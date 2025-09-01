@extends('admin.layouts.app')

@section('title', 'Orders Management')
@section('page-title', 'Orders Management')

@section('content')
<div class="container-fluid">
    
    <!-- Debug Information -->
    @if(isset($orders))
        <div class="alert alert-info">
            <strong>Debug:</strong> Orders variable is set. Count: {{ $orders->count() }}
        </div>
    @else
        <div class="alert alert-warning">
            <strong>Debug:</strong> Orders variable is NOT set!
        </div>
    @endif
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h4 class="mb-0 me-3 text-dark fw-bold">Orders</h4>
        </div>
        <div class="d-flex gap-2">
            <div class="dropdown">
                <button class="btn btn-outline-primary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                    <i class="fas fa-filter me-2"></i>Filter Status
                </button>
                <ul class="dropdown-menu">
                    <li><a class="dropdown-item" href="#">All Orders</a></li>
                    <li><a class="dropdown-item" href="#">Pending</a></li>
                    <li><a class="dropdown-item" href="#">Processing</a></li>
                    <li><a class="dropdown-item" href="#">Shipped</a></li>
                    <li><a class="dropdown-item" href="#">Delivered</a></li>
                    <li><a class="dropdown-item" href="#">Cancelled</a></li>
                </ul>
            </div>
        </div>
    </div>
    
    <!-- Search Bar -->
    <div class="mb-3 order-search">
        <label class="form-label">Search Orders</label>
        <input type="text" class="form-control" placeholder="Search by order ID, customer name, or email...">
    </div>

    <!-- Orders Table -->
    <div class="card order-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>ORDER ID</th>
                            <th>CUSTOMER</th>
                            <th>PRODUCTS</th>
                            <th>TOTAL</th>
                            <th>STATUS</th>
                            <th>PAYMENT</th>
                            <th>DATE</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($orders as $order)
                        <tr>
                            <td>
                                <div class="order-id-section">
                                    <span class="order-id">{{ $order->id }}</span>
                                    <small class="text-muted d-block">{{ $order->items_count }} items</small>
                                </div>
                            </td>
                            <td>
                                <div class="customer-info">
                                    <div class="customer-name">{{ $order->customer_name }}</div>
                                    <div class="customer-email">{{ $order->customer_email }}</div>
                                    <div class="customer-phone">{{ $order->customer_phone }}</div>
                                </div>
                            </td>
                            <td>
                                <div class="products-preview">
                                    @foreach($order->products->take(2) as $product)
                                    <div class="product-item">
                                        <img src="{{ $product->image }}" alt="{{ $product->name }}" class="product-thumbnail">
                                        <div class="product-details">
                                            <div class="product-name">{{ $product->name }}</div>
                                            <div class="product-category">{{ $product->category }}</div>
                                            <div class="product-quantity">Qty: {{ $product->quantity }}</div>
                                        </div>
                                    </div>
                                    @endforeach
                                    @if($order->products->count() > 2)
                                    <div class="more-products">
                                        <span class="badge bg-secondary">+{{ $order->products->count() - 2 }} more</span>
                                    </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="order-total">
                                    <span class="total-amount">${{ number_format($order->total_amount, 2) }}</span>
                                    <small class="text-muted d-block">{{ $order->shipping_method }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="order-status">
                                    @if($order->status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->status == 'processing')
                                        <span class="badge bg-info">Processing</span>
                                    @elseif($order->status == 'shipped')
                                        <span class="badge bg-primary">Shipped</span>
                                    @elseif($order->status == 'delivered')
                                        <span class="badge bg-success">Delivered</span>
                                    @elseif($order->status == 'cancelled')
                                        <span class="badge bg-danger">Cancelled</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="payment-status">
                                    @if($order->payment_status == 'paid')
                                        <span class="badge bg-success">Paid</span>
                                    @elseif($order->payment_status == 'pending')
                                        <span class="badge bg-warning">Pending</span>
                                    @elseif($order->payment_status == 'refunded')
                                        <span class="badge bg-secondary">Refunded</span>
                                    @endif
                                    <small class="text-muted d-block">{{ $order->payment_method }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="order-date">
                                    <div class="date">{{ $order->order_date->format('d M Y') }}</div>
                                    <small class="text-muted">{{ $order->order_date->format('H:i') }}</small>
                                </div>
                            </td>
                            <td>
                                <div class="order-actions">
                                    <a href="{{ route('admin.orders.show', $order->id) }}" class="btn btn-sm btn-outline-primary">
                                        <i class="fas fa-eye me-1"></i>View
                                    </a>
                                    <div class="dropdown d-inline-block ms-2">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-edit me-2"></i>Edit</a></li>
                                            <li><a class="dropdown-item" href="#"><i class="fas fa-print me-2"></i>Print Invoice</a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-danger" href="#"><i class="fas fa-trash me-2"></i>Cancel Order</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="order-empty-state">
                                    <i class="fas fa-shopping-cart"></i>
                                    <h5>No orders found</h5>
                                    <p>Orders will appear here when customers make purchases.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection
