<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $fillable = ['book_id', 'user_id', 'review', 'tags'];

    // Cast "tags" sebagai array
    protected $casts = [
        'tags' => 'array',
    ];

    // Relasi dengan buku
    public function buku()
    {
        return $this->belongsTo(Buku::class);
    }

    // Relasi dengan user (reviewer)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
