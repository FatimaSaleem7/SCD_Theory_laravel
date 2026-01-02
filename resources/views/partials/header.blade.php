<!-- Header -->
<header class="header py-3 shadow-sm bg-white fixed-top">
    <div class="container d-flex justify-content-between align-items-center">
        <a href="{{ url('/') }}" class="logo fs-3 fw-bold text-dark">
            <i class="fas fa-heartbeat text-success me-2"></i>CarePlus
        </a>
        <nav class="navbar">
            <a href="{{ url('/') }}" class="mx-2 text-secondary text-decoration-none">Home</a>
            <a href="{{ url('/#about') }}" class="mx-2 text-secondary text-decoration-none">About Us</a>
            <a href="{{ url('/departments') }}" class="mx-2 text-secondary text-decoration-none">Departments</a>
            <a href="{{ url('/medicines') }}" class="mx-2 text-secondary text-decoration-none">Medicines</a>
            <a href="{{ url('/order_history') }}" class="mx-2 text-secondary text-decoration-none">My Orders</a>

            <a href="{{ url('/contact') }}" class="mx-2 text-secondary text-decoration-none">Contact</a>
            <a href="{{ url('/cart') }}" class="mx-2 text-secondary text-decoration-none position-relative">
        <i class="fa-solid fa-cart-shopping me-1"></i>
                Cart
        <span id="cart-count" class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-success">
        0 </span> </a>

            <a href="{{ url('/checkout') }}" class="mx-2 text-secondary text-decoration-none">
                <i class="fa-solid fa-credit-card me-1"></i>Checkout
            </a>
            <a href="{{ url('/user-login') }}" class="mx-2 text-secondary text-decoration-none">
                <i class="fa-solid fa-right-to-bracket me-1"></i>Login
            </a>
            <a href="{{ url('/user-register') }}" class="mx-2 text-secondary text-decoration-none">
                <i class="fa-solid fa-user-plus me-1"></i>Register
            </a>
        </nav>
    </div>
</header>
