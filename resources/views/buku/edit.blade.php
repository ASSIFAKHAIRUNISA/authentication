<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Buku</title>
</head>
<body>
    <h1>Edit Buku</h1>
    
    <form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        @method('PUT')

        <label for="judul">Judul:</label>
        <input type="text" name="judul" value="{{ $buku->judul }}" required><br>

        <label for="penulis">Penulis:</label>
        <input type="text" name="penulis" value="{{ $buku->penulis }}" required><br>

        <label for="harga">Harga:</label>
        <input type="number" name="harga" value="{{ $buku->harga }}" required><br>

        <label for="tgl_terbit">Tanggal Terbit:</label>
        <input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit }}" required><br>

        <button type="submit">Update Buku</button>
    </form>
</body>
</html>
