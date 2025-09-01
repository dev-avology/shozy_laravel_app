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
            <div class="table-responsive">
                <table class="table table-bordered table-hover">
                    <thead class="table-light">
                        <tr>
                            <th width="50">
                                <input type="checkbox" class="form-check-input" id="selectAll">
                            </th>
                            <th width="80">Image</th>
                            <th>Name</th>
                            <th>Specialization</th>
                            <th>Status</th>
                            <th>Rating</th>
                            <th>Total Jobs</th>
                            <th>Earnings</th>
                            <th>Location</th>
                            <th width="150">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if($technicians && $technicians->count() > 0)
                            @foreach($technicians as $technician)
                            <tr>
                                <td>
                                    <input type="checkbox" class="form-check-input technician-checkbox" value="{{ $technician->id }}">
                                </td>
                                <td>
                                    <img src="{{ $technician->avatar }}" alt="{{ $technician->name }}" 
                                         class="rounded-circle" style="width: 50px; height: 50px; object-fit: cover;">
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <div>
                                            <h6 class="mb-0">{{ $technician->name }}</h6>
                                            <small class="text-muted">{{ $technician->email }}</small>
                                        </div>
                                    </div>
                                </td>
                                <td>{{ $technician->specialization }}</td>
                                <td>
                                    <span class="badge bg-{{ $technician->status === 'online' ? 'success' : ($technician->status === 'busy' ? 'warning' : 'secondary') }}">
                                        {{ ucfirst($technician->status) }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex align-items-center">
                                        <span class="me-2">{{ $technician->rating }}</span>
                                        <i class="fas fa-star text-warning"></i>
                                    </div>
                                </td>
                                <td>{{ $technician->total_jobs }}</td>
                                <td>${{ number_format($technician->total_earnings, 2) }}</td>
                                <td>{{ $technician->location }}</td>
                                <td>
                                    <div class="btn-group" role="group">
                                        <a href="{{ route('admin.technicians.show', $technician->id) }}" 
                                           class="btn btn-sm btn-outline-primary">
                                            <i class="fas fa-eye"></i>
                                        </a>
                                        <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle dropdown-toggle-split" 
                                                data-bs-toggle="dropdown">
                                        </button>
                                        <ul class="dropdown-menu">
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
                                </td>
                            </tr>
                            @endforeach
                        @else
                            <tr>
                                <td colspan="10" class="text-center py-5">
                                    <i class="fas fa-users fa-3x text-muted mb-3"></i>
                                    <h5 class="text-muted">No Technicians Found</h5>
                                    <p class="text-muted">Start by adding your first technician to the platform.</p>
                                    <button class="btn btn-primary">
                                        <i class="fas fa-plus me-2"></i>Add First Technician
                                    </button>
                                </td>
                            </tr>
                        @endif
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
@endsection

@push('styles')
<style>
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

.table th {
    font-size: 0.875rem;
    font-weight: 600;
}

.table td {
    font-size: 0.875rem;
    vertical-align: middle;
}

.btn-group .dropdown-toggle-split {
    border-left: 1px solid rgba(0,0,0,.125);
}
</style>
@endpush

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Select all functionality
    const selectAllCheckbox = document.getElementById('selectAll');
    const technicianCheckboxes = document.querySelectorAll('.technician-checkbox');
    
    selectAllCheckbox.addEventListener('change', function() {
        technicianCheckboxes.forEach(checkbox => {
            checkbox.checked = this.checked;
        });
    });
    
    // Update select all when individual checkboxes change
    technicianCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            const allChecked = Array.from(technicianCheckboxes).every(cb => cb.checked);
            const someChecked = Array.from(technicianCheckboxes).some(cb => cb.checked);
            
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = someChecked && !allChecked;
        });
    });
});
</script>
@endpush
