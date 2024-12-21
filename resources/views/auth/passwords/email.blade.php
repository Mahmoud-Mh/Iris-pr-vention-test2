@extends('layouts.app')

@section('content')
    <h2 class="text-center">Reset Password</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.email') }}">
        @csrf

        <div class="mb-3">
            <label for="email" class="form-label">Enter your email address</label>
            <input type="email" id="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        <button type="submit" class="btn btn-primary w-100">Send Password Reset Link</button>
    </form>

    <div class="text-center mt-3">
        <p>Back to <a href="{{ route('login') }}">Login</a></p>
    </div>
@endsection
