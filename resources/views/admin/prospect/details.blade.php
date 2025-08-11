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
                                        <h3 class="fw-medium text-capitalize mb-0">{{ $customer->first_name  . ' ' . $customer->last_name }}</h3>
                                        <span class="badge bg-success fs-16 text-capitalize px-2 py-1">Status</span>
                                    </div>
                                    <button type="button" class="btn btn-primary">Edit Prospect</button>
                                </div>
                                <!-- Villa Detail Information -->
                                <div class="row">
                                    <div class="col-6">
                                        <h4 class="fw-medium text-capitalize">Details</h4>
                                        <p class="mb-1"><span class="fw-medium text-dark">Email</span><span class="mx-2">:</span>{{ $customer->cust_email ?? '-' }}</p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Whatsapp</span><span class="mx-2">:</span>{{ $customer->cust_phone ? '+' . $customer->cust_phone : '-' }}</p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Sign up date</span><span class="mx-2">:</span> {{ $customer->created_at->format('d F, Y') ?? '-' }} </p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Passport</span><span class="mx-2">:</span>{{ $customer->cust_passport ?? '-' }}</p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Nationality</span><span class="mx-2">:</span> {{  $customer->cust_nationality ?? '-'  }}</p>
                                        <p class="mb-1"><span class="fw-medium text-dark">Assigne to</span><span class="mx-2">:</span> {{  $agen ? $agen->name : '-' }}</p>
                                    </div>

                                    <div class="col-6">
                                        <h4 class="fw-medium text-capitalize">Looking for</h4>

                                        @php 
                                            $villaData = $prospects->where('type_asset' , 'properties')->first();
                                            $landData = $prospects->where('type_asset' , 'land')->first();
                                        @endphp
                                        <div class="mb-2">
                                            <span class="badge fs-16 bg-success me-1">Villa</span>
                                            <table class="w-100">
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Bedroom</span></td>
                                                    <td width="20px">:</td>
                                                    <td>{{ $villaData ? $villaData->min_bedroom . ' - ' . $villaData->max_bedroom : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Budget</span></td>
                                                    <td width="20px">:</td>
                                                    <td>
                                                        <span  >
                                                            IDR {{ number_format($villaData->min_budget_idr ?? 0, 0, ',', '.') }}
                                                            -
                                                            IDR {{ number_format($villaData->max_budget_idr ?? 0, 0, ',', '.') }}
                                                        </span> <br>
                                                        <span >
                                                            USD {{ number_format($villaData->min_budget_usd ?? 0, 2, ',', '.') }}
                                                            -
                                                            USD {{ number_format($villaData->max_budget_usd ?? 0, 2, ',', '.') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Localization</span></td>
                                                    <td width="20px">:</td>
                                                    <td>
                                                       {{ $villaData ? $villaData->localization : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Ready to buy</span></td>
                                                    <td width="20px">:</td>
                                                    <td>
                                                       {{ $villaData ? ($villaData->date ? date('d F, Y' , strtotime($villaData->date)) : '-') : '-' }}
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>

                                        <div>
                                            <span class="badge fs-16 bg-warning me-1">Land</span>
                                            <table class="w-100">
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Land size</span></td>
                                                    <td width="20px">:</td>
                                                    <td>{{ $landData ? $landData->min_land_size . ' - ' . $landData->max_land_size : '-' }}</td>
                                                </tr>
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Budget</span></td>
                                                    <td width="20px">:</td>
                                                    <td>
                                                        <span  >
                                                            IDR {{ number_format($landData->min_budget_idr ?? 0, 0, ',', '.') }}
                                                            -
                                                            IDR {{ number_format($landData->max_budget_idr ?? 0, 0, ',', '.') }}
                                                        </span> <br>
                                                        <span >
                                                            USD {{ number_format($landData->min_budget_usd ?? 0, 2, ',', '.') }}
                                                            -
                                                            USD {{ number_format($landData->max_budget_usd ?? 0, 2, ',', '.') }}
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Localization</span></td>
                                                    <td width="20px">:</td>
                                                    <td>
                                                       {{ $landData ? $landData->localization : '-' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td width="40px"><span class="fw-medium text-dark">Ready to buy</span></td>
                                                    <td width="20px">:</td>
                                                    <td>
                                                       {{ $landData ? ($landData->date ? date('d F, Y' , strtotime($villaData->date)) : '-') : '-' }}
                                                    </td>
                                                </tr>
                                            </table>
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
                                        <h4 class="fw-medium text-capitalize">Files Visit</h4>
                                        <div class="d-flex flex-wrap gap-2">
                                            <!-- Button Visit Dropdown -->
                                            @foreach($villaData->visitDocs as $visitDocs)
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <!-- <i class="ri-download-cloud-line fs-16 text-muted"></i>     -->
                                                        <iconify-icon icon="ph:file-fill" style="margin-bottom: -5px !important" class="fs-18 text-white"></iconify-icon>
                                                        Villa Visit Docs - {{ date('Y/m/d' , strtotime($visitDocs->visit_date)) }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a 
                                                            class="dropdown-item" 
                                                            href="{{ route('visit.pdf.english' , [
                                                                'email' => $visitDocs->email,
                                                                'phone_number' => $visitDocs->phone_number,
                                                                'first_name' => $visitDocs->first_name,
                                                                'last_name' => $visitDocs->last_name,
                                                                'visit_date' => $visitDocs->visit_date,
                                                                'internal_reference' => $agen ? $agen->reference_code : '-',
                                                                'properties' => $visitDocs->propertyVisitDocs->map(fn($item) => ['name' => $item->property->property_name , 'address' => $item->property->property_address , 'selling_price_idr' => $item->property->propertyFinancial->net_seller_idr , 'selling_price_usd' => $item->property->propertyFinancial->net_seller_usd])->toArray(),
                                                            ]) }}"
                                                        >English</a>
                                                        <a class="dropdown-item" href="#">Indonesia</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                            @foreach($landData->visitDocs as $visitDocs)
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <!-- <i class="ri-download-cloud-line fs-16 text-muted"></i>     -->
                                                        <iconify-icon icon="ph:file-fill" style="margin-bottom: -5px !important" class="fs-18 text-white"></iconify-icon>
                                                        Land Visit Docs - {{ date('Y/m/d' , strtotime($visitDocs->visit_date)) }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a 
                                                            class="dropdown-item" 
                                                            href="{{ route('visit.pdf.english' , [
                                                                'email' => $visitDocs->email,
                                                                'phone_number' => $visitDocs->phone_number,
                                                                'first_name' => $visitDocs->first_name,
                                                                'last_name' => $visitDocs->last_name,
                                                                'visit_date' => $visitDocs->visit_date,
                                                                'internal_reference' => $agen ? $agen->reference_code : '-',
                                                                'properties' => $visitDocs->landVisitDocs->map(fn($item) => ['name' => $item->land->land_name , 'address' => $item->land->land_address , 'selling_price_idr' => $item->land->landFinancial->net_seller_idr , 'selling_price_usd' => $item->land->landFinancial->net_seller_usd])->toArray(),
                                                            ]) }}"
                                                        >English</a>
                                                        <a class="dropdown-item" href="#">Indonesia</a>
                                                    </div>
                                                </div>
                                            @endforeach
                                        </div>

                                        <hr>

                                        <h4 class="fw-medium text-capitalize">Files Offerings</h4>
                                        <div class="d-flex flex-wrap gap-2">
                                            <!-- Button Visit Dropdown -->
                                            {{-- @foreach($villaData->visitDocs as $visitDocs)
                                                <div class="dropdown">
                                                    <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton1" data-bs-toggle="dropdown" aria-expanded="false">
                                                        <!-- <i class="ri-download-cloud-line fs-16 text-muted"></i>     -->
                                                        <iconify-icon icon="ph:file-fill" style="margin-bottom: -5px !important" class="fs-18 text-white"></iconify-icon>
                                                        Villa Offerings Docs - {{ date('Y/m/d' , strtotime($visitDocs->visit_date)) }}
                                                    </button>
                                                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton1">
                                                        <a class="dropdown-item" href="#">English</a>
                                                        <a class="dropdown-item" href="#">Indonesia</a>
                                                    </div>
                                                </div>
                                            @endforeach --}}
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
                                        Villa Selected <span class="badge bg-success text-capitalize ms-2">{{ $villaData ? $villaData->propertySelected->count() : '-' }}</span>
                                    </button>
                                </h2>
                                <div id="collapseOne" class="accordion-collapse show collapse" aria-labelledby="headingOne" data-bs-parent="#accordionExample">
                                    <form></form>
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
                                                @foreach ($villaData->propertySelected as $prospectVillaSelected)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="asset_id[]" class="form-check-input property-checkbox" id="{{ $prospectVillaSelected->properties_id }}" value="{{ $prospectVillaSelected->properties_id }}">
                                                                <label class="form-check-label" for="{{ $prospectVillaSelected->properties_id }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class="d-flex align-items-center">
                                                            <img src="{{ asset($prospectVillaSelected->property->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                            <span class="fst-italic fs-12">{{ $prospectVillaSelected->property->property_name }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $prospectVillaSelected->property->bedroom }}</span>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fst-italic fs-12">IDR {{ number_format($prospectVillaSelected->property->net_seller_idr, 2, ',', '.') }}</span>
                                                                <span class="fst-italic fs-12">$ {{ number_format($prospectVillaSelected->property->selling_price_usd, 2, ',', '.') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $prospectVillaSelected->property->sub_region }}</span>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end mb-2 me-2 gap-2">
                                        <button type="button" class="btn btn-warning" data-bs-toggle="modal" id="btn-visit-docs" data-bs-target="#visitDoc-1">Create visit docs</button>
                                        <button type="button" class="btn btn-primary" id="btn-offer-docs">Create offer docs</button>

                                        <!-- Modal -->
                                        <div class="modal modal-lg fade" id="visitDoc-1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('visit.store') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="prospect_id" value="{{ $villaData->id }}" />
                                                    <input type="hidden" name="customer_id" value="{{ $customer->id }}" />
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
                                                                        <tbody id="villa-modal-selected">
                                                                            {{-- @foreach ($data_property as $property)
                                                                                <tr>
                                                                                    <td class="d-flex align-items-center">
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
                                                                                            <span class="fst-italic fs-12">IDR {{ number_format($property->net_seller_idr, 2, ',', '.') }}</span>
                                                                                            <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                                                        </div>
                                                                                    </td>
                                                                                    <td>
                                                                                        <div class="d-flex flex-column gap-1">
                                                                                            <span class="fst-italic fs-12">{{ $property->sub_region }}</span>
                                                                                        </div>
                                                                                    </td>

                                                                                </tr>
                                                                            @endforeach --}}

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 mb-3" id="group_date_visit">
                                                                <label>Input Date</label>
                                                                <input type="text" name="date_visit" class="form-control date_visit @error('date_visit') validation-form @enderror" placeholder="Input Visit Date">

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
                                                </form>

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
                                    <form action="{{ route('prospects.addAsset') }}" method="POST">
                                        @csrf
                                        <input type="hidden" name="prospect_id" value="{{ $villaData->id }}">
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
                                                                    <input type="checkbox" name="asset_id[]" class="form-check-input villa-recomendation-checkboxes" id="{{ $property->id }}" value="{{ $property->id }}">
                                                                    <label class="form-check-label" for="{{ $property->id }}">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                            <td class="d-flex align-items-center">
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
                                                                    <span class="fst-italic fs-12">IDR {{ number_format($property->net_seller_idr, 2, ',', '.') }}</span>
                                                                    <span class="fst-italic fs-12">$ {{ number_format($property->net_seller_usd, 2, ',', '.') }}</span>
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
                                        <div class="d-flex justify-content-end mb-2 me-2 gap-2">
                                            <button type="submit" class="btn btn-primary" id="btn-villa-recomendation-select">Add to selected</button>
                                        </div>
                                    </form>
                                </div>

                            </div>

                            <!-- Land Selected -->
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="headingThree">
                                    <button class="fs-18 accordion-button fw-medium collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                        Land Selected <span class="badge bg-warning text-capitalize ms-2">{{ $landData ? $landData->landSelected->count() : '-' }}</span>
                                    </button>
                                </h2>
                                <div id="collapseThree" class="accordion-collapse collapse" aria-labelledby="headingThree" data-bs-parent="#accordionExample">
                                    <form></form> 
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
                                                @foreach ($landData->landSelected as $prospectLandSelected)
                                                    <tr>
                                                        <td>
                                                            <div class="form-check">
                                                                <input type="checkbox" name="land_id[]" class="form-check-input land-checkbox" id="{{ $prospectLandSelected->land_id }}" value="{{ $prospectLandSelected->land_id }}">
                                                                <label class="form-check-label" for="{{ $prospectLandSelected->land_id }}">&nbsp;</label>
                                                            </div>
                                                        </td>
                                                        <td class="d-flex align-items-center">
                                                            <img src="{{ asset($prospectLandSelected->land->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                            <span class="fst-italic fs-12">{{ $prospectLandSelected->land->land_name }}</span>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $prospectLandSelected->land->total_land_area }} are</span>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="d-flex flex-column">
                                                                <span class="fst-italic fs-12">IDR {{ number_format($prospectLandSelected->land->landFinancial->net_seller_idr, 2, ',', '.') }}</span>
                                                                <span class="fst-italic fs-12">$ {{ number_format($prospectLandSelected->land->landFinancial->net_seller_usd, 2, ',', '.') }}</span>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="d-flex flex-column gap-1">
                                                                <span class="fst-italic fs-12">{{ $prospectLandSelected->land->sub_region }}</span>
                                                            </div>
                                                        </td>

                                                    </tr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="d-flex justify-content-end mb-2 me-2 gap-2">
                                        <button type="button" class="btn btn-warning" id="btn-visit-docs-land" data-bs-toggle="modal" data-bs-target="#visitDoc-2">Create visit docs</button>
                                        <button type="button" class="btn btn-primary" id="btn-offer-docs-land">Create offer docs</button>

                                        <!-- Modal -->
                                        <div class="modal modal-lg fade" id="visitDoc-2" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('visit.store') }}" method="POST">
                                                    @csrf

                                                    <input type="hidden" name="prospect_id" value="{{ $landData->id }}" />
                                                    <input type="hidden" name="customer_id" value="{{ $customer->id }}" />
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Lands Selected </h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="col-lg-12">
                                                                <div class="table-responsive">
                                                                    <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="landSelectedTablePopUp">
                                                                        <thead class="table-light">
                                                                            <tr>
                                                                                <th>Properties Name</th>
                                                                                <th>Bedroom</th>
                                                                                <th>Price</th>
                                                                                <th>Localisation</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody id="land-modal-selected">

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <div class="col-lg-4 mb-3" id="group_date_visit">
                                                                <label>Input Date</label>
                                                                <input type="text"  name="date_visit" class="form-control date_visit @error('date_visit') validation-form @enderror" placeholder="Input Visit Date">

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
                                                </form>

                                            </div>
                                        </div>
                                        <!-- /* Modal -->
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
                                    <form action="{{ route('prospects.addAsset') }}" method="POST">
                                        @csrf
                                        <div class="table-responsive">
                                            <input type="hidden" name="prospect_id" value="{{ $landData->id }}">
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
                                                    @foreach ($data_land as $land)
                                                        <tr>
                                                            <td>
                                                                <div class="form-check">
                                                                    <input type="checkbox" name="asset_id[]" class="form-check-input land-recomendation-checkboxes" id="{{ $land->id }}" value="{{ $land->id }}">
                                                                    <label class="form-check-label" for="{{ $land->id }}">&nbsp;</label>
                                                                </div>
                                                            </td>
                                                            <td class="d-flex align-items-center">
                                                                <img src="{{ asset($land->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-md border-light border-3 rounded border" alt="...">
                                                                <span class="fst-italic fs-12">{{ $land->land_name }}</span>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column gap-1">
                                                                    <span class="fst-italic fs-12">{{ $land->total_land_area }} are</span>
                                                                </div>
                                                            </td>

                                                            <td>
                                                                <div class="d-flex flex-column">
                                                                    <span class="fst-italic fs-12">IDR {{ number_format($land->net_seller_idr, 2, ',', '.') }}</span>
                                                                    <span class="fst-italic fs-12">$ {{ number_format($land->net_seller_usd, 2, ',', '.') }}</span>
                                                                </div>
                                                            </td>
                                                            <td>
                                                                <div class="d-flex flex-column gap-1">
                                                                    <span class="fst-italic fs-12">{{ $land->sub_region }}</span>
                                                                </div>
                                                            </td>

                                                        </tr>
                                                    @endforeach

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="d-flex justify-content-end mb-2 me-2 gap-2">
                                            <button type="submit" class="btn btn-primary" id="btn-land-recomendation-select">Add to selected</button>
                                        </div>
                                    </form>
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
        $(".date_visit").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>
    {{-- /* Flatpickr --}}

    {{-- Data Table --}}
    <script>

        let villaSelectedTablePopUp = null;
        let landSelectedTablePopUp = null;
        $(document).ready(function() {
            $('#villaSelectedTable').DataTable();
            $('#villaRecommendationTable').DataTable();
            $('#landSelectedTable').DataTable();
            $('#landRecommendationTable').DataTable();
            villaSelectedTablePopUp = $('#villaSelectedTablePopUp').DataTable();
            landSelectedTablePopUp = $('#landSelectedTablePopUp').DataTable();
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

    {{-- Logic untuk button offer docs disabled villa --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const properties = @json($data_property);
            const checkboxes = document.querySelectorAll('.property-checkbox');
            const offerBtn = document.getElementById('btn-offer-docs');
            const visitBtn = document.getElementById('btn-visit-docs');
            const tbody = document.getElementById('villa-modal-selected');
            // const selectedBtn = document.getElementById('btn-selected');

            function createPropertyRow(property) {
                villaSelectedTablePopUp.row.add([
                    `<div class="d-flex align-items-center">
                        <img src="${property.image_path || '/admin/assets/images/placeholder.webp'}" class="avatar-md border-light border-3 rounded border" alt="...">
                        <span class="fst-italic fs-12">${property.property_name}</span>
                        <input type="hidden" name="asset_ids[]" value="${property.id}"/>
                    </div>`,
                    `<div class="d-flex flex-column gap-1">
                        <span class="fst-italic fs-12">${property.bedroom ?? '-'}</span>
                    </div>`,
                    `<div class="d-flex flex-column">
                        <span class="fst-italic fs-12">IDR ${formatCurrency(property.net_seller_idr)}</span>
                        <span class="fst-italic fs-12">$ ${formatCurrency(property.net_seller_usd, "us")}</span>
                    </div>`,
                    `<div class="d-flex flex-column gap-1">
                        <span class="fst-italic fs-12">${property.sub_region ?? '-'}</span>
                    </div>`
                ]).draw(); 
            }

            // Helper function for formatting currency
            function formatCurrency(value, type = "id") {
                if (typeof value !== "number") return "0,00";

                return type === "id"
                    ? value.toLocaleString("id-ID", { minimumFractionDigits: 2 })
                    : value.toLocaleString("en-US", { minimumFractionDigits: 2 });
            }


            function toggleOfferButton() {
                const checked = document.querySelectorAll('.property-checkbox:checked');
                offerBtn.disabled = (checked.length !== 1); // Only enable if exactly 1 selected
                visitBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected
                // selectedBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected

                let properties_ids = [];

                checked.forEach(input => {
                    properties_ids.push(Number(input.value));
                });

                const properties_selected = properties.filter((item) => properties_ids.includes(item.id));

                if(villaSelectedTablePopUp) {
                    villaSelectedTablePopUp.clear().draw();
                }

                let renderTable = '';
                properties_selected.forEach((property) => {
                    property.net_seller_usd = typeof property.net_seller_usd == 'string'  ? parseFloat(property.net_seller_usd) : property.net_seller_usd;
                    createPropertyRow(property);
                });

                
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', toggleOfferButton);
            });

            // Initial check in case checkbox already pre-checked
            toggleOfferButton();
        });
    </script>


    {{-- Logic untuk button offer docs disabled land --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const lands = @json($data_land);
            const checkboxes = document.querySelectorAll('.land-checkbox');
            const offerBtn = document.getElementById('btn-offer-docs-land');
            const visitBtn = document.getElementById('btn-visit-docs-land');
            const tbody = document.getElementById('land-modal-selected');
            // const selectedBtn = document.getElementById('btn-selected');

            function createPropertyRow(land) {
                landSelectedTablePopUp.row.add([
                    `<div class="d-flex align-items-center">
                        <img src="${land.image_path || '/admin/assets/images/placeholder.webp'}" class="avatar-md border-light border-3 rounded border" alt="...">
                        <span class="fst-italic fs-12">${land.land_name}</span>
                        <input type="hidden" name="asset_ids[]" value="${land.id}"/>
                    </div>`,
                    `<div class="d-flex flex-column gap-1">
                        <span class="fst-italic fs-12">${land.bedroom ?? '-'}</span>
                    </div>`,
                    `<div class="d-flex flex-column">
                        <span class="fst-italic fs-12">IDR ${formatCurrency(land.net_seller_idr)}</span>
                        <span class="fst-italic fs-12">$ ${formatCurrency(land.net_seller_usd, "us")}</span>
                    </div>`,
                    `<div class="d-flex flex-column gap-1">
                        <span class="fst-italic fs-12">${land.sub_region ?? '-'}</span>
                    </div>`
                ]).draw(); 
            }

            // Helper function for formatting currency
            function formatCurrency(value, type = "id") {
                if (typeof value !== "number") return "0,00";

                return type === "id"
                    ? value.toLocaleString("id-ID", { minimumFractionDigits: 2 })
                    : value.toLocaleString("en-US", { minimumFractionDigits: 2 });
            }


            function toggleOfferButton() {
                const checked = document.querySelectorAll('.land-checkbox:checked');
                offerBtn.disabled = (checked.length !== 1); // Only enable if exactly 1 selected
                visitBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected
                // selectedBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected

                let land_ids = [];

                checked.forEach(input => {
                    land_ids.push(Number(input.value));
                });

                const land_selected = lands.filter((item) => land_ids.includes(item.id));

                if(landSelectedTablePopUp) {
                    landSelectedTablePopUp.clear().draw();
                }

                let renderTable = '';
                land_selected.forEach((property) => {
                    property.net_seller_usd = typeof property.net_seller_usd == 'string'  ? parseFloat(property.net_seller_usd) : property.net_seller_usd;
                    createPropertyRow(property);
                });

                
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', toggleOfferButton);
            });

            // Initial check in case checkbox already pre-checked
            toggleOfferButton();
        });
    </script>

    {{-- Logic untuk Land Recomendation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.land-recomendation-checkboxes');
            const selectBtn = document.querySelector('#btn-land-recomendation-select');

            function toggleLandRecomendationSelect() {
                const checked = document.querySelectorAll('.land-recomendation-checkboxes:checked');
                selectBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', toggleLandRecomendationSelect);
            });

            toggleLandRecomendationSelect();

            // const checkboxes = landRecomendationForm.querySelectorAll('input[name="land_id[]"]');
        });
    </script>

    {{-- Logic untuk Villa Recommendation --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const checkboxes = document.querySelectorAll('.villa-recomendation-checkboxes');
            const selectBtn = document.querySelector('#btn-villa-recomendation-select');

            function toggleVillaRecomendationSelect() {
                const checked = document.querySelectorAll('.villa-recomendation-checkboxes:checked');
                selectBtn.disabled = (checked.length == 0); // Only enable if 1 or more selected
            }

            checkboxes.forEach(cb => {
                cb.addEventListener('change', toggleVillaRecomendationSelect);
            });

            toggleVillaRecomendationSelect();

            // const checkboxes = landRecomendationForm.querySelectorAll('input[name="land_id[]"]');
        });
    </script>

@endpush
