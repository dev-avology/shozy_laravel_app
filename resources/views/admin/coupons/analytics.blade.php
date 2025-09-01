@extends('admin.layouts.app')

@section('title', 'Coupon Analytics')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">{{ $coupon->code }} - Analytics</h1>
            <p class="text-muted">Performance metrics and usage insights</p>
        </div>
        <div>
            <a href="{{ route('admin.coupons.show', $coupon->id) }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Coupon
            </a>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-primary">
                <i class="fas fa-list me-2"></i>All Coupons
            </a>
        </div>
    </div>

    <!-- Key Metrics -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Total Usage</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $monthlyUsage->sum('usage') }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-ticket-alt fa-2x text-gray-300"></i>
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
                                Total Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($monthlyUsage->sum('revenue'), 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
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
                                Avg Monthly Usage</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ number_format($monthlyUsage->avg('usage'), 1) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-line fa-2x text-gray-300"></i>
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
                                Avg Monthly Revenue</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">${{ number_format($monthlyUsage->avg('revenue'), 2) }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-chart-bar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <!-- Monthly Usage Chart -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Monthly Usage Trends</h6>
                </div>
                <div class="card-body">
                    <canvas id="monthlyUsageChart" width="400" height="200"></canvas>
                </div>
            </div>

            <!-- Top Products -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Top Products Using This Coupon</h6>
                </div>
                <div class="card-body">
                    @if($topProducts->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-bordered table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>Product</th>
                                        <th>Usage Count</th>
                                        <th>Revenue Generated</th>
                                        <th>Percentage</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($topProducts as $product)
                                    <tr>
                                        <td>
                                            <strong>{{ $product->product }}</strong>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary">{{ $product->usage }}</span>
                                        </td>
                                        <td>
                                            <span class="fw-bold text-success">${{ number_format($product->revenue, 2) }}</span>
                                        </td>
                                        <td>
                                            <div class="progress" style="height: 20px;">
                                                @php
                                                    $percentage = ($product->usage / $topProducts->sum('usage')) * 100;
                                                @endphp
                                                <div class="progress-bar bg-info" style="width: {{ $percentage }}%">
                                                    {{ number_format($percentage, 1) }}%
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-box fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">No Product Data</h6>
                            <p class="text-muted">No products have used this coupon yet.</p>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Customer Segments -->
            <div class="card shadow mb-4">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Customer Segments</h6>
                </div>
                <div class="card-body">
                    @if($customerSegments->count() > 0)
                        <canvas id="customerSegmentsChart" width="300" height="300"></canvas>
                        <div class="mt-3">
                            @foreach($customerSegments as $segment)
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <span class="text-muted">{{ $segment->segment }}</span>
                                <span class="fw-bold">{{ $segment->usage }} ({{ $segment->percentage }}%)</span>
                            </div>
                            @endforeach
                        </div>
                    @else
                        <div class="text-center py-4">
                            <i class="fas fa-users fa-2x text-muted mb-3"></i>
                            <h6 class="text-muted">No Customer Data</h6>
                            <p class="text-muted">No customer segment data available.</p>
                        </div>
                    @endif
                </div>
            </div>

            <!-- Performance Insights -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Performance Insights</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-primary">Best Month</h6>
                        @php
                            $bestMonth = $monthlyUsage->sortByDesc('usage')->first();
                        @endphp
                        <p class="mb-1"><strong>{{ $bestMonth->month }}</strong></p>
                        <small class="text-muted">{{ $bestMonth->usage }} uses, ${{ number_format($bestMonth->revenue, 2) }} revenue</small>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">Growth Trend</h6>
                        @php
                            $firstMonth = $monthlyUsage->first();
                            $lastMonth = $monthlyUsage->last();
                            $growth = $lastMonth && $firstMonth ? (($lastMonth->usage - $firstMonth->usage) / $firstMonth->usage) * 100 : 0;
                        @endphp
                        <p class="mb-1">
                            <span class="badge bg-{{ $growth >= 0 ? 'success' : 'danger' }}">
                                {{ $growth >= 0 ? '+' : '' }}{{ number_format($growth, 1) }}%
                            </span>
                        </p>
                        <small class="text-muted">From {{ $firstMonth->month ?? 'N/A' }} to {{ $lastMonth->month ?? 'N/A' }}</small>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">Recommendations</h6>
                        <ul class="list-unstyled">
                            @if($growth < 0)
                                <li class="text-danger mb-1">• Usage is declining - consider promotional campaigns</li>
                            @endif
                            @if($monthlyUsage->avg('usage') < 10)
                                <li class="text-warning mb-1">• Low monthly usage - review targeting strategy</li>
                            @endif
                            @if($monthlyUsage->avg('revenue') > 2000)
                                <li class="text-success mb-1">• High revenue generation - consider expanding reach</li>
                            @endif
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Monthly Usage Chart
    const monthlyCtx = document.getElementById('monthlyUsageChart').getContext('2d');
    const monthlyChart = new Chart(monthlyCtx, {
        type: 'line',
        data: {
            labels: {!! json_encode($monthlyUsage->pluck('month')) !!},
            datasets: [{
                label: 'Usage Count',
                data: {!! json_encode($monthlyUsage->pluck('usage')) !!},
                borderColor: 'rgb(75, 192, 192)',
                backgroundColor: 'rgba(75, 192, 192, 0.2)',
                tension: 0.1,
                yAxisID: 'y'
            }, {
                label: 'Revenue ($)',
                data: {!! json_encode($monthlyUsage->pluck('revenue')) !!},
                borderColor: 'rgb(255, 99, 132)',
                backgroundColor: 'rgba(255, 99, 132, 0.2)',
                tension: 0.1,
                yAxisID: 'y1'
            }]
        },
        options: {
            responsive: true,
            interaction: {
                mode: 'index',
                intersect: false,
            },
            scales: {
                y: {
                    type: 'linear',
                    display: true,
                    position: 'left',
                    title: {
                        display: true,
                        text: 'Usage Count'
                    }
                },
                y1: {
                    type: 'linear',
                    display: true,
                    position: 'right',
                    title: {
                        display: true,
                        text: 'Revenue ($)'
                    },
                    grid: {
                        drawOnChartArea: false,
                    },
                }
            }
        }
    });

    // Customer Segments Chart
    const customerCtx = document.getElementById('customerSegmentsChart');
    if (customerCtx) {
        const customerChart = new Chart(customerCtx, {
            type: 'doughnut',
            data: {
                labels: {!! json_encode($customerSegments->pluck('segment')) !!},
                datasets: [{
                    data: {!! json_encode($customerSegments->pluck('usage')) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.8)',
                        'rgba(54, 162, 235, 0.8)',
                        'rgba(255, 205, 86, 0.8)',
                        'rgba(75, 192, 192, 0.8)'
                    ],
                    borderWidth: 2,
                    borderColor: '#fff'
                }]
            },
            options: {
                responsive: true,
                maintainAspectRatio: false,
                plugins: {
                    legend: {
                        position: 'bottom'
                    }
                }
            }
        });
    }
});
</script>
@endpush

@push('styles')
<style>
.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.progress {
    background-color: #e9ecef;
}

.table th {
    background-color: #f8f9fa;
    border-color: #dee2e6;
    font-weight: 600;
}

.badge {
    font-size: 0.75rem;
}
</style>
@endpush
