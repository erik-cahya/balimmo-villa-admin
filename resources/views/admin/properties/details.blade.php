@php
    // Virtual Tour URL
    $virtualTour = null;
    $urlVirtualTour = $attachment->firstWhere('name', 'url_virtual_tour');
    if ($urlVirtualTour && !empty($urlVirtualTour->path_attachment)) {
        $virtualTour = $urlVirtualTour->path_attachment;
    }

    // Lifestyle URL  
    $lifestyle = null;
    $urlLifestyle = $attachment->firstWhere('name', 'url_lifestyle');
    if ($urlLifestyle && !empty($urlLifestyle->path_attachment)) {
        $lifestyle = $urlLifestyle->path_attachment;
    }
    
    // Experience URL
    $experience = null;
    $urlExperience = $attachment->firstWhere('name', 'url_experience');
    if ($urlExperience && !empty($urlExperience->path_attachment)) {
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
                                            @if (Auth::user()->role === 'master')
                                                @php
                                                    $status = 'pending';
                                                @endphp
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <a class="dropdown-item" href="{{ route('properties.changeAcceptance', ['slug' => $data_properties->property_slug, 'status' => 'pending']) }}">Pending</a>
                                                    <a class="dropdown-item" href="{{ route('properties.changeAcceptance', ['slug' => $data_properties->property_slug, 'status' => 'accept']) }}">Accept</a>
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
                                    
                                </div>
                                <!-- Villa Detail Information -->
                                <div class="row">
                                    <div class="col lg-6">
                                        <p class="mb-2"><span class="fw-medium text-dark">Reference code</span><span class="mx-2">:</span>{{ $agent_data->reference_code }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Created date</span><span class="mx-2">:</span>{{ \Carbon\Carbon::parse($data_properties->created_at)->format('d F, Y') }}</p>
                                        <p class="mb-2 text-capitalize"><span class="fw-medium text-dark">Area</span><span class="mx-2">:</span>{{ $data_properties->area }}</p>
                                        <p class="mb-2 text-capitalize"><span class="fw-medium text-dark">Sub region</span><span class="mx-2">:</span>{{ $data_properties->sub_region }}</p>
                                        <p class="mb-2 text-capitalize"><span class="fw-medium text-dark">Region</span><span class="mx-2">:</span>{{ $data_properties->region }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Address</span><span class="mx-2">:</span>{{ isset($data_properties->property_address) ? $data_properties->property_address : 'Data Not Found' }}</p>
                                                                            
                                    </div>

                                    <div class="col-lg-6">
                                        @foreach ($property_owner as $owner)
                                        <p class="mb-2"><span class="fw-medium text-dark">Owner {{ $owner->owner_order }}</span><span class="mx-2">:</span>{{ $owner->first_name }} {{ $owner->last_name }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Email </span><span class="mx-2">:</span>{{ $owner->email }}</p>
                                        <p class="mb-2"><span class="fw-medium text-dark">Number</span><span class="mx-2">:</span>{{ $owner->phone }}</p>
                                        
                                        @endforeach
                                        @if(!empty($data_properties->company_name))
                                            <p class="mb-2">
                                                <span class="fw-medium text-dark">PT PMA</span><span class="mx-2">:</span>{{ $data_properties->company_name }}
                                            </p>
                                        @endif

                                        @if(!empty($data_properties->rep_first_name) || !empty($data_properties->rep_last_name))
                                            <p class="mb-2">
                                                <span class="fw-medium text-dark">Owner</span><span class="mx-2">:</span>{{ $data_properties->rep_first_name }} {{ $data_properties->rep_last_name }}
                                            </p>
                                        @endif

                                        @if(!empty($data_properties->email))
                                            <p class="mb-2">
                                                <span class="fw-medium text-dark">Email</span><span class="mx-2">:</span>{{ $data_properties->email }}
                                            </p>
                                        @endif

                                        @if(!empty($data_properties->phone))
                                            <p class="mb-2">
                                                <span class="fw-medium text-dark">Number</span><span class="mx-2">:</span>{{ $data_properties->phone }}
                                            </p>
                                        @endif

                                        @if(!empty($agent_data->name))
                                            <p class="mb-2">
                                                <span class="fw-medium text-dark">Agent</span><span class="mx-2">:</span>{{ $agent_data->name }}
                                            </p>
                                        @endif

                                       
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
                                                                <p class="mb-2"><span class="fw-medium text-dark">Purchase Date</span><span class="mx-2">:</span>{{ isset($data_properties->purchase_date) ? $data_properties->purchase_date : '-' }}</p>
                                                                <p class="mb-0"><span class="fw-medium text-dark">Zoning</span><span class="mx-2">:</span>{{ $data_properties->zoning }}</p>

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
                                                                        <p class="mb-0"><span class="fw-medium text-dark">Zoning</span><span class="mx-2">:</span>{{ $data_properties->zoning }}</p>

                                                                        <div class="d-flex align-items-center mt-3 flex-wrap gap-2">
                                                                            @if ($data_properties->zoning == 'Yello Zone')
                                                                                <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Green Zone</span>
                                                                            @endif

                                                                            @if ($data_properties->zoning == 2)
                                                                                <span class="badge bg-success-subtle text-dark fw-medium fs-12 border px-2 py-1 text-center"><iconify-icon icon="lets-icons:check-ring-round" class="fs-12"></iconify-icon> Yellow Zone</span>
                                                                            @endif

                                                                            @if ($data_properties->zoning == 3)
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
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Average Nightly Rate</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->avg_nightly_rate, 2, ',', '.') }}</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Average Occupancy Rate (%) </span><span class="mx-2">:</span>{{ $data_properties->avg_occupancy_rate }} %</p>

                                <!-- <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Months Rented per Year *</span><span class="mx-2">:</span>{{ $data_properties->months_rented }} Month</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Annual Turnover</span><span class="mx-2">:</span>IDR {{ number_format($data_properties->annual_turnover, 2, ',', '.') }}</p> -->
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
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Desired Selling Price (IDR)</span><span class="mx-2">:</span>
                                <br>IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</p>
                                
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Desired Selling Price (USD)</span><span class="mx-2">:</span>
                                <br>$ {{ number_format($data_properties->selling_price_usd, 2, ',', '.') }}</p>

                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Commision Ammount (IDR)</span><span class="mx-2">:</span>
                                <br>IDR {{ number_format($data_properties->net_seller_idr, 2, ',', '.') }}</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Estimated Commision Ammount (USD)</span><span class="mx-2">:</span>
                                <br>USD {{ number_format($data_properties->net_seller_usd, 2, ',', '.') }}</p>

                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Net seller price (IDR)</span><span class="mx-2">:</span>
                                <br>IDR {{ number_format($data_properties->desired_price_idr, 2, ',', '.') }}</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Net seller price (USD)</span><span class="mx-2">:</span>
                                <br>USD {{ number_format($data_properties->desired_price_usd, 2, ',', '.') }}</p>

                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Balimmo Commision</span><span class="mx-2">:</span>
                                <br>IDR {{ number_format($data_properties->balimmo_commision_idr, 2, ',', '.') }} | {{ $data_properties->balimmo_commision }}%</p>
                                <p class="col-lg-6 mb-2"><span class="fw-medium text-dark">Agent Commision</span><span class="mx-2">:</span>
                                <br>IDR {{ number_format($data_properties->agent_commision_idr, 2, ',', '.') }} | {{ $data_properties->agent_commision }}%</p>
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
            </div>

            <div class="col-xl-5 col-lg-5">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body"> 

                            <!-- Gallery Data Start -->
                            <div class="row mb-1">
                                <h4>Gallery</h4>
                                <div class="row">
                                    @if (!empty($image_gallery) && count($image_gallery) > 0)
                                        @foreach ($image_gallery as $gallery)
                                            <a href="{{ asset($gallery->image_path) }}"
                                            class="glightbox col-3 mb-3"
                                            data-gallery="property-gallery">
                                                <img src="{{ asset($gallery->image_path) }}"
                                                    style="width: 130px; height: 5rem; object-fit:cover; border-radius: 10px;">
                                            </a>
                                        @endforeach
                                    @else
                                        <p class="text-muted">No image</p>
                                    @endif
                                </div>
                            </div>
                            <!-- Gallery Data End -->

                            <!-- Video Data Start -->
                            <div class="row mb-1">
                                <h4>Video</h4>
                                @if (($experience !== null) || ($virtualTour !== null) || ($lifestyle !== null))
                                    
                                    @if ($virtualTour !== null)
                                        <div class="col-4">
                                            <div class="ratio ratio-16x9">
                                                <iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/{{ $virtualTour }}"
                                                    title="YouTube video player"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    referrerpolicy="strict-origin-when-cross-origin"
                                                    class="rounded"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                            <span class="text-dark d-inline-block my-2">
                                                <a href="https://www.youtube.com/watch?v={{ $virtualTour }}" target="_blank">Visit Tour Video</a>
                                            </span>
                                        </div>
                                    @endif
                                    
                                    @if ($experience !== null)
                                        <div class="col-4">
                                            <div class="ratio ratio-16x9">
                                                <iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/{{ $experience }}"
                                                    title="YouTube video player"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    referrerpolicy="strict-origin-when-cross-origin"
                                                    class="rounded"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                            <span class="text-dark d-inline-block my-2">
                                                <a href="https://www.youtube.com/watch?v={{ $experience }}" target="_blank">Experience Video</a>
                                            </span>
                                        </div>
                                    @endif
                                    
                                    @if ($lifestyle !== null)
                                        <div class="col-4">
                                            <div class="ratio ratio-16x9">
                                                <iframe width="560" height="315"
                                                    src="https://www.youtube.com/embed/{{ $lifestyle }}"
                                                    title="YouTube video player"
                                                    frameborder="0"
                                                    allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                                    referrerpolicy="strict-origin-when-cross-origin"
                                                    class="rounded"
                                                    allowfullscreen>
                                                </iframe>
                                            </div>
                                            <span class="text-dark d-inline-block my-2">
                                                <a href="https://www.youtube.com/watch?v={{ $lifestyle }}" target="_blank">Lifestyle Video</a>
                                            </span>
                                        </div>
                                    @endif

                                @else
                                    <p class="text-muted">No video</p>
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
                                    <div class="col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:scale-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->total_land_area }}m²
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:home-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->villa_area }}m²
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:swimming-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->pool_area }}m²
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:bed-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->bedroom }}
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 border-end">
                                        <p class="text-muted d-flex align-items-center justify-content-center mb-0 gap-1"><iconify-icon icon="solar:bath-broken" class="fs-18 text-warning"></iconify-icon> {{ $data_properties->bathroom }}
                                        </p>
                                    </div>
                                    <div class="col-lg-4 col-md-6 col-6 border-end">
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
                                <div class="col-6 d-flex gap-2">
                                    <!-- Button trigger modal -->
                                    <button type="button" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#exampleModalCenter">
                                        Make an estimation
                                    </button>
                                    <a href="{{ route('properties.edit', $data_properties->property_slug) }}" type="submit" class="btn btn-primary w-fit">Edit Villa</a>
                                </div>
                                <div class="col-6 ">
                                    <h4 class="mb-0" style=" text-align: right">IDR {{ number_format($data_properties->selling_price_idr, 2, ',', '.') }}</h4>
                                    <p class="mb-0" style=" text-align: right">$ {{ number_format($data_properties->selling_price_usd, 2, ',', '.') }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>                

            </div>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="exampleModalCenter" tabindex="-1"  aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" style="width: 80%; max-width: 75vw !important;">
                <div class="modal-content" >
                    <div class="modal-header">
                        <h4 class="modal-title" id="exampleModalCenterTitle">Let’s create an estimation for this villa</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <!-- Choose Currency -->
                        <div class="d-flex align-items-center gap-2 mb-3">
                            <h5 class="mb-0">Choose your currency</h5>
                            <div style="width: 200px">
                                <select class="form-control" data-choices name="choices-single-default" id="choices-single-default">
                                    <option value="USD" selected>USD</option>
                                    <option value="EUR">EUR</option>
                                    <option value="IDR">IDR</option>
                                </select>
                            </div>
                        </div>

                        <!-- === ROI estimation === -->
                        <div class="row align-items-center g-6">
                            <div class="col-12 col-md-2">
                                <h4>ROI estimation</h4>
                            </div>
                            <!-- Estimation Low -->
                            <div class="col-12 col-md-5 row align-items-end">
                                <div class="col-7">
                                    <p class="mb-2">Estimation low</p>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-primary btn-sm price-dec" data-target="price-low">−</button>
                                        <input type="text" class="form-control price-input text-end" id="price-low"
                                            inputmode="numeric" autocomplete="off" value="280000" />
                                        <button type="button" class="btn btn-outline-primary btn-sm price-inc" data-target="price-low">+</button>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <p class="mb-1">Occupation rate <b>75%</b></p>
                                    <p class="mb-0">Price per night <b>120%</b></p>
                                </div>
                            </div>

                            <!-- Estimation High -->
                            <div class="col-12 col-md-5 row align-items-end">
                                <div class="col-7">
                                    <p class="mb-2">Estimation high</p>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="button" class="btn btn-outline-primary     btn-sm price-dec" data-target="price-high">−</button>
                                        <input type="text" class="form-control price-input text-end" id="price-high"
                                            inputmode="numeric" autocomplete="off" value="280000" />
                                        <button type="button" class="btn btn-outline-primary     btn-sm price-inc" data-target="price-high">+</button>
                                    </div>
                                </div>

                                <div class="col-5">
                                    <p class="mb-1">Occupation rate <b>75%</b></p>
                                    <p class="mb-0">Price per night <b>120%</b></p>
                                </div>
                            </div>
                        </div>

                        <!-- === Lease estimation === -->
                        <div class="row align-items-center g-6">
                            <div class="col-12 col-md-2">
                                <h4>Lease estimation</h4>
                            </div>
                            
                            <div class="col-12 col-md-10">
                                <p class="mb-2">Estimation high</p>
                            </div>
                        </div>

                        <p class="mt-3">This is a vertically centered modal.</p>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary">Save changes</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/glightbox.min.js') }}"></script>
    <script>
        const lightbox = GLightbox({
            selector: '.glightbox'
        });
    </script>

    <script>
        (function() {
        const currencySelect = document.getElementById('choices-single-default');
        const inputs = Array.from(document.querySelectorAll('.price-input'));

        // Step per currency
        const steps = { USD: 1000, EUR: 1000, IDR: 1000000 };

        // Formatter per currency (no decimal untuk IDR)
        function formatter(currency) {
            return new Intl.NumberFormat(undefined, {
            style: 'currency',
            currency,
            minimumFractionDigits: currency === 'IDR' ? 0 : 0,
            maximumFractionDigits: currency === 'IDR' ? 0 : 0
            });
        }

        // Parse dari string (buang semua non-digit)
        function parseAmount(str) {
            if (!str) return 0;
            const onlyDigits = str.toString().replace(/[^0-9]/g, '');
            return Number(onlyDigits || 0);
        }

        // Tampilkan dengan format currency
        function formatAmount(val, cur) {
            return formatter(cur).format(val);
        }

        function clamp(n) {
            return Math.max(0, Number.isFinite(n) ? n : 0);
        }

        function setFormatted(el) {
            const cur = currencySelect.value;
            const raw = parseAmount(el.value);
            el.dataset.raw = raw; // simpan nilai numerik bersih
            el.value = formatAmount(raw, cur);
        }

        // Init: format semua input sesuai currency default
        inputs.forEach(setFormatted);

        // Ubah semua tampilan saat currency berganti
        currencySelect.addEventListener('change', () => {
            inputs.forEach(setFormatted);
        });

        // + / - buttons
        function adjust(targetId, dir) {
            const cur = currencySelect.value;
            const step = steps[cur] ?? 1000;
            const el = document.getElementById(targetId);
            if (!el) return;
            const val = parseAmount(el.value);
            const next = clamp(val + dir * step);
            el.value = formatAmount(next, cur);
            el.dataset.raw = next;
        }

        // Delegasi click
        document.addEventListener('click', (e) => {
            if (e.target.classList.contains('price-inc')) {
            adjust(e.target.getAttribute('data-target'), +1);
            } else if (e.target.classList.contains('price-dec')) {
            adjust(e.target.getAttribute('data-target'), -1);
            }
        });

        // Saat fokus: ubah ke tampilan plain number biar enak mengetik
        inputs.forEach((el) => {
            el.addEventListener('focus', () => {
            const raw = el.dataset.raw ?? parseAmount(el.value);
            el.value = raw;
            el.select();
            });

            // Batasi input ke angka saja saat mengetik
            el.addEventListener('input', () => {
            el.value = parseAmount(el.value);
            });

            // Saat blur: format lagi ke currency
            el.addEventListener('blur', () => {
            setFormatted(el);
            });

            // Arrow up/down untuk naik/turun sesuai step
            el.addEventListener('keydown', (ev) => {
            if (ev.key === 'ArrowUp' || ev.key === '+') {
                ev.preventDefault();
                adjust(el.id, +1);
            } else if (ev.key === 'ArrowDown' || ev.key === '-') {
                ev.preventDefault();
                adjust(el.id, -1);
            }
            });
        });
        })();
        </script>
@endpush
