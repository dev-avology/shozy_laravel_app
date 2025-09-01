<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        // Hardcoded customers data
        $customers = collect([
            (object) [
                'id' => 1,
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1234567890',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=center',
                'status' => 'active',
                'total_orders' => 15,
                'completed_orders' => 12,
                'total_spent' => 456.75,
                'last_order_date' => now()->subDays(3),
                'location' => 'New York, NY',
                'joined_date' => now()->subMonths(6),
                'is_verified' => true,
                'preferred_payment' => 'Credit Card',
                'delivery_addresses' => 2
            ],
            (object) [
                'id' => 2,
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '+1987654321',
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=80&h=80&fit=crop&crop=center',
                'status' => 'active',
                'total_orders' => 28,
                'completed_orders' => 26,
                'total_spent' => 892.50,
                'last_order_date' => now()->subDays(1),
                'location' => 'Brooklyn, NY',
                'joined_date' => now()->subMonths(10),
                'is_verified' => true,
                'preferred_payment' => 'PayPal',
                'delivery_addresses' => 3
            ],
            (object) [
                'id' => 3,
                'name' => 'Mike Davis',
                'email' => 'mike.davis@example.com',
                'phone' => '+1555666777',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=center',
                'status' => 'inactive',
                'total_orders' => 8,
                'completed_orders' => 7,
                'total_spent' => 234.25,
                'last_order_date' => now()->subMonths(2),
                'location' => 'Queens, NY',
                'joined_date' => now()->subMonths(8),
                'is_verified' => false,
                'preferred_payment' => 'Cash on Delivery',
                'delivery_addresses' => 1
            ],
            (object) [
                'id' => 4,
                'name' => 'Emily Wilson',
                'email' => 'emily.wilson@example.com',
                'phone' => '+1444333222',
                'avatar' => 'https://images.unsplash.com/photo-1438761681033-6461ffad8d80?w=80&h=80&fit=crop&crop=center',
                'status' => 'active',
                'total_orders' => 42,
                'completed_orders' => 40,
                'total_spent' => 1245.80,
                'last_order_date' => now()->subHours(6),
                'location' => 'Manhattan, NY',
                'joined_date' => now()->subMonths(15),
                'is_verified' => true,
                'preferred_payment' => 'Credit Card',
                'delivery_addresses' => 4
            ]
        ]);

        // Calculate summary statistics
        $totalCustomers = $customers->count();
        $activeCustomers = $customers->where('status', 'active')->count();
        $totalOrders = $customers->sum('total_orders');
        $totalRevenue = $customers->sum('total_spent');
        $verifiedCustomers = $customers->where('is_verified', true)->count();

        return view('admin.customers.index', compact('customers', 'totalCustomers', 'activeCustomers', 'totalOrders', 'totalRevenue', 'verifiedCustomers'));
    }

    public function show($id)
    {
        // Hardcoded customer data
        $customer = (object) [
            'id' => 1,
            'name' => 'John Smith',
            'email' => 'john.smith@example.com',
            'phone' => '+1234567890',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=center',
            'status' => 'active',
            'total_orders' => 15,
            'completed_orders' => 12,
            'total_spent' => 456.75,
            'last_order_date' => now()->subDays(3),
            'location' => 'New York, NY',
            'joined_date' => now()->subMonths(6),
            'is_verified' => true,
            'preferred_payment' => 'Credit Card',
            'delivery_addresses' => 2,
            'bio' => 'Regular customer who loves premium shoe services',
            'preferences' => ['Premium Cleaning', 'Express Service', 'Contactless Delivery'],
            'notes' => 'Prefers evening deliveries between 6-8 PM'
        ];

        // Hardcoded order history data
        $orderHistory = collect([
            (object) [
                'id' => 1,
                'order_id' => 'ORD-001',
                'service' => 'Premium Shoe Cleaning',
                'amount' => 45.99,
                'status' => 'completed',
                'order_date' => now()->subDays(3),
                'delivery_date' => now()->subDays(2),
                'rating' => 5,
                'review' => 'Excellent service! My shoes look brand new.'
            ],
            (object) [
                'id' => 2,
                'order_id' => 'ORD-002',
                'service' => 'Basic Cleaning + Polish',
                'amount' => 32.50,
                'status' => 'completed',
                'order_date' => now()->subDays(10),
                'delivery_date' => now()->subDays(8),
                'rating' => 4,
                'review' => 'Good service, fast delivery.'
            ],
            (object) [
                'id' => 3,
                'order_id' => 'ORD-003',
                'service' => 'Leather Repair + Cleaning',
                'amount' => 78.25,
                'status' => 'completed',
                'order_date' => now()->subDays(20),
                'delivery_date' => now()->subDays(18),
                'rating' => 5,
                'review' => 'Amazing repair work! Highly recommended.'
            ]
        ]);

        // Hardcoded delivery addresses
        $deliveryAddresses = collect([
            (object) [
                'id' => 1,
                'type' => 'Home',
                'address' => '123 Main St, Apt 4B, New York, NY 10001',
                'is_default' => true,
                'contact_person' => 'John Smith',
                'contact_phone' => '+1234567890'
            ],
            (object) [
                'id' => 2,
                'type' => 'Office',
                'address' => '456 Business Ave, Suite 200, New York, NY 10002',
                'is_default' => false,
                'contact_person' => 'John Smith',
                'contact_phone' => '+1234567890'
            ]
        ]);

        return view('admin.customers.show', compact('customer', 'orderHistory', 'deliveryAddresses'));
    }

    public function orders($id)
    {
        // Hardcoded customer data
        $customer = (object) [
            'id' => 1,
            'name' => 'John Smith'
        ];

        // Hardcoded orders data
        $orders = collect([
            (object) [
                'id' => 1,
                'order_id' => 'ORD-001',
                'service' => 'Premium Shoe Cleaning',
                'amount' => 45.99,
                'status' => 'completed',
                'order_date' => now()->subDays(3),
                'delivery_date' => now()->subDays(2),
                'delivery_address' => '123 Main St, Apt 4B, New York, NY 10001',
                'payment_method' => 'Credit Card',
                'rating' => 5,
                'review' => 'Excellent service! My shoes look brand new.'
            ],
            (object) [
                'id' => 2,
                'order_id' => 'ORD-002',
                'service' => 'Basic Cleaning + Polish',
                'amount' => 32.50,
                'status' => 'completed',
                'order_date' => now()->subDays(10),
                'delivery_date' => now()->subDays(8),
                'delivery_address' => '123 Main St, Apt 4B, New York, NY 10001',
                'payment_method' => 'Credit Card',
                'rating' => 4,
                'review' => 'Good service, fast delivery.'
            ],
            (object) [
                'id' => 3,
                'order_id' => 'ORD-003',
                'service' => 'Leather Repair + Cleaning',
                'amount' => 78.25,
                'status' => 'completed',
                'order_date' => now()->subDays(20),
                'delivery_date' => now()->subDays(18),
                'delivery_address' => '456 Business Ave, Suite 200, New York, NY 10002',
                'payment_method' => 'Credit Card',
                'rating' => 5,
                'review' => 'Amazing repair work! Highly recommended.'
            ],
            (object) [
                'id' => 4,
                'order_id' => 'ORD-004',
                'service' => 'Express Cleaning',
                'amount' => 55.00,
                'status' => 'in_progress',
                'order_date' => now()->subHours(6),
                'delivery_date' => now()->addDays(1),
                'delivery_address' => '123 Main St, Apt 4B, New York, NY 10001',
                'payment_method' => 'PayPal',
                'rating' => null,
                'review' => null
            ]
        ]);

        return view('admin.customers.orders', compact('customer', 'orders'));
    }

    public function updateStatus(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Customer status updated successfully!');
    }

    public function blockCustomer(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Customer blocked successfully!');
    }

    public function unblockCustomer(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Customer unblocked successfully!');
    }

    public function addNote(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Note added successfully!');
    }
}
