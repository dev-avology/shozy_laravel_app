<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    public function index()
    {
        // Static orders data with products and status
        $orders = collect([
            (object) [
                'id' => 'ORD-001',
                'customer_name' => 'John Doe',
                'customer_email' => 'john@example.com',
                'customer_phone' => '+1234567890',
                'order_date' => now()->subDays(2),
                'total_amount' => 299.99,
                'status' => 'pending',
                'payment_status' => 'pending',
                'shipping_address' => '123 Main St, City, Country',
                'billing_address' => '123 Main St, City, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Standard Shipping',
                'items_count' => 2,
                'products' => collect([
                    (object) [
                        'id' => 1,
                        'name' => 'Premium Running Shoes',
                        'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=80&h=80&fit=crop&crop=center',
                        'price' => 149.99,
                        'quantity' => 1,
                        'subtotal' => 149.99,
                        'category' => 'Shoes'
                    ],
                    (object) [
                        'id' => 2,
                        'name' => 'Sports T-Shirt',
                        'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=80&h=80&fit=crop&crop=center',
                        'price' => 29.99,
                        'quantity' => 1,
                        'subtotal' => 29.99,
                        'category' => 'Clothing'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-002',
                'customer_name' => 'Jane Smith',
                'customer_email' => 'jane@example.com',
                'customer_phone' => '+1987654321',
                'order_date' => now()->subDays(5),
                'total_amount' => 89.97,
                'status' => 'processing',
                'payment_status' => 'paid',
                'shipping_address' => '456 Oak Ave, Town, Country',
                'billing_address' => '456 Oak Ave, Town, Country',
                'payment_method' => 'PayPal',
                'shipping_method' => 'Express Shipping',
                'items_count' => 3,
                'products' => collect([
                    (object) [
                        'id' => 3,
                        'name' => 'Wireless Headphones',
                        'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=80&h=80&fit=crop&crop=center',
                        'price' => 79.99,
                        'quantity' => 1,
                        'subtotal' => 79.99,
                        'category' => 'Electronics'
                    ],
                    (object) [
                        'id' => 4,
                        'name' => 'Phone Case',
                        'image' => 'https://images.unsplash.com/photo-1603313011961-3d1b5d5c0b5a?w=80&h=80&fit=crop&crop=center',
                        'price' => 9.98,
                        'quantity' => 1,
                        'subtotal' => 9.98,
                        'category' => 'Accessories'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-003',
                'customer_name' => 'Mike Johnson',
                'customer_email' => 'mike@example.com',
                'customer_phone' => '+1122334455',
                'order_date' => now()->subDays(1),
                'total_amount' => 199.98,
                'status' => 'shipped',
                'payment_status' => 'paid',
                'shipping_address' => '789 Pine St, Village, Country',
                'billing_address' => '789 Pine St, Village, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Standard Shipping',
                'items_count' => 2,
                'products' => collect([
                    (object) [
                        'id' => 5,
                        'name' => 'Gaming Mouse',
                        'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=80&h=80&fit=crop&crop=center',
                        'price' => 99.99,
                        'quantity' => 1,
                        'subtotal' => 99.99,
                        'category' => 'Electronics'
                    ],
                    (object) [
                        'id' => 6,
                        'name' => 'Mechanical Keyboard',
                        'image' => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?w=80&h=80&fit=crop&crop=center',
                        'price' => 99.99,
                        'quantity' => 1,
                        'subtotal' => 99.99,
                        'category' => 'Electronics'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-004',
                'customer_name' => 'Sarah Wilson',
                'customer_email' => 'sarah@example.com',
                'customer_phone' => '+1555666777',
                'order_date' => now()->subDays(3),
                'total_amount' => 159.96,
                'status' => 'delivered',
                'payment_status' => 'paid',
                'shipping_address' => '321 Elm Rd, Borough, Country',
                'billing_address' => '321 Elm Rd, Borough, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Express Shipping',
                'items_count' => 4,
                'products' => collect([
                    (object) [
                        'id' => 7,
                        'name' => 'Yoga Mat',
                        'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=80&h=80&fit=crop&crop=center',
                        'price' => 39.99,
                        'quantity' => 1,
                        'subtotal' => 39.99,
                        'category' => 'Sports'
                    ],
                    (object) [
                        'id' => 8,
                        'name' => 'Water Bottle',
                        'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=80&h=80&fit=crop&crop=center',
                        'price' => 19.99,
                        'quantity' => 2,
                        'subtotal' => 39.98,
                        'category' => 'Sports'
                    ],
                    (object) [
                        'id' => 9,
                        'name' => 'Fitness Tracker',
                        'image' => 'https://images.unsplash.com/photo-1575311373937-040b8e1fd5b6?w=80&h=80&fit=crop&crop=center',
                        'price' => 79.99,
                        'quantity' => 1,
                        'subtotal' => 79.99,
                        'category' => 'Electronics'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-005',
                'customer_name' => 'David Brown',
                'customer_email' => 'david@example.com',
                'customer_phone' => '+1444333222',
                'order_date' => now()->subDays(7),
                'total_amount' => 449.95,
                'status' => 'cancelled',
                'payment_status' => 'refunded',
                'shipping_address' => '654 Maple Dr, District, Country',
                'billing_address' => '654 Maple Dr, District, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Standard Shipping',
                'items_count' => 1,
                'products' => collect([
                    (object) [
                        'id' => 10,
                        'name' => 'Smart Watch',
                        'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=80&h=80&fit=crop&crop=center',
                        'price' => 449.95,
                        'quantity' => 1,
                        'subtotal' => 449.95,
                        'category' => 'Electronics'
                    ]
                ])
            ]
        ]);

        return view('admin.orders.index', compact('orders'));
    }

    public function show($id)
    {
        // Find the specific order
        $orders = collect([
            (object) [
                'id' => 'ORD-001',
                'customer_name' => 'John Doe',
                'customer_email' => 'john@example.com',
                'customer_phone' => '+1234567890',
                'order_date' => now()->subDays(2),
                'total_amount' => 299.99,
                'status' => 'pending',
                'payment_status' => 'pending',
                'shipping_address' => '123 Main St, City, Country',
                'billing_address' => '123 Main St, City, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Standard Shipping',
                'items_count' => 2,
                'products' => collect([
                    (object) [
                        'id' => 1,
                        'name' => 'Premium Running Shoes',
                        'image' => 'https://images.unsplash.com/photo-1542291026-7eec264c27ff?w=80&h=80&fit=crop&crop=center',
                        'price' => 149.99,
                        'quantity' => 1,
                        'subtotal' => 149.99,
                        'category' => 'Shoes'
                    ],
                    (object) [
                        'id' => 2,
                        'name' => 'Sports T-Shirt',
                        'image' => 'https://images.unsplash.com/photo-1521572163474-6864f9cf17ab?w=80&h=80&fit=crop&crop=center',
                        'price' => 29.99,
                        'quantity' => 1,
                        'subtotal' => 29.99,
                        'category' => 'Clothing'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-002',
                'customer_name' => 'Jane Smith',
                'customer_email' => 'jane@example.com',
                'customer_phone' => '+1987654321',
                'order_date' => now()->subDays(5),
                'total_amount' => 89.97,
                'status' => 'processing',
                'payment_status' => 'paid',
                'shipping_address' => '456 Oak Ave, Town, Country',
                'billing_address' => '456 Oak Ave, Town, Country',
                'payment_method' => 'PayPal',
                'shipping_method' => 'Express Shipping',
                'items_count' => 3,
                'products' => collect([
                    (object) [
                        'id' => 3,
                        'name' => 'Wireless Headphones',
                        'image' => 'https://images.unsplash.com/photo-1505740420928-5e560c06d30e?w=80&h=80&fit=crop&crop=center',
                        'price' => 79.99,
                        'quantity' => 1,
                        'subtotal' => 79.99,
                        'category' => 'Electronics'
                    ],
                    (object) [
                        'id' => 4,
                        'name' => 'Phone Case',
                        'image' => 'https://images.unsplash.com/photo-1603313011961-3d1b5d5c0b5a?w=80&h=80&fit=crop&crop=center',
                        'price' => 9.98,
                        'quantity' => 1,
                        'subtotal' => 9.98,
                        'category' => 'Accessories'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-003',
                'customer_name' => 'Mike Johnson',
                'customer_email' => 'mike@example.com',
                'customer_phone' => '+1122334455',
                'order_date' => now()->subDays(1),
                'total_amount' => 199.98,
                'status' => 'shipped',
                'payment_status' => 'paid',
                'shipping_address' => '789 Pine St, Village, Country',
                'billing_address' => '789 Pine St, Village, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Standard Shipping',
                'items_count' => 2,
                'products' => collect([
                    (object) [
                        'id' => 5,
                        'name' => 'Gaming Mouse',
                        'image' => 'https://images.unsplash.com/photo-1527864550417-7fd91fc51a46?w=80&h=80&fit=crop&crop=center',
                        'price' => 99.99,
                        'quantity' => 1,
                        'subtotal' => 99.99,
                        'category' => 'Electronics'
                    ],
                    (object) [
                        'id' => 6,
                        'name' => 'Mechanical Keyboard',
                        'image' => 'https://images.unsplash.com/photo-1541140532154-b024d705b90a?w=80&h=80&fit=crop&crop=center',
                        'price' => 99.99,
                        'quantity' => 1,
                        'subtotal' => 99.99,
                        'category' => 'Electronics'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-004',
                'customer_name' => 'Sarah Wilson',
                'customer_email' => 'sarah@example.com',
                'customer_phone' => '+1555666777',
                'order_date' => now()->subDays(3),
                'total_amount' => 159.96,
                'status' => 'delivered',
                'payment_status' => 'paid',
                'shipping_address' => '321 Elm Rd, Borough, Country',
                'billing_address' => '321 Elm Rd, Borough, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Express Shipping',
                'items_count' => 4,
                'products' => collect([
                    (object) [
                        'id' => 7,
                        'name' => 'Yoga Mat',
                        'image' => 'https://images.unsplash.com/photo-1544367567-0f2fcb009e0b?w=80&h=80&fit=crop&crop=center',
                        'price' => 39.99,
                        'quantity' => 1,
                        'subtotal' => 39.99,
                        'category' => 'Sports'
                    ],
                    (object) [
                        'id' => 8,
                        'name' => 'Water Bottle',
                        'image' => 'https://images.unsplash.com/photo-1559827260-dc66d52bef19?w=80&h=80&fit=crop&crop=center',
                        'price' => 19.99,
                        'quantity' => 2,
                        'subtotal' => 39.98,
                        'category' => 'Sports'
                    ],
                    (object) [
                        'id' => 9,
                        'name' => 'Fitness Tracker',
                        'image' => 'https://images.unsplash.com/photo-1575311373937-040b8e1fd5b6?w=80&h=80&fit=crop&crop=center',
                        'price' => 79.99,
                        'quantity' => 1,
                        'subtotal' => 79.99,
                        'category' => 'Electronics'
                    ]
                ])
            ],
            (object) [
                'id' => 'ORD-005',
                'customer_name' => 'David Brown',
                'customer_email' => 'david@example.com',
                'customer_phone' => '+1444333222',
                'order_date' => now()->subDays(7),
                'total_amount' => 449.95,
                'status' => 'cancelled',
                'payment_status' => 'refunded',
                'shipping_address' => '654 Maple Dr, District, Country',
                'billing_address' => '654 Maple Dr, District, Country',
                'payment_method' => 'Credit Card',
                'shipping_method' => 'Standard Shipping',
                'items_count' => 1,
                'products' => collect([
                    (object) [
                        'id' => 10,
                        'name' => 'Smart Watch',
                        'image' => 'https://images.unsplash.com/photo-1607619056574-7b8d3ee536b2?w=80&h=80&fit=crop&crop=center',
                        'price' => 449.95,
                        'quantity' => 1,
                        'subtotal' => 449.95,
                        'category' => 'Electronics'
                    ]
                ])
            ]
        ]);

        $order = $orders->firstWhere('id', $id);

        if (!$order) {
            abort(404);
        }

        return view('admin.orders.show', compact('order'));
    }

    public function updateStatus(Request $request, $id)
    {
        // In a real application, you would update the order status in the database
        // For now, we'll just redirect with a success message
        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}
