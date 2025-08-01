<div class="row mt-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom text-bg-primary" style="border-radius: 10px 10px 0px 0px">
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
                                <th scope="col">Customer Name</th>
                                <th scope="col">Leads From</th>
                                <th scope="col">Phone Number</th>
                                <th scope="col">Localization</th>
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
                                            <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                            <div class="d-block">
                                                <h5 class="text-dark fw-medium mb-0">{{ $customerData->first_name . ' ' . $customerData->last_name }}</h5>
                                                <p class="fs-13 mb-0">{{ $customerData->cust_email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <span class="badge bg-primary text-light"> {{ $customerData->agent_code }}</span>
                                    </td>
                                    <td>
                                        <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_phone), 4)) }}</p>
                                    </td>
                                    <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> {{ $customerData->localization }}</td>

                                    <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</td>
                                    <td>
                                        @foreach (collect($lead)->unique('type_asset') as $ld)
                                            @if ($ld->type_asset == 'properties')
                                                <span class="text-capitalize fw-medium badge bg-success">properties</span>
                                            @elseif ($ld->type_asset == 'land')
                                                <span class="text-capitalize fw-medium badge bg-danger">land</span>
                                            @endif
                                        @endforeach
                                    </td>

                                    <td>
                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#makeProspect-{{ $customerData->id }}">
                                            Make to Prospect
                                        </button>

                                        <input type="hidden" class="propertyId" value="{{ $customerData->id }}">
                                        <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $customerData->cust_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                        {{-- Modal Make to Prospect --}}

                                        {{-- END Modal Make to Prospect --}}

                                    </td>

                                </tr>
                            @endforeach
                        </tbody>
                    </table>

                    @foreach ($data_leads as $leads => $lead)
                        @php
                            $customerData = $lead->first();
                            $matchLeadsProperties = $lead->where('type_asset', 'properties')->first();
                            $matchLeadsLand = $lead->where('type_asset', 'land')->first();

                            // dd($matchLeadsProperties);
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
                                        <div id="detailsVilla">
                                            <!-- Information Leads Villa -->
                                            <div class="d-flex align-items-center gap-2">
                                                <h5 class="modal-title" id="staticBackdropLabel">Lead Information :</h5> <span class="badge bg-success me-1">Villa</span>
                                            </div>
                                            <div class="d-flex my-2 gap-2">
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsProperties?->first_name ?? ('' . ' ' . $matchLeadsProperties?->last_name ?? '') }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsProperties?->cust_email ?? '' }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $matchLeadsProperties?->cust_phone ?? ''), 4)) }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"> {{ \Carbon\Carbon::parse($matchLeadsProperties?->date ?? '')->format('d F, Y') }}</span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                    IDR {{ number_format($matchLeadsProperties?->min_budget_idr ?? 0, 0, ',', '.') }}
                                                    -
                                                    IDR {{ number_format($matchLeadsProperties?->max_budget_idr ?? 0, 0, ',', '.') }}
                                                </span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                    USD {{ number_format($matchLeadsProperties?->min_budget_usd ?? 0, 2, ',', '.') }}
                                                    -
                                                    USD {{ number_format($matchLeadsProperties?->max_budget_usd ?? 0, 2, ',', '.') }}
                                                </span>
                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:bed-outline" class="fs-16 align-middle"></iconify-icon> {{ $matchLeadsProperties?->min_bedroom ?? ('' . ' - ' . $matchLeadsProperties?->max_bedroom ?? '') }} </span>
                                            </div>

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
                                            <!-- End Information Leads Villa -->
                                        </div>

                                        @if ($matchLeadsLand !== NULL)
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
                                        @endif
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
                        <!-- /* Modal -->
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
