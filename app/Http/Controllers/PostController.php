<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;

class PostController extends Controller
{
    // Display a listing of posts
    public function index()
    {
        $posts = Post::all();  // Fetch all posts
        return view('posts.index', compact('posts'));  // Pass posts to view
    }

    // Show the form for creating a new post
    public function create()
    {
        return view('posts.create');  // Display the form to create a post
    }

    // Store a newly created post in the database
    public function store(Request $request)
    {
        // Validate the request input
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Create a new post and associate it with the authenticated user
        Post::create([
            'title' => $request->title,
            'body' => $request->body,
            'user_id' => auth()->id(),  // Set user_id to the authenticated user's ID
        ]);

        // Redirect to the post index with a success message
        return redirect()->route('posts.index')->with('success', 'Post created successfully!');
    }

    // Show the form for editing the specified post
    public function edit(Post $post)
    {
        return view('posts.edit', compact('post'));  // Pass the post to the edit view
    }

    // Update the specified post in the database
    public function update(Request $request, Post $post)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'body' => 'required|string',
        ]);

        // Update the post
        $post->update($request->all());

        // Redirect to the posts index with a success message
        return redirect()->route('posts.index')->with('success', 'Post updated successfully!');
    }

    // Remove the specified post from the database
    public function destroy(Post $post)
    {
        // Delete the post
        $post->delete();

        // Redirect to the posts index with a success message
        return redirect()->route('posts.index')->with('success', 'Post deleted successfully!');
    }

    // Show the details of a single post
    public function show(Post $post)
    {
        return view('posts.show', compact('post'));  // Return the post view
    }
}
