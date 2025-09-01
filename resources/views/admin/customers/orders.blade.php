@extends('admin.layouts.app')

@section('title', 'Customer Orders')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Orders for {{ $customer->name }}</h1>
            <p class="text-muted">Complete order history and details</p>
        </div>
        <div>
            <a href="{{ route('admin.customers.show', $customer->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Customer
            </a>
        </div>
    </div>

    <!-- Order Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-shopping-cart fa-2x text-gray-300"></i>
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
                                Total Spent</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($orders->sum('amount'), 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                Completed Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders->where('status', 'completed')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-check-circle fa-2x text-gray-300"></i>
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
                                Pending Orders</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $orders->where('status', 'pending')->count() }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Filters and Search -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <h6 class="m-0 font-weight-bold text-primary">Filter Orders</h6>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="statusFilter" class="form-label">Status</label>
                    <select class="form-select" id="statusFilter">
                        <option value="">All Statuses</option>
                        <option value="pending">Pending</option>
                        <option value="processing">Processing</option>
                        <option value="completed">Completed</option>
                        <option value="cancelled">Cancelled</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="dateFilter" class="form-label">Date Range</label>
                    <select class="form-select" id="dateFilter">
                        <option value="">All Time</option>
                        <option value="today">Today</option>
                        <option value="week">This Week</option>
                        <option value="month">This Month</option>
                        <option value="year">This Year</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="amountFilter" class="form-label">Amount Range</label>
                    <select class="form-select" id="amountFilter">
                        <option value="">All Amounts</option>
                        <option value="0-50">$0 - $50</option>
                        <option value="50-100">$50 - $100</option>
                        <option value="100-200">$100 - $200</option>
                        <option value="200+">$200+</option>
                    </select>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="searchOrders" class="form-label">Search</label>
                    <input type="text" class="form-control" id="searchOrders" placeholder="Search orders...">
                </div>
            </div>
        </div>
    </div>

    <!-- Orders Table -->
    <div class="card shadow mb-4">
        <div class="card-header py-3 d-flex justify-content-between align-items-center">
            <h6 class="m-0 font-weight-bold text-primary">Order History</h6>
            <div class="d-flex gap-2">
                <button class="btn btn-sm btn-outline-secondary" id="exportOrders">
                    <i class="fas fa-download me-1"></i>Export
                </button>
                <button class="btn btn-sm btn-outline-primary" id="refreshOrders">
                    <i class="fas fa-sync-alt me-1"></i>Refresh
                </button>
            </div>
        </div>
        <div class="card-body">
            @if($orders->count() > 0)
                <div class="table-responsive">
                    <table class="table table-bordered table-hover" id="ordersTable">
                        <thead class="table-light">
                            <tr>
                                <th>
                                    <input type="checkbox" class="form-check-input" id="selectAllOrders">
                                </th>
                                <th>Order ID</th>
                                <th>Service</th>
                                <th>Amount</th>
                                <th>Status</th>
                                <th>Order Date</th>
                                <th>Delivery Date</th>
                                <th>Rating</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                            <tr data-status="{{ $order->status }}" data-amount="{{ $order->amount }}" data-date="{{ $order->order_date->format('Y-m-d') }}">
                                <td>
                                    <input type="checkbox" class="form-check-input order-checkbox" value="{{ $order->id }}">
                                </td>
                                <td>
                                    <strong class="text-primary">{{ $order->order_id }}</strong>
                                    @if($order->is_urgent)
                                        <span class="badge bg-danger ms-1">Urgent</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        @if(isset($order->service_image))
                                            <img src="{{ $order->service_image }}" alt="{{ $order->service }}" 
                                                 class="rounded me-2" style="width: 40px; height: 40px; object-fit: cover;">
                                        @endif
                                        <div>
                                            <div class="fw-bold">{{ $order->service }}</div>
                                            <small class="text-muted">{{ $order->service_category }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="fw-bold text-success">${{ number_format($order->amount, 2) }}</span>
                                    @if($order->discount > 0)
                                        <br><small class="text-muted">-{{ $order->discount }}% off</small>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusColors = [
                                            'pending' => 'warning',
                                            'processing' => 'info',
                                            'completed' => 'success',
                                            'cancelled' => 'danger',
                                            'delivered' => 'primary'
                                        ];
                                        $statusColor = $statusColors[$order->status] ?? 'secondary';
                                    @endphp
                                    <span class="badge bg-{{ $statusColor }}">{{ ucfirst($order->status) }}</span>
                                </td>
                                <td>
                                    <div>{{ $order->order_date->format('M d, Y') }}</div>
                                    <small class="text-muted">{{ $order->order_date->format('h:i A') }}</small>
                                </td>
                                <td>
                                    @if($order->delivery_date)
                                        <div>{{ $order->delivery_date->format('M d, Y') }}</div>
                                        <small class="text-muted">{{ $order->delivery_date->format('h:i A') }}</small>
                                    @else
                                        <span class="text-muted">Not set</span>
                                    @endif
                                </td>
                                <td>
                                    @if($order->rating)
                                        <div class="d-flex align-items-center">
                                            <span class="me-1">{{ $order->rating }}</span>
                                            <i class="fas fa-star text-warning"></i>
                                        </div>
                                        @if($order->review)
                                            <small class="text-muted d-block">{{ Str::limit($order->review, 30) }}</small>
                                        @endif
                                    @else
                                        <span class="text-muted">No rating</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <button type="button" class="btn btn-sm btn-outline-primary" 
                                                data-bs-toggle="modal" data-bs-target="#orderDetailsModal{{ $order->id }}">
                                            <i class="fas fa-eye"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-info" 
                                                onclick="trackOrder('{{ $order->order_id }}')">
                                            <i class="fas fa-map-marker-alt"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success" 
                                                onclick="updateStatus('{{ $order->id }}', 'completed')">
                                            <i class="fas fa-check"></i>
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
                        Showing {{ $orders->count() }} of {{ $orders->count() }} orders
                    </div>
                    <nav aria-label="Orders pagination">
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
                    <i class="fas fa-shopping-cart fa-3x text-muted mb-3"></i>
                    <h5 class="text-muted">No Orders Found</h5>
                    <p class="text-muted">This customer hasn't placed any orders yet.</p>
                </div>
            @endif
        </div>
    </div>
</div>

<!-- Order Details Modals -->
@foreach($orders as $order)
<div class="modal fade" id="orderDetailsModal{{ $order->id }}" tabindex="-1" aria-labelledby="orderDetailsModalLabel{{ $order->id }}" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="orderDetailsModalLabel{{ $order->id }}">
                    Order Details - {{ $order->order_id }}
                </h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <h6 class="fw-bold">Order Information</h6>
                        <table class="table table-sm">
                            <tr><td>Order ID:</td><td><strong>{{ $order->order_id }}</strong></td></tr>
                            <tr><td>Service:</td><td>{{ $order->service }}</td></tr>
                            <tr><td>Category:</td><td>{{ $order->service_category }}</td></tr>
                            <tr><td>Amount:</td><td class="text-success">${{ number_format($order->amount, 2) }}</td></tr>
                            <tr><td>Status:</td><td><span class="badge bg-{{ $statusColors[$order->status] ?? 'secondary' }}">{{ ucfirst($order->status) }}</span></td></tr>
                        </table>
                    </div>
                    <div class="col-md-6">
                        <h6 class="fw-bold">Timing</h6>
                        <table class="table table-sm">
                            <tr><td>Order Date:</td><td>{{ $order->order_date->format('M d, Y h:i A') }}</td></tr>
                            <tr><td>Delivery Date:</td><td>{{ $order->delivery_date ? $order->delivery_date->format('M d, Y h:i A') : 'Not set' }}</td></tr>
                            <tr><td>Urgent:</td><td>{{ $order->is_urgent ? 'Yes' : 'No' }}</td></tr>
                        </table>
                    </div>
                </div>
                
                @if($order->special_instructions)
                <div class="mt-3">
                    <h6 class="fw-bold">Special Instructions</h6>
                    <p class="text-muted">{{ $order->special_instructions }}</p>
                </div>
                @endif
                
                @if($order->rating)
                <div class="mt-3">
                    <h6 class="fw-bold">Customer Feedback</h6>
                    <div class="d-flex align-items-center mb-2">
                        <span class="me-2">Rating: {{ $order->rating }}/5</span>
                        <div>
                            @for($i = 1; $i <= 5; $i++)
                                <i class="fas fa-star {{ $i <= $order->rating ? 'text-warning' : 'text-muted' }}"></i>
                            @endfor
                        </div>
                    </div>
                    @if($order->review)
                        <p class="text-muted">{{ $order->review }}</p>
                    @endif
                </div>
                @endif
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" onclick="editOrder('{{ $order->id }}')">Edit Order</button>
            </div>
        </div>
    </div>
</div>
@endforeach
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all orders functionality
    const selectAllCheckbox = document.getElementById('selectAllOrders');
    const orderCheckboxes = document.querySelectorAll('.order-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        orderCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Filter functionality
    const statusFilter = document.getElementById('statusFilter');
    const dateFilter = document.getElementById('dateFilter');
    const amountFilter = document.getElementById('amountFilter');
    const searchInput = document.getElementById('searchOrders');
    
    function filterOrders() {
        const status = statusFilter.value;
        const date = dateFilter.value;
        const amount = amountFilter.value;
        const search = searchInput.value.toLowerCase();
        
        const rows = document.querySelectorAll('#ordersTable tbody tr');
        
        rows.forEach(row => {
            let show = true;
            
            // Status filter
            if (status && row.dataset.status !== status) {
                show = false;
            }
            
            // Date filter
            if (date) {
                const orderDate = new Date(row.dataset.date);
                const today = new Date();
                
                switch(date) {
                    case 'today':
                        if (orderDate.toDateString() !== today.toDateString()) show = false;
                        break;
                    case 'week':
                        const weekAgo = new Date(today.getTime() - 7 * 24 * 60 * 60 * 1000);
                        if (orderDate < weekAgo) show = false;
                        break;
                    case 'month':
                        if (orderDate.getMonth() !== today.getMonth() || orderDate.getFullYear() !== today.getFullYear()) show = false;
                        break;
                    case 'year':
                        if (orderDate.getFullYear() !== today.getFullYear()) show = false;
                        break;
                }
            }
            
            // Amount filter
            if (amount) {
                const orderAmount = parseFloat(row.dataset.amount);
                switch(amount) {
                    case '0-50':
                        if (orderAmount < 0 || orderAmount > 50) show = false;
                        break;
                    case '50-100':
                        if (orderAmount < 50 || orderAmount > 100) show = false;
                        break;
                    case '100-200':
                        if (orderAmount < 100 || orderAmount > 200) show = false;
                        break;
                    case '200+':
                        if (orderAmount < 200) show = false;
                        break;
                }
            }
            
            // Search filter
            if (search) {
                const text = row.textContent.toLowerCase();
                if (!text.includes(search)) show = false;
            }
            
            row.style.display = show ? '' : 'none';
        });
    }
    
    statusFilter.addEventListener('change', filterOrders);
    dateFilter.addEventListener('change', filterOrders);
    amountFilter.addEventListener('change', filterOrders);
    searchInput.addEventListener('input', filterOrders);
    
    // Export functionality
    document.getElementById('exportOrders').addEventListener('click', function() {
        alert('Export functionality would be implemented here');
    });
    
    // Refresh functionality
    document.getElementById('refreshOrders').addEventListener('click', function() {
        location.reload();
    });
});

// Placeholder functions
function trackOrder(orderId) {
    alert(`Tracking order ${orderId} - This would open a tracking map`);
}

function updateStatus(orderId, status) {
    if (confirm(`Are you sure you want to mark order ${orderId} as ${status}?`)) {
        alert(`Order status updated to ${status}`);
        location.reload();
    }
}

function editOrder(orderId) {
    alert(`Edit order ${orderId} - This would open an edit form`);
}
</script>
@endpush

@push('styles')
<style>
.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    font-weight: 600;
}

.order-checkbox {
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

.modal-lg {
    max-width: 800px;
}

.table-sm td, .table-sm th {
    padding: 0.5rem;
    font-size: 0.875rem;
}

.pagination {
    margin-bottom: 0;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}
</style>
@endpush
