<div class="row mt-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom" style="border-radius: 10px 10px 0px 0px">
                <div>
                    <h4 class="card-title">Specific Property List</h4>
                </div>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-hover table-centered table text-nowrap" id="myTable">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Leads Name</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Phone</th>
                                <th scope="col">Location</th>
                                <th scope="col">Ready to Buy</th>
                                <th scope="col">Looking For</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data_leads as $leads => $lead)
                                @php
                                    $customerData = $lead->first();
                                @endphp

                                {{-- {{ dd($customerData) }} --}}
                                {{-- {{ dd($lead) }} --}}

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->customer_id }}" class="showDetailsSpecific cursor-pointer" data-customer-id="{{ $customerData->customer_id }}">
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="d-block">
                                                <h5 class="text-dark fw-medium mb-0">{{ $customerData->first_name . ' ' . $customerData->last_name }}</h5>
                                                <p class="fs-13 mb-0">{{ $customerData->cust_email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->customer_id }}" class="showDetailsSpecific cursor-pointer" data-customer-id="{{ $customerData->customer_id }}">
                                        <span class="badge bg-primary text-light"> {{ $customerData->agent_code }}</span>
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->customer_id }}" class="showDetailsSpecific cursor-pointer" data-customer-id="{{ $customerData->customer_id }}">
                                        <p class="mb-0">{{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_phone), 4)) }}</p>
                                    </td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->customer_id }}" class="showDetailsSpecific cursor-pointer text-capitalize" data-customer-id="{{ $customerData->customer_id }}"> {{ $customerData->localization }}</td>

                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->customer_id }}" class="showDetailsSpecific cursor-pointer" data-customer-id="{{ $customerData->customer_id }}">{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->customer_id }}" class="showDetailsSpecific cursor-pointer" data-customer-id="{{ $customerData->customer_id }}">
                                        @foreach (collect($lead)->unique('type_asset') as $ld)
                                            @if ($ld->type_asset == 'properties' && $ld->visibility == 1)
                                                <span class="text-capitalize fw-medium badge bg-success">properties</span>
                                            @elseif ($ld->type_asset == 'land' && $ld->visibility == 1)
                                                <span class="text-capitalize fw-medium badge bg-warning">land</span>
                                            @endif
                                        @endforeach
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#makeProspect-{{ $customerData->id }}">
                                            <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon> Edit Data Leads
                                        </button>

                                        <input type="hidden" class="propertyId" value="{{ $customerData->id }}">
                                        <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $customerData->cust_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                        {{-- Modal Make to Prospect --}}

                                        {{-- END Modal Make to Prospect --}}

                                    </td>

                                </tr>

                                {{-- Modal Edit Data Leads --}}
                                <div class="modal modal-lg fade" id="makeProspect-{{ $customerData->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Please check & update the leads file</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('leads.update', $customerData->customer_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <x-form-input className="col-lg-3" type="text" name="customer_first_name" label="First Name" value="{{ $customerData->first_name }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_last_name" label="Last Name" value="{{ $customerData->last_name }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_email" label="Email" value="{{ $customerData->cust_email }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_phone" label="Phone" value="{{ $customerData->cust_phone }}" />

                                                        @php
                                                            $isVillaChecked = collect($lead)->contains(function ($item) {
                                                                return $item->type_asset === 'properties' && $item->visibility == 1;
                                                            });
                                                            $isLandChecked = collect($lead)->contains(function ($item) {
                                                                return $item->type_asset === 'land' && $item->visibility == 1;
                                                            });
                                                        @endphp

                                                        {{-- Looking For --}}
                                                        <div class="col-lg-3 mb-3">
                                                            <label for="leads_looking_for" class="form-label text-muted">Looking For</label>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="type_properties_villa_{{ $customerData->id }}" data-index="{{ $customerData->id }}" name="type_properties_villa" {{ $isVillaChecked ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="type_properties_villa_{{ $customerData->id }}">
                                                                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z" fill="#063436"></path>
                                                                    </svg>
                                                                    Villa
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" id="type_properties_land_{{ $customerData->id }}" data-index="{{ $customerData->id }}" name="type_properties_land" {{ $isLandChecked ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="type_properties_land_{{ $customerData->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                        fill="#063436" viewBox="0 0 24 24">
                                                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2M5 19V5h14v14z"></path>
                                                                        <path d="M12 9h3v3h2V7h-5zM9 12H7v5h5v-2H9z"></path>
                                                                    </svg>
                                                                    Land
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <x-form-input className="col-lg-3" type="text" name="ready_buy_villa" label="Ready to Buy*" value="{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_nationality" label="Nationality" value="{{ $customerData->cust_nationality }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_passport" label="Passport Number" value="{{ $customerData->cust_passport }}" />

                                                    </div>

                                                    @php
                                                        $villaData = $customerData->where('customer_id', $customerData->customer_id)->where('type_asset', 'properties')->first();
                                                        $landData = $customerData->where('customer_id', $customerData->customer_id)->where('type_asset', 'land')->first();
                                                    @endphp

                                                    {{-- VILLA --}}
                                                    <div class="villa-section" data-index="{{ $customerData->id }}" id="villa_section" style="display: none;">
                                                        <div class="d-flex justify-content-center justify-items-center text-center" bis_skin_checked="1">
                                                            <hr class="w-100">
                                                            <label class="w-100 text-success">
                                                                <span class="nav-icon">
                                                                    <i class="ri-community-line"></i>
                                                                </span>
                                                                Looking For Villa {{ $villaData->localization ?? "" }}
                                                            </label>
                                                            <hr class="w-100">
                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="col-lg-12 mb-3" id="group_villa_localization">
                                                                <label for="villa_localization" class="form-label">Localization</label>
                                                                <select id="villa_localization" class="form-select" name="villa_localization">
                                                                    <option value="" selected disabled>Select Area</option>
                                                                    <option value="ubud" {{ ($villaData->localization ?? '') == 'ubud' ? 'selected' : '' }}>Ubud</option>
                                                                    <option value="canggu" {{ ($villaData->localization ?? '') == 'canggu' ? 'selected' : '' }}>Canggu</option>
                                                                    <option value="uluwatu" {{ ($villaData->localization ?? '') == 'uluwatu' ? 'selected' : '' }}>Uluwatu</option>
                                                                    <option value="sanur/nusa dua" {{ ($villaData->localization ?? '') == 'sanur/nusa dua' ? 'selected' : '' }}>Sanur/Nusa Dua</option>
                                                                    <option value="other" {{ ($villaData->localization ?? '') == 'other' ? 'selected' : '' }}>Other</option>
                                                                </select>
                                                            </div>

                                                            @if (!isset($villaData->min_budget_idr) && !isset($villaData->max_budget_idr) && !isset($villaData->min_budget_usd) && !isset($villaData->max_budget_usd))
                                                                <x-form-input className="col-lg-3" type="text" name="villa_min_budget_idr" label="Budget Min" />
                                                                <x-form-input className="col-lg-3" type="text" name="villa_max_budget_idr" label="Budget Max" />
                                                            @endif

                                                            @if ($villaData && $villaData->min_budget_idr !== null && $villaData->max_budget_idr !== null)
                                                                <x-form-input className="col-lg-3" type="text" name="villa_min_budget_idr" label="Budget Min" value="{{ $villaData->min_budget_idr }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="villa_max_budget_idr" label="Budget Max" value="{{ $villaData->max_budget_idr }}" />
                                                            @elseif ($villaData && $villaData->min_budget_usd !== null && $villaData->max_budget_usd !== null)
                                                                <x-form-input className="col-lg-3" type="text" name="villa_min_budget_usd" label="Budget Min" value="{{ $villaData->min_budget_usd }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="villa_max_budget_usd" label="Budget Max" value="{{ $villaData->max_budget_usd }}" />
                                                            @endif

                                                            <x-form-input className="col-lg-3" type="text" name="min_bedroom" label="Bedroom Min" value="{{ $villaData->min_bedroom ?? '' }}" />
                                                            <x-form-input className="col-lg-3" type="text" name="max_bedroom" label="Bedroom Max" value="{{ $villaData->max_bedroom ?? '' }}" />
                                                        </div>
                                                    </div>

                                                    {{-- LAND --}}
                                                    <div class="land-section" data-index="{{ $customerData->id }}" id="land_section" style="display: none;">
                                                        <div class="d-flex justify-content-center justify-items-center text-center" bis_skin_checked="1">
                                                            <hr class="w-100">
                                                            <label class="w-100 text-warning">
                                                                <span class="nav-icon">
                                                                    <iconify-icon icon="tabler:chart-area-line-filled" class="fs-16 align-middle"></iconify-icon>
                                                                </span>
                                                                Looking For Land
                                                            </label>
                                                            <hr class="w-100">
                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="col-lg-12 mb-3" id="group_land_localization">
                                                                <label for="land_localization" class="form-label">Localization</label>
                                                                <select id="land_localization" class="form-select" name="land_localization">
                                                                    <option value="" selected disabled>Select Area</option>
                                                                    <option value="ubud" {{ (!is_null($landData) && $landData->localization ? $landData->localization : '') == 'ubud' ? 'selected' : '' }}>Ubud</option>
                                                                    <option value="canggu" {{ (!is_null($landData) && $landData->localization ? $landData->localization : '') == 'canggu' ? 'selected' : '' }}>Canggu</option>
                                                                    <option value="uluwatu" {{ (!is_null($landData) && $landData->localization ? $landData->localization : '') == 'uluwatu' ? 'selected' : '' }}>Uluwatu</option>
                                                                    <option value="sanur/nusa dua" {{ (!is_null($landData) && $landData->localization ? $landData->localization : '') == 'sanur/nusa dua' ? 'selected' : '' }}>Sanur/Nusa Dua</option>
                                                                    <option value="other" {{ (!is_null($landData) && $landData->localization ? $landData->localization : '') == 'other' ? 'selected' : '' }}>Other</option>
                                                                </select>
                                                            </div>

                                                            <x-form-input className="col-lg-3" type="text" name="land_min_budget_idr" label="Budget Min" value="{{ !is_null($landData) && $landData->min_budget_idr ? $landData->min_budget_idr : '' }}" />
                                                            <x-form-input className="col-lg-3" type="text" name="land_max_budget_idr" label="Budget Max" value="{{ !is_null($landData) && $landData->max_budget_idr ? $landData->max_budget_idr : '' }}" />

                                                            <x-form-input className="col-lg-3" type="text" name="min_land_size" label="Size Min" value="{{ !is_null($landData) && $landData->min_land_size ? $landData->min_land_size : '' }}" />
                                                            <x-form-input className="col-lg-3" type="text" name="max_land_size" label="Size Max" value="{{ !is_null($landData) && $landData->max_land_size ? $landData->max_land_size : '' }}" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer" bis_skin_checked="1">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Make to prosect</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                {{-- END Modal Edit Data Leads --}}
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($data_leads as $leads => $lead)
                        @php
                            $customerData = $lead->first();
                            $customerDataProperties = $lead->where('type_asset', 'properties')->first();
                            $customerDataLand = $lead->where('type_asset', 'land')->first();

                            // dd($customerDataProperties);

                        @endphp

                        <!-- Modal -->
                        <div class="modal modal-xl fade" id="seeProperties-{{ $customerData->customer_id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Properties Selected</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">
                                        @if(!is_null($customerDataProperties))
                                            <div id="detailsVilla">
                                                <!-- Information Leads Villa -->
                                                <div class="d-flex align-items-center gap-2">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Lead Information :</h5> <span class="badge bg-success me-1">Villa</span>
                                                </div>
                                                <div class="d-flex my-2 gap-2">
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-16 align-middle"></iconify-icon> {{ $customerDataProperties->first_name . ' ' . $customerDataProperties->last_name }}</span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-16 align-middle"></iconify-icon> {{ $customerDataProperties?->cust_email ?? '' }}</span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerDataProperties?->cust_phone ?? ''), 4)) }}</span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"> {{ \Carbon\Carbon::parse($customerDataProperties?->date ?? '')->format('d F, Y') }}</span>

                                                    <span class="badge bg-warning text-light p-1" style="font-size: 14px">
                                                        IDR {{ number_format($customerDataProperties?->min_budget_idr ?? 0, 0, ',', '.') }}
                                                        -
                                                        IDR {{ number_format($customerDataProperties?->max_budget_idr ?? 0, 0, ',', '.') }}
                                                    </span>
                                                    <span class="badge bg-success text-light p-1" style="font-size: 14px">
                                                        USD {{ number_format($customerDataProperties?->min_budget_usd ?? 0, 2, ',', '.') }}
                                                        -
                                                        USD {{ number_format($customerDataProperties?->max_budget_usd ?? 0, 2, ',', '.') }}
                                                    </span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:bed-outline" class="fs-16 align-middle"></iconify-icon> {{ $customerDataProperties->min_bedroom . ' - ' . $customerDataProperties->max_bedroom }} </span>
                                                </div>

                                                @if (isset($customerDataProperties->properties_id) && $customerDataProperties->properties_id !== null)
                                                    <div class="table-responsive">
                                                        <table class="table-hover table-centered table text-nowrap" id="tableProperties_specificLeads-{{ $customerData->customer_id }}">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Property Name</th>
                                                                    <th scope="col">Agent</th>
                                                                    <th scope="col">Bedroom</th>
                                                                    <th scope="col">Price</th>
                                                                    <th scope="col">Property Address</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody class="tableContentProperties_specificLeads-{{ $customerData->customer_id }}">
                                                                {{-- <tbody>
                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Villa Agung</td>
                                                                    <td>BPM-MASTER-3213</td>
                                                                    <td>5</td>
                                                                    <td>
                                                                        <div class="d-block" bis_skin_checked="1">
                                                                            <h5 class="text-dark fw-medium mb-0" data-bs-toggle="modal" data-bs-target="#editMatchProperties-4">
                                                                                IDR 4.000.000.000
                                                                            </h5>
                                                                            <p class="fs-13 mb-0">USD 400.000</p>
                                                                        </div>
                                                                    </td>
                                                                    <td>Jl Raya Kuta No 44 Kuta, Badung</td>
                                                                </tr> --}}
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                @endif

                                                <!-- End Information Leads Villa -->
                                            </div>
                                        @endif

                                        @if(!is_null($customerDataProperties) && !is_null($customerDataLand))
                                            <hr class="my-4">
                                        @endif

                                        @if (isset($customerDataLand->land_id) && $customerDataLand->land_id !== null)
                                            <!-- Information Leads Lands -->
                                            <div id="detailsLand">
                                                <div class="d-flex align-items-center gap-2">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Lead Information :</h5><span class="badge bg-warning me-1">Land</span>
                                                </div>
                                                <div class="d-flex my-2 gap-2">
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-16 align-middle"></iconify-icon> {{ $customerDataLand->first_name . ' ' . $customerDataLand->last_name }}</span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-16 align-middle"></iconify-icon> {{ $customerDataLand->cust_email }}</span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerDataLand->cust_phone), 4)) }}</span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"> {{ \Carbon\Carbon::parse($customerDataLand->date)->format('d F, Y') }}</span>
                                                    <span class="badge bg-warning p-1" style="font-size: 14px">
                                                        IDR {{ number_format($customerDataLand->min_budget_idr, 0, ',', '.') }}
                                                        -
                                                        IDR {{ number_format($customerDataLand->max_budget_idr, 0, ',', '.') }}
                                                    </span>
                                                    <span class="badge bg-success p-1" style="font-size: 14px">
                                                        USD {{ number_format($customerDataLand->min_budget_usd, 2, ',', '.') }}
                                                        -
                                                        USD {{ number_format($customerDataLand->max_budget_usd, 2, ',', '.') }}
                                                    </span>
                                                    <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:fullscreen" class="fs-16 align-middle"></iconify-icon> {{ $customerDataLand->min_land_size . ' - ' . $customerDataLand->max_land_size }} m² </span>
                                                </div>
                                                <div class="table-responsive">
                                                    <table class="table-hover table-centered table text-nowrap" id="tableLand_specificLeads-{{ $customerData->customer_id }}">
                                                        <thead class="table-light">
                                                            <tr>
                                                                <th scope="col">No</th>
                                                                <th scope="col">Land Name</th>
                                                                <th scope="col">Agent</th>
                                                                <th scope="col">Size</th>
                                                                <th scope="col">Price</th>
                                                                <th scope="col">Property Address</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody class="tableContentLand_specificLeads-{{ $customerData->customer_id }}">
                                                            {{-- <tr>
                                                            <td>1</td>
                                                            <td>1</td>
                                                            <td>1</td>
                                                            <td>200 m²</td>
                                                            <td>
                                                                <div class="d-block">
                                                                    <h5 class="text-dark fw-medium mb-0"
                                                                        data-bs-toggle="modal" data-bs-target="#editMatchProperties-{{ $customerData->id }}">
                                                                        IDR 4.000.000.00000
                                                                    </h5>
                                                                    <p class="fs-13 mb-0">USD 400.000</p>
                                                                </div>
                                                            </td>
                                                            <td>Address</td>
                                                        </tr> --}}
                                                        </tbody>
                                                    </table>
                                                </div>
                                                <!-- End Information Leads Lands -->
                                            </div>
                                        @endif
                                    </div>
                                    <form action="{{ route('leadsToProspect', $customerData->customer_id) }}" method="POST">
                                        @csrf
                                        <div class="modal-footer">
                                            @role('master')
                                                <div class="propertiesDataLeads"></div>
                                                <div class="row" style="min-width: 200px">
                                                    <select class="form-control choose_agent" name="agent_code" id="choose_agent-{{ $customerData->id }}">
                                                        <option value="{{ $customerData->id }}">{{ $customerData->agent_code }}</option>
                                                    </select>
                                                </div>
                                            @endrole
                                            @role('agent')
                                                <div class="propertiesDataLeads"></div>
                                                <div class="row" style="min-width: 200px">
                                                    <select class="form-control choose_agent" name="agent_code" id="choose_agent-{{ $customerData->id }}">
                                                        <option value="{{ $customerData->id }}">{{ Auth::user()->name }}</option>
                                                    </select>
                                                </div>
                                            @endrole
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            {{-- <button type="submit" class="btn btn-primary">Save Leads</button> --}}
                                        </div>
                                    </form>

                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul class="mb-0">
                                                @foreach ($errors->all() as $message)
                                                    <li>{{ $message }}</li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <!-- /* Modal -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
