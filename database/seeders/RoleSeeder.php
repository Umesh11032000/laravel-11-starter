<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            [
                'name' => 'Super Admin',
                'guard_name' => 'web',
                'slug' => 'super-admin',
                'display_name' => 'Super Admin',
                'description' => 'Super Admin',
            ],
            [
                'name' => 'Admin',
                'guard_name' => 'web',
                'slug' => 'admin',
                'display_name' => 'Admin',
                'description' => 'Admin',
            ],
            [
                'name' => 'User',
                'guard_name' => 'web',
                'slug' => 'user',
                'display_name' => 'User',
                'description' => 'User',
            ]
        ];

        foreach ($roles as $role) {
            Role::updateOrCreate([
                'slug' => $role['slug'],
            ], $role);
        }
    }
}
