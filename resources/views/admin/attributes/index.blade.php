@extends('admin.layouts.app')

@section('title', 'Attributes Management')
@section('page-title', 'Attributes Management')

@section('content')
<div class="container-fluid">
    <!-- Header -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h1 class="card-title mb-0">Attributes Management</h1>
                            <p class="text-muted mb-0">Define product attributes and specifications</p>
                        </div>
                        <div>
                            <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add New Attribute
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Attributes Table -->
    <div class="card">
        <div class="card-header">
            <h5 class="card-title mb-0">
                <i class="fas fa-tags me-2"></i>Attributes List
                <span class="badge bg-secondary ms-2">{{ $attributes->count() }} attributes</span>
            </h5>
        </div>
        
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-hover mb-0">
                    <thead class="table-light">
                        <tr>
                            <th>Name</th>
                            <th>Type</th>
                            <th>Values</th>
                            <th>Required</th>
                            <th>Status</th>
                            <th>Created</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($attributes as $attribute)
                        <tr>
                            <td>
                                <div class="attribute-info">
                                    <h6 class="attribute-name mb-1">{{ $attribute->name }}</h6>
                                </div>
                            </td>
                            <td>
                                <span class="badge bg-info">{{ ucfirst($attribute->type) }}</span>
                            </td>
                            <td>
                                @if(count($attribute->values) > 0)
                                    <div class="attribute-values">
                                        @foreach(array_slice($attribute->values, 0, 3) as $value)
                                            <span class="badge bg-light text-dark me-1">{{ $value }}</span>
                                        @endforeach
                                        @if(count($attribute->values) > 3)
                                            <span class="badge bg-secondary">+{{ count($attribute->values) - 3 }} more</span>
                                        @endif
                                    </div>
                                @else
                                    <span class="text-muted">No predefined values</span>
                                @endif
                            </td>
                            <td>
                                @if($attribute->is_required)
                                    <span class="badge bg-warning">Required</span>
                                @else
                                    <span class="badge bg-secondary">Optional</span>
                                @endif
                            </td>
                            <td>
                                @if($attribute->is_active)
                                    <span class="badge bg-success">Active</span>
                                @else
                                    <span class="badge bg-secondary">Inactive</span>
                                @endif
                            </td>
                            <td>
                                <small class="text-muted">
                                    {{ $attribute->created_at->format('M d, Y') }}
                                </small>
                            </td>
                            <td>
                                <div class="btn-group" role="group">
                                    <a href="{{ route('admin.attributes.show', $attribute->id) }}" 
                                       class="btn btn-sm btn-outline-primary" 
                                       title="View">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    <a href="{{ route('admin.attributes.edit', $attribute->id) }}" 
                                       class="btn btn-sm btn-outline-warning" 
                                       title="Edit">
                                        <i class="fas fa-edit"></i>
                                    </a>
                                    <button type="button" 
                                            class="btn btn-sm btn-outline-danger" 
                                            title="Delete"
                                            onclick="deleteAttribute({{ $attribute->id }})">
                                        <i class="fas fa-trash"></i>
                                    </button>
                                </div>
                            </td>
                        </tr>
                        @empty
                        <tr>
                            <td colspan="7" class="text-center py-4">
                                <div class="empty-state">
                                    <i class="fas fa-tags fa-3x text-muted mb-3"></i>
                                    <h5>No attributes found</h5>
                                    <p class="text-muted">Create your first attribute to define product specifications.</p>
                                    <a href="{{ route('admin.attributes.create') }}" class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add New Attribute
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
                <p>Are you sure you want to delete this attribute? This action cannot be undone.</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <form id="deleteForm" method="POST" style="display: inline;">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger">Delete Attribute</button>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .attribute-name {
        font-weight: 600;
        color: var(--dark-color);
        margin: 0;
    }
    
    .attribute-values {
        display: flex;
        flex-wrap: wrap;
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
</style>
@endpush

@push('scripts')
<script>
    function deleteAttribute(attributeId) {
        if (confirm('Are you sure you want to delete this attribute?')) {
            const form = document.createElement('form');
            form.method = 'POST';
            form.action = `/admin/attributes/${attributeId}`;
            
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
