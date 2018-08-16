<?php

use Illuminate\Database\Seeder;

class PermissionSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $items = [
            
            ['id' => 1, 'title' => 'user_management_access',],
            ['id' => 2, 'title' => 'permission_access',],
            ['id' => 3, 'title' => 'permission_create',],
            ['id' => 4, 'title' => 'permission_edit',],
            ['id' => 5, 'title' => 'permission_view',],
            ['id' => 6, 'title' => 'permission_delete',],
            ['id' => 7, 'title' => 'role_access',],
            ['id' => 8, 'title' => 'role_create',],
            ['id' => 9, 'title' => 'role_edit',],
            ['id' => 10, 'title' => 'role_view',],
            ['id' => 11, 'title' => 'role_delete',],
            ['id' => 12, 'title' => 'user_access',],
            ['id' => 13, 'title' => 'user_create',],
            ['id' => 14, 'title' => 'user_edit',],
            ['id' => 15, 'title' => 'user_view',],
            ['id' => 16, 'title' => 'user_delete',],
            ['id' => 17, 'title' => 'product_management_access',],
            ['id' => 18, 'title' => 'product_management_create',],
            ['id' => 19, 'title' => 'product_management_edit',],
            ['id' => 20, 'title' => 'product_management_view',],
            ['id' => 21, 'title' => 'product_management_delete',],
            ['id' => 22, 'title' => 'product_category_access',],
            ['id' => 23, 'title' => 'product_category_create',],
            ['id' => 24, 'title' => 'product_category_edit',],
            ['id' => 25, 'title' => 'product_category_view',],
            ['id' => 26, 'title' => 'product_category_delete',],
            ['id' => 27, 'title' => 'product_tag_access',],
            ['id' => 28, 'title' => 'product_tag_create',],
            ['id' => 29, 'title' => 'product_tag_edit',],
            ['id' => 30, 'title' => 'product_tag_view',],
            ['id' => 31, 'title' => 'product_tag_delete',],
            ['id' => 32, 'title' => 'product_access',],
            ['id' => 33, 'title' => 'product_create',],
            ['id' => 34, 'title' => 'product_edit',],
            ['id' => 35, 'title' => 'product_view',],
            ['id' => 36, 'title' => 'product_delete',],

        ];

        foreach ($items as $item) {
            \App\Permission::create($item);
        }
    }
}
