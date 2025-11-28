@extends('layouts.frontend')

@section('title', 'Departments')

@section('content')
<!-- Departments Section -->
<section class="py-5 mt-5">
    <div class="container">
        <h2 class="text-success fw-bold text-center mb-5">Our Departments</h2>

        <div class="row g-4">
            @forelse($departments as $dept)
                <div class="col-md-4">
                  <div class="card shadow-sm h-100 text-center">

                        <div class="card-body d-flex flex-column align-items-center">

                            <!-- Image + Icon Side by Side -->
                            <div class="d-flex align-items-center mb-3" style="gap:10px;">
                                @if($dept->image)
                                    <img src="{{ asset('storage/'.$dept->image) }}" 
                                         alt="{{ $dept->name }}" 
                                         class="rounded-circle"
                                         style="width:80px; height:80px; object-fit:cover;">
                                @endif

                                @if($dept->icon)
                                    <i class="{{ $dept->icon }} fa-3x text-success"></i>
                                @endif

                                @if(!$dept->image && !$dept->icon)
                                    <i class="fas fa-building fa-3x text-success"></i>
                                @endif
                            </div>

                            <!-- Department Name -->
                            <h5 class="card-title fw-bold">{{ $dept->name }}</h5>

                            <!-- Department Description -->
                            <p class="text-muted">{{ $dept->description ?? '-' }}</p>

                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12 text-center">
                    <p class="text-muted">No departments available at the moment.</p>
                </div>
            @endforelse
        </div>
    </div>
</section>
@endsection
