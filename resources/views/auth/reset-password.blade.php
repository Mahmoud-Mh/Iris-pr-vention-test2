@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')
<h1>Reset Password</h1>
@if($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif
<form action="{{ route('password.update') }}" method="POST">
    @csrf
    <input type="hidden" name="token" value="{{ $token }}">
    <div class="mb-3">
        <label for="email" class="form-label">Email</label>
        <input type="email" name="email" id="email" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password" class="form-label">New Password</label>
        <input type="password" name="password" id="password" class="form-control" required>
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Confirm New Password</label>
        <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
    </div>
    <button type="submit" class="btn btn-primary">Reset Password</button>
</form>
@endsection
