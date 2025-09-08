@extends('admin.layouts.app')

@section('title', 'Vendors Management')
@section('page-title', 'Vendors Management')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="card-title mb-0">Vendors Management</h1>
                            <p class="text-muted mb-0">Manage your marketplace vendors and sellers</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New Vendor
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Vendors Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-store me-2"></i>Vendors List
                <span class="badge bg-secondary ms-2">{{ $vendors->total() }} vendors</span>
            </h5>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Vendor Info</th>
                            <th>Contact</th>
                            <th>Products</th>
                            <th>Status</th>
                            <th>Joined</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($vendors as $vendor)
                        <tr>
                            <td>
                                <div class="vendor-info">
                                    <h6 class="vendor-name mb-1">{{ $vendor->name }}</h6>
                                    @if($vendor->company_name)
                                        <small class="text-muted">{{ $vendor->company_name }}</small>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="contact-info">
                                    <div class="email mb-1">
                                        <i class="fas fa-envelope me-1 text-primary"></i>
                                        {{ $vendor->email }}
                                    </div>
                                    @if($vendor->phone)
                                        <div class="phone">
                                            <i class="fas fa-phone me-1 text-primary"></i>
                                            {{ $vendor->phone }}
                                        </div>
                                    @endif
                                </div>
                            </td>
                            <td>
                                <div class="products-info">
                                    <div class="d-flex align-items-center gap-2 mb-1">
                                        <span class="badge bg-info">{{ $vendor->products_count }} products</span>
                                        @if($vendor->products_count > 0)
                                            <a href="{{ route('admin.products.vendor-products', $vendor) }}" 
                                               class="btn btn-sm btn-outline-primary">
                                                <i class="fas fa-eye me-1"></i>View Products
                                            </a>
                                        @else
                                            <span class="text-muted small">No products yet</span>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            <td>
                                @if($vendor->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $vendor->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.vendors.show', $vendor) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.vendors.edit', $vendor) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Delete"
                                            onclick="deleteVendor({{ $vendor->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="6" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-store fa-3x text-muted mb-3"></i>
                                    <h5>No vendors found</h5>
                                    <p class="text-muted">Create your first vendor to start building your marketplace.</p>
                                    <a href="{{ route('admin.vendors.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add New Vendor
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
        
        @if($vendors->hasPages())
        <div class="card-footer">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <small class="text-muted">
                        Showing {{ $vendors->firstItem() ?? 0 }} to {{ $vendors->lastItem() ?? 0 }} of {{ $vendors->total() }} results
                    </small>
                </div>
                <div>
                    {{ $vendors->links() }}
                </div>
            </div>
        </div>
        @endif
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
                <p>Are you sure you want to delete this vendor? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Vendor</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .vendor-name {
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
    }
    
    .contact-info {
        font-size: 0.875rem;
    }
    
    .contact-info i {
        width: 16px;
    }
    
    .products-info {
        text-align: center;
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
</style>
@endpush

@push('scripts')
<script>
    function deleteVendor(vendorId) {
        if (confirm('Are you sure you want to delete this vendor?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/vendors/${vendorId}`;
            
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
