<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = ['Work', 'Personal', 'Shopping', 'Health', 'Education'];

        foreach ($categories as $category) {
            Category::firstOrCreate(['slug' => Str::slug($category)], [
                'name' => $category,
                'description' => "Tasks related to {$category}"
            ]);
        }
    }
}
