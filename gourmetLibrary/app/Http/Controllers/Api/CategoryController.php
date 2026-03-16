<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(Category::all());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required|string|unique:categories',  
        ]);
        return response()->json(Category::create($data), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        return response()->json($category);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        $data = $request->validate([
            'name' => 'string|unique:categories,name,' . $category->id,
        ]);
        $category->update($data);
        return response()->json($category);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return response()->json(null, 204);
    }

    public function stats()
    {
        // Récupère toutes les catégories et compte le nombre de livres dans chacune
        $stats = Category::withCount('books')
            ->orderBy('books_count', 'desc') // Les plus représentées en premier
            ->get();

        return response()->json([
            'message' => 'Statistiques de la collection par catégorie',
            'data' => $stats
        ]);
    }
}
