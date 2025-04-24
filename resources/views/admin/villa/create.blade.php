@extends('admin.layouts.master')
@push('plugin-styles')
    <link href="{{ asset('/admin/assets/plugins/dropzone/dropzone.min.css') }}" rel="stylesheet" />
@endpush
@section('content')

<nav class="page-breadcrumb">
    <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="#">Villa</a></li>
        <li class="breadcrumb-item active" aria-current="page">Add Villa</li>
    </ol>
</nav>

<div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
    <div>
      <h4 class="">Add Villa</h4>
    </div>
</div>

<div class="row">
    <div class="col-md-4">
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                      <div class="d-flex justify-content-between">
                        <div class="d-flex flex-column">
                            <img src="https://techzaa.in/lahomes/admin/assets/images/properties/p-1.jpg" alt="" width="100%" id="card-image" class="featured_image img-thumbnail" >
                            
                            <h4 class="text-uppercase fw-bolder tx-6 mt-3 empty" id="card-name">Villa</h4>

                            <hr>
                            <h6 class="tx-9 ">Price : </h6>
                            <h4 class="fw-bolder tx-6 mt-1 price" id="card-price">Rp. 0</h4>

                            <div class="d-inline-flex mt-3">

                                <span class="badge bg-primary mx-1 bedroom"><i class="mdi mdi-bed-queen-outline"></i> <span id="card-bedroom"> 0 </span> Bedroom</span>

                                <span class="badge bg-primary mx-1 location"><i class="mdi mdi-map-marker-multiple"></i> <span id="card-location"> Denpasar, Bali </span>
                                </span>
                            </div>

                        </div>
                      </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <form action="{{ route('villa.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-uppercase fw-bolder tx-9 mb-4">Add Villa Photos</h6>
                            
                            <form action="/file-upload" class="dropzone" id="exampleDropzone"></form>
                        </div>
                    </div>
                </div>
                <div class="col-12 grid-margin">
                    <div class="card">
                        <div class="card-body">
                            <h6 class="text-uppercase fw-bolder tx-9">Villa Informations</h6>
                            <div class="row mt-4">
                                <div class="col-md-6">
                                    <label for="villa_name" class="form-label">Villa Name</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20 px-2 py-0">            
                                            <i class="mdi mdi-home-city-outline"></i>
                                        </span>

                                        <input type="text" id="villa_name" name="villa_name" class="form-control" placeholder="Input Villa Name">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="price" class="form-label">Price</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20 px-2 py-0">            
                                            <i class="mdi mdi-cash-multiple"></i>
                                        </span>
                                        <input type="text" class="form-control" id="price" name="price" placeholder="Masukkan jumlah uang" onkeyup="updateRupiah(event)">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="bedroom" class="form-label">Bedroom</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20 px-2 py-0">            
                                            <i class="mdi mdi-bed-queen-outline"></i>
                                        </span>

                                        <input type="number" id="bedroom" name="bedroom" class="form-control" placeholder="Input Bedroom">
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <label for="location" class="form-label">Sub Region</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20 px-2 py-0">            
                                            <i class="mdi mdi-map-marker-multiple"></i>
                                        </span>
                                        <input type="text" id="location" name="sub_region" class="form-control" placeholder="Input Sub Region">
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <label for="featured_image" class="form-label">Featured Image</label>
                                    <div class="input-group mb-3">
                                        <span class="input-group-text fs-20 px-2 py-0">            
                                            <i class="mdi mdi-image"></i>
                                        </span>
                                        <input class="form-control" type="file" id="featured_image" name="featured_image" onchange="previewImage()" accept="image/*">  
                                                                         
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 justify-content-end d-flex">
                            <button type="submit" class="btn btn-sm btn-primary mt-3 ">
                                <i class="mdi mdi-home-plus fs-5"></i> Add Villa
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
        </form>

    </div>
</div>

            {{-- <x-form name="sub_region" label="Sub Region" type="text"/> --}}
@endsection
@push('plugin-scripts')
  <script src="{{ asset('/admin/assets/plugins/dropzone/dropzone.min.js') }}"></script>
@endpush

@push('custom-scripts')
<script src="{{ asset('/admin/assets/js/dropzone.js') }}"></script>
  <script>
    function formatRupiah(angka) {
        var reverse = angka.toString().split('').reverse().join('');
        var ribuan = reverse.match(/\d{1,3}/g);
        var formatted = ribuan.join('.').split('').reverse().join('');
        return formatted;
    }
    function unformatRupiah(rupiah) {
        return rupiah.replace(/^Rp\.|\./g, '');
    }
    function updateRupiah(e) {
        let amount = e.target.value;
        amount = unformatRupiah(amount);
        amount = formatRupiah(amount);
        e.target.value = amount;
    }
</script>

<script>
    function previewImage() {
    const image = document.querySelector('#featured_image');
    const imgPreview = document.querySelector('.featured_image');
    
    if (!image.files || !image.files[0]) return;
    
    const reader = new FileReader();
    
    reader.onload = function(e) {
        const img = new Image();
        img.src = e.target.result;
        
        img.onload = function() {
            const canvas = document.createElement('canvas');
            const ctx = canvas.getContext('2d');
            const sourceAspect = img.width / img.height;
            const targetAspect = 3 / 2;
            
            let sourceX = 0, sourceY = 0, sourceWidth = img.width, sourceHeight = img.height;
            
            if (sourceAspect > targetAspect) {
                sourceWidth = img.height * targetAspect;
                sourceX = (img.width - sourceWidth) / 2;
            } else {
                sourceHeight = img.width / targetAspect;
                sourceY = (img.height - sourceHeight) / 2;
            }
        
            canvas.width = 500;
            canvas.height = 360;
            ctx.drawImage(
                img, 
                sourceX, sourceY, sourceWidth, sourceHeight,
                0, 0, canvas.width, canvas.height            
            );
            
            // Tampilkan hasilnya
            imgPreview.style.display = 'block';
            imgPreview.src = canvas.toDataURL('image/jpeg');
        }
    }
    
    reader.readAsDataURL(image.files[0]);
}
</script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Get all input elements
        const nameInput = document.getElementById('villa_name');
        const priceInput = document.getElementById('price');
        const bedroomInput = document.getElementById('bedroom');
        const locationInput = document.getElementById('location');

        // Get all card elements
        const cardName = document.getElementById('card-name');
        const cardPrice = document.getElementById('card-price');
        const cardBedroom = document.getElementById('card-bedroom');
        const cardLocation = document.getElementById('card-location');
        

        // Add event listeners for live update
        nameInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                cardName.textContent = this.value;
                cardName.classList.remove('empty');
            } else {
                cardName.textContent = 'Villa';
                cardName.classList.add('empty');
            }
        });
        
        priceInput.addEventListener('input', function() {

            if (this.value.replace(/\./g, '').trim() !== '') {
                const numericValue = Number(this.value.replace(/\./g, '').trim());
                cardPrice.textContent = 'Rp' + numericValue.toLocaleString('id-ID');
            } else {
                cardPrice.textContent = '[Harga]';
            }
        });

        bedroomInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                cardBedroom.textContent = this.value;
                cardBedroom.classList.remove('bedroom');
            } else {
                cardBedroom.textContent = '0';
                cardBedroom.classList.add('bedroom');
            }
        });

        locationInput.addEventListener('input', function() {
            if (this.value.trim() !== '') {
                cardLocation.textContent = this.value;
                cardLocation.classList.remove('location');
            } else {
                cardLocation.textContent = 'Denpasar, Bali';
                cardLocation.classList.add('location');
            }
        });
        
    

    });
</script>
@endpush