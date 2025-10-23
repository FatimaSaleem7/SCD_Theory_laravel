@extends('layouts.app')

@section('title', 'Checkout')

@section('content')
<section class="py-5 mt-5">
    <div class="container">
        <h2 class="text-success fw-bold mb-4 text-center">Checkout</h2>
        <div class="row g-5">

            <!-- Billing Info -->
            <div class="col-md-6">
                <div class="shadow p-4 bg-light rounded">
                    <h4 class="fw-bold mb-3">Billing Details</h4>
                    <form id="checkout-form">
                        <div class="mb-3">
                            <label class="form-label">Full Name</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Phone</label>
                            <input type="text" class="form-control" required>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Address</label>
                            <textarea class="form-control" rows="3" required></textarea>
                        </div>
                        <button type="submit" class="btn btn-success w-100">Place Order</button>
                    </form>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="col-md-6">
                <div class="shadow p-4 bg-light rounded">
                    <h4 class="fw-bold mb-3">Order Summary</h4>
                    <div id="checkoutItems">
                        <!-- JS will load cart items -->
                    </div>
                    <hr>
                    <h5 class="fw-bold">Total: <span id="checkoutTotal" class="text-success">Rs. 0</span></h5>
                </div>
            </div>

        </div>
    </div>
</section>
@endsection

@push('scripts')
<script src="{{ asset('js/store.js') }}"></script>
<script>
document.addEventListener("DOMContentLoaded", () => {
    // Display cart items in checkout summary
    displayCheckout();

    const form = document.getElementById("checkout-form");
    if (form) {
        form.addEventListener("submit", e => {
            e.preventDefault();
            if (getCart().length === 0) {
                alert("Your cart is empty.");
                return;
            }
            alert("Order placed successfully!");
            localStorage.removeItem("cart"); // clear cart
            displayCheckout(); // refresh summary
            form.reset();
        });
    }
});
</script>
@endpush
