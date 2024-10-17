@if(count($data_buku))
    <div class="alert alert-success">Ditemukan <strong>{{count($data_buku)}}</strong> data dengan kata: <strong>{{$cari}}</strong></div>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Model</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
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

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
@else
    <div class="alert alert-warning"><h4>Data {{$cari}} tidak ditemukan</h4>
    <a href="/buku" class="btn btn-warning">Kembali</a></div>
@endif
