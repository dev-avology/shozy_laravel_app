@extends('admin.layouts.app')

@section('title', 'Create Coupon')

@section('content')
<div class="container-fluid">
    <!-- Page Header -->
    <div class="d-flex justify-content-between align-items-center mb-4">
        <div>
            <h1 class="h3 mb-0 text-gray-800">Create New Coupon</h1>
            <p class="text-muted">Add a new discount code or promotion</p>
        </div>
        <div>
            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">
                <i class="fas fa-arrow-left me-2"></i>Back to Coupons
            </a>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-8">
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Coupon Details</h6>
                </div>
                <div class="card-body">
                    <form action="{{ route('admin.coupons.store') }}" method="POST">
                        @csrf
                        
                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="code" class="form-label">Coupon Code <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control @error('code') is-invalid @enderror" 
                                           id="code" name="code" value="{{ old('code') }}" 
                                           placeholder="e.g., WELCOME20" required>
                                    @error('code')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Unique code that customers will enter</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="type" class="form-label">Discount Type <span class="text-danger">*</span></label>
                                    <select class="form-select @error('type') is-invalid @enderror" 
                                            id="type" name="type" required>
                                        <option value="">Select Type</option>
                                        @foreach($types as $type)
                                            <option value="{{ $type }}" {{ old('type') == $type ? 'selected' : '' }}>
                                                @switch($type)
                                                    @case('percentage')
                                                        Percentage Discount
                                                        @break
                                                    @case('fixed')
                                                        Fixed Amount Discount
                                                        @break
                                                    @case('shipping')
                                                        Free Shipping
                                                        @break
                                                    @default
                                                        {{ ucfirst($type) }}
                                                @endswitch
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('type')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="value" class="form-label">Discount Value <span class="text-danger">*</span></label>
                                    <div class="input-group">
                                        <input type="number" class="form-control @error('value') is-invalid @enderror" 
                                               id="value" name="value" value="{{ old('value') }}" 
                                               step="0.01" min="0" required>
                                        <span class="input-group-text" id="valueSuffix">%</span>
                                    </div>
                                    @error('value')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Percentage, fixed amount, or shipping discount</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_discount" class="form-label">Maximum Discount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control @error('max_discount') is-invalid @enderror" 
                                               id="max_discount" name="max_discount" value="{{ old('max_discount') }}" 
                                               step="0.01" min="0">
                                    </div>
                                    @error('max_discount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Maximum discount amount (leave empty for no limit)</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_amount" class="form-label">Minimum Order Amount</label>
                                    <div class="input-group">
                                        <span class="input-group-text">$</span>
                                        <input type="number" class="form-control @error('min_amount') is-invalid @enderror" 
                                               id="min_amount" name="min_amount" value="{{ old('min_amount') }}" 
                                               step="0.01" min="0">
                                    </div>
                                    @error('min_amount')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Minimum order value to apply coupon</small>
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="usage_limit" class="form-label">Usage Limit <span class="text-danger">*</span></label>
                                    <input type="number" class="form-control @error('usage_limit') is-invalid @enderror" 
                                           id="usage_limit" name="usage_limit" value="{{ old('usage_limit') }}" 
                                           min="1" required>
                                    @error('usage_limit')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                    <small class="form-text text-muted">Maximum number of times this coupon can be used</small>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Start Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('start_date') is-invalid @enderror" 
                                           id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                                    @error('start_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">End Date <span class="text-danger">*</span></label>
                                    <input type="date" class="form-control @error('end_date') is-invalid @enderror" 
                                           id="end_date" name="end_date" value="{{ old('end_date') }}" required>
                                    @error('end_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="applies_to" class="form-label">Applies To</label>
                                    <select class="form-select @error('applies_to') is-invalid @enderror" 
                                            id="applies_to" name="applies_to">
                                        @foreach($appliesTo as $option)
                                            <option value="{{ $option }}" {{ old('applies_to') == $option ? 'selected' : '' }}>
                                                @switch($option)
                                                    @case('all_products')
                                                        All Products
                                                        @break
                                                    @case('specific_categories')
                                                        Specific Categories
                                                        @break
                                                    @case('specific_products')
                                                        Specific Products
                                                        @break
                                                    @case('shipping_only')
                                                        Shipping Only
                                                        @break
                                                    @default
                                                        {{ ucwords(str_replace('_', ' ', $option)) }}
                                                @endswitch
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('applies_to')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="status" class="form-label">Status</label>
                                    <select class="form-select @error('status') is-invalid @enderror" 
                                            id="status" name="status">
                                        @foreach($statuses as $status)
                                            <option value="{{ $status }}" {{ old('status') == $status ? 'selected' : '' }}>
                                                {{ ucfirst($status) }}
                                            </option>
                                        @endforeach
                                    </select>
                                    @error('status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="customer_groups" class="form-label">Customer Groups</label>
                            <select class="form-select @error('customer_groups') is-invalid @enderror" 
                                    id="customer_groups" name="customer_groups[]" multiple>
                                @foreach($customerGroups as $group)
                                    <option value="{{ $group }}" {{ in_array($group, old('customer_groups', [])) ? 'selected' : '' }}>
                                        @switch($group)
                                            @case('all_customers')
                                                All Customers
                                                @break
                                            @case('new_customers')
                                                New Customers
                                                @break
                                            @case('vip_customers')
                                                VIP Customers
                                                @break
                                            @case('returning_customers')
                                                Returning Customers
                                                @break
                                            @default
                                                {{ ucwords(str_replace('_', ' ', $group)) }}
                                        @endswitch
                                    </option>
                                @endforeach
                            </select>
                            @error('customer_groups')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                            <small class="form-text text-muted">Hold Ctrl/Cmd to select multiple groups</small>
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                      id="description" name="description" rows="3" 
                                      placeholder="Optional description for internal use">{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end gap-2">
                            <a href="{{ route('admin.coupons.index') }}" class="btn btn-secondary">Cancel</a>
                            <button type="submit" class="btn btn-primary">
                                <i class="fas fa-save me-2"></i>Create Coupon
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-4">
            <!-- Help Card -->
            <div class="card shadow">
                <div class="card-header py-3">
                    <h6 class="m-0 font-weight-bold text-primary">Coupon Guidelines</h6>
                </div>
                <div class="card-body">
                    <div class="mb-3">
                        <h6 class="text-primary">Percentage Discounts</h6>
                        <small class="text-muted">Use for flexible discounts (e.g., 20% off). Set max discount to prevent excessive savings.</small>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">Fixed Amount Discounts</h6>
                        <small class="text-muted">Use for specific dollar amounts (e.g., $50 off). Good for clearance sales.</small>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">Free Shipping</h6>
                        <small class="text-muted">Use to encourage larger orders. Set minimum order amount to ensure profitability.</small>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">Usage Limits</h6>
                        <small class="text-muted">Set reasonable limits to prevent abuse and control marketing costs.</small>
                    </div>
                    
                    <div class="mb-3">
                        <h6 class="text-primary">Validity Period</h6>
                        <small class="text-muted">Create urgency with limited-time offers. Monitor performance during active periods.</small>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    const typeSelect = document.getElementById('type');
    const valueInput = document.getElementById('value');
    const valueSuffix = document.getElementById('valueSuffix');
    const maxDiscountGroup = document.getElementById('max_discount').closest('.mb-3');
    
    function updateValueField() {
        const selectedType = typeSelect.value;
        
        if (selectedType === 'percentage') {
            valueSuffix.textContent = '%';
            valueInput.placeholder = '20';
            maxDiscountGroup.style.display = 'block';
        } else if (selectedType === 'fixed') {
            valueSuffix.textContent = '$';
            valueInput.placeholder = '50.00';
            maxDiscountGroup.style.display = 'none';
        } else if (selectedType === 'shipping') {
            valueSuffix.textContent = '$';
            valueInput.placeholder = '0.00';
            valueInput.value = '0';
            maxDiscountGroup.style.display = 'block';
        }
    }
    
    typeSelect.addEventListener('change', updateValueField);
    updateValueField();
    
    // Set default dates
    const today = new Date().toISOString().split('T')[0];
    const nextMonth = new Date();
    nextMonth.setMonth(nextMonth.getMonth() + 1);
    const nextMonthStr = nextMonth.toISOString().split('T')[0];
    
    if (!document.getElementById('start_date').value) {
        document.getElementById('start_date').value = today;
    }
    if (!document.getElementById('end_date').value) {
        document.getElementById('end_date').value = nextMonthStr;
    }
});
</script>
@endpush

@push('styles')
<style>
.form-label {
    font-weight: 600;
    color: #495057;
}

.card-header {
    background-color: #f8f9fa;
    border-bottom: 1px solid #dee2e6;
}

.form-control:focus, .form-select:focus {
    border-color: #80bdff;
    box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
}
</style>
@endpush
