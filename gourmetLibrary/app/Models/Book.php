<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Book extends Model
{
    protected $fillable = ['category_id', 'title', 'author', 'published_at', 'total_copies', 'degraded_copies'];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function copies()
    {
        return $this->hasMany(BookCopy::class);
    }

    public function borrows()
    {
        return $this->hasMany(Borrow::class);
    }
}
