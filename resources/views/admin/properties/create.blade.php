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
                        <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex px-4 justify-content-between align-items-start">
                                <div class="bg-light-subtle border-dark rounded border px-1 pt-2 col-4 row ">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Owner 1</h5>
                                    <hr>
                                    <div class="row p-0 m-0 mb-2">
                                        <div class="p-1 col-6 mb-1" id="group_owners[0][first_name]">
                                            <label for="owners[0][first_name]" class="form-label">First Name</label>

                                            <input type="text" id="owners[0][first_name]" name="owners[0][first_name]" class="form-control @error('owners.0.first_name') validation-form @enderror" placeholder="Input First Name" value="{{ old('owners.0.first_name') }}">

                                            @error('owners.0.first_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="p-1 col-6 mb-1" id="group_owners[0][last_name]">
                                            <label for="owners[0][last_name]" class="form-label">Last Name</label>

                                            <input type="text" id="owners[0][last_name]" name="owners[0][last_name]" class="form-control @error('owners.0.last_name') validation-form @enderror" placeholder="Input Last Name" value="{{ old('owners.0.last_name') }}">

                                            @error('owners.0.last_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="p-1 col-6 mb-1" id="group_owners[0][email]">
                                            <label for="owners[0][email]" class="form-label">Email</label>

                                            <input type="text" id="owners[0][email]" name="owners[0][email]" class="form-control @error('owners.0.email') validation-form @enderror" placeholder="Input Email" value="{{ old('owners.0.email') }}">

                                            @error('owners.0.email')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="p-1 col-6 mb-1" id="group_owners[0][phone_number]">
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
                                <div class="bg-light-subtle border-dark rounded border px-1 pt-2 col-4 row">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Owner 2</h5>
                                    <hr>                               

                                    <div class="row p-0 m-0 mb-2">

                                        <div class="p-1 col-6 mb-1" id="group_owners[1][first_name]">
                                            <label for="owners[1][first_name]" class="form-label">First Name</label>

                                            <input type="text" id="owners[1][first_name]" name="owners[1][first_name]" class="form-control @error('owners.1.first_name') validation-form @enderror" placeholder="Input First Name" value="{{ old('owners.1.first_name') }}">

                                            @error('owners.1.first_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="p-1 col-6 mb-1" id="group_owners[1][last_name]">
                                            <label for="owners[1][last_name]" class="form-label">Last Name</label>

                                            <input type="text" id="owners[1][last_name]" name="owners[1][last_name]" class="form-control @error('owners.1.last_name') validation-form @enderror" placeholder="Input Last Name" value="{{ old('owners.1.last_name') }}">

                                            @error('owners.1.last_name')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="p-1 col-6 mb-1" id="group_owners[1][email]">
                                            <label for="owners[1][email]" class="form-label">Email</label>

                                            <input type="text" id="owners[1][email]" name="owners[1][email]" class="form-control @error('owners.1.email') validation-form @enderror" placeholder="Input Email" value="{{ old('owners.1.email') }}">

                                            @error('owners.1.email')
                                                <div class="alert alert-danger fs-11 m-0 p-1">

                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <div class="p-1 col-6 mb-1" id="group_owners[1][phone_number]">
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
                                <div class="bg-light-subtle border-dark rounded border px-1 pt-2 col-4 row">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Legal Entity (if applicable): PT PMA</h5>
                                    <hr>
                                    <div class="row p-0 m-0 mb-2">

                                        <x-form-input className="p-1 col-12" type="text" name="company_name" label="Company Name"/>
                                        <x-form-input className="p-1 col-6" type="text" name="legal_rep_first_name" label="Owner First Name"/>
                                        <x-form-input className="p-1 col-6" type="text" name="legal_rep_last_name" label="Owner Last Name"/>
                                        <x-form-input className="p-1 col-6" type="email" name="legal_rep_email" label="Email"/>
                                        <x-form-input className="p-1 col-6" type="number" name="legal_rep_phone_number" label="Phone Number"/>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <br />
                    <!-- Land -->
                    <div class="accordion-item">
                        <h2 class="accordion-header" id="headingTwo">
                            <button class="accordion-button fs-18 fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                Land
                            </button>
                        </h2>
                        <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                            <div class="accordion-body row d-flex px-4 gap-4 align-items-start justify-content-between">

                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 py-2">
                                    <div class="col-lg-6 mb-3" id="group_internal_reference">
                                        <label for="internal_reference" class="form-label">Internal Reference</label>
                                        <input type="text" class="form-control" placeholder="Internal Reference" disabled value="{{ Auth::user()->reference_code }}">
                                    </div>

                                    <x-form-input className="col-lg-6" type="text" name="property_name" label="Property Name" />

                                    <div class="col-lg-4 mb-3" id="group_region">
                                        <label for="region" class="form-label">Area</label>
                                        <select id="region" class="form-select" name="region">
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
                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 py-2">
                                    
                                    <div class="mb-4">
                                        <h5 class="text-dark fw-semibold">Type of mandat *</h5>
                                        <hr>
                                        
                                        <div class="row align-items-center">
                                            <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="esstentials_mandate" value="Essentials Mandate" {{ old('type_mandate') == 'Essentials Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="esstentials_mandate">Essentials</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate" {{ old('type_mandate') == 'Booster Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="booster_mandate">Booster</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate" {{ old('type_mandate') == 'Booster Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="booster_mandate">Max Booster</label>
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
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="esstentials_mandate" value="Essentials Mandate" {{ old('type_mandate') == 'Essentials Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="esstentials_mandate">Invest</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate" {{ old('type_mandate') == 'Booster Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="booster_mandate">Confort</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate" {{ old('type_mandate') == 'Booster Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="booster_mandate">Premium</label>
                                                </div>
                                            </div>
                                            <div class="col-6">
                                                <x-form-input type="text" name="property_name" label="Constructor name" />
                                            </div>
                                        </div>
                                    </div>

                                    <div class="">
                                        <h5 class="text-dark fw-semibold">Property legal category *</h5>
                                        <hr>
                                        
                                        <div class="row align-items-center">
                                            <!-- <div class="col-6">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="esstentials_mandate" value="Essentials Mandate" {{ old('type_mandate') == 'Essentials Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="esstentials_mandate">Leasehold</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="booster_mandate" value="Booster Mandate" {{ old('type_mandate') == 'Booster Mandate' ? 'checked' : '' }}>
                                                    <label class="form-check-label" for="booster_mandate">Freehold</label>
                                                </div>
                                            </div> -->
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
                            <div class="accordion-body row d-flex gap-4 px-4 align-items-start justify-content-between">

                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 pt-2">
                                    <h5 class="text-dark fw-semibold">Indoor *</h5>
                                    <hr>
                                    <div class="row px-2 pb-2">
                                        @foreach ($feature_list_indoor as $feature_indoor)
                                            <x-form-checkbox className="form-check col-4" name="feature[{{ $feature_indoor->slug }}]" label="{{ $feature_indoor->name }}" />
                                        @endforeach
                                    </div>
                                </div>

                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 pt-2">
                                    <h5 class="text-dark fw-semibold">Outdoor *</h5>
                                    <hr>
                                    <div class="row px-2 pb-2">

                                        @foreach ($feature_list_outdoor as $feature_outdoor)
                                            <x-form-checkbox className="form-check col-4" name="feature[{{ $feature_outdoor->slug }}]" label="{{ $feature_outdoor->name }}" />
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
                            <div class="accordion-body row d-flex gap-4 px-4 align-items-start justify-content-between">

                                <div class="col-12 gap-4 row bg-light-subtle border-dark rounded border px-1 py-2">
                                    <div class="col-6 row align-content-start">
                                        <h5 class="text-dark fw-semibold">Do you have any data about the rental of the property ? </h5>                                    
                                        <hr>
                                        <p class="text-dark ">Average Nightly Rate / Average Occupancy Rate / Estimated Annual Turnover etc.</p>
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="yes" value="Yes">
                                                    <label class="form-check-label" for="yes">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline">
                                                    <input class="form-check-input" type="radio" name="type_mandate" id="no" value="No">
                                                    <label class="form-check-label" for="no">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col-6 row">
                                        <x-form-input className="col-12" type="text" name="leasehold_negotiation_ext_cost" label="Average nightly price" />
                                        <x-form-input className="col-12" type="text" name="leasehold_purchase_cost" label="Average occupation rate" />
                                        <div class="col-12">
                                            <label class="form-check-label" for="booster_mandate">Supporting document</label>
                                            <input type="file" id="file_type_of_mandate" name="file_type_of_mandate" class="form-control" placeholder="">
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
                            <div class="accordion-body row d-flex gap-4 px-4 align-items-start justify-content-between">
                                <!-- PILIHAN AGENT / OWNER -->
                                <div class="col-6 row bg-light-subtle border-dark rounded border px-1 py-2">
                                    <h5 class="text-dark fw-semibold">How did you find the property?</h5>
                                    <hr>
                                    <div class="col-12 mb-3">
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="find_property" id="by_owner" value="Owner of the villa">
                                        <label class="form-check-label" for="by_owner">Owner of the villa</label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input class="form-check-input" type="radio" name="find_property" id="by_agent" value="By an agent">
                                        <label class="form-check-label" for="by_agent">By an agent</label>
                                    </div>
                                    </div>

                                    <!-- Jika by agent -->
                                    <div id="agent_fields" style="display: none;">
                                        <x-form-input className="col-12" type="text" name="agent_name" label="Name of this agent" />
                                        <x-form-input className="col-12" type="text" name="agent_email" label="Email of this agent" />
                                        <x-form-input className="col-12" type="text" name="agent_whatsapp" label="Whatsapp of this agent" />
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

                                    <!-- DESIRE PRICE -->
                                    <div class="col-12 mt-2">
                                    <label>Desire price from the owner</label>
                                    <input type="text" class="form-control" id="desire_price_from_the_owner" name="desire_price_from_the_owner">
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
                                    <div class="col-12 mt-2" id="agent_commission_field">
                                    <label>Commission of the agent (%)</label>
                                    <input type="number" id="commission_of_the_agent" name="commission_of_the_agent" class="form-control" />
                                    </div>

                                    <div class="col-12 mt-2">
                                    <label>Balimmo commission (%)</label>
                                    <input type="number" id="balimmo_commission" name="balimmo_commission" class="form-control" placeholder="%" value="0" />
                                    </div>

                                    <!-- WEBSITE PRICE -->
                                    <div class="col-12 mt-2">
                                    <label>Website price (calculated)</label>
                                    <input type="text" name="website_price" id="website_price" class="form-control" readonly />
                                    </div>

                                    <!-- NET PROFIT (Selling Price Only) -->
                                    <div class="col-12 mt-2" id="profit_wrapper" style="display: none;">
                                    <label>Net Profit / Margin (Estimated)</label>
                                    <input type="text" name="net_profit" id="net_profit" class="form-control" readonly />
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
                            <div class="accordion-body row d-flex gap-4 px-4 align-items-start justify-content-between">

                                <div class="col-6 row bg-light-subtle border-dark rounded border p-2">
                                    <h5 class="text-dark fw-semibold">Plan shooting</h5>                                    
                                    <hr>                                    
                                    <button type="button" class="btn btn-primary width-xl col-4">Book shooting on calendar</button>
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
                                                                style="width: 100%; max-width: 100px; aspect-ration: 16 / 9; object-fit: cover; border: 1px solid #ccc; padding: 2px;">
                                                            <p class="mt-1 mb-0 text-center">Image {{ $index + 1 }}</p>
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
                                        <x-form-input className="col-12" type="text" name="leasehold_negotiation_ext_cost" label="Visit Tour Link" />
                                        <x-form-input className="col-12" type="text" name="leasehold_purchase_cost" label="Lifestyle" />
                                        <x-form-input className="col-12" type="text" name="leasehold_purchase_cost" label="Experience" />
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
                        <a href="#!" class="btn btn-danger w-100">Cancel</a>
                    </div>
                    <div class="col-lg-2">
                        <button type="submit" class="btn btn-primary w-100">Create Properties</button>
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

    {-- PRICE CALCULTAION --}
    <script>
        function parseRupiah(value) {
        return parseFloat(value.replace(/[^0-9]/g, '')) || 0;
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

        function updateBalimmoCommission() {
        const price = parseRupiah(document.getElementById("desire_price_from_the_owner").value);
        const balimmoInput = document.getElementById("balimmo_commission");
        const fullCommission = document.querySelector('input[name="full_commission_balimmo"]:checked')?.value;
        const isAgentFullYes = fullCommission === "Yes";
        const isAgentFullNo  = fullCommission === "No";
        const isAgent = document.getElementById("by_agent").checked;
        const isOwner = isOwnerSelected();

        if (!price || !balimmoInput) {
            balimmoInput.value = "0";
            return;
        }

        const rate = getBalimmoCommissionRate(price);
        const min = getBalimmoMinCommission(price);
        let val = parseFloat(balimmoInput.value);

        if (!balimmoInput.value || val === 0) {
            // Auto-fill jika belum ada input manual
            if (isOwner || isAgentFullYes) {
            balimmoInput.value = rate.toFixed(2);
            } else if (isAgentFullNo) {
            balimmoInput.value = min.toFixed(2);
            }
        }

        val = parseFloat(balimmoInput.value);

        // Validasi manual input
        if (balimmoInput === document.activeElement) {
            if ((isOwner || isAgentFullYes) && val < rate) {
            alert(`Balimmo commission cannot be lower than ${rate}%`);
            balimmoInput.value = rate.toFixed(2);
            } else if (isAgentFullNo && val < min) {
            alert(`Balimmo commission cannot be lower than minimum: ${min}%`);
            balimmoInput.value = min.toFixed(2);
            } else if (val > 100) {
            alert("Balimmo commission cannot exceed 100%");
            balimmoInput.value = "100";
            }
        }

        calculateWebsitePrice();
        }

        function calculateWebsitePrice() {
        const price = parseRupiah(document.getElementById("desire_price_from_the_owner").value);
        const agent = parseFloat(document.getElementById("commission_of_the_agent").value) || 0;
        const balimmo = parseFloat(document.getElementById("balimmo_commission").value) || 0;
        const base = getBasePriceType();

        const totalCommission = price * (agent + balimmo) / 100;
        let websitePrice = 0;
        const netProfitField = document.getElementById("net_profit");
        const profitWrapper = document.getElementById("profit_wrapper");

        if (base === "NET saler") {
            websitePrice = price + totalCommission;
            profitWrapper.style.display = "none";
        } else {
            websitePrice = price;
            profitWrapper.style.display = "block";
            netProfitField.value = Math.round(price - totalCommission).toLocaleString('id-ID');
        }

        document.getElementById("website_price").value = Math.round(websitePrice).toLocaleString('id-ID');
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
            el.addEventListener('input', () => {
                updateBalimmoCommission();
                calculateWebsitePrice();
            });
            el.addEventListener('change', () => {
                updateBalimmoCommission();
                calculateWebsitePrice();
            });
            }
        });
        }

        window.addEventListener("DOMContentLoaded", () => {
        const ownerRadio = document.getElementById("by_owner");
        const agentRadio = document.getElementById("by_agent");

        const commonFields = document.getElementById("common_fields");
        const agentFields = document.getElementById("agent_fields");
        const agentCommissionFields = document.getElementById("agent_commission_fields");

        function updateFormDisplay() {
        const agentFields = document.getElementById("agent_fields");
        const agentCommissionFields = document.getElementById("agent_commission_fields");
        const agentCommissionField = document.getElementById("agent_commission_field");
        const commonFields = document.getElementById("common_fields");

        commonFields.style.display = "block";

        if (document.getElementById("by_agent").checked) {
            agentFields.style.display = "block";
            agentCommissionFields.style.display = "block";
            agentCommissionField.style.display = "block"; // SHOW field agent commission
        } else {
            agentFields.style.display = "none";
            agentCommissionFields.style.display = "none";
            agentCommissionField.style.display = "none"; // HIDE when owner
        }

        document.getElementById("balimmo_commission").value = "0";
        document.getElementById("website_price").value = "";
        document.getElementById("net_profit").value = "";
        document.getElementById("profit_wrapper").style.display = "none";

        updateBalimmoCommission();
        setupListeners();
        }


        ownerRadio.addEventListener("change", updateFormDisplay);
        agentRadio.addEventListener("change", updateFormDisplay);
        });
    </script>
    {-- PRICE CALCULTAION --}



    <script>
    // Ambil semua radio button dengan name "split_land"
        const findProperty = document.querySelectorAll('input[name="find_property"]');
        const findPropertySelected = document.getElementById('find_property_selection');
        const findPropertyAgent = document.getElementById('find_property_by_agent');
        const findPropertyOwner = document.getElementById('find_property_by_owner');

        findProperty.forEach(radio => {
            radio.addEventListener('change', function() {
                if (this.value === "By an agent") {
                    findPropertySelected.style.display = 'block';
                    findPropertyAgent.style.display = 'block';
                    findPropertyOwner.style.display = 'none';
                } else if (this.value === "Owner of the villa") {
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
        const defaultKurs = 15000;
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
        document.addEventListener('DOMContentLoaded', function() {
            const regionSelect = document.getElementById('region');
            const subregionSelect = document.getElementById('subregion');

            const regionChoices = new Choices(regionSelect, {
                searchEnabled: false
            });
            const subregionChoices = new Choices(subregionSelect, {
                searchEnabled: false
            });

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
