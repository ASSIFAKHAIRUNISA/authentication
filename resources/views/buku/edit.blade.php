<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/js/bootstrap-datepicker.min.js"></script>
    <title>Edit Buku</title>
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Edit Buku</h1>
        <div class="card p-4 shadow-sm">
            <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT')

                <!-- Input fields for book details -->
                <div class="mb-3">
                    <label for="judul" class="form-label">Judul</label>
                    <input type="text" name="judul" value="{{ $buku->judul }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="penulis" class="form-label">Penulis</label>
                    <input type="text" name="penulis" value="{{ $buku->penulis }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="harga" class="form-label">Harga</label>
                    <input type="number" name="harga" value="{{ $buku->harga }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="tgl_terbit" class="form-label">Tanggal Terbit</label>
                    <input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit }}" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="thumbnail" class="form-label">Upload Thumbnail</label>
                    <input type="file" name="thumbnail" class="form-control" accept="image/*">
                </div>

                <div class="mb-3">
                    <label class="form-label">Upload Gallery Images</label>
                    <input type="file" name="gallery[]" class="form-control" accept="image/*" multiple>
                </div>
                <!-- Display existing gallery images -->
                @if($buku->galleries)
                <div class="mt-3">
                    <p>Gallery saat ini:</p>
                    <div class="d-flex flex-wrap">
                        @foreach($buku->galleries as $gallery)
                            <div class="me-2 mb-2">
                                <img src="{{ asset($gallery->path) }}" alt="Gallery Image" width="100" class="img-thumbnail">

                                <!--Keterangan Gallery-->
                                <div class="keterangan">
                                    <p>{{ $gallery->keterangan }}</p>
                                </div>

                                <div class="form-check mt-1">
                                    <input type="checkbox" class="form-check-input" name="delete_gallery[]" value="{{ $gallery->id }}" id="deleteGallery{{ $gallery->id }}">
                                    <label class="form-check-label text-danger" for="deleteGallery{{ $gallery->id }}">Hapus</label>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
                @endif

                <button type="submit" class="btn btn-primary w-100">Update Buku</button>
            </form>
        </div>
    </div>

    <script>
        function addFileInput() {
            const fileUploads = document.getElementById('fileUploads');
            const fileUploadContainer = document.createElement('div');
            fileUploadContainer.classList.add('mb-3', 'file-upload-container');

            const fileInput = document.createElement('input');
            fileInput.type = 'file';
            fileInput.name = 'gallery[]'; // Make sure the name is in array format
            fileInput.classList.add('form-control', 'file-input', 'mt-2');

            const removeButton = document.createElement('button');
            removeButton.type = 'button';
            removeButton.classList.add('btn', 'btn-danger', 'mt-2');
            removeButton.textContent = 'Remove';
            removeButton.onclick = function () {
                fileUploadContainer.remove();
            };

            fileUploadContainer.appendChild(fileInput);
            fileUploadContainer.appendChild(removeButton);
            fileUploads.appendChild(fileUploadContainer);
        }
    </script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
