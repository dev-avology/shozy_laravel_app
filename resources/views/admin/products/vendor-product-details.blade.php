@extends('admin.layouts.app')

@section('title', 'Vendor Product Details - Nike Air Max 270')
@section('page-title', 'Vendor Product Management')

@section('content')
<div class="container-fluid">
    <!-- Admin Header with Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Vendor Product Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.users.index') }}">Vendors</a></li>
                                         <li class="breadcrumb-item"><a href="{{ route('admin.products.vendor-products', 1) }}">John Doe's Products</a></li>
                    <li class="breadcrumb-item active">Nike Air Max 270</li>
                </ol>
            </nav>
        </div>
        <div class="btn-toolbar">
            <div class="btn-group me-2">
                <a href="#" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Product
                </a>
                <button class="btn btn-danger" onclick="deleteProduct(1)">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
                         <a href="{{ route('admin.products.vendor-products', 1) }}" class="btn btn-secondary">
                 <i class="fas fa-arrow-left"></i> Back to Products
             </a>
        </div>
    </div>

    <!-- Main Content Row -->
    <div class="row">
        <!-- Left Column - Product Information -->
        <div class="col-lg-8">
            <!-- Product Overview Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Product Overview</h6>
                    <div class="dropdown no-arrow">
                        <a class="dropdown-toggle" href="#" role="button" id="dropdownMenuLink" data-toggle="dropdown">
                            <i class="fas fa-ellipsis-v fa-sm fa-fw text-gray-400"></i>
                        </a>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="main-product-image mb-3">
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=400&h=400&fit=crop" 
                                     alt="Nike Air Max 270" 
                                     class="img-fluid rounded border shadow-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="product-title text-dark mb-3">Nike Air Max 270 Running Shoes</h4>
                            
                            <div class="product-badges mb-3">
                                <span class="badge badge-success mr-2">Active</span>
                                <span class="badge badge-warning mr-2">Featured</span>
                                <span class="badge badge-info">3D Model</span>
                            </div>

                            <div class="product-info-table">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Price:</td>
                                        <td class="text-success font-weight-bold h5">$149.99</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Brand:</td>
                                        <td>Nike</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Category:</td>
                                        <td><span class="badge badge-light">Shoes</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Condition:</td>
                                        <td>New</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Stock:</td>
                                        <td>25 units available</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Size:</td>
                                        <td>US 9.5</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Color:</td>
                                        <td>Black/White</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Product Images Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Product Images (360° View)</h6>
                    <small class="text-muted">Images uploaded by vendor from mobile app</small>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=200&h=200&fit=crop" 
                                     alt="Front View" class="img-fluid rounded border">
                                <div class="image-label">Front View</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1549298916-b41d501d3772?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1549298916-b41d501d3772?w=200&h=200&fit=crop" 
                                     alt="Side View" class="img-fluid rounded border">
                                <div class="image-label">Side View</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=200&h=200&fit=crop" 
                                     alt="Back View" class="img-fluid rounded border">
                                <div class="image-label">Back View</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=200&h=200&fit=crop" 
                                     alt="Top View" class="img-fluid rounded border">
                                <div class="image-label">Top View</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?w=200&h=200&fit=crop" 
                                     alt="Bottom View" class="img-fluid rounded border">
                                <div class="image-label">Bottom View</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=200&h=200&fit=crop" 
                                     alt="Detail View" class="img-fluid rounded border">
                                <div class="image-label">Sole Detail</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=200&h=200&fit=crop" 
                                     alt="Logo Detail" class="img-fluid rounded border">
                                <div class="image-label">Logo Detail</div>
                            </div>
                        </div>
                        <div class="col-md-3 mb-3">
                            <div class="admin-image-item" onclick="openImageModal('https://images.unsplash.com/photo-1552346154-21d32810aba3?w=600&h=600&fit=crop')">
                                <img src="https://images.unsplash.com/photo-1552346154-21d32810aba3?w=200&h=200&fit=crop" 
                                     alt="Material Detail" class="img-fluid rounded border">
                                <div class="image-label">Material Detail</div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Right Column - Admin Controls & Details -->
        <div class="col-lg-4">
            <!-- Admin Actions Card -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cog mr-2"></i>Product Management
                    </h6>
                </div>
                <div class="card-body">
                    <div class="form-group">
                        <label class="small mb-1" for="productStatus">Status</label>
                        <select class="form-control" id="productStatus" onchange="updateStatus(this.value)">
                            <option value="active" selected>Active</option>
                            <option value="inactive">Inactive</option>
                            <option value="pending">Pending Review</option>
                            <option value="rejected">Rejected</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="featuredSwitch" checked>
                            <label class="custom-control-label small" for="featuredSwitch">Mark as Featured Product</label>
                        </div>
                    </div>
                    
                    <hr>
                    
                    <div class="d-grid gap-2">
                        <button class="btn btn-success btn-sm mb-2" onclick="approveProduct()">
                            <i class="fas fa-check mr-2"></i>Approve Product
                        </button>
                        <button class="btn btn-warning btn-sm" onclick="rejectProduct()">
                            <i class="fas fa-times mr-2"></i>Reject Product
                        </button>
                    </div>
                </div>
            </div>

            <!-- Vendor Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-store mr-2"></i>Vendor Details
                    </h6>
                </div>
                <div class="card-body">
                    <div class="text-center mb-3">
                        <img src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face" 
                             alt="Vendor Avatar" class="rounded-circle border" width="80" height="80">
                    </div>
                    
                    <div class="vendor-details">
                        <h6 class="text-dark mb-1">John Doe</h6>
                        <p class="text-muted small mb-2">Doe Sports & Footwear</p>
                        
                        <div class="contact-info">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope text-primary mr-2"></i>
                                <small>john.doe@example.com</small>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-phone text-primary mr-2"></i>
                                <small>+1 (555) 123-4567</small>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                <small>New York, NY</small>
                            </div>
                        </div>
                        
                        <div class="row text-center border-top pt-3">
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="h5 mb-0 text-primary font-weight-bold">8</div>
                                    <small class="text-muted">Products</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="h5 mb-0 text-warning font-weight-bold">4.8</div>
                                    <small class="text-muted">Rating</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="h5 mb-0 text-info font-weight-bold">3</div>
                                    <small class="text-muted">Years</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3D Model Information -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-cube mr-2"></i>3D Model
                    </h6>
                </div>
                <div class="card-body text-center">
                    <div class="mb-3">
                        <span class="badge badge-success">Available</span>
                    </div>
                    
                    <div class="model-preview mb-3">
                        <div class="p-4 border rounded bg-light">
                            <i class="fas fa-cube fa-3x text-muted mb-2"></i>
                            <p class="mb-0 small text-muted">Interactive 3D Model</p>
                        </div>
                    </div>
                    
                    <p class="small text-muted mb-3">Enhanced product visualization uploaded by vendor</p>
                    
                    <a href="#" target="_blank" class="btn btn-primary btn-sm">
                        <i class="fas fa-external-link-alt mr-2"></i>View 3D Model
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Product Description & Details -->
    <div class="row">
        <div class="col-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">
                        <i class="fas fa-align-left mr-2"></i>Product Details & Specifications
                    </h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="mb-4">
                                <h6 class="section-title">Description</h6>
                                <p class="description-text">
                                    The Nike Air Max 270 delivers visible cushioning under every step. The design draws inspiration from Air Max icons, showcasing Nike's greatest innovation with its large window and fresh array of colors. The Max Air unit provides lightweight cushioning for all-day comfort, while the mesh upper offers breathability and support.
                                </p>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="section-title">Key Features</h6>
                                <ul class="feature-list">
                                    <li>Full-length Max Air unit for maximum cushioning</li>
                                    <li>Mesh upper for breathability and support</li>
                                    <li>Rubber outsole for durability and traction</li>
                                    <li>Lightweight design for all-day comfort</li>
                                    <li>Modern silhouette with classic Air Max DNA</li>
                                    <li>Available in multiple colorways</li>
                                </ul>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="section-title">Specifications</h6>
                                <div class="specifications-list">
                                    <div class="spec-item">
                                        <span class="spec-key">Weight:</span>
                                        <span class="spec-value">12.5 oz (354g)</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-key">Heel Height:</span>
                                        <span class="spec-value">32mm</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-key">Forefoot Height:</span>
                                        <span class="spec-value">22mm</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-key">Drop:</span>
                                        <span class="spec-value">10mm</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-key">Upper Material:</span>
                                        <span class="spec-value">Mesh and Synthetic</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-key">Midsole:</span>
                                        <span class="spec-value">Max Air Unit</span>
                                    </div>
                                    <div class="spec-item">
                                        <span class="spec-key">Outsole:</span>
                                        <span class="spec-value">Rubber</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-4">
                                <h6 class="section-title">Tags</h6>
                                <div class="tags-container">
                                    <span class="tag-badge">Running</span>
                                    <span class="tag-badge">Athletic</span>
                                    <span class="tag-badge">Comfortable</span>
                                    <span class="tag-badge">Nike</span>
                                    <span class="tag-badge">Air Max</span>
                                    <span class="tag-badge">Casual</span>
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="section-title">SEO Information</h6>
                                <div class="meta-item">
                                    <label class="meta-label">Meta Title:</label>
                                    <div class="meta-value">Nike Air Max 270 Running Shoes - Premium Athletic Footwear</div>
                                </div>
                                
                                <div class="meta-item">
                                    <label class="meta-label">Meta Description:</label>
                                    <div class="meta-value">Shop Nike Air Max 270 running shoes with full-length Max Air cushioning. Lightweight, breathable design perfect for running and casual wear.</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>

