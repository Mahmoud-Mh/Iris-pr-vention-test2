@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1>Create New Post</h1>

    <form method="POST" action="{{ route('post.store') }}">
        @csrf

        <div class="mb-3">
            <label for="title" class="form-label">Title</label>
            <input type="text" id="title" class="form-control" name="title" required>
        </div>

        <div class="mb-3">
            <label for="content" class="form-label">Content</label>
            <textarea id="content" class="form-control" name="content" rows="5" required></textarea>
        </div>

        <button type="submit" class="btn btn-success">Create Post</button>
    </form>
</div>
@endsection
