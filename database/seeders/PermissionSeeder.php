<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'users_list',
            'user_add',
            'user_edit',
            'user_delete',

            'products_list',
            'product_add',
            'product_edit',
            'product_delete',

            'brands_list',
            'brand_add',
            'brand_edit',
            'brand_delete',

            'orders_list',
            'order_add',
            'order_edit',
            'order_delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
