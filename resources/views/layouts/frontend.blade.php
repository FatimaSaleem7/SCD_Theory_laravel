<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'CarePlus')</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <!-- Custom CSS -->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>

    @include('partials.header')

    <!-- Main Content -->
    <main class="pt-5 mt-4">
        @yield('content')
    </main>

    @include('partials.footer')

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- Page-specific JS -->
    @stack('scripts')

    <!-- Global Store Script for Cart Count -->
    <script src="{{ asset('js/store.js') }}"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            updateCartCount(); // keeps cart count visible on all pages
        });
    </script>
</body>
</html>

