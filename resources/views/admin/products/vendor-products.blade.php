@extends('admin.layouts.app')

@section('title', 'Vendor Products - John Doe')
@section('page-title', 'Vendor Products')

@section('content')
<div class="container-fluid">
    <!-- Vendor Header -->
    <div class="row mb-3">
        <div class="col-12">
            <div class="card">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="mb-1">John Doe's Products</h4>
                            <div class="vendor-info">
                                <p class="text-muted mb-1">
                                    <i class="fas fa-envelope me-2"></i>john.doe@example.com
                                </p>
                                <p class="text-muted mb-1">
                                    <i class="fas fa-phone me-2"></i>+1 (555) 123-4567
                                </p>
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar me-2"></i>Member since Jan 2024
                                </p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.users.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to Vendors
                            </a>
                            <a href="#" class="btn btn-outline-secondary">
                                <i class="fas fa-user me-2"></i>Vendor Details
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-3">
        <div class="col-xl-3 col-md-6 mb-3">
            <div class="card stat-card">
                <div class="card-body py-3">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Total Products</h6>
                            <h3 class="stat-value text-primary">8</h3>
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
                            <h3 class="stat-value text-success">6</h3>
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
                            <h3 class="stat-value text-warning">2</h3>
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
                            <h6 class="stat-label">Featured Products</h6>
                            <h3 class="stat-value text-info">3</h3>
                        </div>
                        <div class="stat-icon bg-info">
                            <i class="fas fa-star text-white"></i>
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
                    <a href="#" class="btn btn-info btn-sm">
                        <i class="fas fa-download me-1"></i>Export
                    </a>
                </div>
            </div>
        </div>
        
        <div class="collapse show" id="filtersCollapse">
            <div class="card-body py-3">
                <form method="GET" action="#" class="row g-2">
                    <div class="col-md-3">
                        <label for="search" class="form-label small">Search</label>
                        <input type="text" class="form-control form-control-sm" id="search" name="search" 
                               placeholder="Product name, SKU, description...">
                    </div>
                    
                    <div class="col-md-2">
                        <label for="category" class="form-label small">Category</label>
                        <select class="form-select form-select-sm" id="category" name="category">
                            <option value="">All Categories</option>
                            <option value="shoes">Shoes</option>
                            <option value="clothing">Clothing</option>
                            <option value="accessories">Accessories</option>
                        </select>
                    </div>
                    
                    <div class="col-md-2">
                        <label for="status" class="form-label small">Status</label>
                        <select class="form-select form-select-sm" id="status" name="status">
                            <option value="">All Statuses</option>
                            <option value="active">Active</option>
                            <option value="pending">Pending</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    
                    <div class="col-md-3">
                        <label class="form-label small">Date Range</label>
                        <div class="d-flex gap-1">
                            <input type="date" class="form-control form-control-sm" name="date_from">
                            <input type="date" class="form-control form-control-sm" name="date_to">
                        </div>
                    </div>
                    
                    <div class="col-12">
                        <div class="d-flex gap-2">
                            <button type="submit" class="btn btn-primary btn-sm">
                                <i class="fas fa-search me-1"></i>Apply
                            </button>
                            <a href="#" class="btn btn-outline-secondary btn-sm">
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
                    <i class="fas fa-list me-2"></i>Products by John Doe
                    <span class="badge bg-secondary ms-2">8 products</span>
                </h6>
                <div class="d-flex gap-2">
                    <span class="text-muted small">Showing 8 results</span>
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
                            <th>Product Name</th>
                            <th>Category</th>
                            <th>Price</th>
                            <th>Status</th>
                            <th>Features</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @for($i = 1; $i <= 8; $i++)
                        <tr>
                            <td>
                                <input type="checkbox" class="form-check-input product-checkbox" value="{{ $i }}">
                            </td>
                            <td>
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150&h=150&fit=crop" 
                                     alt="Product {{ $i }}" 
                                     class="product-thumbnail"
                                     data-bs-toggle="modal" 
                                     data-bs-target="#imageModal{{ $i }}">
                            </td>
                            <td>
                                <div class="product-info">
                                    <h6 class="product-name mb-1">Nike Air Max {{ $i * 10 }}</h6>
                                    {{-- <p class="product-description mb-1 text-muted">
                                        High-quality running shoes with advanced cushioning technology and modern design.
                                    </p>
                                    <small class="text-muted">SKU: NAM{{ $i * 10 }}</small> --}}
                                </div>
                            </td>
                            <td>
                                <span class="category-badge">Shoes</span>
                            </td>
                            <td>
                                <span class="price-amount">${{ 99 + ($i * 10) }}.99</span>
                            </td>
                            <td>
                                @if($i <= 6)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-warning">Pending</span>
                                @endif
                            </td>
                            <td>
                                <div class="feature-badges">
                                    @if($i <= 3)
                                        <span class="badge bg-warning mb-1">Featured</span>
                                    @endif
                                    @if($i % 2 == 0)
                                        <span class="badge bg-info">3D Model</span>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ date('M d, Y', strtotime('-' . (8 - $i) . ' days')) }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.vendor-product-details', ['vendor' => 1, 'product' => $i]) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="#" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Delete"
                                            onclick="deleteProduct({{ $i }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Image Modal for each product -->
                        <div class="modal fade" id="imageModal{{ $i }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Nike Air Max {{ $i * 10 }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=400&fit=crop" 
                                             alt="Nike Air Max {{ $i * 10 }}" 
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endfor
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="card-footer py-2">
            <div class="d-flex justify-content-between align-items-center">
                <div class="text-muted small">
                    Showing 1-8 of 8 products
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
            <form action="#" method="POST">
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
    
    .product-name {
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
    }
    
    .product-description {
        font-size: 0.875rem;
        line-height: 1.4;
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

    .vendor-info p {
        margin-bottom: 0.5rem;
    }
    
    .vendor-info i {
        width: 16px;
        color: var(--primary-color);
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
            alert('Product ' + productId + ' would be deleted (demo mode)');
        }
    }
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush