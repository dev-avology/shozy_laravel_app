@extends('admin.layouts.app')

@section('title', 'Coupon Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Coupon Management</h1>
            <p class="text-muted">Manage discount codes, promotions, and special offers</p>
        </div>
        <div>
            <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add Coupon Code
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
                                Total Coupons</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCoupons }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
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
                                Active Coupons</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeCoupons }}</div>
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
                                Total Usage</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($totalUsage) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
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
                                Total Savings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalSavings, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Coupons Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Coupon Codes</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" id="exportCoupons">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <button class="btn btn-sm btn-outline-primary" id="refreshCoupons">
                    <i class="fas fa-sync-alt me-1"></i>Refresh
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($coupons->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="couponsTable">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAllCoupons">
                                </th>
                                <th>Code</th>
                                <th>Type</th>
                                <th>Value</th>
                                <th>Usage</th>
                                <th>Validity</th>
                                <th>Status</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($coupons as $coupon)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input coupon-checkbox" value="{{ $coupon->id }}">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div class="coupon-icon me-3">
                                            <i class="fas fa-ticket-alt fa-2x text-primary"></i>
                                        </div>
                                        <div>
                                            <div class="fw-bold text-primary">{{ $coupon->code }}</div>
                                            <small class="text-muted">ID: {{ $coupon->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    @php
                                        $typeColors = [
                                            'percentage' => 'success',
                                            'fixed' => 'info',
                                            'shipping' => 'warning'
                                        ];
                                        $typeColor = $typeColors[$coupon->type] ?? 'secondary';
                                        $typeLabels = [
                                            'percentage' => 'Percentage',
                                            'fixed' => 'Fixed Amount',
                                            'shipping' => 'Free Shipping'
                                        ];
                                        $typeLabel = $typeLabels[$coupon->type] ?? ucfirst($coupon->type);
                                    @endphp
                                    <span class="badge bg-{{ $typeColor }}">{{ $typeLabel }}</span>
                                </td>
                                <td>
                                    @if($coupon->type === 'percentage')
                                        <span class="fw-bold text-success">{{ $coupon->value }}%</span>
                                        <br><small class="text-muted">Max: ${{ number_format($coupon->max_discount, 2) }}</small>
                                    @elseif($coupon->type === 'fixed')
                                        <span class="fw-bold text-success">${{ number_format($coupon->value, 2) }}</span>
                                    @else
                                        <span class="badge bg-success">Free</span>
                                        <br><small class="text-muted">Max: ${{ number_format($coupon->max_discount, 2) }}</small>
                                    @endif
                                </td>
                                <td>
                                    <div class="mb-1">
                                        <span class="fw-bold">{{ number_format($coupon->used_count) }}</span>
                                        <span class="text-muted">/ {{ number_format($coupon->usage_limit) }}</span>
                                    </div>
                                    <div class="progress" style="height: 6px;">
                                        @php
                                            $usagePercentage = ($coupon->used_count / $coupon->usage_limit) * 100;
                                        @endphp
                                        <div class="progress-bar bg-{{ $usagePercentage >= 80 ? 'danger' : ($usagePercentage >= 60 ? 'warning' : 'success') }}" 
                                             style="width: {{ $usagePercentage }}%"></div>
                                    </div>
                                </td>
                                <td>
                                    <div class="mb-1">
                                        <small class="text-muted">From: {{ $coupon->start_date->format('M d, Y') }}</small>
                                    </div>
                                    <div>
                                        <small class="text-muted">To: {{ $coupon->end_date->format('M d, Y') }}</small>
                                    </div>
                                    @if($coupon->end_date->isPast())
                                        <span class="badge bg-danger mt-1">Expired</span>
                                    @elseif($coupon->start_date->isFuture())
                                        <span class="badge bg-warning mt-1">Future</span>
                                    @else
                                        <span class="badge bg-success mt-1">Active</span>
                                    @endif
                                </td>
                                <td>
                                    @if($coupon->status === 'active')
                                        <span class="badge bg-success">Active</span>
                                    @elseif($coupon->status === 'inactive')
                                        <span class="badge bg-secondary">Inactive</span>
                                    @else
                                        <span class="badge bg-danger">Expired</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.coupons.show', $coupon->id) }}" 
                                           class="btn btn-sm btn-outline-primary" title="View Details">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <a href="{{ route('admin.coupons.analytics', $coupon->id) }}" 
                                           class="btn btn-sm btn-outline-info" title="Analytics">
                                            <i class="fas fa-chart-bar"></i>
                                        </a>
                                        <a href="{{ route('admin.coupons.edit', $coupon->id) }}" 
                                           class="btn btn-sm btn-outline-secondary" title="Edit">
                                            <i class="fas fa-edit"></i>
                                        </a>
                                        <a href="{{ route('admin.coupons.duplicate', $coupon->id) }}" 
                                           class="btn btn-sm btn-outline-warning" title="Duplicate">
                                            <i class="fas fa-copy"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-danger" 
                                                onclick="deleteCoupon({{ $coupon->id }})" title="Delete">
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
                        Showing {{ $coupons->count() }} of {{ $coupons->count() }} coupon codes
                    </div>
                    <nav aria-label="Coupons pagination">
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
                    <i class="fas fa-ticket-alt fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Coupon Codes Found</h5>
                    <p class="text-muted">Get started by adding your first coupon code.</p>
                    <a href="{{ route('admin.coupons.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus me-2"></i>Add Coupon Code
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
                        <a href="{{ route('admin.coupons.create') }}" class="btn btn-outline-primary">
                            <i class="fas fa-plus me-2"></i>Create New Coupon
                        </a>
                        <button class="btn btn-outline-info" onclick="bulkUpdateStatus()">
                            <i class="fas fa-toggle-on me-2"></i>Bulk Update Status
                        </button>
                        <button class="btn btn-outline-warning" onclick="exportCouponData()">
                            <i class="fas fa-download me-2"></i>Export Coupon Data
                        </button>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-md-6">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Coupon Insights</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted">Most Popular</span>
                            <span class="fw-bold">WELCOME20</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted">Highest Value</span>
                            <span class="fw-bold">VIP30</span>
                        </div>
                        <div class="progress" style="height: 8px;">
                            <div class="progress-bar bg-success" style="width: 60%"></div>
                        </div>
                    </div>
                    
                    <div class="mb-3">
                        <div class="d-flex justify-content-between align-items-center mb-1">
                            <span class="text-muted">Usage Rate</span>
                            <span class="fw-bold">FLASH25</span>
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
    // Select all coupons functionality
    const selectAllCheckbox = document.getElementById('selectAllCoupons');
    const couponCheckboxes = document.querySelectorAll('.coupon-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        couponCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Export functionality
    document.getElementById('exportCoupons').addEventListener('click', function() {
        alert('Export functionality would be implemented here');
    });
    
    // Refresh functionality
    document.getElementById('refreshCoupons').addEventListener('click', function() {
        location.reload();
    });
});

// Placeholder functions
function deleteCoupon(id) {
    if (confirm(`Are you sure you want to delete coupon ${id}?`)) {
        alert(`Coupon ${id} deleted successfully`);
        location.reload();
    }
}

function bulkUpdateStatus() {
    const selectedCheckboxes = document.querySelectorAll('.coupon-checkbox:checked');
    if (selectedCheckboxes.length === 0) {
        alert('Please select at least one coupon');
        return;
    }
    
    const status = prompt('Enter new status (active/inactive/expired):');
    if (status && ['active', 'inactive', 'expired'].includes(status.toLowerCase())) {
        alert(`Status updated to ${status} for ${selectedCheckboxes.length} coupons`);
        location.reload();
    }
}

function exportCouponData() {
    alert('Export functionality would be implemented here');
}
</script>
@endpush

@push('styles')
<style>
.coupon-icon {
    width: 50px;
    text-align: center;
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    font-weight: 600;
}

.coupon-checkbox {
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
