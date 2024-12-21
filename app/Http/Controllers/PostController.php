<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PostController extends Controller
{
    // Display the home page with a list of posts
    public function index()
    {
        $posts = Post::where('user_id', Auth::id())->get();
        return view('home', compact('posts'));
    }

    // Show the form to create a new post
    public function create()
    {
        return view('post.create'); // No need to pass any $post variable here
    }

    // Store a new post in the database
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        Post::create([
            'user_id' => Auth::id(),
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('home')->with('status', 'Post created successfully!');
    }

    // Show the form to edit an existing post
    public function edit(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not authorized to edit this post.');
        }

        return view('post.edit', compact('post')); // Pass $post for editing
    }

    // Update an existing post
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
        ]);

        $post->update([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        return redirect()->route('home')->with('status', 'Post updated successfully!');
    }

    // Delete a post
    public function destroy(Post $post)
    {
        if ($post->user_id !== Auth::id()) {
            return redirect()->route('home')->with('error', 'You are not authorized to delete this post.');
        }

        $post->delete();
        return redirect()->route('home')->with('status', 'Post deleted successfully!');
    }
}
