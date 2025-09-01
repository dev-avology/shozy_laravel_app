@extends('admin.layouts.app')

@section('title', 'Technicians Management')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Technicians Management</h1>
            <p class="text-muted">Manage your service technicians, track performance, and handle payouts</p>
        </div>
        <div>
            <button class="btn btn-primary">
                <i class="fas fa-plus me-2"></i>Add New Technician
            </button>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Technicians</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalTechnicians }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-users fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Online Technicians</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $onlineTechnicians }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-circle fa-2x text-success"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Earnings</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($totalEarnings, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Pending Payouts</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($pendingPayouts, 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Search and Filters -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <div class="row align-items-center">
                <div class="col-md-6">
                    <h6 class="m-0 font-weight-bold text-primary">Technicians</h6>
                </div>
                <div class="col-md-6">
                    <div class="input-group">
                        <input type="text" class="form-control" placeholder="Search technicians...">
                        <button class="btn btn-outline-secondary" type="button">
                            <i class="fas fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <div class="card-body">
            <div class="row">
                @if($technicians && $technicians->count() > 0)
                    @foreach($technicians as $technician)
                    <div class="col-lg-6 col-xl-4 mb-4">
                        <div class="card technician-card h-100">
                            <div class="card-header bg-transparent border-0">
                                <div class="d-flex justify-content-between align-items-center">
                                    <div class="d-flex align-items-center">
                                        <img src="{{ $technician->avatar }}" alt="{{ $technician->name }}" 
                                             class="rounded-circle me-3" style="width: 50px; height: 50px; object-fit: cover;">
                                        <div>
                                            <h6 class="mb-0">{{ $technician->name }}</h6>
                                            <small class="text-muted">{{ $technician->specialization }}</small>
                                        </div>
                                    </div>
                                    <div class="dropdown">
                                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown">
                                            <i class="fas fa-ellipsis-v"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li><a class="dropdown-item" href="{{ route('admin.technicians.show', $technician->id) }}">
                                                <i class="fas fa-eye me-2"></i>View Details
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.technicians.jobs', $technician->id) }}">
                                                <i class="fas fa-briefcase me-2"></i>View Jobs
                                            </a></li>
                                            <li><a class="dropdown-item" href="{{ route('admin.technicians.earnings', $technician->id) }}">
                                                <i class="fas fa-dollar-sign me-2"></i>View Earnings
                                            </a></li>
                                            <li><hr class="dropdown-divider"></li>
                                            <li><a class="dropdown-item text-warning" href="#">
                                                <i class="fas fa-edit me-2"></i>Edit
                                            </a></li>
                                            <li><a class="dropdown-item text-danger" href="#">
                                                <i class="fas fa-trash me-2"></i>Delete
                                            </a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="row text-center mb-3">
                                    <div class="col-4">
                                        <div class="border-end">
                                            <h6 class="mb-0 text-primary">{{ $technician->total_jobs }}</h6>
                                            <small class="text-muted">Total Jobs</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <div class="border-end">
                                            <h6 class="mb-0 text-success">{{ $technician->rating }}</h6>
                                            <small class="text-muted">Rating</small>
                                        </div>
                                    </div>
                                    <div class="col-4">
                                        <h6 class="mb-0 text-info">${{ number_format($technician->total_earnings, 2) }}</h6>
                                        <small class="text-muted">Earnings</small>
                                    </div>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center mb-2">
                                    <span class="badge bg-{{ $technician->status === 'online' ? 'success' : ($technician->status === 'busy' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($technician->status) }}
                                    </span>
                                    <small class="text-muted">{{ $technician->location }}</small>
                                </div>
                                
                                <div class="d-flex justify-content-between align-items-center">
                                    <div>
                                        <small class="text-muted">Current Jobs: {{ $technician->current_jobs }}</small>
                                    </div>
                                    <div>
                                        @if($technician->is_verified)
                                            <span class="badge bg-success me-1">Verified</span>
                                        @endif
                                        @if($technician->is_featured)
                                            <span class="badge bg-warning">Featured</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="card-footer bg-transparent">
                                <div class="d-flex justify-content-between align-items-center">
                                    <small class="text-muted">Joined {{ $technician->joined_date->diffForHumans() }}</small>
                                    <div>
                                        <a href="{{ route('admin.technicians.show', $technician->id) }}" class="btn btn-sm btn-primary">
                                            <i class="fas fa-eye me-1"></i>View
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                @else
                    <div class="col-12">
                        <div class="text-center py-5">
                            <i class="fas fa-users fa-3x text-muted mb-3"></i>
                            <h5 class="text-muted">No Technicians Found</h5>
                            <p class="text-muted">Start by adding your first technician to the platform.</p>
                            <button class="btn btn-primary">
                                <i class="fas fa-plus me-2"></i>Add First Technician
                            </button>
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
.technician-card {
    transition: transform 0.2s ease, box-shadow 0.2s ease;
    border: 1px solid #e3e6f0;
}

.technician-card:hover {
    transform: translateY(-5px);
    box-shadow: 0 0.5rem 1rem rgba(0, 0, 0, 0.15);
}

.technician-card .card-header {
    background: linear-gradient(135deg, #f8f9fc 0%, #eaecf4 100%);
}

.border-left-primary {
    border-left: 0.25rem solid #4e73df !important;
}

.border-left-success {
    border-left: 0.25rem solid #1cc88a !important;
}

.border-left-info {
    border-left: 0.25rem solid #36b9cc !important;
}

.border-left-warning {
    border-left: 0.25rem solid #f6c23e !important;
}
</style>
@endpush
