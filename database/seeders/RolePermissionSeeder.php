<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Create roles
        $customerRole = Role::create(['name' => 'customer']);
        $technicianRole = Role::create(['name' => 'technician']);
        $deliveryRole = Role::create(['name' => 'delivery']);
        $vendorRole = Role::create(['name' => 'vendor']);

        // Create permissions (you can add more as needed)
        $permissions = [
            'view_profile',
            'edit_profile',
            'create_order',
            'view_orders',
            'update_order_status',
            'view_technicians',
            'assign_technician',
            'view_delivery',
            'track_delivery',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }

        // Assign permissions to roles
        $customerRole->givePermissionTo([
            'view_profile',
            'edit_profile',
            'create_order',
            'view_orders',
            'track_delivery',
        ]);

        $technicianRole->givePermissionTo([
            'view_profile',
            'edit_profile',
            'view_orders',
            'update_order_status',
            'view_delivery',
        ]);

        $deliveryRole->givePermissionTo([
            'view_profile',
            'edit_profile',
            'view_orders',
            'update_order_status',
            'track_delivery',
        ]);

        $vendorRole->givePermissionTo([
            'view_profile',
            'edit_profile',
            'view_orders',
            'update_order_status',
            'track_delivery',
        ]);

        $this->command->info('Roles and permissions created successfully!');
    }
}
