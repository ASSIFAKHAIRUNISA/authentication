@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="text-center">Formulir Review Buku</h1>
    <form action="{{ route('reviews.store') }}" method="POST">
        @csrf
        <!-- Dropdown untuk memilih buku -->
        <div class="mb-3">
            <label for="buku_id" class="form-label">Pilih Buku</label>
            <select name="buku_id" id="buku_id" class="form-control" required>
                <option value="">-- Pilih Buku --</option>
                @foreach ($buku as $book)
                    <option value="{{ $book->id }}">{{ $book->judul }}</option>
                @endforeach
            </select>
        </div>

        <!-- Textarea untuk review -->
        <div class="mb-3">
            <label for="review" class="form-label">Tulis Review</label>
            <textarea name="review" id="review" class="form-control" rows="5" required></textarea>
        </div>

        <!-- Input untuk tags -->
        <div id="tags-container" class="mb-3">
            <label for="tags" class="form-label">Tags (Tambahkan Tag)</label>
            <div>
                <input type="text" name="tags[]" class="form-control mb-2" placeholder="Tag">
            </div>
        </div>
        <button type="button" class="btn btn-secondary mb-3" id="add-tag">Tambahkan Tag</button>

        <!-- Tombol submit -->
        <button type="submit" class="btn btn-primary">Simpan Review</button>
    </form>
</div>

<script>
    document.getElementById('add-tag').addEventListener('click', function() {
        const container = document.getElementById('tags-container');
        const input = document.createElement('input');
        input.type = 'text';
        input.name = 'tags[]';
        input.className = 'form-control mb-2';
        input.placeholder = 'Tag';
        container.appendChild(input);
    });
</script>
@endsection
