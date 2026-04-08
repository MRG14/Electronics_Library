<?php

namespace Database\Seeders;

use App\Models\Book;
use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = Category::all();
        $users = User::all();

        foreach (range(1, 20) as $i) {
            $title = "Judul Buku {$i}";
            $status = fake()->randomElement(['waiting approval', 'approved', 'rejected']);

            Book::create([
                'user_id' => $users->random()->id,
                'category_id' => $categories->random()->id,

                'title' => $title,
                'slug' => str($title)->slug(),
                'description' => fake()->text(200),

                // placeholder image + file
                'image_path' => 'books/images/sample.jpg',
                'file_path' => 'books/files/sample.pdf',

                'status' => $status,
                'approved_at' => $status === 'approved' ? now()->subDays(rand(1, 30)) : null,
            ]);
        }
    }
}
