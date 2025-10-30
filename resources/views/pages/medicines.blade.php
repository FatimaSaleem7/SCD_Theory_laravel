@extends('layouts.app')

@section('title', 'Medicines')

@section('content')
<!-- Medicines Section -->
<section class="py-5 mt-5">
    <div class="container text-center">

        <!-- Product Categories -->
        <h2 class="text-success fw-bold mb-4">Shop by Category</h2>
        <div class="row g-3 justify-content-center mb-5" id="categoryCards">

            <!-- 🔹 All Medicines -->
            <div class="col-6 col-md-4 col-lg-2">
                <div class="category-card p-3 shadow-sm border rounded text-center active" data-category="all">
                    <i class="fa-solid fa-boxes-stacked fa-2x text-success mb-2"></i>
                    <h6>All Medicines</h6>
                </div>
            </div>

            <!-- Other Categories -->
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
            @php
            $medicines = [
                ['name'=>'Paracetamol','price'=>150,'img'=>'image/panadol.png','category'=>'otc','desc'=>'Effective for fever and pain relief.'],
                ['name'=>'Axomax Capsule','price'=>220,'img'=>'image/azomax.png','category'=>'prescription','desc'=>'Common antibiotic used for infections.'],
                ['name'=>'Folic Acid','price'=>180,'img'=>'image/folicacid.png','category'=>'vitamins','desc'=>'Boosts immunity and supports RBC health.'],
                ['name'=>'Toothbrush','price'=>120,'img'=>'image/colgate.png','category'=>'personal','desc'=>'Helps with dental hygiene.'],
                ['name'=>'Ibuprofen','price'=>200,'img'=>'image/brufen.png','category'=>'otc','desc'=>'Reduces fever and cures minor aches.'],
                ['name'=>'Baby Oil','price'=>350,'img'=>'image/babyoil.png','category'=>'baby','desc'=>"Nourishes the baby's skin with all natural oils."],
                ['name'=>'Flagyl Tablet','price'=>250,'img'=>'image/flagyl.jpg','category'=>'prescription','desc'=>'Treats bacterial and parasitic infections effectively.'],
                ['name'=>'Surbex Z Vitamin','price'=>300,'img'=>'image/surbex.jpg','category'=>'vitamins','desc'=>'Boosts energy and supports immune system health.'],
                ['name'=>'Toothpaste','price'=>180,'img'=>'image/toothpaste.png','category'=>'personal','desc'=>'Cleans teeth, freshens breath, and prevents cavities.'],
            ];
            @endphp

            @foreach($medicines as $medicine)
            <div class="col-12 col-sm-6 col-md-4 medicine-card" data-category="{{ $medicine['category'] }}">
                <div class="card shadow-sm h-100">
                    <a href="{{ route('medicinedetail', ['name' => $medicine['name']]) }}" class="text-decoration-none text-dark">
                        <img src="{{ asset($medicine['img']) }}" class="card-img-top medicine-img" alt="{{ $medicine['name'] }}">
                        <div class="card-body">
                            <h5 class="card-title fw-bold">{{ $medicine['name'] }}</h5>
                            <p class="card-text text-muted">{{ $medicine['desc'] }}</p>
                            <p class="text-success fw-semibold">Rs. {{ $medicine['price'] }}</p>
                        </div>
                    </a>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/store.js') }}"></script>
@endpush
