@extends('admin.layouts.app')

@section('title', 'Customer Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Customer: {{ $customer->name }}</h1>
            <p class="text-muted">Profile overview and order history</p>
        </div>
        <div>
            <a href="{{ route('admin.customers.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Customers
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="{{ $customer->avatar }}" alt="{{ $customer->name }}"
                         class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="mb-0">{{ $customer->name }}</h5>
                    <p class="text-muted">Regular Customer</p>
                    <span class="badge bg-{{ $customer->status === 'active' ? 'success' : 'secondary' }} mb-2">
                        {{ ucfirst($customer->status) }}
                    </span>
                    
                    <!-- Quick Stats -->
                    <div class="row text-center mt-3">
                        <div class="col-4">
                            <div class="border-end">
                                <h6 class="mb-0 text-primary">{{ $customer->total_orders }}</h6>
                                <small class="text-muted">Orders</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <h6 class="mb-0 text-success">${{ number_format($customer->total_spent, 2) }}</h6>
                                <small class="text-muted">Spent</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <h6 class="mb-0 text-info">{{ $customer->delivery_addresses }}</h6>
                            <small class="text-muted">Addresses</small>
                        </div>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email: <span class="text-muted">{{ $customer->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Phone: <span class="text-muted">{{ $customer->phone }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Location: <span class="text-muted">{{ $customer->location }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Joined: <span class="text-muted">{{ $customer->joined_date->format('M d, Y') }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Payment: <span class="text-muted">{{ $customer->preferred_payment }}</span>
                        </li>
                    </ul>
                    
                    <div class="mt-3">
                        @if($customer->is_verified)
                            <span class="badge bg-success me-1"><i class="fas fa-check-circle me-1"></i>Verified</span>
                        @endif
                        @if($customer->status === 'active')
                            <span class="badge bg-primary"><i class="fas fa-circle me-1"></i>Active</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Customer Preferences -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Preferences</h6>
                </div>
                <div class="card-body">
                    @if(isset($customer->preferences) && count($customer->preferences) > 0)
                        @foreach($customer->preferences as $preference)
                            <span class="badge bg-info me-1 mb-1">{{ $preference }}</span>
                        @endforeach
                    @else
                        <p class="text-muted">No preferences set</p>
                    @endif
                </div>
            </div>

            <!-- Customer Notes -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Notes</h6>
                </div>
                <div class="card-body">
                    @if(isset($customer->notes) && $customer->notes)
                        <p class="text-muted">{{ $customer->notes }}</p>
                    @else
                        <p class="text-muted">No notes available</p>
                    @endif
                    
                    <button class="btn btn-sm btn-outline-primary mt-2" data-bs-toggle="modal" data-bs-target="#addNoteModal">
                        <i class="fas fa-plus me-1"></i>Add Note
                    </button>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Order History -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
                    <a href="{{ route('admin.customers.orders', $customer->id) }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($orderHistory->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Service</th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Order Date</th>
                                        <th>Delivery Date</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($orderHistory as $order)
                                    <tr>
                                        <td><strong>{{ $order->order_id }}</strong></td>
                                        <td>{{ $order->service }}</td>
                                        <td class="text-success">${{ number_format($order->amount, 2) }}</td>
                                        <td><span class="badge bg-success">{{ ucfirst($order->status) }}</span></td>
                                        <td>{{ $order->order_date->format('M d, Y') }}</td>
                                        <td>{{ $order->delivery_date->format('M d, Y') }}</td>
                                        <td>
                                            @if($order->rating)
                                                {{ $order->rating }} <i class="fas fa-star text-warning"></i>
                                            @else
                                                <span class="text-muted">No rating</span>
                                            @endif
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">No order history available.</p>
                    @endif
                </div>
            </div>

            <!-- Delivery Addresses -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Delivery Addresses</h6>
                </div>
                <div class="card-body">
                    @if($deliveryAddresses->count() > 0)
                        @foreach($deliveryAddresses as $address)
                        <div class="delivery-address-card mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0">{{ $address->type }}</h6>
                                @if($address->is_default)
                                    <span class="badge bg-primary">Default</span>
                                @endif
                            </div>
                            
                            <div class="mb-2">
                                <strong>Address:</strong><br>
                                <span class="text-muted">{{ $address->address }}</span>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Contact:</strong> {{ $address->contact_person }}
                                </div>
                                <div class="col-md-6">
                                    <strong>Phone:</strong> {{ $address->contact_phone }}
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center">No delivery addresses available.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Activity -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Activity</h6>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-success"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Order Completed</h6>
                                <p class="text-muted mb-0">Order ORD-001 was completed successfully</p>
                                <small class="text-muted">{{ now()->subDays(2)->diffForHumans() }}</small>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-info"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">New Order Placed</h6>
                                <p class="text-muted mb-0">Order ORD-004 was placed for Express Cleaning</p>
                                <small class="text-muted">{{ now()->subHours(6)->diffForHumans() }}</small>
                            </div>
                        </div>
                        
                        <div class="timeline-item mb-3">
                            <div class="timeline-marker bg-warning"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Payment Method Updated</h6>
                                <p class="text-muted mb-0">Changed preferred payment to Credit Card</p>
                                <small class="text-muted">{{ now()->subDays(5)->diffForHumans() }}</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add Note Modal -->
<div class="modal fade" id="addNoteModal" tabindex="-1" aria-labelledby="addNoteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="addNoteModalLabel">Add Customer Note</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('admin.customers.add-note', $customer->id) }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="note" class="form-label">Note</label>
                        <textarea class="form-control" id="note" name="note" rows="3" placeholder="Enter customer note..."></textarea>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Add Note</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.delivery-address-card {
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.delivery-address-card:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.timeline {
    position: relative;
    padding-left: 30px;
}

.timeline-item {
    position: relative;
}

.timeline-marker {
    position: absolute;
    left: -35px;
    width: 12px;
    height: 12px;
    border-radius: 50%;
    border: 2px solid #fff;
    box-shadow: 0 0 0 3px #dee2e6;
}

.timeline-item:not(:last-child)::after {
    content: '';
    position: absolute;
    left: -29px;
    top: 20px;
    width: 2px;
    height: calc(100% + 10px);
    background: #dee2e6;
}

.badge {
    font-size: 0.75rem;
}

.list-group-item {
    border-left: none;
    border-right: none;
}
</style>
@endpush
