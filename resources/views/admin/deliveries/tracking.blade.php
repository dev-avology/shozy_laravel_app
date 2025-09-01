@extends('admin.layouts.app')

@section('title', 'Live Delivery Tracking')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Live Delivery Tracking</h1>
            <p class="text-muted">Real-time location tracking and delivery status updates</p>
        </div>
        <div>
            <a href="{{ route('admin.deliveries.show', $deliveryUser->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Profile
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Map Container -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-map-marker-alt me-2"></i>Live Location Map
                    </h6>
                </div>
                <div class="card-body">
                    <div class="map-container" style="height: 500px; background: #f8f9fa; border-radius: 8px; position: relative;">
                        <!-- Placeholder for map integration -->
                        <div class="d-flex align-items-center justify-content-center h-100">
                            <div class="text-center">
                                <i class="fas fa-map fa-3x text-muted mb-3"></i>
                                <h5 class="text-muted">Map Integration</h5>
                                <p class="text-muted">Connect with Google Maps or Mapbox API for live tracking</p>
                                <div class="bg-light p-3 rounded">
                                    <strong>Current Location:</strong> {{ $deliveryUser->current_location }}<br>
                                    <strong>Last Updated:</strong> {{ $deliveryUser->last_updated->diffForHumans() }}
                                </div>
                            </div>
                        </div>
                        
                        <!-- Status indicator -->
                        <div class="position-absolute top-0 end-0 m-3">
                            <span class="badge bg-{{ $deliveryUser->status === 'online' ? 'success' : 'secondary' }} fs-6">
                                <i class="fas fa-circle me-1"></i>{{ ucfirst($deliveryUser->status) }}
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Delivery User Status -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Delivery User Status</h6>
                </div>
                <div class="card-body">
                    <div class="d-flex align-items-center mb-3">
                        <img src="https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=60&h=60&fit=crop&crop=center" 
                             alt="Avatar" class="rounded-circle me-3" style="width: 60px; height: 60px; object-fit: cover;">
                        <div>
                            <h6 class="mb-0">{{ $deliveryUser->name }}</h6>
                            <small class="text-muted">ID: {{ $deliveryUser->id }}</small>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Status:</strong>
                        <span class="badge bg-{{ $deliveryUser->status === 'online' ? 'success' : 'secondary' }} ms-2">
                            {{ ucfirst($deliveryUser->status) }}
                        </span>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Last Updated:</strong><br>
                        <small class="text-muted">{{ $deliveryUser->last_updated->format('M d, Y g:i A') }}</small>
                    </div>
                    
                    <div class="mb-3">
                        <strong>Current Location:</strong><br>
                        <small class="text-muted">{{ $deliveryUser->current_location }}</small>
                    </div>
                </div>
            </div>

            <!-- Active Deliveries -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Active Deliveries</h6>
                </div>
                <div class="card-body">
                    @if($activeDeliveries->count() > 0)
                        @foreach($activeDeliveries as $delivery)
                        <div class="delivery-status-card mb-3 p-3 border rounded">
                            <div class="d-flex justify-content-between align-items-start mb-2">
                                <h6 class="mb-0">{{ $delivery->order_id }}</h6>
                                <span class="badge bg-{{ $delivery->current_status === 'in_progress' ? 'warning' : 'info' }}">
                                    {{ ucfirst(str_replace('_', ' ', $delivery->current_status)) }}
                                </span>
                            </div>
                            
                            <div class="mb-2">
                                <strong>Customer:</strong> {{ $delivery->customer_name }}
                            </div>
                            
                            <div class="mb-2">
                                <strong>Pickup:</strong><br>
                                <small class="text-success">{{ $delivery->pickup_address }}</small>
                            </div>
                            
                            <div class="mb-2">
                                <strong>Dropoff:</strong><br>
                                <small class="text-danger">{{ $delivery->dropoff_address }}</small>
                            </div>
                            
                            <div class="mb-3">
                                <strong>Progress:</strong>
                                <div class="progress mt-1" style="height: 8px;">
                                    <div class="progress-bar bg-success" role="progressbar" 
                                         style="width: {{ $delivery->progress }}%" 
                                         aria-valuenow="{{ $delivery->progress }}" 
                                         aria-valuemin="0" aria-valuemax="100">
                                    </div>
                                </div>
                                <small class="text-muted">{{ $delivery->progress }}% Complete</small>
                            </div>
                            
                            <div class="row text-center">
                                <div class="col-6">
                                    <div class="border-end">
                                        <strong class="text-primary">{{ $delivery->estimated_arrival }}</strong><br>
                                        <small class="text-muted">ETA</small>
                                    </div>
                                </div>
                                <div class="col-6">
                                    <strong class="text-success">${{ number_format($delivery->earnings, 2) }}</strong><br>
                                    <small class="text-muted">Earnings</small>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    @else
                        <p class="text-muted text-center">No active deliveries.</p>
                    @endif
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <button class="btn btn-outline-primary">
                            <i class="fas fa-refresh me-2"></i>Refresh Location
                        </button>
                        <button class="btn btn-outline-info">
                            <i class="fas fa-route me-2"></i>View Route
                        </button>
                        <button class="btn btn-outline-warning">
                            <i class="fas fa-phone me-2"></i>Contact Driver
                        </button>
                        <button class="btn btn-outline-success">
                            <i class="fas fa-check me-2"></i>Mark Complete
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.map-container {
    background: linear-gradient(135deg, #f8f9fa 0%, #e9ecef 100%);
}

.delivery-status-card {
    background: #f8f9fa;
    transition: all 0.3s ease;
}

.delivery-status-card:hover {
    background: #e9ecef;
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(0,0,0,0.1);
}

.progress {
    border-radius: 10px;
}

.progress-bar {
    border-radius: 10px;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush

@push('scripts')
<script>
// Auto-refresh location every 30 seconds
setInterval(function() {
    // In a real application, this would make an AJAX call to update location
    console.log('Refreshing location data...');
}, 30000);

// Simulate real-time updates
document.addEventListener('DOMContentLoaded', function() {
    // Add any real-time tracking functionality here
    console.log('Tracking page loaded');
});
</script>
@endpush
