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

        \App\Models\User::create([
            'name' => 'الأدمن',
            'email' => 'admin@alnajat.edu.kw',
            'role' => 'admin',
            'gender' => 'ذكر',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
        ]);

        \App\Models\User::create([
            'name' => 'طلال',
            'email' => 'talal@alnajat.edu.kw',
            'role' => 'official',
            'gender' => 'ذكر',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
        ]);

        \App\Models\User::create([
            'name' => 'سارة عثمان',
            'email' => 'sara@alnajat.edu.kw',
            'role' => 'official',
            'gender' => 'أنثى',
            'password' => "$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi" //password
        ]);
    }
}
