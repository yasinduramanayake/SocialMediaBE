<?php

namespace App\Helpers;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class Helper
{
    public static function createPermissions()
    {
        $permisions = [
            [
                'name' => 'Add users',
                'guard_name' => 'api',
            ],

            [
                'name' => 'Add Categories',
                'guard_name' => 'api',
            ],

            [
                'name' => 'Add SubCategories',
                'guard_name' => 'api',
            ],
            [
                'name' => 'Add Services',
                'guard_name' => 'api',
            ],
            [
                'name' => 'View Orders',
                'guard_name' => 'api',
            ],
            [
                'name' => 'Edit Orders',
                'guard_name' => 'api',
            ],
            [
                'name' => 'Edit Payment',
                'guard_name' => 'api',
            ],

            [
                'name' => 'View Reviews',
                'guard_name' => 'api',
            ],
            [
                'name' => 'Add Order',
                'guard_name' => 'api',
            ],
            [
                'name' => 'Add Payments',
                'guard_name' => 'api',
            ],
            [
                'name' => 'Add Review',
                'guard_name' => 'api',
            ],
        ];
        Permission::insert($permisions);
    }

    public static function createRoles()
    {
        Role::create([
            'name' => 'Admin',
            'guard_name' => 'api',
        ])->givePermissionTo([
            'Add users',
            'Add Categories',
            'Add SubCategories',
            'Add Services',
            'View Orders',
            'Edit Payment',
            'View Reviews',
        ]);

        Role::create([
            'name' => 'User',
            'guard_name' => 'api',
        ])->givePermissionTo([
            'Add Review',
            'Add Payments',
            'Add Order',
            'Edit Orders',
        ]);
    }
}
