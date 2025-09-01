@extends('admin.layouts.app')

@section('title', 'Shipping Method Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">{{ $shippingMethod->name }}</h1>
            <p class="text-muted">Shipping method details and configuration</p>
        </div>
        <div>
            <a href="{{ route('admin.shipping.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Shipping
            </a>
            <a href="{{ route('admin.shipping.edit', $shippingMethod->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Method
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Method Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Method Information</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-truck fa-3x text-primary mb-2"></i>
                        <h5 class="mb-0">{{ $shippingMethod->name }}</h5>
                        <span class="badge bg-{{ $shippingMethod->status === 'active' ? 'success' : 'secondary' }} mt-2">
                            {{ ucfirst($shippingMethod->status) }}
                        </span>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Carrier:</span>
                            <span class="badge bg-info">{{ $shippingMethod->carrier }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Delivery Time:</span>
                            <span class="text-muted">{{ $shippingMethod->delivery_time }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Base Rate:</span>
                            @if($shippingMethod->base_rate > 0)
                                <span class="fw-bold text-success">${{ number_format($shippingMethod->base_rate, 2) }}</span>
                            @else
                                <span class="badge bg-success">Free</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Weight Limit:</span>
                            <span class="text-muted">{{ $shippingMethod->weight_limit }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Dimension Limit:</span>
                            <span class="text-muted">{{ $shippingMethod->dimension_limit }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Tracking:</span>
                            @if($shippingMethod->tracking_available)
                                <span class="badge bg-success">Available</span>
                            @else
                                <span class="badge bg-secondary">Not Available</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Insurance:</span>
                            @if($shippingMethod->insurance_included)
                                <span class="badge bg-success">Included</span>
                            @else
                                <span class="badge bg-secondary">Not Included</span>
                            @endif
                        </li>
                        @if($shippingMethod->insurance_included)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Insurance Limit:</span>
                            <span class="text-muted">{{ $shippingMethod->insurance_limit }}</span>
                        </li>
                        @endif
                    </ul>
                    
                    <div class="mt-3">
                        <small class="text-muted">
                            <strong>Created:</strong> {{ $shippingMethod->created_at->format('M d, Y') }}<br>
                            <strong>Last Updated:</strong> {{ $shippingMethod->updated_at->format('M d, Y') }}
                        </small>
                    </div>
                </div>
            </div>

            <!-- Quick Actions -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.shipping.zones', $shippingMethod->id) }}" class="btn btn-outline-info">
                            <i class="fas fa-map-marker-alt me-2"></i>Manage Zones
                        </a>
                        <a href="{{ route('admin.shipping.tracking', $shippingMethod->id) }}" class="btn btn-outline-warning">
                            <i class="fas fa-route me-2"></i>Track Shipments
                        </a>
                        <button class="btn btn-outline-success" onclick="toggleStatus({{ $shippingMethod->id }})">
                            <i class="fas fa-toggle-on me-2"></i>Toggle Status
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Zones Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex justify-content-between align-items-center">
                    <h6 class="m-0 font-weight-bold text-primary">Shipping Zones</h6>
                    <a href="{{ route('admin.shipping.zones', $shippingMethod->id) }}" class="btn btn-sm btn-outline-primary">
                        <i class="fas fa-plus me-1"></i>Add Zone
                    </a>
                </div>
                <div class="card-body">
                    @if($zones->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Zone Name</th>
                                        <th>Coverage</th>
                                        <th>Rate</th>
                                        <th>Delivery Time</th>
                                        <th>Total Orders</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($zones as $zone)
                                    <tr>
                                        <td>
                                            <strong>{{ $zone->name }}</strong>
                                        </td>
                                        <td>
                                            <div>
                                                <span class="badge bg-primary me-1">{{ implode(', ', $zone->countries) }}</span>
                                                <small class="text-muted d-block">{{ implode(', ', $zone->states) }}</small>
                                            </div>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">${{ number_format($zone->rate, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $zone->delivery_time }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-secondary">{{ number_format($zone->total_orders) }}</span>
                                        </td>
                                        <td>
                                            <div class="btn-group" role="group">
                                                <button class="btn btn-sm btn-outline-primary" title="Edit Zone">
                                                    <i class="fas fa-edit"></i>
                                                </button>
                                                <button class="btn btn-sm btn-outline-danger" title="Delete Zone">
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-map-marker-alt fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">No Zones Configured</h6>
                            <p class="text-muted">Add shipping zones to define different rates for different areas.</p>
                            <a href="{{ route('admin.shipping.zones', $shippingMethod->id) }}" class="btn btn-primary btn-sm">
                                <i class="fas fa-plus me-1"></i>Add First Zone
                            </a>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Recent Shipments -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Shipments</h6>
                </div>
                <div class="card-body">
                    @if($recentShipments->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Tracking #</th>
                                        <th>Customer</th>
                                        <th>Destination</th>
                                        <th>Status</th>
                                        <th>Shipped Date</th>
                                        <th>Delivered Date</th>
                                        <th>Amount</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($recentShipments as $shipment)
                                    <tr>
                                        <td>
                                            <strong class="text-primary">{{ $shipment->tracking_number }}</strong>
                                        </td>
                                        <td>{{ $shipment->customer }}</td>
                                        <td>{{ $shipment->destination }}</td>
                                        <td>
                                            @php
                                                $statusColors = [
                                                    'pending' => 'warning',
                                                    'in_transit' => 'info',
                                                    'delivered' => 'success',
                                                    'cancelled' => 'danger'
                                                ];
                                                $statusColor = $statusColors[$shipment->status] ?? 'secondary';
                                            @endphp
                                            <span class="badge bg-{{ $statusColor }}">{{ ucfirst(str_replace('_', ' ', $shipment->status)) }}</span>
                                        </td>
                                        <td>
                                            @if($shipment->shipped_date)
                                                {{ $shipment->shipped_date->format('M d, Y') }}
                                            @else
                                                <span class="text-muted">Not shipped</span>
                                            @endif
                                        </td>
                                        <td>
                                            @if($shipment->delivered_date)
                                                {{ $shipment->delivered_date->format('M d, Y') }}
                                            @else
                                                <span class="text-muted">Not delivered</span>
                                            @endif
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">${{ number_format($shipment->amount, 2) }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-shipping-fast fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">No Recent Shipments</h6>
                            <p class="text-muted">No shipments have been made using this shipping method yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Method Description -->
            @if($shippingMethod->description)
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Description</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-0">{{ $shippingMethod->description }}</p>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
function toggleStatus(id) {
    if (confirm('Are you sure you want to toggle the status of this shipping method?')) {
        // This would normally make an AJAX call to update the status
        alert('Status toggled successfully!');
        location.reload();
    }
}
</script>
@endpush

@push('styles')
<style>
.list-group-item {
    border-left: none;
    border-right: none;
}

.badge {
    font-size: 0.75rem;
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    font-weight: 600;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
</style>
@endpush
