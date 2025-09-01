<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        // Static categories data
        $categories = collect([
            (object) [
                'id' => 1,
                'name' => 'Shoes',
                'slug' => 'shoes',
                'description' => 'All types of footwear including sneakers, boots, sandals, and formal shoes',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 45,
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 1,
                'meta_title' => 'Shoes Collection - Premium Footwear',
                'meta_description' => 'Discover our extensive collection of shoes for all occasions',
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 2,
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Fashion apparel including shirts, pants, dresses, and accessories',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 128,
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 2,
                'meta_title' => 'Clothing Collection - Fashion Apparel',
                'meta_description' => 'Trendy clothing for men, women, and children',
                'created_at' => now()->subDays(45),
                'updated_at' => now()->subDays(10),
            ],
            (object) [
                'id' => 3,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and gadgets for modern lifestyle',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 67,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 3,
                'meta_title' => 'Electronics Store - Latest Gadgets',
                'meta_description' => 'Cutting-edge electronics and smart devices',
                'created_at' => now()->subDays(60),
                'updated_at' => now()->subDays(15),
            ],
            (object) [
                'id' => 4,
                'name' => 'Bags & Wallets',
                'slug' => 'bags-wallets',
                'description' => 'Stylish bags, backpacks, and wallet collections',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 34,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 4,
                'meta_title' => 'Bags & Wallets - Fashion Accessories',
                'meta_description' => 'Elegant bags and wallets for every occasion',
                'created_at' => now()->subDays(75),
                'updated_at' => now()->subDays(20),
            ],
            (object) [
                'id' => 5,
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Fashion accessories and lifestyle products',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 89,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 5,
                'meta_title' => 'Accessories Collection - Style Essentials',
                'meta_description' => 'Complete your look with our accessory collection',
                'created_at' => now()->subDays(90),
                'updated_at' => now()->subDays(25),
            ],
            (object) [
                'id' => 6,
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Home decor, furniture, and garden essentials',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 56,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 6,
                'meta_title' => 'Home & Garden - Living Spaces',
                'meta_description' => 'Transform your living spaces with our collection',
                'created_at' => now()->subDays(105),
                'updated_at' => now()->subDays(30),
            ],
            (object) [
                'id' => 7,
                'name' => 'Sports & Fitness',
                'slug' => 'sports-fitness',
                'description' => 'Sports equipment and fitness gear for active lifestyle',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 42,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 7,
                'meta_title' => 'Sports & Fitness - Active Lifestyle',
                'meta_description' => 'Equipment and gear for sports and fitness enthusiasts',
                'created_at' => now()->subDays(120),
                'updated_at' => now()->subDays(35),
            ],
            (object) [
                'id' => 8,
                'name' => 'Beauty & Health',
                'slug' => 'beauty-health',
                'description' => 'Beauty products and health supplements',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 78,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 8,
                'meta_title' => 'Beauty & Health - Wellness Products',
                'meta_description' => 'Premium beauty and health products for your wellbeing',
                'created_at' => now()->subDays(135),
                'updated_at' => now()->subDays(40),
            ],
        ]);

        $stats = [
            'total' => $categories->count(),
            'active' => $categories->where('status', 'active')->count(),
            'featured' => $categories->where('is_featured', true)->count(),
            'total_products' => $categories->sum('product_count'),
        ];

        return view('admin.categories.index', compact('categories', 'stats'));
    }

    public function create()
    {
        $parentCategories = collect([
            (object) ['id' => null, 'name' => 'No Parent'],
            (object) ['id' => 1, 'name' => 'Shoes'],
            (object) ['id' => 2, 'name' => 'Clothing'],
            (object) ['id' => 3, 'name' => 'Electronics'],
        ]);

        return view('admin.categories.create', compact('parentCategories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        // For now, just redirect with success message
        // In a real application, you would save to database
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category created successfully!');
    }

    public function show($id)
    {
        // All categories data for reference
        $allCategories = collect([
            (object) [
                'id' => 1,
                'name' => 'Shoes',
                'slug' => 'shoes',
                'description' => 'All types of footwear including sneakers, boots, sandals, and formal shoes. Our shoe collection features premium brands and comfortable designs for every occasion.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 45,
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 1,
                'meta_title' => 'Shoes Collection - Premium Footwear',
                'meta_description' => 'Discover our extensive collection of shoes for all occasions',
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 2,
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Fashion apparel including shirts, pants, dresses, and accessories. Our clothing collection features trendy designs for men, women, and children.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 128,
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 2,
                'meta_title' => 'Clothing Collection - Fashion Apparel',
                'meta_description' => 'Trendy clothing for men, women, and children',
                'created_at' => now()->subDays(45),
                'updated_at' => now()->subDays(10),
            ],
            (object) [
                'id' => 3,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and gadgets for modern lifestyle. From smartphones to smart home devices, we have the latest technology.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 67,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 3,
                'meta_title' => 'Electronics Store - Latest Gadgets',
                'meta_description' => 'Cutting-edge electronics and smart devices',
                'created_at' => now()->subDays(60),
                'updated_at' => now()->subDays(15),
            ],
            (object) [
                'id' => 4,
                'name' => 'Bags & Wallets',
                'slug' => 'bags-wallets',
                'description' => 'Stylish bags, backpacks, and wallet collections. Premium leather and designer bags for every occasion.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 34,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 4,
                'meta_title' => 'Bags & Wallets - Fashion Accessories',
                'meta_description' => 'Elegant bags and wallets for every occasion',
                'created_at' => now()->subDays(75),
                'updated_at' => now()->subDays(20),
            ],
            (object) [
                'id' => 5,
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Fashion accessories and lifestyle products. Complete your look with our extensive accessory collection.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 89,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 5,
                'meta_title' => 'Accessories Collection - Style Essentials',
                'meta_description' => 'Complete your look with our accessory collection',
                'created_at' => now()->subDays(90),
                'updated_at' => now()->subDays(25),
            ],
            (object) [
                'id' => 6,
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Home decor, furniture, and garden essentials. Transform your living spaces with our beautiful collection.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 56,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 6,
                'meta_title' => 'Home & Garden - Living Spaces',
                'meta_description' => 'Transform your living spaces with our collection',
                'created_at' => now()->subDays(105),
                'updated_at' => now()->subDays(30),
            ],
            (object) [
                'id' => 7,
                'name' => 'Sports & Fitness',
                'slug' => 'sports-fitness',
                'description' => 'Sports equipment and fitness gear for active lifestyle. Everything you need for your fitness journey.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 42,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 7,
                'meta_title' => 'Sports & Fitness - Active Lifestyle',
                'meta_description' => 'Equipment and gear for sports and fitness enthusiasts',
                'created_at' => now()->subDays(120),
                'updated_at' => now()->subDays(35),
            ],
            (object) [
                'id' => 8,
                'name' => 'Beauty & Health',
                'slug' => 'beauty-health',
                'description' => 'Beauty products and health supplements. Premium beauty and health products for your wellbeing.',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 78,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 8,
                'meta_title' => 'Beauty & Health - Wellness Products',
                'meta_description' => 'Premium beauty and health products for your wellbeing',
                'created_at' => now()->subDays(135),
                'updated_at' => now()->subDays(40),
            ],
        ]);

        $category = $allCategories->firstWhere('id', (int)$id);
        
        if (!$category) {
            abort(404);
        }

        return view('admin.categories.show', compact('category'));
    }

    public function edit($id)
    {
        // All categories data for reference
        $allCategories = collect([
            (object) [
                'id' => 1,
                'name' => 'Shoes',
                'slug' => 'shoes',
                'description' => 'All types of footwear including sneakers, boots, sandals, and formal shoes',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 45,
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 1,
                'meta_title' => 'Shoes Collection - Premium Footwear',
                'meta_description' => 'Discover our extensive collection of shoes for all occasions',
                'created_at' => now()->subDays(30),
                'updated_at' => now()->subDays(5),
            ],
            (object) [
                'id' => 2,
                'name' => 'Clothing',
                'slug' => 'clothing',
                'description' => 'Fashion apparel including shirts, pants, dresses, and accessories',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 128,
                'status' => 'active',
                'is_featured' => true,
                'sort_order' => 2,
                'meta_title' => 'Clothing Collection - Fashion Apparel',
                'meta_description' => 'Trendy clothing for men, women, and children',
                'created_at' => now()->subDays(45),
                'updated_at' => now()->subDays(10),
            ],
            (object) [
                'id' => 3,
                'name' => 'Electronics',
                'slug' => 'electronics',
                'description' => 'Electronic devices and gadgets for modern lifestyle',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 67,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 3,
                'meta_title' => 'Electronics Store - Latest Gadgets',
                'meta_description' => 'Cutting-edge electronics and smart devices',
                'created_at' => now()->subDays(60),
                'updated_at' => now()->subDays(15),
            ],
            (object) [
                'id' => 4,
                'name' => 'Bags & Wallets',
                'slug' => 'bags-wallets',
                'description' => 'Stylish bags, backpacks, and wallet collections',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 34,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 4,
                'meta_title' => 'Bags & Wallets - Fashion Accessories',
                'meta_description' => 'Elegant bags and wallets for every occasion',
                'created_at' => now()->subDays(75),
                'updated_at' => now()->subDays(20),
            ],
            (object) [
                'id' => 5,
                'name' => 'Accessories',
                'slug' => 'accessories',
                'description' => 'Fashion accessories and lifestyle products',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 89,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 5,
                'meta_title' => 'Accessories Collection - Style Essentials',
                'meta_description' => 'Complete your look with our accessory collection',
                'created_at' => now()->subDays(90),
                'updated_at' => now()->subDays(25),
            ],
            (object) [
                'id' => 6,
                'name' => 'Home & Garden',
                'slug' => 'home-garden',
                'description' => 'Home decor, furniture, and garden essentials',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 56,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 6,
                'meta_title' => 'Home & Garden - Living Spaces',
                'meta_description' => 'Transform your living spaces with our collection',
                'created_at' => now()->subDays(105),
                'updated_at' => now()->subDays(30),
            ],
            (object) [
                'id' => 7,
                'name' => 'Sports & Fitness',
                'slug' => 'sports-fitness',
                'description' => 'Sports equipment and fitness gear for active lifestyle',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 42,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 7,
                'meta_title' => 'Sports & Fitness - Active Lifestyle',
                'meta_description' => 'Equipment and gear for sports and fitness enthusiasts',
                'created_at' => now()->subDays(120),
                'updated_at' => now()->subDays(35),
            ],
            (object) [
                'id' => 8,
                'name' => 'Beauty & Health',
                'slug' => 'beauty-health',
                'description' => 'Beauty products and health supplements',
                'parent_id' => null,
                'parent_name' => null,
                'product_count' => 78,
                'status' => 'active',
                'is_featured' => false,
                'sort_order' => 8,
                'meta_title' => 'Beauty & Health - Wellness Products',
                'meta_description' => 'Premium beauty and health products for your wellbeing',
                'created_at' => now()->subDays(135),
                'updated_at' => now()->subDays(40),
            ],
        ]);

        $category = $allCategories->firstWhere('id', (int)$id);
        
        if (!$category) {
            abort(404);
        }

        $parentCategories = collect([
            (object) ['id' => null, 'name' => 'No Parent'],
            (object) ['id' => 1, 'name' => 'Shoes'],
            (object) ['id' => 2, 'name' => 'Clothing'],
            (object) ['id' => 3, 'name' => 'Electronics'],
        ]);

        return view('admin.categories.edit', compact('category', 'parentCategories'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'parent_id' => 'nullable|integer',
            'status' => 'required|in:active,inactive',
            'is_featured' => 'boolean',
            'sort_order' => 'nullable|integer|min:0',
            'meta_title' => 'nullable|string|max:255',
            'meta_description' => 'nullable|string',
        ]);

        // For now, just redirect with success message
        // In a real application, you would update in database
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category updated successfully!');
    }

    public function destroy($id)
    {
        // For now, just redirect with success message
        // In a real application, you would delete from database
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category deleted successfully!');
    }

    public function toggleStatus($id)
    {
        // For now, just redirect with success message
        // In a real application, you would toggle status in database
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category status updated successfully!');
    }

    public function toggleFeatured($id)
    {
        // For now, just redirect with success message
        // In a real application, you would toggle featured status in database
        return redirect()->route('admin.categories.index')
            ->with('success', 'Category featured status updated successfully!');
    }
}
