<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Image;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    use ImageTrait;

    /* Guest functions */
    public function getIndex()
    {
        $posts = Post::with('users')->latest()->paginate(6);
        return view('guest.index', ['posts' => $posts, 'topPosts' => $this->getTopPosts(), 'preview_images' => $this->getPreviewImages()]);
    }

    public function getPostByTag($id)
    {
        $tag = Tag::find($id);
        $posts = $tag->posts()->latest()->paginate(6);
        return view('guest.tag', ['posts' => $posts, 'topPosts' => $this->getTopPosts(), 'preview_images' => $this->getPreviewImages()]);
    }

    public function getRelatedPosts($id, $post_id)
    {
        $tag = Tag::find($id);
        $relatedPosts = $tag->posts()->where('post_id', '!=', $post_id)->orderBy('views', 'desc')->take(2)->get();
        return $relatedPosts;
    }

    public function getPreviewImages()
    {
        $preview_images = Image::with('Posts')->where('folder', '=', 'preview_images')->get();
        return $preview_images;
    }

    public function getMainImages()
    {
        $main_images = Image::with('Posts')->where('folder', '=', 'main_images')->get();
        return $main_images;
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

        $user_id = $post->value('user_id');

        $profile_image_url = Image::where('user_id', '=', $user_id)
            ->where('folder', '=', 'profile_images')
            ->value('url');

        $main_image_url = Image::where('post_id', '=', $id)
            ->where('folder', '=', 'main_images')
            ->value('url');
        //Update post count
        Post::find($id)->increment('views');
        return view('guest.post', ['post' => $post, 'preview_images' => $this->getPreviewImages(),
            'topPosts' => $this->getTopPosts(), 'tag' => $tag,
            'relatedPosts' => $this->getRelatedPosts($tag_id, $id),
            'tag_id' => $tag_id, 'main_image_url' => $main_image_url, 'profile_image_url' => $profile_image_url]);
    }

    /* Admin functions */
    public function getAdminIndex()
    {
        //show just the posts of the admin logged in
        $posts = Post::where('user_id', Auth::id())->get();
        return view('admin.index', ['posts' => $posts, 'preview_images' => $this->getPreviewImages()]);
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
        $preview_image_url = Image::where('post_id', '=', $id)
            ->where('folder', '=', 'preview_images')
            ->value('url');
        return view('admin.edit', ['post' => $post, 'postId' => $id,
            'tags' => $tags, 'preview_image' => $preview_image_url]);
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
            'content' => 'required|min:15',
            'tag' => 'required'
        ]);
        $post = new Post;

        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $preview_image_id = $this->uploadPreviewImageNew($request, null, false);
        $post->user_id = Auth::id();
        $post->save();

        $id = $post->id;

        Image::where('id', '=', $preview_image_id)->update(array('post_id' => $id));

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
            'tag' => 'required',
//            'main_image',
            'preview_image'
        ]);
        $post = Post::find($id);
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        if (!empty($request->input('preview_image')))
            $this->uploadPreviewImageNew($request, $post, true);
        $post->update();

        $current_tag_name = "CURRENT TAG: " . $post->tags->first()->name;
        $current_tag = $post->tags->first()->id;

        if ($current_tag_name != $request->input('tag'))
            $post->tags()->detach($current_tag);


        $tag = Tag::select('id')->where('name', $request->input('tag'))->get();

        $post->tags()->attach($tag);

        return redirect()->back()
            ->with('info', 'Post edited, new title: ' . $request->input('title'));
    }

    /* SEARCH METHOD */
    public function search(Request $request)
    {
        $search = $request->input('search');

        // Search in the title and content columns from the posts table
        $posts = Post::query()
            ->where('title', 'LIKE', "%{$search}%")
            ->orWhere('content', 'LIKE', "%{$search}%")
            ->latest()->paginate(6);

        // Return the search view with the result
        return view('guest.index', ['posts' => $posts, 'topPosts' => $this->getTopPosts(), 'preview_images' => $this->getPreviewImages()]);
    }
}
