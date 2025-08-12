@extends('admin.layouts.master')
@push('style')
    <style>
        .choices {
            margin-bottom: 0px;
        }

        #lease_duration_group {
            display: none !important;
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
                        <h4 class="fw-semibold mb-0">Add Villa</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="/properties">Villa </a></li>
                            <li class="breadcrumb-item active">Add Villa</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex flex-row flex-wrap gap-2">
                    @if ($errors->any())
                        @foreach ($errors->all() as $error)
                            <div class="alert alert-danger fs-11 m-0 p-1">
                                {{ $error }}
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>

            <div class="row mb-4">
                <div class="accordion" id="accordionExample">

                    <!-- Owners -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fs-18 fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                Owners
                            </button>
                        </h2>
                        <div id="collapseOne" class="accordion-collapse show collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex justify-content-between align-items-start px-4">
                                <div class="bg-light-subtle border-dark col-4 row rounded border p-3">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Owner 1</h5>
                                    <hr>
                                    <div class="row m-0 mb-2 p-0">
                                        <div class="col-6 mb-1 p-1" id="group_owners[0][first_name]">
                                            <label for="owners[0][first_name]" class="form-label">First Name</label>

                                            <input type="text" id="owners[0][first_name]" name="owners[0][first_name]" class="form-control @error('owners.0.first_name') validation-form @enderror" placeholder="Input First Name" value="{{ old('owners.0.first_name') }}">

                                            @error('owners.0.first_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-1 p-1" id="group_owners[0][last_name]">
                                            <label for="owners[0][last_name]" class="form-label">Last Name</label>

                                            <input type="text" id="owners[0][last_name]" name="owners[0][last_name]" class="form-control @error('owners.0.last_name') validation-form @enderror" placeholder="Input Last Name" value="{{ old('owners.0.last_name') }}">

                                            @error('owners.0.last_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-1 p-1" id="group_owners[0][email]">
                                            <label for="owners[0][email]" class="form-label">Email</label>

                                            <input type="text" id="owners[0][email]" name="owners[0][email]" class="form-control @error('owners.0.email') validation-form @enderror" placeholder="Input Email" value="{{ old('owners.0.email') }}">

                                            @error('owners.0.email')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-1 p-1" id="group_owners[0][phone_number]">
                                            <label for="owners[0][phone_number]" class="form-label">Phone Number</label>

                                            <input type="text" id="owners[0][phone_number]" name="owners[0][phone_number]" class="form-control @error('owners.0.phone_number') validation-form @enderror" placeholder="Input Phone Number" value="{{ old('owners.0.phone_number') }}">

                                            @error('owners.0.phone_number')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <div class="bg-light-subtle border-dark col-4 row rounded border p-3">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Owner 2</h5>
                                    <hr>

                                    <div class="row m-0 mb-2 p-0">

                                        <div class="col-6 mb-1 p-1" id="group_owners[1][first_name]">
                                            <label for="owners[1][first_name]" class="form-label">First Name</label>

                                            <input type="text" id="owners[1][first_name]" name="owners[1][first_name]" class="form-control @error('owners.1.first_name') validation-form @enderror" placeholder="Input First Name" value="{{ old('owners.1.first_name') }}">

                                            @error('owners.1.first_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-1 p-1" id="group_owners[1][last_name]">
                                            <label for="owners[1][last_name]" class="form-label">Last Name</label>

                                            <input type="text" id="owners[1][last_name]" name="owners[1][last_name]" class="form-control @error('owners.1.last_name') validation-form @enderror" placeholder="Input Last Name" value="{{ old('owners.1.last_name') }}">

                                            @error('owners.1.last_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-1 p-1" id="group_owners[1][email]">
                                            <label for="owners[1][email]" class="form-label">Email</label>

                                            <input type="text" id="owners[1][email]" name="owners[1][email]" class="form-control @error('owners.1.email') validation-form @enderror" placeholder="Input Email" value="{{ old('owners.1.email') }}">

                                            @error('owners.1.email')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="col-6 mb-1 p-1" id="group_owners[1][phone_number]">
                                            <label for="owners[1][phone_number]" class="form-label">Phone Number</label>

                                            <input type="text" id="owners[1][phone_number]" name="owners[1][phone_number]" class="form-control @error('owners.1.phone_number') validation-form @enderror" placeholder="Input Phone Number" value="{{ old('owners.1.phone_number') }}">

                                            @error('owners.1.phone_number')
                                                <div class="alert alert-danger fs-11 m-0 p-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                    </div>
                                </div>
                                <div class="bg-light-subtle border-dark col-4 row rounded border p-3">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Legal Entity (if applicable): PT PMA</h5>
                                    <hr>
                                    <div class="row">

                                        <x-form-input className="p-1 col-12" type="text" name="company_name" label="Company Name" />
                                        <x-form-input className="p-1 col-6" type="text" name="legal_rep_first_name" label="Owner First Name" />
                                        <x-form-input className="p-1 col-6" type="text" name="legal_rep_last_name" label="Owner Last Name" />
                                        <x-form-input className="p-1 col-6" type="email" name="legal_rep_email" label="Email" />
                                        <x-form-input className="p-1 col-6" type="number" name="legal_rep_phone_number" label="Phone Number" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <!-- Villa -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button fs-18 fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Villa
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex align-items-start justify-content-between gap-4 px-4">

                                <div class="col-6 row bg-light-subtle border-dark rounded border p-3">
                                    <div class="col-lg-6 mb-3" id="group_internal_reference">
                                        <label for="internal_reference" class="form-label">Internal Reference</label>
                                        <input type="text" class="form-control" placeholder="Internal Reference" disabled value="{{ Auth::user()->reference_code }}">
                                    </div>

                                    <x-form-input className="col-lg-6" type="text" name="property_name" label="Property Name" />

                                    <div class="col-lg-4 mb-3" id="group_area">
                                        <label for="area" class="form-label">Area</label>
                                        <select id="area" class="form-select" name="area">
                                            <option value="" selected disabled>Select Area</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 mb-3" id="group_region">
                                        <label for="region" class="form-label">Region</label>
                                        <select id="region" class="form-select" name="region">
                                            <option value="" selected disabled>Select Region</option>
                                        </select>
                                    </div>

                                    <div class="col-lg-4 mb-3" id="group_region">
                                        <label for="region" class="form-label">Sub Region</label>
                                        <select id="subregion" class="form-select" name="subregion">
                                            <option value="" selected disabled>Select Region First </option>
                                        </select>
                                    </div>

                                    <div class="col-lg-12 mb-3" id="group_property_address">
                                        <label for="property_address" class="form-label">Property Address</label>
                                        <textarea class="form-control" id="property_address" name="property_address" rows="1" placeholder="Enter address">{{ old('property_address') }}</textarea>
                                    </div>

                                    <div class="col-lg-12 mb-3" id="group_description">
                                        <label for="description" class="form-label">Description</label>
                                        <textarea class="form-control" id="description" name="description" rows="3" placeholder="Enter description">{{ old('description') }}</textarea>
                                    </div>

                                    <x-form-input className="col-lg-4" type="text" name="land_size" label="Total Land Area (m²)" placeholder="Input Land Size" />
                                    <x-form-input className="col-lg-4" type="text" name="built_area" label="Villa Area (m²)" placeholder="Input Villa Area" />
                                    <x-form-input className="col-lg-4" type="text" name="pool_area" label="Pool Area (m²)" placeholder="Input Pool Area" />

                                    <x-form-input className="col-lg-6" type="number" name="bedroom" label="Bedroom" />
                                    <x-form-input className="col-lg-6" type="number" name="bathroom" label="Bathroom" />

                                    <x-form-input className="col-lg-6" type="number" name="year_construction" label="Year of Construction" placeholder="Input the Year of Construction" />
                                    <x-form-input className="col-lg-6" type="number" name="year_renovated" label="Year of Last Renovation" placeholder="Input the Year of Renovation" />

                                </div>
                                <div class="col-6 row bg-light-subtle border-dark rounded border p-3">

                                    <div class="mb-4">
                                        <h5 class="text-dark fw-semibold">Type of mandat *</h5>
                                        <hr>

                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="esstentials_mandate" value="essentials mandate" {{ old('type_mandate') == 'essentials mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="esstentials_mandate">Essentials</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="booster mandate" {{ old('type_mandate') == 'booster mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="booster_mandate">Booster</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="max_booster_mandate" value="max booster mandate" {{ old('type_mandate') == 'max booster mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="max_booster_mandate">Max Booster</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <input type="file" id="file_type_of_mandate" name="file_type_of_mandate" class="form-control" placeholder="">
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <h5 class="text-dark fw-semibold">Construction quality *</h5>
                                        <hr>

                                        <div class="row">
                                            <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="construction_quality" id="construction_quality_invest" value="invest" {{ old('type_mandate') == 'invest' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="construction_quality_invest">Invest</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="construction_quality" id="construction_quality_comfort" value="comfort" {{ old('type_mandate') == 'comfort' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="construction_quality_comfort">Comfort</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="construction_quality" id="construction_quality_premium" value="premium" {{ old('type_mandate') == 'premium' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="construction_quality_premium">Premium</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <x-form-input type="text" name="constructor_name" label="Constructor name" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <h5 class="text-dark fw-semibold">Property legal category *</h5>
                                        <hr>

                                        <div class="row align-items-center">                                            
                                            <div class="col-12">

                                                <x-form-select className="col-lg-12" name="legal_category" label="Property category" :options="['Leasehold', 'Freehold']" />

                                                <div class="row mb-0">
                                                    <div class="bg-light-subtle border-dark rounded border p-2" id="freehold_group">
                                                        <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Freehold (Hak Milik)</h5>
                                                        <hr>
                                                        <div class="row">

                                                            <x-form-input className="col-lg-6" type="text" name="freehold_purchase_date" label="Purchase Date" />
                                                            <x-form-input className="col-lg-6" type="text" name="freehold_certificate_number" label="Certificate Number" />
                                                            <x-form-input className="col-lg-6" type="text" name="freehold_certificate_holder_name" label="Certificate Holder Name" />

                                                            <div class="col-lg-6">
                                                                <div class="row">
                                                                    <label for="" class="form-label">Zoning</label>
                                                                    <div class="col-12">
                                                                        <div class="form-check form-check">
                                                                            <input class="form-check-input" type="radio" name="freehold_zoning" id="freehold_green_zone" value="Green Zone" {{ old('freehold_zoning') == 'Green Zone' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="freehold_green_zone">Green Zone</label>
                                                                        </div>
                                                                        <div class="form-check form-check">
                                                                            <input class="form-check-input" type="radio" name="freehold_zoning" id="freehold_yellow_zone" value="Yellow Zone" {{ old('freehold_zoning') == 'Yellow Zone' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="freehold_yellow_zone">Yellow Zone</label>
                                                                        </div>
                                                                        <div class="form-check form-check">
                                                                            <input class="form-check-input" type="radio" name="freehold_zoning" id="freehold_pink_zone" value="Pink Zone" {{ old('freehold_zoning') == 'Pink Zone' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="freehold_pink_zone">Pink Zone</label>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>
                                                    </div>

                                                    <div class="bg-light-subtle border-dark mb-1 rounded border p-2" id="leasehold_group">
                                                        <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Leasehold (Hak Sewa)</h5>
                                                        <hr>
                                                        <div class="row">

                                                            <x-form-input className="col-lg-6" type="text" name="leasehold_start_date" label="Start Date" />
                                                            <x-form-input className="col-lg-6" type="text" name="leasehold_end_date" label="End Date" />

                                                            <x-form-input className="col-lg-6" type="text" name="leasehold_contract_number" label="Contract Number" />
                                                            <x-form-input className="col-lg-6" type="text" name="leasehold_contract_holder_name" label="Contract Holder Name" />

                                                        </div>
                                                    </div>

                                                    <div class="bg-light-subtle border-dark rounded border p-2" id="extension_leasehold_group">
                                                        <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Extension Details</h5>
                                                        <hr>
                                                        <div class="row">

                                                            <x-form-input className="col-lg-6" type="text" name="leasehold_negotiation_ext_cost" label="Negotiation Extension Cost" />
                                                            <x-form-input className="col-lg-6" type="text" name="leasehold_purchase_cost" label="Purchase Cost" />
                                                            <x-form-input className="col-lg-6" type="text" name="leasehold_deadline_payment" label="Deadline for Payment to Secure this Rate" />

                                                            <div class="col-lg-6">
                                                                <div class="row">
                                                                    <label for="" class="form-label">Zoning</label>
                                                                    <div class="col-12">
                                                                        <div class="form-check form-check">
                                                                            <input class="form-check-input" type="radio" name="leasehold_zoning" id="leasehold_green_zone" value="Green Zone" {{ old('leasehold_zoning') == 'Green Zone' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="leasehold_green_zone">Green Zone</label>
                                                                        </div>
                                                                        <div class="form-check form-check">
                                                                            <input class="form-check-input" type="radio" name="leasehold_zoning" id="leasehold_yellow_zone" value="Yellow Zone" {{ old('leasehold_zoning') == 'Yellow Zone' ? 'checked' : '' }}>
                                                                            <label class="form-check-label" for="leasehold_yellow_zone">Yellow Zone</label>
                                                                        </div>
                                                                        <div class="form-check form-check">
                                                                            <input class="form-check-input" type="radio" name="leasehold_zoning" id="leasehold_pink_zone" value="Pink Zone" {{ old('leasehold_zoning') == 'Pink Zone' ? 'checked' : '' }}>
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
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>

                    <br />
                    <!-- Furnitures -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fs-18 fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFurnitures" aria-expanded="true" aria-controls="collapseOne">
                                Furnitures
                            </button>
                        </h2>
                        <div id="collapseFurnitures" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex align-items-start justify-content-between gap-4 px-4">

                                <div class="col-6 row bg-light-subtle border-dark rounded border p-3">
                                    <h5 class="text-dark fw-semibold">Indoor *</h5>
                                    <hr>
                                    <div class="row px-2 pb-2">
                                        @foreach ($feature_list_indoor as $feature_indoor)
                                            <x-form-checkbox className="form-check col-6 pt-2" name="feature[{{ $feature_indoor->slug }}]" label="{{ $feature_indoor->name }}" />
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-6 row bg-light-subtle border-dark rounded border p-3">
                                    <h5 class="text-dark fw-semibold">Outdoor *</h5>
                                    <hr>
                                    <div class="row px-2 pb-2">

                                        @foreach ($feature_list_outdoor as $feature_outdoor)
                                            <x-form-checkbox className="form-check col-6 pt-2" name="feature[{{ $feature_outdoor->slug }}]" label="{{ $feature_outdoor->name }}" />
                                        @endforeach

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <!-- Rental yield -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fs-18 fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseRentalYield" aria-expanded="true" aria-controls="collapseOne">
                                Rental yield
                            </button>
                        </h2>
                        <div id="collapseRentalYield" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex align-items-start justify-content-between gap-4 px-4">

                                <div class="col-12 row bg-light-subtle border-dark gap-4 rounded border p-3">
                                    <div class="col-6 row align-content-start">
                                        <h5 class="text-dark fw-semibold">Do you have any data about the rental of the property ? </h5>
                                        <hr>
                                        <p class="text-dark">Average Nightly Rate / Average Occupancy Rate / Estimated Annual Turnover etc.</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="average_price_status" id="yes" value="yes">
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="average_price_status" id="no" value="no">
                                                    <label class="form-check-label" for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 row" id="rentalDataFields" style="display: none">
                                        <h5 class="text-dark fw-semibold">Choose for calculate</h5>
                                        <hr>
                                        
                                        <!-- Radio buttons for calculation type -->
                                        <div class="col-12 mb-3">
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="average_price_option" id="Daily" value="Daily">
                                                <label class="form-check-label" for="Daily">Daily</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="average_price_option" id="Monthly" value="Monthly">
                                                <label class="form-check-label" for="Monthly">Monthly</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="average_price_option" id="Yearly" value="Yearly">
                                                <label class="form-check-label" for="Yearly">Yearly</label>
                                            </div>
                                        </div>

                                        <!-- Average price input with dynamic label -->
                                        <div class="col-12 mb-1">
                                            <label class="form-label" id="averagePriceLabel">Average price (IDR)</label>
                                            <input type="text" name="average_price" id="average_price" class="form-control" placeholder="(IDR) Average price (e.g., 1.000.000)"/>
                                        </div>

                                        <!-- Average occupancy rate input (only visible for Daily option) -->
                                        <div class="col-12 mb-1" id="occupancyRateField" style="display: none;">
                                            <label class="form-label">Average occupation rate (%)</label>
                                            <input type="number" name="average_occupancy_rate" id="average_occupancy_rate" class="form-control" placeholder="Average occupation rate in percentage" min="0" max="100" step="0.1"/>
                                            <div class="form-text">Enter percentage value (e.g., 75 for 75%)</div>
                                        </div>

                                        <!-- Annual turnover (readonly, calculated automatically) -->
                                        <div class="col-12 mb-1">
                                            <label class="form-label">Annual turnover (IDR)</label>
                                            <input type="text" name="annual_turnover" id="annual_turnover" class="form-control" placeholder="Annual turnover" style="background: #f9f9fc" readonly/>
                                        </div>

                                        <!-- Display calculation formula -->
                                        <div class="col-12 mb-1">
                                            <div class="alert alert-info" id="calculationFormula" style="display: none;">
                                                <small id="formulaText"></small>
                                            </div>
                                        </div>
                                        
                                        <!-- Supporting document upload -->
                                        <div class="col-12 mb-3">
                                            <label class="form-check-label" for="file_rental_support">Supporting document</label>
                                            <input type="file" id="file_rental_support" name="file_rental_support" class="form-control" placeholder="">
                                        </div>

                                        
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                    <br />
                    <!-- Sale price and conditions -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fs-18 fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseSalePrice" aria-expanded="true" aria-controls="collapseOne">
                                Sale price and conditions
                            </button>
                        </h2>
                        <div id="collapseSalePrice" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex align-items-start justify-content-between gap-4 px-4">
                                <!-- PILIHAN AGENT / OWNER -->
                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 py-2">
                                    <h5 class="text-dark fw-semibold">How did you find the property?</h5>
                                    <hr>
                                    <div class="col-12 mb-3">
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="find_property" id="by_owner" value="owner">
                                            <label class="form-check-label" for="by_owner">Owner of the villa</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="find_property" id="by_agent" value="agent">
                                            <label class="form-check-label" for="by_agent">By an agent</label>
                                        </div>
                                    </div>

                                    <!-- Jika by agent -->
                                    <div id="agent_fields" style="display: none;">
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Name of this agent</label>
                                            <input type="text" name="agent_name" class="form-control" />
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Email of this agent</label>
                                            <input type="text" name="agent_email" class="form-control" />
                                        </div>
                                        <div class="col-12 mb-2">
                                            <label class="form-label">Whatsapp of this agent</label>
                                            <input type="text" name="agent_whatsapp" class="form-control" />
                                        </div>
                                    </div>
                                </div>

                                <!-- FORM UTAMA -->
                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 py-2" id="common_fields" style="display: none;">
                                    <h5 class="text-dark fw-semibold" id="form_title">Property Details</h5>
                                    <hr>

                                    <!-- BASE PRICE -->
                                    <div class="col-12">
                                        <label class="form-label">What's the base price?</label><br />
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="base_price" id="base_price_1" value="NET saler">
                                            <label class="form-check-label" for="base_price_1">NET saler</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="base_price" id="base_price_2" value="Selling price">
                                            <label class="form-check-label" for="base_price_2">Selling price</label>
                                        </div>
                                    </div>

                                    <!-- BASE PRICE -->
                                    <div class="col-12 mt-2">
                                        <label>Base price (IDR)</label>
                                        <input type="text" class="form-control" id="desire_price_from_the_owner" name="desire_price_from_the_owner" placeholder="IDR">
                                    </div>

                                    <!-- FULL COMMISSION (AGENT ONLY) -->
                                    <div id="agent_commission_fields" style="display: none;" class="col-12 mt-2">
                                        <label>Full Balimmo commission?</label><br />
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="full_commission_balimmo" id="commission_balimmo_yes" value="Yes">
                                            <label class="form-check-label" for="commission_balimmo_yes">Yes</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="full_commission_balimmo" id="commission_balimmo_no" value="No">
                                            <label class="form-check-label" for="commission_balimmo_no">No</label>
                                        </div>
                                    </div>

                                    <!-- COMMISSIONS -->
                                    <div class="row" id="agent_commission_row" style="display: none;">
                                        <div class="col-6 mt-2" id="agent_commission_field">
                                            <label>Commission of the agent (%)</label>
                                            <input type="text" id="commission_of_the_agent" name="commission_of_the_agent" class="form-control" />
                                        </div>
                                        
                                        <div class="col-6 mt-2" id="agent_commission_field_idr">
                                            <label>Commission of the agent (IDR)</label>
                                            <input type="text" id="commission_of_the_agent_idr" name="commission_of_the_agent_idr" class="form-control" style="background: #f9f9fc" readonly/>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col-6 mt-2">
                                            <label>Balimmo commission (%)</label>
                                            <input type="text" id="balimmo_commission" name="balimmo_commission" class="form-control" placeholder="%" />
                                        </div>

                                        <div class="col-6 mt-2">
                                            <label>Balimmo commission (IDR)</label>
                                            <input type="text" id="balimmo_commission_idr" name="balimmo_commission_idr" class="form-control" placeholder="IDR" style="background: #f9f9fc" readonly/>
                                        </div>

                                        <!-- <div class="col-4 mt-2">
                                            <label>Min Balimmo commission (%)</label>
                                            <input type="text" id="minimum_balimmo_commission" name="minimum_balimmo_commission" class="form-control" placeholder="%" disabled/>
                                        </div> -->
                                    </div>

                                    <!-- WEBSITE PRICE -->
                                    <div class="col-12 mt-2">
                                        <label>Website price (calculated)</label>
                                        <input type="text" name="website_price" id="website_price" class="form-control" style="background: #f9f9fc" readonly />
                                    </div>

                                    <div class="row">
                                        <!-- PRICE TO OWNER (NEW FIELD) -->
                                        <div class="col-6 mt-2">
                                            <label>Price to Owner</label>
                                            <input type="text" name="price_to_owner" id="price_to_owner" class="form-control" style="background: #f9f9fc" readonly />
                                        </div>

                                        <!-- NET PROFIT (Always visible now) -->
                                        <div class="col-6 mt-2" id="profit_wrapper">
                                            <label>Net Profit / Margin (Estimated)</label>
                                            <input type="text" name="net_profit" id="net_profit" class="form-control" style="background: #f9f9fc" readonly />
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <!-- Photos and videos -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingOne">
                            <button class="accordion-button fs-18 fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseGallery" aria-expanded="true" aria-controls="collapseOne">
                                Photos and videos
                            </button>
                        </h2>
                        <div id="collapseGallery" class="accordion-collapse collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex align-items-start justify-content-between gap-4 px-4">

                                <div class="col-6 row bg-light-subtle border-dark rounded border p-2">
                                    <h5 class="text-dark fw-semibold">Plan shooting</h5>
                                    <hr>
                                    <button type="button" class="btn btn-primary" style="width: fit-content">Book shooting on calendar</button>
                                </div>

                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 py-2">
                                    <h5 class="text-dark fw-semibold">Publish photos and videos</h5>
                                    <hr>
                                    <div class="row">
                                        <div class="col-lg-12">
                                            <label for="gallery" class="form-label">Property Gallery</label>

                                            <input type="file" name="images[]" id="imageInput" multiple accept="image/*" class="form-control mb-1">

                                            <div id="previewContainer" class="d-flex flex-wrap gap-2">
                                                @if (session('old_images'))
                                                    @foreach (session('old_images') as $index => $img)
                                                        <div class="img-preview" data-index="{{ $index }}">
                                                            <img src="{{ asset('tmp_uploads/' . Auth::user()->reference_code . '/' . $img) }}" alt="Preview"
                                                                style="width: 130px; height: 5rem; aspect-ration: 16 / 9; object-fit: cover; border: 1px solid #ccc; padding: 2px;">
                                                            <p class="mb-0 mt-1 text-center">Image {{ $index + 1 }}</p>
                                                            <input type="hidden" name="old_images[]" value="{{ $img }}">
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>

                                            <input type="hidden" name="order" id="imageOrder">

                                            @error('images')
                                                <div class="alert alert-danger" role="alert">
                                                    {{ $message }}
                                                </div>
                                            @enderror

                                        </div>
                                        <x-form-input className="col-12" type="text" name="url_virtual_tour" label="Visit Tour Link" />
                                        <x-form-input className="col-12" type="text" name="url_lifestyle" label="Lifestyle" />
                                        <x-form-input className="col-12" type="text" name="url_experience" label="Experience" />
                                    </div>

                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="mb-3 rounded">
                <div class="row justify-content-end g-2">
                    <div class="col-lg-2">
                        <a href="/properties" class="btn btn-danger w-100">Cancel</a>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary w-100">Create Villa</button>
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
    

    {{-- {-- PRICE CALCULTAION --} --}}
    <script>
        function parseRupiah(value) {
            return parseFloat(value.replace(/[^0-9]/g, '')) || 0;
        }

        function formatRupiah(value) {
            // Hapus semua karakter non-digit
            const number = value.replace(/[^0-9]/g, '');
            // Format dengan titik pemisah ribuan
            return number.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
        }

        function handleBasePriceInput(event) {
            const input = event.target;
            const cursorPosition = input.selectionStart;
            const oldValue = input.value;
            const oldLength = oldValue.length;
            
            // Format nilai
            const formattedValue = formatRupiah(input.value);
            input.value = formattedValue;
            
            // Hitung posisi cursor baru berdasarkan perubahan panjang
            const newLength = formattedValue.length;
            const lengthDiff = newLength - oldLength;
            const newCursorPosition = cursorPosition + lengthDiff;
            
            // Set posisi cursor yang benar
            input.setSelectionRange(newCursorPosition, newCursorPosition);
        }

        function getBalimmoCommissionRate(price) {
            if (price < 15_000_000_000) return 5;
            if (price < 34_000_000_000) return 4;
            if (price < 70_000_000_000) return 3;
            return 2.5;
        }

        function getBalimmoMinCommission(price) {
            if (price < 15_000_000_000) return 3.5;
            if (price < 34_000_000_000) return 3;
            if (price < 70_000_000_000) return 2.2;
            return 2;
        }

        function isOwnerSelected() {
            return document.getElementById("by_owner").checked;
        }

        function getBasePriceType() {
            const selected = document.querySelector('input[name="base_price"]:checked');
            return selected ? selected.value : "NET saler";
        }

        function updateMinimumBalimmoCommission() {
            const price = parseRupiah(document.getElementById("desire_price_from_the_owner").value);
            const minCommissionInput = document.getElementById("minimum_balimmo_commission");
            
            if (!price || !minCommissionInput) {
                if (minCommissionInput) minCommissionInput.value = "0";
                return;
            }

            const minRate = getBalimmoMinCommission(price);
            minCommissionInput.value = minRate.toFixed(2);
        }

        function calculateBalimmoForAgentNo(price, agentCommission) {
            const fullRate = getBalimmoCommissionRate(price);
            const minRate = getBalimmoMinCommission(price);
            
            // Rumus: Rate penuh dikurangi komisi agent
            let calculatedBalimmo = fullRate - agentCommission;
            
            // Tidak boleh kurang dari minimum
            if (calculatedBalimmo < minRate) {
                calculatedBalimmo = minRate;
            }
            
            // Tidak boleh negatif
            if (calculatedBalimmo < 0) {
                calculatedBalimmo = minRate;
            }
            
            return calculatedBalimmo;
        }

        // FUNGSI BARU: Kalkulasi commission dalam IDR
        function updateCommissionIDR() {
            const price = parseRupiah(document.getElementById("desire_price_from_the_owner").value);
            const agentCommissionPercent = parseFloat(document.getElementById("commission_of_the_agent").value) || 0;
            const balimmoCommissionPercent = parseFloat(document.getElementById("balimmo_commission").value) || 0;
            
            const agentCommissionIdrField = document.getElementById("commission_of_the_agent_idr");
            const balimmoCommissionIdrField = document.getElementById("balimmo_commission_idr");
            
            if (!price) {
                if (agentCommissionIdrField) agentCommissionIdrField.value = "0";
                if (balimmoCommissionIdrField) balimmoCommissionIdrField.value = "0";
                return;
            }
            
            // Kalkulasi commission dalam IDR
            const agentCommissionIdr = price * agentCommissionPercent / 100;
            const balimmoCommissionIdr = price * balimmoCommissionPercent / 100;
            
            // Update field dengan format number
            if (agentCommissionIdrField) {
                agentCommissionIdrField.value = Math.round(agentCommissionIdr).toLocaleString('id-ID');
            }
            if (balimmoCommissionIdrField) {
                balimmoCommissionIdrField.value = Math.round(balimmoCommissionIdr).toLocaleString('id-ID');
            }
        }

        function updateBalimmoCommission(forceUpdate = false) {
            const price = parseRupiah(document.getElementById("desire_price_from_the_owner").value);
            const balimmoInput = document.getElementById("balimmo_commission");
            const agentCommissionInput = document.getElementById("commission_of_the_agent");
            const agentCommission = parseFloat(agentCommissionInput.value) || 0;
            const fullCommission = document.querySelector('input[name="full_commission_balimmo"]:checked')?.value;
            const isAgentFullYes = fullCommission === "Yes";
            const isAgentFullNo = fullCommission === "No";
            const isAgent = document.getElementById("by_agent").checked;
            const isOwner = isOwnerSelected();

            if (!price || !balimmoInput) {
                if (balimmoInput) balimmoInput.value = "0";
                updateMinimumBalimmoCommission();
                updateCommissionIDR(); // TAMBAHAN: Update IDR calculations
                return;
            }

            const rate = getBalimmoCommissionRate(price);
            const minRate = getBalimmoMinCommission(price);
            
            updateMinimumBalimmoCommission();

            // Set field editability
            const canEdit = isOwner || (isAgent && (isAgentFullYes || isAgentFullNo));
            balimmoInput.readOnly = !canEdit;

            // Auto-calculate only on force update (not during manual editing)
            if (forceUpdate) {
                if (isOwner || (isAgent && isAgentFullYes)) {
                    balimmoInput.value = rate.toFixed(2);
                } else if (isAgent && isAgentFullNo) {
                    const calculatedBalimmo = calculateBalimmoForAgentNo(price, agentCommission);
                    balimmoInput.value = calculatedBalimmo.toFixed(2);
                } else if (isAgent) {
                    balimmoInput.value = "0";
                }
            }

            // TAMBAHAN: Update IDR calculations
            updateCommissionIDR();
            calculateWebsitePrice();
        }

        // TAMBAHAN: Fungsi untuk validasi saat blur
        function validateBalimmoCommission() {
            const balimmoInput = document.getElementById("balimmo_commission");
            const price = parseRupiah(document.getElementById("desire_price_from_the_owner").value);
            
            if (!price || !balimmoInput || balimmoInput.readOnly) return;
            
            const minRate = getBalimmoMinCommission(price);
            let val = parseFloat(balimmoInput.value) || 0;
            
            // Validasi dan koreksi nilai
            if (val < minRate) {
                alert(`Balimmo commission cannot be lower than minimum: ${minRate}%`);
                balimmoInput.value = minRate.toFixed(2);
            } else if (val > 100) {
                alert("Balimmo commission cannot exceed 100%");
                balimmoInput.value = "100";
            }
            
            updateCommissionIDR(); // TAMBAHAN: Update IDR setelah validasi
            calculateWebsitePrice();
        }

        function calculateWebsitePrice() {
            const desiredPrice = parseRupiah(document.getElementById("desire_price_from_the_owner").value);
            const agent = parseFloat(document.getElementById("commission_of_the_agent").value) || 0;
            const balimmo = parseFloat(document.getElementById("balimmo_commission").value) || 0;
            const base = getBasePriceType();

            const totalCommissionRate = agent + balimmo;
            const totalCommission = desiredPrice * totalCommissionRate / 100;
            
            let websitePrice = 0;
            let priceToOwner = 0;
            let netProfit = 0;

            const netProfitField = document.getElementById("net_profit");
            const priceToOwnerField = document.getElementById("price_to_owner");

            if (base === "NET saler") {
                // NET saler: Desired price = harga bersih untuk owner
                websitePrice = desiredPrice + totalCommission;
                priceToOwner = desiredPrice; // Sama dengan desired price
                netProfit = totalCommission; // Profit = komisi
            } else {
                // Selling price: Desired price = harga jual
                websitePrice = desiredPrice;
                priceToOwner = desiredPrice - totalCommission; // Dikurangi komisi
                netProfit = totalCommission; // Profit = komisi juga
            }

            // Update display
            document.getElementById("website_price").value = Math.round(websitePrice).toLocaleString('id-ID');
            
            if (priceToOwnerField) {
                priceToOwnerField.value = Math.round(priceToOwner).toLocaleString('id-ID');
            }
            
            if (netProfitField) {
                netProfitField.value = Math.round(netProfit).toLocaleString('id-ID');
            }

            // TAMBAHAN: Update IDR calculations setiap kali website price dikalkulasi
            updateCommissionIDR();
        }

        function setupListeners() {
            const fields = [
                'desire_price_from_the_owner',
                'commission_of_the_agent',
                'balimmo_commission',
                'commission_balimmo_yes',
                'commission_balimmo_no',
                'base_price_1',
                'base_price_2'
            ];

            fields.forEach(id => {
                const el = document.getElementById(id);
                if (el) {
                    if (id === 'desire_price_from_the_owner') {
                        // Khusus untuk base price field - tambahkan formatting
                        el.addEventListener('input', (event) => {
                            handleBasePriceInput(event);
                            updateBalimmoCommission(true);
                            calculateWebsitePrice();
                        });
                        el.addEventListener('change', () => {
                            updateBalimmoCommission(true);
                            calculateWebsitePrice();
                        });
                    } else if (id === 'balimmo_commission') {
                        // Untuk balimmo commission, gunakan input event tanpa force update
                        el.addEventListener('input', () => {
                            updateCommissionIDR(); // TAMBAHAN: Update IDR saat mengetik
                            calculateWebsitePrice(); // Hanya hitung ulang harga, jangan auto-update nilai
                        });
                        
                        // Tambahkan blur event untuk validasi
                        el.addEventListener('blur', validateBalimmoCommission);
                    } else {
                        // Untuk field lain, tetap gunakan force update
                        el.addEventListener('input', () => {
                            updateBalimmoCommission(true);
                            calculateWebsitePrice();
                        });
                        el.addEventListener('change', () => {
                            updateBalimmoCommission(true);
                            calculateWebsitePrice();
                        });
                    }
                }
            });
        }

        window.addEventListener("DOMContentLoaded", () => {
            const ownerRadio = document.getElementById("by_owner");
            const agentRadio = document.getElementById("by_agent");

            function updateFormDisplay() {
                const agentFields = document.getElementById("agent_fields");
                const agentCommissionFields = document.getElementById("agent_commission_fields");
                const agentCommissionRow = document.getElementById("agent_commission_row"); // TAMBAHAN: Referensi ke row agent commission
                const commonFields = document.getElementById("common_fields");

                // Always show common fields if radio is selected
                if (ownerRadio.checked || agentRadio.checked) {
                    commonFields.style.display = "block";
                }

                if (agentRadio.checked) {
                    if (agentFields) agentFields.style.display = "block";
                    agentCommissionFields.style.display = "block";
                    agentCommissionRow.style.display = "flex"; // TAMBAHAN: Tampilkan row agent commission untuk agent
                } else {
                    if (agentFields) agentFields.style.display = "none";
                    agentCommissionFields.style.display = "none";
                    agentCommissionRow.style.display = "none"; // TAMBAHAN: Sembunyikan row agent commission untuk owner
                }

                // Run Commission Calculations on load
                updateBalimmoCommission(true);
                calculateWebsitePrice();
            }

            // Initial Load Run
            updateFormDisplay();

            // On Change Event
            if (ownerRadio) ownerRadio.addEventListener("change", updateFormDisplay);
            if (agentRadio) agentRadio.addEventListener("change", updateFormDisplay);

            // Setup Listeners
            setupListeners();
        });

        window.addEventListener("load", () => {
            updateBalimmoCommission(true); // Force initial calculation
            calculateWebsitePrice();
        });
    </script>
    {{-- {-- PRICE CALCULTAION --} --}}

    <script>
        // Ambil semua radio button dengan name "split_land"
        const findProperty = document.querySelectorAll('input[name="find_property"]');
        const findPropertySelected = document.getElementById('find_property_selection');
        const findPropertyAgent = document.getElementById('find_property_by_agent');
        const findPropertyOwner = document.getElementById('find_property_by_owner');

        findProperty.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === "agent") {
                    findPropertySelected.style.display = 'block';
                    findPropertyAgent.style.display = 'block';
                    findPropertyOwner.style.display = 'none';
                } else if (this.value === "owner") {
                    findPropertySelected.style.display = 'none';
                    findPropertyAgent.style.display = 'none';
                    findPropertyOwner.style.display = 'block';
                } else {
                    findPropertySelected.style.display = 'none';
                    findPropertyAgent.style.display = 'none';
                    findPropertyOwner.style.display = 'none';
                }
            });
        });
    </script>

    {{-- Rental Option --}}
    <script>
        document.querySelectorAll('input[name="average_price_status"]').forEach(function(elem) {
            elem.addEventListener('change', function() {
                var rentalFields = document.getElementById('rentalDataFields');
                if (this.value === 'yes') {
                    rentalFields.style.display = 'flex';
                } else {
                    rentalFields.style.display = 'none';
                }
            });
        });
    </script>
    {{-- Rental Option --}}
    
    {{-- Rental Calculation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const radioButtons = document.querySelectorAll('input[name="average_price_option"]');
            const averagePriceLabel = document.getElementById('averagePriceLabel');
            const averagePriceInput = document.getElementById('average_price');
            const occupancyRateField = document.getElementById('occupancyRateField');
            const occupancyRateInput = document.getElementById('average_occupancy_rate');
            const annualTurnoverInput = document.getElementById('annual_turnover');
            const calculationFormula = document.getElementById('calculationFormula');
            const formulaText = document.getElementById('formulaText');

            // Function to update label based on selected option
            function updateLabel(selectedOption) {
                switch(selectedOption) {
                    case 'Daily':
                        averagePriceLabel.textContent = 'Average price per night (IDR)';
                        occupancyRateField.style.display = 'block';
                        break;
                    case 'Monthly':
                        averagePriceLabel.textContent = 'Average price per month (IDR)';
                        occupancyRateField.style.display = 'none';
                        occupancyRateInput.value = '';
                        break;
                    case 'Yearly':
                        averagePriceLabel.textContent = 'Average price per year (IDR)';
                        occupancyRateField.style.display = 'none';
                        occupancyRateInput.value = '';
                        break;
                    default:
                        averagePriceLabel.textContent = 'Average price (IDR)';
                        occupancyRateField.style.display = 'none';
                        break;
                }
            }

            // Function to calculate annual turnover
            function calculateAnnualTurnover() {
                const selectedOption = document.querySelector('input[name="average_price_option"]:checked');
                const averagePrice = getNumericValue(averagePriceInput.value);
                const occupancyRate = parseFloat(occupancyRateInput.value) || 0;

                if (!selectedOption || averagePrice === 0) {
                    annualTurnoverInput.value = '';
                    calculationFormula.style.display = 'none';
                    return;
                }

                let annualTurnover = 0;
                let formula = '';

                switch(selectedOption.value) {
                    case 'Daily':
                        if (occupancyRate === 0) {
                            annualTurnoverInput.value = '';
                            calculationFormula.style.display = 'none';
                            return;
                        }
                        // Convert percentage to decimal (e.g., 75% = 0.75)
                        const occupancyDecimal = occupancyRate / 100;
                        annualTurnover = averagePrice * 365 * occupancyDecimal;
                        formula = `Formula: ${averagePrice.toLocaleString('id-ID')} × 365 × ${occupancyRate}% = ${annualTurnover.toLocaleString('id-ID')}`;
                        break;
                    case 'Monthly':
                        annualTurnover = averagePrice * 12;
                        formula = `Formula: ${averagePrice.toLocaleString('id-ID')} × 12 = ${annualTurnover.toLocaleString('id-ID')}`;
                        break;
                    case 'Yearly':
                        annualTurnover = averagePrice;
                        formula = `Formula: ${averagePrice.toLocaleString('id-ID')} = ${annualTurnover.toLocaleString('id-ID')}`;
                        break;
                }

                // Format the result with thousand separators
                annualTurnoverInput.value = annualTurnover.toLocaleString('id-ID');
                
                // Show calculation formula
                formulaText.textContent = formula;
                calculationFormula.style.display = 'block';
            }

            // Event listeners for radio buttons
            radioButtons.forEach(radio => {
                radio.addEventListener('change', function() {
                    updateLabel(this.value);
                    calculateAnnualTurnover();
                });
            });

            // Function to format number with thousand separators as user types (integers only)
            function formatNumberInput(input) {
                // Remove all non-digit characters (no decimal points allowed)
                let value = input.value.replace(/[^\d]/g, '');
                
                // Format with thousand separators (dots)
                if (value) {
                    value = value.replace(/\B(?=(\d{3})+(?!\d))/g, '.');
                }
                
                input.value = value;
            }

            // Function to get numeric value from formatted input
            function getNumericValue(formattedValue) {
                // Remove thousand separators (.) to get pure number
                return parseInt(formattedValue.replace(/\./g, '')) || 0;
            }

            // Event listeners for input changes
            averagePriceInput.addEventListener('input', function() {
                formatNumberInput(this);
                calculateAnnualTurnover();
            });
            
            occupancyRateInput.addEventListener('input', calculateAnnualTurnover);

            // Validate occupancy rate input (0-100%) - only for occupancy rate field
            occupancyRateInput.addEventListener('input', function() {
                let value = parseFloat(this.value);
                if (value > 100) {
                    this.value = 100;
                } else if (value < 0) {
                    this.value = 0;
                }
                calculateAnnualTurnover();
            });
        });
    </script>
    {{-- Rental Calculation --}}

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
            // Sembunyikan semua grup toggle
            $('.find_property_section').hide();

            const oldLegalCategory = "{{ old('legal_category') }}";
            // Handle semua toggle sekaligus
            if (oldLegalCategory === 'By Owner') {
                $('#leasehold_group').attr('style', 'display: block !important');
            } else if (oldLegalCategory === 'Freehold') {
                $('#leasehold_group').attr('style', 'display: none !important');
            }
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
    {{-- /* Custom Toggle */ --}}

    {{-- Convert IDR to USD --}}
    <script>
        const defaultKurs = 16000;
        const cacheKey = 'usd_to_idr_rate';
        const cacheTimeKey = 'usd_to_idr_rate_time';
        const cacheTTL = 10 * 60 * 2000; // 20 minutes

        // debounce / batasi eksekusi fungsi (ketika user ketik angka)
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
            if (idrValue < '15000000000') {
                document.getElementById('commision_rate').value = '5%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;

            } else if (idrValue >= '15000000000' && idrValue <= '34000000000') {
                document.getElementById('commision_rate').value = '4%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;
            } else if (idrValue > '34000000000' && idrValue <= '70000000000') {
                document.getElementById('commision_rate').value = '3%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;
            } else {
                document.getElementById('commision_rate').value = '2.5%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;
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

        document.getElementById('idr_price').addEventListener('input', debounce(handleIDRInput, 400));
    </script>

    {{-- /* Convert IDR to USD --}}

    {{-- Flatpickr --}}
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
    {{-- /* Flatpickr --}}

    {{-- Get Region & Subregion --}}
    <script>
        const oldRegion = @json(old('region'));
        const oldSubregion = @json(old('subregion'));
    </script>
    <script>
        const areaData = [
            { value: 'ubud', label: 'Ubud' },
            { value: 'canggu', label: 'Canggu' },
            { value: 'uluwatu', label: 'Uluwatu' },
            { value: 'sanur/nusa dua', label: 'Sanur/Nusa Dua' },
            { value: 'other', label: 'Other' }
        ];

        document.addEventListener('DOMContentLoaded', function() {
            const areaSelect = document.getElementById('area');
            const regionSelect = document.getElementById('region');
            const subregionSelect = document.getElementById('subregion');

            const areaChoices = new Choices(areaSelect, {
                searchEnabled: false,
                shouldSort: false
            });
            const regionChoices = new Choices(regionSelect, {
                searchEnabled: false
            });
            const subregionChoices = new Choices(subregionSelect, {
                searchEnabled: false
            });
            
            areaChoices.setChoices(areaData, 'value', 'label', true);

            const url = "{{ route('api.regions') }}";

            fetch(url)
                .then(response => response.json())
                .then(data => {
                    const regions = Object.keys(data);

                    regionChoices.setChoices(
                        regions.map(region => ({
                            value: region,
                            label: region.charAt(0).toUpperCase() + region.slice(1)
                        })),
                        'value',
                        'label',
                        true
                    );

                    // ✅ Set old region setelah setChoices selesai
                    if (oldRegion) {
                        regionChoices.setChoiceByValue(oldRegion);

                        // ✅ Load subregion berdasarkan region lama
                        const subregions = data[oldRegion] || [];
                        subregionChoices.setChoices(
                            subregions.map(sub => ({
                                value: sub,
                                label: sub
                            })),
                            'value',
                            'label',
                            true
                        );

                        // ✅ Set old subregion
                        if (oldSubregion) {
                            subregionChoices.setChoiceByValue(oldSubregion);
                        }
                    }

                    // 🔁 Handle perubahan region (user memilih)
                    regionSelect.addEventListener('change', function() {
                        const selectedRegion = this.value;
                        const subregions = data[selectedRegion] || [];

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

    {{-- /* Get Region & Subregion --}}

    {{-- ######################### Gallery Upload ######################### --}}
    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.15.0/Sortable.min.js"></script>

    <script>
        const imageInput = document.getElementById('imageInput');
        const previewContainer = document.getElementById('previewContainer');
        const imageOrder = document.getElementById('imageOrder');
        const galleryForm = document.getElementById('galleryForm');
        let files = [];

        imageInput.addEventListener('change', (e) => {
            const newFiles = Array.from(e.target.files);

            if (newFiles.length < 4) {
                alert('Minimum must be 4 images!');
                imageInput.value = ''; // reset input
                return;
            }

            previewContainer.innerHTML = '';

            newFiles.forEach((file, index) => {
                const formData = new FormData();
                formData.append('file', file);

                // Kirim ke server
                fetch("{{ route('gallery.upload.temp') }}", {
                        method: "POST",
                        headers: {
                            "X-CSRF-TOKEN": "{{ csrf_token() }}"
                        },
                        body: formData
                    })
                    .then(res => res.json())
                    .then(data => {
                        if (data.success) {
                            const imgDiv = document.createElement('div');
                            imgDiv.classList.add('img-preview');
                            imgDiv.setAttribute('data-index', index);
                            imgDiv.innerHTML = `
                    <img src="/tmp_uploads/{{ Auth::user()->reference_code }}/${data.filename}"
                         alt="Preview"
                         style="width: 100px; height: 100px; object-fit: cover; border: 2px solid #ccc; padding: 4px;">
                    <p class="text-center mt-1">Image ${index + 1}</p>
                    <input type="hidden" name="old_images[]" value="${data.filename}">
                `;
                            previewContainer.appendChild(imgDiv);
                            updateOrder(); // tetap panggil ini
                        }
                    });
            });
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
