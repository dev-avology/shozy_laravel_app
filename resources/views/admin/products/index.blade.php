@extends('admin.layouts.app')

@section('title', 'Products Management')
@section('page-title', 'Products Management')

@section('content')
<div class="container-fluid">
    <!-- Statistics Cards -->
    <div class="row mb-3">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Total Products</h6>
                            <h3 class="stat-value text-primary">{{ $stats['total'] }}</h3>
                        </div>
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-box text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Active Products</h6>
                            <h3 class="stat-value text-success">{{ $stats['active'] }}</h3>
                        </div>
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Pending Review</h6>
                            <h3 class="stat-value text-warning">{{ $stats['pending'] }}</h3>
                        </div>
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Rejected</h6>
                            <h3 class="stat-value text-danger">{{ $stats['rejected'] }}</h3>
                        </div>
                        <div class="stat-icon bg-danger">
                            <i class="fas fa-times-circle text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>

    <!-- Filters and Actions -->
    <div class="card mb-3 filter-card">
        <div class="card-header py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    <i class="fas fa-filter me-2"></i>Filters & Search
                </h6>
                <div class="d-flex gap-1">
                    <button type="button" class="btn btn-outline-primary btn-sm" data-bs-toggle="collapse" data-bs-target="#filtersCollapse">
                        <i class="fas fa-filter me-1"></i>Toggle
                    </button>
                    <button type="button" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#bulkActionModal">
                        <i class="fas fa-tasks me-1"></i>Bulk
                    </button>
                    <a href="{{ route('admin.products.export') }}" class="btn btn-info btn-sm">
                        <i class="fas fa-download me-1"></i>Export
                    </a>
                </div>
            </div>
        </div>
        
        <div class="collapse show" id="filtersCollapse">
            <div class="card-body py-3">
                <form method="GET" action="{{ route('admin.products.index') }}" class="row g-2">
                    <div class="col-md-3">
                        <label for="search" class="form-label small">Search</label>
                        <input type="text" class="form-control form-control-sm" id="search" name="search" 
                               value="{{ request('search') }}" placeholder="Product name, SKU, description...">
                    </div>
                    
                    <div class="col-md-2">
                        <label for="vendor" class="form-label small">Vendor</label>
                        <select class="form-select form-select-sm" id="vendor" name="vendor">
                            <option value="">All Vendors</option>
                            @foreach($vendors as $vendor)
                                <option value="{{ $vendor->id }}" {{ request('vendor') == $vendor->id ? 'selected' : '' }}>
                                    {{ $vendor->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="category" class="form-label small">Category</label>
                        <select class="form-select form-select-sm" id="category" name="category">
                            <option value="">All Categories</option>
                            @foreach($categories as $category)
                                <option value="{{ $category->id }}" {{ request('category') == $category->id ? 'selected' : '' }}>
                                    {{ $category->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="status" class="form-label small">Status</label>
                        <select class="form-select form-select-sm" id="status" name="status">
                            <option value="">All Statuses</option>
                            @foreach($statuses as $status)
                                <option value="{{ $status }}" {{ request('status') == $status ? 'selected' : '' }}>
                                    {{ ucfirst($status) }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label small">Date Range</label>
                        <div class="d-flex gap-1">
                            <input type="date" class="form-control form-control-sm" name="date_from" value="{{ request('date_from') }}">
                            <input type="date" class="form-control form-control-sm" name="date_to" value="{{ request('date_to') }}">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search me-1"></i>Apply
                            </button>
                            <a href="{{ route('admin.products.export') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-times me-1"></i>Clear
                            </a>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-header py-2">
            <div class="d-flex justify-content-between align-items-center">
                <h6 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Products List
                    <span class="badge bg-secondary ms-2">{{ $products->count() }} products</span>
                </h6>
                <div class="d-flex gap-2">
                    <span class="text-muted small">Showing {{ $products->count() }} results</span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="50">
                                <input type="checkbox" class="form-check-input" id="selectAll">
                            </th>
                            <th width="80">Image</th>
                            <th>Product Details</th>
                            <th>Vendor</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Features</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($products as $product)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input product-checkbox" value="{{ $product->id }}">
                            </td>
                            <td>
                                @if($product->main_image)
                                    <img src="{{ $product->main_image }}" 
                                         alt="{{ $product->name }}" 
                                         class="product-thumbnail"
                                         data-bs-toggle="modal" 
                                         data-bs-target="#imageModal{{ $product->id }}">
                                @else
                                    <div class="product-thumbnail-placeholder">
                                        <i class="fas fa-image text-muted"></i>
                                    </div>
                                @endif
                            </td>
                            <td>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">{{ $product->name }}</h6>
                                    <p class="product-description mb-1 text-muted">
                                        {{ Str::limit($product->description, 60) }}
                                    </p>
                                    <small class="text-muted">SKU: N/A</small>
                                </div>
                            </td>
                            <td>
                                <div class="vendor-info">
                                    <span class="vendor-name">{{ $product->vendor->name ?? 'N/A' }}</span>
                                    <br>
                                    <small class="text-muted">{{ $product->vendor->company ?? '' }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="category-badge">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td>
                                <span class="price-amount">${{ number_format($product->price, 2) }}</span>
                            </td>
                            <td>
                                <span class="badge bg-{{ $product->status === 'active' ? 'success' : ($product->status === 'pending' ? 'warning' : 'danger') }}">
                                    {{ ucfirst($product->status) }}
                                </span>
                            </td>
                            <td>
                                <div class="feature-badges">
                                    @if($product->is_featured)
                                        <span class="badge bg-warning mb-1">Featured</span>
                                    @endif
                                    @if($product->has_3d_model)
                                        <span class="badge bg-info">3D Model</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $product->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.show', $product->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product->id) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Delete"
                                            onclick="deleteProduct({{ $product->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Image Modal for each product -->
                        @if($product->main_image)
                        <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ $product->main_image }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @empty
                        <tr>
                            <td colspan="10" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                    <h5>No products found</h5>
                                    <p class="text-muted">Try adjusting your filters or search criteria.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="card-footer py-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Showing 1-8 of {{ $products->count() }} products
                </div>
                <nav aria-label="Products pagination">
                    <ul class="pagination pagination-sm mb-0">
                        <li class="page-item disabled">
                            <span class="page-link">Previous</span>
                        </li>
                        <li class="page-item active">
                            <span class="page-link">1</span>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">2</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">3</a>
                        </li>
                        <li class="page-item">
                            <a class="page-link" href="#">Next</a>
                        </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>
</div>

<!-- Bulk Action Modal -->
<div class="modal fade" id="bulkActionModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Bulk Actions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <form action="{{ route('admin.products.bulk-action') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="bulkAction" class="form-label">Select Action</label>
                        <select class="form-select" id="bulkAction" name="action" required>
                            <option value="">Choose an action...</option>
                            <option value="activate">Activate Selected</option>
                            <option value="deactivate">Deactivate Selected</option>
                            <option value="approve">Approve Selected</option>
                            <option value="reject">Reject Selected</option>
                            <option value="delete">Delete Selected</option>
                        </select>
                    </div>
                    
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        <strong>Warning:</strong> This action will affect all selected products. Please review your selection carefully.
                    </div>
                    
                    <input type="hidden" name="products" id="selectedProducts">
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Apply Action</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Delete Confirmation Modal -->
<div class="modal fade" id="deleteModal" tabindex="-1">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Confirm Delete</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body">
                <p>Are you sure you want to delete this product? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Product</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    /* Smaller Font Sizes */
    .card-title {
        font-size: 1rem !important;
    }
    
    .stat-value {
        font-size: 1.5rem !important;
    }
    
    .stat-label {
        font-size: 0.75rem !important;
    }
    
    .form-label {
        font-size: 0.875rem !important;
    }
    
    .table th {
        font-size: 0.875rem !important;
    }
    
    .table td {
        font-size: 0.875rem !important;
    }
    
    /* Filter Card with Corner Cutting */
    .filter-card {
        position: relative;
        overflow: hidden;
    }
    
    .filter-card::before {
        content: '';
        position: absolute;
        top: 0;
        right: 0;
        width: 0;
        height: 0;
        border-style: solid;
        border-width: 0 30px 30px 0;
        border-color: transparent #4e73df transparent transparent;
        z-index: 1;
    }
    
    .filter-card::after {
        content: 'FILTER';
        position: absolute;
        top: 2px;
        right: 2px;
        color: white;
        font-size: 0.6rem;
        font-weight: bold;
        z-index: 2;
        transform: rotate(45deg);
        transform-origin: center;
    }
    
    .product-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s ease;
        border: 2px solid #e3e6f0;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
    }
    
    .product-thumbnail:hover {
        transform: scale(1.05);
        box-shadow: 0 4px 8px rgba(0,0,0,0.15);
        border-color: #4e73df;
    }
    
    .product-thumbnail-placeholder {
        width: 60px;
        height: 60px;
        background: var(--light-color);
        border-radius: 8px;
        display: flex;
        align-items: center;
        justify-content: center;
        color: var(--secondary-color);
    }
    
    .product-name {
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
    }
    
    .product-description {
        font-size: 0.875rem;
        line-height: 1.4;
    }
    
    .vendor-name {
        font-weight: 500;
        color: var(--dark-color);
    }
    
    .category-badge {
        background: var(--light-color);
        color: var(--dark-color);
        padding: 4px 8px;
        border-radius: 12px;
        font-size: 0.75rem;
        font-weight: 500;
    }
    
    .price-amount {
        font-weight: 600;
        color: var(--primary-color);
        font-size: 1.1rem;
    }
    
    .feature-badges {
        display: flex;
        flex-direction: column;
        gap: 4px;
    }
    
    .empty-state {
        padding: 2rem;
    }
    
    .empty-state i {
        color: var(--secondary-color);
    }
    
    .table th {
        font-weight: 600;
        color: var(--dark-color);
        border-bottom: 2px solid var(--border-color);
    }
    
    .table td {
        vertical-align: middle;
        border-bottom: 1px solid var(--border-color);
    }
    
    .btn-group .btn {
        border-radius: 6px !important;
        margin: 0 2px;
    }
    
    .stat-card {
        border: none;
        border-radius: 16px;
        box-shadow: var(--shadow);
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    
    .stat-card:hover {
        transform: translateY(-5px);
        box-shadow: var(--shadow-lg);
    }
    
    .stat-icon {
        width: 60px;
        height: 60px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .stat-value {
        font-size: 2rem;
        font-weight: 700;
        margin: 0;
    }
    
    .stat-label {
        color: var(--secondary-color);
        font-size: 0.875rem;
        font-weight: 500;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
</style>
@endpush

@push('scripts')
<script>
    // Select all functionality
    document.getElementById('selectAll').addEventListener('change', function() {
        const checkboxes = document.querySelectorAll('.product-checkbox');
        checkboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Update selected products for bulk actions
    function updateSelectedProducts() {
        const checkboxes = document.querySelectorAll('.product-checkbox:checked');
        const productIds = Array.from(checkboxes).map(cb => cb.value);
        document.getElementById('selectedProducts').value = JSON.stringify(productIds);
    }
    
    // Add event listeners to checkboxes
    document.querySelectorAll('.product-checkbox').forEach(checkbox => {
        checkbox.addEventListener('change', updateSelectedProducts);
    });
    
    // Delete product function
    function deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/products/${productId}`;
            
            const csrfToken = document.createElement('input');
            csrfToken.type = 'hidden';
            csrfToken.name = '_token';
            csrfToken.value = '{{ csrf_token() }}';
            
            const methodField = document.createElement('input');
            methodField.type = 'hidden';
            methodField.name = '_method';
            methodField.value = 'DELETE';
            
            form.appendChild(csrfToken);
            form.appendChild(methodField);
            document.body.appendChild(form);
            form.submit();
        }
    }
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
