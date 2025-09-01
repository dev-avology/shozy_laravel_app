@extends('admin.layouts.app')

@section('title', 'Assigned Orders')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Assigned Orders - {{ $deliveryUser->name }}</h1>
            <p class="text-muted">View and manage all orders assigned to this delivery user</p>
        </div>
        <div>
            <a href="{{ route('admin.deliveries.show', $deliveryUser->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Profile
            </a>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Assigned Orders</h6>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search orders...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">
                                <input type="checkbox" class="form-check-input" id="selectAll">
                            </th>
                            <th>Order ID</th>
                            <th>Customer</th>
                            <th>Pickup & Dropoff</th>
                            <th>Scheduled Time</th>
                            <th>Duration</th>
                            <th>Distance</th>
                            <th>Status</th>
                            <th>Priority</th>
                            <th>Earnings</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($assignedOrders->count() > 0)
                            @foreach($assignedOrders as $order)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input order-checkbox" value="{{ $order->id }}">
                                </td>
                                <td>
                                    <strong>{{ $order->order_id }}</strong>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $order->customer_name }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <div class="delivery-route">
                                        <div class="mb-1">
                                            <i class="fas fa-map-marker-alt text-success me-2"></i>
                                            <small class="text-success">{{ $order->pickup_address }}</small>
                                        </div>
                                        <div>
                                            <i class="fas fa-map-marker-alt text-danger me-2"></i>
                                            <small class="text-danger">{{ $order->dropoff_address }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $order->scheduled_time }}</strong>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $order->estimated_duration }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $order->distance }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $order->status === 'assigned' ? 'info' : ($order->status === 'in_progress' ? 'warning' : 'success') }}">
                                        {{ ucfirst(str_replace('_', ' ', $order->status)) }}
                                    </span>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $order->priority === 'high' ? 'danger' : ($order->priority === 'medium' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($order->priority) }}
                                    </span>
                                </td>
                                <td>
                                    <strong class="text-success">${{ number_format($order->earnings, 2) }}</strong>
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        @if($order->status === 'assigned')
                                            <button class="btn btn-sm btn-success" title="Accept Order">
                                                <i class="fas fa-check"></i>
                                            </button>
                                            <button class="btn btn-sm btn-danger" title="Reject Order">
                                                <i class="fas fa-times"></i>
                                            </button>
                                        @elseif($order->status === 'in_progress')
                                            <button class="btn btn-sm btn-info" title="Update Status">
                                                <i class="fas fa-edit"></i>
                                            </button>
                                            <button class="btn btn-sm btn-success" title="Mark Complete">
                                                <i class="fas fa-check-double"></i>
                                            </button>
                                        @endif
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" 
                                                data-bs-toggle="dropdown">
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="#">
                                                <i class="fas fa-eye me-2"></i>View Details
                                            </a></li>
                                            <li><a class="dropdown-item" href="#">
                                                <i class="fas fa-route me-2"></i>View Route
                                            </a></li>
                                            <li><a class="dropdown-item" href="#">
                                                <i class="fas fa-phone me-2"></i>Contact Customer
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-warning" href="#">
                                                <i class="fas fa-edit me-2"></i>Edit Order
                                            </a></li>
                                            <li><a class="dropdown-item text-danger" href="#">
                                                <i class="fas fa-trash me-2"></i>Cancel Order
                                            </a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="11" class="text-center py-5">
                                    <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Orders Assigned</h5>
                                    <p class="text-muted">This delivery user has no orders assigned at the moment.</p>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Order Statistics -->
    <div class="row">
        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assignedOrders->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Assigned Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assignedOrders->where('status', 'assigned')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                In Progress</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $assignedOrders->where('status', 'in_progress')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-route fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Earnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($assignedOrders->sum('earnings'), 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.delivery-route {
    max-width: 200px;
}

.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.table th {
    font-size: 0.875rem;
    font-weight: 600;
}

.table td {
    font-size: 0.875rem;
    vertical-align: middle;
}

.btn-group .dropdown-toggle-split {
    border-left: 1px solid rgba(0,0,0,.125);
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const orderCheckboxes = document.querySelectorAll('.order-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        orderCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Update select all when individual checkboxes change
    orderCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(orderCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(orderCheckboxes).some(cb => cb.checked);
            
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        });
    });
});
</script>
@endpush
