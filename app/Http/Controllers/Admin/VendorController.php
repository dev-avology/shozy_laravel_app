<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class VendorController extends Controller
{
    public function index()
    {
        // Get users with vendor role (assuming role_id 2 is for vendors)
        $vendors = User::where('role_id', 2)
            ->withCount('products')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.vendors.index', compact('vendors'));
    }

    public function create()
    {
        return view('admin.vendors.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'phone' => 'nullable|string|max:20',
            'password' => 'required|string|min:8|confirmed',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'company_name' => $request->company_name,
            'address' => $request->address,
            'role_id' => 2, // Vendor role
            'is_active' => $request->boolean('is_active', true),
        ]);

        // Assign vendor role using Spatie
        $user->assignRole('vendor');

        return redirect()->route('admin.vendors.index')
            ->with('success', 'Vendor created successfully!');
    }

    public function show(User $vendor)
    {
        // Ensure this is a vendor
        if ($vendor->role_id !== 2) {
            abort(404, 'User is not a vendor');
        }

        $vendor->load(['products' => function($query) {
            $query->latest()->take(10);
        }]);

        $stats = [
            'total_products' => $vendor->products()->count(),
            'active_products' => $vendor->products()->where('status', 'active')->count(),
            'pending_products' => $vendor->products()->where('status', 'pending')->count(),
            'rejected_products' => $vendor->products()->where('status', 'rejected')->count(),
        ];

        return view('admin.vendors.show', compact('vendor', 'stats'));
    }

    public function edit(User $vendor)
    {
        // Ensure this is a vendor
        if ($vendor->role_id !== 2) {
            abort(404, 'User is not a vendor');
        }

        return view('admin.vendors.edit', compact('vendor'));
    }

    public function update(Request $request, User $vendor)
    {
        // Ensure this is a vendor
        if ($vendor->role_id !== 2) {
            abort(404, 'User is not a vendor');
        }

        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $vendor->id,
            'phone' => 'nullable|string|max:20',
            'password' => 'nullable|string|min:8|confirmed',
            'company_name' => 'nullable|string|max:255',
            'address' => 'nullable|string',
            'is_active' => 'boolean',
        ]);

        $data = $request->except(['password']);
        
        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $vendor->update($data);

        return redirect()->route('admin.vendors.index')
            ->with('success', 'Vendor updated successfully!');
    }

    public function destroy(User $vendor)
    {
        // Ensure this is a vendor
        if ($vendor->role_id !== 2) {
            abort(404, 'User is not a vendor');
        }

        // Check if vendor has products
        if ($vendor->products()->count() > 0) {
            return redirect()->route('admin.vendors.index')
                ->with('error', 'Cannot delete vendor with existing products. Please reassign or delete the products first.');
        }

        $vendor->delete();

        return redirect()->route('admin.vendors.index')
            ->with('success', 'Vendor deleted successfully!');
    }

    public function toggleStatus(User $vendor)
    {
        // Ensure this is a vendor
        if ($vendor->role_id !== 2) {
            abort(404, 'User is not a vendor');
        }

        $vendor->update(['is_active' => !$vendor->is_active]);
        
        $status = $vendor->is_active ? 'activated' : 'deactivated';
        return redirect()->route('admin.vendors.index')
            ->with('success', "Vendor {$status} successfully!");
    }

    public function products(User $vendor)
    {
        // Ensure this is a vendor
        if ($vendor->role_id !== 2) {
            abort(404, 'User is not a vendor');
        }

        $products = $vendor->products()
            ->with(['category', 'images'])
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        return view('admin.vendors.products', compact('vendor', 'products'));
    }
}
