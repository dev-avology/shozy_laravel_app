<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function index(Request $request)
    {
        // For now, return a simple view with placeholder data
        // In a real application, you would query the database
        $products = collect([
            (object) [
                'id' => 1,
                'name' => 'Nike Air Max 270 Running Shoes',
                'description' => 'Premium running shoes with Air Max technology',
                'price' => 129.99,
                'status' => 'active',
                'is_featured' => true,
                'has_3d_model' => true,
                'vendor' => (object) ['name' => 'John Doe', 'company' => 'Shoe Store'],
                'category' => (object) ['name' => 'Shoes'],
                'main_image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150&h=150&fit=crop',
                'created_at' => now(),
            ],
            (object) [
                'id' => 2,
                'name' => 'Leather Crossbody Bag',
                'description' => 'Handcrafted leather bag with adjustable strap',
                'price' => 89.99,
                'status' => 'active',
                'is_featured' => false,
                'has_3d_model' => false,
                'vendor' => (object) ['name' => 'Jane Smith', 'company' => 'Fashion Boutique'],
                'category' => (object) ['name' => 'Bags & Wallets'],
                'main_image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(2),
            ],
            (object) [
                'id' => 3,
                'name' => 'Wireless Bluetooth Headphones',
                'description' => 'High-quality wireless headphones with noise cancellation',
                'price' => 199.99,
                'status' => 'pending',
                'is_featured' => false,
                'has_3d_model' => true,
                'vendor' => (object) ['name' => 'Mike Johnson', 'company' => 'Accessories Shop'],
                'category' => (object) ['name' => 'Accessories'],
                'main_image' => 'https://images.unsplash.com/photo-1560769629-975ec94e6a86?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 4,
                'name' => 'Smart Fitness Watch',
                'description' => 'Advanced fitness tracking with heart rate monitor',
                'price' => 299.99,
                'status' => 'active',
                'is_featured' => true,
                'has_3d_model' => false,
                'vendor' => (object) ['name' => 'Tech Gadgets', 'company' => 'Electronics Store'],
                'category' => (object) ['name' => 'Electronics'],
                'main_image' => 'https://images.unsplash.com/photo-1595950653106-6c9ebd614d3a?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(1),
            ],
            (object) [
                'id' => 5,
                'name' => 'Organic Cotton T-Shirt',
                'description' => 'Comfortable and eco-friendly cotton t-shirt',
                'price' => 29.99,
                'status' => 'active',
                'is_featured' => false,
                'has_3d_model' => false,
                'vendor' => (object) ['name' => 'Eco Fashion', 'company' => 'Sustainable Clothing'],
                'category' => (object) ['name' => 'Clothing'],
                'main_image' => 'https://images.unsplash.com/photo-1551107696-a4b0c5a0d9a2?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(3),
            ],
            (object) [
                'id' => 6,
                'name' => 'Stainless Steel Water Bottle',
                'description' => 'Insulated water bottle keeps drinks cold for 24 hours',
                'price' => 39.99,
                'status' => 'active',
                'is_featured' => false,
                'has_3d_model' => false,
                'vendor' => (object) ['name' => 'Outdoor Gear', 'company' => 'Adventure Store'],
                'category' => (object) ['name' => 'Outdoor'],
                'main_image' => 'https://images.unsplash.com/photo-1606107557195-0e29a4b5b4aa?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(4),
            ],
            (object) [
                'id' => 7,
                'name' => 'Wireless Charging Pad',
                'description' => 'Fast wireless charging for all compatible devices',
                'price' => 49.99,
                'status' => 'pending',
                'is_featured' => false,
                'has_3d_model' => false,
                'vendor' => (object) ['name' => 'Tech Gadgets', 'company' => 'Electronics Store'],
                'category' => (object) ['name' => 'Electronics'],
                'main_image' => 'https://images.unsplash.com/photo-1600185365483-26d7a4cc7519?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(6),
            ],
            (object) [
                'id' => 8,
                'name' => 'Handmade Ceramic Mug',
                'description' => 'Beautiful handcrafted ceramic coffee mug',
                'price' => 24.99,
                'status' => 'active',
                'is_featured' => false,
                'has_3d_model' => false,
                'vendor' => (object) ['name' => 'Artisan Crafts', 'company' => 'Handmade Goods'],
                'category' => (object) ['name' => 'Home & Garden'],
                'main_image' => 'https://images.unsplash.com/photo-1552346154-21d32810aba3?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(7),
            ],
        ]);

        // Static data for vendors and categories
        $vendors = collect([
            (object) ['id' => 1, 'name' => 'John Doe', 'company' => 'Shoe Store'],
            (object) ['id' => 2, 'name' => 'Jane Smith', 'company' => 'Fashion Boutique'],
            (object) ['id' => 3, 'name' => 'Mike Johnson', 'company' => 'Accessories Shop'],
        ]);

        $categories = collect([
            (object) ['id' => 'shoes', 'name' => 'Shoes'],
            (object) ['id' => 'accessories', 'name' => 'Accessories'],
            (object) ['id' => 'clothing', 'name' => 'Clothing'],
            (object) ['id' => 'bags', 'name' => 'Bags & Wallets'],
            (object) ['id' => 'jewelry', 'name' => 'Jewelry'],
        ]);

        $statuses = ['active', 'inactive', 'pending', 'rejected'];

        $stats = [
            'total' => $products->count(),
            'active' => $products->where('status', 'active')->count(),
            'pending' => $products->where('status', 'pending')->count(),
            'rejected' => 0,
        ];

        return view('admin.products.index', compact('products', 'vendors', 'categories', 'statuses', 'stats'));
    }

    public function show($id)
    {
        // Placeholder product data matching mobile app design
        $product = (object) [
            'id' => $id,
            'name' => 'Nike Air Max 270 Running Shoes',
            'description' => 'The Nike Air Max 270 delivers unrivaled, all-day comfort. The shoe\'s design draws inspiration from Air Max icons, showcasing Nike\'s greatest innovation with its large window and fresh array of colors. The Max Air 270 unit delivers unrivaled, all-day comfort. The foam midsole is lightweight and provides responsive cushioning under every step.',
            'price' => 129.99,
            'status' => 'active',
            'is_featured' => true,
            'has_3d_model' => true,
            'condition' => 'new',
            'quantity' => 25,
            'brand' => 'Nike',
            'size' => '42',
            'material' => 'Mesh, Synthetic, Rubber',
            'color' => 'Black/White',
            'weight' => '12.5 oz',
            'heel_height' => '1.5 inches',
            'waterproof' => 'No',
            'warranty' => '2 years',
            'sku' => 'NIKE-AM270-001',
            'vendor' => (object) [
                'name' => 'John Doe',
                'company' => 'Shoe Store',
                'email' => 'john.doe@shoestore.com',
                'phone' => '+1 (555) 123-4567',
                'location' => 'New York, NY',
                'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face',
                'total_products' => 45,
                'rating' => 4.8,
                'years_active' => 2,
            ],
            'category' => (object) ['name' => 'Shoes'],
            'images' => [
                (object) [
                    'id' => 1,
                    'url' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=300&h=300&fit=crop',
                    'type' => 'image',
                    'is_primary' => true,
                    'alt_text' => 'Front View',
                ],
                (object) [
                    'id' => 2,
                    'url' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=300&h=300&fit=crop',
                    'type' => 'image',
                    'is_primary' => false,
                    'alt_text' => 'Side View',
                ],
                (object) [
                    'id' => 3,
                    'url' => 'https://via.placeholder.com/300x300/FF6B35/FFFFFF?text=Back',
                    'type' => 'image',
                    'is_primary' => false,
                    'alt_text' => 'Back View',
                ],
                (object) [
                    'id' => 4,
                    'url' => 'https://via.placeholder.com/300x300/FF6B35/FFFFFF?text=Top',
                    'type' => 'image',
                    'is_primary' => false,
                    'alt_text' => 'Top View',
                ],
                (object) [
                    'id' => 5,
                    'url' => 'https://via.placeholder.com/300x300/FF6B35/FFFFFF?text=Bottom',
                    'type' => 'image',
                    'is_primary' => false,
                    'alt_text' => 'Bottom View',
                ],
                (object) [
                    'id' => 6,
                    'url' => 'https://via.placeholder.com/300x300/FF6B35/FFFFFF?text=Detail1',
                    'type' => 'image',
                    'is_primary' => false,
                    'alt_text' => 'Sole Detail',
                ],
                (object) [
                    'id' => 7,
                    'url' => 'https://placeholder.com/300x300/FF6B35/FFFFFF?text=Detail2',
                    'type' => 'image',
                    'is_primary' => false,
                    'alt_text' => 'Logo Detail',
                ],
                (object) [
                    'id' => 8,
                    'url' => 'https://via.placeholder.com/300x300/FF6B35/FFFFFF?text=Detail3',
                    'type' => 'image',
                    'is_primary' => false,
                    'alt_text' => 'Material Detail',
                ],
            ],
            'specifications' => [
                'Material' => 'Mesh, Synthetic, Rubber',
                'Closure' => 'Lace-up',
                'Sole' => 'Rubber',
                'Technology' => 'Air Max 270',
                'Weight' => '12.5 oz',
                'Heel Height' => '1.5 inches',
                'Waterproof' => 'No',
                'Warranty' => '2 years',
            ],
            'features' => [
                'Breathable mesh upper for ventilation',
                'Foam midsole for lightweight cushioning',
                'Rubber outsole for durable traction',
                'Max Air 270 unit for maximum comfort',
                'Padded collar and tongue for a secure fit',
            ],
            'tags' => ['Running', 'Athletic', 'Comfortable', 'Lightweight', 'Durable'],
            'meta_title' => 'Nike Air Max 270 Running Shoes - Premium Comfort',
            'meta_description' => 'Experience ultimate comfort with Nike Air Max 270 running shoes. Features Air Max technology and breathable mesh upper.',
            'model_url' => 'https://example.com/shoe.glb',
            'created_at' => now(),
            'updated_at' => now(),
        ];

        return view('admin.products.show', compact('product'));
    }

    public function edit($id)
    {
        // Placeholder product data for editing
        $product = (object) [
            'id' => $id,
            'name' => 'Nike Air Max 270 Running Shoes',
            'description' => 'Premium running shoes with Air Max technology',
            'price' => 129.99,
            'category_id' => 'shoes',
            'brand' => 'Nike',
            'size' => '42',
            'material' => 'Mesh, Synthetic, Rubber',
            'color' => 'Black/White',
            'condition' => 'new',
            'quantity' => 25,
            'model_url' => 'https://example.com/shoe.glb',
        ];

        // Static data for vendors and categories
        $vendors = collect([
            (object) ['id' => 1, 'name' => 'John Doe', 'company' => 'Shoe Store'],
            (object) ['id' => 2, 'name' => 'Jane Smith', 'company' => 'Fashion Boutique'],
            (object) ['id' => 3, 'name' => 'Mike Johnson', 'company' => 'Accessories Shop'],
        ]);

        $categories = collect([
            (object) ['id' => 'shoes', 'name' => 'Shoes'],
            (object) ['id' => 'accessories', 'name' => 'Accessories'],
            (object) ['id' => 'clothing', 'name' => 'Clothing'],
            (object) ['id' => 'bags', 'name' => 'Bags & Wallets'],
            (object) ['id' => 'jewelry', 'name' => 'Jewelry'],
        ]);

        $statuses = ['active', 'inactive', 'pending', 'rejected'];
        
        return view('admin.products.edit', compact('product', 'vendors', 'categories', 'statuses'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|string',
            'vendor_id' => 'required|integer',
            'status' => 'required|in:active,inactive,pending,rejected',
            'is_featured' => 'boolean',
            'is_3d_available' => 'boolean',
        ]);

        // For now, just redirect with success message
        // In a real application, you would update in database
        return redirect()->route('admin.products.index')
            ->with('success', 'Product updated successfully!');
    }

    public function destroy($id)
    {
        // For now, just redirect with success message
        // In a real application, you would delete from database
        return redirect()->route('admin.products.index')
            ->with('success', 'Product deleted successfully!');
    }

    public function bulkAction(Request $request)
    {
        $request->validate([
            'action' => 'required|in:activate,deactivate,delete,approve,reject',
            'products' => 'required|array',
            'products.*' => 'integer'
        ]);

        // For now, just redirect with success message
        // In a real application, you would process bulk actions
        $action = $request->action;
        $message = "Bulk action '{$action}' completed successfully!";
        
        return redirect()->route('admin.products.index')->with('success', $message);
    }

    public function vendorProducts($vendorId)
    {
        // Placeholder vendor data
        $vendor = (object) [
            'id' => $vendorId,
            'name' => 'John Doe',
            'company' => 'Shoe Store',
            'email' => 'john.doe@shoestore.com',
            'phone' => '+1 (555) 123-4567',
            'location' => 'New York, NY',
                            'avatar' => 'https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?w=80&h=80&fit=crop&crop=face',
            'total_products' => 45,
            'rating' => 4.8,
            'years_active' => 2,
        ];

        // Placeholder vendor products data
        $products = collect([
            (object) [
                'id' => 1,
                'name' => 'Nike Air Max 270 Running Shoes',
                'price' => 129.99,
                'status' => 'active',
                'category' => (object) ['name' => 'Shoes'],
                'main_image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=150&h=150&fit=crop',
                'created_at' => now(),
            ],
            (object) [
                'id' => 2,
                'name' => 'Adidas Ultraboost 21',
                'price' => 179.99,
                'status' => 'active',
                'category' => (object) ['name' => 'Shoes'],
                'main_image' => 'https://images.unsplash.com/photo-1549298916-b41d501d3772?w=150&h=150&fit=crop',
                'created_at' => now()->subDays(1),
            ],
        ]);

        return view('admin.products.vendor-products', compact('vendor', 'products'));
    }

    public function export(Request $request)
    {
        // For now, just redirect with success message
        // In a real application, you would export products
        return redirect()->route('admin.products.index')
            ->with('success', 'Products exported successfully!');
    }
}
