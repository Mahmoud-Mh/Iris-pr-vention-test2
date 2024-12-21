@extends('layouts.app')

@section('title', 'All Posts')

@section('content')
<h1 class="mb-4">All Posts</h1>
<a href="{{ route('posts.create') }}" class="btn btn-primary mb-3">Create New Post</a>

@forelse ($posts as $post)
    <div class="card mb-3">
        <div class="card-body">
            <h3 class="card-title">{{ $post->title }}</h3>
            <p class="card-text">{{ $post->body }}</p>
            <div class="d-flex justify-content-between">
                <a href="{{ route('posts.show', $post) }}" class="btn btn-info btn-sm">View</a>
                <a href="{{ route('posts.edit', $post) }}" class="btn btn-warning btn-sm">Edit</a>
                <form action="{{ route('posts.destroy', $post) }}" method="POST" style="display:inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                </form>
            </div>
        </div>
    </div>
@empty
    <p>No posts available.</p>
@endforelse
@endsection
