<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'الأدمن',
            'email' => 'admin@elnagat_edu.com',
            'role' => 'admin',
            'gender' => 'male',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
        ]);

        \App\Models\User::factory()->create([
            'name' => 'طلال',
            'email' => 'talal@elnagat_edu.com',
            'role' => 'official',
            'gender' => 'male',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
        ]);

        \App\Models\User::factory()->create([
            'name' => 'sara',
            'email' => 'sara@elnagat_edu.com',
            'role' => 'official',
            'gender' => 'female',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
        ]);
    }
}
