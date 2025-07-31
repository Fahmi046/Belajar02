<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Category::create(['name' => 'Web Programming', 'slug' => 'web-programming','color' => 'red']);
        Category::create(['name' => 'Personal', 'slug' => 'personal','color' => 'green']);
        Category::create(['name' => 'Programming', 'slug' => 'programming','color' => 'blue']);   
    }
}