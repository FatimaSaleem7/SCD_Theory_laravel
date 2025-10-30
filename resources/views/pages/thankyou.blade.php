@extends('layouts.app')

@section('title', 'Thank You')

@section('content')
<section class="py-5 mt-5 text-center">
    <div class="container">
        <div class="d-flex flex-column align-items-center justify-content-center">
            <i class="fa-solid fa-circle-check text-success" style="font-size: 4rem;"></i>
            <h1 class="text-success fw-bold mt-3">Thank You!</h1>
            <p class="lead text-muted mt-2">Your order has been placed successfully. We’ll deliver your products soon.</p>
            <a href="{{ route('home') }}" class="btn btn-success mt-4 px-4">Return to Home</a>
        </div>
    </div>
</section>
@endsection
