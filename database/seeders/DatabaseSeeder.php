<?php

namespace Database\Seeders;

use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Contracts\Permission;

use function Laravel\Prompts\confirm;
use function Laravel\Prompts\info;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $wantToCreateDummy = confirm('Do you want to create dummy data?');
        if ($wantToCreateDummy) {
            User::factory(50)->create();
        }

        $this->call([
            LanguageSeeder::class,
            PermissionSeeder::class,
            RoleSeeder::class,
            StateCitySeeder::class,
            SuperAdminSeeder::class
        ]);

        info('Database seeded successfully');
    }
}
