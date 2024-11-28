<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulir Review Buku</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <!-- Header atau Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <a class="navbar-brand" href="#">Katalog Buku</a>
        <div class="collapse navbar-collapse">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <a class="nav-link" href="#">Beranda</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Review</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">Tentang Kami</a>
                </li>
            </ul>
        </div>
    </nav>

    <div class="container mt-5">
        <h1>Formulir Review Buku</h1>

        <!-- Menampilkan pesan sukses jika ada -->
        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Formulir Review Buku -->
        <form action="{{ url('/formulir-review-buku') }}" method="POST">
            @csrf

            <!-- Dropdown Pemilihan Buku -->
            <div class="mb-3">
                <label for="book_id" class="form-label">Pilih Buku</label>
                <select name="book_id" id="book_id" class="form-control" required>
                    <option value="" selected disabled>Pilih Buku</option>
                    @foreach ($books as $book)
                        <option value="{{ $book->id }}">{{ $book->title }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Text Area Review -->
            <div class="mb-3">
                <label for="review" class="form-label">Tulis Review</label>
                <textarea name="review" id="review" class="form-control" rows="5" required></textarea>
            </div>

            <!-- Multiple Input Tags -->
            <div class="mb-3">
                <label for="tags" class="form-label">Tag</label>
                <div id="tags-container">
                    <input type="text" name="tags[]" class="form-control mb-2" placeholder="Tambahkan tag">
                </div>
                <button type="button" id="add-tag" class="btn btn-secondary">Tambah Tag</button>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Simpan Review</button>
        </form>
    </div>

    <!-- Footer -->
    <footer class="bg-light py-4 mt-5">
        <div class="container text-center">
            <p>&copy; 2024 Katalog Buku. Semua Hak Dilindungi.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        // Tambah input tag baru
        document.getElementById('add-tag').addEventListener('click', function() {
            const container = document.getElementById('tags-container');
            const input = document.createElement('input');
            input.type = 'text';
            input.name = 'tags[]';
            input.className = 'form-control mb-2';
            input.placeholder = 'Tambahkan tag';
            container.appendChild(input);
        });
    </script>
</body>
</html>
