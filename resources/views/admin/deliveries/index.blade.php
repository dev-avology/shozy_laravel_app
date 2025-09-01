@extends('admin.layouts.app')

@section('title', 'Delivery Panel Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Delivery Panel Management</h1>
            <p class="text-muted">Manage delivery users, track deliveries, and monitor performance</p>
        </div>
        <div>
            <button class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Delivery User
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Delivery Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDeliveryUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-truck fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Online Users</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $onlineDeliveryUsers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Deliveries</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalDeliveries }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-box fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Active Deliveries</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeDeliveries }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-route fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Delivery Users</h6>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search delivery users...">
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
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>Vehicle Info</th>
                            <th>Status</th>
                            <th>Rating</th>
                            <th>Deliveries</th>
                            <th>This Week</th>
                            <th>Location</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($deliveryUsers && $deliveryUsers->count() > 0)
                            @foreach($deliveryUsers as $deliveryUser)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input delivery-user-checkbox" value="{{ $deliveryUser->id }}">
                                </td>
                                <td>
                                    <img src="{{ $deliveryUser->avatar }}" alt="{{ $deliveryUser->name }}" 
                                         class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">{{ $deliveryUser->name }}</h6>
                                            <small class="text-muted">{{ $deliveryUser->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $deliveryUser->vehicle_type }}</strong><br>
                                        <small class="text-muted">{{ $deliveryUser->vehicle_number }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $deliveryUser->status === 'online' ? 'success' : ($deliveryUser->status === 'busy' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($deliveryUser->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{ $deliveryUser->rating }}</span>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $deliveryUser->total_deliveries }}</strong><br>
                                        <small class="text-muted">{{ $deliveryUser->current_deliveries }} active</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-success">
                                        <strong>${{ number_format($deliveryUser->this_week_earnings, 2) }}</strong><br>
                                        <small class="text-muted">This Week</small>
                                    </div>
                                </td>
                                <td>{{ $deliveryUser->location }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.deliveries.show', $deliveryUser->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" 
                                                data-bs-toggle="dropdown">
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.deliveries.tracking', $deliveryUser->id) }}">
                                                <i class="fas fa-map-marker-alt me-2"></i>Live Tracking
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.deliveries.orders', $deliveryUser->id) }}">
                                                <i class="fas fa-list me-2"></i>View Orders
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-warning" href="#">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a></li>
                                            <li><a class="dropdown-item text-danger" href="#">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </a></li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Delivery Users Found</h5>
                                    <p class="text-muted">Start by adding your first delivery user to the platform.</p>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add First Delivery User
                                    </button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
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
    const deliveryUserCheckboxes = document.querySelectorAll('.delivery-user-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        deliveryUserCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Update select all when individual checkboxes change
    deliveryUserCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(deliveryUserCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(deliveryUserCheckboxes).some(cb => cb.checked);
            
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        });
    });
});
</script>
@endpush
