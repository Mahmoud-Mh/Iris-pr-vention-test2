@extends('layouts.app')

@section('title', 'Dashboard')

@section('content')
<div class="card text-center">
    <div class="card-header">
        Welcome, {{ Auth::user()->name }}
    </div>
    <div class="card-body">
        <h5 class="card-title">What would you like to do today?</h5>
        <div class="d-flex justify-content-center gap-3">
            <a href="{{ route('posts.index') }}" class="btn btn-primary">View Posts</a>
            <a href="{{ route('posts.create') }}" class="btn btn-success">Create New Post</a>
        </div>
    </div>
    <div class="card-footer text-muted">
        {{ now()->format('F d, Y') }}
    </div>
</div>
@endsection
