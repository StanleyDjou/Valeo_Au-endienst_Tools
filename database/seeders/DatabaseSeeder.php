<?php

namespace Database\Seeders;

use App\Models\Constant;
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
            'name' => "Djoukeng Stalone",
            'phone' => "+49 17642056794",
            'email' => 'sdjouken@gmail.com',
            'admin' => 1,
            'password' => Hash::make("password"),
        ]);

        Constant::create([
            'name' => "Fuel Price",
            'value' => "1.70",
        ]);

        Constant::create([
            'name' => "Consumption Per 100km",
            'value' => "8",
        ]);

        Constant::create([
            'name' => "Average Food Price Per Day",
            'value' => "20",
        ]);

        Constant::create([
            'name' => "Origin Town",
            'value' => "Stollberg Erzgeb",
        ]);

    }
}
