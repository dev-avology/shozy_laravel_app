@extends('admin.layouts.app')

@section('title', 'Category Details')
@section('page-title', 'Category Details')

@section('content')
<div class="container-fluid">
    <!-- Breadcrumb -->
    <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none">
                    <i class="fas fa-home me-1"></i>Dashboard
                </a>
            </li>
            <li class="breadcrumb-item">
                <a href="{{ route('admin.categories.index') }}" class="text-decoration-none">
                    <i class="fas fa-tags me-1"></i>Categories
                </a>
            </li>
            <li class="breadcrumb-item active" aria-current="page">{{ $category->name }}</li>
        </ol>
    </nav>

    <div class="row">
        <!-- Category Information -->
        <div class="col-lg-8">
            <div class="card mb-4">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-info-circle me-2"></i>Category Information
                        </h5>
                        <div class="d-flex gap-2">
                            <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning btn-sm">
                                <i class="fas fa-edit me-1"></i>Edit
                            </a>
                            <a href="{{ route('admin.categories.index') }}" class="btn btn-outline-secondary btn-sm">
                                <i class="fas fa-arrow-left me-1"></i>Back
                            </a>
                        </div>
                    </div>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="category-details">
                                <div class="detail-item mb-3">
                                    <label class="detail-label">Category Name:</label>
                                    <span class="detail-value">{{ $category->name }}</span>
                                </div>
                                
                                <div class="detail-item mb-3">
                                    <label class="detail-label">Slug:</label>
                                    <span class="detail-value text-muted">{{ $category->slug }}</span>
                                </div>
                                
                                <div class="detail-item mb-3">
                                    <label class="detail-label">Description:</label>
                                    <p class="detail-description">{{ $category->description }}</p>
                                </div>
                                
                                <div class="detail-item mb-3">
                                    <label class="detail-label">Parent Category:</label>
                                    <span class="detail-value">
                                        @if($category->parent_name)
                                            <span class="badge bg-info">{{ $category->parent_name }}</span>
                                        @else
                                            <span class="text-muted">No Parent (Top Level)</span>
                                        @endif
                                    </span>
                                </div>
                                
                                <div class="detail-item mb-3">
                                    <label class="detail-label">Sort Order:</label>
                                    <span class="detail-value">{{ $category->sort_order }}</span>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-4">
                            <div class="category-status">
                                <div class="status-card mb-3">
                                    <div class="status-header">
                                        <i class="fas fa-toggle-on me-2"></i>Status
                                    </div>
                                    <div class="status-body">
                                        <span class="badge bg-{{ $category->status === 'active' ? 'success' : 'danger' }} fs-6">
                                            {{ ucfirst($category->status) }}
                                        </span>
                                    </div>
                                </div>
                                
                                <div class="status-card mb-3">
                                    <div class="status-header">
                                        <i class="fas fa-star me-2"></i>Featured
                                    </div>
                                    <div class="status-body">
                                        @if($category->is_featured)
                                            <span class="badge bg-warning fs-6">Featured</span>
                                        @else
                                            <span class="badge bg-secondary fs-6">Not Featured</span>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="status-card">
                                    <div class="status-header">
                                        <i class="fas fa-box me-2"></i>Products Count
                                    </div>
                                    <div class="status-body">
                                        <span class="badge bg-primary fs-6">{{ $category->product_count }} Products</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <!-- SEO Information -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-search me-2"></i>SEO Information
                    </h5>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="detail-label">Meta Title:</label>
                            <p class="detail-value">{{ $category->meta_title ?: 'Not set' }}</p>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <label class="detail-label">Meta Description:</label>
                            <p class="detail-value">{{ $category->meta_description ?: 'Not set' }}</p>
                        </div>
                    </div>
                    
                    @if($category->meta_title && $category->meta_description)
                        <div class="seo-preview mt-3">
                            <h6 class="text-muted mb-2">Search Result Preview:</h6>
                            <div class="preview-box">
                                <div class="preview-title">{{ $category->meta_title }}</div>
                                <div class="preview-url">{{ config('app.url') }}/categories/{{ $category->slug }}</div>
                                <div class="preview-description">{{ $category->meta_description }}</div>
                            </div>
                        </div>
                    @endif
                </div>
            </div>
            
            <!-- Category Analytics -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-line me-2"></i>Category Analytics
                    </h5>
                </div>
                
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="analytics-card bg-primary text-white">
                                <div class="analytics-icon">
                                    <i class="fas fa-box"></i>
                                </div>
                                <div class="analytics-content">
                                    <div class="analytics-value">{{ $category->product_count }}</div>
                                    <div class="analytics-label">Total Products</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="analytics-card bg-success text-white">
                                <div class="analytics-icon">
                                    <i class="fas fa-chart-bar"></i>
                                </div>
                                <div class="analytics-content">
                                    <div class="analytics-value">{{ $category->sort_order }}</div>
                                    <div class="analytics-label">Display Order</div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <div class="analytics-card bg-info text-white">
                                <div class="analytics-icon">
                                    <i class="fas fa-calendar"></i>
                                </div>
                                <div class="analytics-content">
                                    <div class="analytics-value">{{ $category->created_at->format('M Y') }}</div>
                                    <div class="analytics-label">Created</div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="col-md-6 mb-3">
                            <div class="analytics-card bg-warning text-white">
                                <div class="analytics-icon">
                                    <i class="fas fa-clock"></i>
                                </div>
                                <div class="analytics-content">
                                    <div class="analytics-value">{{ $category->updated_at->format('M Y') }}</div>
                                    <div class="analytics-label">Last Updated</div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        
        <!-- Sidebar -->
        <div class="col-lg-4">
            <!-- Category Statistics -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-bar me-2"></i>Statistics
                    </h5>
                </div>
                
                <div class="card-body">
                    <div class="stat-item mb-3">
                        <div class="stat-label">Total Products</div>
                        <div class="stat-value text-primary">{{ $category->product_count }}</div>
                    </div>
                    
                    <div class="stat-item mb-3">
                        <div class="stat-label">Category Status</div>
                        <div class="stat-value">
                            <span class="badge bg-{{ $category->status === 'active' ? 'success' : 'danger' }}">
                                {{ ucfirst($category->status) }}
                            </span>
                        </div>
                    </div>
                    
                    <div class="stat-item mb-3">
                        <div class="stat-label">Featured Status</div>
                        <div class="stat-value">
                            @if($category->is_featured)
                                <span class="badge bg-warning">Featured</span>
                            @else
                                <span class="text-muted">Not Featured</span>
                            @endif
                        </div>
                    </div>
                    
                    <div class="stat-item">
                        <div class="stat-label">Sort Order</div>
                        <div class="stat-value">{{ $category->sort_order }}</div>
                    </div>
                </div>
            </div>
            
            <!-- Quick Actions -->
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2"></i>Quick Actions
                    </h5>
                </div>
                
                <div class="card-body">
                    <div class="d-grid gap-2">
                        <a href="{{ route('admin.categories.edit', $category->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit me-1"></i>Edit Category
                        </a>
                        
                        @if($category->status === 'active')
                            <button type="button" class="btn btn-outline-secondary" onclick="toggleStatus({{ $category->id }})">
                                <i class="fas fa-pause me-1"></i>Deactivate
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-success" onclick="toggleStatus({{ $category->id }})">
                                <i class="fas fa-play me-1"></i>Activate
                            </button>
                        @endif
                        
                        @if($category->is_featured)
                            <button type="button" class="btn btn-outline-warning" onclick="toggleFeatured({{ $category->id }})">
                                <i class="fas fa-star me-1"></i>Remove Featured
                            </button>
                        @else
                            <button type="button" class="btn btn-outline-info" onclick="toggleFeatured({{ $category->id }})">
                                <i class="fas fa-star me-1"></i>Make Featured
                            </button>
                        @endif
                        
                        <button type="button" class="btn btn-outline-danger" onclick="deleteCategory({{ $category->id }})">
                            <i class="fas fa-trash me-1"></i>Delete Category
                        </button>
                    </div>
                </div>
            </div>
            
            <!-- Category Timeline -->
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2"></i>Timeline
                    </h5>
                </div>
                
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item">
                            <div class="timeline-icon bg-success">
                                <i class="fas fa-plus text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Category Created</div>
                                <div class="timeline-date">{{ $category->created_at->format('M d, Y \a\t g:i A') }}</div>
                            </div>
                        </div>
                        
                        <div class="timeline-item">
                            <div class="timeline-icon bg-info">
                                <i class="fas fa-edit text-white"></i>
                            </div>
                            <div class="timeline-content">
                                <div class="timeline-title">Last Updated</div>
                                <div class="timeline-date">{{ $category->updated_at->format('M d, Y \a\t g:i A') }}</div>
                            </div>
                        </div>
                    </div>
                </div>
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
                <p>Are you sure you want to delete the category "<strong>{{ $category->name }}</strong>"?</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Warning:</strong> This action cannot be undone. If this category has products, they will become uncategorized.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Category</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .card {
        border: none;
        border-radius: 16px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.1);
    }
    
    .card-header {
        background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
        color: white;
        border-radius: 16px 16px 0 0 !important;
        border: none;
    }
    
    .breadcrumb {
        background: transparent;
        padding: 0;
    }
    
    .breadcrumb-item a {
        color: #667eea;
    }
    
    .breadcrumb-item.active {
        color: var(--secondary-color);
    }
    
    /* Category Details */
    .detail-item {
        display: flex;
        flex-direction: column;
        gap: 0.5rem;
    }
    
    .detail-label {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.9rem;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }
    
    .detail-value {
        font-size: 1.1rem;
        color: var(--dark-color);
    }
    
    .detail-description {
        color: var(--secondary-color);
        line-height: 1.6;
        margin: 0;
    }
    
    /* Status Cards */
    .status-card {
        background: #f8f9fc;
        border-radius: 12px;
        padding: 1rem;
        border: 1px solid #e3e6f0;
    }
    
    .status-header {
        font-weight: 600;
        color: var(--secondary-color);
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .status-body {
        text-align: center;
    }
    
    /* Statistics */
    .stat-item {
        display: flex;
        justify-content: space-between;
        align-items: center;
        padding: 0.75rem 0;
        border-bottom: 1px solid #e3e6f0;
    }
    
    .stat-item:last-child {
        border-bottom: none;
    }
    
    .stat-label {
        font-weight: 500;
        color: var(--secondary-color);
    }
    
    .stat-value {
        font-weight: 600;
        color: var(--dark-color);
    }
    
    /* Analytics Cards */
    .analytics-card {
        border-radius: 12px;
        padding: 1.5rem;
        display: flex;
        align-items: center;
        gap: 1rem;
        box-shadow: 0 4px 15px rgba(0,0,0,0.1);
    }
    
    .analytics-icon {
        width: 50px;
        height: 50px;
        background: rgba(255,255,255,0.2);
        border-radius: 12px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-size: 1.5rem;
    }
    
    .analytics-content {
        flex: 1;
    }
    
    .analytics-value {
        font-size: 1.8rem;
        font-weight: 700;
        margin-bottom: 0.25rem;
    }
    
    .analytics-label {
        font-size: 0.9rem;
        opacity: 0.9;
    }
    
    /* SEO Preview */
    .seo-preview {
        background: #f8f9fc;
        border-radius: 8px;
        padding: 1rem;
    }
    
    .preview-box {
        background: white;
        border-radius: 8px;
        padding: 1rem;
        border: 1px solid #e3e6f0;
    }
    
    .preview-title {
        color: #1a0dab;
        font-weight: 600;
        font-size: 1.1rem;
        margin-bottom: 0.25rem;
    }
    
    .preview-url {
        color: #006621;
        font-size: 0.9rem;
        margin-bottom: 0.5rem;
    }
    
    .preview-description {
        color: #545454;
        font-size: 0.9rem;
        line-height: 1.4;
        margin: 0;
    }
    
    /* Timeline */
    .timeline {
        position: relative;
    }
    
    .timeline-item {
        display: flex;
        align-items: flex-start;
        gap: 1rem;
        margin-bottom: 1rem;
    }
    
    .timeline-item:last-child {
        margin-bottom: 0;
    }
    
    .timeline-icon {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        flex-shrink: 0;
    }
    
    .timeline-content {
        flex: 1;
    }
    
    .timeline-title {
        font-weight: 600;
        color: var(--dark-color);
        font-size: 0.9rem;
        margin-bottom: 0.25rem;
    }
    
    .timeline-date {
        color: var(--secondary-color);
        font-size: 0.8rem;
    }
    
    .btn {
        border-radius: 8px;
        font-weight: 500;
        padding: 0.5rem 1rem;
        transition: all 0.3s ease;
    }
    
    .btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(0,0,0,0.15);
    }
    
    /* Responsive */
    @media (max-width: 768px) {
        .detail-item {
            margin-bottom: 1rem;
        }
        
        .analytics-card {
            margin-bottom: 1rem;
        }
    }
</style>
@endpush

@push('scripts')
<script>
    // Toggle category status
    function toggleStatus(categoryId) {
        if (confirm('Are you sure you want to change this category status?')) {
            window.location.href = `/admin/categories/${categoryId}/toggle-status`;
        }
    }
    
    // Toggle featured status
    function toggleFeatured(categoryId) {
        if (confirm('Are you sure you want to change this category featured status?')) {
            window.location.href = `/admin/categories/${categoryId}/toggle-featured`;
        }
    }
    
    // Delete category function
    function deleteCategory(categoryId) {
        const modal = new bootstrap.Modal(document.getElementById('deleteModal'));
        modal.show();
    }
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
</script>
@endpush
