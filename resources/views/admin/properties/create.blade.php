@extends('admin.layouts.master')
@push('style')

    <!-- Link ke CSS Select2 -->

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
<form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data">
     @csrf
     <div class="container-fluid">

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

     <div class="row">

          
          <div class="col-xl-6 col-lg-6 ">
               {{-- -------------------------------------------------------------------------  --}}
               {{-- Properties Information Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Property Information</h4>
                     </div>
                     <div class="card-body">
                         <div class="row">
                              <x-form-input className="col-lg-12" type="text" name="property_name" label="Properties Name"/>
                         
                              <div class="col-lg-12 mb-3" id="group_property_description">
                                   <label for="property_description" class="form-label">Description</label>
                                   <textarea class="form-control" id="property_description" name="property_description" rows="3" placeholder="Enter address"></textarea>
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
                     
                              <x-form-select className="col-lg-6" name="property_type" label="Property Type"
                                   :options="['Appartement', 'Terrain', 'Villa', 'Villa Complex']"
                              />
                     
                              <x-form-select className="col-lg-6" name="property_status" label="Choose Status Property" 
                                   :options="['Avaliable', 'Rented', 'Sold', 'Under Construction', 'Under Contract']"
                              />
                     
                              <div class="col-lg-6 mb-3" id="group_internal_reference">
                                   <label for="internal_reference" class="form-label">Internal Reference</label>
                                   <input type="text" class="form-control" placeholder="Internal Reference" disabled value="{{ Auth::user()->reference_code }}">
                                   <input type="hidden" id="internal_reference" name="internal_reference" class="form-control" placeholder="Internal Reference" readonly value="{{ Auth::user()->reference_code }}">
                              </div>
                     
                              <x-form-input className="col-lg-6" type="text" name="year_built" label="Year Built" placeholder="Input Year Built" />
                              <x-form-input className="col-lg-6" type="text" name="current_owner" label="Current Owner" placeholder="Input Current Owner" />
                              <x-form-input className="col-lg-6" type="text" name="owner_contact" label="Owner Contact" placeholder="Input Owner Contact" />
                         
                              <div class="col-lg-6 mb-3">
                                   <label for="start_date" class="form-label">Start Date</label>
                                   <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Start Date">
                              </div>

                              <div class="col-lg-6 mb-3">
                                   <label for="end_date" class="form-label">End Date</label>
                                   <input type="text" id="end_date" name="end_date" class="form-control" placeholder="Basic datepicker">
                              </div>
                         </div>
                     
                     
                     </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Main Features Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Main Features</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <x-form-input className="col-lg-6" type="number" name="bedrooms" label="Bedrooms" />
                              <x-form-input className="col-lg-6" type="number" name="bathroom" label="Bathroom" />
                              <x-form-input className="col-lg-6" type="text" name="parking_area" label="Parking Area" />
                              
                              <x-form-select className="col-lg-6" name="kitchen_type" label="Kitchen Type" 
                                   :options="['Closed Kitchen', 'Open Kitchen', 'Full Kitchen']"
                              />

                              <x-form-select className="col-lg-6" name="roof_type" label="Roof Type" 
                                   :options="['Alang Alang Roof', 'Flat Roof', 'Tiled Roof']"
                              />

                              <x-form-select className="col-lg-6" name="floor_type" label="Floor Type" 
                                   :options="['Smoot Concrete', 'Wood Floor', 'Ceramic Floor']"
                              />

       
                         </div>


                    </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Location & Surrounding Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Location & Surroundings</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <x-form-multiple-select name="properties_view" label="Properties Views">
                                   <option value="Jungle">Jungle</option>
                                   <option value="Mountain">Mountain</option>
                                   <option value="Sky City">Sky City</option>
                                   <option value="Sea">Sea</option>
                                   <option value="Rice Fields">Rice Fields</option>
                              </x-form-multiple-select>



                              <x-form-select className="col-lg-6" name="main_road_access" label="Main Road Access" toggle="#group_road_width"/>
                              <x-form-input className="col-lg-6 toggle-group" type="text" name="road_width" label="Road Width"/>

                              <x-form-select className="col-lg-6" name="secure_neighborhood" label="Secured Neighborhood" toggle="#group_secure_neighborhood_type"/>

                              <x-form-select className="col-lg-6 toggle-group" name="secure_neighborhood_type" label="Secured Neighborhood Type"
                                   :options="['Security Post', 'Gated Community']"
                              />

                              {{-- ########################### Proximity to key Points --}}
                              <div class="col-lg-12 mb-3">
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



                         </div>


                    </div>
               </div>


               {{-- -------------------------------------------------------------------------  --}}
               {{-- Investment Potential Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Investment Potential</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <x-form-select className="col-lg-6" name="current_usage" label="Current Usage"
                                   :options="['Owner Occupied', 'Rented', 'Vacant Land']"
                              />

                              <x-form-select className="col-lg-6" name="rental_history" label="Rental History" toggle="#group_last_year_income" />
                              <x-form-input className="col-lg-6 toggle-group" type="text" name="last_year_income" label="Last Year Income"/>

                              <x-form-input className="col-lg-6" type="text" name="estimated_occupancy_rate" label="Estimated Occupancy Rate" placeholder="In Percent (Ex: 10%)"/>
                              <x-form-input className="col-lg-6" type="text" name="return_on_investment" label="ROI (Return on Investment) Potential" placeholder="Percentage per year (Ex: 12%)"/>

                             
                         </div>


                    </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Document & Attachment Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Document & Attachment</h4>
                    </div>
                    <div class="card-body">
                         <div class="col-lg-12 mb-3">
                              <label for="featured_image" class="form-label">Featured Image</label>
                              <input type="file" id="featured_image" name="featured_image" class="form-control" placeholder="">
                         </div>
                         {{-- <div class="col-lg-12 mb-3">
                                   <label for="gallery" class="form-label">Gallery</label>
                                   <div class="dropzone" id="gallery-dropzone"></div>
                         </div>

                         <div class="col-lg-12 mb-3">
                                   <label for="property_plan" class="form-label">Property Plan</label>
                                   <input type="file" id="property_plan" name="property_plan" class="form-control" placeholder="">
                         </div>

                         <div class="col-lg-12 mb-3">
                              <label for="ownership_certificate" class="form-label">Ownership Certificate</label>
                              <input type="file" id="ownership_certificate" name="ownership_certificate" class="form-control" placeholder="">
                         </div>

                         <div class="col-lg-12 mb-3">
                              <label for="imb_pbg" class="form-label">IMB/PBG</label>
                              <input type="file" id="imb_pbg" name="imb_pbg" class="form-control" placeholder="">
                         </div> --}}
                         <x-form-input className="col-lg-6" type="text" name="virtual_tour" label="Virtual Tour (URL)" placeholder="Input URL Virtual Tour"/>

                         <x-form-select className="col-lg-6" name="monthly_charges" label="Monthly Charges"
                              :options="['Water', 'Internet', 'Electric']"
                         />
                    </div>
               </div>
          </div>

          <div class="col-xl-6 col-lg-6 ">

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Legal & Finance Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Legal & Finance Information</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <x-form-select className="col-lg-12" name="property_category" label="Property Category"
                                   :options="['Leasehold', 'Freehold']"
                              />
                
                            <div id="lease_duration_group" class="">
                                   <div class="row">
                                        <x-form-input className="col-lg-6" type="text" name="remaining_duration_lease" placeholder="Remaining Lease Duration" label="Remaining Lease Duration (Years)"/>
                                        <x-form-input className="col-lg-6" type="text" name="total_duration_lease" placeholder="Total Lease Duration" label="Total Lease Duration (Years)"/>
                                   </div>
                
                                   <div class="row">
                                        <x-form-select className="col-lg-6" name="extend_leasehold" label="Extends Leasehold" toggle="#group_duration_extend_leashold" />
                                        <x-form-input className="col-lg-6 toggle-group" type="text" name="duration_extend_leashold" label="Max Ext Duration (Years)" placeholder="Input Extend Leasehold"/>
                                    </div>
                            </div>
                
                            <x-form-input className="col-lg-6" type="text" name="price" label="Sell Price"/>
                            <x-form-input className="col-lg-6" type="text" name="cost_meter" label="Unit Price (per m²)"/>
                            <x-form-input className="col-lg-6" type="text" name="annual_fees" label="Annual Fees"/>
                            <x-form-input className="col-lg-6" type="text" name="estimated_rental_income" label="Estimated rental income (in a year)"/>
                
                         </div>
                
                
                    </div>
                </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Dimension Properties Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Dimension Properties</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <x-form-input className="col-lg-6" type="text" name="land_size" label="Land Size (m²)" placeholder="Input Land Size" />
                              <x-form-input className="col-lg-6" type="text" name="built_area" label="Built Area (m²)" placeholder="Input Built Area" />
                              <x-form-input className="col-lg-6" type="text" name="living_area" label="Living Area (m²)" placeholder="Input Living Area" />

                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Number of Floors" placeholder="Input Number of Floors" />

                              <x-form-select className="col-lg-6" name="garden" label="Garden" toggle="#group_garden_size" />
                              <x-form-input className="col-lg-6 toggle-group" type="text" name="garden_size" label="Garden Size" placeholder="Input Garden Size (m²)" />

                              <x-form-input className="col-lg-6" type="text" name="number_floors_building" label="Number Floors in Building" placeholder="Input Number of Floors in Building" />
                              <x-form-input className="col-lg-6" type="text" name="which_floor_apartement" label="Which floor the Appartement is on" placeholder="What floor is the apartment on ?" />
                             
                         </div>
                    </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Properties Facility Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 20px 0px 20px 0px">
                         <h4 class="card-title">Property Facilities</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">
                              {{-- ##### Features ####### --}}
                              
                              <div class="pt-4 px-3 rounded bg-light-subtle border border-light mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-community-line"></i></span> POOL</h5>
                                   <div class="my-3 row">

                                        <x-form-select className="col-lg-12" name="pool" label="Pool" toggle="#pool_group" />

                                        <div id="pool_group" class="toggle-group row">
                                             <x-form-input className="col-lg-4" type="text" name="pool_size" label="Pool Size (m²)" placeholder="Input Pool Size" />
                                             <x-form-input className="col-lg-4" type="text" name="pool_depth" label="Pool Depth (m)" placeholder="Input Pool Depth" />
                                             <x-form-select className="col-lg-4" name="heated_pool" label="Heated Pool" />
                                             <x-form-select className="col-lg-12" name="shared_pool" label="Shared Pool" />
                                        </div>

                                   </div>
                               </div>

                               <div class="pt-4 px-3 rounded bg-light-subtle border border-light mb-4">
                                   <h5 class="text-dark fw-semibold"> <span class="nav-icon"><i class="ri-community-line"></i></span> OUTDOOR & GARDEN</h5>
                                   <div class="my-3 row">

                                        <x-form-select className="col-lg-6" name="private_garden" label="Private Garden" toggle="#group_private_garden_size" />
                                        <x-form-input className="col-lg-6 toggle-group" type="text" name="private_garden_size" label="Private Garden Size (m²)" />

                                        <x-form-select className="col-lg-6" name="gazebo" label="Gazebo/Bale Bengong" toggle="#group_gazebo_size" />
                                        <x-form-input className="col-lg-6 toggle-group" type="text" name="gazebo_size" label="Gazebo/Bale Bengong Size (m²)" />
          
                                        <x-form-select className="col-lg-6" name="barbecue_area" label="Barbecue Area" />

                                        <x-form-select className="col-lg-6" name="rooftop_terrace" label="Rooftop/Terrace" toggle="#group_rooftop_terrace_size" />
                                        <x-form-input className="col-lg-6 toggle-group" type="text" name="rooftop_terrace_size" label="Rooftop/Terrace Size (m²)" />
                                   </div>
                               </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-light mb-4">
                                   <h5 class="text-dark fw-semibold"> <span class="nav-icon"><i class="ri-community-line"></i></span> COMFORT & FACILITIES</h5>
                                   <div class="my-3 row">

                                        <x-form-select className="col-lg-6" name="air_conditioning" label="Air Conditioning" />
                                        <x-form-input className="col-lg-6" type="text" name="number_air_conditioning" label="Number of Units" placeholder="Input Number Unit AC" />
                                        <x-form-select className="col-lg-6" name="ceiling_fans" label="Ceiling Fans" />
                                        <x-form-select className="col-lg-6" name="water_heater" label="Water Heater" toggle="#group_water_heater_type" />
                                        <x-form-select className="col-lg-6 toggle-group" name="water_heater_type" label="Water Heater Type" 
                                             :options="['Electric', 'Solar']"
                                        />


                                        <x-form-input className="col-lg-6" type="text" name="electrical_power" label="Electrical Power (watt)" />

                                        <x-form-select className="col-lg-6" name="internet" label="Internet/Wi-Fi" />
                                        <x-form-input className="col-lg-6" type="text" name="type_of_connection" label="Speed Connection (mbps)" />

                                        <x-form-multiple-select name="security" label="Security">
                                             <option value="alarm system">Alarm System</option>
                                             <option value="cctv">CCTV</option>
                                             <option value="security_guard">Security Guard</option>
                                        </x-form-multiple-select>

                                        <x-form-select className="col-lg-6" name="backup_generator" label="Backup Generator" />

                                        <x-form-select className="col-lg-6" name="water_reservoir" label="Water Reservoir" />
                                        <x-form-input className="col-lg-6" type="text" name="water_reservoir_capacity" label="Water Reservoir Capacity (Liter)" />

                                        <x-form-select className="col-lg-6" name="water_filtration_system" label="Water Filtration System" />


                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-light mb-4">
                                   <h5 class="text-dark fw-semibold"> <span class="nav-icon"><i class="ri-community-line"></i></span> OTHER FACILITIES</h5>
                                   <div class="my-3 row">

                                        <x-form-select className="col-lg-6" name="furnished" label="Furnished" />

                                        <x-form-multiple-select name="fully_equipped_kitchen" label="Fully equipped kitchen">
                                             <option value="dishwasher">Dishwasher</option>
                                             <option value="oven">Oven</option>
                                             <option value="stove">Stove</option>
                                        </x-form-multiple-select>
          
                                        <x-form-multiple-select name="laundry" label="Laundry">
                                             <option value="dryer">Dryer</option>
                                             <option value="washing_machine">Washing Machine</option>
                                        </x-form-multiple-select>
          
                                        <x-form-select className="col-lg-6" name="private_gym" label="Private Gym" />
                                        <x-form-select className="col-lg-6" name="private_cinema" label="Private Cinema" />
          
                                   </div>
                              </div>

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
     <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>


     <script src="{{ asset('admin/assets/js/custom/custom-toggle.js') }}"></script>
     <script src="{{ asset('admin/assets/js/custom/currency-format.js') }}"></script>

    <script>
          $("#start_date").flatpickr({dateFormat: "d-m-Y"});
          $("#end_date").flatpickr({dateFormat: "d-m-Y"});

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
