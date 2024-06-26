<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\Enums\RoleType;

class RolesAndPermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userPermissions = [
            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'permission-list',
            'permission-create',
            'permission-edit',
            'permission-delete',

            'category-list',
            'category-create',
            'category-edit',
            'category-delete',

            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',


            'product-list',
            'product-create',
            'product-edit',
            'product-delete',


            'order-list',
            'order-create',
            'order-edit',
            'order-delete',

            'statistic-summary'
        ];

        foreach ($userPermissions as $permission) {
            Permission::create(['name' => $permission, 'guard_name' => 'user']);
        }


        Role::query()->create([
            'name' => RoleType::ADMIN,
            'guard_name' => 'user',
        ])->syncPermissions($userPermissions);


    }
}
