@extends('admin.layouts.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTable.min.css') }}">

    <style>
        .dataTables_filter input {
            border: 1px solid #eaedf1 !important;
            /* border: 1px solid red; */
            padding: 6px;
            border-radius: 5px;
        }

        .dataTables_wrapper {
            padding: 1rem;
        }

        .dataTable {
            margin-top: 3rem !important;
        }

        .paging_simple_numbers {
            /* background-color: red; */
            /* #063436 */
        }
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <!-- <h4 class="fw-semibold mb-0">Create Document Visit</h4> -->
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="{{ route('prospects.index') }}">Prospect</a></li>
                        <li class="breadcrumb-item active">Detail Prospect</li>
                    </ol>
                </div>
            </div>
        </div>
        <form action="{{ route('visit.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-6">
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex justify-content-between mb-3">
                                    <div class="d-flex align-items-center gap-2">
                                        <h3 class="fw-medium text-capitalize mb-0">Deva Mahayana</h3>                
                                        <span class="badge bg-success fs-16 text-capitalize px-2 py-1">Status</span>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Edit Prospect</button>
                                </div>
                                <!-- Villa Detail Information -->
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="fw-medium text-capitalize">Details</h4> 
                                        <p class="mb-1"><span class="fw-medium text-dark">Email</span><span class="mx-2">:</span>devamahayanatop@gmail.com</p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Whatsapp</span><span class="mx-2">:</span>+33 34 312 422</p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Sign up date</span><span class="mx-2">:</span>16 July, 2025</p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Passport</span><span class="mx-2">:</span>ZERTY65432</p>                                                                            
                                        <p class="mb-1"><span class="fw-medium text-dark">Nationality</span><span class="mx-2">:</span>China</p>                                                                            
                                        <p class="mb-1"><span class="fw-medium text-dark">Assigne to</span><span class="mx-2">:</span>Agent name</p>                                                                            
                                    </div>

                                    <div class="col-6">
                                        <h4 class="fw-medium text-capitalize">Looking for</h4> 
                                        <div class="mb-2">
                                            <span class="badge fs-16 bg-success me-1">Villa</span>
                                            <p class="mb-1"><span class="fw-medium text-dark">Bedroom</span><span class="mx-2">:</span>2 - 4</p>
                                            <p class="mb-1"><span class="fw-medium text-dark">Budget</span><span class="mx-2">:</span>IDR 500.000.000 - IDR 2.500.000.000,00</p>
                                            <p class="mb-1"><span class="fw-medium text-dark">Localisation</span><span class="mx-2">:</span>Canggu</p>
                                            <p class="mb-1"><span class="fw-medium text-dark">Ready to buy</span><span class="mx-2">:</span>16 July, 2025</p>
                                        </div>
                                        
                                        <div>
                                            <span class="badge fs-16 bg-warning me-1">Land</span>
                                            <p class="mb-1"><span class="fw-medium text-dark">Land size</span><span class="mx-2">:</span>200 - 300 m²</p>
                                            <p class="mb-1"><span class="fw-medium text-dark">Budget</span><span class="mx-2">:</span>IDR 500.000.000 - IDR 2.000.000.000,00</p>
                                            <p class="mb-1"><span class="fw-medium text-dark">Localisation</span><span class="mx-2">:</span>Canggu</p>
                                            <p class="mb-1"><span class="fw-medium text-dark">Ready to buy</span><span class="mx-2">:</span>16 July, 2025</p>
                                        </div>
                                    </div>                                    
                                </div>
                            </div>

                        </div>
                    </div>
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                            
                                <!-- Villa Detail Information -->
                                <div class="row">
                                    <div class="col-12">
                                        <h4 class="fw-medium text-capitalize">Files</h4> 
                                        <div class="d-flex flex-wrap gap-2">   
                                            <!-- Button Visit Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <!-- <i class="ri-download-cloud-line fs-16 text-muted"></i>     -->
                                                    <iconify-icon icon="ph:file-fill" style="margin-bottom: -5px !important" class="text-white fs-18"></iconify-icon>
                                                    Visit Docs
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <a class="dropdown-item" href="#">English</a>
                                                    <a class="dropdown-item" href="#">Indonesia</a>
                                                </div>
                                            </div>                  
                                            <!-- Offering Dropdown -->
                                            <div class="dropdown">
                                                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <!-- <i class="ri-download-cloud-line fs-16 text-muted"></i>     -->
                                                    <iconify-icon icon="ph:file-fill" style="margin-bottom: -5px !important" class="text-white fs-18"></iconify-icon>
                                                    Offering Docs
                                                </button>
                                                <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                    <a class="dropdown-item" href="#">English</a>
                                                    <a class="dropdown-item" href="#">Indonesia</a>
                                                </div>
                                            </div>                  
                                            <!-- <a href="" class="text-dark stretched-link d-flex bg-light-subtle align-items-center position-relative gap-1 rounded border p-2 text-start">
                                                <iconify-icon icon="ph:file-fill" class="text-danger fs-18"></iconify-icon>
                                                <h4 class="fs-14" style="margin-bottom: -1px !important">Property Files</h4>
                                                <i class="ri-download-cloud-line fs-16 text-muted"></i>
                                            </a>                                    
                                            <a href="" class="text-dark stretched-link d-flex bg-light-subtle align-items-center position-relative gap-1 rounded border p-2 text-start">
                                                <iconify-icon icon="ph:file-fill" class="text-danger fs-18"></iconify-icon>
                                                <h4 class="fs-14" style="margin-bottom: -1px !important">Visit PDF</h4>
                                                <i class="ri-download-cloud-line fs-16 text-muted"></i>
                                            </a>                                    
                                            <a href="" class="text-dark stretched-link d-flex bg-light-subtle align-items-center position-relative gap-1 rounded border p-2 text-start">
                                                <iconify-icon icon="ph:file-fill" class="text-danger fs-18"></iconify-icon>
                                                <h4 class="fs-14" style="margin-bottom: -1px !important">Offering Paper </h4>
                                                <i class="ri-download-cloud-line fs-16 text-muted"></i>
                                            </a>                                     -->
                                        </div>                                                                            
                                    </div>                                   
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-xl-6">
                    <div class="card">
                        <div class="accordion" id="accordionExample">

                            <!-- Villa Selected -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingOne">
                                    <button class="fs-18 accordion-button fw-medium" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                        Villa Selected <span class="ms-2 badge bg-success text-capitalize">2</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <div class="table-responsive">
                                        <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="villaSelectedTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 20px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="selectAll1">
                                                            <label class="form-check-label" for="selectAll1"></label>
                                                        </div>
                                                    </th>
                                                    <th>Properties Name</th>
                                                    <th>Bedroom</th>
                                                    <th>Price</th>
                                                    <th>Localisation</th>                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_property as $property)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="propertyId[]" class="form-check-input property-checkbox" id="{{ $property->propertyId }}" value="{{ $property->propertyId }}">
                                                                <label class="form-check-label" for="{{ $property->propertyId }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class=" d-flex align-items-center">
                                                            <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                            <span class="fst-italic fs-12">{{ $property->property_name }}</span>                                                
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->bedroom }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fst-italic fs-12">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                                                <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->sub_region }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="propertyId[]" class="form-check-input property-checkbox" id="{{ $property->propertyId }}" value="{{ $property->propertyId }}">
                                                                <label class="form-check-label" for="{{ $property->propertyId }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class=" d-flex align-items-center">
                                                            <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                            <span class="fst-italic fs-12">{{ $property->property_name }}</span>                                                
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->bedroom }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fst-italic fs-12">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                                                <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->sub_region }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mb-2 me-2">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" id="btn-visit-docs" data-bs-target="#visitDoc-1">Create visit docs</button>
                                        <button type="button" class="btn btn-primary" id="btn-offer-docs">Create offer docs</button>

                                        
                                        <!-- Modal -->
                                        <div class="modal modal-lg fade" id="visitDoc-1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Properties Selected </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="col-lg-12">
                                                            <div class="table-responsive">
                                                                <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="villaSelectedTablePopUp">
                                                                    <thead class="table-light">
                                                                        <tr>                                                                         
                                                                            <th>Properties Name</th>
                                                                            <th>Bedroom</th>
                                                                            <th>Price</th>
                                                                            <th>Localisation</th>                                            
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($data_property as $property)
                                                                        <tr>                                                                              
                                                                            <td class=" d-flex align-items-center">
                                                                                <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                                                <span class="fst-italic fs-12">{{ $property->property_name }}</span>                                                
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex flex-column gap-1">
                                                                                    <span class="fst-italic fs-12">{{ $property->bedroom }}</span>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                            <td>
                                                                                <div class="d-flex flex-column">
                                                                                    <span class="fst-italic fs-12">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                                                                    <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                                                </div>
                                                                            </td>
                                                                            <td>
                                                                                <div class="d-flex flex-column gap-1">
                                                                                    <span class="fst-italic fs-12">{{ $property->sub_region }}</span>
                                                                                </div>
                                                                            </td>
                                                                            
                                                                        </tr>                                                                            
                                                                        @endforeach

                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                        </div>                                       
                                                        <div class="col-lg-4 mb-3" id="group_date_visit">
                                                            <label>Input Date</label>
                                                            <input type="text" id="date_visit" name="date_visit" class="form-control @error('date_visit') validation-form @enderror" placeholder="Input Visit Date">

                                                            @error('date_visit')
                                                                <div class="alert alert-danger mt-1 p-1" role="alert">
                                                                    {{ $message }}
                                                                </div>
                                                            @enderror
                                                        </div>                       
                                                    </div>

                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Create visit docs</button>                                                        
                                                    </div>
                                                   
                                                </div>
                                            </div>
                                        </div>
                                        <!-- /* Modal -->
                                    </div>
                                </div>
                            </div>

                            <!-- Villa Recommendation -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingTwo">
                                    <button class="fs-18 accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                                        Villa Recommendation
                                    </button>
                                </h2>
                                <div id="collapseTwo" class="accordion-collapse collapse" aria-labelledby="headingTwo" data-bs-parent="#accordionExample">
                                    <div class="table-responsive">
                                        <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="villaRecommendationTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 20px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="selectAll1">
                                                            <label class="form-check-label" for="selectAll1"></label>
                                                        </div>
                                                    </th>
                                                    <th>Properties Name</th>
                                                    <th>Bedroom</th>
                                                    <th>Price</th>
                                                    <th>Localisation</th>                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_property as $property)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="propertyId[]" class="form-check-input" id="{{ $property->propertyId }}" value="{{ $property->propertyId }}">
                                                                <label class="form-check-label" for="{{ $property->propertyId }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class=" d-flex align-items-center">
                                                            <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                            <span class="fst-italic fs-12">{{ $property->property_name }}</span>                                                
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->bedroom }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fst-italic fs-12">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                                                <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->sub_region }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mb-2 me-2">
                                        <button type="submit" class="btn btn-primary" id="btn-selected">Add to selected</button>
                                    </div>
                                </div>
                                
                            </div>
                            
                            <!-- Land Selected -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="fs-18 accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Land Selected <span class="ms-2 badge bg-warning text-capitalize">1</span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <div class="table-responsive">
                                        <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="landSelectedTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 20px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="selectAll1">
                                                            <label class="form-check-label" for="selectAll1"></label>
                                                        </div>
                                                    </th>
                                                    <th>Properties Name</th>
                                                    <th>Land Size</th>
                                                    <th>Price</th>
                                                    <th>Localisation</th>                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_property as $property)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="propertyId[]" class="form-check-input property-checkbox" id="{{ $property->propertyId }}" value="{{ $property->propertyId }}">
                                                                <label class="form-check-label" for="{{ $property->propertyId }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class=" d-flex align-items-center">
                                                            <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                            <span class="fst-italic fs-12">{{ $property->property_name }}</span>                                                
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->bedroom }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fst-italic fs-12">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                                                <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->sub_region }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mb-2 me-2">
                                        <button type="submit" class="btn btn-warning" id="btn-visit-docs">Create visit docs</button>
                                        <button type="submit" class="btn btn-primary" id="btn-offer-docs">Create offer docs</button>
                                    </div>
                                </div>
                            </div>

                            <!-- Land Recommendation -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingFour">
                                    <button class="fs-18 accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                                        Land Recommendation
                                    </button>
                                </h2>
                                <div id="collapseFour" class="accordion-collapse collapse" aria-labelledby="headingFour" data-bs-parent="#accordionExample">
                                    <div class="table-responsive">
                                        <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="landRecommendationTable">
                                            <thead class="table-light">
                                                <tr>
                                                    <th style="width: 20px;">
                                                        <div class="form-check">
                                                            <input type="checkbox" class="form-check-input" id="selectAll1">
                                                            <label class="form-check-label" for="selectAll1"></label>
                                                        </div>
                                                    </th>
                                                    <th>Properties Name</th>
                                                    <th>Land Size</th>
                                                    <th>Price</th>
                                                    <th>Localisation</th>                                            
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($data_property as $property)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="propertyId[]" class="form-check-input" id="{{ $property->propertyId }}" value="{{ $property->propertyId }}">
                                                                <label class="form-check-label" for="{{ $property->propertyId }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class=" d-flex align-items-center">
                                                            <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                            <span class="fst-italic fs-12">{{ $property->property_name }}</span>                                                
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->bedroom }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fst-italic fs-12">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                                                <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $property->sub_region }}</span>
                                                            </div>
                                                        </td>
                                                        
                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex gap-2 justify-content-end mb-2 me-2">
                                        <button type="submit" class="btn btn-primary">Add to selected</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                                                        
                </div>
              

            </div>
        </form>
    </div>

    <div class="toast-container position-fixed end-0 top-0 p-3">
        <div id="liveToast2" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="auth-logo me-auto">
                    <img class="logo-dark" src="{{ asset('admin') }}/assets/images/logo-dark.png" alt="logo-dark" height="18" />
                    <img class="logo-light" src="{{ asset('admin') }}/assets/images/logo-light.png" alt="logo-light" height="18" />
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $errors->first('propertiesNull') }}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/flatpickr-min.js') }}"></script>

    @if ($errors->has('propertiesNull'))
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const toastLiveExample2 = document.getElementById('liveToast2');
                const toast = new bootstrap.Toast(toastLiveExample2);
                toast.show();
            });
        </script>
    @endif

    {{-- Flatpickr --}}
    <script>
        $("#date_visit").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>
    {{-- /* Flatpickr --}}

    {{-- Data Table --}}
    <script>
        $(document).ready(function() {
            $('#villaSelectedTable').DataTable();
            $('#villaRecommendationTable').DataTable();
            $('#landSelectedTable').DataTable();
            $('#landRecommendationTable').DataTable();
            $('#villaSelectedTablePopUp').DataTable();
            $('#propertiesTable').DataTable();
            $('#clientTable').DataTable();
        });
    </script>
    {{-- /* Data Table --}}

    {{-- Checkbox check all --}}
    <script>
        $('#selectAll').on('change', function() {
            $('.form-check-input').prop('checked', this.checked);
        });
    </script>
    {{-- /* Checkbox check all --}}

    {{-- Sweet Alert --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Saat halaman sudah ready
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let propertyName = this.getAttribute('data-nama');
                    let propertyId = this.parentElement.querySelector('.propertyId').value;

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete agent " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/agent/' + propertyId, {
                                    method: 'DELETE',
                                    headers: {
                                        'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                        'Content-Type': 'application/json'
                                    }
                                })
                                .then(response => response.json())
                                .then(data => {
                                    Swal.fire({
                                        title: data.judul,
                                        text: data.pesan,
                                        icon: data.swalFlashIcon,
                                    });

                                    // Optional: reload table / halaman
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
                                })
                                .catch(error => {
                                    console.error('Error:', error);
                                    Swal.fire('Error', 'Something went wrong!', 'error');
                                });
                        }
                    });
                });
            });
        });
    </script>
    {{-- /* End Sweet Alert --}}

    {{-- Logic untuk button offer docs disabled --}}
    <script>
    document.addEventListener('DOMContentLoaded', function () {
        const checkboxes = document.querySelectorAll('.property-checkbox');
        const offerBtn = document.getElementById('btn-offer-docs');
        const visitBtn = document.getElementById('btn-visit-docs');
        const selectedBtn = document.getElementById('btn-selected');

        function toggleOfferButton() {
            const checked = document.querySelectorAll('.property-checkbox:checked');
            offerBtn.disabled = (checked.length !== 1); // Only enable if exactly 1 selected
            visitBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected
            selectedBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected
        }

        checkboxes.forEach(cb => {
            cb.addEventListener('change', toggleOfferButton);
        });

        // Initial check in case checkbox already pre-checked
        toggleOfferButton();
    });
    </script>

@endpush
