<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku;

class BukuController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // $data_buku = Buku::all();
        $batas = 5;

        //mengurutkan buku berdasarkan kolom id yang terakhir
        // $data_buku = Buku::all()->sortByDesc('id');
        $data_buku = Buku::orderBy('id', 'desc')->paginate($batas);
        $no = $batas * ($data_buku->currentPage() - 1);

        // Menghitung jumlah data buku
        $jumlah_buku = Buku::count();

        // Menghitung total harga dari semua buku
        $total_harga = Buku::sum('harga');

        // Mengirim data ke view
        return view('buku.index', compact('data_buku', 'no', 'jumlah_buku', 'total_harga'));
    }

    public function search(Request $request){
        $batas = 5;
        $cari = $request->kata;
        $data_buku = Buku::where('judul','like',"%".$cari."%")->orwhere('penulis','like',"%".$cari."%")->paginate($batas);
        $jumlah_buku = $data_buku->count();
        $no = $batas = ($data_buku->currentPage()-1);
        return view('buku.search', compact('jumlah_buku','data_buku', 'no', 'cari'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('buku.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // dd($request); untuk cek bug fixing
        // $buku = new Buku();
        // $buku->judul = $request->judul;
        // $buku->penulis = $request->penulis;
        // $buku->harga = $request->harga;
        // $buku->tgl_terbit = $request->tanggal_terbit;
        // $buku->save();
        $this->validate($request,[
            'judul' => 'required|string',
            'penulis' => 'required|string|max:30',
            'harga' => 'required|numeric',
            'tanggal_terbit' => 'required|date'
        ]);

        // return redirect()->route('buku.index');
        return redirect('/buku')->with('pesan','Data Buku Berhasil di Simpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $buku = Buku::find($id);
        return view('buku.edit', compact('buku'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $buku = Buku::find($id);
        $buku->judul = $request->judul;
        $buku->penulis = $request->penulis;
        $buku->harga = $request->harga;
        $buku->tgl_terbit = $request->tgl_terbit;
        $buku->save();

        // Redirect to the buku index page
        // return redirect()->route('buku.index');
        return redirect('/buku')->with('pesan','Data Buku Berhasil di Update');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $buku = Buku::find($id);
        $buku->delete();

        // return redirect('/buku');
        return redirect('/buku')->with('pesan','Data Buku Berhasil di Hapus');
    }
}
