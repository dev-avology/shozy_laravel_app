@extends('admin.layouts.app')

@section('title', 'Delivery User Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Delivery User: {{ $deliveryUser->name }}</h1>
            <p class="text-muted">Profile overview and delivery performance</p>
        </div>
        <div>
            <a href="{{ route('admin.deliveries.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Delivery Panel
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="{{ $deliveryUser->avatar }}" alt="{{ $deliveryUser->name }}"
                         class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="mb-0">{{ $deliveryUser->name }}</h5>
                    <p class="text-muted">Professional Delivery Driver</p>
                    <span class="badge bg-{{ $deliveryUser->status === 'online' ? 'success' : ($deliveryUser->status === 'busy' ? 'warning' : 'secondary') }} mb-2">
                        {{ ucfirst($deliveryUser->status) }}
                    </span>
                    
                    <!-- Quick Stats -->
                    <div class="row text-center mt-3">
                        <div class="col-4">
                            <div class="border-end">
                                <h6 class="mb-0 text-primary">{{ $deliveryUser->total_deliveries }}</h6>
                                <small class="text-muted">Total</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="border-end">
                                <h6 class="mb-0 text-success">{{ $deliveryUser->rating }}</h6>
                                <small class="text-muted">Rating</small>
                            </div>
                        </div>
                        <div class="col-4">
                            <h6 class="mb-0 text-info">{{ $deliveryUser->current_deliveries }}</h6>
                            <small class="text-muted">Active</small>
                        </div>
                    </div>

                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email: <span class="text-muted">{{ $deliveryUser->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Phone: <span class="text-muted">{{ $deliveryUser->phone }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Vehicle: <span class="text-muted">{{ $deliveryUser->vehicle_type }} - {{ $deliveryUser->vehicle_number }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Location: <span class="text-muted">{{ $deliveryUser->location }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Joined: <span class="text-muted">{{ $deliveryUser->joined_date->format('M d, Y') }}</span>
                        </li>
                    </ul>
                    
                    <div class="mt-3">
                        @if($deliveryUser->is_verified)
                            <span class="badge bg-success me-1"><i class="fas fa-check-circle me-1"></i>Verified</span>
                        @endif
                        @if($deliveryUser->is_active)
                            <span class="badge bg-primary"><i class="fas fa-circle me-1"></i>Active</span>
                        @endif
                    </div>
                </div>
            </div>

            <!-- Earnings Summary -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Earnings Summary</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-6 mb-3">
                            <h5 class="mb-0 text-success">${{ number_format($deliveryUser->this_week_earnings, 2) }}</h5>
                            <small class="text-muted">This Week</small>
                        </div>
                        <div class="col-6 mb-3">
                            <h5 class="mb-0 text-primary">${{ number_format($deliveryUser->total_earnings, 2) }}</h5>
                            <small class="text-muted">Total</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Current Deliveries -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Current Deliveries</h6>
                    <a href="{{ route('admin.deliveries.orders', $deliveryUser->id) }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($currentDeliveries->count() > 0)
                        @foreach($currentDeliveries as $delivery)
                        <div class="delivery-card mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0">{{ $delivery->customer_name }}'s Delivery</h6>
                                <span class="badge bg-{{ $delivery->status === 'in_progress' ? 'warning' : 'info' }}">
                                    {{ ucfirst(str_replace('_', ' ', $delivery->status)) }}
                                </span>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <i class="fas fa-map-marker-alt text-success me-2"></i>
                                        <strong>Pickup:</strong> {{ $delivery->pickup_address }}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                        <strong>Dropoff:</strong> {{ $delivery->dropoff_address }}
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-2">
                                        <i class="fas fa-clock me-2"></i>
                                        <strong>Time:</strong> {{ $delivery->scheduled_time }}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-stopwatch me-2"></i>
                                        <strong>Duration:</strong> {{ $delivery->estimated_duration }}
                                    </div>
                                    <div class="mb-2">
                                        <i class="fas fa-compass me-2"></i>
                                        <strong>Distance:</strong> {{ $delivery->distance }}
                                    </div>
                                </div>
                            </div>
                            
                            <div class="d-flex justify-content-between align-items-center">
                                <div>
                                    <strong>Earnings:</strong> ${{ number_format($delivery->earnings, 2) }}
                                </div>
                                <div>
                                    @if($delivery->status === 'assigned')
                                        <button class="btn btn-sm btn-success me-2">
                                            <i class="fas fa-check me-1"></i>Accept
                                        </button>
                                        <button class="btn btn-sm btn-danger">
                                            <i class="fas fa-times me-1"></i>Reject
                                        </button>
                                    @endif
                                </div>
                            </div>
                            
                            @if($delivery->notes)
                                <div class="mt-2 p-2 bg-light rounded">
                                    <small class="text-muted"><strong>Notes:</strong> {{ $delivery->notes }}</small>
                                </div>
                            @endif
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center">No current deliveries.</p>
                    @endif
                </div>
            </div>

            <!-- Recent Deliveries -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Deliveries</h6>
                    <a href="{{ route('admin.deliveries.orders', $deliveryUser->id) }}" class="btn btn-sm btn-outline-primary">View All</a>
                </div>
                <div class="card-body">
                    @if($recentDeliveries->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Route</th>
                                        <th>Completed</th>
                                        <th>Duration</th>
                                        <th>Earnings</th>
                                        <th>Rating</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentDeliveries as $delivery)
                                    <tr>
                                        <td>{{ $delivery->order_id }}</td>
                                        <td>{{ $delivery->customer_name }}</td>
                                        <td>
                                            <div>
                                                <small class="text-success">{{ $delivery->pickup_address }}</small><br>
                                                <small class="text-danger">{{ $delivery->dropoff_address }}</small>
                                            </div>
                                        </td>
                                        <td>{{ $delivery->completed_time }}</td>
                                        <td>{{ $delivery->actual_duration }}</td>
                                        <td>${{ number_format($delivery->earnings, 2) }}</td>
                                        <td>{{ $delivery->rating }} <i class="fas fa-star text-warning"></i></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <p class="text-muted text-center">No recent deliveries available.</p>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.delivery-card {
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.delivery-card:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
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
