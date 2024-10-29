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

                <form action="{{route('buku.search')}}" method="get">@csrf
                    <input type="text" name="kata" class="form-control" placeholder="Cari ..." style="width: 30%;
                    display: inline; margin-top: 10px; margin-bottom: 10px; float: right;">
                </form>
                <a href="{{ route('buku.create') }}" class="btn btn-primary float-end">Tambah Buku</a>
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
                                    <td>{{ $buku->judul }}</td>
                                    <td>{{ $buku->penulis }}</td>
                                    <td>{{ "Rp. ".number_format($buku->harga, 2, ',', '.') }}</td>
                                    <td>{{ \Carbon\Carbon::parse($buku->tgl_terbit)->format('d-m-Y') }}</td>
                                    <td>
                                        <form action="{{ route('buku.destroy', $buku->id) }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button onclick="return confirm('Yakin mau di hapus?')" type="submit"
                                            class="btn btn-danger">Hapus</button>
                                        </form>
                                    </td>
                                    <td>
                                        <!-- Tombol Edit Buku -->
                                        <form action="{{ route('buku.edit', $buku->id) }}" method="PUT">
                                            <button type="submit"
                                            class="btn btn-warning">Edit</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
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
