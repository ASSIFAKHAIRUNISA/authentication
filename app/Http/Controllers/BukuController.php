<?php

namespace App\Http\Controllers;

use App\Models\Buku;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;
use App\Models\Gallery;

class BukuController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }
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
        return view('auth.dashboard', compact('data_buku', 'no', 'jumlah_buku', 'total_harga'));
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
    // Validasi input
    $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:30',
        'harga' => 'required|numeric',
        'tanggal_terbit' => 'required|date',
        'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'keterangan' => 'required|string', // menambahkan keterangan
        'gallery.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048' // Validasi untuk setiap file dalam array gallery
    ]);

    // Buat instance buku baru
    $buku = new Buku();
    $buku->judul = $request->judul;
    $buku->penulis = $request->penulis;
    $buku->harga = $request->harga;
    $buku->tgl_terbit = $request->tanggal_terbit;

    // Proses upload thumbnail jika ada
    if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
        $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

        // Resize menggunakan Intervention Image
        Image::make(storage_path('app/public/uploads/' . $fileName))
            ->fit(240, 320)
            ->save();

        // Simpan informasi file ke dalam database
        $buku->filename = $fileName;
        $buku->filepath = '/storage/uploads/' . $fileName;
    }

    // Simpan buku ke database
    $buku->save();

    // Proses upload gallery jika ada
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $file) {
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                // Simpan informasi gallery ke dalam database
                Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/uploads/' . $fileName,
                    'keterangan' => $request->keterangan, //Menambah keterangan galeri
                    'foto' => $fileName,
                    'buku_id' => $buku->id
                ]);
            }
        }
    }

    return redirect('/buku')->with('pesan', 'Data Buku Berhasil Disimpan');
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
    $buku = Buku::findOrFail($id);

    // Validasi input
    $request->validate([
        'judul' => 'required|string|max:255',
        'penulis' => 'required|string|max:255',
        'harga' => 'required|numeric',
        'tgl_terbit' => 'required|date',
        'thumbnail' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'gallery.*' => 'nullable|image|mimes:jpeg,jpg,png|max:2048',
        'keterangan' => 'required|string', // menambahkan keterangan
        'delete_gallery' => 'nullable|array' // Tambahkan validasi untuk galeri yang ingin dihapus
    ]);

    // Update data buku
    $buku->judul = $request->judul;
    $buku->penulis = $request->penulis;
    $buku->harga = $request->harga;
    $buku->tgl_terbit = $request->tgl_terbit;

    // Hapus gallery yang dipilih
    if ($request->has('delete_gallery')) {
        foreach ($request->delete_gallery as $galleryId) {
            $gallery = Gallery::find($galleryId);
            if ($gallery) {
                // Hapus file dari storage
                if (Storage::disk('public')->exists('uploads/' . $gallery->foto)) {
                    Storage::disk('public')->delete('uploads/' . $gallery->foto);
                }
                // Hapus dari database
                $gallery->delete();
            }
        }
    }

    // Proses upload thumbnail baru jika ada
    if ($request->hasFile('thumbnail') && $request->file('thumbnail')->isValid()) {
        $fileName = time() . '_' . $request->thumbnail->getClientOriginalName();
        $filePath = $request->file('thumbnail')->storeAs('uploads', $fileName, 'public');

        // Resize menggunakan Intervention Image
        Image::make(storage_path('app/public/uploads/' . $fileName))
            ->fit(240, 320)
            ->save();

        // Update path di database
        $buku->filename = $fileName;
        $buku->filepath = '/storage/uploads/' . $fileName;
    }

    // Proses upload gallery baru jika ada
    if ($request->hasFile('gallery')) {
        foreach ($request->file('gallery') as $file) {
            if ($file->isValid()) {
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');

                // Simpan informasi gallery ke database
                Gallery::create([
                    'nama_galeri' => $fileName,
                    'path' => '/storage/uploads/' . $fileName,
                    'foto' => $fileName,
                    'keterangan' => $request->keterangan, //Menambah keterangan galeri
                    'buku_id' => $id
                ]);
            }
        }
    }

    // Simpan perubahan data buku
    $buku->save();

    return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Update');
}


    /**
     * Menghapus data buku
     */
    public function destroy($id)
    {
        $buku = Buku::find($id);

        if ($buku) {
            $buku->delete();
            return redirect('/buku')->with('pesan', 'Data Buku Berhasil di Hapus');
        }

        return redirect('/buku')->with('error', 'Buku tidak ditemukan');
    }
}
