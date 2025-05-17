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
<form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
     @csrf
     <div class="container-fluid">

     <div class="row">
          <div class="col-12">
               <div class="page-title-box">
                    <h4 class="mb-0 fw-semibold">Add Property</h4>
                    <ol class="breadcrumb mb-0">
                         <li class="breadcrumb-item"><a href="javascript: void(0);">Properties </a></li>
                         <li class="breadcrumb-item active">Listing Property</li>
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

                                        <x-form-input className="col-lg-6" type="text" name="owners[0][first_name]" label="First Name" />
                                        <x-form-input className="col-lg-6" type="text" name="owners[0][last_name]" label="Last Name" />
                                        <x-form-input className="col-lg-6" type="number" name="owners[0][phone_number]" label="Phone Number" />
                                        <x-form-input className="col-lg-6" type="email" name="owners[0][email]" label="Email" />

                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Owner 2</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-6" type="text" name="owners[1][first_name]" label="First Name" />
                                        <x-form-input className="col-lg-6" type="text" name="owners[1][last_name]" label="Last Name" />
                                        <x-form-input className="col-lg-6" type="number" name="owners[1][phone_number]" label="Phone Number" />
                                        <x-form-input className="col-lg-6" type="email" name="owners[1][email]" label="Email" />

                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Legal Entity (if applicable): PT PMA (property_legal)</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-12" type="text" name="company_name" label="Company Name" />
                                        <x-form-input className="col-lg-6" type="text" name="legal_rep_first_name" label="Legal Representative First Name" />
                                        <x-form-input className="col-lg-6" type="text" name="legal_rep_last_name" label="Legal Representative Last Name" />
                                        <x-form-input className="col-lg-6" type="number" name="legal_rep_phone_number" label="Phone Number" />
                                        <x-form-input className="col-lg-6" type="email" name="legal_rep_email" label="Email" />


                                   </div>
                              </div>

                         </div>


                     </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Features & Amenities Form  --}}
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

                                        @foreach ($feature_list_indoor as $feature_indoor)
                                             <x-form-checkbox className="form-check mb-2 mx-3" name="feature[{{ $feature_indoor->slug }}]" label="{{ $feature_indoor->name }}" />
                                        @endforeach

                                        {{-- <x-form-checkbox className="form-check mb-2 mx-3" name="fully_furnished" label="Fully Furnished" />
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
                                        <x-form-checkbox className="form-check mb-2 mx-3" name="cctv" label="CCTV System" /> --}}

                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Outdoor Features</h5>
                                   <hr>
                                   <div class="my-3 row">
                                        @foreach ($feature_list_outdoor as $feature_outdoor)
                                             <x-form-checkbox className="form-check mb-2 mx-3" name="feature[{{ $feature_outdoor->slug }}]" label="{{ $feature_outdoor->name }}" />
                                        @endforeach
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
                              <x-form-input className="col-lg-4" type="text" name="pool_area" label="Pool Area (m²)" placeholder="Input Pool Area" />

                              <x-form-input className="col-lg-6" type="text" name="bedroom" label="Bedroom" />
                              <x-form-input className="col-lg-6" type="text" name="bathroom" label="Bathroom" />

                              <x-form-input className="col-lg-6" type="text" name="year_construction" label="Year of Construction" placeholder="Input the Year of Construction" />
                              <x-form-input className="col-lg-6" type="text" name="year_renovated" label="Year of Last Renovation" placeholder="Input the Year of Renovation" />


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

                              <x-form-input className="col-lg-6" type="text" name="average_nightly_rate" label="Average Nightly Rate (IDR) *" />

                               <div class="col-md-6" id="group_average_occupancy_rate">
                                   <label for="average_occupancy_rate" class="form-label">Average Occupancy Rate (%) *</label>
                                   <div class="input-group">
                                   <input type="number" name="average_occupancy_rate" class="form-control" placeholder="Input Avg Occupancy Rate">
                                   <span class="input-group-text">%</span>
                                   </div>
                              </div>

                              <div class="col-md-6" id="group_month_rented_per_year">
                                   <label for="month_rented_per_year" class="form-label">Months Rented per Year *</label>
                                   <div class="input-group">
                                   <input type="number" name="month_rented_per_year" class="form-control" min="1" max="120" placeholder="Months Rented per Year">
                                   <span class="input-group-text">month(s)</span>
                                   </div>
                              </div>


                              <x-form-input className="col-lg-6" type="text" name="estimated_annual_turnover" label="Estimated Annual Turnover (IDR) *" />
                              <div class="col-lg-12 mb-3">
                                   <label for="file_rental_support" class="form-label">Supporting Document (e.g. : agency report, booking.com, airbnb, etc)</label>
                                   <input type="file" id="file_rental_support" name="file_rental_support" class="form-control" placeholder="">
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

                         <x-form-select className="col-lg-12" name="legal_category" label="Property Legal Category"
                                   :options="['Leasehold', 'Freehold']"
                         />

                         <div class="row">
                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4" id="freehold_group">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Freehold (Hak Milik)</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-6" type="text" name="freehold_purchase_date" label="Purchase Date" />

                                        <x-form-input className="col-lg-6" type="text" name="freehold_certificate_number" label="Certificate Number" />
                                        <x-form-input className="col-lg-6" type="text" name="freehold_certificate_holder_name" label="Certificate Holder Name" />

                                        <div class="col-lg-6">
                                             <label for="" class="form-label">Zoning</label>

                                             <x-form-checkbox className="form-check mb-2" name="freehold_green_zone" label="Green Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="freehold_yellow_zone" label="Yellow Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="freehold_pink_zone" label="Pink Zone" />
                                        </div>

                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4" id="leasehold_group">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Leasehold (Hak Sewa)</h5>
                                   <hr>
                                   <div class="my-3 row">



                                        <x-form-input className="col-lg-6" type="text" name="leasehold_start_date" label="Start Date" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_end_date" label="End Date" />

                                        <x-form-input className="col-lg-6" type="text" name="leasehold_contract_number" label="Contract Number" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_contract_holder_name" label="Contract Holder Name" />

                                   </div>
                              </div>

                              <div class="pt-4 px-3 rounded bg-light-subtle border border-dark mb-4" id="extension_leasehold_group">
                                   <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Extension Details</h5>
                                   <hr>
                                   <div class="my-3 row">

                                        <x-form-input className="col-lg-6" type="text" name="leasehold_negotiation_ext_cost" label="Negotiation Extension Cost" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_purchase_cost" label="Purchase Cost" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_deadline_payment" label="Deadline for Payment to Secure this Rate" />

                                        <div class="col-lg-6">
                                             <label for="" class="form-label">Zoning</label>

                                             <x-form-checkbox className="form-check mb-2" name="leasehold_green_zone" label="Green Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="leasehold_yellow_zone" label="Yellow Zone" />
                                             <x-form-checkbox className="form-check mb-2" name="leasehold_pink_zone" label="Pink Zone" />
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

                                   <x-form-input className="col-lg-4" type="text" name="estimated_commision_idr" label="Est. Commision Ammount" value="IDR 0" disabled="true" />
                                   <x-form-input className="col-lg-4" type="text" name="estimated_commision_usd" label="Est. Commision Ammount" value="$0" disabled="true" />

                                   <x-form-input className="col-lg-6" type="text" name="net_seller_price_idr" label="Net Seller price (Excluding Commision)" value="IDR 0" disabled="true" />
                                   <x-form-input className="col-lg-6" type="text" name="net_seller_price_usd" label="Net Seller price (Excluding Commision)" value="$0" disabled="true" />

                         </div>
                    </div>
               </div>


               {{-- -------------------------------------------------------------------------  --}}
               {{-- Type of Mandate Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Type of Mandate</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <div class="col-lg-12 mb-3">
                                   <div class="row">
                                        <div class="col-12">
                                             <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="type_mandate" id="esstentials_mandate" value="Essentials Mandate">
                                                  <label class="form-check-label" for="esstentials_mandate">Essentials Mandate</label>
                                             </div>
                                             <div class="form-check form-check-inline">
                                                  <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate">
                                                  <label class="form-check-label" for="booster_mandate">Booster Mandate</label>
                                             </div>
                                        </div>
                                   </div>
                              </div>

                              <div class="col-lg-12 mb-3">
                                   <label for="file_type_of_mandate" class="form-label">Supporting Document</label>
                                   <input type="file" id="file_type_of_mandate" name="file_type_of_mandate" class="form-control" placeholder="">
                              </div>

                         </div>
                    </div>
               </div>

               {{-- -------------------------------------------------------------------------  --}}
               {{-- Document & Attachment Section Form  --}}
               {{-- -------------------------------------------------------------------------  --}}
               <div class="card">
                    <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                         <h4 class="card-title text-uppercase">Document & Attachment</h4>
                    </div>
                    <div class="card-body">
                         <div class="row">

                              <div class="col-lg-12 mb-3">
                                   <label for="gallery" class="form-label">Property Gallery (min 4)</label>
                                   {{-- <input type="file" id="gallery" name="gallery" class="form-control" placeholder=""> --}}

                                   <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="form-control mb-3">
                                   <div id="previewContainer" class="d-flex flex-wrap gap-3"></div>

                                   <input type="hidden" name="order" id="imageOrder">

                              </div>

                              <x-form-input className="col-lg-12" type="text" name="url_virtual_tour" label="Virtual Tour Link" placeholder="Input Youtube URL" />
                              <x-form-input className="col-lg-12" type="text" name="url_lifestyle" label="Lifestyle" placeholder="Input Youtube URL"/>
                              <x-form-input className="col-lg-12" type="text" name="url_experience" label="Experience" placeholder="Input Youtube URL"/>

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

     {{-- <script src="{{ asset('admin/assets/js/custom/custom-toggle.js') }}"></script> --}}
     <script src="{{ asset('admin/assets/js/custom/currency-format.js') }}"></script>

     <script src="{{ asset('admin/assets/js/axios.min.js') }}"></script>

     {{-- Custom Toggle --}}
     <script>

          $(document).ready(function() {
               // Sembunyikan semua grup toggle
               $('.toggle-group').hide();

               // Handle semua toggle sekaligus
               $('[data-toggle-target]').on('change', function() {
               const target = $(this).data('toggle-target');
               const showCondition = $(this).val() === 'yes' || $(this).val() === 'Yes'; // Sesuaikan dengan value Anda

               $(target).toggle(showCondition);
               });
          });

          $(document).ready(function() {

          $('#leasehold_group').hide();
          $('#freehold_group').hide();
          $('#extension_leasehold_group').hide();

          // Cek nilai old dari server
          const oldLegalCategory = "{{ old('legal_category') }}";

          console.log(oldLegalCategory);

          if (oldLegalCategory === 'Leasehold') {
               $('#leasehold_group').attr('style', 'display: block !important');
               $('#freehold_group').attr('style', 'display: none !important');
               $('#extension_leasehold_group').attr('style', 'display: block !important');
          } else if (oldLegalCategory === 'Freehold') {
               $('#leasehold_group').attr('style', 'display: none !important');
               $('#freehold_group').attr('style', 'display: block !important');
               $('#extension_leasehold_group').attr('style', 'display: none !important');
          }

          // Saat user mengganti pilihan
          $('#legal_category').on('change', function() {
               if ($(this).val() === 'Leasehold') {
                    $('#leasehold_group').attr('style', 'display: block !important');
                    $('#freehold_group').attr('style', 'display: none !important');
                    $('#extension_leasehold_group').attr('style', 'display: block !important');
               } else {
                    $('#leasehold_group').attr('style', 'display: none !important');
                    $('#freehold_group').attr('style', 'display: block !important');
                    $('#extension_leasehold_group').attr('style', 'display: none !important');
               }
          });
          });

     </script>
     {{-- /* Custom Toggle */--}}

     {{-- Convert IDR to USD --}}
     <script>
          const defaultKurs = 15000;
          const cacheKey = 'usd_to_idr_rate';
          const cacheTimeKey = 'usd_to_idr_rate_time';
          const cacheTTL = 10 * 60 * 1000; // 10 minutes

          // debounce / batasi eksekusi fungsi (ketika user ketik angka)
          function debounce(func, delay) {
               let timeout;
               return function (...args) {
                    clearTimeout(timeout);
                    timeout = setTimeout(() => func.apply(this, args), delay);
               };
          }

          function formatCurrency(value, locale, currency, fraction = 2) {
               return new Intl.NumberFormat(locale, {
                    style: 'currency',
                    currency: currency,
                    minimumFractionDigits: fraction
               }).format(value);
          }

          async function getExchangeRate() {
               const now = new Date().getTime();
               const storedRate = localStorage.getItem(cacheKey);
               const storedTime = localStorage.getItem(cacheTimeKey);

               if (storedRate && storedTime && (now - parseInt(storedTime)) < cacheTTL) {
                    return parseFloat(storedRate);
               }

               try {
                    const response = await axios.get('https://api.exchangerate-api.com/v4/latest/USD');
                    const rate = response.data.rates.IDR;
                    localStorage.setItem(cacheKey, rate);
                    localStorage.setItem(cacheTimeKey, now);
                    return rate;
               } catch (error) {
                    console.error("Gagal mengambil kurs dari API:", error);
                    return defaultKurs;
               }
          }

          async function handleIDRInput() {

               const idrInput = document.getElementById('idr_price');
               const commissionRateInput = document.getElementById('commision_rate');
               const idrValue = parseFloat(idrInput.value.replace(/[^0-9]/g, '')) || 0;
               let commissionPercent = parseFloat(commissionRateInput.value) / 100 || 0;

               // Balimmo Properties Fees
               if(idrValue < '15000000000'){
                    document.getElementById('commision_rate').value = '5%';
                    commissionPercent = parseFloat(commissionRateInput.value) / 100;

               }else if(idrValue >= '15000000000' && idrValue <= '34000000000'){
                    document.getElementById('commision_rate').value = '4%';
                    commissionPercent = parseFloat(commissionRateInput.value) / 100;
               }
               else if(idrValue > '34000000000' && idrValue <= '70000000000'){
                    document.getElementById('commision_rate').value = '4%';
                    commissionPercent = parseFloat(commissionRateInput.value) / 100;
               }
               else{
                    document.getElementById('commision_rate').value = '2.5%';
                    commissionPercent = parseFloat(commissionRateInput.value) / 100;
               }

               if (idrValue <= 0) return;

               const rate = await getExchangeRate();
               const usdValue = idrValue / rate;

               // Update USD values
               document.getElementById('usd_price').value = formatCurrency(usdValue, 'en-US', 'USD');
               document.getElementById('usd_price_raw').value = usdValue.toFixed(2);

               // Komisi & Net Seller (IDR)
               const idrCommission = idrValue * commissionPercent;
               const idrNetSeller = idrValue - idrCommission;

               document.getElementById('estimated_commision_idr').value = formatCurrency(idrCommission, 'id-ID', 'IDR', 0);
               document.getElementById('net_seller_price_idr').value = formatCurrency(idrNetSeller, 'id-ID', 'IDR', 0);

               // Komisi & Net Seller (USD)
               const usdCommission = usdValue * commissionPercent;
               const usdNetSeller = usdValue - usdCommission;
               document.getElementById('estimated_commision_usd').value = formatCurrency(usdCommission, 'en-US', 'USD');
               document.getElementById('net_seller_price_usd').value = formatCurrency(usdNetSeller, 'en-US', 'USD');
          }

          document.getElementById('idr_price').addEventListener('input', debounce(handleIDRInput, 400));
     </script>

     {{-- /* Convert IDR to USD --}}

    <script>
          $("#leasehold_start_date").flatpickr({dateFormat: "d-m-Y"});
          $("#leasehold_end_date").flatpickr({dateFormat: "d-m-Y"});
          $("#freehold_purchase_date").flatpickr({dateFormat: "d-m-Y"});
          $("#leasehold_deadline_payment").flatpickr({dateFormat: "d-m-Y"});
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

          {{-- ######################### Gallery Upload ######################### --}}
          <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

          <script>
          const imageInput = document.getElementById('imageInput');
          const previewContainer = document.getElementById('previewContainer');
          const imageOrder = document.getElementById('imageOrder');
          const galleryForm = document.getElementById('galleryForm');
          let files = [];

          imageInput.addEventListener('change', (e) => {
               files = Array.from(e.target.files);
               previewContainer.innerHTML = '';

               files.forEach((file, index) => {
                    const reader = new FileReader();
                    reader.onload = (event) => {
                         const imgDiv = document.createElement('div');
                         imgDiv.classList.add('img-preview');
                         imgDiv.setAttribute('data-index', index);
                         imgDiv.innerHTML = `
                              <img src="${event.target.result}" alt="Image Preview"
                                   style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #ccc; padding: 4px;">
                              <p class="text-center mt-1">Image ${index + 1}</p>
                         `;
                         previewContainer.appendChild(imgDiv);
                    };
                    reader.readAsDataURL(file);
               });

               updateOrder();
          });

          function updateOrder() {
               const items = document.querySelectorAll('.img-preview');
               imageOrder.value = Array.from(items).map(item => item.getAttribute('data-index')).join(',');
          }

          new Sortable(previewContainer, {
               animation: 150,
               onEnd: () => updateOrder(),
          });

          // 👇 Tambahkan ini agar order selalu terupdate saat form disubmit
          galleryForm.addEventListener('submit', function (e) {
               updateOrder(); // pastikan order diperbarui dulu
          });
          </script>
          {{-- /* Gallery Upload */ --}}
@endpush
