@extends('layouts.frontend')

@section('title', 'Medicines')

@section('content')
<!-- Medicines Section -->
<section class="py-5 mt-5">
    <div class="container text-center">

        <!-- Product Categories -->
        <h2 class="text-success fw-bold mb-4">Shop by Category</h2>
        <div class="row g-3 justify-content-center mb-5" id="categoryCards">
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card p-3 shadow-sm border rounded text-center active" data-category="all">
                    <i class="fa-solid fa-boxes-stacked fa-2x text-success mb-2"></i>
                    <h6>All Medicines</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card p-3 shadow-sm border rounded text-center" data-category="prescription">
                    <i class="fa-solid fa-prescription-bottle-medical fa-2x text-success mb-2"></i>
                    <h6>Prescription Medicines</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card p-3 shadow-sm border rounded text-center" data-category="otc">
                    <i class="fa-solid fa-pills fa-2x text-success mb-2"></i>
                    <h6>OTC & Wellness</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card p-3 shadow-sm border rounded text-center" data-category="vitamins">
                    <i class="fa-solid fa-capsules fa-2x text-success mb-2"></i>
                    <h6>Vitamins & Supplements</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card p-3 shadow-sm border rounded text-center" data-category="personal">
                    <i class="fa-solid fa-spa fa-2x text-success mb-2"></i>
                    <h6>Personal Care</h6>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card p-3 shadow-sm border rounded text-center" data-category="baby">
                    <i class="fa-solid fa-baby fa-2x text-success mb-2"></i>
                    <h6>Baby & Mother Care</h6>
                </div>
            </div>
        </div>

        <!-- Medicines Grid -->
        <h2 class="text-success fw-bold mb-4">Our Medicines</h2>
        <div class="row g-4" id="medicineContainer">
            @forelse($medicines as $medicine)
            <div class="col-12 col-sm-6 col-md-4 medicine-card" data-category="{{ $medicine->category ?? 'other' }}">
                <div class="card shadow-sm h-100">
                    <a href="{{ route('medicinedetail', $medicine->id) }}" class="text-decoration-none text-dark">
                        <img src="{{ $medicine->image ? asset('storage/'.$medicine->image) : asset('image/placeholder.png') }}" class="card-img-top medicine-img" alt="{{ $medicine->name }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $medicine->name }}</h5>
                            <p class="card-text text-muted">{{ \Illuminate\Support\Str::limit($medicine->description, 90) }}</p>
                            <p class="text-success fw-semibold">Rs. {{ $medicine->price }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @empty
            <div class="col-12 text-center">
                <p class="text-muted">No medicines available yet.</p>
            </div>
            @endforelse
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/store.js') }}"></script>
@endpush
