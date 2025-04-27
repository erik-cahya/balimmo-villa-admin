@extends('admin.layouts.master')
@push('style')

    <!-- Link ke CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
          /* Menyesuaikan lebar select2 dengan form-control Bootstrap */
          .select2-container--default .select2-selection--single {
          height: calc(2.25rem + 2px); /* Sesuaikan dengan tinggi input form Bootstrap */
          padding: 1px 1px !important;  /* Padding untuk kesesuaian dengan form-control */
          border: 1px solid #eaedf1;  /* Border yang sesuai dengan form-control Bootstrap */
          border-radius: 0.375rem;    /* Border radius yang sesuai dengan Bootstrap */
          font-size: 14px;            /* Ukuran font yang sesuai */
          }

          .select2-search__field{
               border: 1px solid #eaedf1!important;
               border-radius: 0.35rem;
               margin: 6px 0px;
          }

          /* Menyesuaikan dropdown Select2 */
          .select2-container--default .select2-results__option {
               /* Padding di dalam dropdown */
          padding: 0.25rem 1.25rem; 
          font-size: 14px;           /* Ukuran font */
          }

          /* Menyesuaikan tampilan Select2 ketika dropdown dibuka */
          .select2-container--default .select2-selection--single:focus {
          /* border-color: #80bdff; Warna border saat focus */
          outline: none;
          }

          /* Menyesuaikan dropdown dengan tema Bootstrap */
          .select2-container--default .select2-dropdown {
          border: 1px solid #ced4da; /* Border dropdown sesuai form-control */
          border-radius: 0.375rem;    /* Sesuaikan dengan border-radius Bootstrap */
          }

          /* Untuk memastikan ada ruang pada dropdown Select2 agar lebih rapi */
          .select2-container--default .select2-selection--single .select2-selection__rendered {
               padding: 0.375rem 0.75rem; /* Padding yang konsisten dengan input form */
               color: #687D92 !important;
          }

          .select2-selection--multiple{
               /* padding: 0.375rem 0.75rem; Padding yang konsisten dengan input form */
               /* color: red !important; */
               border: 1px solid #ced4da!important;
               border-radius: 0.35rem!important;
               padding: 0px!important;
          }
          /* .select2-search__field--multiple{
               margin: 0px!important;
               padding: 18px 10px!important;
          } */
           .select2-search__field{
               /* background-color: red!important; */
               border: 0px!important;
           }

          .select2-selection__placeholder{
               color: #687D92 !important;
          }
    </style>

