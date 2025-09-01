@extends('admin.layouts.app')

@section('title', 'Shipping Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Shipping Management</h1>
            <p class="text-muted">Manage shipping methods, zones, and rates</p>
        </div>
        <div>
            <a href="{{ route('admin.shipping.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Shipping Method
            </a>
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
                                Total Methods</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalMethods }}</div>
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
                                Active Methods</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeMethods }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                                Total Shipments</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalShipments) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shipping-fast fa-2x text-gray-300"></i>
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
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalRevenue, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Shipping Methods Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Shipping Methods</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" id="exportShipping">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <button class="btn btn-sm btn-outline-primary" id="refreshShipping">
                    <i class="fas fa-sync-alt me-1"></i>Refresh
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($shippingMethods->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="shippingTable">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAllShipping">
                                </th>
                                <th>Method</th>
                                <th>Carrier</th>
                                <th>Delivery Time</th>
                                <th>Base Rate</th>
                                <th>Zones</th>
                                <th>Shipments</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($shippingMethods as $method)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input shipping-checkbox" value="{{ $method->id }}">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="shipping-icon me-3">
                                            <i class="{{ $method->icon }} fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold">{{ $method->name }}</div>
                                            <small class="text-muted">ID: {{ $method->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-info">{{ $method->carrier }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ $method->delivery_time }}</span>
                                </td>
                                <td>
                                    @if($method->base_rate > 0)
                                        <span class="fw-bold text-success">${{ number_format($method->base_rate, 2) }}</span>
                                    @else
                                        <span class="badge bg-success">Free</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $method->zones }}</span>
                                </td>
                                <td>
                                    <span class="text-muted">{{ number_format($method->total_shipments) }}</span>
                                </td>
                                <td>
                                    @if($method->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @else
                                        <span class="badge bg-secondary">Inactive</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.shipping.show', $method->id) }}" 
                                           class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.shipping.zones', $method->id) }}" 
                                           class="btn btn-sm btn-outline-info" title="Manage Zones">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </a>
                                        <a href="{{ route('admin.shipping.tracking', $method->id) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Track Shipments">
                                            <i class="fas fa-route"></i>
                                        </a>
                                        <a href="{{ route('admin.shipping.edit', $method->id) }}" 
                                           class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteShippingMethod({{ $method->id }})" title="Delete">
                                            <i class="fas fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="d-flex justify-content-between align-items-center mt-4">
                    <div class="text-muted">
                        Showing {{ $shippingMethods->count() }} of {{ $shippingMethods->count() }} shipping methods
                    </div>
                    <nav aria-label="Shipping pagination">
                        <ul class="pagination pagination-sm mb-0">
                            <li class="page-item disabled">
                                <span class="page-link">Previous</span>
                            </li>
                            <li class="page-item active"><span class="page-link">1</span></li>
                            <li class="page-item disabled">
                                <span class="page-link">Next</span>
                            </li>
                        </ul>
                    </nav>
                </div>
            @else
                <div class="text-center py-5">
                    <i class="fas fa-truck fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Shipping Methods Found</h5>
                    <p class="text-muted">Get started by adding your first shipping method.</p>
                    <a href="{{ route('admin.shipping.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Shipping Method
                    </a>
                </div>
            @endif
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row">
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Quick Actions</h6>
                </div>
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.shipping.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>Create New Shipping Method
                        </a>
                        <button class="btn btn-outline-info" onclick="bulkUpdateStatus()">
                            <i class="fas fa-toggle-on me-2"></i>Bulk Update Status
                        </button>
                        <button class="btn btn-outline-warning" onclick="exportShippingData()">
                            <i class="fas fa-download me-2"></i>Export Shipping Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Shipping Insights</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted">Most Popular Method</span>
                            <span class="fw-bold">Standard Shipping</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted">Revenue Leader</span>
                            <span class="fw-bold">Express Shipping</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted">Zone Coverage</span>
                            <span class="fw-bold">International</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-info" style="width: 90%"></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all shipping methods functionality
    const selectAllCheckbox = document.getElementById('selectAllShipping');
    const shippingCheckboxes = document.querySelectorAll('.shipping-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        shippingCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Export functionality
    document.getElementById('exportShipping').addEventListener('click', function() {
        alert('Export functionality would be implemented here');
    });
    
    // Refresh functionality
    document.getElementById('refreshShipping').addEventListener('click', function() {
        location.reload();
    });
});

// Placeholder functions
function deleteShippingMethod(id) {
    if (confirm(`Are you sure you want to delete shipping method ${id}?`)) {
        alert(`Shipping method ${id} deleted successfully`);
        location.reload();
    }
}

function bulkUpdateStatus() {
    const selectedCheckboxes = document.querySelectorAll('.shipping-checkbox:checked');
    if (selectedCheckboxes.length === 0) {
        alert('Please select at least one shipping method');
        return;
    }
    
    const status = prompt('Enter new status (active/inactive):');
    if (status && ['active', 'inactive'].includes(status.toLowerCase())) {
        alert(`Status updated to ${status} for ${selectedCheckboxes.length} shipping methods`);
        location.reload();
    }
}

function exportShippingData() {
    alert('Export functionality would be implemented here');
}
</script>
@endpush

@push('styles')
<style>
.shipping-icon {
    width: 50px;
    text-align: center;
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    font-weight: 600;
}

.shipping-checkbox {
    margin: 0;
}

.btn-group .btn {
    margin-right: 2px;
}

.btn-group .btn:last-child {
    margin-right: 0;
}

.badge {
    font-size: 0.75rem;
}

.progress {
    background-color: #e9ecef;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.pagination {
    margin-bottom: 0;
}
</style>
@endpush
