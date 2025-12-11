
@extends('layouts.frontend')

@section('title', 'Medicines')

@section('content')
<!-- Medicines Section -->
<section class="py-5 mt-5">
    <div class="container text-center">

        @include('partials.search')

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
<script>
document.addEventListener('DOMContentLoaded', function () {
    const input = document.getElementById('globalSearch');
    const button = document.getElementById('globalSearchBtn');
    const dropdown = document.getElementById('globalSearchDropdown');
    const results = document.getElementById('globalSearchResults');

    function escapeHtml(text) {
        return text.replace(/[&<>"']/g, function(m) { return ({
            '&': '&amp;',
            '<': '&lt;',
            '>': '&gt;',
            '"': '&quot;',
            "'": '&#039;'
        })[m]; });
    }

    async function searchMedicines(query) {
        if (!query.trim()) {
            results.innerHTML = '';
            dropdown.style.display = 'none';
            return;
        }

        try {
            const res = await fetch(`/ajax/medicines/search?query=${encodeURIComponent(query)}`);
            const data = await res.json();
            if (!data.length) {
                results.innerHTML = '<li class="list-group-item text-muted">No results found</li>';
            } else {
                results.innerHTML = data.map(item => `
                    <li class="list-group-item list-group-item-action p-2">
                        <a href="/medicinedetail/${item.id}" class="d-flex align-items-center text-decoration-none text-dark">
                            <!-- Image or Placeholder -->
                            <div class="flex-shrink-0 me-3">
                                ${item.image 
                                    ? `<img src="/storage/${item.image}" class="rounded border" style="width: 50px; height: 50px; object-fit: cover;">` 
                                    : `<div class="bg-light rounded border d-flex align-items-center justify-content-center" style="width: 50px; height: 50px;"><i class="fas fa-pills text-secondary"></i></div>`
                                }
                            </div>
                            
                            <!-- Content -->
                            <div class="flex-grow-1">
                                <h6 class="mb-0 fw-bold text-dark">${escapeHtml(item.name)}</h6>
                                <small class="text-muted d-block text-capitalize">
                                    <i class="fas fa-tag fa-xs me-1"></i>${escapeHtml(item.category || 'Uncategorized')}
                                </small>
                            </div>

                            <!-- Price -->
                            <div class="text-end ms-3">
                                <span class="badge bg-success bg-opacity-10 text-success px-2 py-1 fs-6">
                                    Rs. ${item.price}
                                </span>
                            </div>
                        </a>
                    </li>
                `).join('');
            }
            dropdown.style.display = 'block';
        } catch (err) {
            console.error(err);
        }
    }

    // Debounce for typing
    let timeout;
    input.addEventListener('keyup', function () {
        clearTimeout(timeout);
        timeout = setTimeout(() => searchMedicines(input.value), 300);
    });

    // Search button click
    button.addEventListener('click', function(e) {
        e.preventDefault();
        searchMedicines(input.value);
    });

    // Hide dropdown when clicking outside
    document.addEventListener('click', function(e) {
        if (!dropdown.contains(e.target) && e.target !== input && e.target !== button) {
            dropdown.style.display = 'none';
        }
    });
});
</script>
@endpush
