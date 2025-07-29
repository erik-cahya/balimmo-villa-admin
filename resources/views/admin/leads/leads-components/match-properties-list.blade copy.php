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
                            {{-- {{ dd($leadsData) }} --}}
                            @php
                            $matchLeads = $LeadsMatch->first(); // ambil lead pertama
                            $authUser = Auth::user();
                            $referenceCode = $authUser->role === 'Master' ? null : $authUser->reference_code;
                            // Ambil properti yang sudah difilter
                            // $filteredMatchLeads = $referenceCode ? $matchProperties[$matchLeads->id]->where('internal_reference', $referenceCode) : $matchProperties[$matchLeads->id];
                            @endphp

                            @if (Auth::user()->role == 'Master' || ($filteredMatchLeads->count() > 0 && Auth::user()->role == 'agent'))
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                        <div class="d-block">
                                            <h5 class="text-dark fw-medium mb-0">{{ $matchLeads->first_name . ' ' . $matchLeads->last_name }}</h5>
                                            <p class="fs-13 mb-0">{{ $matchLeads->cust_email }}</p>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    <span class="badge bg-primary fst-italic"><iconify-icon icon="material-symbols:real-estate-agent-sharp" class="align-middle"></iconify-icon> BPA-ERIK-2032</span>
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
                                    <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#editLeads-{{ $matchLeads->id }}">
                                        <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                    </button>

                                    <button
                                        class="btn btn-xs btn-primary show-matching"
                                        data-lead-id="{{ $matchLeads->id }}"
                                        data-bs-toggle="modal"
                                        data-bs-target="#matchingPropertiesModal">

                                        Show Match Properties - {{ $matchLeads->id }}
                                    </button>

                                    {{-- Delete Button --}}
                                    @if (Auth::user()->role == 'Master')
                                    <input type="hidden" class="customerID" value="{{ $matchLeads->customer_id }}">
                                    <button type="button" class="btn btn-xs btn-danger deleteButtonSingle" data-nama="{{ $matchLeads->first_name . ' ' . $matchLeads->last_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                    @endif
                                    {{-- /* Delete Button --}}

                                </td>
                            </tr>

                            {{-- Modal Make Prospect --}}
                            <div class="modal modal-lg fade" id="makeProspect-{{ $matchLeads->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="staticBackdropLabel">Make to Prospect</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <form action="{{ route('leadsToProspect', $matchLeads->id) }}" method="POST">
                                            @csrf

                                            <div class="modal-body">
                                                <div class="row">
                                                    <x-form-input className="col-lg-6" type="text" name="leads_name" label="Name" value="{{ $matchLeads->first_name }}" disabled />
                                                    <x-form-input className="col-lg-6" type="text" name="leads_email" label="Email" value="{{ $matchLeads->cust_email }}" disabled />
                                                    <x-form-input className="col-lg-6" type="text" name="leads_telp" label="Phone Number" value="{{ $matchLeads->cust_telp }}" disabled />
                                                    <x-form-input className="col-lg-6" type="text" name="leads_budget" label="Budget" value="IDR {{ number_format($matchLeads->cust_budget, 2, ',', '.') }}" disabled />
                                                    <x-form-input className="col-lg-6" type="text" name="leads_localization" label="Localization" value="{{ $matchLeads->localization }}" disabled />
                                                    <x-form-input className="col-lg-6" type="text" name="leads_date" label="Date Submit" value="{{ \Carbon\Carbon::parse($matchLeads->date)->format('d F, Y') }}" disabled />

                                                    <div class="col-lg-6 text-capitalize mb-3" id="group_status_prospect">
                                                        <label for="status_prospect" class="form-label">Make It Prospect</label>
                                                        <select class="form-control" id="status_prospect" name="status_prospect">
                                                            <option value="Yes">Yes</option>
                                                            <option value="No" selected>No</option>
                                                        </select>

                                                        @error('status_prospect')
                                                        <style>
                                                            .choices__inner {
                                                                border-color: #e96767 !important;
                                                            }
                                                        </style>

                                                        <div class="alert alert-danger m-0">
                                                            {{ $message }}
                                                        </div>
                                                        @enderror
                                                    </div>

                                                    {{-- <div class="col-lg-6 text-capitalize mb-3" id="group_selected_properties_id">
                                                                <label for="selected_properties_id" class="form-label">Select Properties</label>
                                                                <select class="form-control" id="selected_properties_id" name="selected_properties_id">
                                                                    <option value="" disabled selected>Choose Properties</option>
                                                                    @foreach ($filteredMatchLeads as $properties)
                                                                        <option value="{{ $properties->id }}">{{ $properties->property_name . ' | ' . $properties->internal_reference }}</option>
                                                    @endforeach
                                                    </select>

                                                    @error('selected_properties_id')
                                                    <style>
                                                        .choices__inner {
                                                            border-color: #e96767 !important;
                                                        }
                                                    </style>

                                                    <div class="alert alert-danger m-0">
                                                        {{ $message }}
                                                    </div>
                                                    @enderror
                                                </div> --}}
                                            </div>

                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                        <button type="submit" class="btn btn-primary">Save to Prospect</button>
                                    </div>
                                    </form>

                                </div>
                            </div>
                </div>
                {{-- END Modal Make Prospect --}}

                {{-- Modal Edit Data Leads --}}
                <div class="modal modal-lg fade" id="editLeads-{{ $matchLeads->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title text-dark" id="staticBackdropLabel">Please check & update the leads file</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <form action="{{ route('leads.update', $matchLeads->id) }}" method="POST">
                                @csrf
                                @method('PUT')
                                <div class="modal-body">
                                    <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                        <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Customer Data</h5>
                                        <hr>
                                        <div class="row my-3">
                                            <x-form-input className="col-lg-4" type="text" name="customer_first_name" label="First Name" value="{{ $matchLeads->first_name }}" />
                                            <x-form-input className="col-lg-4" type="text" name="customer_last_name" label="Last Name" value="{{ $matchLeads->last_name }}" />
                                            <x-form-input className="col-lg-4" type="text" name="customer_email" label="Email" value="{{ $matchLeads->cust_email }}" />
                                            <x-form-input className="col-lg-4" type="text" name="customer_phone" label="Phone Number" value="{{ $matchLeads->cust_phone }}" />

                                            <x-form-input className="col-lg-4" type="text" name="ready_buy_villa" label="Ready to Buy" value="{{ \Carbon\Carbon::parse($matchLeads->date)->format('d F, Y') }}" />

                                            <div class="col-lg-4 mb-3">
                                                <div class="row">
                                                    <div class="col-lg-12 d-flex">

                                                        @php
                                                        // $isVillaChecked = collect($LeadsMatch)->contains('type_asset', 'villa');
                                                        $isVillaChecked = collect($LeadsMatch)->contains(function ($item) {
                                                        return $item->type_asset === 'villa' && $item->visibility == 1;
                                                        });

                                                        $isLandChecked = collect($LeadsMatch)->contains(function ($item) {
                                                        return $item->type_asset === 'land' && $item->visibility == 1;
                                                        });
                                                        @endphp

                                                        <div class="col-lg-6 mb-3">
                                                            <div class="row">
                                                                <label class="mb-1 mb-3">Looking For</label>

                                                                <div class="col-lg-12 d-flex">
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" class="form-check-input" id="type_properties_villa" data-index="{{ $matchLeads->id }}" name="type_properties_villa" {{ $isVillaChecked ? 'checked' : '' }}>
                                                                        <label class="form-check-label text-capitalize" for="type_properties_villa">Villa</label>
                                                                    </div>

                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" class="form-check-input" id="type_properties_land" data-index="{{ $matchLeads->id }}" name="type_properties_land" {{ $isLandChecked ? 'checked' : '' }}>
                                                                        <label class="form-check-label text-capitalize" for="type_properties_land">Land</label>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    @php

                                    $villaData = collect($LeadsMatch)->firstWhere('type_asset', 'villa');
                                    $landData = collect($LeadsMatch)->firstWhere('type_asset', 'land');
                                    @endphp
                                    {{-- VILLA --}}
                                    <div class="bg-light-subtle border-dark villa-section mb-4 rounded border px-3 pt-4" data-index="{{ $matchLeads->id }}" id="villa_section" style="display: none;">
                                        <h5 class="text-dark fw-semibold">
                                            <span class="nav-icon">
                                                <iconify-icon icon="ic:baseline-villa" class="fs-16 align-middle"></iconify-icon>
                                            </span> VILLA
                                        </h5>
                                        <hr>
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
                                    <div class="bg-light-subtle border-dark land-section mb-4 rounded border px-3 pt-4" data-index="{{ $matchLeads->id }}" id="land_section" style="display: none;">
                                        <h5 class="text-dark fw-semibold">
                                            <span class="nav-icon">
                                                <iconify-icon icon="tabler:chart-area-line-filled" class="fs-16 align-middle"></iconify-icon>
                                            </span> LAND
                                        </h5>
                                        <hr>
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

                                    {{-- If it is a master, you can input it directly to a specific agent so that the selected agent gets the leads. --}}
                                    @if (Auth::user()->role == 'Master')
                                    <hr>
                                    <div class="col-lg-6 mb-3" id="group_input_specific_properties">
                                        <label for="input_specific_properties" class="form-label">Input to Specific Leads</label>
                                        <select id="input_specific_properties" class="form-select" name="input_specific_properties">
                                            <option value="" disabled selected>Select Properties</option>
                                            @foreach ($data_properties as $properties)
                                            <option value="{{ $properties->property_slug }}">{{ $properties->property_name . ' | ' . $properties->internal_reference }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @endif

                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Close</button>
                                    <button type="submit" class="btn btn-xs btn-primary">Edit Leads Data</button>
                                </div>
                            </form>

                        </div>
                    </div>
                </div>
                {{-- END Modal Edit Data Leads --}}
                @endif
                @endforeach

                <!-- Modal Properties Match -->
                <div class="modal modal-lg fade" id="matchingPropertiesModal" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="matchingPropertiesModalLabel">Matching Properties - {{ $matchLeads->id }}</h5>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>

                            </div>

                            <div class="modal-body">
                                <div id="modalLoading" class="text-center">
                                    <div class="spinner-border text-primary" role="status">
                                        <span class="sr-only">Loading...</span>
                                    </div>
                                </div>

                                <div id="criteriaInfo" class="row"></div>

                                <div class="row" id="propertiesData">

                                </div>

                            </div>

                        </div>
                    </div>
                </div>
                <!-- /* Modal Properties Match -->

                {{-- <!-- Modal -->
                            <div class="modal fade" id="matchingPropertiesModal-{{ $matchLeads->id }}" tabindex="-1" role="dialog" aria-labelledby="matchingPropertiesModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-lg" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="matchingPropertiesModalLabel">Matching Properties</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div id="modalLoading" class="text-center">
                                <div class="spinner-border text-primary" role="status">
                                    <span class="sr-only">Loading...</span>
                                </div>
                            </div>

                            <div id="criteriaInfo"></div>

                            <table class="table" id="propertiesTable" style="display: none;">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>Selling Price</th>
                                        <th>Bedrooms</th>
                                    </tr>
                                </thead>
                                <tbody id="propertiesTableBody">
                                </tbody>
                            </table>

                            <div id="noProperties" class="alert alert-warning" style="display: none;">
                                No matching properties found.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        </div>
                    </div>
                </div>
            </div> --}}

            </tbody>
            </table>
        </div>
    </div>
</div>
</div>

</div>