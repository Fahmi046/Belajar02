<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
        User::factory()->create([
            'name' => 'Sandika Galih',
            'username' => 'sandikagalih',
            'email' => 'sandika@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::factory()->create([
            'name' => 'Elvin',
            'username' => 'elvin',
            'email' => 'elvin@gmail.com',
            'password' => bcrypt('password'),
        ]);
        User::factory(3)->create(); // Membuat 3 user random lainnya [cite: 435]
    }
    }
}
