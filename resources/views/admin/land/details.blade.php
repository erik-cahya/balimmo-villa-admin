@php
    // dd($attachment->firstWhere('name', 'url_virtual_tour')->path_attachment);

    // Lifestyle URL
    $lifestyle = null;
    $urlLifestyle = $attachment->firstWhere('name', 'url_lifestyle');
    if ($urlLifestyle) {
        $lifestyle = $urlLifestyle->path_attachment;
    }

    // Virtual Tour URL
    $virtualTour = null;
    $urlVirtualTour = $attachment->firstWhere('name', 'url_virtual_tour');
    if ($urlVirtualTour) {
        $virtualTour = $urlVirtualTour->path_attachment;
    }

    // Experience URL
    $experience = null;
    $urlExperience = $attachment->firstWhere('name', 'url_experience');
    if ($urlExperience) {
        $experience = $urlExperience->path_attachment;
    }
@endphp
@extends('admin.layouts.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/glightbox.min.css') }}" />
@endpush
@section('content')
    <div class="container-fluid">

        <!-- ========== Page Title Start ========== -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Property Overview</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="/properties">Data Listing</a></li>
                        <li class="breadcrumb-item active">Property Overview</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ========== Page Title End ========== -->

        <div class="row">

            <div class="col-xl-7 col-lg-7">

                <!-- Data count grid -->
                <div class="col-xl-12">
                    <div class="row">
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <span>Person interest</span>
                                    <h3 class="mb-0">64</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <span>Visit done</span>
                                    <h3 class="mb-0">12</h3>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-4">
                            <div class="card">
                                <div class="card-body">
                                    <span>Offers</span>
                                    <h3 class="mb-0">2</h3>
                                </div>
                            </div>
                        </div>                    
                    </div>
                </div>                
                
                <!-- Villa Detail Card Start -->
                <div class="col-12">
                    <div class="card">                     
                        <div class="card-body">
                            <div>
                                <!-- Villa Name -->
                                <div class="d-flex align-items-center justify-content-between gap-2 mb-3">
                                    <div class="d-flex align-items-center gap-2 col-12">
                                        <h3 class="fw-medium text-capitalize mb-0">{{ $data_properties->property_name }}</h3>
                                        <!-- <div>
                                            @php
                                                if ($data_properties->type_acceptance == 'pending') {
                                                    $className = 'bg-warning';
                                                } elseif ($data_properties->type_acceptance == 'accept') {
                                                    $className = 'bg-success';
                                                } else {
                                                    $className = 'bg-danger';
                                                }
                                            @endphp
                                            <span class="badge {{ $className }} text-light fs-16 text-capitalize px-2 py-1">{{ $data_properties->type_acceptance }}</span>
                                        </div> -->
                                        <div class="dropdown">
                                            @php
                                                if ($data_properties->type_acceptance == 'pending') {
                                                    $className = 'btn-warning';
                                                } elseif ($data_properties->type_acceptance == 'accept') {
                                                    $className = 'btn-success';
                                                } else {
                                                    $className = 'btn-danger';
                                                }
                                            @endphp
                                            <button class="btn fs-14 fw-semibold {{ $className }} text-capitalize dropdown-toggle px-2 py-1" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                {{ $data_properties->type_acceptance }}
                                            </button>
                                            @if (Auth::user()->role === 'Master')
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                <a class="dropdown-item" href="#">Pending</a>
                                                <a class="dropdown-item" href="#">Accept</a>
                                            </div>
                                            @endif
                                        </div>
                                        <div>
                                            @php
                                                if ($data_properties->type_mandate == 'Essentials Mandate') {
                                                    $className = 'bg-warning';                                           
                                                } else {
                                                    $className = 'bg-secondary';
                                                }
                                            @endphp
                                            <span class="badge {{ $className }} text-light fs-14 text-capitalize px-2 py-2">{{ $data_properties->type_mandate }}</span>
                                        </div>
                                    </div>
                                    <!-- @if (Auth::user()->role === 'Master')                                    
                                        <form method="POST" action="{{ route('properties.changeAcceptance', $data_properties->property_slug) }}" class="d-flex gap-2 align-items-center col-4">
                                            @csrf
                                            <x-form-select className="w-100" name="type_acceptance" label="" :options="['pending', 'accept', 'decline']" :selected="old('type_acceptance', $data_properties->type_acceptance ?? '')" />
                                            <button type="submit" class="btn btn-primary">Change</button>
                                        </form>                                            
                                    @endif -->
                                    
                                </div>
                                <!-- Villa Detail Information -->
                                <div class="row">
                                    <div class="col lg-6">
                                        <p class="mb-2"><span class="fw-medium text-dark">Reference code</span><span class="mx-2">:</span>{{ $agent_data->reference_code }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Created date</span><span class="mx-2">:</span>{{ \Carbon\Carbon::parse($data_properties->created_at)->format('d F, Y') }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Sector</span><span class="mx-2">:</span>{{ $data_properties->region }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Address</span><span class="mx-2">:</span>{{ isset($data_properties->property_address) ? $data_properties->property_address : 'Data Not Found' }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Land area</span><span class="mx-2">:</span>{{ $data_properties->total_land_area }} M<sup>2</sup></p>
                                                                            
                                    </div>

                                    <div class="col-lg-6">
                                        @foreach ($property_owner as $owner)
                                        <p class="mb-2"><span class="fw-medium text-dark">Owner {{ $owner->owner_order }}</span><span class="mx-2">:</span>{{ $owner->first_name }} {{ $owner->last_name }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Email </span><span class="mx-2">:</span>{{ $owner->email }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Number</span><span class="mx-2">:</span>{{ $owner->phone }}</p>
                                        
                                        @endforeach
                                        <p class="mb-2"><span class="fw-medium text-dark">Agent</span><span class="mx-2">:</span>{{ $agent_data->name }}</p>
                                       
                                    </div>                                    
                                </div>

                                <!-- Land Information -->
                                <div class="row ">
                                    <div class="col-xl-12 col-lg-12">
                                        <div class="card mb-0 border shadow-none">
                                            <div class="card-body">
                                                <div class="row justify-content-between align-items-center">
                                                    <div class="col-xl-12">                          
                                                        <div class="">
                                                            @if ($data_properties->legal_status === 'Freehold')
                                                                {{-- Freehold --}}
                                                                <h4 class="card-title mb-2">Land Information :</h4>
                                                                <p class="mb-2"><span class="fw-medium text-dark">Legal Status</span><span class="mx-2">:</span>{{ isset($data_properties->legal_status) ? $data_properties->legal_status : '-' }}</p>
                                                                <p class="mb-2"><span class="fw-medium text-dark">Certificate Name</span><span class="mx-2">:</span>{{ isset($data_properties->holder_number) ? $data_properties->holder_name : '-' }}</p>
                                                                <p class="mb-2"><span class="fw-medium text-dark">Certificate Number</span><span class="mx-2">:</span>{{ isset($data_properties->holder_number) ? $data_properties->holder_number : '-' }}</p>
                                                                <p class="mb-0"><span class="fw-medium text-dark">Purchase Date</span><span class="mx-2">:</span>{{ isset($data_properties->purchase_date) ? $data_properties->purchase_date : '-' }}</p>

                                                                <div class="d-flex align-items-center mt-3 flex-wrap gap-2">
                                                                    @if ($data_properties->green_zone == 1)
                                                                        <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Green Zone</span>
                                                                    @endif

                                                                    @if ($data_properties->yellow_zone == 1)
                                                                        <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Yellow Zone</span>
                                                                    @endif

                                                                    @if ($data_properties->red_zone == 1)
                                                                        <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Red Zone</span>
                                                                    @endif
                                                                </div>
                                                            @else
                                                                {{-- Leasehold --}}
                                                                <div class="row">
                                                                    <div class="col lg-6">
                                                                        <h4 class="card-title mb-2">Land Information :</h4>

                                                                        <p class="mb-2"><span class="fw-medium text-dark">Legal Status</span><span class="mx-2">:</span>{{ isset($data_properties->legal_status) ? $data_properties->legal_status : '-' }}</p>
                                                                        <p class="mb-2"><span class="fw-medium text-dark">Contract Holder Name</span><span class="mx-2">:</span>{{ isset($data_properties->holder_name) ? $data_properties->holder_name : '-' }}</p>
                                                                        <p class="mb-2"><span class="fw-medium text-dark">Contract Number</span><span class="mx-2">:</span>{{ isset($data_properties->holder_number) ? $data_properties->holder_number : '-' }}</p>
                                                                        <p class="mb-2"><span class="fw-medium text-dark">Start Date</span><span class="mx-2">:</span>{{ isset($data_properties->start_date) ? $data_properties->start_date : '-' }}</p>
                                                                        <p class="mb-0"><span class="fw-medium text-dark">End Date</span><span class="mx-2">:</span>{{ isset($data_properties->end_date) ? $data_properties->end_date : '-' }}</p>
                                                                    </div>

                                                                    <div class="col-lg-6">
                                                                        <h4 class="card-title mb-2">Extension Details :</h4>
                                                                        <p class="mb-2"><span class="fw-medium text-dark">Negotiation Extension Cost</span><span class="mx-2">:</span>{{ isset($data_properties->extension_cost) ? $data_properties->extension_cost : '-' }}</p>
                                                                        <p class="mb-2"><span class="fw-medium text-dark">Purchase Cost</span><span class="mx-2">:</span>{{ isset($data_properties->purchase_cost) ? $data_properties->purchase_cost : '-' }}</p>
                                                                        <p class="mb-2"><span class="fw-medium text-dark">Deadline for Payment to Secure Rate</span><span class="mx-2">:</span>{{ isset($data_properties->deadline_payment) ? $data_properties->deadline_payment : '-' }}</p>

                                                                        <div class="d-flex align-items-center mt-3 flex-wrap gap-2">
                                                                            @if ($data_properties->green_zone == 1)
                                                                                <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Green Zone</span>
                                                                            @endif

                                                                            @if ($data_properties->yellow_zone == 1)
                                                                                <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Yellow Zone</span>
                                                                            @endif

                                                                            @if ($data_properties->red_zone == 1)
                                                                                <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Red Zone</span>
                                                                            @endif
                                                                        </div>

                                                                    </div>
                                                                </div>
                                                            @endif

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
                <!-- Villa Detail Card End -->

                <!-- Rental Yield Card -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Rental Yield</h4>
                            <div class="row">
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Average Nightly Rate</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Average Occupancy Rate (%) </span><span class="mx-2">:</span>{{ $data_properties->avg_occupancy_rate }} %</p>

                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Months Rented per Year *</span><span class="mx-2">:</span>{{ $data_properties->months_rented }} Month</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Annual Turnover</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->annual_turnover, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>                

                <!-- Sale Price & Conditions Card -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Sale Price & Conditions</h4>
                            <div class="row">
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Desired Selling Price (IDR)</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Desired Selling Price (USD)</span><span class="mx-2">:</span>$ {{ number_format($data_properties->selling_price_usd, 2, ',', '.') }}</p>

                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Commision Ammount (IDR)</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->commision_ammount_idr, 2, ',', '.') }}</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Commision Ammount (USD)</span><span class="mx-2">:</span>USD {{ number_format($data_properties->commision_ammount_usd, 2, ',', '.') }}</p>

                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Net Seller price (IDR)</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->net_seller_idr, 2, ',', '.') }}</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Net Seller price (USD)</span><span class="mx-2">:</span>USD {{ number_format($data_properties->net_seller_usd, 2, ',', '.') }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Property File Card -->
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4>Property File</h4>
                            <div class="d-flex flex-wrap gap-2">
                                @foreach ($attachment as $key => $value)
                                    @if ($value->name !== 'url_virtual_tour' && $value->name !== 'url_lifestyle' && $value->name !== 'url_experience')
                                        @if ($value->path_attachment !== null)
                                            <a href="{{ asset('admin/attachment/' . $data_properties->property_slug . '/' . $value->path_attachment) }}" class="text-dark stretched-link d-flex bg-light-subtle align-items-center position-relative gap-1 rounded border p-2 text-start">
                                                <iconify-icon icon="ph:file-fill" class="text-danger fs-18"></iconify-icon>
                                                <h4 class="fs-14" style="margin-bottom: -1px !important">{{ $value->path_attachment }}</h4>
                                                <i class="ri-download-cloud-line fs-16 text-muted"></i>
                                            </a>
                                        @endif
                                    @endif
                                @endforeach
                            </div>
                        </div>
                    </div>
                </div>

                <!-- @if (Auth::user()->role === 'Master')
                    <div class="col-12">
                        <div class="card">
                            <div class="card-header bg-primary text-white">
                                <h4 class="card-title">Accept Listing Properties</h4>
                            </div>
                            <div class="card-body">
                                <form method="POST" action="{{ route('properties.changeAcceptance', $data_properties->property_slug) }}" class="d-flex align-items-center flex-wrap">
                                    @csrf
                                    <x-form-select className="col-lg-6" name="type_acceptance" label="Accept Listing Properties" :options="['pending', 'accept', 'decline']" :selected="old('type_acceptance', $data_properties->type_acceptance ?? '')" />
                                    <button type="submit" class="btn btn-primary mx-4">Change Status</button>
                                </form>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <div class="position-relative">
                                <img src="{{ asset($data_properties?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="" class="img-fluid rounded" style="width: 100%; height: 30rem; object-fit: cover">
                                <span class="position-absolute start-0 top-0 p-2">
                                    @php
                                        if ($data_properties->type_acceptance == 'pending') {
                                            $className = 'bg-warning';
                                        } elseif ($data_properties->type_acceptance == 'accept') {
                                            $className = 'bg-success';
                                        } else {
                                            $className = 'bg-danger';
                                        }
                                    @endphp
                                    <span class="badge {{ $className }} text-light fs-16 text-capitalize px-2 py-1">{{ $data_properties->type_acceptance }}</span>
                                </span>
                            </div>
                            <div class="d-flex justify-content-between my-3 flex-wrap gap-2">
                                <div>
                                    <a href="#!" class="fs-20 text-dark fw-medium text-capitalize">{{ $data_properties->property_name }} - {{ $data_properties->sub_region }}, {{ $data_properties->region }}</a>
                                    <p class="d-flex align-items-center mb-0 mt-1 gap-1"><iconify-icon icon="solar:map-point-wave-bold-duotone" class="fs-18 text-primary"></iconify-icon>{{ isset($data_properties->property_address) ? $data_properties->property_address : 'Data Not Found' }}</p>
                                </div>
                                <div>
                                    <ul class="list-inline d-flex align-items-center float-end mb-0 gap-1">
                                        <div class="d-flex align-items-center gap-2">
                                            <div class="avatar-sm bg-success-subtle rounded">
                                                <iconify-icon icon="solar:wallet-money-bold-duotone" class="fs-24 text-success avatar-title"></iconify-icon>
                                            </div>
                                            <div class="d-flex flex-column align-items-end">
                                                <p class="fw-medium text-dark fs-14 mb-0">IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</p>
                                                <p class="fw-medium text-dark fs-14 mb-0">$ {{ number_format($data_properties->selling_price_usd, 2, '.', ',') }} </p>
                                            </div>
                                        </div>
                                    </ul>
                                </div>
                            </div>
                            @foreach ($image_gallery as $gallery)
                                <a href="{{ asset($gallery->image_path) }}" class="glightbox" data-gallery="property-gallery">
                                    <img src="{{ asset($gallery->image_path) }}" width="130" style="margin:10px; border-radius:8px;">
                                </a>
                            @endforeach

                            <div class="bg-light-subtle mt-3 rounded border border-dashed p-2">
                                <div class="row align-items-center g-2 text-center">
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted fs-15 fw-medium d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:bed-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->bedroom }} Bedroom
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted fs-15 fw-medium d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:bath-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->bathroom }} Bathrooms
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted fs-15 fw-medium d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:scale-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->total_land_area }}m² area
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted fs-15 fw-medium d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->pool_area }}m² Pool Area
                                        </p>
                                    </div>
                                </div>
                            </div>

                            <h5 class="text-dark fw-medium mt-3">Property Owner :</h5>
                            <div class="row mt-3 gap-3">
                                <div class="row">
                                    @foreach ($property_owner as $owner)
                                        <div class="col-xl-6 col-sm-12">
                                            <div class="card bg-primary text-white">
                                                <div class="card-body">
                                                    <div class="d-flex align-items-center flex-wrap gap-3">
                                                        {{-- <img src="{{ asset('admin/assets/images/person-placeholder.png') }}" alt="" class=" bg-light avatar-lg rounded-3 border border-light border-3"> --}}
                                                        <iconify-icon icon="solar:user-bold" class="text-white" style="font-size: 60px"></iconify-icon>

                                                        <div class="d-block">
                                                            <a href="#!" class="fw-medium fs-16 text-white">{{ $owner->first_name }} {{ $owner->last_name }}</a>
                                                            <p class="mb-0">{{ $owner->email }}</p>
                                                            <hr style="border-color: #ffff">
                                                            <p class="text-light mb-0 text-white">#Owner {{ $owner->owner_order }}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    @endforeach
                                </div>
                            </div>

                            <h5 class="text-dark fw-medium mt-3">Some Facility :</h5>
                            <div class="d-flex align-items-center mt-3 flex-wrap gap-2">
                                @foreach ($feature_list as $feature)
                                    <span class="badge bg-light-subtle text-muted fw-medium fs-13 border px-2 py-1 text-center">{{ $feature->feature_name }}</span>
                                @endforeach
                            </div>

                            <div class="row my-3">
                                <div class="col-xl-12 col-lg-12">
                                    <div class="card mb-0 border shadow-none">
                                        <div class="card-body">
                                            <div class="row justify-content-between align-items-center">
                                                <div class="col-xl-12">
                                                    <div class="avatar bg-primary mb-3 rounded bg-opacity-10">
                                                        <iconify-icon icon="fa:legal" class="fs-28 text-danger avatar-title"></iconify-icon>
                                                    </div>
                                                    <div class="mt-4">

                                                        @if ($data_properties->legal_status === 'Freehold')
                                                            {{-- Freehold --}}
                                                            <p class="mb-2"><span class="fw-medium text-dark">Legal Status</span><span class="mx-2">:</span>{{ isset($data_properties->legal_status) ? $data_properties->legal_status : '-' }}</p>
                                                            <p class="mb-2"><span class="fw-medium text-dark">Certificate Name</span><span class="mx-2">:</span>{{ isset($data_properties->holder_number) ? $data_properties->holder_name : '-' }}</p>
                                                            <p class="mb-2"><span class="fw-medium text-dark">Certificate Number</span><span class="mx-2">:</span>{{ isset($data_properties->holder_number) ? $data_properties->holder_number : '-' }}</p>
                                                            <p class="mb-2"><span class="fw-medium text-dark">Purchase Date</span><span class="mx-2">:</span>{{ isset($data_properties->purchase_date) ? $data_properties->purchase_date : '-' }}</p>

                                                            <div class="d-flex align-items-center mt-3 flex-wrap gap-2">
                                                                @if ($data_properties->green_zone == 1)
                                                                    <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Green Zone</span>
                                                                @endif

                                                                @if ($data_properties->yellow_zone == 1)
                                                                    <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Yellow Zone</span>
                                                                @endif

                                                                @if ($data_properties->red_zone == 1)
                                                                    <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Red Zone</span>
                                                                @endif
                                                            </div>
                                                        @else
                                                            {{-- Leasehold --}}
                                                            <div class="row">
                                                                <div class="col lg-6">
                                                                    <h4 class="card-title mb-2">Legal Information :</h4>

                                                                    <p class="mb-2"><span class="fw-medium text-dark">Legal Status</span><span class="mx-2">:</span>{{ isset($data_properties->legal_status) ? $data_properties->legal_status : '-' }}</p>
                                                                    <p class="mb-2"><span class="fw-medium text-dark">Contract Holder Name</span><span class="mx-2">:</span>{{ isset($data_properties->holder_name) ? $data_properties->holder_name : '-' }}</p>
                                                                    <p class="mb-2"><span class="fw-medium text-dark">Contract Number</span><span class="mx-2">:</span>{{ isset($data_properties->holder_number) ? $data_properties->holder_number : '-' }}</p>
                                                                    <p class="mb-2"><span class="fw-medium text-dark">Start Date</span><span class="mx-2">:</span>{{ isset($data_properties->start_date) ? $data_properties->start_date : '-' }}</p>
                                                                    <p class="mb-2"><span class="fw-medium text-dark">End Date</span><span class="mx-2">:</span>{{ isset($data_properties->end_date) ? $data_properties->end_date : '-' }}</p>
                                                                </div>

                                                                <div class="col-lg-6">
                                                                    <h4 class="card-title mb-2">Extension Details :</h4>
                                                                    <p class="mb-2"><span class="fw-medium text-dark">Negotiation Extension Cost</span><span class="mx-2">:</span>{{ isset($data_properties->extension_cost) ? $data_properties->extension_cost : '-' }}</p>
                                                                    <p class="mb-2"><span class="fw-medium text-dark">Purchase Cost</span><span class="mx-2">:</span>{{ isset($data_properties->purchase_cost) ? $data_properties->purchase_cost : '-' }}</p>
                                                                    <p class="mb-2"><span class="fw-medium text-dark">Deadline for Payment to Secure Rate</span><span class="mx-2">:</span>{{ isset($data_properties->deadline_payment) ? $data_properties->deadline_payment : '-' }}</p>

                                                                    <div class="d-flex align-items-center mt-3 flex-wrap gap-2">
                                                                        @if ($data_properties->green_zone == 1)
                                                                            <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Green Zone</span>
                                                                        @endif

                                                                        @if ($data_properties->yellow_zone == 1)
                                                                            <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Yellow Zone</span>
                                                                        @endif

                                                                        @if ($data_properties->red_zone == 1)
                                                                            <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Red Zone</span>
                                                                        @endif
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        @endif

                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="rounded border p-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <p class="text-dark fw-semibold fs-16 mb-0"><iconify-icon icon="solar:bath-broken" class="fs-18 text-primary"></iconify-icon> Sale Price & Conditions</p>
                                                <hr>
                                                <div class="row">
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Desired Selling Price (IDR)</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</p>
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Desired Selling Price (USD)</span><span class="mx-2">:</span>$ {{ number_format($data_properties->selling_price_usd, 2, ',', '.') }}</p>

                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Commision Ammount (IDR)</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->commision_ammount_idr, 2, ',', '.') }}</p>
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Commision Ammount (USD)</span><span class="mx-2">:</span>USD {{ number_format($data_properties->commision_ammount_usd, 2, ',', '.') }}</p>
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Net Seller price (IDR)</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->net_seller_idr, 2, ',', '.') }}</p>
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Net Seller price (USD)</span><span class="mx-2">:</span>USD {{ number_format($data_properties->net_seller_usd, 2, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-12 mt-4">
                                    <div class="rounded border p-4">
                                        <div class="d-flex align-items-center gap-3">
                                            <div>
                                                <p class="text-dark fw-semibold fs-16 mb-0"><iconify-icon icon="solar:bath-broken" class="fs-18 text-primary"></iconify-icon> Rental Yield</p>
                                                <hr>
                                                <div class="row">
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Average Nightly Rate</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</p>
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Average Occupancy Rate (%) </span><span class="mx-2">:</span>{{ $data_properties->avg_occupancy_rate }} %</p>

                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Months Rented per Year *</span><span class="mx-2">:</span>{{ $data_properties->months_rented }} Month</p>
                                                    <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Annual Turnover</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->annual_turnover, 2, ',', '.') }}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <div class="border-top border-bottom container mt-3">
                                <h5 class="text-dark fw-medium mt-3">Property Details :</h5>
                                <p class="mt-2">{{ $data_properties->property_description }}</p>
                            </div>

                            <div class="d-flex align-items-center justify-content-end">
                                <div>
                                    <p class="d-flex align-items-center mb-0 gap-1"><iconify-icon icon="solar:calendar-date-broken" class="fs-18 text-primary"></iconify-icon> {{ \Carbon\Carbon::parse($data_properties->created_at)->format('d F, Y') }}</p>
                                </div>
                            </div>
                        </div>

                    </div>
                </div> -->
            </div>

            <div class="col-xl-5 col-lg-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body"> 

                            <!-- Gallery Data Start -->
                            <div class="row mb-1">
                                <h4>Gallery</h4>
                                <div class="row">
                                    @foreach ($image_gallery as $gallery)
                                        <a href="{{ asset($gallery->image_path) }}" class="glightbox col-3 mb-3" data-gallery="property-gallery">
                                            <img src="{{ asset($gallery->image_path) }}" class="w-100" style="border-radius:5px;">
                                        </a>
                                    @endforeach
                                </div>
                                
                            </div>
                            <!-- Gallery Data End -->

                            <!-- Video Data Start -->
                            <div class="row mb-1">
                                <h4>Video</h4>
                                @if (($experience !== null) | ($virtualTour !== null) | ($lifestyle !== null))
                                
                                    @if ($virtualTour !== null)
                                        <div class="col-4">
                                            <div class="ratio ratio-16x9">
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $virtualTour }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" class="rounded" allowfullscreen=""></iframe>
                                            </div>
                                            <span class="text-dark d-inline-block my-2">
                                                <a href="https://www.youtube.com/embed/{{ $virtualTour }}">Visit Tour Video</a>
                                            </span>
                                        </div>
                                    @endif
                                    
                                    @if ($experience !== null)
                                        <div class="col-4">                                            
                                            <div class="ratio ratio-16x9">
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $experience }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" class="rounded" allowfullscreen=""></iframe>
                                            </div>
                                            <span class="text-dark d-inline-block my-2">
                                                <a href="https://www.youtube.com/embed/{{ $experience }}">Experience Video</a>
                                            </span>
                                        </div>
                                    @endif                                

                                    @if ($lifestyle !== null)
                                        <div class="col-4">
                                            <div class="ratio ratio-16x9">
                                                <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $lifestyle }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" class="rounded" allowfullscreen=""></iframe>
                                            </div>
                                            <span class="text-dark d-inline-block my-2">
                                                <a href="https://www.youtube.com/embed/{{ $lifestyle }}">Lifestyle Video</a>
                                            </span>
                                        </div>
                                    @endif
                          
                                @endif
                            </div>
                            <!-- Video Data End -->

                            <!-- Villa Description Start -->
                            <div class="row mb-1">
                                <h4>Description</h4>
                                <p>{{ $data_properties->property_description }}</p>
                            </div>
                            <!-- Villa Description End -->

                            <!-- Villa Characteristic Start -->
                            <div class="bg-light-subtle rounded border border-dashed p-2 mb-3">
                                <div class="row align-items-center g-2 text-center">                                    
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:scale-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->total_land_area }}m²
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:home-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->villa_area }}m²
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:swimming-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->pool_area }}m²
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:bed-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->bedroom }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:bath-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->bathroom }}
                                        </p>
                                    </div>
                                    <div class="col-xl-3 col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:alarm-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->year_construction }}
                                        </p>
                                    </div>
                                </div>
                            </div>
                            <!-- Villa Characteristic End -->

                            <!-- Villa Aminities Start -->
                            <div class="row mb-3">
                                <h4>Caracteristics :</h4>
                                <div class="d-flex align-items-center mt-1 flex-wrap gap-2">
                                    @foreach ($feature_list as $feature)
                                        <span class="badge bg-light-subtle text-muted fw-medium fs-13 border px-2 py-1 text-center">{{ $feature->feature_name }}</span>
                                    @endforeach
                                </div>
                            </div>
                            <!-- Villa Aminities End -->
                             
                            <div class="row d-flex align-items-center" style="justify-content: space-between !important ">
                                <button type="submit" class="btn btn-primary col-4">Edit Property</button>
                                <div class="col-6 ">
                                    <h4 class="mb-0" style=" text-align: right">IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</h4>
                                    <p class="mb-0" style=" text-align: right">$ {{ number_format($data_properties->selling_price_usd, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- {{-- Agent Details --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">Property Agent Details</h4>
                    </div>
                    <div class="card-body">
                        <div class="text-center">
                            <img src="{{ asset('admin') }}{{ $agent_data->profile == null ? '/assets/images/users/dummy-avatar.jpg' : '/profile-image/' . $agent_data->reference_code . '/' . $agent_data->profile }}" alt="" class="avatar-xl rounded-circle border-light mx-auto border border-2" style="width: 8rem; height: 8rem; object-fit:cover; border-radius: 10px">
                            <div class="mt-2">
                                <a href="#!" class="fw-medium text-dark fs-16 text-uppercase">{{ $agent_data->name }}</a>
                                <p class="text-capitalize mb-0">({{ $agent_data->role }})</p>
                            </div>
                        </div>
                        <div class="mt-4">
                            <div class="d-flex align-items-center border-bottom gap-3 pb-3">
                                <div class="avatar bg-primary rounded bg-opacity-10">
                                    <iconify-icon icon="material-symbols:real-estate-agent-outline" class="fs-28 text-primary avatar-title"></iconify-icon>
                                </div>
                                <div>
                                    <p class="text-dark fw-medium fs-15 mb-1">Reference Code</p>
                                    <p class="text-muted mb-0">{{ $agent_data->reference_code }}</p>
                                </div>
                            </div>
                            <div class="d-flex align-items-center border-bottom gap-3 py-3">
                                <div class="avatar bg-primary rounded bg-opacity-10">
                                    <iconify-icon icon="ic:round-email" class="fs-28 text-primary avatar-title"></iconify-icon>
                                </div>
                                <div>
                                    <p class="text-dark fw-medium fs-15 mb-1">Agent Email</p>
                                    <p class="text-muted mb-0">{{ $agent_data->email }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-light-subtle">
                        <div class="row g-2">
                            <div class="col-lg-12">
                                <a href="mailto:{{ $agent_data->email }}" class="btn btn-primary w-100"><iconify-icon icon="material-symbols:mail" class="fs-18 align-middle"></iconify-icon> Mail Us</a>
                            </div>
                        </div>
                    </div>
                </div>
                {{-- /* Agent Details --}}

                {{-- Property File --}}
                <div class="card">
                    <div class="card-header bg-primary text-white">
                        <h4 class="card-title">Property File</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex flex-wrap gap-2">

                            @foreach ($attachment as $key => $value)
                                @if ($value->name !== 'url_virtual_tour' && $value->name !== 'url_lifestyle' && $value->name !== 'url_experience')
                                    @if ($value->path_attachment !== null)
                                        <div class="d-flex bg-light-subtle align-items-center position-relative gap-2 rounded border p-2 text-start">
                                            <iconify-icon icon="ph:file-fill" class="text-danger fs-24"></iconify-icon>
                                            <div>
                                                <h4 class="fs-14 mb-1"><a href="{{ asset('admin/attachment/' . $data_properties->property_slug . '/' . $value->path_attachment) }}" class="text-dark stretched-link">{{ $value->path_attachment }}</a></h4>
                                            </div>
                                            <i class="ri-download-cloud-line fs-20 text-muted"></i><i class=''></i>
                                        </div>
                                    @endif
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
                @if (($experience !== null) | ($virtualTour !== null) | ($lifestyle !== null))
                    {{-- Video --}}
                    <div class="card">
                        <div class="card-header bg-primary text-white">
                            <h4 class="card-title">Video</h4>
                        </div>
                        <div class="card-body">
                            @if ($experience !== null)
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="ratio ratio-16x9">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $experience }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" class="rounded" allowfullscreen=""></iframe>
                                        </div>
                                        <span class="text-dark d-inline-block my-2">
                                            <a href="#!" class="text-dark fs-18 fw-medium">Experience Video</a>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if ($virtualTour !== null)
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="ratio ratio-16x9">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $virtualTour }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" class="rounded" allowfullscreen=""></iframe>
                                        </div>
                                        <span class="text-dark d-inline-block my-2">
                                            <a href="#!" class="text-dark fs-18 fw-medium">Virtual Tour Video</a>
                                        </span>
                                    </div>
                                </div>
                            @endif

                            @if ($lifestyle !== null)
                                <div class="card">
                                    <div class="card-body p-2">
                                        <div class="ratio ratio-16x9">
                                            <iframe width="560" height="315" src="https://www.youtube.com/embed/{{ $lifestyle }}" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" referrerpolicy="strict-origin-when-cross-origin" class="rounded" allowfullscreen=""></iframe>
                                        </div>
                                        <span class="text-dark d-inline-block my-2">
                                            <a href="#!" class="text-dark fs-18 fw-medium">Lifestyle Video</a>
                                        </span>
                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                @endif -->

            </div>
        </div>

        {{-- <div class="row">
         <div class="col-lg-12">
              <div class="mapouter">
                   <div class="gmap_canvas mb-2"><iframe class="gmap_iframe rounded" width="100%" style="height: 400px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University of Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
              </div>
         </div>
    </div> --}}
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/glightbox.min.js') }}"></script>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>
@endpush
