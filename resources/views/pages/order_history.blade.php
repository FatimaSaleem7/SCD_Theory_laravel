@extends('layouts.frontend')

@section('title', 'My Order History')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h2 class="text-success fw-bold">Order History</h2>
        <p class="text-muted">Track your recent purchases</p>
    </div>

    <div class="row mb-5 justify-content-center">
        <div class="col-md-6">
            <form action="{{ route('order.history') }}" method="GET" class="d-flex shadow-sm rounded p-2 bg-white border">
                <input type="email" name="email" class="form-control border-0" 
                       placeholder="Enter email used at checkout" value="{{ $searchEmail ?? '' }}" required>
                <button type="submit" class="btn btn-success ms-2 px-4">Find Orders</button>
            </form>
            @if(isset($searchEmail))
                <div class="text-center mt-2">
                    <small class="text-muted">Showing orders for: <strong>{{ $searchEmail }}</strong></small>
                </div>
            @endif
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="fw-bold">Results</h4>
        <span class="badge bg-success px-3 py-2">
            Total Orders Found: {{ $orders->count() }}
        </span>
    </div>

    @if($orders->isEmpty())
        <div class="text-center py-5 shadow-sm bg-light rounded border">
            <i class="fa-solid fa-receipt fa-3x text-muted mb-3"></i>
            <p class="text-muted fs-5">No orders found. Try searching with the email you used during checkout.</p>
            <a href="{{ route('medicines') }}" class="btn btn-outline-success mt-2">Go to Medicines</a>
        </div>
    @else
        <div class="accordion border-0" id="ordersAccordion">
            @foreach($orders as $order)
            <div class="accordion-item border mb-3 shadow-sm rounded overflow-hidden">
                <h2 class="accordion-header">
                    <button class="accordion-button collapsed bg-white" type="button" 
                            data-bs-toggle="collapse" data-bs-target="#collapse{{ $order->id }}">
                        
                        <div class="d-flex flex-wrap justify-content-between w-100 align-items-center">
                            <div class="me-4">
                                <span class="text-muted small d-block">ORDER ID</span>
                                <span class="fw-bold text-dark">#{{ $order->id }}</span>
                            </div>
                            <div class="me-4 d-none d-md-block">
                                <span class="text-muted small d-block">PLACED ON</span>
                                <span class="fw-bold text-dark">{{ $order->created_at->format('d M, Y') }}</span>
                            </div>
                            <div class="me-4">
                                <span class="text-muted small d-block">TOTAL AMOUNT</span>
                                <span class="fw-bold text-success">Rs. {{ number_format($order->total_amount) }}</span>
                            </div>
                            <div class="me-3">
                                @if($order->status == 'pending')
                                    <span class="badge bg-warning text-dark px-3">Pending</span>
                                @else
                                    <span class="badge bg-success px-3">Completed</span>
                                @endif
                            </div>
                        </div>
                    </button>
                </h2>
                
                <div id="collapse{{ $order->id }}" class="accordion-collapse collapse" data-bs-parent="#ordersAccordion">
                    <div class="accordion-body bg-light-subtle p-4">
                        <h6 class="fw-bold mb-3 border-bottom pb-2">Items Purchased</h6>
                        <div class="table-responsive">
                            <table class="table table-borderless bg-white rounded shadow-sm border">
                                <thead class="table-light">
                                    <tr>
                                        <th>Medicine</th>
                                        <th class="text-center">Price</th>
                                        <th class="text-center">Qty</th>
                                        <th class="text-end">Subtotal</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($order->items as $item)
                                    <tr class="align-middle">
                                        <td>
                                            <div class="d-flex align-items-center">
                                                <img src="{{ $item->medicine->image ? asset('storage/'.$item->medicine->image) : asset('image/placeholder.png') }}" 
                                                     class="rounded me-2 shadow-sm" style="width: 40px; height: 40px; object-fit: cover;">
                                                <span class="fw-semibold">{{ $item->medicine->name }}</span>
                                            </div>
                                        </td>
                                        <td class="text-center">Rs. {{ number_format($item->price) }}</td>
                                        <td class="text-center">x{{ $item->quantity }}</td>
                                        <td class="text-end fw-bold">Rs. {{ number_format($item->price * $item->quantity) }}</td>
                                    </tr>
                                    @endforeach
                                </tbody>
                                <tfoot class="border-top">
                                    <tr>
                                        <td colspan="3" class="text-end fw-bold pt-3">Grand Total:</td>
                                        <td class="text-end fw-bold text-success fs-5 pt-3">Rs. {{ number_format($order->total_amount) }}</td>
                                    </tr>
                                </tfoot>
                            </table>
                        </div>
                        
                        <div class="row mt-3">
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm border h-100">
                                    <p class="mb-1 text-success fw-bold small">SHIPPING ADDRESS</p>
                                    <p class="text-muted mb-0 small">{{ $order->customer_address }}</p>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="p-3 bg-white rounded shadow-sm border h-100">
                                    <p class="mb-1 text-success fw-bold small">CONTACT INFO</p>
                                    <p class="text-muted mb-0 small">Phone: {{ $order->customer_phone }}</p>
                                    <p class="text-muted mb-0 small">Email: {{ $order->customer_email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    @endif
</div>
@endsection