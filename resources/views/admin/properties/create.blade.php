@extends('admin.layouts.master')
@push('style')

    <!-- Link ke CSS Select2 -->

    <style>
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
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Property Owners</h4>
                     </div>
                     <div class="card-body">
                         <div class="row">

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Owner 1</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-6" type="text" name="first_own_first_name" label="First Name" />
                                        <x-form-input className="col-lg-6" type="text" name="first_own_last_name" label="Last Name" />
                                        <x-form-input className="col-lg-6" type="number" name="first_own_phone_number" label="Phone Number" />
                                        <x-form-input className="col-lg-6" type="email" name="first_own_email" label="Email" />


                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Owner 2</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-6" type="text" name="second_own_first_name" label="First Name" />
                                        <x-form-input className="col-lg-6" type="text" name="second_own_last_name" label="Last Name" />
                                        <x-form-input className="col-lg-6" type="number" name="second_own_phone_number" label="Phone Number" />
                                        <x-form-input className="col-lg-6" type="email" name="second_own_email" label="Email" />


                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Legal Entity (if applicable): PT. PMA</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-12" type="text" name="company_name" label="Company Name" />
                                        <x-form-input className="col-lg-6" type="text" name="legal_rep_last_name" label="Legal Representative Last Name" />
                                        <x-form-input className="col-lg-6" type="text" name="legal_rep_first_name" label="Legal Representative First Name" />
                                        <x-form-input className="col-lg-6" type="number" name="legal_rep_phone_number" label="Phone Number" />
                                        <x-form-input className="col-lg-6" type="email" name="legal_rep_email" label="Email" />


                                   </div>
                              </div>
                    
                         </div>
                     
                     
                     </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Main Features Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Features & Amenities</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Indoor Features</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Fully Furnished" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="equipped_kitchen" label="Equipped Kitchen (Fridge, Oven, Stove, Extractor Hood)" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="air_conditioning" label="Air Conditioning in All Room" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="wardobes_dressing_room" label="Dressing Room or Built-in Wardobes" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="master_bedroom_bathub" label="Bathub in Master Bedroom" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="laundry_room" label="Laundry Room with Washing Machine" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="home_cinema" label="Home Cinema or Projector" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="office_space" label="Office Space" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="installed_wifi" label="Installed Wi-Fi" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="safe_box" label="Safe Box" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="smart_home_system" label="Smart Home System" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="integrated_audio_system" label="Integrated Audio System" />
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="cctv" label="CCTV System" />

                                   </div>
                              </div>


                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Outdoor Features</h5>
                                   <hr>
                                   <div class="my-3 row">

                                             <div class="col-md-6">
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Infinity Pool" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Pool Deck / Sun Loungers Included" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Landscape Garden" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Gazebo / Outdoor Lounge" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Outdoor Shower" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Outdoor Kitchen or Barbeque Area" />
                                             </div>

                                             <div class="col-md-6">
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Garage / Carport" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Automatic Gate" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Ocean View" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Rice Field View" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Jungle View" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="West-facing (Sunset View)" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Direct Beach Access" />
                                                  <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Rooftop Terrace" />
                                             </div>

                                   </div>
                              </div>
       
                         </div>


                    </div>
               </div>


          </div>

          <div class="col-xl-6 col-lg-6 ">

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Purpose of The Mandate Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Purpose of The Mandate</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <div class="col-lg-12 mb-3" id="group_internal_reference">
                                   <label for="internal_reference" class="form-label">Internal Reference</label>
                                   <input type="text" class="form-control" placeholder="Internal Reference" disabled value="{{ Auth::user()->reference_code }}">
                              </div>

                              <x-form-input className="col-lg-12" type="text" name="property_name" label="Property Name" />

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

                              <div class="col-lg-12 mb-3" id="group_description">
                                   <label for="description" class="form-label">Description</label>
                                   <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description"></textarea>
                              </div>

                
                         </div>
                
                
                    </div>
                </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Technical Details of The Property Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Technical Details of The Property</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <x-form-input className="col-lg-4" type="text" name="land_size" label="Total Land Area (m²)" placeholder="Input Land Size" />
                              
                              <x-form-input className="col-lg-4" type="text" name="built_area" label="Villa Area (m²)" placeholder="Input Villa Area" />
                              <x-form-input className="col-lg-4" type="text" name="living_area" label="Pool Area (m²)" placeholder="Input Pool Area" />

                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Bedroom" />
                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Bathroom" />

                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Year of Construction" placeholder="Input the Year of Construction" />
                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Year of Last Renovation" placeholder="Input the Year of Renovation" />

                             
                         </div>
                    </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Rental Yield Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Rental Yield</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Average Nightly Rate (IDR)" />
                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Average Occupancy Rate (%)" />

                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Months Rented per Year" />
                              <x-form-input className="col-lg-6" type="text" name="number_of_floors" label="Estimated Annual Turnover" />
                              <div class="col-lg-12 mb-3">
                                   <label for="featured_image" class="form-label">Supporting Document (e.g. : agency report, booking.com, airbnb, etc)</label>
                                   <input type="file" id="featured_image" name="featured_image" class="form-control" placeholder="">
                              </div>
                             
                         </div>
                    </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Legal Status of the Property Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Legal Status of the Property</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Freehold (Hak Milik)</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <div class="col-lg-6 mb-3">
                                             <label for="purchase_date" class="form-label">Purchase Date</label>
                                             <input type="text" id="purchase_date" name="purchase_date" class="form-control" placeholder="Input Purchase Date">
                                        </div>

                                        <x-form-input className="col-lg-6" type="text" name="certificate_number" label="Certificate Number" />
                                        <x-form-input className="col-lg-6" type="text" name="certificate_holder_name" label="Certificate Holder Name" />

                                        <div class="col-lg-6">
                                             <label for="" class="form-label">Zoning</label>

                                             <x-form-checkbox className="form-check mb-2" name="green_zone" label="Green Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="yellow_zone" label="Yellow Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="pink_zone" label="Pink Zone" />
                                        </div>

                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Leasehold (Hak Sewa)</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <div class="col-lg-6 mb-3">
                                             <label for="start_date" class="form-label">Start Date</label>
                                             <input type="text" id="start_date" name="start_date" class="form-control" placeholder="Input Start Date">
                                        </div>
                                        <div class="col-lg-6 mb-3">
                                             <label for="end_date" class="form-label">End Date</label>
                                             <input type="text" id="end_date" name="end_date" class="form-control" placeholder="Input End Date">
                                        </div>

                                        <x-form-input className="col-lg-6" type="text" name="contract_number" label="Contract Number" />
                                        <x-form-input className="col-lg-6" type="text" name="contract_holder_name" label="Contract Holder Name" />

                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Extension Details</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-6" type="text" name="contract_number" label="Negotiation Extension Cost" />
                                        <x-form-input className="col-lg-6" type="text" name="contract_holder_name" label="Purchase Cost" />

                                        <div class="col-lg-6 mb-3">
                                             <label for="deadline_payment" class="form-label">Deadline for Payment to Secure this Rate</label>
                                             <input type="text" id="deadline_payment" name="deadline_payment" class="form-control" placeholder="Input Payment Deadline">
                                        </div>

                                        <div class="col-lg-6">
                                             <label for="" class="form-label">Zoning</label>

                                             <x-form-checkbox className="form-check mb-2" name="green_zone" label="Green Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="yellow_zone" label="Yellow Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="pink_zone" label="Pink Zone" />
                                        </div>

                                   </div>
                              </div>


                         </div>
                    </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Sale Price & Conditions Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Sale Price & Conditions</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                                   <x-form-input className="col-lg-6" type="text" name="idr_price" label="Desired Selling Price" />
                                   <x-form-input className="col-lg-6" type="text" name="usd_price" label="Estimated USD Conversion" disabled="true" />
                                   <input type="hidden" name="usd_price" id="usd_price_raw">

                                   <x-form-input className="col-lg-4" type="text" name="commision_rate" label="Commision Rate (%)" value="4%" disabled="true" />

                                   <x-form-input className="col-lg-4" type="text" name="estimated_commision_idr" label="Est. Commision Ammount" value="0" disabled="true" />
                                   <x-form-input className="col-lg-4" type="text" name="estimated_commision_usd" label="Est. Commision Ammount" value="$0" disabled="true" />

                                   <x-form-input className="col-lg-6" type="text" name="net_seller_price_idr" label="Net Seller price (Excluding Commision)" value="0" disabled="true" />
                                   <x-form-input className="col-lg-6" type="text" name="net_seller_price_usd" label="Net Seller price (Excluding Commision)" value="$0" disabled="true" />

                         </div>
                    </div>
               </div>


               <div class="mb-3 rounded">
                    <div class="row justify-content-end g-2">
                         <div class="col-lg-3">
                              <button type="submit" class="btn btn-outline-primary w-100">Create Properties</button>
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
     <script src="{{ asset('admin/assets/js/cleave.min.js') }}"></script>
     <script src="{{ asset('admin/assets/js/cleave-phone.us.js') }}"></script>
     <script src="{{ asset('admin/assets/js/flatpickr-min.js') }}"></script>


     <script src="{{ asset('admin/assets/js/custom/custom-toggle.js') }}"></script>
     <script src="{{ asset('admin/assets/js/custom/currency-format.js') }}"></script>

     <script src="{{ asset('admin/assets/js/axios.min.js') }}"></script>

     {{-- Convert IDR to USD --}}
     <script>
          document.getElementById('idr_price').addEventListener('input', async function() {
               const idrValue = parseFloat(this.value.replace(/[^0-9]/g, ''));
               let commisionPercent = parseFloat(document.getElementById('commision_rate').value) / 100;

               if (!isNaN(idrValue)) {
                    try {
                         // ExchangeRate-API
                         const response = await axios.get('https://api.exchangerate-api.com/v4/latest/USD');
                         const rate = response.data.rates.IDR;
                         
                         document.getElementById('usd_price').value = '$ ' + (idrValue / rate).toFixed(2);
                         document.getElementById('usd_price_raw').value = '$ ' + (idrValue / rate).toFixed(2);
                    } catch (error) {
                         console.error("Gagal mengambil kurs:", error);
                         document.getElementById('usd_price').value = '$ ' + (idrValue / 15000).toFixed(2);
                         document.getElementById('usd_price_raw').value = '$ ' + (idrValue / 15000).toFixed(2);
                    }


                    // IDR Estimate Commision Ammount
                    const idrCommission = idrValue * commisionPercent;
                    const idrNetSeller = idrValue - idrCommission;

                    document.getElementById('estimated_commision_idr').value = new Intl.NumberFormat('id-ID', {
                         style: 'currency',
                         currency: 'IDR',
                         minimumFractionDigits: 0
                    }).format(idrCommission);

                    document.getElementById('net_seller_price_idr').value = new Intl.NumberFormat('id-ID', {
                         style: 'currency',
                         currency: 'IDR',
                         minimumFractionDigits: 0
                    }).format(idrNetSeller);

                    // USD Estimate Commision Ammount
                    let usdValue = parseFloat(document.getElementById('usd_price_raw').value.replace(/[^0-9.]/g, ''));
                    const usdCommision = usdValue * commisionPercent;
                    const usdNetSeller = usdValue - usdCommision;

                    document.getElementById('estimated_commision_usd').value = new Intl.NumberFormat('en-US', {
                         style: 'currency',
                         currency: 'USD',
                         minimumFractionDigits: 2
                    }).format(usdCommision);

                    document.getElementById('net_seller_price_usd').value = new Intl.NumberFormat('en-US', {
                         style: 'currency',
                         currency: 'USD',
                         minimumFractionDigits: 2
                    }).format(usdNetSeller);

               }
          });
     </script>
     {{-- /* Convert IDR to USD --}}
     



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
