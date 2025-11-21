@extends('layouts.frontend')

@section('title', 'Product Details')

@section('content')
@if($product)
<section class="py-5 mt-5">
    <div class="container">
        <div class="row align-items-center gy-4">
            <!-- Product Image -->
            <div class="col-md-5 text-center">
                <div class="p-3 bg-white rounded-4 shadow-sm border" style="max-width: 350px; margin: auto;">
                    <img src="{{ $product->image ? asset('storage/'.$product->image) : asset('image/placeholder.png') }}" 
                         alt="{{ $product->name }}" 
                         class="img-fluid rounded-3" 
                         style="object-fit: contain; max-height: 260px; width: 100%;">
                </div>
            </div>

            <!-- Product Info -->
            <div class="col-md-7">
                <h2 class="text-success fw-bold">{{ $product->name }}</h2>
                <p class="text-muted mt-3">{{ $product->description }}</p>
                <h4 class="text-success mt-3">Rs. {{ $product->price }}</h4>

                <!-- Quantity Control -->
                <div class="d-flex align-items-center mt-3">
                    <button class="btn btn-outline-success btn-sm"
                        onclick="let input=this.nextElementSibling; input.value=Math.max(1, parseInt(input.value)-1)">−</button>
                    <input type="number" value="1" min="1"
                        class="form-control text-center mx-2" style="width:60px;">
                    <button class="btn btn-outline-success btn-sm"
                        onclick="let input=this.previousElementSibling; input.value=parseInt(input.value)+1">+</button>
                </div>

                <!-- Buttons -->
                <div class="mt-4">
                    <button class="btn btn-success me-2"
                        onclick="addToCart('{{ $product->name }}', {{ $product->price }}, '{{ $product->image ? asset('storage/'.$product->image) : asset('image/placeholder.png') }}', this)">
                        Add to Cart
                    </button>
                    <a href="{{ url('/cart') }}" class="btn btn-outline-success me-2">Go to Cart</a>
                    <a href="{{ route('medicines') }}" class="btn btn-outline-secondary">Back to Medicines</a>
                </div>
            </div>
        </div>

        <!-- Customer Reviews (static placeholder) -->
        <div class="mt-5">
            <h4 class="text-success fw-bold mb-3">Customer Reviews</h4>

            <p class="text-muted">No reviews yet. Be the first to write one!</p>

            <!-- Add Review Form -->
            <div class="mt-3">
                <h6 class="fw-semibold text-success mb-2">Add Your Review:</h6>
                <div class="d-flex">
                    <input type="text" class="form-control me-2" id="reviewInput" placeholder="Write your review...">
                    <button class="btn btn-success btn-sm" onclick="submitReview()">Submit</button>
                </div>
            </div>
        </div>
    </div>
</section>
@else
<section class="py-5 mt-5 text-center">
    <div class="container">
        <h2 class="text-danger">Product not found.</h2>
        <a href="{{ route('medicines') }}" class="btn btn-success mt-3">Back to Medicines</a>
    </div>
</section>
@endif
@endsection

@push('scripts')
<script src="{{ asset('js/store.js') }}"></script>
<script>
function submitReview() {
    const input = document.getElementById("reviewInput");
    if (!input.value.trim()) return;
    input.value = "";
}
</script>
@endpush
