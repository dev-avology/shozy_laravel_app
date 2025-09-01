<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DeliveryController extends Controller
{
    public function index()
    {
        // Hardcoded delivery users data
        $deliveryUsers = collect([
            (object) [
                'id' => 1,
                'name' => 'Alex Rodriguez',
                'email' => 'alex.rodriguez@delivery.com',
                'phone' => '+1234567890',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=center',
                'status' => 'online',
                'rating' => 4.9,
                'total_deliveries' => 89,
                'completed_deliveries' => 85,
                'this_week_earnings' => 156.75,
                'total_earnings' => 2340.50,
                'current_deliveries' => 2,
                'vehicle_type' => 'Motorcycle',
                'vehicle_number' => 'MC-1234',
                'location' => 'New York, NY',
                'joined_date' => now()->subMonths(8),
                'is_verified' => true,
                'is_active' => true
            ],
            (object) [
                'id' => 2,
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@delivery.com',
                'phone' => '+1987654321',
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=80&h=80&fit=crop&crop=center',
                'status' => 'busy',
                'rating' => 4.8,
                'total_deliveries' => 156,
                'completed_deliveries' => 152,
                'this_week_earnings' => 189.25,
                'total_earnings' => 3456.75,
                'current_deliveries' => 1,
                'vehicle_type' => 'Car',
                'vehicle_number' => 'CAR-5678',
                'location' => 'Brooklyn, NY',
                'joined_date' => now()->subMonths(12),
                'is_verified' => true,
                'is_active' => true
            ],
            (object) [
                'id' => 3,
                'name' => 'Mike Davis',
                'email' => 'mike.davis@delivery.com',
                'phone' => '+1555666777',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=center',
                'status' => 'offline',
                'rating' => 4.7,
                'total_deliveries' => 203,
                'completed_deliveries' => 198,
                'this_week_earnings' => 134.50,
                'total_earnings' => 4567.25,
                'current_deliveries' => 0,
                'vehicle_type' => 'Bicycle',
                'vehicle_number' => 'BIKE-9012',
                'location' => 'Queens, NY',
                'joined_date' => now()->subMonths(15),
                'is_verified' => true,
                'is_active' => false
            ]
        ]);

        // Calculate summary statistics
        $totalDeliveryUsers = $deliveryUsers->count();
        $onlineDeliveryUsers = $deliveryUsers->where('status', 'online')->count();
        $totalDeliveries = $deliveryUsers->sum('total_deliveries');
        $totalEarnings = $deliveryUsers->sum('total_earnings');
        $activeDeliveries = $deliveryUsers->sum('current_deliveries');

        return view('admin.deliveries.index', compact('deliveryUsers', 'totalDeliveryUsers', 'onlineDeliveryUsers', 'totalDeliveries', 'totalEarnings', 'activeDeliveries'));
    }

    public function show($id)
    {
        // Hardcoded delivery user data
        $deliveryUser = (object) [
            'id' => 1,
            'name' => 'Alex Rodriguez',
            'email' => 'alex.rodriguez@delivery.com',
            'phone' => '+1234567890',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=center',
            'status' => 'online',
            'rating' => 4.9,
            'total_deliveries' => 89,
            'completed_deliveries' => 85,
            'this_week_earnings' => 156.75,
            'total_earnings' => 2340.50,
            'current_deliveries' => 2,
            'vehicle_type' => 'Motorcycle',
            'vehicle_number' => 'MC-1234',
            'location' => 'New York, NY',
            'joined_date' => now()->subMonths(8),
            'is_verified' => true,
            'is_active' => true,
            'bio' => 'Professional delivery driver with 8+ years of experience. Expert in fast and safe deliveries across NYC.',
            'working_hours' => 'Mon-Sat: 8AM-8PM',
            'service_areas' => ['Manhattan', 'Brooklyn', 'Queens'],
            'specializations' => ['Food Delivery', 'Package Delivery', 'Express Delivery']
        ];

        // Hardcoded current deliveries data
        $currentDeliveries = collect([
            (object) [
                'id' => 1,
                'order_id' => 'ORD-001',
                'customer_name' => 'Sarah Johnson',
                'pickup_address' => '123 Main St, New York, NY',
                'dropoff_address' => '456 Oak Ave, Brooklyn, NY',
                'scheduled_time' => '2:30 PM',
                'estimated_duration' => '25 min',
                'distance' => '3.2 km',
                'status' => 'in_progress',
                'earnings' => 12.50,
                'notes' => 'Customer requested contactless delivery'
            ],
            (object) [
                'id' => 2,
                'order_id' => 'ORD-002',
                'customer_name' => 'Mike Davis',
                'pickup_address' => '789 Pine St, Queens, NY',
                'dropoff_address' => '321 Elm St, Bronx, NY',
                'scheduled_time' => '4:15 PM',
                'estimated_duration' => '35 min',
                'distance' => '4.8 km',
                'status' => 'assigned',
                'earnings' => 18.75,
                'notes' => 'Fragile items - handle with care'
            ]
        ]);

        // Hardcoded recent deliveries data
        $recentDeliveries = collect([
            (object) [
                'id' => 3,
                'order_id' => 'ORD-003',
                'customer_name' => 'John Smith',
                'pickup_address' => '555 Broadway, Manhattan, NY',
                'dropoff_address' => '777 5th Ave, Manhattan, NY',
                'completed_time' => '1:45 PM',
                'actual_duration' => '22 min',
                'distance' => '2.8 km',
                'status' => 'completed',
                'earnings' => 15.00,
                'rating' => 5
            ],
            (object) [
                'id' => 4,
                'order_id' => 'ORD-004',
                'customer_name' => 'Emily Wilson',
                'pickup_address' => '888 Park Ave, Brooklyn, NY',
                'dropoff_address' => '999 Madison Ave, Manhattan, NY',
                'completed_time' => '12:30 PM',
                'actual_duration' => '28 min',
                'distance' => '3.5 km',
                'status' => 'completed',
                'earnings' => 16.25,
                'rating' => 5
            ]
        ]);

        return view('admin.deliveries.show', compact('deliveryUser', 'currentDeliveries', 'recentDeliveries'));
    }

    public function tracking($id)
    {
        // Hardcoded tracking data
        $deliveryUser = (object) [
            'id' => 1,
            'name' => 'Alex Rodriguez',
            'status' => 'online',
            'current_location' => '40.7128, -74.0060', // NYC coordinates
            'last_updated' => now()->subMinutes(5)
        ];

        $activeDeliveries = collect([
            (object) [
                'id' => 1,
                'order_id' => 'ORD-001',
                'customer_name' => 'Sarah Johnson',
                'pickup_address' => '123 Main St, New York, NY',
                'dropoff_address' => '456 Oak Ave, Brooklyn, NY',
                'pickup_coordinates' => '40.7589, -73.9851',
                'dropoff_coordinates' => '40.7182, -73.9584',
                'current_status' => 'in_progress',
                'progress' => 65, // percentage
                'estimated_arrival' => '2:55 PM',
                'earnings' => 12.50
            ]
        ]);

        return view('admin.deliveries.tracking', compact('deliveryUser', 'activeDeliveries'));
    }

    public function orders($id)
    {
        // Hardcoded orders data
        $deliveryUser = (object) [
            'id' => 1,
            'name' => 'Alex Rodriguez'
        ];

        $assignedOrders = collect([
            (object) [
                'id' => 1,
                'order_id' => 'ORD-001',
                'customer_name' => 'Sarah Johnson',
                'pickup_address' => '123 Main St, New York, NY',
                'dropoff_address' => '456 Oak Ave, Brooklyn, NY',
                'scheduled_time' => '2:30 PM',
                'estimated_duration' => '25 min',
                'distance' => '3.2 km',
                'status' => 'assigned',
                'earnings' => 12.50,
                'priority' => 'high',
                'notes' => 'Customer requested contactless delivery'
            ],
            (object) [
                'id' => 2,
                'order_id' => 'ORD-002',
                'customer_name' => 'Mike Davis',
                'pickup_address' => '789 Pine St, Queens, NY',
                'dropoff_address' => '321 Elm St, Bronx, NY',
                'scheduled_time' => '4:15 PM',
                'estimated_duration' => '35 min',
                'distance' => '4.8 km',
                'status' => 'pending',
                'earnings' => 18.75,
                'priority' => 'medium',
                'notes' => 'Fragile items - handle with care'
            ]
        ]);

        return view('admin.deliveries.orders', compact('deliveryUser', 'assignedOrders'));
    }

    public function updateStatus(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Delivery user status updated successfully!');
    }

    public function assignOrder(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Order assigned successfully!');
    }

    public function updateDeliveryStatus(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Delivery status updated successfully!');
    }
}
