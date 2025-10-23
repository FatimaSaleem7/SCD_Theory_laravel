@extends('layouts.app')

@section('title', 'Home')

@section('content')
<!-- Home Section -->
<section id="home" class="py-5 mt-5">
    <div class="container text-center">
        <div class="row align-items-center">
            <div class="col-md-6">
                <img src="{{ asset('image/greendoctor.png') }}" alt="Home Image" class="img-fluid">
            </div>
            <div class="col-md-6">
                <h3 class="text-success fw-bold mt-4">Your Health, Our Commitment.</h3>
                <p class="text-muted mt-3">
                    Ensuring quality healthcare through well-organized hospital departments and reliable medicines.
                    Our system is designed to manage patient care efficiently, provide timely treatments,
                    and maintain a smooth flow between pharmacy and patient services for better health outcomes.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- About Us Section -->
<section id="about" class="py-5 bg-light">
    <div class="container">
        <h1 class="text-center mb-5">
            <span class="text-success">About</span> Us
        </h1>
        <div class="row align-items-center">
            <div class="col-md-6 text-center mb-4 mb-md-0">
                <img src="{{ asset('image/aboutus.png') }}" alt="About Us" class="img-fluid rounded shadow-sm" style="max-height: 350px;">
            </div>
            <div class="col-md-6">
                <h3 class="text-success fw-bold mb-3">We Take Care of Your Health</h3>
                <p class="text-muted">
                    At CarePlus, we are committed to providing quality healthcare services through
                    expert doctors, advanced facilities, and a patient-first approach. Our team ensures
                    that every patient receives personalized care, reliable medicines, and continuous support
                    throughout their recovery journey.
                </p>
            </div>
        </div>
    </div>
</section>

<!-- Stats Section -->
<section class="icons-container py-5 bg-light">
    <div class="container">
        <div class="row g-4 text-center">
            <div class="col-md-3 col-6">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-user-md fa-3x text-success mb-2"></i>
                    <h4>90+</h4>
                    <p class="text-muted">Doctors at Work</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-users fa-3x text-success mb-2"></i>
                    <h4>1000+</h4>
                    <p class="text-muted">Satisfied Patients</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-bed fa-3x text-success mb-2"></i>
                    <h4>500+</h4>
                    <p class="text-muted">Bed Facility</p>
                </div>
            </div>
            <div class="col-md-3 col-6">
                <div class="p-3 border rounded shadow-sm">
                    <i class="fas fa-flask fa-3x text-success mb-2"></i>
                    <h4>1200+</h4>
                    <p class="text-muted">Lab Tests Conducted</p>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection
