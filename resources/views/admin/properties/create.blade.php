@extends('admin.layouts.master')
@push('style')

    <!-- Link ke CSS Select2 -->
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />

    <style>
        .validation-form{
            border-color: #e96767!important;
        }

        .validation-message{
          top: 100%;
          z-index: 5;
          max-width: 100%;
          padding: .3125rem .625rem;
          font-size: .7875rem;
          color: #fff;
          background-color: var(--bs-danger);
          border-radius: var(--bs-border-radius);
        }

        .choices{
          margin-bottom: 0px;
        }

        #lease_duration_group{
          display: none!important;
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

          <div class="col-xl-6 col-lg-6 ">
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Property Information</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              {{-- ##### Main Data Villa ####### --}}

                              <x-form-input className="col-lg-12" type="text" name="property_name" label="Properties Name"/>

                              <div class="col-lg-12 mb-3" id="group_property_address">
                                   <label for="property_address" class="form-label">Description</label>
                                   <textarea class="form-control" id="property_address" name="property_address" rows="3" placeholder="Enter address"></textarea>
                              </div>

                              <div class="col-lg-6 mb-3" id="group_region">
                                   <label for="region" class="form-label">Region</label>
                                   <select id="region" class="form-select" name="region">
                                        <option value="" selected disabled>Select Region</option>
                                   </select>
                              </div>

                              <div class="col-lg-6 mb-3" id="group_region">
                                   <label for="region" class="form-label">Sub Region</label>
                                   <select id="subregion" class="form-select" name="subregion">
                                        <option value="" selected disabled>Select Region First </option>
                                   </select>
                              </div>

                              <div class="col-lg-12 mb-3" id="group_property_address">
                                   <label for="property_address" class="form-label">Property Address</label>
                                   <textarea class="form-control" id="property_address" name="property_address" rows="3" placeholder="Enter address"></textarea>
                              </div>

                              <x-form-select className="col-lg-6" name="property_type" label="Property Type" >
                                   <option value="" selected disabled>Choose Type of Property</option>
                                   <option value="appartement">Appartement</option>
                                   <option value="terrain">Terrain</option>
                                   <option value="villa">Villa</option>
                                   <option value="villa-complex">Villa Complex</option>
                              </x-form-select>

                              <x-form-select className="col-lg-6" name="property_status" label="Choose Status Property" >
                                   <option value="" selected disabled>Choose Status of Property</option>
                                   <option value="avaliable">Avaliable</option>
                                   <option value="rented">Rented</option>
                                   <option value="sold">Sold</option>
                                   <option value="under_construction">Under Construction</option>
                                   <option value="under_contract">Under Contract</option>
                              </x-form-select>

                              <div class="col-lg-6 mb-3" id="group_internal_reference">
                                   <label for="internal_reference" class="form-label">Internal Reference</label>
                                   <input type="text" class="form-control" placeholder="Internal Reference" disabled value="{{ Auth::user()->name }}">
                                   <input type="hidden" id="internal_reference" name="internal_reference" class="form-control" placeholder="Internal Reference" readonly value="{{ Auth::user()->name }}">
                              </div>

                              <x-form-input className="col-lg-6" type="text" name="year_built" label="Year Built" placeholder="Input Year Built" />
                              <x-form-input className="col-lg-6" type="text" name="current_owner" label="Current Owner" placeholder="Input Current Owner" />
                              <x-form-input className="col-lg-6" type="text" name="owner_contact" label="Owner Contact" placeholder="Input Owner Contact" />
                         </div>


                    </div>
               </div>

          </div>

          <div class="col-xl-6 col-lg-6 ">
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Legal & Finance Information</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              {{-- ##### Legal & Finance Form ####### --}}

                              <x-form-select className="col-lg-12" name="property_category" label="Property Category" >
                                   <option value="" selected disabled>Choose Category of Property</option>
                                   <option value="leasehold">Leasehold</option>
                                   <option value="freehold">Freehold</option>
                              </x-form-select>

                              {{-- <x-form-select className="col-lg-6" name="private_garden" label="Choose Private Garden" ></x-form-select> --}}

                            <div id="lease_duration_group" class="">
                                   <div class="d-flex">
                                        <x-form-input className="col-lg-6 pe-2" type="text" name="remaining_duration_lease" placeholder="Remaining Lease Duration" label="Remaining Lease Duration (Years)"/>
                                        <x-form-input className="col-lg-6 pe-2" type="text" name="total_duration_lease" placeholder="Total Lease Duration" label="Total Lease Duration (Years)"/>
                                   </div>

                                   <div class="d-flex">

                                        <x-form-select className="col-lg-6 pe-2" name="extend_leasehold" label="Extends Leasehold" ></x-form-select>
                                        <x-form-input className="col-lg-6 pe-2" type="text" name="duration_extend_leashold" label="Maximum Extend Duration Leasehold (Years)"/>
                                    </div>
                            </div>

                         </div>


                    </div>
               </div>

               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Add Property Features</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">
                              {{-- ##### Features ####### --}}
                              <x-form-input className="col-lg-6" type="text" name="land_size" label="Land Size (m²)" placeholder="Input Land Size" />
                              <x-form-input className="col-lg-6" type="text" name="living_area" label="Living Area (m²)" placeholder="Input Living Area" />
                              <x-form-input className="col-lg-6" type="text" name="built_area" label="Built Area (m²)" placeholder="Input Built Area" />
                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Number of Floors" placeholder="Input Number of Floors" />
                              <x-form-input className="col-lg-6" type="text" name="garden_size" label="Garden Size" placeholder="Input Garden Size (m²)" />
                              <x-form-input className="col-lg-6" type="text" name="number_floors_building" label="Number Floors in Building" placeholder="Input Number of Floors in Building" />
                              <x-form-input className="col-lg-6" type="text" name="which_floor_apartement" label="Which floor the Appartement is on" placeholder="What floor is the apartment on ?" />
                              <x-form-input className="col-lg-6" type="text" name="bedroom" label="Bedroom" placeholder="Enter the number of bedrooms" />
                              <x-form-input className="col-lg-6" type="text" name="bathroom" label="Bathroom" placeholder="Enter the number of bathrooms" />
                              <x-form-input className="col-lg-6" type="text" name="vehicle_spaces" label="Vehicle Spaces" placeholder="Enter the vehicle spaces" />

                              <x-form-select className="col-lg-6" name="kitchen_type" label="Kitchen Type" placeholder="Enter the kitchen type">
                                   <option value="" selected disabled>Choose Type of Kitchen</option>
                                   <option value="Closed Kitchen">Closed Kitchen</option>
                                   <option value="Open Kitchen">Open Kitchen</option>
                              </x-form-select>

                              <x-form-input className="col-lg-6" type="text" name="roof_type" label="Roof Type" placeholder="Enter the roof type" />
                              <x-form-input className="col-lg-6" type="text" name="soil_type" label="Soil Type" placeholder="Enter the soil type" />
                              <x-form-input className="col-lg-6" type="text" name="topography" label="Topography" placeholder="Enter the topography" />
                              <x-form-input className="col-lg-6" type="text" name="access" label="Access" placeholder="Enter the properties access" />
                              <x-form-input className="col-lg-6" type="text" name="land_type" label="Land Type" placeholder="Input Land Type" />
                              <x-form-input className="col-lg-6" type="text" name="swimming_pool" label="Swimming Pool" placeholder="Input Swimming Pool" />
                              <x-form-input className="col-lg-6" type="text" name="pool_size" label="Pool Size (m²)" placeholder="Input Swimming Pool Size" />
                              <x-form-input className="col-lg-6" type="text" name="pool_depth" label="Pool Size (m)" placeholder="Input Swimming Pool Depth" />
                              <x-form-input className="col-lg-6" type="text" name="heated_pool" label="Heated Pool" placeholder="Input Pool Heated" />

                              <x-form-select className="col-lg-6" name="private_garden" label="Choose Private Garden" ></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="private_garden_size" label="Private Garden Size (m²)" />

                              <x-form-select className="col-lg-6" name="barbecue_area" label="Barbecue Area"></x-form-select>

                              <x-form-select className="col-lg-6" name="gazebo" label="Gazebo/Bale Bengong"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="gazebo_size" label="Gazebo/Bale Bengong Size (m²)" />

                              <x-form-select className="col-lg-6" name="rooftop_terrace" label="Rooftop/Terrace"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="rooftop_terrace_size" label="Rooftop/Terrace Size" />

                              <x-form-select className="col-lg-6" name="air_conditioning" label="Air Conditioning"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="number_air_conditioning" label="Number of Units" placeholder="Input Number Unit AC" />

                              <x-form-select className="col-lg-6" name="ceiling_fans" label="Ceiling Fans"></x-form-select>

                              <x-form-select className="col-lg-6" name="water_heater" label="Water Heater"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="water_heater_type" label="Water Heater Type" />

                              <x-form-input className="col-lg-6" type="text" name="electrical_power_watt" label="Electrical Power Watt" />

                              <x-form-select className="col-lg-6" name="internet" label="Internet/Wi-Fi"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="type_of_connection" label="Speed Connection (mbps)" />

                              <x-form-multiple-select name="security" label="Security">
                                   <option value="alarm_system">Alarm System</option>
                                   <option value="cctv">CCTV</option>
                                   <option value="security_guard">Security Guard</option>
                              </x-form-multiple-select>

                              <x-form-select className="col-lg-6" name="backup_generator" label="Backup Generator"></x-form-select>

                              <x-form-select className="col-lg-6" name="water_reservoir" label="Water Reservoir"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="water_reservoir_capacity" label="Water Reservoir Capacity (Liter)" />

                              <x-form-select className="col-lg-6" name="water_filtration_system" label="Water Filtration System"></x-form-select>

                              <x-form-select className="col-lg-6" name="furnished" label="Furnished"></x-form-select>

                              <x-form-multiple-select name="fully_equipped_kitchen" label="Fully equipped kitchen">
                                   <option value="dishwasher">Dishwasher</option>
                                   <option value="oven">Oven</option>
                                   <option value="stove">Stove</option>
                              </x-form-multiple-select>

                              <x-form-multiple-select name="laundry" label="Fully equipped kitchen">
                                   <option value="dryer">Dryer</option>
                                   <option value="washing_machine">Washing Machine</option>
                              </x-form-multiple-select>

                              <x-form-select className="col-lg-6" name="private_gym" label="Private Gym"></x-form-select>
                              <x-form-select className="col-lg-6" name="private_cinema" label="Private Cinema"></x-form-select>

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

                              <x-form-select className="col-lg-6" name="main_road_access" label="Main Road Access"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="road_width" label="Road Width"/>

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

                              <x-form-input className="col-lg-6" type="text" name="distance_beach" label="Distance time Beach" placeholder="Input Distance in Minutes"/>
                              <x-form-input className="col-lg-6" type="text" name="distance_restaurants" label="Distance time restaurants" placeholder="Input Distance in Minutes"/>
                              <x-form-input className="col-lg-6" type="text" name="distance_school" label="Distance time school" placeholder="Input Distance in Minutes"/>
                              <x-form-input className="col-lg-6" type="text" name="distance_shops" label="Distance time shops" placeholder="Input Distance in Minutes"/>

                              <x-form-select className="col-lg-6" name="secure_neighborhood" label="Secured Neighborhood"></x-form-select>
                              <x-form-select className="col-lg-6" name="secure_neighborhood_type" label="Secured Neighborhood Type">
                                   <option value="Security Post">Security Post</option>
                                   <option value="Gated Community">Gated Community</option>
                              </x-form-select>

                              <x-form-select className="col-lg-6" name="on_site_service" label="On-site Service"></x-form-select>

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

                              <x-form-select className="col-lg-6" name="current_usage" label="Current Usage">
                                   <option value="owner_occupied">Owner Occupied</option>
                                   <option value="rented">Rented</option>
                                   <option value="vacant_land">Vacant Land</option>
                              </x-form-select>

                              <x-form-select className="col-lg-6" name="rental_history" label="Rental History"></x-form-select>
                              <x-form-input className="col-lg-6" type="text" name="last_year_income" label="Last Year Income"/>

                              <x-form-input className="col-lg-6" type="text" name="estimated_occupancy_rate" label="Estimated Occupancy Rate" placeholder="In Percent (Ex: 10%)"/>
                              <x-form-input className="col-lg-6" type="text" name="return_on_investment" label="ROI (Return on Investment) Potential" placeholder="Percentage per year (Ex: 12%)"/>

                              <x-form-select className="col-lg-6" name="shared_facilities" label="Shared Facilities">
                                   <option value="">No</option>
                                   <option value="pool">Pool</option>
                              </x-form-select>



                         </div>
                    </div>
               </div>

               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
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

     <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
     <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/cleave.min.js"></script>
     <script src="https://cdn.jsdelivr.net/npm/cleave.js@1.6.0/dist/addons/cleave-phone.us.js"></script>

     {{-- Yes/No Toggle Script --}}
     <script>
          $(document).ready(function() {
               $('#group_secure_neighborhood_type').hide();
               $('#group_on_site_service_type').hide();
               $('#group_last_year_income').hide();
               $('#group_private_garden_size').hide();

               // Swimming Pool Toggle
               $('#swimming_pool').on('change', function() {
                    let value = $(this).val();
                    if (value === 'Yes') {
                         $('#group_4').show();
                    } else {
                         $('#group_4').hide();
                    }
               });

               // Property Type Toggle
               $('#property_type').on('change', function() {
                    let value = $(this).val();

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

               // Secure Neighborhood
               $('#secure_neighborhood').on('change', function() {
                    let value = $(this).val();

                    if (value === 'yes') {
                         $('#group_secure_neighborhood_type').show();

                    }
                    else {
                         $('#group_secure_neighborhood_type').hide();
                    }
               });

               // Om Site Service
               $('#on_site_service').on('change', function() {
                    let value = $(this).val();

                    if (value === 'yes') {
                         $('#group_on_site_service_type').show();

                    }
                    else {
                         $('#group_on_site_service_type').hide();
                    }
               });

               // Rental History
               $('#rental_history').on('change', function() {
                    let value = $(this).val();

                    if (value === 'yes') {
                         $('#group_last_year_income').show();

                    }
                    else {
                         $('#group_last_year_income').hide();
                    }
               });
               // Private Garden
               $('#private_garden').on('change', function() {
                    let value = $(this).val();
                    console.log(value);

                    if (value === 'yes') {
                         $('#group_private_garden_size').show();

                    }
                    else {
                         $('#group_private_garden_size').hide();
                    }
               });

               // Property Category
               $('#property_category').on('change', function() {
                    if ($(this).val() === 'leasehold') {
                         $('#lease_duration_group').attr('style', 'display: block !important');
                    } else {
                         $('#lease_duration_group').attr('style', 'display: none !important');
                    }
               });

               // Property Category
               $('#extend_leasehold').on('change', function() {
                    if ($(this).val() === 'yes') {
                         $('#lease_duration_group').attr('style', 'display: block !important');
                    } else {
                         $('#lease_duration_group').attr('style', 'display: none !important');
                    }
               });
          });
     </script>

    <script>
     let price = new Cleave('#price', {
         numeral: true,
         numeralThousandsGroupStyle: 'thousand',
         prefix: '$ ',
         noImmediatePrefix: true,
         numeralDecimalMark: '.',
         delimiter: ','
     });

     let rent_price = new Cleave('#rent_price', {
         numeral: true,
         numeralThousandsGroupStyle: 'thousand',
         prefix: '$ ',
         noImmediatePrefix: true,
         numeralDecimalMark: '.',
         delimiter: ','
     });
     let rent_prannual_feesice = new Cleave('#annual_fees', {
         numeral: true,
         numeralThousandsGroupStyle: 'thousand',
         prefix: '$ ',
         noImmediatePrefix: true,
         numeralDecimalMark: '.',
         delimiter: ','
     });

     let estimated_rental_income = new Cleave('#estimated_rental_income', {
         numeral: true,
         numeralThousandsGroupStyle: 'thousand',
         prefix: '$ ',
         noImmediatePrefix: true,
         numeralDecimalMark: '.',
         delimiter: ','
     });
 </script>

     <script>
          document.addEventListener('DOMContentLoaded', function () {
              const regionSelect = document.getElementById('region');
              const subregionSelect = document.getElementById('subregion');

              const regionChoices = new Choices(regionSelect, { searchEnabled: false });
              const subregionChoices = new Choices(subregionSelect, { searchEnabled: false });

              const url = "{{ asset('/admin/data/regions.json') }}";

              console.log(url);
              fetch(url)
                  .then(response => response.json())
                  .then(data => {
                      const regions = Object.keys(data);
                      regionChoices.setChoices(
                          regions.map(region => ({ value: region, label: region.charAt(0).toUpperCase() + region.slice(1) })),
                          'value',
                          'label',
                          true
                      );

                      regionSelect.addEventListener('change', function () {
                          const selectedRegion = this.value;
                          const subregions = data[selectedRegion] || [];

                          // Reset subregion choices
                          subregionChoices.clearChoices();
                          subregionChoices.setChoices(
                              subregions.map(sub => ({ value: sub, label: sub })),
                              'value',
                              'label',
                              true
                          );
                      });
                  })
                  .catch(error => {
                      console.error("Failed to load JSON:", error);
                  });
          });
          </script>
@endpush
