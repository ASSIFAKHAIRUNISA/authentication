<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Tambahkan jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Tambahkan Bootstrap Datepicker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
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
    <script type="text/javascript">
        $(document).ready(function(){
            $('.date').datepicker({
                format: 'yyyy/mm/dd',
                autoclose: true
            });
        });
    </script>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
