@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

    <!-- ========== Page Title Start ========== -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Add Property</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                    <li class="breadcrumb-item active">Add Property</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ========== Page Title End ========== -->

    <div class="row">
         <div class="col-xl-3 col-lg-4">
              <div class="card">
                   <div class="card-body">
                        <div class="position-relative">
                             <img src="{{ asset('admin') }}/assets/images/properties/p-1.jpg" alt="" class="img-fluid rounded bg-light">
                             <span class="position-absolute top-0 end-0 p-1">
                                  <span class="badge bg-success text-light fs-13">For Rent</span>
                             </span>
                        </div>
                        <div class="mt-3">
                             <h4 class="mb-1">Dvilla Residences Batu<span class="fs-14 text-muted ms-1">(Residences)</span></h4>
                             <p  class="mb-1">4604 , Philli Lane Kiowa U.S.A</p>
                             <h5 class="text-dark fw-medium mt-3">Price :</h5>
                             <h4 class="fw-semibold mt-2 text-muted">$8,930.00</h4>
                        </div>
                        <div class="row mt-2 g-2">
                             <div class="col-lg-3 col-3">
                                  <span class="badge bg-light-subtle text-muted border fs-12">
                                       <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>
                                       5 Beds
                                  </span>
                             </div>
                             <div class="col-lg-3 col-3">
                                  <span class="badge bg-light-subtle text-muted border fs-12">
                                       <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>
                                       4 Bath
                                  </span>
                             </div>
                             <div class="col-lg-3 col-3">
                                  <span class="badge bg-light-subtle text-muted border fs-12">
                                       <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>
                                       1400ft
                                  </span>
                             </div>
                             <div class="col-lg-3 col-3">
                                  <span class="badge bg-light-subtle text-muted border fs-12">
                                       <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>
                                       3 Floor
                                  </span>
                             </div>
                        </div>
                   </div>
                   <div class="card-footer bg-light-subtle">
                        <div class="row g-2">
                             <div class="col-lg-6">
                                  <a href="#!" class="btn btn-outline-primary w-100">Add Property</a>
                             </div>
                             <div class="col-lg-6">
                                  <a href="#!" class="btn btn-danger w-100">Cancel</a>
                             </div>
                        </div>
                   </div>

              </div>
         </div>

         <div class="col-xl-9 col-lg-8 ">
              <div class="card">
                   <div class="card-header">
                        <h4 class="card-title">Add Property Photo</h4>
                   </div>
                   <div class="card-body">
                        <form action="/" method="post" class="dropzone bg-light-subtle py-5" id="myAwesomeDropzone" data-plugin="dropzone" data-previews-container="#file-previews" data-upload-preview-template="#uploadPreviewTemplate">
                             <div class="fallback">
                                  <input name="file" type="file" multiple="multiple">
                             </div>
                             <div class="dz-message needsclick">
                                  <i class="ri-upload-cloud-2-line fs-48 text-primary"></i>
                                  <h3 class="mt-4">Drop your images here, or <span class="text-primary">click to browse</span></h3>
                                  <span class="text-muted fs-13">
                                       1600 x 1200 (4:3) recommended. PNG, JPG and GIF files are allowed
                                  </span>
                             </div>
                        </form>
                   </div>
              </div>
              <div class="card">
                   <div class="card-header">
                        <h4 class="card-title">Property Information</h4>
                   </div>
                   <div class="card-body">
                        <div class="row">

                              @foreach ($features as $ftr)
                                        @if ($ftr->input_type == 'text')

                                             <div class="col-lg-6 my-2" id="group_{{ $ftr->id }}">
                                                  <label for="property-categories" class="form-label">{{ $ftr->name }}</label>
                                                  <input type="text" id="input_text" class="form-control" placeholder="Input {{ $ftr->name }}">
                                             </div>

                                        @elseif ($ftr->input_type == 'select')
                                        
                                             <div class="col-lg-6 my-2" id="group_{{ $ftr->id }}">
                                                  <label for="property-categories" class="form-label">{{ $ftr->name }}</label>
                                                  <select class="form-control" id="{{ strtolower(str_replace(' ', '_', $ftr->name )) }}" data-choices data-choices-groups data-placeholder="Select Categories" name="choices-single-groups">
                                                       @foreach (json_decode($ftr->options) as $option )
                                                            <option value="{{ $option }}">{{ $option }}</option>
                                                       @endforeach
                                                  </select>
                                             </div>
                                        @endif
                              @endforeach
                               
                        </div>
                   </div>
              </div>

              <div class="mb-3 rounded">
                   <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                             <a href="#!" class="btn btn-outline-primary w-100">Create Product</a>
                        </div>
                        <div class="col-lg-2">
                             <a href="#!" class="btn btn-danger w-100">Cancel</a>
                        </div>
                   </div>
              </div>
         </div>
    </div>

</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

     <script>
          // Pakai jQuery supaya gampang
          $(document).ready(function() {
               $('#swimming_pool').on('change', function() {
                    var value = $(this).val();
                    if (value === 'Yes') {
                         $('#group_4').show();
                    } else {
                         $('#group_4').hide();
                         $('#group_4').val(''); // Optional: reset value saat No
                    }
               });
          });
     </script>
@endpush
