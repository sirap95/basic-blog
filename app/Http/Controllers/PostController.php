<?php

namespace App\Http\Controllers;

use App\Models\Like;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class PostController extends Controller
{

    /* Guest functions */

    public function getIndex()
    {
        $posts = Post::all();
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
        $post = Post::findOrFail($id)->delete();
        return redirect()->route('admin.index')->with('info', 'Post deleted succesfully');
    }

    public function postAdminCreate(Request $request)
    {
        $this->validate($request, [
            'title' => 'required|min:5',
            'content' => 'required|min:15'
        ]);
        $post = new Post([
            'title' => $request->input('title'),
            'content' => $request->input('content')
        ]);
        $post->save();
        return redirect()->route('admin.index')->with('info', 'Post created, title is: ' . $request->input('title'));
    }

    public function liker($postId)
    {
        $like = new Like([
            'post_id' => $postId
        ]);
        $like->save();
        return redirect()->back();
    }
}
