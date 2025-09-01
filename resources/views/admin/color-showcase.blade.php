@extends('admin.layouts.app')

@section('title', 'Color Showcase')
@section('page-title', 'Color Showcase - Shozy App Design System')

@section('content')
<div class="container-fluid">
    <!-- Header Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="gradient-text mb-3">Shozy App Design System</h1>
                    <p class="text-muted fs-5">Color scheme and design elements matching your mobile app</p>
                </div>
            </div>
        </div>
    </div>

    <!-- Color Palette Section -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-palette me-2"></i>
                        Color Palette
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <!-- Primary Colors -->
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="bg-primary rounded-circle mx-auto mb-2" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">#FF7F27</div>
                                <h6>Primary Orange</h6>
                                <small class="text-muted">Main accent color</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="bg-light rounded-circle mx-auto mb-2" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; color: var(--dark-color); font-weight: bold;">#F8F5F0</div>
                                <h6>Header Background</h6>
                                <small class="text-muted">Light beige/off-white</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="bg-success rounded-circle mx-auto mb-2" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold;">#4CAF50</div>
                                <h6>Success Green</h6>
                                <small class="text-muted">Checkmarks & success</small>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="text-center">
                                <div class="rounded-circle mx-auto mb-2" style="width: 80px; height: 80px; display: flex; align-items: center; justify-content: center; color: white; font-weight: bold; background: var(--accent-blue);">#00BCD4</div>
                                <h6>Accent Blue</h6>
                                <small class="text-muted">Diamond tier accent</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Button Showcase -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-toggle-on me-2"></i>
                        Button Styles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <h6>Primary Buttons</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                <button class="btn btn-primary">Primary Button</button>
                                <button class="btn btn-outline-primary">Outline Primary</button>
                                <button class="btn btn-primary btn-sm">Small</button>
                                <button class="btn btn-primary btn-lg">Large</button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <h6>Action Buttons</h6>
                            <div class="d-flex gap-2 flex-wrap">
                                <button class="btn btn-success">Success</button>
                                <button class="btn btn-warning">Warning</button>
                                <button class="btn btn-danger">Danger</button>
                                <button class="btn btn-info">Info</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Form Elements Showcase -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-edit me-2"></i>
                        Form Elements
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-6">
                            <label for="exampleInput" class="form-label">Text Input</label>
                            <input type="text" class="form-control" id="exampleInput" placeholder="Enter text here">
                        </div>
                        <div class="col-md-6">
                            <label for="exampleSelect" class="form-label">Select Dropdown</label>
                            <select class="form-select" id="exampleSelect">
                                <option>Choose an option</option>
                                <option>Option 1</option>
                                <option>Option 2</option>
                                <option>Option 3</option>
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label for="exampleTextarea" class="form-label">Textarea</label>
                            <textarea class="form-control" id="exampleTextarea" rows="3" placeholder="Enter your message"></textarea>
                        </div>
                        <div class="col-md-6">
                            <label class="form-label">Checkboxes</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check1">
                                <label class="form-check-label" for="check1">Option 1</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="check2">
                                <label class="form-check-label" for="check2">Option 2</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Card Showcase -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-layer-group me-2"></i>
                        Card Styles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="card card-hover">
                                <div class="card-body text-center">
                                    <i class="fas fa-star fa-3x text-primary mb-3"></i>
                                    <h5>Feature Card</h5>
                                    <p class="text-muted">Hover over this card to see the effect</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-heart fa-3x text-danger mb-3"></i>
                                    <h5>Regular Card</h5>
                                    <p class="text-muted">Standard card without hover effects</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="card">
                                <div class="card-body text-center">
                                    <i class="fas fa-lightbulb fa-3x text-warning mb-3"></i>
                                    <h5>Info Card</h5>
                                    <p class="text-muted">Another example card</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Pricing Cards (Mobile App Style) -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-tags me-2"></i>
                        Pricing Cards (Mobile App Style)
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-4">
                        <div class="col-md-6">
                            <div class="pricing-card">
                                <div class="pricing-tier">Platinum</div>
                                <div class="pricing-amount">AED 1200</div>
                                <div class="pricing-duration">/6 months</div>
                                <div class="pricing-requirement">Requirement: 101-200 free products</div>
                                <ul class="benefit-list">
                                    <li>All Gold benefits</li>
                                    <li>Full banner on the app's home page</li>
                                    <li>Special social media campaign</li>
                                    <li>Products listed under 'Exclusive Offers'</li>
                                    <li>Partner logo featured in notifications</li>
                                </ul>
                                <button class="btn btn-primary w-100">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Select & Pay
                                </button>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="pricing-card">
                                <div class="pricing-tier" style="color: var(--accent-blue);">Diamond</div>
                                <div class="pricing-amount">AED 2000</div>
                                <div class="pricing-duration">/12 months (1 year)</div>
                                <div class="pricing-requirement">Requirement: 200+ free products</div>
                                <ul class="benefit-list">
                                    <li>All Platinum benefits</li>
                                    <li>Premium placement in all sections</li>
                                    <li>Dedicated account manager</li>
                                    <li>Priority customer support</li>
                                    <li>Exclusive partnership events</li>
                                </ul>
                                <button class="btn btn-primary w-100">
                                    <i class="fas fa-credit-card me-2"></i>
                                    Select & Pay
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Status Indicators -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-info-circle me-2"></i>
                        Status Indicators
                    </h5>
                </div>
                <div class="card-body">
                    <div class="row g-3">
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <span class="status-indicator status-active"></span>
                                <span>Active Status</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <span class="status-indicator status-inactive"></span>
                                <span>Inactive Status</span>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="d-flex align-items-center">
                                <span class="status-indicator status-pending"></span>
                                <span>Pending Status</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Alerts Showcase -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        Alert Styles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="alert alert-success">
                        <i class="fas fa-check-circle me-2"></i>
                        This is a success alert with the new design!
                    </div>
                    <div class="alert alert-warning">
                        <i class="fas fa-exclamation-triangle me-2"></i>
                        This is a warning alert with the new design!
                    </div>
                    <div class="alert alert-danger">
                        <i class="fas fa-times-circle me-2"></i>
                        This is a danger alert with the new design!
                    </div>
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle me-2"></i>
                        This is an info alert with the new design!
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Table Showcase -->
    <div class="row mb-4">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title">
                        <i class="fas fa-table me-2"></i>
                        Table Styles
                    </h5>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th>Role</th>
                                    <th>Status</th>
                                    <th>Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>John Doe</td>
                                    <td><span class="badge bg-primary">Admin</span></td>
                                    <td><span class="badge bg-success">Active</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-primary">Edit</button>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Jane Smith</td>
                                    <td><span class="badge bg-info">User</span></td>
                                    <td><span class="badge bg-warning">Pending</span></td>
                                    <td>
                                        <button class="btn btn-sm btn-outline-warning">Review</button>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Floating Action Button -->
<a href="#" class="fab">
    <i class="fas fa-plus"></i>
</a>
@endsection

@push('styles')
<style>
    .gradient-text {
        background: linear-gradient(135deg, var(--primary-color) 0%, var(--accent-blue) 100%);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
        background-clip: text;
        font-weight: 700;
    }
</style>
@endpush
