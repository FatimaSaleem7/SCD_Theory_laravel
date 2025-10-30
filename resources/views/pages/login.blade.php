@extends('layouts.app')

@section('title', 'Login')

@section('content')
<section class="login-section d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="login-container bg-light shadow p-4 rounded" style="width:100%; max-width:400px; margin-top:80px;">
        <h2 class="text-center mb-4 text-success"><i class="fa-solid fa-lock me-2"></i>Login</h2>

        <form method="GET" action="{{ route('login') }}">
            @csrf
            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Login</button>
                <a href="{{ route('register') }}" class="btn btn-outline-secondary">Create Account</a>
            </div>
        </form>
    </div>
</section>
@endsection
