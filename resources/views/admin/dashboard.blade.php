@extends('admin.layouts.app')

@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="container-fluid">
    <!-- Welcome Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center py-5">
                    <h2 class="display-6 mb-3">Welcome back, {{ auth()->guard('admin')->user()->name ?? 'Admin' }}! 👋</h2>
                    <p class="text-muted fs-5">Here's what's happening with your application today.</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistics Cards -->
    <div class="stats-grid">
        <div class="stat-card">
            <div class="stat-icon bg-primary text-white">
                <i class="fas fa-users"></i>
            </div>
            <div class="stat-value text-primary">{{ $stats['total_users'] }}</div>
            <div class="stat-label">Total Users</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-success text-white">
                <i class="fas fa-user"></i>
            </div>
            <div class="stat-value text-success">{{ $stats['customers'] }}</div>
            <div class="stat-label">Customers</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-warning text-white">
                <i class="fas fa-tools"></i>
            </div>
            <div class="stat-value text-warning">{{ $stats['technicians'] }}</div>
            <div class="stat-label">Technicians</div>
        </div>

        <div class="stat-card">
            <div class="stat-icon bg-info text-white">
                <i class="fas fa-truck"></i>
            </div>
            <div class="stat-value text-info">{{ $stats['delivery'] }}</div>
            <div class="stat-label">Delivery Partners</div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-bolt me-2 text-warning"></i>
                        Quick Actions
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="btn btn-outline-primary w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-user-plus fs-2 mb-2"></i>
                                <span>Add New User</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="btn btn-outline-success w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-chart-line fs-2 mb-2"></i>
                                <span>View Reports</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="btn btn-outline-warning w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-cog fs-2 mb-2"></i>
                                <span>Settings</span>
                            </a>
                        </div>
                        <div class="col-md-3 col-sm-6">
                            <a href="#" class="btn btn-outline-info w-100 h-100 d-flex flex-column align-items-center justify-content-center py-4">
                                <i class="fas fa-question-circle fs-2 mb-2"></i>
                                <span>Help</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Recent Activity & System Status -->
    <div class="row">
        <!-- Recent Activity -->
        <div class="col-lg-8">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-clock me-2 text-primary"></i>
                        Recent Activity
                    </h5>
                </div>
                <div class="card-body">
                    <div class="timeline">
                        <div class="timeline-item d-flex mb-3">
                            <div class="timeline-marker bg-success rounded-circle me-3" style="width: 12px; height: 12px; margin-top: 6px;"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">New user registered</h6>
                                <p class="text-muted mb-0">John Doe registered as a customer</p>
                                <small class="text-muted">2 minutes ago</small>
                            </div>
                        </div>
                        <div class="timeline-item d-flex mb-3">
                            <div class="timeline-marker bg-primary rounded-circle me-3" style="width: 12px; height: 12px; margin-top: 6px;"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Order completed</h6>
                                <p class="text-muted mb-0">Order #12345 has been completed successfully</p>
                                <small class="text-muted">1 hour ago</small>
                            </div>
                        </div>
                        <div class="timeline-item d-flex mb-3">
                            <div class="timeline-marker bg-warning rounded-circle me-3" style="width: 12px; height: 12px; margin-top: 6px;"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">System maintenance</h6>
                                <p class="text-muted mb-0">Scheduled maintenance completed</p>
                                <small class="text-muted">3 hours ago</small>
                            </div>
                        </div>
                        <div class="timeline-item d-flex">
                            <div class="timeline-marker bg-info rounded-circle me-3" style="width: 12px; height: 12px; margin-top: 6px;"></div>
                            <div class="timeline-content">
                                <h6 class="mb-1">Database backup</h6>
                                <p class="text-muted mb-0">Daily backup completed successfully</p>
                                <small class="text-muted">1 day ago</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- System Status -->
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-server me-2 text-info"></i>
                        System Status
                    </h5>
                </div>
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Database</span>
                        <span class="badge bg-success">Online</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>API Services</span>
                        <span class="badge bg-success">Online</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Email Service</span>
                        <span class="badge bg-success">Online</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <span>Storage</span>
                        <span class="badge bg-warning">75% Used</span>
                    </div>
                    <div class="d-flex justify-content-between align-items-center">
                        <span>Memory</span>
                        <span class="badge bg-success">45% Used</span>
                    </div>
                </div>
            </div>

            <!-- Quick Stats -->
            <div class="card mt-3">
                <div class="card-header">
                    <h5 class="card-title mb-0">
                        <i class="fas fa-chart-pie me-2 text-warning"></i>
                        Quick Stats
                    </h5>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Active Users</span>
                            <span class="fw-semibold">{{ $stats['total_users'] }}</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-primary" style="width: 85%"></div>
                        </div>
                    </div>
                    <div class="mb-3">
                        <div class="d-flex justify-content-between mb-1">
                            <span>Orders Today</span>
                            <span class="fw-semibold">24</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-success" style="width: 65%"></div>
                        </div>
                    </div>
                    <div>
                        <div class="d-flex justify-content-between mb-1">
                            <span>Revenue</span>
                            <span class="fw-semibold">$12,450</span>
                        </div>
                        <div class="progress" style="height: 6px;">
                            <div class="progress-bar bg-warning" style="width: 90%"></div>
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
    .timeline-item {
        position: relative;
    }

    .timeline-item:not(:last-child)::after {
        content: '';
        position: absolute;
        left: 5px;
        top: 18px;
        bottom: -15px;
        width: 2px;
        background-color: #e2e8f0;
    }

    .timeline-marker {
        flex-shrink: 0;
    }

    .timeline-content h6 {
        font-size: 0.875rem;
        font-weight: 600;
        margin-bottom: 0.25rem;
    }

    .timeline-content p {
        font-size: 0.8125rem;
        margin-bottom: 0.25rem;
    }

    .timeline-content small {
        font-size: 0.75rem;
    }
</style>
@endpush
