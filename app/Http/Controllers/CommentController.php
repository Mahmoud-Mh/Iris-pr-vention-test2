<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\Comment;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(Request $request, Post $post)
    {
        $request->validate([
            'comment' => 'required|string|max:1000', 
        ]);
    
        $post->comments()->create([
            'user_id' => auth()->id(),
            'comment' => $request->comment,
        ]);
    
        return redirect()->route('posts.show', $post)->with('success', 'Comment added successfully!');
    }
    
}
