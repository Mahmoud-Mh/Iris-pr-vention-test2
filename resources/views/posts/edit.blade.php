@extends('layouts.app')

@section('title', 'Edit Post')

@section('content')
<h1>Edit Post</h1>
<form action="{{ route('posts.update', $post) }}" method="POST">
    @csrf
    @method('PUT')
    <div class="mb-3">
        <label for="title" class="form-label">Title</label>
        <input type="text" name="title" id="title" class="form-control" value="{{ old('title', $post->title) }}" required>
    </div>
    <div class="mb-3">
        <label for="body" class="form-label">Body</label>
        <textarea name="body" id="body" class="form-control" rows="5" required>{{ old('body', $post->body) }}</textarea>
    </div>
    <button type="submit" class="btn btn-primary">Update Post</button>
</form>
@endsection
