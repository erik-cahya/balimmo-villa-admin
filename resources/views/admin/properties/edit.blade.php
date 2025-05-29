@extends('admin.layouts.master')
@push('style')
    <!-- Link ke CSS Select2 -->

    <style>
        .choices {
            margin-bottom: 0px;
        }

        #lease_duration_group {
            display: none !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('admin/assets/css/glightbox.min.css') }}" />
@endpush
@section('content')
    <form action="{{ route('properties.update', $data_properties->id) }}" method="POST" enctype="multipart/form-data" id="galleryForm">
        @csrf
        @method('PUT')
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="fw-semibold mb-0">Add Property</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Properties </a></li>
                            <li class="breadcrumb-item active">Listing Property</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-xl-6 col-lg-6">
                    {{-- -------------------------------------------------------------------------  --}}
                    {{-- Properties Information Form  --}}
                    {{-- -------------------------------------------------------------------------  --}}
                    <div class="card">
                        <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                            <h4 class="card-title text-uppercase">Property Owners</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div id="owners-container">
                                    @foreach ($property_owner as $index => $owner)
                                        @include('components.owner-input', ['owner' => $owner, 'index' => $index])
                                    @endforeach
                                </div>

                                <button type="button" class="btn btn-sm btn-secondary mb-2" onclick="addOwner()">+ Add Owner</button>

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Legal Entity (if applicable): PT PMA</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <x-form-input className="col-lg-12" type="text" name="company_name" label="Company Name" value="{{ $data_properties->company_name }}" />
                                        <x-form-input className="col-lg-6" type="text" name="legal_rep_first_name" label="Legal Representative First Name" value="{{ $data_properties->rep_first_name }}" />
                                        <x-form-input className="col-lg-6" type="text" name="legal_rep_last_name" label="Legal Representative Last Name" value="{{ $data_properties->rep_last_name }}" />
                                        <x-form-input className="col-lg-6" type="number" name="legal_rep_phone_number" label="Phone Number" value="{{ $data_properties->phone }}" />
                                        <x-form-input className="col-lg-6" type="email" name="legal_rep_email" label="Email" value="{{ $data_properties->email }}" />

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

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Indoor Features</h5>
                                    <hr>
                                    <div class="row my-3">
                                        @foreach ($feature_list_indoor as $featureIndoor)
                                            <div class="form-check mx-3 mb-2">

                                                <input type="checkbox" id="feature[{{ $featureIndoor->slug }}]" name="feature[{{ $featureIndoor->slug }}]" value="{{ $featureIndoor->id }}" class="form-check-input"
                                                    {{ in_array($featureIndoor->id, $selected_feature_ids) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="feature[{{ $featureIndoor->slug }}]">{{ $featureIndoor->name }}</label>

                                            </div>
                                        @endforeach

                                    </div>
                                </div>

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Outdoor Features</h5>
                                    <hr>
                                    <div class="row my-3">
                                        @foreach ($feature_list_outdoor as $featureOutdoor)
                                            <div class="form-check mx-3 mb-2">

                                                <input type="checkbox" id="feature[{{ $featureOutdoor->slug }}]" name="feature[{{ $featureOutdoor->slug }}]" value="{{ $featureOutdoor->id }}" class="form-check-input"
                                                    {{ in_array($featureOutdoor->id, $selected_feature_ids) ? 'checked' : '' }}>
                                                <label class="form-check-label" for="feature[{{ $featureOutdoor->slug }}]">{{ $featureOutdoor->name }}</label>

                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6 col-lg-6">

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

                                <x-form-input className="col-lg-12" type="text" name="property_name" label="Property Name" value="{{ $data_properties->property_name }}" />

                                <div class="col-lg-6 mb-3" id="group_region">
                                    <label for="region" class="form-label">Region</label>
                                    <select id="region" class="form-select" name="region">
                                        <option value="" disabled>Select Region</option>
                                    </select>
                                </div>

                                <div class="col-lg-6 mb-3" id="group_subregion">
                                    <label for="subregion" class="form-label">Sub Region</label>
                                    <select id="subregion" class="form-select" name="subregion">
                                        <option value="" disabled>Select Region First</option>
                                    </select>
                                </div>

                                <div class="col-lg-12 mb-3" id="group_property_address">
                                    <label for="property_address" class="form-label">Property Address</label>
                                    <textarea class="form-control" id="property_address" name="property_address" rows="3" placeholder="Enter address">{{ $data_properties->property_address }}</textarea>
                                </div>

                                <div class="col-lg-12 mb-3" id="group_description">
                                    <label for="description" class="form-label">Description</label>
                                    <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ $data_properties->property_description }}</textarea>
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

                                <x-form-input className="col-lg-4" type="text" name="land_size" label="Total Land Area (m²)" placeholder="Input Land Size" value="{{ $data_properties->total_land_area }}" />

                                <x-form-input className="col-lg-4" type="text" name="built_area" label="Villa Area (m²)" placeholder="Input Villa Area" value="{{ $data_properties->villa_area }}" />
                                <x-form-input className="col-lg-4" type="text" name="pool_area" label="Pool Area (m²)" placeholder="Input Pool Area" value="{{ $data_properties->pool_area }}" />

                                <x-form-input className="col-lg-6" type="number" name="bedroom" label="Bedroom" value="{{ $data_properties->bedroom }}" />
                                <x-form-input className="col-lg-6" type="number" name="bathroom" label="Bathroom" value="{{ $data_properties->bathroom }}" />

                                <x-form-input className="col-lg-6" type="number" name="year_construction" label="Year of Construction" placeholder="Input the Year of Construction" value="{{ $data_properties->year_construction }}" />
                                <x-form-input className="col-lg-6" type="number" name="year_renovated" label="Year of Last Renovation" placeholder="Input the Year of Renovation" value="{{ $data_properties->year_renovated }}" />

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

                                <x-form-input className="col-lg-6" type="text" name="average_nightly_rate" label="Average Nightly Rate (IDR) *" value="{{ $data_properties->avg_nightly_rate }}" />

                                <div class="col-md-6" id="group_average_occupancy_rate">
                                    <label for="average_occupancy_rate" class="form-label">Average Occupancy Rate (%) *</label>
                                    <div class="input-group">
                                        <input type="number" name="average_occupancy_rate" class="form-control" placeholder="Input Avg Occupancy Rate" value="{{ round($data_properties->avg_occupancy_rate, 0) }}">
                                        <span class="input-group-text">%</span>
                                    </div>
                                </div>

                                <div class="col-md-6" id="group_month_rented_per_year">
                                    <label for="month_rented_per_year" class="form-label">Months Rented per Year *</label>
                                    <div class="input-group">
                                        <input type="number" name="month_rented_per_year" class="form-control" min="1" max="120" placeholder="Months Rented per Year" value="{{ $data_properties->months_rented }}">
                                        <span class="input-group-text">month(s)</span>
                                    </div>
                                </div>

                                <x-form-input className="col-lg-6" type="text" name="estimated_annual_turnover" label="Estimated Annual Turnover (IDR) *" value="{{ $data_properties->annual_turnover }}" />
                                <div class="col-lg-12 mb-3">
                                    <label for="file_rental_support" class="form-label">Supporting Document (e.g. : agency report, booking.com, airbnb, etc)</label>
                                    <input type="file" id="file_rental_support" name="file_rental_support" class="form-control mb-2" placeholder="">

                                    @if (isset($attachment['file_rental_support']))
                                        <a href="{{ asset('admin/attachment/' . $data_properties->property_slug . '/' . $attachment['file_rental_support']) }}">
                                            <span class="badge bg-light-subtle text-muted fw-medium fs-13 d-flex align-items-center border px-2 py-1">
                                                <iconify-icon icon="material-symbols-light:download-rounded" class="fs-18 text-primary"></iconify-icon>
                                                {{ $attachment['file_rental_support'] }}
                                            </span>
                                        </a>
                                    @endif

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
                                :options="['Leasehold', 'Freehold']" :selected="old('legal_category', $data_properties->legal_status ?? '')" />

                            <div class="row">
                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4" id="freehold_group">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Freehold (Hak Milik)</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <x-form-input className="col-lg-6" type="text" name="freehold_purchase_date" label="Purchase Date" value="{{ $data_properties->purchase_date }}" />

                                        <x-form-input className="col-lg-6" type="text" name="freehold_certificate_number" label="Certificate Number" value="{{ $data_properties->holder_number }}" />
                                        <x-form-input className="col-lg-6" type="text" name="freehold_certificate_holder_name" label="Certificate Holder Name" value="{{ $data_properties->holder_name }}" />

                                        <div class="col-lg-6 mb-3">
                                            <div class="row">
                                                <label for="" class="form-label">Zoning</label>
                                                <div class="col-12">
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input" type="radio" name="freehold_zoning" id="freehold_green_zone" value="Green Zone" {{ $data_properties->zoning == 'Green Zone' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="freehold_green_zone">Green Zone</label>
                                                    </div>
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input" type="radio" name="freehold_zoning" id="freehold_yellow_zone" value="Yellow Zone" {{ $data_properties->zoning == 'Yellow Zone' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="freehold_yellow_zone">Yellow Zone</label>
                                                    </div>
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input" type="radio" name="freehold_zoning" id="freehold_pink_zone" value="Pink Zone" {{ $data_properties->zoning == 'Pink Zone' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="freehold_pink_zone">Pink Zone</label>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4" id="leasehold_group">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Leasehold (Hak Sewa)</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <x-form-input className="col-lg-6" type="text" name="leasehold_start_date" label="Start Date" value="{{ $data_properties->start_date }}" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_end_date" label="End Date" value="{{ $data_properties->end_date }}" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_contract_number" label="Contract Number" value="{{ $data_properties->holder_number }}" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_contract_holder_name" label="Contract Holder Name" value="{{ $data_properties->holder_name }}" />

                                    </div>
                                </div>

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4" id="extension_leasehold_group">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Extension Details</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <x-form-input className="col-lg-6" type="text" name="leasehold_negotiation_ext_cost" label="Negotiation Extension Cost" value="{{ $data_properties->extension_cost }}" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_purchase_cost" label="Purchase Cost" value="{{ $data_properties->purchase_cost }}" />
                                        <x-form-input className="col-lg-6" type="text" name="leasehold_deadline_payment" label="Deadline for Payment to Secure this Rate" value="{{ $data_properties->deadline_payment }}" />

                                        <div class="col-lg-6 mb-3">
                                            <div class="row">
                                                <label for="" class="form-label">Zoning</label>
                                                <div class="col-12">
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input" type="radio" name="leasehold_zoning" id="leasehold_green_zone" value="Green Zone" {{ $data_properties->zoning == 'Green Zone' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="leasehold_green_zone">Green Zone</label>
                                                    </div>
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input" type="radio" name="leasehold_zoning" id="leasehold_yellow_zone" value="Yellow Zone" {{ $data_properties->zoning == 'Yellow Zone' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="leasehold_yellow_zone">Yellow Zone</label>
                                                    </div>
                                                    <div class="form-check form-check">
                                                        <input class="form-check-input" type="radio" name="leasehold_zoning" id="leasehold_pink_zone" value="Pink Zone" {{ $data_properties->zoning == 'Pink Zone' ? 'checked' : '' }}>
                                                        <label class="form-check-label" for="leasehold_pink_zone">Pink Zone</label>
                                                    </div>
                                                </div>
                                            </div>
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

                                <x-form-input className="col-lg-6" type="text" name="idr_price" label="Desired Selling Price" value="{{ $data_properties->selling_price_idr }}" />
                                {{-- <x-form-input className="col-lg-6" type="text" name="usd_price" label="Estimated USD Conversion" value="{{ $data_properties->selling_price_usd }}" disabled="true" /> --}}
                                <x-form-input className="col-lg-6" type="text" name="usd_price" label="Estimated USD Conversion" disabled="true" />

                                <input type="hidden" name="usd_price" id="usd_price_raw">

                                <x-form-input className="col-lg-4" type="text" name="commision_rate" label="Commision Rate (%)" value="4%" disabled="true" />

                                <x-form-input className="col-lg-4" type="text" name="estimated_commision_idr" label="Est. Commision Ammount" value="0" disabled="true" />
                                <x-form-input className="col-lg-4" type="text" name="estimated_commision_usd" label="Est. Commision Ammount" value="$0" disabled="true" />

                                <x-form-input className="col-lg-6" type="text" name="net_seller_price_idr" label="Net Seller price (Excluding Commision)" value="IDR 0" disabled="true" />
                                <x-form-input className="col-lg-6" type="text" name="net_seller_price_usd" label="Net Seller price (Excluding Commision)" value="$0" disabled="true" />
                                <p id="exchange_rate_info">Loading exchange rate...</p>

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
                                                <input class="form-check-input" type="radio" name="type_mandate" id="esstentials_mandate" value="Essentials Mandate" {{ $data_properties->type_mandate == 'Essentials Mandate' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="esstentials_mandate">Essentials Mandate</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate" {{ $data_properties->type_mandate == 'Booster Mandate' ? 'checked' : '' }}>
                                                <label class="form-check-label" for="booster_mandate">Booster Mandate</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-lg-12 mb-3">
                                    <label for="file_type_of_mandate" class="form-label">Supporting Document</label>
                                    <input type="file" id="file_type_of_mandate" name="file_type_of_mandate" class="form-control mb-2" placeholder="">

                                    @if (isset($attachment['file_type_of_mandate']))
                                        <a href="{{ asset('admin/attachment/' . $data_properties->property_slug . '/' . $attachment['file_type_of_mandate']) }}">
                                            <span class="badge bg-light-subtle text-muted fw-medium fs-13 d-flex align-items-center flex-nowrap border px-2 py-1">
                                                <iconify-icon icon="material-symbols-light:download-rounded" class="fs-18 text-primary"></iconify-icon>
                                                {{ $attachment['file_type_of_mandate'] }}
                                            </span>
                                        </a>
                                    @endif

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

                                <div class="col-lg-12 d-block mb-3">
                                    <label for="gallery" class="form-label d-block">Property Gallery </label>

                                    @foreach ($image_gallery as $gallery)
                                        <a href="{{ asset($gallery->image_path) }}" class="glightbox" data-gallery="property-gallery">
                                            <img src="{{ asset($gallery->image_path) }}" width="130" style="margin: 6px; width: 5rem; max-height: 5rem; object-fit:cover; border-radius: 10px">
                                        </a>
                                    @endforeach

                                    <div class="row">
                                        <div class="col-12">
                                            <a href="{{ route('gallery.edit', $image_gallery[0]->gallery_id) }}" class="btn btn-sm btn-primary">Edit Gallery</a>

                                        </div>
                                    </div>

                                </div>

                                <x-form-input className="col-lg-12" type="text" name="url_virtual_tour" label="Virtual Tour Link" placeholder="Input Youtube URL" value="{{ $attachment['url_virtual_tour'] }}" />
                                <x-form-input className="col-lg-12" type="text" name="url_lifestyle" label="Lifestyle" placeholder="Input Youtube URL" value="{{ $attachment['url_lifestyle'] }}" />
                                <x-form-input className="col-lg-12" type="text" name="url_experience" label="Experience" placeholder="Input Youtube URL" value="{{ $attachment['url_experience'] }}" />

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

    <script src="{{ asset('admin/assets/js/glightbox.min.js') }}"></script>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>

    <script>
        let ownerIndex = {{ count($property_owner) }};

        function addOwner() {
            const container = document.getElementById('owners-container');

            const newBlock = document.createElement('div');
            newBlock.className = 'owner-block border rounded p-3 mb-3 position-relative';
            newBlock.dataset.index = ownerIndex;

            newBlock.innerHTML = `
            <button type="button" class="btn-close position-absolute top-0 end-0 m-2" onclick="removeOwner(this)" aria-label="Close"></button>

            <h5 class="text-dark fw-semibold"><i class="ri-user-line"></i> Owner ${ownerIndex + 1}</h5>
            <hr>
            <div class="row">
                <input type="hidden" name="owners[${ownerIndex}][id]" value="">
                <div class="col-lg-6 mb-2">
                    <label class="form-label">First Name</label>
                    <input class="form-control" type="text" name="owners[${ownerIndex}][first_name]">
                </div>
                <div class="col-lg-6 mb-2">
                    <label class="form-label">Last Name</label>
                    <input class="form-control" type="text" name="owners[${ownerIndex}][last_name]">
                </div>
                <div class="col-lg-6 mb-2">
                    <label class="form-label">Phone Number</label>
                    <input class="form-control" type="number" name="owners[${ownerIndex}][phone_number]">
                </div>
                <div class="col-lg-6 mb-2">
                    <label class="form-label">Email</label>
                    <input class="form-control" type="text" name="owners[${ownerIndex}][email]">
                </div>
            </div>
        `;

            container.appendChild(newBlock);
            ownerIndex++;
        }

        function removeOwner(button) {
            const ownerBlock = button.closest('.owner-block');

            const hiddenIdInput = ownerBlock.querySelector('input[name^="owners"][name$="[id]"]');
            if (hiddenIdInput && hiddenIdInput.value) {
                // Jika owner memiliki ID (artinya sudah tersimpan di database), tandai untuk dihapus
                const deletedInput = document.createElement('input');
                deletedInput.type = 'hidden';
                deletedInput.name = 'owners_deleted[]';
                deletedInput.value = hiddenIdInput.value;
                document.getElementById('owners-container').appendChild(deletedInput);
            }

            // Hapus elemen blok owner
            ownerBlock.remove();
        }
    </script>

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
            //   const oldLegalCategory = "{{ old('legal_category') }}";
            const oldLegalCategory = "{{ $data_properties->legal_status }}";

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
    {{-- /* Custom Toggle */ --}}

    {{-- Convert IDR to USD --}}
    <script>
        const defaultKurs = 15000;
        const cacheKey = 'usd_to_idr_rate';
        const cacheTimeKey = 'usd_to_idr_rate_time';
        const cacheTTL = 10 * 60 * 1000; // 10 minutes

        function debounce(func, delay) {
            let timeout;
            return function(...args) {
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
            if (idrValue < 15000000000) {
                commissionRateInput.value = '5%';
                commissionPercent = 0.05;
            } else if (idrValue >= 15000000000 && idrValue <= 34000000000) {
                commissionRateInput.value = '4%';
                commissionPercent = 0.04;
            } else if (idrValue > 34000000000 && idrValue <= 70000000000) {
                commissionRateInput.value = '4%';
                commissionPercent = 0.04;
            } else {
                commissionRateInput.value = '2.5%';
                commissionPercent = 0.025;
            }

            if (idrValue <= 0) return;

            const rate = await getExchangeRate();
            document.getElementById('exchange_rate_info').textContent = `1 USD = ${formatCurrency(rate, 'id-ID', 'IDR', 0)}`;
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

        document.addEventListener('DOMContentLoaded', () => {
            const idrInput = document.getElementById('idr_price');
            if (idrInput && idrInput.value) {
                // Panggil langsung saat halaman edit terbuka
                handleIDRInput();
            }

            idrInput.addEventListener('input', debounce(handleIDRInput, 400));
        });
    </script>

    {{-- /* Convert IDR to USD --}}

    <script>
        $("#leasehold_start_date").flatpickr({
            dateFormat: "d-m-Y"
        });
        $("#leasehold_end_date").flatpickr({
            dateFormat: "d-m-Y"
        });
        $("#freehold_purchase_date").flatpickr({
            dateFormat: "d-m-Y"
        });
        $("#leasehold_deadline_payment").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>

    {{-- Region & Sub Region --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const regionSelect = document.getElementById('region');
            const subregionSelect = document.getElementById('subregion');

            const regionChoices = new Choices(regionSelect, {
                searchEnabled: false,
                shouldSort: false
            });
            const subregionChoices = new Choices(subregionSelect, {
                searchEnabled: false,
                shouldSort: false
            });

            const selectedRegion = "{{ old('region', $data_properties->region ?? '') }}".toLowerCase();
            const selectedSubregion = "{{ old('subregion', $data_properties->sub_region ?? '') }}";

            const url = "{{ route('api.regions') }}"; // Ganti dari asset() ke route()

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const regions = Object.keys(data);

                    // Populate region dropdown
                    regionChoices.setChoices(
                        regions.map(region => ({
                            value: region,
                            label: region.charAt(0).toUpperCase() + region.slice(1)
                        })),
                        'value',
                        'label',
                        true
                    );

                    // Set selected region dan subregion (jika ada)
                    if (selectedRegion && regions.includes(selectedRegion)) {
                        regionChoices.setChoiceByValue(selectedRegion);

                        const subregions = data[selectedRegion];
                        subregionChoices.setChoices(
                            subregions.map(sub => ({
                                value: sub,
                                label: sub
                            })),
                            'value',
                            'label',
                            true
                        );

                        if (selectedSubregion) {
                            subregionChoices.setChoiceByValue(selectedSubregion);
                        }
                    }

                    // On region change
                    regionSelect.addEventListener('change', function() {
                        const selected = this.value;
                        const subregions = data[selected] || [];

                        subregionChoices.clearChoices();
                        subregionChoices.setChoices(
                            subregions.map(sub => ({
                                value: sub,
                                label: sub
                            })),
                            'value',
                            'label',
                            true
                        );
                    });
                })
                .catch(error => {
                    console.error("Failed to load region data:", error);
                });
        });
    </script>

    {{-- Region & Sub Region --}}

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
        galleryForm.addEventListener('submit', function(e) {
            updateOrder(); // pastikan order diperbarui dulu
        });
    </script>
    {{-- /* Gallery Upload */ --}}
@endpush
