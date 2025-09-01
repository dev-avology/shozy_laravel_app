<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class CouponController extends Controller
{
    public function index()
    {
        $coupons = collect([
            (object) [
                'id' => 1,
                'code' => 'WELCOME20',
                'type' => 'percentage',
                'value' => 20,
                'min_amount' => 50.00,
                'max_discount' => 100.00,
                'usage_limit' => 1000,
                'used_count' => 450,
                'status' => 'active',
                'start_date' => Carbon::now()->subMonths(2),
                'end_date' => Carbon::now()->addMonths(1),
                'applies_to' => 'all_products',
                'customer_groups' => ['new_customers'],
                'created_at' => Carbon::now()->subMonths(3)
            ],
            (object) [
                'id' => 2,
                'code' => 'SAVE50',
                'type' => 'fixed',
                'value' => 50.00,
                'min_amount' => 100.00,
                'max_discount' => 50.00,
                'usage_limit' => 500,
                'used_count' => 320,
                'status' => 'active',
                'start_date' => Carbon::now()->subMonth(),
                'end_date' => Carbon::now()->addMonths(2),
                'applies_to' => 'specific_categories',
                'customer_groups' => ['all_customers'],
                'created_at' => Carbon::now()->subMonth()
            ],
            (object) [
                'id' => 3,
                'code' => 'FLASH25',
                'type' => 'percentage',
                'value' => 25,
                'min_amount' => 25.00,
                'max_discount' => 75.00,
                'usage_limit' => 200,
                'used_count' => 200,
                'status' => 'expired',
                'start_date' => Carbon::now()->subDays(7),
                'end_date' => Carbon::now()->subDays(1),
                'applies_to' => 'all_products',
                'customer_groups' => ['all_customers'],
                'created_at' => Carbon::now()->subDays(10)
            ],
            (object) [
                'id' => 4,
                'code' => 'VIP30',
                'type' => 'percentage',
                'value' => 30,
                'min_amount' => 200.00,
                'max_discount' => 150.00,
                'usage_limit' => 100,
                'used_count' => 75,
                'status' => 'active',
                'start_date' => Carbon::now()->subDays(30),
                'end_date' => Carbon::now()->addMonths(3),
                'applies_to' => 'all_products',
                'customer_groups' => ['vip_customers'],
                'created_at' => Carbon::now()->subDays(35)
            ],
            (object) [
                'id' => 5,
                'code' => 'FREESHIP',
                'type' => 'shipping',
                'value' => 0.00,
                'min_amount' => 75.00,
                'max_discount' => 15.00,
                'usage_limit' => 300,
                'used_count' => 180,
                'status' => 'active',
                'start_date' => Carbon::now()->subDays(15),
                'end_date' => Carbon::now()->addMonths(1),
                'applies_to' => 'shipping_only',
                'customer_groups' => ['all_customers'],
                'created_at' => Carbon::now()->subDays(20)
            ]
        ]);

        $totalCoupons = $coupons->count();
        $activeCoupons = $coupons->where('status', 'active')->count();
        $totalUsage = $coupons->sum('used_count');
        $totalSavings = $coupons->sum(function($coupon) {
            if ($coupon->type === 'percentage') {
                return ($coupon->value / 100) * $coupon->used_count * 100; // Assuming average order value
            } elseif ($coupon->type === 'fixed') {
                return $coupon->value * $coupon->used_count;
            } else {
                return $coupon->max_discount * $coupon->used_count;
            }
        });

        return view('admin.coupons.index', compact('coupons', 'totalCoupons', 'activeCoupons', 'totalUsage', 'totalSavings'));
    }

    public function show($id)
    {
        $coupon = collect([
            (object) [
                'id' => 1,
                'code' => 'WELCOME20',
                'type' => 'percentage',
                'value' => 20,
                'min_amount' => 50.00,
                'max_discount' => 100.00,
                'usage_limit' => 1000,
                'used_count' => 450,
                'status' => 'active',
                'start_date' => Carbon::now()->subMonths(2),
                'end_date' => Carbon::now()->addMonths(1),
                'applies_to' => 'all_products',
                'customer_groups' => ['new_customers'],
                'description' => 'Welcome discount for new customers',
                'excluded_products' => [],
                'excluded_categories' => [],
                'created_at' => Carbon::now()->subMonths(3),
                'updated_at' => Carbon::now()->subDays(5)
            ]
        ])->firstWhere('id', $id);

        if (!$coupon) {
            abort(404);
        }

        $usageHistory = collect([
            (object) [
                'id' => 1,
                'order_id' => 'ORD-001',
                'customer' => 'John Smith',
                'order_amount' => 150.00,
                'discount_applied' => 30.00,
                'final_amount' => 120.00,
                'used_at' => Carbon::now()->subDays(2)
            ],
            (object) [
                'id' => 2,
                'order_id' => 'ORD-002',
                'customer' => 'Sarah Johnson',
                'order_amount' => 200.00,
                'discount_applied' => 40.00,
                'final_amount' => 160.00,
                'used_at' => Carbon::now()->subDays(1)
            ],
            (object) [
                'id' => 3,
                'order_id' => 'ORD-003',
                'customer' => 'Mike Davis',
                'order_amount' => 75.00,
                'discount_applied' => 15.00,
                'final_amount' => 60.00,
                'used_at' => Carbon::now()->subHours(6)
            ]
        ]);

        $statistics = [
            'total_orders' => $usageHistory->count(),
            'total_discount' => $usageHistory->sum('discount_applied'),
            'average_order_value' => $usageHistory->avg('order_amount'),
            'conversion_rate' => ($coupon->used_count / $coupon->usage_limit) * 100
        ];

        return view('admin.coupons.show', compact('coupon', 'usageHistory', 'statistics'));
    }

    public function create()
    {
        $types = ['percentage', 'fixed', 'shipping'];
        $statuses = ['active', 'inactive', 'expired'];
        $appliesTo = ['all_products', 'specific_categories', 'specific_products', 'shipping_only'];
        $customerGroups = ['all_customers', 'new_customers', 'vip_customers', 'returning_customers'];
        
        return view('admin.coupons.create', compact('types', 'statuses', 'appliesTo', 'customerGroups'));
    }

    public function store(Request $request)
    {
        // This would normally validate and store data
        // For now, just redirect back to index
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon created successfully!');
    }

    public function edit($id)
    {
        $coupon = collect([
            (object) [
                'id' => 1,
                'code' => 'WELCOME20',
                'type' => 'percentage',
                'value' => 20,
                'min_amount' => 50.00,
                'max_discount' => 100.00,
                'usage_limit' => 1000,
                'used_count' => 450,
                'status' => 'active',
                'start_date' => Carbon::now()->subMonths(2),
                'end_date' => Carbon::now()->addMonths(1),
                'applies_to' => 'all_products',
                'customer_groups' => ['new_customers'],
                'description' => 'Welcome discount for new customers'
            ]
        ])->firstWhere('id', $id);

        if (!$coupon) {
            abort(404);
        }

        $types = ['percentage', 'fixed', 'shipping'];
        $statuses = ['active', 'inactive', 'expired'];
        $appliesTo = ['all_products', 'specific_categories', 'specific_products', 'shipping_only'];
        $customerGroups = ['all_customers', 'new_customers', 'vip_customers', 'returning_customers'];

        return view('admin.coupons.edit', compact('coupon', 'types', 'statuses', 'appliesTo', 'customerGroups'));
    }

    public function update(Request $request, $id)
    {
        // This would normally validate and update data
        // For now, just redirect back to show
        return redirect()->route('admin.coupons.show', $id)->with('success', 'Coupon updated successfully!');
    }

    public function destroy($id)
    {
        // This would normally delete the coupon
        // For now, just redirect back to index
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon deleted successfully!');
    }

    public function updateStatus(Request $request, $id)
    {
        // This would normally update the coupon status
        // For now, just return success response
        return response()->json(['success' => true, 'message' => 'Status updated successfully']);
    }

    public function duplicate($id)
    {
        // This would normally duplicate the coupon
        // For now, just redirect back to index
        return redirect()->route('admin.coupons.index')->with('success', 'Coupon duplicated successfully!');
    }

    public function analytics($id)
    {
        $coupon = collect([
            (object) [
                'id' => 1,
                'code' => 'WELCOME20',
                'type' => 'percentage',
                'value' => 20
            ]
        ])->firstWhere('id', $id);

        if (!$coupon) {
            abort(404);
        }

        $monthlyUsage = collect([
            (object) ['month' => 'January 2024', 'usage' => 45, 'revenue' => 2250.00],
            (object) ['month' => 'February 2024', 'usage' => 52, 'revenue' => 2600.00],
            (object) ['month' => 'March 2024', 'usage' => 38, 'revenue' => 1900.00],
            (object) ['month' => 'April 2024', 'usage' => 61, 'revenue' => 3050.00],
            (object) ['month' => 'May 2024', 'usage' => 48, 'revenue' => 2400.00],
            (object) ['month' => 'June 2024', 'usage' => 55, 'revenue' => 2750.00]
        ]);

        $customerSegments = collect([
            (object) ['segment' => 'New Customers', 'usage' => 65, 'percentage' => 65],
            (object) ['segment' => 'Returning Customers', 'usage' => 25, 'percentage' => 25],
            (object) ['segment' => 'VIP Customers', 'usage' => 10, 'percentage' => 10]
        ]);

        $topProducts = collect([
            (object) ['product' => 'Premium Cleaning Service', 'usage' => 25, 'revenue' => 1250.00],
            (object) ['product' => 'Express Delivery', 'usage' => 20, 'revenue' => 1000.00],
            (object) ['product' => 'Standard Service', 'usage' => 15, 'revenue' => 750.00]
        ]);

        return view('admin.coupons.analytics', compact('coupon', 'monthlyUsage', 'customerSegments', 'topProducts'));
    }
}
