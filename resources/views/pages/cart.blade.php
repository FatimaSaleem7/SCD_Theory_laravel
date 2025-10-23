@extends('layouts.app')

@section('title', 'Cart')

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <h2 class="text-success fw-bold mb-4 text-center">Your Cart</h2>

        <div id="cart-items" class="row g-4">
            <!-- JS will inject cart items here -->
        </div>

        <div class="text-end mt-4">
            <h4 class="fw-bold">Total: <span id="cart-total" class="text-success">Rs. 0</span></h4>
            <a href="{{ url('/checkout') }}" class="btn btn-success mt-3">Proceed to Checkout</a>
        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/store.js') }}"></script>
<script>
    // Initialize cart display
    document.addEventListener('DOMContentLoaded', () => {
        displayCart();
    });
</script>
@endpush
