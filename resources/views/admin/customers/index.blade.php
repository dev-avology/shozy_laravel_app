@extends('admin.layouts.app')

@section('title', 'Customer Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Customer Management</h1>
            <p class="text-muted">Manage normal users who create orders on your platform</p>
        </div>
        <div>
            <button class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Customer
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
                                Total Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalCustomers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
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
                                Active Customers</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $activeCustomers }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-check fa-2x text-gray-300"></i>
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
                                Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalOrders }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
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

    <!-- Search and Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Customers</h6>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search customers...">
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
                            <th>Contact Info</th>
                            <th>Status</th>
                            <th>Orders</th>
                            <th>Total Spent</th>
                            <th>Last Order</th>
                            <th>Location</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($customers && $customers->count() > 0)
                            @foreach($customers as $customer)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input customer-checkbox" value="{{ $customer->id }}">
                                </td>
                                <td>
                                    <img src="{{ $customer->avatar }}" alt="{{ $customer->name }}" 
                                         class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">{{ $customer->name }}</h6>
                                            <small class="text-muted">ID: {{ $customer->id }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <div><strong>{{ $customer->email }}</strong></div>
                                        <small class="text-muted">{{ $customer->phone }}</small>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-{{ $customer->status === 'active' ? 'success' : 'secondary' }}">
                                        {{ ucfirst($customer->status) }}
                                    </span>
                                    @if($customer->is_verified)
                                        <br><small class="text-success"><i class="fas fa-check-circle"></i> Verified</small>
                                    @endif
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $customer->total_orders }}</strong><br>
                                        <small class="text-muted">{{ $customer->completed_orders }} completed</small>
                                    </div>
                                </td>
                                <td>
                                    <div class="text-success">
                                        <strong>${{ number_format($customer->total_spent, 2) }}</strong><br>
                                        <small class="text-muted">{{ $customer->preferred_payment }}</small>
                                    </div>
                                </td>
                                <td>
                                    <div>
                                        <strong>{{ $customer->last_order_date->format('M d, Y') }}</strong><br>
                                        <small class="text-muted">{{ $customer->last_order_date->diffForHumans() }}</small>
                                    </div>
                                </td>
                                <td>{{ $customer->location }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.customers.show', $customer->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" 
                                                data-bs-toggle="dropdown">
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.customers.orders', $customer->id) }}">
                                                <i class="fas fa-shopping-cart me-2"></i>View Orders
                                            </a></li>
                                            <li><a class="dropdown-item" href="#">
                                                <i class="fas fa-edit me-2"></i>Edit Profile
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            @if($customer->status === 'active')
                                                <li><a class="dropdown-item text-warning" href="#" onclick="blockCustomer({{ $customer->id }})">
                                                    <i class="fas fa-ban me-2"></i>Block Customer
                                                </a></li>
                                            @else
                                                <li><a class="dropdown-item text-success" href="#" onclick="unblockCustomer({{ $customer->id }})">
                                                    <i class="fas fa-check me-2"></i>Unblock Customer
                                                </a></li>
                                            @endif
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
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Customers Found</h5>
                                    <p class="text-muted">Start by adding your first customer to the platform.</p>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add First Customer
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
    const customerCheckboxes = document.querySelectorAll('.customer-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        customerCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Update select all when individual checkboxes change
    customerCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(customerCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(customerCheckboxes).some(cb => cb.checked);
            
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        });
    });
});

function blockCustomer(customerId) {
    if (confirm('Are you sure you want to block this customer?')) {
        // In a real application, this would make an AJAX call
        console.log('Blocking customer:', customerId);
        alert('Customer blocked successfully!');
    }
}

function unblockCustomer(customerId) {
    if (confirm('Are you sure you want to unblock this customer?')) {
        // In a real application, this would make an AJAX call
        console.log('Unblocking customer:', customerId);
        alert('Customer unblocked successfully!');
    }
}
</script>
@endpush
