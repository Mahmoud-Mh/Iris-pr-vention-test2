@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')
<div class="d-flex justify-content-center align-items-center" style="height: 80vh;">
    <div class="card p-4" style="width: 100%; max-width: 400px;">
        <h1 class="text-center">Reset Password</h1>
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <form action="{{ route('password.email') }}" method="POST">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Send Reset Link</button>
        </form>
    </div>
</div>
@endsection
