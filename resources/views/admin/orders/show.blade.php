@extends('admin.layouts.app')

@section('title', 'Order Details - ' . $order->id)
@section('page-title', 'Order Details')

@section('content')
<div class="container-fluid">
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h4 class="mb-0 me-3 text-dark fw-bold">Order: {{ $order->id }}</h4>
            <span class="badge bg-secondary ms-2">{{ $order->items_count }} items</span>
        </div>
        <div class="d-flex gap-2">
            <button class="btn btn-outline-primary">
                <i class="fas fa-print me-2"></i>Print Invoice
            </button>
            <button class="btn btn-outline-secondary">
                <i class="fas fa-envelope me-2"></i>Send Email
            </button>
        </div>
    </div>

    <div class="row">
        <!-- Order Information -->
        <div class="col-lg-8">
            <!-- Order Status Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Order Status</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="status-item">
                                <label class="form-label">Order Status</label>
                                <div class="d-flex align-items-center">
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning fs-6">Pending</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info fs-6">Processing</span>
                                    @elseif($order->status == 'shipped')
                                        <span class="badge bg-primary fs-6">Shipped</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-success fs-6">Delivered</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger fs-6">Cancelled</span>
                                    @endif
                                    <button class="btn btn-sm btn-outline-primary ms-3">Update Status</button>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="status-item">
                                <label class="form-label">Payment Status</label>
                                <div class="d-flex align-items-center">
                                    @if($order->payment_status == 'paid')
                                        <span class="badge bg-success fs-6">Paid</span>
                                    @elseif($order->payment_status == 'pending')
                                        <span class="badge bg-warning fs-6">Pending</span>
                                    @elseif($order->payment_status == 'refunded')
                                        <span class="badge bg-secondary fs-6">Refunded</span>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Products Card -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Order Items</h6>
                </div>
                <div class="card-body p-0">
                    <div class="table-responsive">
                        <table class="table table-hover mb-0">
                            <thead class="table-light">
                                <tr>
                                    <th>Product</th>
                                    <th>Category</th>
                                    <th>Price</th>
                                    <th>Quantity</th>
                                    <th>Subtotal</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($order->products as $product)
                                <tr>
                                    <td>
                                        <div class="product-info">
                                            <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-image">
                                            <div class="product-details">
                                                <div class="product-name">{{ $product->name }}</div>
                                                <div class="product-id">ID: {{ $product->id }}</div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-light text-dark">{{ $product->category }}</span>
                                    </td>
                                    <td>${{ number_format($product->price, 2) }}</td>
                                    <td>{{ $product->quantity }}</td>
                                    <td class="fw-bold">${{ number_format($product->subtotal, 2) }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>

        <!-- Sidebar Information -->
        <div class="col-lg-4">
            <!-- Customer Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Customer Information</h6>
                </div>
                <div class="card-body">
                    <div class="customer-detail">
                        <label class="form-label">Name</label>
                        <p class="mb-3">{{ $order->customer_name }}</p>
                    </div>
                    <div class="customer-detail">
                        <label class="form-label">Email</label>
                        <p class="mb-3">{{ $order->customer_email }}</p>
                    </div>
                    <div class="customer-detail">
                        <label class="form-label">Phone</label>
                        <p class="mb-3">{{ $order->customer_phone }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Summary -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Order Summary</h6>
                </div>
                <div class="card-body">
                    <div class="summary-item d-flex justify-content-between mb-2">
                        <span>Subtotal:</span>
                        <span>${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                    <div class="summary-item d-flex justify-content-between mb-2">
                        <span>Shipping:</span>
                        <span>{{ $order->shipping_method }}</span>
                    </div>
                    <div class="summary-item d-flex justify-content-between mb-2">
                        <span>Payment Method:</span>
                        <span>{{ $order->payment_method }}</span>
                    </div>
                    <hr>
                    <div class="summary-item d-flex justify-content-between fw-bold">
                        <span>Total:</span>
                        <span class="text-primary fs-5">${{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Shipping Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h6 class="card-title mb-0">Shipping Information</h6>
                </div>
                <div class="card-body">
                    <div class="shipping-detail">
                        <label class="form-label">Shipping Address</label>
                        <p class="mb-3">{{ $order->shipping_address }}</p>
                    </div>
                    <div class="shipping-detail">
                        <label class="form-label">Billing Address</label>
                        <p class="mb-3">{{ $order->billing_address }}</p>
                    </div>
                </div>
            </div>

            <!-- Order Timeline -->
            <div class="card">
                <div class="card-header">
                    <h6 class="card-title mb-0">Order Timeline</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <div class="timeline-title">Order Placed</div>
                                <div class="timeline-date">{{ $order->order_date->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @if($order->status != 'pending')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <div class="timeline-title">Order Confirmed</div>
                                <div class="timeline-date">{{ $order->order_date->addHours(2)->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        @if($order->status == 'shipped' || $order->status == 'delivered')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-primary"></div>
                            <div class="timeline-content">
                                <div class="timeline-title">Order Shipped</div>
                                <div class="timeline-date">{{ $order->order_date->addDays(1)->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                        @if($order->status == 'delivered')
                        <div class="timeline-item">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <div class="timeline-title">Order Delivered</div>
                                <div class="timeline-date">{{ $order->order_date->addDays(3)->format('d M Y, H:i') }}</div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
