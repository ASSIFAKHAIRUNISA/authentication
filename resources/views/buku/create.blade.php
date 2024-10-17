<html>
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Perpustakaan</title>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
        <!-- Tambahkan jQuery -->
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <!-- Tambahkan Bootstrap Datepicker -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
        <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    </head>
    <body>
        <div class="container">
            <h4>Tambah Buku</h4>
            <form method="post" action="{{route('buku.store')}}">
                @csrf
                <div>Judul <input type="text" name="judul" class="form-control"></div>
                <div>Penulis <input type="text" name="penulis" class="form-control"></div>
                <div>Harga <input type="text" name="harga" class="form-control"></div>
                <div>Tanggal Terbit
                    <input type="text" name="tanggal_terbit" class="form-control date">
                </div>
                <button type="submit" class="btn btn-primary mt-3">Simpan</button>
                <a href="{{'/buku'}}" class="btn btn-secondary mt-3">Kembali</a>
            </form>
        </div>

        <script type="text/javascript">
            $(document).ready(function(){
                $('.date').datepicker({
                    format: 'yyyy/mm/dd',
                    autoclose: true
                });
            });
        </script>
        @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
            <li>{{ __('Terjadi kesalahan: ') . $error }}</li>
            @endforeach
        </ul>
        @endif

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    </body>
</html>
