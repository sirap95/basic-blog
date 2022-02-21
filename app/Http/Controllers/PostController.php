<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Session\Store;

class PostController extends Controller
{

    /* Guest functions */

    public function getIndex()
    {
        $posts = Post::all();
        return view('guest.index', ['posts' => $posts]);
    }

    public function getPost($id) {
        $post = Post::find($id);
        return view('guest.post', ['post' => $post]);
    }

    /* Admin functions */

    public function getAdminIndex() {
        $posts = Post::all();
        return view('admin.index', ['posts' => $posts]);
    }

    public function getAdminEdit($id) {
        $post = Post::find($id);
        return view('admin.edit', ['post' => $post, 'postId' => $id]);
    }

    public function deleteAdminPost($id) {
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
        return redirect()->route('admin.index')->with('info', 'Post created, title is: '. $request->input('title'));
    }
}
