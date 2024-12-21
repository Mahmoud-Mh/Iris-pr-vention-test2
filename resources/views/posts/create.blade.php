@extends('layouts.app')

@section('title', 'Create Post')

@section('content')
<h1>Create a New Post</h1>
<form action="{{ route('posts.store') }}" method="POST">
    @csrf
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" id="body" class="form-control" rows="5" required></textarea>
    </div>
    <button type="submit" class="btn btn-primary">Create Post</button>
</form>
@endsection
