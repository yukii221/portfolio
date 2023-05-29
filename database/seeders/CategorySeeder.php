<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = [
            'ニュース',
            '観光',
            'イベント',
            '生活',
        ];

        foreach ($categories as $category) {
            Category::create(['name' => $category]);
        }
    
    }
}
