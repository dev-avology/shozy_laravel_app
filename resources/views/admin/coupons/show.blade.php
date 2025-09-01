@extends('admin.layouts.app')

@section('title', 'Coupon Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">{{ $coupon->code }}</h1>
            <p class="text-muted">Coupon details and usage statistics</p>
        </div>
        <div>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Coupons
            </a>
            <a href="{{ route('admin.coupons.edit', $coupon->id) }}" class="btn btn-primary">
                <i class="fas fa-edit me-2"></i>Edit Coupon
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Coupon Information Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Coupon Information</h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <i class="fas fa-ticket-alt fa-3x text-primary mb-2"></i>
                        <h5 class="mb-0">{{ $coupon->code }}</h5>
                        <span class="badge bg-{{ $coupon->status === 'active' ? 'success' : 'secondary' }} mt-2">
                            {{ ucfirst($coupon->status) }}
                        </span>
                    </div>
                    
                    <ul class="list-group list-group-flush">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Type:</span>
                            @php
                                $typeLabels = [
                                    'percentage' => 'Percentage',
                                    'fixed' => 'Fixed Amount',
                                    'shipping' => 'Free Shipping'
                                ];
                                $typeLabel = $typeLabels[$coupon->type] ?? ucfirst($coupon->type);
                            @endphp
                            <span class="badge bg-info">{{ $typeLabel }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Value:</span>
                            @if($coupon->type === 'percentage')
                                <span class="fw-bold text-success">{{ $coupon->value }}%</span>
                            @elseif($coupon->type === 'fixed')
                                <span class="fw-bold text-success">${{ number_format($coupon->value, 2) }}</span>
                            @else
                                <span class="badge bg-success">Free</span>
                            @endif
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Min Order Amount:</span>
                            <span class="text-muted">${{ number_format($coupon->min_amount, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Max Discount:</span>
                            <span class="fw-bold text-success">${{ number_format($coupon->max_discount, 2) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Usage Limit:</span>
                            <span class="text-muted">{{ number_format($coupon->usage_limit) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Used Count:</span>
                            <span class="fw-bold text-primary">{{ number_format($coupon->used_count) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Applies To:</span>
                            <span class="text-muted">{{ ucwords(str_replace('_', ' ', $coupon->applies_to)) }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <span>Customer Groups:</span>
                            <div class="text-end">
                                @foreach($coupon->customer_groups as $group)
                                    <span class="badge bg-secondary me-1">{{ ucwords(str_replace('_', ' ', $group)) }}</span>
                                @endforeach
                            </div>
                        </li>
                    </ul>
                    
                    <div class="mt-3">
                        <small class="text-muted">
                            <strong>Created:</strong> {{ $coupon->created_at->format('M d, Y H:i') }}<br>
                            <strong>Last Updated:</strong> {{ $coupon->updated_at->format('M d, Y H:i') }}
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
                        <a href="{{ route('admin.coupons.analytics', $coupon->id) }}" class="btn btn-outline-info">
                            <i class="fas fa-chart-bar me-2"></i>View Analytics
                        </a>
                        <a href="{{ route('admin.coupons.duplicate', $coupon->id) }}" class="btn btn-outline-warning">
                            <i class="fas fa-copy me-2"></i>Duplicate Coupon
                        </button>
                        <button class="btn btn-outline-success" onclick="toggleStatus({{ $coupon->id }})">
                            <i class="fas fa-toggle-on me-2"></i>Toggle Status
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Usage Statistics -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Usage Statistics</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 text-center mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-primary mb-1">{{ $statistics['total_orders'] }}</h4>
                                <small class="text-muted">Total Orders</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-success mb-1">${{ number_format($statistics['total_discount'], 2) }}</h4>
                                <small class="text-muted">Total Discount</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-info mb-1">${{ number_format($statistics['average_order_value'], 2) }}</h4>
                                <small class="text-muted">Avg Order Value</small>
                            </div>
                        </div>
                        <div class="col-md-3 text-center mb-3">
                            <div class="border rounded p-3">
                                <h4 class="text-warning mb-1">{{ number_format($statistics['conversion_rate'], 1) }}%</h4>
                                <small class="text-muted">Usage Rate</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Usage History -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Recent Usage History</h6>
                </div>
                <div class="card-body">
                    @if($usageHistory->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Order ID</th>
                                        <th>Customer</th>
                                        <th>Order Amount</th>
                                        <th>Discount Applied</th>
                                        <th>Final Amount</th>
                                        <th>Used At</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($usageHistory as $usage)
                                    <tr>
                                        <td>
                                            <strong class="text-primary">{{ $usage->order_id }}</strong>
                                        </td>
                                        <td>{{ $usage->customer }}</td>
                                        <td>
                                            <span class="fw-bold">${{ number_format($usage->order_amount, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">${{ number_format($usage->discount_applied, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-primary">${{ number_format($usage->final_amount, 2) }}</span>
                                        </td>
                                        <td>
                                            <span class="text-muted">{{ $usage->used_at->format('M d, Y H:i') }}</span>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-chart-line fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">No Usage History</h6>
                            <p class="text-muted">This coupon hasn't been used yet.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Coupon Description -->
            @if(isset($coupon->description) && $coupon->description)
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Description</h6>
                </div>
                <div class="card-body">
                    <p class="text-muted mb-0">{{ $coupon->description }}</p>
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
    if (confirm('Are you sure you want to toggle the status of this coupon?')) {
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

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
</style>
@endpush
