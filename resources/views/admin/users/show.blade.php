@extends('admin.layouts.app')

@section('title', 'User Details')
@section('page-title', 'User Details')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex justify-content-between align-items-center">
                        <h5 class="card-title mb-0">
                            <i class="fas fa-user me-2"></i>
                            Vendor Information
                        </h5>
                        <div class="d-flex gap-2">
                            @if($user->role_id == 2 || ($user->roles && $user->roles->contains('name', 'Vendor')))
                                @if(($user->products_count ?? 0) > 0)
                                    <a href="{{ route('admin.products.vendor-products', $user) }}" class="btn btn-primary">
                                        <i class="fas fa-box me-2"></i>
                                        View Products ({{ $user->products_count ?? 0 }})
                                    </a>
                                @endif
                            @endif
                            <a href="{{ route('admin.users.edit', $user) }}" class="btn btn-warning">
                                <i class="fas fa-edit me-2"></i>
                                Edit Vendor
                            </a>
                            <a href="{{ route('admin.users.index') }}" class="btn btn-secondary">
                                <i class="fas fa-arrow-left me-2"></i>
                                Back to Vendors
                            </a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Full Name</label>
                                        <p class="form-control-plaintext">{{ $user->name }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Email Address</label>
                                        <p class="form-control-plaintext">{{ $user->email }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Phone Number</label>
                                        <p class="form-control-plaintext">{{ $user->phone }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Role</label>
                                        <p class="form-control-plaintext">
                                            @if($user->roles->count() > 0)
                                                <span class="badge bg-primary">{{ $user->roles->first()->name }}</span>
                                            @else
                                                <span class="badge bg-secondary">Vendor</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Account Status</label>
                                        <p class="form-control-plaintext">
                                            @if($user->is_active)
                                                <span class="badge bg-success">Active</span>
                                            @else
                                                <span class="badge bg-secondary">Inactive</span>
                                            @endif
                                        </p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Registration Date</label>
                                        <p class="form-control-plaintext">{{ $user->created_at->format('F j, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">Last Updated</label>
                                        <p class="form-control-plaintext">{{ $user->updated_at->format('F j, Y \a\t g:i A') }}</p>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="mb-3">
                                        <label class="form-label fw-bold">User ID</label>
                                        <p class="form-control-plaintext">{{ $user->id }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-4">
                            <div class="card bg-light">
                                <div class="card-body text-center">
                                    <div class="avatar-lg bg-primary text-white rounded-circle d-flex align-items-center justify-content-center mx-auto mb-3">
                                        {{ strtoupper(substr($user->name, 0, 1)) }}
                                    </div>
                                    <h5 class="card-title">{{ $user->name }}</h5>
                                    <p class="text-muted mb-3">{{ $user->email }}</p>
                                    
                                    <!-- Products Section for Vendors -->
                                    @if($user->role_id == 2 || ($user->roles && $user->roles->contains('name', 'Vendor')))
                                    <div class="vendor-products-section mb-3">
                                        <div class="d-flex justify-content-between align-items-center mb-2">
                                            <span class="fw-bold">Products:</span>
                                            <span class="badge bg-info">{{ $user->products_count ?? 0 }} items</span>
                                        </div>
                                        @if(($user->products_count ?? 0) > 0)
                                            <a href="{{ route('admin.products.vendor-products', $user) }}" 
                                               class="btn btn-primary btn-sm w-100">
                                                <i class="fas fa-box me-2"></i>View All Products
                                            </a>
                                        @else
                                            <span class="text-muted small">No products added yet</span>
                                        @endif
                                    </div>
                                    <hr>
                                    @endif
                                    
                                    <div class="d-grid gap-2">
                                        <form action="{{ route('admin.users.toggle-status', $user) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <button type="submit" class="btn btn-{{ $user->is_active ? 'warning' : 'success' }} w-100">
                                                <i class="fas fa-{{ $user->is_active ? 'pause' : 'play' }} me-2"></i>
                                                {{ $user->is_active ? 'Deactivate' : 'Activate' }} User
                                            </button>
                                        </form>
                                        
                                        <form action="{{ route('admin.users.destroy', $user) }}" method="POST" 
                                              onsubmit="return confirm('Are you sure you want to delete this user? This action cannot be undone.')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-danger w-100">
                                                <i class="fas fa-trash me-2"></i>
                                                Delete User
                                            </button>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
    .avatar-lg {
        width: 80px;
        height: 80px;
        font-weight: 600;
        font-size: 2rem;
    }
    
    .form-label {
        color: var(--dark-color);
    }
    
    .form-control-plaintext {
        padding: 0.375rem 0;
        margin-bottom: 0;
        color: var(--dark-color);
        background-color: transparent;
        border: solid transparent;
        border-width: 1px 0;
    }
    
    .badge {
        font-size: 0.875rem;
        padding: 0.5rem 0.75rem;
    }
</style>
@endpush
