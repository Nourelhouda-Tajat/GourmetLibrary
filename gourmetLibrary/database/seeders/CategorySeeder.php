<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Category;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Pâtisserie',],
            ['name' => 'Cuisine Italienne', ],
            ['name' => 'Vins & Sommelerie', ],
            ['name' => 'Techniques de Chef',],
        ];

        foreach ($categories as $cat) {
            Category::create($cat);
        }
    }
}
