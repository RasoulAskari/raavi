<?php

namespace Database\Seeders;

use App\Models\AdministratorSchema;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        AdministratorSchema::create(
            [
                
                'full_name' => 'admin',

                'email' => 'admin@admin.com',
                'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
                "phone_no" => "00923413010354",
                "gender" => "male",

            ]
        );
    }
}
