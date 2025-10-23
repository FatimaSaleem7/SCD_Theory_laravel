@extends('layouts.app')

@section('title', 'Medicines')

@section('content')
<!-- Medicines Section -->
<section class="py-5 mt-5">
    <div class="container text-center">

        <!-- Product Categories -->
        <h2 class="text-success fw-bold mb-4">Shop by Category</h2>
        <div class="row g-3 justify-content-center mb-5" id="categoryCards">
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
                ['name'=>'Paracetamol','price'=>150,'img'=>'image/panadol.png','category'=>'otc','desc'=>'Effective for fever and pain relief.','reviews'=>[['name'=>'Ali','rating'=>'★★★★☆','comment'=>'Always keep it at home. Quick relief.']]],
                ['name'=>'Axomax Capsule','price'=>220,'img'=>'image/azomax.png','category'=>'prescription','desc'=>'Common antibiotic used for infections.','reviews'=>[['name'=>'Maria','rating'=>'★★★★☆','comment'=>'Quick recovery, but always consult doctor first!']]],
                ['name'=>'Folic Acid','price'=>180,'img'=>'image/folicacid.png','category'=>'vitamins','desc'=>'Boosts immunity and supports RBC health.','reviews'=>[['name'=>'Usman','rating'=>'★★★★★','comment'=>'Really helps during flu season!']]],
                ['name'=>'Toothbrush','price'=>120,'img'=>'image/colgate.png','category'=>'personal','desc'=>'Helps with dental hygiene.','reviews'=>[['name'=>'Usman','rating'=>'★★★★★','comment'=>'Essential for Hygiene.']]],
                ['name'=>'Ibuprofen','price'=>200,'img'=>'image/brufen.png','category'=>'otc','desc'=>'Reduces fever and cures minor aches.','reviews'=>[['name'=>'Tooba','rating'=>'★★★','comment'=>'Good for body ache']]],
                ['name'=>'Baby Oil','price'=>350,'img'=>'image/babyoil.png','category'=>'baby','desc'=>"Nourishes the baby's skin with all natural oils.",'reviews'=>[['name'=>'Safia','rating'=>'★★★★','comment'=>'Excellent product for my baby.']]],
                ['name'=>'Flagyl Tablet','price'=>250,'img'=>'image/flagyl.jpg','category'=>'prescription','desc'=>'Treats bacterial and parasitic infections effectively.','reviews'=>[['name'=>'Faria','rating'=>'★★★','comment'=>'Tastes awful but works great for gut problems.']]],
                ['name'=>'Surbex Z Vitamin','price'=>300,'img'=>'image/surbex.jpg','category'=>'vitamins','desc'=>'Boosts energy and supports immune system health.','reviews'=>[['name'=>'Rumaisa','rating'=>'★★★★','comment'=>'Enhances energy levels and strengthens immunity.']]],
                ['name'=>'Toothpaste','price'=>180,'img'=>'image/toothpaste.png','category'=>'personal','desc'=>'Cleans teeth, freshens breath, and prevents cavities.','reviews'=>[['name'=>'Maha','rating'=>'★★★★','comment'=>'Leaves mouth feeling clean and refreshed.']]],
            ];
            @endphp

            @foreach($medicines as $medicine)
            <div class="col-12 col-sm-6 col-md-4 medicine-card" data-category="{{ $medicine['category'] }}">
                <div class="card shadow-sm h-100">
                    <img src="{{ asset($medicine['img']) }}" class="card-img-top medicine-img" alt="{{ $medicine['name'] }}">
                    <div class="card-body">
                        <h5 class="card-title">{{ $medicine['name'] }}</h5>
                        <p class="card-text">{{ $medicine['desc'] }}</p>

                        <!-- Quantity control -->
                        <div class="quantity-control mb-2 d-flex justify-content-center align-items-center">
                            <button class="btn btn-outline-success btn-sm" onclick="let input=this.nextElementSibling; input.value=Math.max(1, parseInt(input.value)-1)">−</button>
                            <input type="number" value="1" min="1" style="width:60px;" class="form-control text-center mx-2">
                            <button class="btn btn-outline-success btn-sm" onclick="let input=this.previousElementSibling; input.value=parseInt(input.value)+1">+</button>
                        </div>

                        <!-- Add to Cart -->
                        <button class="btn btn-success mt-2" onclick="addToCart('{{ $medicine['name'] }}', {{ $medicine['price'] }}, '{{ asset($medicine['img']) }}', this)">
                            Add to Cart
                        </button>

                        <!-- Customer Reviews -->
                        <div class="mt-3">
                            <h6 class="text-success fw-semibold">Customer Reviews:</h6>
                            @foreach($medicine['reviews'] as $review)
                            <div class="review-card">
                                <p class="mb-1"><strong>{{ $review['name'] }}:</strong> {{ $review['comment'] }}</p>
                                <small class="text-muted">{{ $review['rating'] }}</small>
                            </div>
                            @endforeach
                            <div class="d-flex mt-2">
                                <input type="text" class="form-control me-2" placeholder="Write your review...">
                                <button class="btn btn-success btn-sm">Submit</button>
                            </div>
                        </div>

                    </div>
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
