@extends('admin.layouts.app')

@section('title', 'Categories Management')
@section('page-title', 'Categories Management')

@section('content')
<div class="container-fluid">
    
    <!-- Header Section -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div class="d-flex align-items-center">
            <h4 class="mb-0 me-3 text-dark fw-bold">Categories</h4>
        </div>
        <div class="d-flex gap-2">
            <a href="{{ route('admin.categories.create') }}" class="btn btn-warning">
                Create New
            </a>
        </div>
    </div>
    
    <!-- Breadcrumb -->
    {{-- <nav aria-label="breadcrumb" class="mb-3">
        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="{{ route('admin.dashboard') }}" class="text-decoration-none text-muted">
                    seller
                </a>
            </li>
            <li class="breadcrumb-item active text-muted" aria-current="page">category</li>
        </ol>
    </nav> --}}
    
    <!-- Search Bar -->
    <div class="mb-3 category-search">
        <label class="form-label">Search</label>
        <input type="text" class="form-control" placeholder="search...">
    </div>

    <!-- Categories Table -->
    <div class="card category-table">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>NAME</th>
                            <th>CREATED AT</th>
                            <th>ACTION</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($categories as $category)
                        <tr>
                            <td>
                                <div class="category-name-section">
                                    <div class="category-name-display" id="category-name-{{ $category->id }}">
                                        {{ $category->name }}
                                    </div>
                                    <input type="text" class="form-control category-name-edit d-none" 
                                           id="category-name-input-{{ $category->id }}" 
                                           value="{{ $category->name }}">
                                    {{-- <div class="category-actions mt-1">
                                        <button type="button" class="btn btn-sm btn-outline-primary btn-edit-name" 
                                                onclick="editCategoryName({{ $category->id }})" title="Edit Name">
                                            <i class="fas fa-edit"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-success btn-save-name d-none" 
                                                onclick="saveCategoryName({{ $category->id }})" title="Save Name">
                                            <i class="fas fa-check"></i>
                                        </button>
                                        <button type="button" class="btn btn-sm btn-outline-secondary btn-cancel-name d-none" 
                                                onclick="cancelEditName({{ $category->id }})" title="Cancel">
                                            <i class="fas fa-times"></i>
                                        </button>
                                    </div> --}}
                                </div>
                            </td>
                            <td>
                                <span class="created-date">{{ $category->created_at->format('d-m-Y') }}</span>
                            </td>
                            <td>
                                <div class="dropdown category-action-dropdown">
                                    <button class="btn dropdown-toggle" type="button" 
                                            data-bs-toggle="dropdown" aria-expanded="false">
                                        Action
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.categories.edit', $category->id) }}">
                                                <i class="fas fa-edit text-warning me-2"></i>Edit
                                            </a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" href="{{ route('admin.categories.create') }}?parent_id={{ $category->id }}">
                                                <i class="fas fa-plus text-info me-2"></i>Add Subcategory
                                            </a>
                                        </li>
                                        <li><hr class="dropdown-divider"></li>
                                        <li>
                                            <a class="dropdown-item text-danger" href="#" data-bs-toggle="modal" data-bs-target="#deleteModal" data-category-id="{{ $category->id }}">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </a>
                                        </li>
                                        </ul>
                                    </div>
                                </td>
                            </tr>
                        @empty
                                                 <tr>
                             <td colspan="3" class="text-center py-4">
                                 <div class="category-empty-state">
                                     <i class="fas fa-tags"></i>
                                     <h5>No categories found</h5>
                                     <p>Start by creating your first category.</p>
                                     <a href="{{ route('admin.categories.create') }}" class="btn btn-primary">
                                         <i class="fas fa-plus me-1"></i>Create Category
                                     </a>
                                 </div>
                             </td>
                         </tr>
                        @endforelse
                    </tbody>
                </table>
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
                <p>Are you sure you want to delete this category? This action cannot be undone.</p>
                <div class="alert alert-danger">
                    <i class="fas fa-exclamation-triangle me-2"></i>
                    <strong>Note:</strong> If this category has products, they will become uncategorized.
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="button" class="btn btn-danger" onclick="confirmDelete()">Delete Category</button>
            </div>
        </div>
    </div>
</div>
@endsection



@push('scripts')
<script>

    
    // Delete category function
    function confirmDelete() {
        const modal = document.getElementById('deleteModal');
        const categoryId = modal.getAttribute('data-category-id');
        
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = `/admin/categories/${categoryId}`;
        
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
    
    // Inline category name editing
    function editCategoryName(categoryId) {
        const displayElement = document.getElementById(`category-name-${categoryId}`);
        const inputElement = document.getElementById(`category-name-input-${categoryId}`);
        const editBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-edit-name');
        const saveBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-save-name');
        const cancelBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-cancel-name');
        
        displayElement.classList.add('d-none');
        inputElement.classList.remove('d-none');
        editBtn.classList.add('d-none');
        saveBtn.classList.remove('d-none');
        cancelBtn.classList.remove('d-none');
        
        inputElement.focus();
        inputElement.select();
    }
    
    function saveCategoryName(categoryId) {
        const displayElement = document.getElementById(`category-name-${categoryId}`);
        const inputElement = document.getElementById(`category-name-input-${categoryId}`);
        const editBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-edit-name');
        const saveBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-save-name');
        const cancelBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-cancel-name`);
        
        const newName = inputElement.value.trim();
        if (newName) {
            displayElement.textContent = newName;
            // Here you would typically make an AJAX call to save the name
            // For now, we'll just update the display
        }
        
        displayElement.classList.remove('d-none');
        inputElement.classList.add('d-none');
        editBtn.classList.remove('d-none');
        saveBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
    }
    
    function cancelEditName(categoryId) {
        const displayElement = document.getElementById(`category-name-${categoryId}`);
        const inputElement = document.getElementById(`category-name-input-${categoryId}`);
        const editBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-edit-name');
        const saveBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-save-name');
        const cancelBtn = document.querySelector(`#category-name-${categoryId}`).parentNode.querySelector('.btn-cancel-name`);
        
        // Reset input value to original
        inputElement.value = displayElement.textContent;
        
        displayElement.classList.remove('d-none');
        inputElement.classList.add('d-none');
        editBtn.classList.remove('d-none');
        saveBtn.classList.add('d-none');
        cancelBtn.classList.add('d-none');
    }
    
    // Edit category function
    function editCategory(categoryId) {
        window.location.href = `/admin/categories/${categoryId}/edit`;
    }
    
    // Add subcategory function
    function addSubcategory(categoryId) {
        // Redirect to create page with parent category pre-selected
        window.location.href = `/admin/categories/create?parent_id=${categoryId}`;
    }
    
    // Initialize tooltips
    var tooltipTriggerList = [].slice.call(document.querySelectorAll('[data-bs-toggle="tooltip"]'));
    var tooltipList = tooltipTriggerList.map(function (tooltipTriggerEl) {
        return new bootstrap.Tooltip(tooltipTriggerEl);
    });
    
    // Set category ID when delete modal opens
    document.getElementById('deleteModal').addEventListener('show.bs.modal', function (event) {
        const button = event.relatedTarget;
        const categoryId = button.getAttribute('data-category-id');
        this.setAttribute('data-category-id', categoryId);
    });
</script>
@endpush
