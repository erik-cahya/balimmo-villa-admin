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

                         <x-form-select name="property_status" label="Choose Status Property" >
                              <option value="" selected disabled>Choose Status of Property</option>
                              <option value="avaliable">Avaliable</option>
                              <option value="rented">Rented</option>
                              <option value="sold">Sold</option>
                              <option value="under_construction">Under Construction</option>
                              <option value="under_contract">Under Contract</option>
                         </x-form-select>

                         <x-form-input type="text" name="curryear_builtent_owner" label="Year Built" placeholder="Input Year Built" />
                         <x-form-input type="text" name="current_owner" label="Current Owner" placeholder="Input Current Owner" />
                         <x-form-input type="text" name="owner_contact" label="Owner Contact" placeholder="Input Owner Contact" />

                         <x-form-select name="property_category" label="Property Category" >
                              <option value="" selected disabled>Choose Category of Property</option>
                              <option value="freehold">Freehold</option>
                              <option value="leasehold">Leasehold</option>
                         </x-form-select>

                         <x-form-input type="text" name="rent_price" label="Rent Price" placeholder="Input Rental Price" />
                         <x-form-input type="text" name="annual_fees" label="Annual Fees" placeholder="Input Annual Fees" />
                         <x-form-input type="text" name="estimated_rental_income" label="Estimated rental income (in a year)" placeholder="Input Estimated Rental Income" />

                    </div>

                         
               </div>
          </div>

          <div class="card">
               <div class="card-header">
                    <h4 class="card-title">Add Property Features</h4>
               </div>
               <div class="card-body">
                    <div class="row">
                         {{-- ##### Features ####### --}}
                         <x-form-input type="text" name="land_size" label="Land Size (m2)" placeholder="Input Land Size" />
                         <x-form-input type="text" name="living_area" label="Living Area (m2)" placeholder="Input Living Area" />
                         <x-form-input type="text" name="built_area" label="Built Area (m2)" placeholder="Input Built Area" />
                         <x-form-input type="text" name="number_of_floors" label="Number of Floors" placeholder="Input Number of Floors" />
                         <x-form-input type="text" name="garden_size" label="Garden Size" placeholder="Input Garden Size (m2)" />
                         <x-form-input type="text" name="number_floors_building" label="Number Floors in Building" placeholder="Input Number of Floors in Building" />
                         <x-form-input type="text" name="which_floor_apartement" label="Which floor the Appartement is on" placeholder="What floor is the apartment on ?" />
                         <x-form-input type="text" name="bedroom" label="Bedroom" placeholder="Enter the number of bedrooms" />
                         <x-form-input type="text" name="bathroom" label="bathroom" placeholder="Enter the number of bathrooms" />
                         <x-form-input type="text" name="vehicle_spaces" label="Vehicle Spaces" placeholder="Enter the vehicle spaces" />
                         <x-form-input type="text" name="kitchen_type" label="Kitchen Type" placeholder="Enter the kitchen type" />
                         <x-form-input type="text" name="roof_type" label="Roof Type" placeholder="Enter the roof type" />
                         <x-form-input type="text" name="soil_type" label="Soil Type" placeholder="Enter the soil type" />
                         <x-form-input type="text" name="topography" label="Topography" placeholder="Enter the topography" />
                         <x-form-input type="text" name="access" label="Access" placeholder="Enter the properties access" />
                         <x-form-input type="text" name="land_type" label="Land Type" placeholder="Input Land Type" />
                         <x-form-input type="text" name="swimming_pool" label="Swimming Pool" placeholder="Input Swimming Pool" />
                         <x-form-input type="text" name="pool_size" label="Pool Size (m2)" placeholder="Input Swimming Pool Size" />
                         <x-form-input type="text" name="pool_depth" label="Pool Size (m)" placeholder="Input Swimming Pool Depth" />
                         <x-form-input type="text" name="heated_pool" label="Heated Pool" placeholder="Input Pool Heated" />

                         <x-form-select name="private_graden" label="Choose Private Garden" ></x-form-select>
                         <x-form-input type="text" name="private_garden_size" label="Private Garden Size (m2)" />
                         
                         <x-form-select name="barbecue_area" label="Barbecue Area"></x-form-select>

                         <x-form-select name="gazebo" label="Gazebo/Bale Bengong"></x-form-select>
                         <x-form-input type="text" name="gazebo_size" label="Gazebo/Bale Bengong Size (m2)" />

                         <x-form-select name="rooftop_terrace" label="Rooftop/Terrace"></x-form-select>
                         <x-form-input type="text" name="rooftop_terrace_size" label="Rooftop/Terrace Size" />
                         
                         <x-form-select name="air_conditioning" label="Air Conditioning"></x-form-select>
                         <x-form-input type="text" name="number_air_conditioning" label="Number of Units" placeholder="Input Number Unit AC" />
                         
                         <x-form-select name="ceiling_fans" label="Ceiling Fans"></x-form-select>

                         <x-form-select name="water_heater" label="Water Heater"></x-form-select>
                         <x-form-input type="text" name="water_heater_type" label="Water Heater Type" />
                         
                         <x-form-input type="text" name="electrical_power_watt" label="Electrical Power Watt" />

                         <x-form-select name="internet" label="Internet/Wi-Fi"></x-form-select>
                         <x-form-input type="text" name="type_of_connection" label="Speed Connection (mbps)" />

                         <x-form-multiple-select name="security" label="Security">
                              <option value="alarm_system">Alarm System</option>
                              <option value="cctv">CCTV</option>
                              <option value="security_guard">Security Guard</option>
                         </x-form-multiple-select>

                         <x-form-select name="backup_generator" label="Backup Generator"></x-form-select>

                         <x-form-select name="water_reservoir" label="Water Reservoir"></x-form-select>
                         <x-form-input type="text" name="water_reservoir_capacity" label="Water Reservoir Capacity (Liter)" />
                         
                         <x-form-select name="water_filtration_system" label="Water Filtration System"></x-form-select>
                         
                         <x-form-select name="furnished" label="Furnished"></x-form-select>

                         <x-form-multiple-select name="fully_equipped_kitchen" label="Fully equipped kitchen">
                              <option value="dishwasher">Dishwasher</option>
                              <option value="oven">Oven</option>
                              <option value="stove">Stove</option>
                         </x-form-multiple-select>

                         <x-form-multiple-select name="laundry" label="Fully equipped kitchen">
                              <option value="dryer">Dryer</option>
                              <option value="washing_machine">Washing Machine</option>
                         </x-form-multiple-select>

                         <x-form-select name="private_gym" label="Private Gym"></x-form-select>
                         <x-form-select name="private_cinema" label="Private Cinema"></x-form-select>

                         <x-form-multiple-select name="features" label="Properties Features">
                              <option value="backup_generator">Backup Generator</option>
                              <option value="bbq_area">BBQ Area</option>
                              <option value="cinema_room">Cinema Room</option>
                              <option value="filtration">Filtration</option>
                              <option value="gazebo">Gazebo</option>
                              <option value="private_gym">Private Gym</option>
                              <option value="rooftop">Rooftop</option>
                              <option value="terrace">Terrace</option>
                              <option value="water_storage">Water Storage</option>
                         </x-form-multiple-select>

                         <x-form-multiple-select name="properties_view" label="Properties Views">
                              <option value="jungle">Jungle</option>
                              <option value="mountain">Mountain</option>
                              <option value="sky_city">Sky City</option>
                              <option value="sea">Sea</option>
                              <option value="rice_fields">Rice Fields</option>
                         </x-form-multiple-select>

                         <x-form-select name="main_road_access" label="Main Road Access"></x-form-select>
                         <x-form-input type="text" name="road_width" label="Road Width"/>

                         {{-- ########################### Proximity to key Points --}}
                         <div class="col-lg-6 mb-3">
                              <label for="" class="form-label mb-2">Proximity to key Points</label>

                              <div class="btn-group d-flex justify-content-start align-items-center" role="group" aria-label="Basic checkbox toggle button group">

                                   <div class="me-2">
                                        <input class="form-check-input me-1" type="checkbox" value="beach" name="beach" id="beach">
                                        <label class="form-check-label" for="beach">Beach</label>
                                   </div>

                                   <div class="me-2">
                                        <input class="form-check-input me-1" type="checkbox" value="restaurants" name="restaurants" id="restaurants">
                                        <label class="form-check-label" for="restaurants">Restaurants</label>
                                   </div>

                                   <div class="me-2">
                                        <input class="form-check-input me-1" type="checkbox" value="schools" name="schools" id="schools">
                                        <label class="form-check-label" for="schools">Schools</label>
                                   </div>

                                   <div class="me-2">
                                        <input class="form-check-input me-1" type="checkbox" value="shops" name="shops" id="shops">
                                        <label class="form-check-label" for="shops">Shops</label>
                                   </div>
                              </div>
                         </div>

                         <x-form-input type="text" name="distance_beach" label="Distance time Beach" placeholder="Input Distance in Minutes"/>
                         <x-form-input type="text" name="distance_restaurants" label="Distance time restaurants" placeholder="Input Distance in Minutes"/>
                         <x-form-input type="text" name="distance_school" label="Distance time school" placeholder="Input Distance in Minutes"/>
                         <x-form-input type="text" name="distance_shops" label="Distance time shops" placeholder="Input Distance in Minutes"/>

                         <x-form-select name="secure_neighborhood" label="Secured Neighborhood"></x-form-select>
                         <x-form-select name="secure_neighborhood_type" label="Secured Neighborhood Type">
                              <option value="security_post">Security Post</option>
                              <option value="gated_community">Gated Community</option>
                         </x-form-select>

                         <x-form-select name="on_site_service" label="On-site Service"></x-form-select>

                         {{-- <x-form-multiple-select name="on_site_service_type" label="On-site Service Type">
                              <option value="maintenance">Maintenance</option>
                              <option value="reception">Reception</option>
                              <option value="security">Security</option>
                         </x-form-multiple-select> --}}

                         {{-- ########################### On-site Service Type --}}
                         <div class="col-lg-6 mb-3" id="group_on_site_service_type">
                              <label for="" class="form-label mb-2">On-site Service Type</label>

                              <div class="btn-group d-flex justify-content-start align-items-center" role="group" aria-label="Basic checkbox toggle button group">

                                   <div class="me-2">
                                        <input class="form-check-input me-1" type="checkbox" value="maintenace" name="maintenace" id="maintenace">
                                        <label class="form-check-label" for="maintenace">Maintenace</label>
                                   </div>

                                   <div class="me-2">
                                        <input class="form-check-input me-1" type="checkbox" value="reception" name="reception" id="reception">
                                        <label class="form-check-label" for="reception">Reception</label>
                                   </div>

                                   <div class="me-2">
                                        <input class="form-check-input me-1" type="checkbox" value="security" name="security" id="security">
                                        <label class="form-check-label" for="security">Security</label>
                                   </div>
                              </div>
                         </div>

                         <x-form-select name="current_usage" label="Current Usage">
                              <option value="owner_occupied">Owner Occupied</option>
                              <option value="rented">Rented</option>
                              <option value="vacant_land">Vacant Land</option>
                         </x-form-select>

                         <x-form-select name="rental_history" label="Rental History"></x-form-select>
                         <x-form-input type="text" name="last_year_income" label="Last Year Income"/>

                         <x-form-input type="text" name="estimated_occupancy_rate" label="Estimated Occupancy Rate" placeholder="In Percent (Ex: 10%)"/>
                         <x-form-input type="text" name="return_on_investment" label="ROI (Return on Investment) Potential" placeholder="Percentage per year (Ex: 12%)"/>
                         
                         <x-form-select name="shared_facilities" label="Shared Facilities">
                              <option value="">No</option>
                              <option value="pool">Pool</option>
                         </x-form-select>

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
               $('#group_secure_neighborhood_type').hide();
               $('#group_on_site_service_type').hide();
               $('#group_last_year_income').hide();

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

                    if (value === 'appartement') {
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

               $('#secure_neighborhood').on('change', function() {
                    var value = $(this).val();
                    console.log(value);

                    if (value === 'yes') {
                         $('#group_secure_neighborhood_type').show();
                         
                    } 
                    else {
                         $('#group_secure_neighborhood_type').hide();
                    }
               });

               $('#on_site_service').on('change', function() {
                    var value = $(this).val();
                    console.log(value);

                    if (value === 'yes') {
                         $('#group_on_site_service_type').show();
                         
                    } 
                    else {
                         $('#group_on_site_service_type').hide();
                    }
               });

               $('#rental_history').on('change', function() {
                    var value = $(this).val();
                    console.log(value);

                    if (value === 'yes') {
                         $('#group_last_year_income').show();
                         
                    } 
                    else {
                         $('#group_last_year_income').hide();
                    }
               });
          });

     </script>

     <script>
          $(document).ready(function() {
               $('#security').select2({
                    placeholder: 'Select an option'
               });
               $('#fully_equipped_kitchen').select2({
                    placeholder: 'Select an option'
               });
               $('#laundry').select2({
                    placeholder: 'Select an option'
               });
               $('#features').select2({
                    placeholder: 'Select an option'
               });
               $('#properties_view').select2({
                    placeholder: 'Select an option'
               });
               $('#on_site_service_type').select2({
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
