<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Dropzone Form Upload</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container my-5">
    <h2 class="mb-4">Form with Dropzone Upload</h2>

    <form id="my-form" method="POST" action="{{ route('form.submit') }}" enctype="multipart/form-data">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" name="name" class="form-control">
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Upload Gallery</label>
            <div class="dropzone" id="gallery-dropzone"></div>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Submit</button>
    </form>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.3/min/dropzone.min.js"></script>
<script>
    Dropzone.autoDiscover = false;

    let uploadedGalleryFiles = [];

    const galleryDropzone = new Dropzone("#gallery-dropzone", {
        url: "{{ route('form.upload') }}",
        maxFiles: 10,
        acceptedFiles: "image/*",
        addRemoveLinks: true,
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
        },
        success: function (file, response) {
            uploadedGalleryFiles.push(response.path);
        },
        removedfile: function (file) {
            let index = uploadedGalleryFiles.findIndex(path => path === file.upload?.filename || file.name);
            if (index > -1) uploadedGalleryFiles.splice(index, 1);
            file.previewElement.remove();
        }
    });

    $('#my-form').on('submit', function(e) {
        e.preventDefault();

        let formData = new FormData(this);
        uploadedGalleryFiles.forEach(path => {
            formData.append('gallery[]', path);
        });

        $.ajax({
            url: "{{ route('form.submit') }}",
            method: 'POST',
            data: formData,
            processData: false,
            contentType: false,
            success: function(response) {
                alert('Data berhasil disimpan!');
                $('#my-form')[0].reset();
                galleryDropzone.removeAllFiles();
            },
            error: function(err) {
                alert('Terjadi kesalahan!');
                console.log(err.responseText);
            }
        });
    });
</script>

</body>
</html>
