<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Model</title>
</head>
<body>
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
                    <td>{{ $buku->id }}</td>
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
                            @csrf
                            @method('UPDATE')
                            <button type="submit"
                            class="btn btn-warning">Edit</button>
                        </form> 
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>  

    <!-- Menampilkan jumlah data buku -->
    <p>Jumlah Buku: {{ $jumlah_buku }}</p>

    <!-- Menampilkan total harga semua buku -->
    <p>Total Harga Semua Buku: Rp. {{ number_format($total_harga, 2, ',', '.') }}</p>              
</body>
</html>