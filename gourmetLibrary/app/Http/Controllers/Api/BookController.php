<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Book;
use App\Models\Category;

class BookController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Book::with('category')->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
            $validated = $request->validate([
            'title' => 'required|string|max:255',
            'author' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'published_at' => 'required|date',
            'total_copies' => 'required|integer|min:1',
        ]);

        $book = Book::create($validated);

        $book->copies()->create([
            'status' => 'available'
        ]);

        return response()->json($book->load('copies'), 201);

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $book = Book::with(['category', 'copies'])->findOrFail($id);
        return response()->json($book);
    
    }

    
    public function search(Request $request)
    {
        $query = Book::with('category');

        if($request->filled('title')){
            $query->where('title', 'like', '%' . $request->title . '%');
        }
        if($request->filled('author')){
            $query->where('author', 'like', '%'. $request->author . '%');
        }
        if ($request->filled('category_id')) {
            $query->where('category_id', $request->category_id);
        }

        if($request->filled('category_name')){
            $category= Category::where('name', 'like', '%' . $request->category_name . '%')->first();
            if ($category) {
                $query->where('category_id', $category->id);
            } 
        }

        $result=$query->get();   
        if ($result->isEmpty()){
            return response()->json(['message'=>'Aucun livre trouvé'], 404);
        }
        return response()->json($result);
    }
    
    public function latest()
    {
        $books = Book::with('category')->latest()->take(5)->get();
    
        return response()->json($books);
    }

    public function popular()
    {
        $books = Book::with('category')->withCount('borrows')->orderBy('borrows_count', 'desc')->take(5)->get();

        return response()->json($books);
    }

    public function damagedBooks()
    {
        $damagedStats = Book::with(['category'])
            ->withCount(['copies as damaged_copies_count' => function ($query) {
                $query->where('status', 'damaged');
            }])
            ->having('damaged_copies_count', '>', 0)
            ->get();

        return response()->json([
            'total_damaged_items' => $damagedStats->sum('damaged_copies_count'),
            'details' => $damagedStats
        ]);
    }
}

