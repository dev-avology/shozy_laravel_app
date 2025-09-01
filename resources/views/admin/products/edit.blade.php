@extends('admin.layouts.app')

@section('title', 'Edit Product')
@section('page-title', 'Edit Product')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-4">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.products.index') }}">Products</a></li>
            <li class="breadcrumb-item active">Edit Product</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-edit me-2"></i>Edit Product
                    </h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.products.update', $product->id) }}" method="POST">
                        @csrf
                        @method('PUT')
                        
                        <!-- Basic Information Section -->
                        <div class="row mb-4">
                            <div class="col-12">
                                <h6 class="section-title mb-3">
                                    <i class="fas fa-info-circle me-2"></i>Basic Information
                                </h6>
                                
                                <div class="row">
                                    <div class="col-md-6 mb-3">
                                        <label for="name" class="form-label">Product Name *</label>
                                        <input type="text" class="form-control" id="name" name="name" 
                                               value="{{ $product->name }}" required>
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="vendor_id" class="form-label">Vendor *</label>
                                        <select class="form-select" id="vendor_id" name="vendor_id" required>
                                            <option value="">Select Vendor</option>
                                            @foreach($vendors as $vendor)
                                                <option value="{{ $vendor->id }}" {{ $product->vendor_id == $vendor->id ? 'selected' : '' }}>
                                                    {{ $vendor->name }} ({{ $vendor->company }})
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    
                                    <div class="col-12 mb-3">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="4">{{ $product->description }}</textarea>
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
                                        @foreach($categories as $category)
                                        <div class="col-md-3 mb-2">
                                            <div class="category-option {{ $product->category_id === $category->id ? 'active' : '' }}" 
                                                 data-category="{{ $category->id }}">
                                                <i class="fas fa-folder fa-2x mb-2"></i>
                                                <span>{{ $category->name }}</span>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                
                                <input type="hidden" name="category_id" id="selected_category" value="{{ $product->category_id }}" required>
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
                                               value="{{ $product->brand }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="size" class="form-label">Size</label>
                                        <input type="text" class="form-control" id="size" name="size" 
                                               value="{{ $product->size }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="material" class="form-label">Material</label>
                                        <input type="text" class="form-control" id="material" name="material" 
                                               value="{{ $product->material }}">
                                    </div>
                                    
                                    <div class="col-md-6 mb-3">
                                        <label for="color" class="form-label">Color</label>
                                        <input type="text" class="form-control" id="color" name="color" 
                                               value="{{ $product->color }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Additional Details -->
                        <div class="row mb-4">
                            <div class="col-md-6 mb-3">
                                <label for="quantity" class="form-label">Quantity Available</label>
                                <input type="number" class="form-control" id="quantity" name="quantity" 
                                       value="{{ $product->quantity }}" min="1" required>
                            </div>
                            
                            <div class="col-md-6 mb-3">
                                <label for="price" class="form-label">Price *</label>
                                <div class="input-group">
                                    <span class="input-group-text">$</span>
                                    <input type="number" class="form-control" id="price" name="price" 
                                           value="{{ $product->price }}" step="0.01" min="0" required>
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
                                           value="{{ $product->model_url }}" placeholder="https://.../shoe.glb">
                                </div>
                            </div>
                        </div>

                        <!-- Submit Buttons -->
                        <div class="row">
                            <div class="col-12">
                                <div class="d-flex gap-2">
                                    <button type="submit" class="btn btn-primary btn-lg">
                                        <i class="fas fa-save me-2"></i>Update Product
                                    </button>
                                    <a href="{{ route('admin.products.show', $product->id) }}" class="btn btn-secondary btn-lg">
                                        <i class="fas fa-eye me-2"></i>View Product
                                    </a>
                                    <a href="{{ route('admin.products.index') }}" class="btn btn-outline-secondary btn-lg">
                                        <i class="fas fa-arrow-left me-2"></i>Back to Products
                                    </a>
                                </div>
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
    // Category selection
    document.querySelectorAll('.category-option').forEach(option => {
        option.addEventListener('click', function() {
            document.querySelectorAll('.category-option').forEach(opt => opt.classList.remove('active'));
            this.classList.add('active');
            document.getElementById('selected_category').value = this.dataset.category;
        });
    });
</script>
@endpush
