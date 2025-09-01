@extends('admin.layouts.app')

@section('title', 'Add New Product')
@section('page-title', 'Add New Product')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-plus me-2"></i>Create New Product
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        
                        <!-- Product Images (360° View) Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-images me-2"></i>Product Images (360° View)
                                </h6>
                                <p class="text-muted mb-3">
                                    Upload high-quality images with white background and proper angles for the best customer experience
                                </p>
                                
                                <div class="image-upload-area mb-3">
                                    <div class="upload-box" onclick="document.getElementById('productImages').click()">
                                        <i class="fas fa-plus fa-2x text-muted"></i>
                                        <p class="mb-0 mt-2">Add Image</p>
                                        <small class="text-muted">0/8 images</small>
                                    </div>
                                </div>
                                
                                <div class="image-guidelines">
                                    <h6 class="mb-2">Image Guidelines:</h6>
                                    <ul class="list-unstyled">
                                        <li class="mb-1">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            High quality (minimum 800x800px)
                                        </li>
                                        <li class="mb-1">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            White or neutral background
                                        </li>
                                        <li class="mb-1">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Multiple angles for 360° view
                                        </li>
                                        <li class="mb-1">
                                            <i class="fas fa-check-circle text-success me-2"></i>
                                            Good lighting and clear details
                                        </li>
                                        <li class="mb-1">
                                            <i class="fas fa-info-circle text-info me-2"></i>
                                            We check border whiteness ≥ 80% and resolution ≥ 800x800
                                        </li>
                                    </ul>
                                </div>
                                
                                <input type="file" id="productImages" name="images[]" multiple accept="image/*" style="display: none;">
                            </div>
                        </div>

                        <!-- Basic Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Basic Information
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="product_name" class="form-label">Product Name *</label>
                                        <input type="text" class="form-control" id="product_name" name="name" 
                                               placeholder="Enter product name" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="vendor_id" class="form-label">Vendor *</label>
                                        <select class="form-select" id="vendor_id" name="vendor_id" required>
                                            <option value="">Select Vendor</option>
                                            <option value="1">John Doe (Shoe Store)</option>
                                            <option value="2">Jane Smith (Fashion Boutique)</option>
                                            <option value="3">Mike Johnson (Accessories Shop)</option>
                                        </select>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4" 
                                                  placeholder="Describe your product in detail"></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Category Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-folder me-2"></i>Category *
                                </h6>
                                
                                <div class="category-options">
                                    <div class="row">
                                        <div class="col-md-3 mb-2">
                                            <div class="category-option" data-category="shoes">
                                                <i class="fas fa-shoe-prints fa-2x mb-2"></i>
                                                <span>Shoes</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="category-option" data-category="accessories">
                                                <i class="fas fa-shopping-bag fa-2x mb-2"></i>
                                                <span>Accessories</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="category-option" data-category="clothing">
                                                <i class="fas fa-tshirt fa-2x mb-2"></i>
                                                <span>Clothing</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="category-option" data-category="bags">
                                                <i class="fas fa-handbag fa-2x mb-2"></i>
                                                <span>Bags & Wallets</span>
                                            </div>
                                        </div>
                                        <div class="col-md-3 mb-2">
                                            <div class="category-option" data-category="jewelry">
                                                <i class="fas fa-gem fa-2x mb-2"></i>
                                                <span>Jewelry</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="category_id" id="selected_category" required>
                            </div>
                        </div>

                        <!-- Product Details Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-tags me-2"></i>Product Details
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="brand" class="form-label">Brand</label>
                                        <input type="text" class="form-control" id="brand" name="brand" 
                                               placeholder="Brand name">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="size" class="form-label">Size</label>
                                        <input type="text" class="form-control" id="size" name="size" 
                                               placeholder="e.g., 42, M, L">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="material" class="form-label">Material</label>
                                        <input type="text" class="form-control" id="material" name="material" 
                                               placeholder="e.g., Leather, Canvas">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="color" class="form-label">Color</label>
                                        <input type="text" class="form-control" id="color" name="color" 
                                               placeholder="e.g., Black, Brown">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Condition Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-star me-2"></i>Condition
                                </h6>
                                
                                <div class="condition-options">
                                    <div class="row">
                                        <div class="col-md-4 mb-2">
                                            <div class="condition-option active" data-condition="new">
                                                <h6 class="mb-1">New</h6>
                                                <small class="text-muted">Never used, original packaging</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="condition-option" data-condition="like_new">
                                                <h6 class="mb-1">Like New</h6>
                                                <small class="text-muted">Used once or twice, excellent condition</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="condition-option" data-condition="good">
                                                <h6 class="mb-1">Good</h6>
                                                <small class="text-muted">Used but well maintained</small>
                                            </div>
                                        </div>
                                        <div class="col-md-4 mb-2">
                                            <div class="condition-option" data-condition="fair">
                                                <h6 class="mb-1">Fair</h6>
                                                <small class="text-muted">Some wear but functional</small>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                
                                <input type="hidden" name="condition" id="selected_condition" value="new" required>
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantity Available</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" 
                                       placeholder="Number of items available" min="1" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price" 
                                           placeholder="0.00" step="0.01" min="0" required>
                                </div>
                            </div>
                        </div>

                        <!-- 3D Model Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-cube me-2"></i>3D Model (Optional)
                                </h6>
                                <p class="text-muted mb-3">
                                    Provide a URL to a .glb/.gltf model for interactive 3D view
                                </p>
                                
                                <div class="mb-3">
                                    <label for="model_url" class="form-label">Model URL</label>
                                    <input type="url" class="form-control" id="model_url" name="model_url" 
                                           placeholder="https://.../shoe.glb">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Button -->
                        <div class="row">
                            <div class="col-12">
                                <button type="submit" class="btn btn-primary btn-lg w-100">
                                    <i class="fas fa-cloud-upload-alt me-2"></i>Upload Product
                                </button>
                                <p class="text-muted text-center mt-2 mb-0">
                                    Your product will be reviewed within 24 hours before being published
                                </p>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .section-title {
        color: var(--dark-color);
        font-weight: 600;
        border-bottom: 2px solid var(--primary-color);
        padding-bottom: 8px;
    }
    
    .image-upload-area {
        border: 2px dashed var(--border-color);
        border-radius: 12px;
        padding: 2rem;
        text-align: center;
        background: var(--light-bg);
        transition: all 0.3s ease;
    }
    
    .image-upload-area:hover {
        border-color: var(--primary-color);
        background: var(--primary-light);
    }
    
    .upload-box {
        cursor: pointer;
        padding: 2rem;
        border-radius: 8px;
        transition: all 0.3s ease;
    }
    
    .upload-box:hover {
        background: var(--white);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .image-guidelines ul li {
        padding: 4px 0;
        font-size: 0.9rem;
    }
    
    .category-options {
        margin-bottom: 1rem;
    }
    
    .category-option {
        text-align: center;
        padding: 1.5rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--white);
    }
    
    .category-option:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.1);
    }
    
    .category-option.active {
        border-color: var(--primary-color);
        background: var(--primary-light);
        color: var(--primary-color);
    }
    
    .category-option i {
        color: var(--secondary-color);
        margin-bottom: 0.5rem;
    }
    
    .condition-options {
        margin-bottom: 1rem;
    }
    
    .condition-option {
        text-align: center;
        padding: 1.5rem 1rem;
        border: 2px solid var(--border-color);
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: var(--white);
    }
    
    .condition-option:hover {
        border-color: var(--primary-color);
        transform: translateY(-2px);
    }
    
    .condition-option.active {
        border-color: var(--primary-color);
        background: var(--primary-color);
        color: var(--white);
    }
    
    .condition-option h6 {
        margin-bottom: 0.5rem;
        font-weight: 600;
    }
    
    .form-control, .form-select {
        border: 2px solid var(--border-color);
        border-radius: 8px;
        padding: 0.75rem 1rem;
        transition: all 0.3s ease;
    }
    
    .form-control:focus, .form-select:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 0.2rem rgba(var(--primary-rgb), 0.25);
    }
    
    .btn-primary {
        background: var(--primary-color);
        border: none;
        border-radius: 12px;
        padding: 1rem 2rem;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        background: var(--primary-dark);
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(var(--primary-rgb), 0.3);
    }
</style>
@endpush

@push('scripts')
<script>
    // Category selection
    document.querySelectorAll('.category-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.category-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('selected_category').value = this.dataset.category;
        });
    });
    
    // Condition selection
    document.querySelectorAll('.condition-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.condition-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('selected_condition').value = this.dataset.condition;
        });
    });
    
    // Image upload preview
    document.getElementById('productImages').addEventListener('change', function(e) {
        const files = e.target.files;
        const uploadBox = document.querySelector('.upload-box');
        
        if (files.length > 0) {
            uploadBox.innerHTML = `
                <i class="fas fa-check-circle text-success fa-2x mb-2"></i>
                <p class="mb-0">${files.length} image(s) selected</p>
                <small class="text-muted">${files.length}/8 images</small>
            `;
        }
    });
</script>
@endpush
