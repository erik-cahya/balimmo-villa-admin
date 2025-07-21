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
                                <th scope="col">Customer Name</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Budget IDR</th>
                                <th scope="col">Budget USD</th>
                                <th scope="col">Localization</th>
                                <th scope="col">Type Asset Choice</th>
                                <th scope="col">Date</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data_leads_matches as $leadsData => $LeadsMatch)
                                @php
                                    $matchLeads = $LeadsMatch->first(); // ambil lead pertama
                                    $authUser = Auth::user();
                                    $referenceCode = $authUser->role === 'Master' ? null : $authUser->reference_code;
                                    // Ambil properti yang sudah difilter
                                    $filteredMatchLeads = $referenceCode ? $matchProperties[$matchLeads->id]->where('internal_reference', $referenceCode) : $matchProperties[$matchLeads->id];
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
                                            <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $matchLeads->cust_phone), 4)) }}</p>
                                        </td>
                                        <td>
                                            <span class="badge bg-primary fst-italic p-2"><iconify-icon icon="tdesign:money-filled" class="align-middle"></iconify-icon> IDR {{ number_format($matchLeads->max_budget_idr, 0, ',', '.') }}</span>
                                        </td>
                                        <td>
                                            <span class="badge bg-warning fst-italic p-2"><iconify-icon icon="tdesign:money-filled" class="align-middle"></iconify-icon> USD {{ number_format($matchLeads->max_budget_usd, 2, ',', '.') }}</span>

                                        </td>
                                        <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> {{ $matchLeads->localization }}</td>

                                        <td>
                                            @foreach ($LeadsMatch as $leads)
                                                <span class="text-capitalize fw-medium badge bg-primary p-2">{{ $leads->type_asset }}</span>
                                            @endforeach
                                        </td>

                                        <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($matchLeads->date)->format('d F, Y') }}</td>

                                        <td>
                                            <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#editLeads-{{ $matchLeads->id }}">
                                                <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                            </button>

                                            @if ($filteredMatchLeads->count() == 0)
                                                <span class="btn btn-xs btn-primary">No Match Properties</span>
                                            @else
                                                <button class="btn btn-xs btn-secondary toggle-villas" type="button" data-bs-toggle="modal" data-bs-target="#makeProspect-{{ $matchLeads->id }}">
                                                    Make to Prospect
                                                </button>
                                                <button class="btn btn-xs btn-primary toggle-villas" type="button" data-bs-toggle="modal" data-bs-target="#matchProperties-{{ $matchLeads->id }}">
                                                    Show {{ $filteredMatchLeads->count() }} Properties
                                                </button>
                                            @endif

                                            @if (Auth::user()->role == 'Master')
                                                <input type="hidden" class="customerID" value="{{ $matchLeads->customer_id }}">
                                                <button type="button" class="btn btn-xs btn-danger deleteButtonSingle" data-nama="{{ $matchLeads->first_name . ' ' . $matchLeads->last_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                            @endif

                                        </td>
                                    </tr>
                                    <!-- Modal Properties Match -->
                                    <div class="modal modal-xl fade" id="matchProperties-{{ $matchLeads->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Recomendation Properties</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <span class="fst-italic fw-medium text-dark">Data Leads</span>
                                                    <div class="d-flex mb-3 mt-2 gap-1">
                                                        <span class="badge bg-dark p-1" style="font-size: 12px; font-weight: 200"><iconify-icon icon="solar:user-bold" class="fs-10 align-middle"></iconify-icon> {{ $matchLeads->cust_name }}</span>
                                                        <span class="badge bg-dark p-1" style="font-size: 12px; font-weight: 200"><iconify-icon icon="solar:user-bold" class="fs-10 align-middle"></iconify-icon> {{ $matchLeads->cust_email }}</span>
                                                        <span class="badge bg-dark p-1" style="font-size: 12px; font-weight: 200"><iconify-icon icon="mdi:phone" class="fs-10 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $matchLeads->cust_telp), 4)) }}</span>
                                                        <span class="badge bg-dark p-1" style="font-size: 12px; font-weight: 200"><iconify-icon icon="flowbite:map-pin-solid" class="fs-10 align-middle"></iconify-icon> {{ $matchLeads->localization }}</span>
                                                        <span class="badge bg-dark p-1" style="font-size: 12px; font-weight: 200"><iconify-icon icon="tdesign:money-filled" class="fs-10 align-middle"></iconify-icon> IDR {{ number_format($matchLeads->cust_budget, 2, ',', '.') }}</span>
                                                    </div>
                                                    <hr>
                                                    <div class="row">
                                                        @foreach ($filteredMatchLeads as $properties)
                                                            <div class="col-md-6 col-xl-6">
                                                                <div class="card bg-primary bg-gradient">
                                                                    <div class="card-body">
                                                                        <div class="row align-items-center justify-content-between">
                                                                            <div class="col-xl-7 col-lg-6 col-md-6">
                                                                                <h3 class="fw-bold fs-18 text-white">{{ $properties->property_name }}</h3>
                                                                                <hr>
                                                                                <div class="row">
                                                                                    <div class="col-lg-6 col-lg-6 col-md-6 col-6">
                                                                                        <div class="d-flex gap-2">
                                                                                            <div class="avatar-sm flex-shrink-0">
                                                                                                <span class="avatar-title bg-success rounded bg-opacity-50 text-white">
                                                                                                    <iconify-icon icon="solar:bed-broken" class="fs-16 align-middle"></iconify-icon>
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="d-block">
                                                                                                <h5 class="fw-medium mb-0 text-white">{{ $properties->bedroom }}</h5>
                                                                                                <p class="text-white-50 mb-0">Bedroom</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="col-lg-6 col-lg-6 col-md-6 col-6">
                                                                                        <div class="d-flex gap-2">
                                                                                            <div class="avatar-sm flex-shrink-0">
                                                                                                <span class="avatar-title bg-danger rounded bg-opacity-50 text-white">
                                                                                                    <iconify-icon icon="solar:bed-broken" class="fs-16 align-middle"></iconify-icon>
                                                                                                </span>
                                                                                            </div>
                                                                                            <div class="d-block">
                                                                                                <h5 class="fw-medium mb-0 text-white">{{ $properties->bathroom }}</h5>
                                                                                                <p class="text-white-50 mb-0">Bathrom</p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                                <hr>
                                                                                <div class="d-flex fs-10 gap-3">
                                                                                    <h4 class="fw-normal fst-italic text-white" style="font-size: 16px!important">IDR {{ number_format($properties->selling_price_idr, 2, ',', '.') }}</h4>
                                                                                    <h4 class="fw-normal fst-italic text-white" style="font-size: 16px!important">USD {{ number_format($properties->selling_price_usd, 2, ',', '.') }}</h4>
                                                                                </div>
                                                                                <hr>
                                                                                <h3 class="fw-normal fs-16 fst-italic text-white">{{ $properties->region }} - {{ $properties->sub_region }}</h3>
                                                                                <h3 class="fw-normal fs-11 fst-italic text-white">{{ $properties->internal_reference }}</h3>

                                                                            </div>
                                                                            <div class="col-xl-5 col-lg-4 col-md-4">
                                                                                <img src="{{ asset('admin') }}/assets/images/home.png" alt="" class="img-fluid">
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                    {{-- <button type="submit" class="btn btn-primary">Change Password</button> --}}
                                                </div>

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
                                    <!-- /* Modal Properties Match -->

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

                                                            <div class="col-lg-6 text-capitalize mb-3" id="group_selected_properties_id">
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
                                                            </div>
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
                                                                <x-form-input className="col-lg-6" type="text" name="customer_name" label="Name" value="{{ $matchLeads->first_name . ' ' . $matchLeads->last_name }}" />
                                                                <x-form-input className="col-lg-6" type="text" name="customer_email" label="Email" value="{{ $matchLeads->cust_email }}" />
                                                                <x-form-input className="col-lg-6" type="text" name="customer_phone" label="Phone Number" value="{{ $matchLeads->cust_phone }}" />

                                                                <div class="col-lg-6 mb-3">
                                                                    <div class="row">
                                                                        <div class="col-lg-12 d-flex">

                                                                            @php
                                                                                $isVillaChecked = collect($LeadsMatch)->contains('type_asset', 'villa');
                                                                                $isLandChecked = collect($LeadsMatch)->contains('type_asset', 'land');
                                                                            @endphp

                                                                            <div class="col-lg-6 mb-3">
                                                                                <div class="row">
                                                                                    <label class="mb-1 mb-3">Looking For</label>

                                                                                    <div class="col-lg-12 d-flex">
                                                                                        <div class="form-check form-check-inline">
                                                                                            <input type="checkbox" class="form-check-input" id="type_properties_villa" name="type_properties_villa" {{ $isVillaChecked ? 'checked' : '' }}>
                                                                                            <label class="form-check-label text-capitalize" for="type_properties_villa">Villa</label>
                                                                                        </div>

                                                                                        <div class="form-check form-check-inline">
                                                                                            <input type="checkbox" class="form-check-input" id="type_properties_land" name="type_properties_land" {{ $isLandChecked ? 'checked' : '' }}>
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

                                                        @foreach ($LeadsMatch as $data)
                                                            @if ($data->type_asset == 'villa')
                                                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4" id="villa_section" style="display: none;">
                                                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><iconify-icon icon="ic:baseline-villa" class="fs-16 align-middle"></iconify-icon></span> VILLA</h5>
                                                                    <hr>
                                                                    <div class="row my-3">

                                                                        <div class="col-lg-6 mb-3" id="group_villa_localization">
                                                                            <label for="villa_localization" class="form-label">Localization</label>
                                                                            <select id="villa_localization" class="form-select" name="villa_localization">
                                                                                <option value="" disabled selected>Select Region</option>
                                                                                @foreach ($data_localization as $localization)
                                                                                    <option value="{{ $localization->name }}" {{ $localization->name == $data->localization ? 'selected' : '' }}>{{ $localization->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <x-form-input className="col-lg-6" type="text" name="ready_buy_villa" label="Ready to Buy" value="{{ \Carbon\Carbon::parse($data->date)->format('d F, Y') }}" />

                                                                        {{-- Karena ada 2 tipe : usd dan idr (jika min dan max budget idr tidak null, maka tampilkan budget idr) --}}
                                                                        @if ($data->min_budget_idr !== null && $data->max_budget_idr !== null)
                                                                            <x-form-input className="col-lg-3" type="text" name="villa_min_budget_idr" label="Budget Min" value="{{ $data->min_budget_idr }}" />
                                                                            <x-form-input className="col-lg-3" type="text" name="villa_max_budget_idr" label="Budget Max" value="{{ $data->max_budget_idr }}" />
                                                                        @elseif ($data->min_budget_usd !== null && $data->max_budget_usd !== null)
                                                                            <x-form-input className="col-lg-3" type="text" name="villa_min_budget_usd" label="Budget Min" value="{{ $data->min_budget_usd }}" />
                                                                            <x-form-input className="col-lg-3" type="text" name="villa_max_budget_usd" label="Budget Max" value="{{ $data->max_budget_usd }}" />
                                                                        @endif

                                                                        <x-form-input className="col-lg-3" type="text" name="minimum_bedroom" label="Bedroom Min" value="{{ $data->min_bedroom }}" />
                                                                        <x-form-input className="col-lg-3" type="text" name="maximum_bedroom" label="Bedroom Max" value="{{ $data->max_bedroom }}" />

                                                                    </div>
                                                                </div>
                                                            @endif
                                                            @if ($data->type_asset == 'land')
                                                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4" id="land_section" style="display: none;">
                                                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><iconify-icon icon="tabler:chart-area-line-filled" class="fs-16 align-middle"></iconify-icon></span> LAND</h5>
                                                                    <hr>
                                                                    <div class="row my-3">
                                                                        <div class="col-lg-6 mb-3" id="group_land_localization">
                                                                            <label for="land_localization" class="form-label">Localization</label>
                                                                            <select id="land_localization" class="form-select" name="land_localization">
                                                                                <option value="" disabled selected>Select Region</option>
                                                                                @foreach ($data_localization as $localization)
                                                                                    <option value="{{ $localization->name }}" {{ $localization->name == $data->localization ? 'selected' : '' }}>{{ $localization->name }}</option>
                                                                                @endforeach
                                                                            </select>
                                                                        </div>

                                                                        <x-form-input className="col-lg-6" type="text" name="ready_buy_land" label="Ready to Buy" value="{{ \Carbon\Carbon::parse($data->date)->format('d F, Y') }}" />

                                                                        {{-- Karena ada 2 tipe : usd dan idr (jika min dan max budget idr tidak null, maka tampilkan budget idr) --}}
                                                                        @if ($data->min_budget_idr !== null && $data->max_budget_idr !== null)
                                                                            <x-form-input className="col-lg-3" type="text" name="land_min_budget_idr" label="Budget Min" value="{{ $data->min_budget_idr }}" />
                                                                            <x-form-input className="col-lg-3" type="text" name="land_max_budget_idr" label="Budget Max" value="{{ $data->max_budget_idr }}" />
                                                                        @elseif ($data->min_budget_usd !== null && $data->max_budget_usd !== null)
                                                                            <x-form-input className="col-lg-3" type="text" name="land_min_budget_usd" label="Budget Min" value="{{ $data->min_budget_usd }}" />
                                                                            <x-form-input className="col-lg-3" type="text" name="land_max_budget_usd" label="Budget Max" value="{{ $data->max_budget_usd }}" />
                                                                        @endif

                                                                        <x-form-input className="col-lg-3" type="text" name="minimum_land_size" label="Size Min" value="{{ $data->min_land_size }}" />
                                                                        <x-form-input className="col-lg-3" type="text" name="maximum_land_size" label="Size Max" value="{{ $data->max_land_size }}" />

                                                                    </div>
                                                                </div>
                                                            @endif
                                                        @endforeach

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

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
