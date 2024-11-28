<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use App\Models\Review;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    // Menampilkan halaman untuk membuat review buku
    public function create()
    {
        $books = Buku::all(); // Mengambil daftar buku
        return view('reviews.create', compact('books'));
    }

    // Menyimpan review yang dikirimkan melalui form
    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'review' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        // Menyimpan review
        Review::create([
            'book_id' => $request->book_id,
            'user_id' => auth()->id(), // Mengambil ID pengguna yang sedang login
            'review' => $request->review,
            'tags' => $request->tags, // Menyimpan tag dalam format JSON
        ]);

        return redirect()->route('reviews.create')->with('success', 'Review berhasil disimpan!');
    }

    // Menampilkan review berdasarkan reviewer
    public function showByReviewer($userId)
    {
        $reviews = Review::where('user_id', $userId)->with('book')->get(); // Ambil semua review oleh reviewer tertentu
        return view('reviews.reviewer', compact('reviews'));
    }

    // Menampilkan review berdasarkan tag
    public function showByTag($tag)
    {
        $reviews = Review::whereJsonContains('tags', $tag)->with('book')->get(); // Ambil review yang mengandung tag tertentu
        return view('reviews.tag', compact('reviews'));
    }

    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,internal_reviewer']);
    }

}
