@extends('layouts.frontend')

@section('title', 'Cart')

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <h2 class="text-success fw-bold mb-4 text-center">Your Cart</h2>

        <div class="table-responsive">
    <table class="table table-bordered align-middle text-center">
        <thead class="table-success">
            <tr>
                <th>Image</th>
                <th>Product</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody id="cart-items"></tbody>
    </table>
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

@endpush
