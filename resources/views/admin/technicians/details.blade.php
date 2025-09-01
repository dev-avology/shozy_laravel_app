@extends('admin.layouts.app')

@section('title', 'Technician Details')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Technician Details: {{ $technician->name }}</h1>
            <p class="text-muted">Comprehensive profile and performance overview</p>
        </div>
        <div>
            <a href="{{ route('admin.technicians.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Technicians
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-4">
            <!-- Profile Card -->
            <div class="card shadow mb-4">
                <div class="card-body text-center">
                    <img src="{{ $technician->avatar }}" alt="{{ $technician->name }}"
                         class="rounded-circle mb-3" style="width: 120px; height: 120px; object-fit: cover;">
                    <h5 class="mb-0">{{ $technician->name }}</h5>
                    <p class="text-muted">{{ $technician->specialization }}</p>
                    <span class="badge bg-{{ $technician->status === 'online' ? 'success' : ($technician->status === 'busy' ? 'warning' : 'secondary') }} mb-2">
                        {{ ucfirst($technician->status) }}
                    </span>
                    <ul class="list-group list-group-flush mt-3">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Email: <span class="text-muted">{{ $technician->email }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Phone: <span class="text-muted">{{ $technician->phone }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Location: <span class="text-muted">{{ $technician->location }}</span>
                        </li>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            Joined: <span class="text-muted">{{ $technician->joined_date->format('M d, Y') }}</span>
                        </li>
                    </ul>
                    <div class="mt-3">
                        @if($technician->is_verified)
                            <span class="badge bg-success me-1"><i class="fas fa-check-circle me-1"></i>Verified</span>
                        @endif
                        @if($technician->is_featured)
                            <span class="badge bg-warning"><i class="fas fa-star me-1"></i>Featured</span>
                        @endif
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-8">
            <!-- Performance Overview -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Performance Overview</h6>
                </div>
                <div class="card-body">
                    <div class="row text-center">
                        <div class="col-md-3 mb-3">
                            <h5 class="mb-0 text-primary">{{ $technician->total_jobs }}</h5>
                            <small class="text-muted">Total Jobs</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <h5 class="mb-0 text-success">{{ $technician->completed_jobs }}</h5>
                            <small class="text-muted">Completed</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <h5 class="mb-0 text-info">{{ $technician->rating }} <i class="fas fa-star text-warning"></i></h5>
                            <small class="text-muted">Rating</small>
                        </div>
                        <div class="col-md-3 mb-3">
                            <h5 class="mb-0 text-warning">{{ $technician->current_jobs }}</h5>
                            <small class="text-muted">Current Jobs</small>
                        </div>
                    </div>
                    <hr>
                    <div class="row text-center">
                        <div class="col-md-4 mb-3">
                            <h5 class="mb-0 text-primary">${{ number_format($technician->total_earnings, 2) }}</h5>
                            <small class="text-muted">Total Earnings</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5 class="mb-0 text-success">${{ number_format($technician->this_week_earnings, 2) }}</h5>
                            <small class="text-muted">This Week</small>
                        </div>
                        <div class="col-md-4 mb-3">
                            <h5 class="mb-0 text-danger">${{ number_format($technician->pending_payout, 2) }}</h5>
                            <small class="text-muted">Pending Payout</small>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Tabs for Details -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <ul class="nav nav-tabs card-header-tabs" id="technicianTabs" role="tablist">
                        <li class="nav-item">
                            <a class="nav-link active" id="jobs-tab" data-bs-toggle="tab" href="#jobs" role="tab" aria-controls="jobs" aria-selected="true">Recent Jobs</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="earnings-tab" data-bs-toggle="tab" href="#earnings" role="tab" aria-controls="earnings" aria-selected="false">Earnings History</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" id="profile-tab" data-bs-toggle="tab" href="#profile" role="tab" aria-controls="profile" aria-selected="false">Profile Info</a>
                        </li>
                    </ul>
                </div>
                <div class="card-body">
                    <div class="tab-content" id="technicianTabsContent">
                        <!-- Recent Jobs Tab -->
                        <div class="tab-pane fade show active" id="jobs" role="tabpanel" aria-labelledby="jobs-tab">
                            <h5 class="mb-3">Recent Job History</h5>
                            @if($jobHistory->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Job ID</th>
                                                <th>Customer</th>
                                                <th>Service</th>
                                                <th>Date</th>
                                                <th>Status</th>
                                                <th>Earnings</th>
                                                <th>Rating</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($jobHistory as $job)
                                            <tr>
                                                <td>JOB-{{ $job->id }}</td>
                                                <td>{{ $job->customer_name }}</td>
                                                <td>{{ $job->service }}</td>
                                                <td>{{ $job->date->format('M d, Y') }}</td>
                                                <td><span class="badge bg-success">{{ ucfirst($job->status) }}</span></td>
                                                <td>${{ number_format($job->earnings, 2) }}</td>
                                                <td>{{ $job->rating }} <i class="fas fa-star text-warning"></i></td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center">No recent job history available.</p>
                            @endif
                        </div>

                        <!-- Earnings History Tab -->
                        <div class="tab-pane fade" id="earnings" role="tabpanel" aria-labelledby="earnings-tab">
                            <h5 class="mb-3">Monthly Earnings Summary</h5>
                            @if($earningsHistory->count() > 0)
                                <div class="table-responsive">
                                    <table class="table table-bordered table-hover">
                                        <thead>
                                            <tr>
                                                <th>Month</th>
                                                <th>Amount</th>
                                                <th>Jobs Completed</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($earningsHistory as $earning)
                                            <tr>
                                                <td>{{ $earning->month }}</td>
                                                <td>${{ number_format($earning->amount, 2) }}</td>
                                                <td>{{ $earning->jobs }}</td>
                                            </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @else
                                <p class="text-muted text-center">No earnings history available.</p>
                            @endif
                        </div>

                        <!-- Profile Info Tab -->
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">
                            <h5 class="mb-3">Additional Profile Information</h5>
                            <ul class="list-group list-group-flush">
                                <li class="list-group-item"><strong>Bio:</strong> {{ $technician->bio }}</li>
                                <li class="list-group-item"><strong>Skills:</strong> {{ implode(', ', $technician->skills) }}</li>
                                <li class="list-group-item"><strong>Languages:</strong> {{ implode(', ', $technician->languages) }}</li>
                                <li class="list-group-item"><strong>Working Hours:</strong> {{ $technician->working_hours }}</li>
                                <li class="list-group-item"><strong>Service Areas:</strong> {{ implode(', ', $technician->service_areas) }}</li>
                                <li class="list-group-item"><strong>Certifications:</strong> {{ implode(', ', $technician->certifications) }}</li>
                            </ul>
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
.nav-tabs .nav-link {
    color: #6c757d;
    border: none;
    border-bottom: 2px solid transparent;
}

.nav-tabs .nav-link.active {
    color: #4e73df;
    background-color: transparent;
    border-bottom: 2px solid #4e73df;
}

.list-group-item {
    border-left: none;
    border-right: none;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush
