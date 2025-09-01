<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TechnicianController extends Controller
{
    public function index()
    {
        // Hardcoded technicians data
        $technicians = collect([
            (object) [
                'id' => 1,
                'name' => 'John Smith',
                'email' => 'john.smith@example.com',
                'phone' => '+1234567890',
                'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=center',
                'status' => 'online',
                'rating' => 4.8,
                'total_jobs' => 156,
                'completed_jobs' => 142,
                'total_earnings' => 342.75,
                'this_week_earnings' => 89.99,
                'pending_payout' => 156.50,
                'specialization' => 'Shoe Cleaning & Repair',
                'location' => 'New York, NY',
                'joined_date' => now()->subMonths(6),
                'current_jobs' => 2,
                'is_verified' => true,
                'is_featured' => true
            ],
            (object) [
                'id' => 2,
                'name' => 'Sarah Johnson',
                'email' => 'sarah.johnson@example.com',
                'phone' => '+1987654321',
                'avatar' => 'https://images.unsplash.com/photo-1494790108755-2616b612b786?w=80&h=80&fit=crop&crop=center',
                'status' => 'busy',
                'rating' => 4.9,
                'total_jobs' => 203,
                'completed_jobs' => 198,
                'total_earnings' => 567.25,
                'this_week_earnings' => 134.50,
                'pending_payout' => 89.75,
                'specialization' => 'Premium Shoe Services',
                'location' => 'Brooklyn, NY',
                'joined_date' => now()->subMonths(8),
                'current_jobs' => 1,
                'is_verified' => true,
                'is_featured' => false
            ]
        ]);

        // Calculate summary statistics
        $totalTechnicians = $technicians->count();
        $onlineTechnicians = $technicians->where('status', 'online')->count();
        $totalEarnings = $technicians->sum('total_earnings');
        $pendingPayouts = $technicians->sum('pending_payout');
        $activeJobs = $technicians->sum('current_jobs');

        return view('admin.technicians.index', compact('technicians', 'totalTechnicians', 'onlineTechnicians', 'totalEarnings', 'pendingPayouts', 'activeJobs'));
    }

    public function show($id)
    {
        // Hardcoded technician data
        $technician = (object) [
            'id' => 1,
            'name' => 'John Smith',
            'email' => 'john.smith@example.com',
            'phone' => '+1234567890',
            'avatar' => 'https://images.unsplash.com/photo-1507003211169-0a1dd7228f2d?w=80&h=80&fit=crop&crop=center',
            'status' => 'online',
            'rating' => 4.8,
            'total_jobs' => 156,
            'completed_jobs' => 142,
            'total_earnings' => 342.75,
            'this_week_earnings' => 89.99,
            'pending_payout' => 156.50,
            'specialization' => 'Shoe Cleaning & Repair',
            'location' => 'New York, NY',
            'joined_date' => now()->subMonths(6),
            'current_jobs' => 2,
            'is_verified' => true,
            'is_featured' => true,
            'bio' => 'Professional shoe care specialist with 6+ years of experience. Expert in cleaning, repairing, and maintaining all types of footwear.',
            'skills' => ['Shoe Cleaning', 'Leather Repair', 'Sole Replacement', 'Color Restoration', 'Odor Removal'],
            'languages' => ['English', 'Spanish'],
            'working_hours' => 'Mon-Fri: 8AM-6PM, Sat: 9AM-4PM',
            'service_areas' => ['Manhattan', 'Brooklyn', 'Queens'],
            'certifications' => ['Professional Shoe Care Certification', 'Leather Craftsmanship Diploma']
        ];

        // Hardcoded job history data
        $jobHistory = collect([
            (object) [
                'id' => 1,
                'customer_name' => 'Sarah Johnson',
                'service' => 'Premium Shoe Cleaning',
                'address' => '123 Main St, New York, NY',
                'date' => now()->subDays(2),
                'duration' => '90 min',
                'status' => 'completed',
                'earnings' => 89.99,
                'rating' => 5
            ],
            (object) [
                'id' => 2,
                'customer_name' => 'Mike Davis',
                'service' => 'Basic Cleaning',
                'address' => '456 Oak Ave, Brooklyn, NY',
                'date' => now()->subDays(5),
                'duration' => '45 min',
                'status' => 'completed',
                'earnings' => 45.50,
                'rating' => 5
            ]
        ]);

        // Hardcoded earnings data
        $earningsHistory = collect([
            (object) ['month' => 'January 2024', 'amount' => 156.80, 'jobs' => 12],
            (object) ['month' => 'December 2023', 'amount' => 189.45, 'jobs' => 15],
            (object) ['month' => 'November 2023', 'amount' => 134.90, 'jobs' => 11]
        ]);

        return view('admin.technicians.details', compact('technician', 'jobHistory', 'earningsHistory'));
    }

    public function jobs($technicianId)
    {
        // Hardcoded jobs data
        $jobs = collect([
            (object) [
                'id' => 1,
                'customer_name' => 'Sarah Johnson',
                'service' => 'Premium Shoe Cleaning',
                'address' => '123 Main St, New York, NY',
                'scheduled_time' => '2:00 PM',
                'duration' => '90 min',
                'status' => 'in_progress',
                'earnings' => 89.99,
                'notes' => 'Customer requested extra attention to leather areas'
            ],
            (object) [
                'id' => 2,
                'customer_name' => 'Mike Davis',
                'service' => 'Basic Cleaning',
                'address' => '456 Oak Ave, Brooklyn, NY',
                'scheduled_time' => '4:30 PM',
                'duration' => '45 min',
                'status' => 'assigned',
                'earnings' => 45.50,
                'notes' => 'Standard cleaning service'
            ]
        ]);

        return view('admin.technician.jobs', compact('jobs', 'technicianId'));
    }

    public function earnings($technicianId)
    {
        // Hardcoded earnings data
        $earnings = collect([
            (object) [
                'id' => 1,
                'date' => now()->subDays(2),
                'job_id' => 'JOB-001',
                'customer' => 'Sarah Johnson',
                'service' => 'Premium Shoe Cleaning',
                'amount' => 89.99,
                'status' => 'completed',
                'payout_status' => 'pending'
            ],
            (object) [
                'id' => 2,
                'date' => now()->subDays(5),
                'job_id' => 'JOB-002',
                'customer' => 'Mike Davis',
                'service' => 'Basic Cleaning',
                'amount' => 45.50,
                'status' => 'completed',
                'payout_status' => 'paid'
            ]
        ]);

        // Hardcoded payouts data
        $payouts = collect([
            (object) [
                'id' => 1,
                'date' => now()->subDays(10),
                'amount' => 234.50,
                'status' => 'completed',
                'method' => 'Bank Transfer'
            ]
        ]);

        // Hardcoded pending requests data
        $pendingRequests = collect([
            (object) [
                'id' => 1,
                'date' => now()->subDays(1),
                'amount' => 156.50,
                'status' => 'pending',
                'notes' => 'Requested for monthly expenses'
            ]
        ]);

        return view('admin.technician.earnings', compact('earnings', 'payouts', 'pendingRequests', 'technicianId'));
    }

    public function updateStatus(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Technician status updated successfully!');
    }

    public function approvePayout(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Payout request approved successfully!');
    }

    public function rejectPayout(Request $request, $id)
    {
        return redirect()->back()->with('success', 'Payout request rejected successfully!');
    }
}
