<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;


class PostController extends Controller
{
    use ImageTrait;

    /* Guest functions */

    public function getIndex()
    {
        //$posts = Post::latest()->paginate(6);

       $posts = Post::with('users')->latest()->paginate(6);

        return view('guest.index', ['posts' => $posts, 'topPosts' => $this->getTopPosts()]);
    }

    public function getPostByTag($id)
    {
        $tag = Tag::find($id);

        $posts = $tag->posts()->latest()->paginate(6);
        return view('guest.tag', ['posts' => $posts, 'topPosts' => $this->getTopPosts()]);
    }

    public function getRelatedPosts($id, $post_id)
    {
        $tag = Tag::find($id);
        $relatedPosts = $tag->posts()->where('post_id', '!=', $post_id)->orderBy('views', 'desc')->take(2)->get();
        return $relatedPosts;
    }


    public function getTopPosts()
    {
        $topPosts = Post::orderBy('views', 'desc')->take(3)->get();
        return $topPosts;
    }

    public function getPost($id)
    {
        $post = Post::with('users')->find($id);
        $tag = $post->tags->first()->name;
        $tag_id = $post->tags->first()->id;
        $images = $post->images->all();
        $main_image_url =
        //Update post count
        Post::find($id)->increment('views');
        return view('guest.post', ['post' => $post, 'topPosts' => $this->getTopPosts(), 'tag' => $tag,
            'relatedPosts' => $this->getRelatedPosts($tag_id, $id), 'tag_id' => $tag_id]);
    }

    /* Admin functions */

    public function getAdminIndex()
    {
        //show just the posts of the admin logged in
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.index', ['posts' => $posts]);
    }

    public function create()
    {
        $tags = Tag::all();
        return view('admin.create', ['tags' => $tags]);
    }

    public function getAdminEdit($id)
    {
        $post = Post::find($id);
        $tags = Tag::all();
        return view('admin.edit', ['post' => $post, 'postId' => $id, 'tags' => $tags]);
    }

    public function deleteAdminPost($id)
    {
        Post::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('info', 'Post deleted succesfully');
    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'description' => 'required|min:5|max:400',
            'content' => 'required|min:15',
            'tag' => 'required'
        ]);
        $post = new Post;

        $update = true;
        $updateMain = true;

        if ($post->preview_image == null)
            $update = false;
        if ($post->main_image == null)
            $updateMain = false;

        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $this->updatePreviewImage($request, $post, $update);
        $image_id = $this->uploadImageNew($request);
        $post->user_id = Auth::id();
        $post->save();
        $id = $post->id;
        $image = Image::findOrFail($image_id);
        $image->posts()->attach($id);
        $tag = Tag::select('id')->where('name', $request->input('tag'))->get();
        $post->tags()->attach($tag);

        return redirect()->route('admin.index')->with('info', 'Post created, title is: ' . $request->input('title'));
    }

    public function uploadImageContent(Request $request)
    {
        $this->upload($request);
    }

    public function postAdminEdit(Request $request, $id)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:15',
            'description' => 'required|min:15|max:400',
            'tag' => 'required',
            'main_image',
            'preview_image'
        ]);
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $this->updatePreviewImage($request, $post, true);
        $this->updateMainImage($request, $post, true);
        $post->update();

        $current_tag_name ="CURRENT TAG: ".$post->tags->first()->name;
        $current_tag = $post->tags->first()->id;

        if($current_tag_name != $request->input('tag'))
            $post->tags()->detach($current_tag);


        $tag = Tag::select('id')->where('name', $request->input('tag'))->get();

        $post->tags()->attach($tag);

        return redirect()->back()
            ->with('info', 'Post edited, new title: ' . $request->input('title'));
    }
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Search in the title and content columns from the posts table
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->latest()->paginate(6);

        // Return the search view with the result
        return view('guest.index', ['posts' => $posts, 'topPosts' => $this->getTopPosts()]);
    }
}
