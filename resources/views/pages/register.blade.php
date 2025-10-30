@extends('layouts.app')

@section('title', 'Register')

@section('content')
<section class="register-section d-flex justify-content-center align-items-center" style="min-height:100vh;">
    <div class="register-container bg-light shadow p-4 rounded" style="width:100%; max-width:450px; margin-top:80px;">
        <h2 class="text-center mb-4 text-success"><i class="fa-solid fa-user-plus me-2"></i>Create Account</h2>

        <form method="GET" action="{{ route('register') }}">
            @csrf
            <div class="mb-3">
                <label for="name" class="form-label">Full Name:</label>
                <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email:</label>
                <input type="email" id="email" name="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="phone" class="form-label">Phone:</label>
                <input type="text" id="phone" name="phone" class="form-control" value="{{ old('phone') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password:</label>
                <input type="password" id="password" name="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="password_confirmation" class="form-label">Confirm Password:</label>
                <input type="password" id="password_confirmation" name="password_confirmation" class="form-control" required>
            </div>

            <div class="d-grid gap-2">
                <button type="submit" class="btn btn-success">Register</button>
                <a href="{{ route('login') }}" class="btn btn-outline-secondary">Login</a>
            </div>
        </form>
    </div>
</section>
@endsection
