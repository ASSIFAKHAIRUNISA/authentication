@extends('auth.layouts')

@section('content')

<div class="row justify-content-center mt-5">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>
                @endif

                @if (Auth::check() && Auth::user()->level == 'admin')
                <div class="mb-3 d-flex justify-content-between align-items-center">
                    <a href="{{ route('buku.create') }}" class="btn btn-primary float-end ">Tambah Buku</a>
                    <form action="{{route('buku.search')}}" method="get">@csrf
                        <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 100%;
                        display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
                    </form>
                </div>
                    <table class="table table-stripped">
                        <thead>
                            <tr>
                                <th>id</th>
                                <th>Judul Buku</th>
                                <th>Penulis</th>
                                <th>Harga</th>
                                <th>Tanggal Terbit</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($data_buku as $index => $buku)
                                <tr>
                                    <td>{{ $index+1 }}</td>
                                    <td>
                                        <div style="display: flex; align-items: center;">
                                            @if ($buku->filepath)
                                                <img src="{{ asset($buku->filepath) }}" alt="" style="width: 50px; height: 50px; margin-right: 10px; object-fit: cover;">
                                            @endif
                                            <span>{{ $buku->judul }}</span>
                                        </div>
                                    </td>
                                    <td>{{ $buku->penulis }}</td>
                                    <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <!-- Form Hapus Buku -->
                                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" style="margin-right: 5px;">
                                                @csrf
                                                @method('DELETE')
                                                <button onclick="return confirm('Yakin mau di hapus?')" type="submit" class="btn btn-danger">Hapus</button>
                                            </form>

                                            <!-- Tombol Edit Buku -->
                                            <form action="{{ route('buku.edit', $buku->id) }}" method="GET">
                                                <button type="submit" class="btn btn-warning">Edit</button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                @endif
                            @if(Session::has('pesan'))
                                <div class="alert alert-success">{{Session::get('pesan')}}</div>
                            @endif
                        </tbody>
                    </table>

                    <div>{{ $data_buku->links('pagination::bootstrap-5') }}</div>
                    <div><strong>Jumlah Buku: {{$jumlah_buku}}</strong></div>

                    <!-- Menampilkan jumlah data buku -->
                    {{-- <p>Jumlah Buku: {{ $jumlah_buku }}</p> --}}

                    <!-- Menampilkan total harga semua buku -->
                    <p>Total Harga Semua Buku: Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>

                <div class="row mt-4">
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Jumlah Buku</h5>
                                <p class="card-text">{{ $jumlah_buku }}</p>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-body">
                                <h5 class="card-title">Total Harga Buku</h5>
                                <p class="card-text">Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection














{{-- @extends('auth.layouts')

@section('content')

<a href="{{ route('buku.index') }}">Lihat Buku</a>

<div class="row justify-content-center mt-5">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Dashboard</div>
            <div class="card-body">
                @if ($message = Session::get('success'))
                    <div class="alert alert-success">
                        {{ $message }}
                    </div>
                @else
                    <div class="alert alert-success">
                        You are logged in!
                    </div>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection --}}
