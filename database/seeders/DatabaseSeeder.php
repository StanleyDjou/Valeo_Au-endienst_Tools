<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::create([
            'name' => "admin",
            'phone' => "1234567",
            'email' => 'admin@gmail.com',
            'admin' => 1,
            'password' => Hash::make("password"),
        ]);

        $this->call(PermissionsSeeder::class);
        $this->call(JobSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(RolePermissionSeeder::class);
        $this->call(LocationSeerder::class);
        $this->call(UserPermissionSeeder::class);
        $this->call(UserRoleSeeder::class);

    }
}
