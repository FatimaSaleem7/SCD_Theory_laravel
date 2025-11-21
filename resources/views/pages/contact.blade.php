@extends('layouts.frontend')

@section('title', 'Contact')

@section('content')
<!-- Contact Section -->
<section class="py-5 mt-5 contact-section">
    <div class="container">
        <h2 class="text-success fw-bold mb-4 text-center">Contact Us</h2>
        <div class="row align-items-center justify-content-center">
            
            <!-- Image Column -->
            <div class="col-md-5 mb-4 mb-md-0 text-center">
                <img src="{{ asset('image/contactUs.png') }}" alt="Contact Us" class="img-fluid rounded shadow-sm">
            </div>

            <!-- Form Column -->
            <div class="col-md-7">
                <form class="shadow p-4 bg-light rounded">
                    <div class="mb-3">
                        <label for="name" class="form-label">Full Name</label>
                        <input type="text" class="form-control" id="name" placeholder="Enter your name">
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" placeholder="Enter your email">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">Message</label>
                        <textarea class="form-control" id="message" rows="4" placeholder="Type your message..."></textarea>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Send Message</button>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Contact Info Section -->
<section class="bg-light py-5">
    <div class="container text-center">
        <div class="row justify-content-center">
            <div class="col-md-4 mb-3">
                <i class="fas fa-map-marker-alt fa-2x text-success mb-2"></i>
                <p class="mb-0 fw-bold">CarePlus Hospital</p>
                <p>Clifton Block 8, Karachi, Pakistan</p>
            </div>
            <div class="col-md-4 mb-3">
                <i class="fas fa-phone fa-2x text-success mb-2"></i>
                <p class="mb-0 fw-bold">+92 300 1234567</p>
                <p>021 98765423</p>
            </div>
            <div class="col-md-4 mb-3">
                <i class="fas fa-envelope fa-2x text-success mb-2"></i>
                <p class="mb-0 fw-bold">info@careplus.com</p>
                <p>support@careplus.com</p>
            </div>
        </div>
    </div>
</section>
@endsection
