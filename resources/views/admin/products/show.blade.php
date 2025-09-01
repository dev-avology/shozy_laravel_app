@extends('admin.layouts.app')

@section('title', 'Product Details')
@section('page-title', 'Product Management')

@section('content')
<div class="container-fluid">
    <!-- Admin Header with Navigation -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Product Details</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
                    <li class="breadcrumb-item active">{{ $product->name }}</li>
                </ol>
            </nav>
        </div>
        <div class="btn-toolbar">
            <div class="btn-group me-2">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">
                    <i class="fas fa-edit"></i> Edit Product
                </a>
                <button class="btn btn-danger" onclick="deleteProduct({{ $product->id }})">
                    <i class="fas fa-trash"></i> Delete
                </button>
            </div>
            <a href="{{ route('admin.products.index') }}" class="btn btn-secondary">
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
                                     alt="{{ $product->name }}" 
                                     class="img-fluid rounded border shadow-sm">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h4 class="product-title text-dark mb-3">{{ $product->name }}</h4>
                            
                            <div class="product-badges mb-3">
                                <span class="badge badge-{{ $product->status === 'active' ? 'success' : ($product->status === 'pending' ? 'warning' : 'danger') }} mr-2">
                                    {{ ucfirst($product->status) }}
                                </span>
                                @if($product->is_featured)
                                    <span class="badge badge-warning mr-2">Featured</span>
                                @endif
                                @if($product->has_3d_model)
                                    <span class="badge badge-info">3D Model</span>
                                @endif
                            </div>

                            <div class="product-info-table">
                                <table class="table table-borderless">
                                    <tr>
                                        <td class="font-weight-bold">Price:</td>
                                        <td class="text-success font-weight-bold h5">${{ number_format($product->price, 2) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Brand:</td>
                                        <td>{{ $product->brand }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Category:</td>
                                        <td><span class="badge badge-light">{{ $product->category->name }}</span></td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Condition:</td>
                                        <td>{{ ucfirst($product->condition) }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Stock:</td>
                                        <td>{{ $product->quantity }} units available</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Size:</td>
                                        <td>{{ $product->size }}</td>
                                    </tr>
                                    <tr>
                                        <td class="font-weight-bold">Color:</td>
                                        <td>{{ $product->color }}</td>
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
                            <option value="active" {{ $product->status === 'active' ? 'selected' : '' }}>Active</option>
                            <option value="inactive" {{ $product->status === 'inactive' ? 'selected' : '' }}>Inactive</option>
                            <option value="pending" {{ $product->status === 'pending' ? 'selected' : '' }}>Pending Review</option>
                            <option value="rejected" {{ $product->status === 'rejected' ? 'selected' : '' }}>Rejected</option>
                        </select>
                    </div>
                    
                    <div class="form-group">
                        <div class="custom-control custom-switch">
                            <input type="checkbox" class="custom-control-input" id="featuredSwitch" {{ $product->is_featured ? 'checked' : '' }}>
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
                        <h6 class="text-dark mb-1">{{ $product->vendor->name }}</h6>
                        <p class="text-muted small mb-2">{{ $product->vendor->company }}</p>
                        
                        <div class="contact-info">
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-envelope text-primary mr-2"></i>
                                <small>{{ $product->vendor->email }}</small>
                            </div>
                            <div class="d-flex align-items-center mb-2">
                                <i class="fas fa-phone text-primary mr-2"></i>
                                <small>{{ $product->vendor->phone }}</small>
                            </div>
                            <div class="d-flex align-items-center mb-3">
                                <i class="fas fa-map-marker-alt text-primary mr-2"></i>
                                <small>{{ $product->vendor->location }}</small>
                            </div>
                        </div>
                        
                        <div class="row text-center border-top pt-3">
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="h5 mb-0 text-primary font-weight-bold">{{ $product->vendor->total_products }}</div>
                                    <small class="text-muted">Products</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="h5 mb-0 text-warning font-weight-bold">{{ $product->vendor->rating }}</div>
                                    <small class="text-muted">Rating</small>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="stat-item">
                                    <div class="h5 mb-0 text-info font-weight-bold">{{ $product->vendor->years_active }}</div>
                                    <small class="text-muted">Years</small>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- 3D Model Information -->
            @if($product->has_3d_model)
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
                    
                    <a href="{{ $product->model_url }}" target="_blank" class="btn btn-primary btn-sm">
                        <i class="fas fa-external-link-alt mr-2"></i>View 3D Model
                    </a>
                </div>
            </div>
            @endif
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
                                    {{ $product->description }}
                                </p>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="section-title">Key Features</h6>
                                <ul class="feature-list">
                                    @foreach($product->features as $feature)
                                    <li>{{ $feature }}</li>
                                    @endforeach
                                </ul>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="section-title">Specifications</h6>
                                <div class="specifications-list">
                                    @foreach($product->specifications as $key => $value)
                                    <div class="spec-item">
                                        <span class="spec-key">{{ $key }}:</span>
                                        <span class="spec-value">{{ $value }}</span>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="mb-4">
                                <h6 class="section-title">Tags</h6>
                                <div class="tags-container">
                                    @foreach($product->tags as $tag)
                                    <span class="tag-badge">{{ $tag }}</span>
                                    @endforeach
                                </div>
                            </div>
                            
                            <div class="mb-4">
                                <h6 class="section-title">SEO Information</h6>
                                <div class="meta-item">
                                    <label class="meta-label">Meta Title:</label>
                                    <div class="meta-value">{{ $product->meta_title }}</div>
                                </div>
                                
                                <div class="meta-item">
                                    <label class="meta-label">Meta Description:</label>
                                    <div class="meta-value">{{ $product->meta_description }}</div>
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
                <p>Are you sure you want to delete <strong>{{ $product->name }}</strong>? This action cannot be undone.</p>
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
</script>
@endpush
