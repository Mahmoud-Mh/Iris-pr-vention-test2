@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Edit Post</h1>

    <form method="POST" action="{{ route('post.update', $post) }}">
        @csrf
        @method('POST')

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" class="form-control" name="title" value="{{ $post->title }}" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" class="form-control" name="content" rows="5" required>{{ $post->content }}</textarea>
        </div>

        <button type="submit" class="btn btn-warning">Update Post</button>
    </form>
</div>
@endsection
