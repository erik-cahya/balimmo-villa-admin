@extends('admin.layouts.master')
@push('styles')
    <style>
        .img-preview {
            position: relative;
        }

        .img-preview .remove-btn {
            position: absolute;
            top: -8px;
            right: -8px;
            background: red;
            color: white;
            border: none;
            border-radius: 50%;
            width: 22px;
            height: 22px;
            font-size: 14px;
            line-height: 18px;
            text-align: center;
            cursor: pointer;
        }
    </style>
@endpush
@section('content')
    <div class="container">
        <h2>Edit Gallery</h2>

        <form action="{{ route('gallery.update', $gallery->id) }}" method="POST" enctype="multipart/form-data" id="galleryForm">
            @csrf
            <input type="text" name="title" value="{{ $gallery->title }}" class="form-control mb-3">
            <textarea name="description" class="form-control mb-3">{{ $gallery->description }}</textarea>

            <h5>Existing Images</h5>
            <div id="existingImages" class="d-flex mb-3 flex-wrap gap-3">

                @foreach ($gallery->images->sortBy('order') as $img)
                    <div class="img-preview" data-id="{{ $img->id }}" class="d-flex">
                        <img src="{{ asset($img->image_path) }}" style="width:150px; height:150px; object-fit:cover; border:1px solid #ccc; padding:4px;">
                        <p class="mt-1 text-center"></p>
                        <button type="button" class="btn btn-sm btn-danger btn-delete" data-id="{{ $img->id }}">Delete</button>
                    </div>
                @endforeach

            </div>

            <input type="hidden" name="order" id="imageOrder">

            {{-- <h5>Add New Images</h5>
        <input type="file" name="images[]" multiple class="form-control mb-3"> --}}

            <h5>New Images Preview</h5>
            <div id="newImagesPreview" class="d-flex mb-3 flex-wrap gap-3"></div>
            <input type="file" name="images[]" id="newImageInput" multiple class="form-control mb-3">

            <button type="submit" class="btn btn-success">Update Gallery</button>
        </form>
    </div>
@endsection

@push('scripts')
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>
    {{-- Delete Per Image --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            document.querySelectorAll('.btn-delete').forEach(btn => {
                btn.addEventListener('click', function() {
                    const imageId = this.getAttribute('data-id');
                    if (confirm('Are you sure you want to delete this image?')) {
                        fetch(`/gallery-images/${imageId}`, {
                                method: 'DELETE',
                                headers: {
                                    'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                    'Accept': 'application/json',
                                }
                            })
                            .then(res => res.json())
                            .then(data => {
                                if (data.success) {
                                    // remove image from DOM
                                    this.closest('.img-preview').remove();
                                }
                            });
                    }
                });
            });
        });
    </script>

    {{-- /*  Delete Per Image */ --}}

    <script>
        const newImageInput = document.getElementById('newImageInput');
        const newImagesPreview = document.getElementById('newImagesPreview');

        newImageInput.addEventListener('change', (e) => {
            const files = Array.from(e.target.files);
            newImagesPreview.innerHTML = ''; // Kosongkan preview sebelumnya

            files.forEach((file, index) => {
                const reader = new FileReader();
                reader.onload = (event) => {
                    const imgDiv = document.createElement('div');
                    imgDiv.classList.add('img-preview');

                    const removeBtn = document.createElement('button');
                    removeBtn.classList.add('remove-btn');
                    removeBtn.innerHTML = '&times;';
                    removeBtn.addEventListener('click', () => {
                        files.splice(index, 1); // hapus dari array
                        const dt = new DataTransfer();
                        files.forEach(f => dt.items.add(f));
                        newImageInput.files = dt.files; // replace file input
                        imgDiv.remove(); // hapus preview
                    });

                    imgDiv.innerHTML = `
                    <img src="${event.target.result}" alt="Preview" style="width: 150px; height: 150px; object-fit: cover; border: 2px solid #ccc; padding: 4px;">
                    <p class="text-center">Baru ${index + 1}</p>
                `;
                    imgDiv.appendChild(removeBtn);
                    newImagesPreview.appendChild(imgDiv);
                };
                reader.readAsDataURL(file);
            });
        });
    </script>

    <script>
        const existing = document.getElementById('existingImages');
        const orderInput = document.getElementById('imageOrder');


        function updateOrder() {
            const ids = [...document.querySelectorAll('.img-preview')].map(e => e.dataset.id);
            orderInput.value = ids.join(',');
        }

        new Sortable(existing, {
            animation: 150,
            onEnd: () => updateOrder(),
        });

        updateOrder();

        document.getElementById('galleryForm').addEventListener('submit', () => {
            updateOrder();
        });
    </script>
@endpush
