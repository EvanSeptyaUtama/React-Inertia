<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::latest()->get();
        return inertia('Posts/Index', [
            'posts' => $posts
        ]);
    }
    public function create()
    {
        return inertia('Posts/Create');
    }

    public function store(Request $request)
    {
        //set validation
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        //create posts
        Post::create([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //redirect
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Disimpan!');
    }
    public function edit(Post $post)
    {
        return inertia(
            'Posts/Edit',
            ['post' => $post]
        );
    }

    public function update(Request $request, Post $post)
    {
        //set validation
        $request->validate([
            'title'   => 'required',
            'content' => 'required',
        ]);

        //update post
        $post->update([
            'title'     => $request->title,
            'content'   => $request->content
        ]);

        //redirect
        return redirect()->route('posts.index')->with('success', 'Data Berhasil Diupdate!');
    }

    public function destroy(Post $post)
    {
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Data berhasil dihapus!');
    }
}