@endpush
@section('content')
<form action="{{ route('properties.store') }}" method="POST">
     @csrf
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
                              <div class="col-lg-4 col-3">
                                   <span class="badge bg-light-subtle text-muted border fs-12">
                                        <span class="fs-16"><iconify-icon icon="solar:bed-broken" class="align-middle"></iconify-icon></span>
                                        5 Beds
                                   </span>
                              </div>
                              <div class="col-lg-4 col-3">
                                   <span class="badge bg-light-subtle text-muted border fs-12">
                                        <span class="fs-16"><iconify-icon icon="solar:bath-broken" class="align-middle"></iconify-icon></span>
                                        4 Bath
                                   </span>
                              </div>
                              <div class="col-lg-4 col-3">
                                   <span class="badge bg-light-subtle text-muted border fs-12">
                                        <span class="fs-16"><iconify-icon icon="solar:scale-broken" class="align-middle"></iconify-icon></span>
                                        1400ft
                                   </span>
                              </div>
                              <div class="col-lg-4 col-3">
                                   <span class="badge bg-light-subtle text-muted border fs-12">
                                        <span class="fs-16"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="align-middle"></iconify-icon></span>
                                        3 Floor
                                   </span>
                              </div>
                         </div>
                    </div>
                    <div class="card-footer bg-light-subtle">
                         <div class="row">
                              <div class="col-lg-12">
                                   <a href="#!" class="btn btn-primary w-100">Add Property</a>
                              </div>
                         </div>
                    </div>

               </div>
          </div>

          <div class="col-xl-9 col-lg-8 ">
          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Property Information</h4>
               </div>
               <div class="card-body">
                    <div class="row">

                         {{-- ##### Main Data Villa ####### --}}

                         <div class="col-lg-6 mb-3" id="group_property_name">
                              <label for="property_name" class="form-label">Properties Name</label>
                              <input type="text" id="property_name" name="property_name" class="form-control" placeholder="Input Name Properties">
                         </div>

                         <div class="col-lg-6 mb-3" id="group_property_type">
                              <label for="property_type" class="form-label">Property Type</label>
                              <select class="form-control" id="property_type" name="property_type" data-choices data-choices-groups data-placeholder="Select Country">
                                   <option value="">Choose Type of Property</option>
                                   <optgroup label="">
                                        <option value="appartement">Appartement</option>
                                        <option value="terrain">Terrain</option>
                                        <option value="villa">Villa</option>
                                        <option value="villa-complex">Villa Complex</option>
                                   </optgroup>
                              </select>
                         </div>

                         <div class="col-lg-6 mb-3" id="group_region">
                              <label for="region" class="form-label">Region</label>
                              
                              <select class="form-control" id="region" name="region" data-placeholder="Select Categories">
                                   <option value="">Choose Region Properties</option>                                                                                                           
                              </select>
                         </div>

                         <div class="col-lg-6 mb-3" id="group_subregion">
                              <label for="subregion" class="form-label">Sub Region</label>
                              <select class="form-control" id="subregion" name="subregion" data-placeholder="Select Country" >
                                   <option value="">Choose Sub Region Property</option>
                              </select>
                         </div>

                         <div class="col-lg-12 mb-3" id="group_property_address">
                              <label for="property_address" class="form-label">Property Address</label>
                              <textarea class="form-control" id="property_address" name="property_address" rows="3" placeholder="Enter address"></textarea>
                         </div>

                         <div class="col-lg-6 mb-3" id="group_internal_reference">
                              <label for="internal_reference" class="form-label">Internal Reference</label>
                              <input type="text" class="form-control" placeholder="Internal Reference" disabled value="{{ Auth::user()->name }}">
                              <input type="hidden" id="internal_reference" name="internal_reference" class="form-control" placeholder="Internal Reference" readonly value="{{ Auth::user()->name }}">
                         </div>

                         <div class="col-lg-6" id="group_property_status">
                              <label for="property_status" class="form-label">Property Status</label>
                              <select class="form-control" id="property_status" name="property_status" data-choices data-choices-groups data-placeholder="Select Country">
                                   <option value="" selected disabled>Choose Status of Property</option>
                                   <option value="avaliable">Avaliable</option>
                                   <option value="rented">Rented</option>
                                   <option value="sold">Sold</option>
                                   <option value="under_construction">Under Construction</option>
                                   <option value="under_contract">Under Contract</option>
                              </select>
                         </div>

                         <div class="col-lg-6 mb-3" id="group_year_built">
                              <label for="year_built" class="form-label">Year Built</label>
                              <input type="text" id="year_built" name="year_built" class="form-control" placeholder="Internal Reference">
                         </div>

                         <div class="col-lg-6 mb-3" id="group_current_owner">
                              <label for="current_owner" class="form-label">Current Owner</label>
                              <input type="text" id="current_owner" name="current_owner" class="form-control" placeholder="Internal Reference">
                         </div>
                         <div class="col-lg-6 mb-3" id="group_owner_contact">
                              <label for="owner_contact" class="form-label">Owner Contact</label>
                              <input type="text" id="owner_contact" name="owner_contact" class="form-control" placeholder="Internal Reference">
                         </div>

                         <div class="col-lg-6" id="group_property_category">
                              <label for="property_category" class="form-label">Property Category</label>
                              <select class="form-control" id="property_category" name="property_category" data-choices data-choices-groups data-placeholder="Select Country">
                                   <option value="" selected disabled>Choose Category of Property</option>
                                   <option value="freehold">Freehold</option>
                                   <option value="leasehold">Leasehold</option>
                              </select>
                         </div>
                    
                         <div class="col-lg-6 mb-3" id="group_rent_price">
                              <label for="rent_price" class="form-label">Rent Price</label>
                              <input type="text" id="rent_price" name="rent_price" class="form-control" placeholder="Internal Reference">
                         </div>

                         <div class="col-lg-6 mb-3" id="group_annual_fees">
                              <label for="annual_fees" class="form-label">Annual Fees</label>
                              <input type="text" id="annual_fees" name="annual_fees" class="form-control" placeholder="Internal Reference">
                         </div>

                         <div class="col-lg-6 mb-3" id="group_estimated_rental_income">
                              <label for="estimated_rental_income" class="form-label">Estimated rental income (in a year)</label>
                              <input type="text" id="estimated_rental_income" name="estimated_rental_income" class="form-control" placeholder="Internal Reference">
                         </div>

                         {{-- <div class="col-lg-6" id="group_security">
                              <label for="security" class="form-label">Security</label>
                              <select class="form-control" id="security" name="security[]" multiple="multiple">
                                   <option value="Alarm System">Alarm System</option>
                                   <option value="CCTV">CCTV</option>
                                   <option value="Security Guard">Security Guard</option>
                              </select>
                         </div> --}}

                         <x-form-select name="security" label="Security">
                              <option value="Alarm System">Alarm System</option>
                              <option value="CCTV">CCTV</option>
                              <option value="Security Guard">Security Guard</option>
                         </x-form-select>

                         <hr>
                         {{-- ##### Features ####### --}}

                         <x-form-input type="text" name="land_size" label="Land Size (m2)" placeholder="Input Land Size" />
                         <x-form-input type="text" name="living_area" label="Living Area (m2)" placeholder="Input Living Area" />
                         <x-form-input type="text" name="built_area" label="Built Area (m2)" placeholder="Input Built Area" />
                         <x-form-input type="text" name="number_of_floors" label="Number of Floors" placeholder="Input Number of Floors" />


                    </div>

                         
               </div>
          </div>

          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Add Property Document</h4>
               </div>
               <div class="card-body">
               <div class="col-lg-12 mb-3">
                         <label for="security" class="form-label">Gallery</label>
                         <div class="dropzone" id="gallery-dropzone"></div>
               </div>

               <div class="col-lg-12 mb-3">
                         <label for="security" class="form-label">Property Plan</label>
                         <input type="file" id="property-bedroom" class="form-control" placeholder="">
               </div>

                    <div class="col-lg-12 mb-3">
                         <label for="security" class="form-label">Ownership Certificate</label>
                         <input type="file" id="property-bedroom" class="form-control" placeholder="">
                    </div>

                    <div class="col-lg-12 mb-3">
                         <label for="security" class="form-label">Monthly Charges</label>
                         <input type="file" id="property-bedroom" class="form-control" placeholder="">
                    </div>
               </div>
          </div>

          
          <div class="mb-3 rounded">
               <div class="row justify-content-end g-2">
                    <div class="col-lg-2">
                         <button type="submit" class="btn btn-outline-primary w-100">Create Product</button>
                    </div>
                    <div class="col-lg-2">
                         <a href="#!" class="btn btn-danger w-100">Cancel</a>
                    </div>
               </div>
          </div>
     </div>

     </div>
</form>
@endsection
@push('scripts')

     <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>




     <script>
          $(document).ready(function() {
               // Swimming Pool Toggle
               $('#swimming_pool').on('change', function() {
                    var value = $(this).val();
                    if (value === 'Yes') {
                         $('#group_4').show();
                    } else {
                         $('#group_4').hide();
                    }
               });

               // Property Type Toggle
               $('#property_type').on('change', function() {
                    var value = $(this).val();
                    console.log(value);
                    if (value === 'terrain') {
                         $('#group_year_built').hide();
                         $('#group_property_status').show();
                         
                    } 
                    else if(value === 'villa') {
                         $('#group_property_status').hide();
                         $('#group_year_built').show();
                    }
                    else {
                         $('#group_year_built').show();
                         $('#group_property_status').show();
                    }
               });
          });

     </script>

     <script>
          $(document).ready(function() {
               $('#security').select2({
                    placeholder: 'Select an option'
               });
          });
     </script>

     <script>
          $(document).ready(function() {
          // Inisialisasi Select2 untuk Region dan Subregion
          $('#region').select2({
               placeholder: "Pilih Region",
               allowClear: true
          });
          
          $('#subregion').select2({
               placeholder: "Pilih Subregion",
               allowClear: true
          });
          
          // Fetch data JSON dari file regions.json yang ada di public
          $.getJSON("{{ asset('/admin/data/regions.json') }}", function(regionsData) {
               // Menambahkan Region ke Select2
               for (const region in regionsData) {
                    const option = new Option(region.charAt(0).toUpperCase() + region.slice(1), region);
                    $('#region').append(option);
               }
          
               // Event listener ketika Region dipilih
               $('#region').on('change', function() {
                    const selectedRegion = $(this).val();
                    const subregionSelect = $('#subregion');
          
                    subregionSelect.empty(); // Kosongkan pilihan Subregion sebelumnya
                    subregionSelect.append(new Option('-- Pilih Subregion --', ''));
          
                    if (selectedRegion && regionsData[selectedRegion]) {
                         regionsData[selectedRegion].forEach(function(subregion) {
                              const option = new Option(subregion, subregion.toLowerCase().replace(/\s+/g, '-'));
                              subregionSelect.append(option);
                         });
                    }
          
                    // Update Select2 setelah append
                    subregionSelect.trigger('change');
               });
          });
          });
     </script>
@endpush
