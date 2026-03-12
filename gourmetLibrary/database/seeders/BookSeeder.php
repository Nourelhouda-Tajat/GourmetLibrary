<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\BookCopy;
use App\Models\Category;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $category = Category::first();

        $books = [
            [
                'title' => 'Le Grand Larousse Pâtissier',
                'author' => 'Ferrandi Paris',
                'category_id' => $category->id,
                'published_at' => '2023-10-12',
                'total_copies' => 5,
                'degraded_copies' => 1,
            ],
            [
                'title' => 'Pasta Grannies',
                'author' => 'Vicky Bennison',
                'category_id' => $category->id,
                'published_at' => '2019-10-17',
                'total_copies' => 3,
                'degraded_copies' => 0,
            ]
        ];
        foreach ($books as $bookData) {
            $book = Book::create($bookData);
            
            for ($i = 0; $i < $book->total_copies; $i++) {
                BookCopy::create([
                    'book_id' => $book->id,
                    'status' => ($i === 0 && $book->degraded_copies > 0) ? 'damaged' : 'available'
                ]);
            }
        }
    }
}
