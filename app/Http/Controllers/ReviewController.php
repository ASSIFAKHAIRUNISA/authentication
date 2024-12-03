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
        $buku = Buku::all(); // Mengambil daftar buku
        return view('reviews.create', compact('buku'));
    }

    // Menyimpan review yang dikirimkan melalui form
    public function store(Request $request)
    {
        $request->validate([
            'buku_id' => 'required|exists:buku,id',
            'review' => 'required|string',
            'tags' => 'nullable|array',
            'tags.*' => 'string',
        ]);

        // Menyimpan review
        Review::create([
            'buku_id' => $request->buku_id,
            'user_id' => auth()->id(), // Mengambil ID pengguna yang sedang login
            'review' => $request->review,
            'tags' => $request->tags, // Menyimpan tag dalam format JSON
        ]);

        return redirect()->route('reviews.create')->with('success', 'Review berhasil disimpan!');
    }

    // Menampilkan review berdasarkan reviewer
    public function showByReviewer($userId)
    {
        $reviews = Review::where('user_id', $userId)->with('buku')->get();
        return view('reviews.reviewer', compact('reviews'));
    }

    public function showByTag($tagName)
    {
        $reviews = Review::whereJsonContains('tags', $tagName)->with('buku')->get();
        return view('reviews.tag', compact('reviews'));
    }


    public function __construct()
    {
        $this->middleware(['auth', 'role:admin,internal_reviewer']);
    }

    public function show($bukuId)
    {
        $buku = Buku::findOrFail($bukuId); // Menemukan buku berdasarkan ID
        $reviews = $buku->reviews; // Mendapatkan semua review untuk buku tersebut

        return view('reviews.show', compact('buku', 'reviews')); // Mengirimkan data buku dan review ke view
    }

}
