<?php

namespace Database\Seeders;

use App\Models\Tag;
use Illuminate\Database\Seeder;

class TagSeeder extends Seeder
{
    public function run(): void
    {
        foreach (['Urgent', 'Client', 'Home', 'Planning', 'Follow Up'] as $tag) {
            Tag::firstOrCreate(['name' => $tag]);
        }
    }
}
