@extends('admin.layouts.app')

@section('title', 'Vendor Products - ' . $vendor->name)
@section('page-title', 'Vendor Products')

@section('content')
<div class="container-fluid">
    <!-- Vendor Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="card-title mb-2">{{ $vendor->name }}'s Products</h1>
                            <div class="vendor-info">
                                <p class="text-muted mb-1">
                                    <i class="fas fa-envelope me-2"></i>{{ $vendor->email }}
                                </p>
                                @if($vendor->phone)
                                <p class="text-muted mb-1">
                                    <i class="fas fa-phone me-2"></i>{{ $vendor->phone }}
                                </p>
                                @endif
                                <p class="text-muted mb-0">
                                    <i class="fas fa-calendar me-2"></i>Member since {{ $vendor->created_at->format('M Y') }}
                                </p>
                            </div>
                        </div>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.products.index') }}" class="btn btn-outline-primary">
                                <i class="fas fa-arrow-left me-2"></i>Back to All Products
                            </a>
                            <a href="{{ route('admin.users.edit', $vendor) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>Edit Vendor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendor Statistics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Total Products</h6>
                            <h2 class="stat-value text-primary">{{ $products->total() }}</h2>
                        </div>
                        <div class="stat-icon bg-primary">
                            <i class="fas fa-box text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Active Products</h6>
                            <h2 class="stat-value text-success">{{ $vendor->products()->where('status', 'active')->count() }}</h2>
                        </div>
                        <div class="stat-icon bg-success">
                            <i class="fas fa-check-circle text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Pending Review</h6>
                            <h2 class="stat-value text-warning">{{ $vendor->products()->where('status', 'pending')->count() }}</h2>
                        </div>
                        <div class="stat-icon bg-warning">
                            <i class="fas fa-clock text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card stat-card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="stat-label">Featured Products</h6>
                            <h2 class="stat-value text-info">{{ $vendor->products()->where('is_featured', true)->count() }}</h2>
                        </div>
                        <div class="stat-icon bg-info">
                            <i class="fas fa-star text-white"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Products Table -->
    <div class="card">
        <div class="card-header">
            <div class="d-flex justify-content-between align-items-center">
                <h5 class="card-title mb-0">
                    <i class="fas fa-list me-2"></i>Products by {{ $vendor->name }}
                    <span class="badge bg-secondary ms-2">{{ $products->total() }} products</span>
                </h5>
                <div class="d-flex gap-2">
                    <span class="text-muted">Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results</span>
                </div>
            </div>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th width="80">Image</th>
                            <th>Product Details</th>
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
                                @if($product->mainImage)
                                    <img src="{{ $product->mainImage->thumbnail_url }}" 
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
                                    <small class="text-muted">SKU: {{ $product->sku ?? 'N/A' }}</small>
                                </div>
                            </td>
                            <td>
                                <span class="category-badge">{{ $product->category->name ?? 'Uncategorized' }}</span>
                            </td>
                            <td>
                                <span class="price-amount">{{ $product->formatted_price }}</span>
                            </td>
                            <td>
                                {!! $product->status_badge !!}
                            </td>
                            <td>
                                <div class="feature-badges">
                                    {!! $product->featured_badge !!}
                                    {!! $product->three_d_badge !!}
                                </div>
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $product->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.products.show', $product) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.products.edit', $product) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        
                        <!-- Image Modal for each product -->
                        @if($product->mainImage)
                        <div class="modal fade" id="imageModal{{ $product->id }}" tabindex="-1">
                            <div class="modal-dialog modal-lg">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">{{ $product->name }}</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
                                    </div>
                                    <div class="modal-body text-center">
                                        <img src="{{ $product->mainImage->url }}" 
                                             alt="{{ $product->name }}" 
                                             class="img-fluid">
                                    </div>
                                </div>
                            </div>
                        </div>
                        @endif
                        
                        @empty
                        <tr>
                            <td colspan="8" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-box fa-3x text-muted mb-3"></i>
                                    <h5>No products found for this vendor</h5>
                                    <p class="text-muted">{{ $vendor->name }} hasn't added any products yet.</p>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($products->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $products->firstItem() ?? 0 }} to {{ $products->lastItem() ?? 0 }} of {{ $products->total() }} results
                    </small>
                </div>
                <div>
                    {{ $products->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
        @endif
    </div>
</div>
@endsection

@push('styles')
<style>
    .product-thumbnail {
        width: 60px;
        height: 60px;
        object-fit: cover;
        border-radius: 8px;
        cursor: pointer;
        transition: transform 0.2s ease;
    }
    
    .product-thumbnail:hover {
        transform: scale(1.05);
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
    
    .vendor-info p {
        margin-bottom: 0.5rem;
    }
    
    .vendor-info i {
        width: 16px;
        color: var(--primary-color);
    }
    
    .empty-state {
        padding: 2rem;
    }
    
    .empty-state i {
        color: var(--secondary-color);
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
