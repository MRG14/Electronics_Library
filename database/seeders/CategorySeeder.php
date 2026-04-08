<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            'Edukasi',
            'Teknologi',
            'Novel',
            'Komik',
            'Fiksi',
            'Non-Fiksi'
        ];

        foreach ($categories as $name) {
            Category::create([
                'title' => $name,
                'image_path' => 'categories/images/sample.jpg'
            ]);
        }
    }
}
