@extends('layouts.app')

@section('title', $post->title)

@section('content')
<div class="card">
    <div class="card-body">
        <h1 class="card-title">{{ $post->title }}</h1>
        <p class="card-text">{{ $post->body }}</p>
        <p class="text-muted">Posted on {{ $post->created_at->format('F d, Y') }}</p>
    </div>
</div>

<hr>

<h3>Comments</h3>
@if ($post->comments->isEmpty())
    <p>No comments yet.</p>
@else
    @foreach ($post->comments as $comment)
        <div class="alert alert-secondary">
            {{ $comment->comment }} <!-- This should be $comment->comment instead of $comment->body -->
        </div>
    @endforeach
@endif

<hr>

<h3>Add a Comment</h3>
<form action="{{ route('posts.comments.store', $post) }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="comment" class="form-label">Comment</label>
        <textarea name="comment" id="comment" class="form-control" rows="3" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Add Comment</button>
</form>

@endsection
