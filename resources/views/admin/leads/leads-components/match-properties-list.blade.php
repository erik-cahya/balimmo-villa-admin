<div class="row">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <h4 class="card-title">Property Matches</h4>
                </div>
            </div>

            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-hover table-centered table text-nowrap" id="specificPropertyTable">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Leads Name</th>
                                <th scope="col">Agent</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Localization</th>
                                <th scope="col">Ready To Buy</th>
                                <th scope="col">Looking For</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data_leads_matches as $leadsData => $LeadsMatch)
                                @php
                                    $matchLeads = $LeadsMatch->first(); // ambil lead pertama
                                    $authUser = Auth::user();
                                    $referenceCode = $authUser->role === 'Master' ? null : $authUser->reference_code;
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>

                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $matchLeads->id }}" class="showDetails cursor-pointer" data-data-id="{{ $matchLeads->id }}">
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="d-block">
                                                <h5 class="text-dark fw-medium mb-0">{{ $matchLeads->first_name . ' ' . $matchLeads->last_name }}</h5>
                                                <p class="fs-13 mb-0">{{ $matchLeads->cust_email }}</p>
                                            </div>
                                        </div>
                                    </td>

                                    <td>
                                        <div class="matching-container" data-lead-id="{{ $matchLeads->id }}">

                                            <div class="propertiesData d-flex flex-column gap-1"></div>

                                            <div class="noProperties" style="display: none;">
                                                <span class="badge bg-primary text-light"> No Match Agent</span>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $matchLeads->cust_phone), 4)) }}</p>
                                    </td>

                                    <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> {{ $matchLeads->localization }}</td>
                                    <td>
                                        <iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($matchLeads->date)->format('d F, Y') }}

                                    </td>
                                    <td>
                                        @foreach ($LeadsMatch as $leads)
                                            @php
                                                if ($leads->type_asset == 'villa' && $leads->visibility == 1) {
                                                    $className = 'bg-success';
                                                } elseif ($leads->type_asset == 'land' && $leads->visibility == 1) {
                                                    $className = 'bg-danger';
                                                } else {
                                                    $className = 'd-none';
                                                }
                                            @endphp
                                            <span class="text-capitalize fw-medium badge {{ $className }}">{{ $leads->type_asset }}</span>
                                        @endforeach
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#editLeads-{{ $matchLeads->id }}">
                                            <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon> Make to Prospect
                                        </button>

                                        {{-- Delete Button --}}
                                        @if (Auth::user()->role == 'Master')
                                            <input type="hidden" class="customerID" value="{{ $matchLeads->customer_id }}">
                                            <button type="button" class="btn btn-xs btn-danger deleteButtonSingle" data-nama="{{ $matchLeads->first_name . ' ' . $matchLeads->last_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                        @endif
                                        {{-- /* Delete Button --}}

                                    </td>
                                </tr>

                                {{-- Modal Make to Prospect --}}
                                <div class="modal modal-lg fade" id="editLeads-{{ $matchLeads->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog modal-lg">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Please check & update the leads file</h5>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <form action="{{ route('leads.update', $matchLeads->customer_id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="modal-body">

                                                    <div class="row">
                                                        <x-form-input className="col-lg-3" type="text" name="customer_first_name" label="First Name" value="{{ $matchLeads->first_name }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_last_name" label="Last Name" value="{{ $matchLeads->last_name }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_email" label="Email" value="{{ $matchLeads->cust_email }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_phone" label="Phone" value="{{ $matchLeads->cust_phone }}" />

                                                        @php
                                                            $isVillaChecked = collect($LeadsMatch)->contains(function ($item) {
                                                                return $item->type_asset === 'villa' && $item->visibility == 1;
                                                            });
                                                            $isLandChecked = collect($LeadsMatch)->contains(function ($item) {
                                                                return $item->type_asset === 'land' && $item->visibility == 1;
                                                            });
                                                        @endphp

                                                        {{-- Looking For --}}
                                                        <div class="col-lg-3 mb-3">
                                                            <label for="leads_looking_for" class="form-label text-muted">Looking For</label>
                                                            <div class="form-check">
                                                                <input type="checkbox" class="form-check-input" id="type_properties_villa_{{ $matchLeads->id }}" data-index="{{ $matchLeads->id }}" name="type_properties_villa" {{ $isVillaChecked ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="type_properties_villa_{{ $matchLeads->id }}">
                                                                    <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                        <path d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z" fill="#063436"></path>
                                                                    </svg>
                                                                    Villa
                                                                </label>
                                                            </div>
                                                            <div class="form-check form-check-inline">
                                                                <input type="checkbox" class="form-check-input" id="type_properties_land_{{ $matchLeads->id }}" data-index="{{ $matchLeads->id }}" name="type_properties_land" {{ $isLandChecked ? 'checked' : '' }}>
                                                                <label class="form-check-label" for="type_properties_land_{{ $matchLeads->id }}">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16"
                                                                        fill="#063436" viewBox="0 0 24 24">
                                                                        <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2M5 19V5h14v14z"></path>
                                                                        <path d="M12 9h3v3h2V7h-5zM9 12H7v5h5v-2H9z"></path>
                                                                    </svg>
                                                                    Land
                                                                </label>
                                                            </div>
                                                        </div>

                                                        <x-form-input className="col-lg-3" type="text" name="ready_buy_villa" label="Ready to Buy*" value="{{ \Carbon\Carbon::parse($matchLeads->date)->format('d F, Y') }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_nationality" label="Nationality" value="{{ $matchLeads->cust_nationality }}" />
                                                        <x-form-input className="col-lg-3" type="text" name="customer_passport" label="Passport Number" value="{{ $matchLeads->cust_passport }}" />

                                                    </div>

                                                    @php
                                                        $villaData = collect($LeadsMatch)->firstWhere('type_asset', 'villa');
                                                        $landData = collect($LeadsMatch)->firstWhere('type_asset', 'land');
                                                    @endphp
                                                    {{-- VILLA --}}
                                                    <div class="villa-section" data-index="{{ $matchLeads->id }}" id="villa_section" style="display: none;">
                                                        <div class="d-flex justify-content-center justify-items-center text-center" bis_skin_checked="1">
                                                            <hr class="w-100">
                                                            <label class="w-100 text-success">
                                                                <span class="nav-icon">
                                                                    <i class="ri-community-line"></i>
                                                                </span>
                                                                Looking For Villa
                                                            </label>
                                                            <hr class="w-100">
                                                        </div>

                                                        <div class="row my-3">
                                                            <div class="col-lg-12 mb-3" id="group_villa_localization">
                                                                <label for="villa_localization" class="form-label">Localization</label>
                                                                <select id="villa_localization" class="form-select" name="villa_localization">
                                                                    <option value="" disabled selected>Select Region</option>
                                                                    @foreach ($data_localization as $localization)
                                                                        <option value="{{ $localization->name }}"
                                                                            {{ $villaData && $localization->name == $villaData->localization ? 'selected' : '' }}>
                                                                            {{ $localization->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

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
                                                    <div class="land-section" data-index="{{ $matchLeads->id }}" id="land_section" style="display: none;">

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
                                                                    <option value="" disabled selected>Select Region</option>
                                                                    @foreach ($data_localization as $localization)
                                                                        <option value="{{ $localization->name }}"
                                                                            {{ $landData && $localization->name == $landData->localization ? 'selected' : '' }}>
                                                                            {{ $localization->name }}
                                                                        </option>
                                                                    @endforeach
                                                                </select>
                                                            </div>

                                                            @if ($landData && $landData->min_budget_idr !== null && $landData->max_budget_idr !== null)
                                                                <x-form-input className="col-lg-3" type="text" name="land_min_budget_idr" label="Budget Min" value="{{ $landData->min_budget_idr }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="land_max_budget_idr" label="Budget Max" value="{{ $landData->max_budget_idr }}" />
                                                            @elseif ($landData && $landData->min_budget_usd !== null && $landData->max_budget_usd !== null)
                                                                <x-form-input className="col-lg-3" type="text" name="land_min_budget_usd" label="Budget Min" value="{{ $landData->min_budget_usd }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="land_max_budget_usd" label="Budget Max" value="{{ $landData->max_budget_usd }}" />
                                                            @endif

                                                            <x-form-input className="col-lg-3" type="text" name="min_land_size" label="Size Min" value="{{ $landData->min_land_size ?? '' }}" />
                                                            <x-form-input className="col-lg-3" type="text" name="max_land_size" label="Size Max" value="{{ $landData->max_land_size ?? '' }}" />
                                                        </div>
                                                    </div>

                                                </div>
                                                <div class="modal-footer" bis_skin_checked="1">
                                                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                    <button type="submit" class="btn btn-primary">Save and Make Prospect</button>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                                {{-- END Modal Make to Prospect --}}
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($data_leads_matches as $leadsData => $LeadsMatch)
                        @php
                            $matchLeads = $LeadsMatch->first(); // ambil lead pertama
                            $authUser = Auth::user();
                            $referenceCode = $authUser->role === 'Master' ? null : $authUser->reference_code;
                            // Ambil properti yang sudah difilter
                            // $filteredMatchLeads = $referenceCode ? $matchProperties[$matchLeads->id]->where('internal_reference', $referenceCode) : $matchProperties[$matchLeads->id];

                            $matchLeadsProperties = $LeadsMatch->where('type_asset', 'villa')->first();
                            $matchLeadsLand = $LeadsMatch->where('type_asset', 'land')->first();
                        @endphp

                        <!-- Modal See Detail Properties -->
                        <div class="modal modal-xl fade" id="seeProperties-{{ $matchLeads->id }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title" id="staticBackdropLabel">Modal title</h5>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body">

                                        <div id="detailsVilla">
                                            <!-- Information Leads Villa -->
                                            <div class="d-flex align-items-center gap-2">
                                                <h5 class="modal-title" id="staticBackdropLabel">Lead Information :</h5> <span class="badge bg-success me-1">Villa</span>
                                            </div>
                                            <div class="d-flex my-2 gap-2">
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsProperties->first_name . ' ' . $matchLeadsProperties->last_name }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsProperties->cust_email }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $matchLeadsProperties->cust_phone), 4)) }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"> {{ \Carbon\Carbon::parse($matchLeadsProperties->date)->format('d F, Y') }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                    IDR {{ number_format($matchLeadsProperties->min_budget_idr, 0, ',', '.') }}
                                                    -
                                                    IDR {{ number_format($matchLeadsProperties->max_budget_idr, 0, ',', '.') }}
                                                </span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                    USD {{ number_format($matchLeadsProperties->min_budget_usd, 2, ',', '.') }}
                                                    -
                                                    USD {{ number_format($matchLeadsProperties->max_budget_usd, 2, ',', '.') }}
                                                </span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:bed-outline" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsProperties->min_bedroom . ' - ' . $matchLeadsProperties->max_bedroom }} </span>
                                            </div>

                                            <div class="table-responsive">
                                                <table class="table-hover table-centered table text-nowrap" id="propertiesLeadsDetails-{{ $matchLeads->id }}">
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
                                                    <tbody class="detailsPropertyTables">
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
                                            <!-- End Information Leads Villa -->
                                        </div>

                                        <!-- Information Leads Lands -->
                                        <div id="detailsLand">
                                            <div class="d-flex align-items-center gap-2">
                                                <h5 class="modal-title" id="staticBackdropLabel">Lead Information :</h5><span class="badge bg-warning me-1">Land</span>
                                            </div>
                                            <div class="d-flex my-2 gap-2">
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsLand->first_name . ' ' . $matchLeadsLand->last_name }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsLand->cust_email }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $matchLeadsLand->cust_phone), 4)) }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"> {{ \Carbon\Carbon::parse($matchLeadsLand->date)->format('d F, Y') }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                    IDR {{ number_format($matchLeadsLand->min_budget_idr, 0, ',', '.') }}
                                                    -
                                                    IDR {{ number_format($matchLeadsLand->max_budget_idr, 0, ',', '.') }}
                                                </span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                    USD {{ number_format($matchLeadsLand->min_budget_usd, 2, ',', '.') }}
                                                    -
                                                    USD {{ number_format($matchLeadsLand->max_budget_usd, 2, ',', '.') }}
                                                </span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:fullscreen" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsLand->min_land_size . ' - ' . $matchLeadsLand->max_land_size }} m² </span>
                                            </div>
                                            <div class="table-responsive">
                                                <table class="table-hover table-centered table text-nowrap" id="landLeadsDetails-{{ $matchLeads->id }}">
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
                                                    <tbody class="detailsLandTables">
                                                        {{-- <tr>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>1</td>
                                                        <td>200 m²</td>
                                                        <td>
                                                            <div class="d-block">
                                                                <h5 class="text-dark fw-medium mb-0"
                                                                    data-bs-toggle="modal" data-bs-target="#editMatchProperties-{{ $matchLeads->id }}">
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

                                    </div>
                                    <form action="{{ route('leadsToProspect', $matchLeads->customer_id) }}" method="POST">
                                        @csrf
                                        <div class="modal-footer">
                                            @role('Master')
                                                <div class="propertiesDataLeads"></div>
                                                <div class="row" style="min-width: 200px">
                                                    <select class="form-control choose_agent" name="agent_code" id="choose_agent-{{ $matchLeads->id }}">
                                                        <option value="">Choose agent</option>
                                                    </select>
                                                </div>
                                            @endrole
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                            <button type="submit" class="btn btn-primary">Save Leads</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!-- END Modal See Detail Properties -->
                    @endforeach

                </div>
            </div>
        </div>
    </div>

</div>
