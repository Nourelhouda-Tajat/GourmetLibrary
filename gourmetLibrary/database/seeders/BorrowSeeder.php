<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Book;
use App\Models\User;
use App\Models\Borrow;

class BorrowSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
        $user = User::where('role', 'gourmand')->first();
        $book = Book::first();

        if ($user && $book) {
            Borrow::create([
                'user_id' => $user->id,
                'book_id' => $book->id,
                'status' => 'active',
                'borrowed_at' => now(),
                'returned_at' => null,
            ]);
        }
    
        }
    }
}
