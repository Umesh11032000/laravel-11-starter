<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $permissions = [
            [
                'name' => 'create-update-user',
                'guard_name' => 'web',
                'collection_name' => 'user',
                'description' => 'A user can create and update users',
            ],
            [
                'name' => 'delete-user',
                'guard_name' => 'web',
                'collection_name' => 'user',
                'description' => 'A user can delete users',
            ],
            [
                'name' => 'view-user',
                'guard_name' => 'web',
                'collection_name' => 'user',
                'description' => 'A user can view users',
            ],
            [
                'name' => 'view-all-users',
                'guard_name' => 'web',
                'collection_name' => 'user',
                'description' => 'A user can view all users',
            ],
            [
                'name' => 'export-users',
                'guard_name' => 'web',
                'collection_name' => 'user',
                'description' => 'A user can export users',
            ],
            [
                'name' => 'create-update-role',
                'guard_name' => 'web',
                'collection_name' => 'role',
                'description' => 'A user can create and update roles',
            ],
            [
                'name' => 'delete-role',
                'guard_name' => 'web',
                'collection_name' => 'role',
                'description' => 'A user can delete roles',
            ],
            [
                'name' => 'view-role',
                'guard_name' => 'web',
                'collection_name' => 'role',
                'description' => 'A user can view roles',
            ],
            [
                'name' => 'export-roles',
                'guard_name' => 'web',
                'collection_name' => 'role',
                'description' => 'A user can export roles',
            ],
        ];

        foreach ($permissions as $permission) {
            Permission::updateOrCreate(
                [
                    'name' => $permission['name'],
                    'guard_name' => $permission['guard_name'],
                    'collection_name' => $permission['collection_name'],
                ],
                $permission,
            );
        }
    }
}
