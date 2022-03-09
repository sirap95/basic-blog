<?php

namespace App\Http\Controllers;

use App\Http\Traits\ImageTrait;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;


class PostController extends Controller
{
    use ImageTrait;

    /* Guest functions */

    public function getIndex()
    {
        $posts = Post::latest()->paginate(6);
        return view('guest.index', ['posts' => $posts, 'topPosts' => $this->getTopPosts()]);
    }

    public function getTopPosts()
    {
        $topPosts = Post::orderBy('views', 'desc')->take(3)->get();
        return $topPosts;
    }

    public function getPost($id)
    {
        $post = Post::find($id);
        //Update post count
        Post::find($id)->increment('views');
        return view('guest.post', ['post' => $post, 'topPosts' => $this->getTopPosts()]);
    }

    /* Admin functions */

    public function getAdminIndex()
    {
        $posts = Post::all();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getAdminEdit($id)
    {
        $post = Post::find($id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);
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
            'content' => 'required|min:15'
        ]);
        $post = new Post;
        $post->title = $request->input('title');
        $post->description = $request->input('description');
        $post->content = $request->input('content');
        $this->updatePreviewImage($request, $post, false);
        $this->updateMainImage($request, $post, false);
        $post->save();
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

        return redirect()->back()
            ->with('info', 'Post edited, new title: ' . $request->input('title'));
    }
}
