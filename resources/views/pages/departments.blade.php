@extends('layouts.frontend')

@section('title', 'Departments')

@section('content')
<!-- Departments Section -->
<section class="py-5 mt-5">
    <div class="container">
        <h2 class="text-success fw-bold text-center mb-5">Our Departments</h2>

        <div class="row g-4">
            @php
            $departments = [
                ['icon'=>'fas fa-heartbeat','title'=>'Cardiology','desc'=>'Providing expert care for heart-related conditions with advanced diagnostics and treatment.'],
                ['icon'=>'fas fa-brain','title'=>'Neurology','desc'=>'Our neurologists specialize in brain, spine, and nervous system disorders with precise treatments.'],
                ['icon'=>'fas fa-bone','title'=>'Orthopedics','desc'=>'Specialized care for bones, joints, and muscles ensuring mobility and pain relief.'],
                ['icon'=>'fas fa-stethoscope','title'=>'General Medicine','desc'=>'Our general physicians offer comprehensive care for everyday health needs and preventive checkups.'],
                ['icon'=>'fas fa-x-ray','title'=>'Radiology','desc'=>'Equipped with the latest imaging technologies to assist in accurate diagnostics.'],
                ['icon'=>'fas fa-child','title'=>'Pediatrics','desc'=>'Comprehensive child care services from birth through adolescence by experienced pediatricians.'],
            ];
            @endphp

            @foreach($departments as $dept)
            <div class="col-md-4">
                <div class="card shadow-sm h-100 text-center">
                    <div class="card-body">
                        <i class="{{ $dept['icon'] }} fa-3x text-success mb-3"></i>
                        <h5 class="card-title fw-bold">{{ $dept['title'] }}</h5>
                        <p class="text-muted">{{ $dept['desc'] }}</p>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