<!-- Image Modal -->
<div class="modal fade" id="imageModal" tabindex="-1">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Product Image</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
            </div>
            <div class="modal-body text-center">
                <img id="modalImage" src="" alt="Product Image" class="img-fluid">
            </div>
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
                <p>Are you sure you want to delete <strong>Nike Air Max 270</strong>? This action cannot be undone.</p>
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
    /* Admin Dashboard Styling */
    .text-gray-800 {
        color: #5a5c69 !important;
    }
    
    .card.shadow {
        box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15) !important;
        border: 1px solid #e3e6f0;
    }
    
    .card-header.py-3 {
        background-color: #f8f9fc;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .font-weight-bold {
        font-weight: 700 !important;
    }
    
    .text-primary {
        color: #4e73df !important;
    }
    
    .badge-success {
        background-color: #1cc88a;
        color: white;
    }
    
    .badge-warning {
        background-color: #f6c23e;
        color: #1f2937;
    }
    
    .badge-info {
        background-color: #36b9cc;
        color: white;
    }
    
    .badge-light {
        background-color: #e9ecef;
        color: #5a5c69;
    }
    
    /* Product Image Styling */
    .admin-image-item {
        position: relative;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    
    .admin-image-item:hover {
        transform: translateY(-2px);
    }
    
    .admin-image-item img {
        width: 100%;
        height: 120px;
        object-fit: cover;
        transition: all 0.2s ease;
    }
    
    .admin-image-item:hover img {
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    .image-label {
        text-align: center;
        font-size: 0.75rem;
        color: #6c757d;
        margin-top: 0.5rem;
        font-weight: 500;
    }
    
    .feature-list {
        list-style: none;
        padding-left: 0;
    }
    
    .feature-list li {
        padding: 8px 0;
        border-bottom: 1px solid var(--border-color);
        position: relative;
        padding-left: 25px;
    }
    
    .feature-list li:before {
        content: "✓";
        position: absolute;
        left: 0;
        color: var(--success-color);
        font-weight: bold;
    }
    
    .vendor-avatar img {
        border: 3px solid var(--primary-color);
    }
    
    .vendor-name {
        color: var(--dark-color);
        font-weight: 600;
    }
    
    .vendor-contact p {
        font-size: 0.9rem;
    }
    
    .stat-item h6 {
        color: var(--primary-color);
        font-weight: 700;
    }
    
    .model-placeholder {
        text-align: center;
        padding: 2rem;
        border: 2px dashed var(--border-color);
        border-radius: 8px;
        background: var(--light-bg);
    }
    
    .status-item label {
        font-weight: 600;
        color: var(--dark-color);
    }
    
    .table td {
        padding: 8px 0;
        border: none;
    }
    
    .table td:first-child {
        font-weight: 600;
        color: var(--dark-color);
        width: 40%;
    }
    
    .section-title {
        color: var(--dark-color);
        font-weight: 600;
        margin-bottom: 15px;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 8px;
    }
    
    .description-text {
        line-height: 1.6;
        color: var(--dark-color);
        font-size: 1rem;
    }
    
    .specifications-list {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }
    
    .spec-item {
        display: flex;
        justify-content: space-between;
        padding: 10px;
        background: var(--light-color);
        border-radius: 8px;
    }
    
    .spec-key {
        font-weight: 600;
        color: var(--dark-color);
    }
    
    .spec-value {
        color: var(--secondary-color);
    }
    
    .tags-container {
        display: flex;
        flex-wrap: wrap;
        gap: 8px;
    }
    
    .tag-badge {
        background: var(--primary-color);
        color: white;
        padding: 6px 12px;
        border-radius: 16px;
        font-size: 0.875rem;
        font-weight: 500;
    }
    
    .meta-item {
        margin-bottom: 15px;
    }
    
    .meta-label {
        font-weight: 600;
        color: var(--secondary-color);
        font-size: 0.875rem;
        margin-bottom: 5px;
    }
    
    .meta-value {
        color: var(--dark-color);
        font-size: 0.875rem;
        line-height: 1.4;
    }
    
    .breadcrumb {
        background: var(--light-color);
        border-radius: 8px;
        padding: 12px 20px;
    }
    
    .breadcrumb-item a {
        color: var(--primary-color);
        text-decoration: none;
    }
    
    .breadcrumb-item.active {
        color: var(--secondary-color);
    }
</style>
@endpush

@push('scripts')
<script>
    function openImageModal(imageSrc) {
        document.getElementById('modalImage').src = imageSrc;
        new bootstrap.Modal(document.getElementById('imageModal')).show();
    }
    
    function updateStatus(status) {
        // Update product status via AJAX
        console.log('Updating status to:', status);
        // Add your AJAX call here
    }
    
    function approveProduct() {
        if (confirm('Are you sure you want to approve this product?')) {
            // Approve product via AJAX
            console.log('Product approved');
            // Add your AJAX call here
        }
    }
    
    function rejectProduct() {
        if (confirm('Are you sure you want to reject this product?')) {
            // Reject product via AJAX
            console.log('Product rejected');
            // Add your AJAX call here
        }
    }
    
    function deleteProduct(productId) {
        if (confirm('Are you sure you want to delete this product?')) {
            alert('Product ' + productId + ' would be deleted (demo mode)');
        }
    }
</script>
@endpush
