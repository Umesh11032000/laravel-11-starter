<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

use function Laravel\Prompts\info;
use function Laravel\Prompts\table;

class SuperAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $suprAdminUser = [
            'first_name' => 'Super',
            'middle_name' => '',
            'last_name' => 'Admin',
            'email' => 'superadmin@' . config('app.name', 'laravel') . '.com',
            'password' => bcrypt('12345678'),
            'mobile_number' => '1234567890',
        ];

        $suprAdminUser = User::updateOrCreate(['email' => $suprAdminUser['email']], $suprAdminUser);
        $permissions = Permission::all();

        $role = Role::where('slug', 'super-admin')->first();

        if (!$role) {
            Artisan::call('db:seed', ['--class' => RoleSeeder::class]);

            $role = Role::where('slug', 'super-admin')->first();
        }

        $role->syncPermissions($permissions);

        $suprAdminUser->assignRole($role);

        $suprAdminUser->email_verified_at = now();
        $suprAdminUser->save();

        $action = $suprAdminUser->isrewasRecentlyCreated ? 'created' : 'updated';
        info("Super Admin user $action successfully.");

        table([
            ['Name', $suprAdminUser->full_name],
            ['Email', $suprAdminUser->email],
            ['Password', '12345678'],
        ]);
    }
}
