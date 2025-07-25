<div class="row mt-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
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
                                @role('Master')
                                    <th scope="col">Agent</th>
                                @endrole
                                <th scope="col">Phone Number</th>
                                <th scope="col">Localization</th>                                
                                <th scope="col">Ready to buy</th>
                                <th scope="col">Looking for</th>
                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data_leads as $customer => $cst)
                                @php
                                    $customerData = $cst->first();
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}" class="cursor-pointer">
                                        <div class="d-flex align-items-center gap-1">
                                            <div class="d-block">
                                                <h5 class="text-dark fw-medium mb-0">
                                                    {{ $customerData->cust_name }}
                                                </h5>
                                                <p class="fs-13 mb-0">{{ $customer }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    @role('Master')
                                        <td>
                                            <span class="badge bg-primary text-light"> {{ $customerData->agent_code }}</span>
                                        </td>
                                    @endrole
                                    <td>
                                        <p class="mb-0">{{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</p>
                                    </td>
                                    <td>{{ $customerData->localization }}</td>
                                    <td> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}" class="cursor-pointer">
                                        <!-- {{ $cst->count() }} Properties  -->
                                        <span class="badge bg-success me-1">Villa</span>
                                        <!-- <span class="badge bg-warning me-1">Land</span> -->
                                    </td>
                                    <td>                    
                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#editMatchProperties-{{ $customerData->id }}">
                                            Make to Prospect
                                        </button>
                                        <input type="hidden" class="propertyId" value="{{ $customer }}">
                                        <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $customerData->cust_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                        <!-- Modal -->
                                        <div class="modal modal-xl fade" id="seeProperties-{{ $customerData->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Properties Selected </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <!-- Information Leads Villa -->
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Lead Information :</h5> <span class="badge bg-success me-1">Villa</span>
                                                            </div>
                                                            <div class="d-flex gap-2 my-2">
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-16 align-middle"></iconify-icon> {{ $customerData->cust_name }}</span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-16 align-middle"></iconify-icon> {{ $customerData->cust_email }}</span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</span>                                                            
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                                    IDR {{ number_format($customerData->cust_budget, 0, ',', '.') }}
                                                                    -
                                                                    IDR {{ number_format($customerData->cust_budget, 0, ',', '.') }}                                                                                                                                        
                                                                </span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                                    USD {{ number_format($customerData->cust_budget_usd, 2, ',', '.') }}
                                                                    -
                                                                    USD {{ number_format($customerData->cust_budget_usd, 2, ',', '.') }}                                                                                                                                        
                                                                </span>                                                                
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:bed-outline" class="fs-16 align-middle"></iconify-icon> 2 - 4 </span>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table-hover table-centered table text-nowrap" id="seePropertiesVillaDetailTable-{{ $customerData->id }}">
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
                                                                    <tbody>
                                                                        @foreach ($cst as $property)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $property->property_name }}</td>
                                                                                <td>{{ $property->agent_code }}</td>                                                                                
                                                                                <td>{{ $property->bedroom }}</td>
                                                                                <td>
                                                                                    <div class="d-block">
                                                                                        <h5 class="text-dark fw-medium mb-0" 
                                                                                        data-bs-toggle="modal" data-bs-target="#editMatchProperties-{{ $customerData->id }}" >
                                                                                            IDR 4.000.000.000
                                                                                        </h5>
                                                                                        <p class="fs-13 mb-0">USD 400.000</p>
                                                                                    </div>
                                                                                </td>  
                                                                                <td>{{ $property->property_address . ' ' . $property->sub_region . ', ' . $property->region }}</td>                                                                            
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                                                                             
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#seePropertiesVillaDetailTable-{{ $customerData->id }}').DataTable();
                                                                });
                                                            </script>
                                                    </div>

                                                    <!-- Information Leads Land -->
                                                    <!-- <div class="modal-body">
                                                        
                                                            <div class="d-flex gap-2 align-items-center">
                                                                <h5 class="modal-title" id="staticBackdropLabel">Lead Information :</h5><span class="badge bg-warning me-1">Land</span>
                                                            </div>
                                                            <div class="d-flex gap-2 my-2">
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-16 align-middle"></iconify-icon> {{ $customerData->cust_name }}</span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-16 align-middle"></iconify-icon> {{ $customerData->cust_email }}</span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</span>                                                            
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                                    IDR {{ number_format($customerData->cust_budget, 0, ',', '.') }}
                                                                    -
                                                                    IDR {{ number_format($customerData->cust_budget, 0, ',', '.') }}                                                                                                                                        
                                                                </span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px">
                                                                    USD {{ number_format($customerData->cust_budget_usd, 2, ',', '.') }}
                                                                    -
                                                                    USD {{ number_format($customerData->cust_budget_usd, 2, ',', '.') }}                                                                                                                                        
                                                                </span>
                                                                <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:fullscreen" class="fs-16 align-middle"></iconify-icon> 200 - 400 m² </span>
                                                            </div>
                                                            <div class="table-responsive">
                                                                <table class="table-hover  table-centered table text-nowrap" id="seePropertiesLandDetailTable-{{ $customerData->id }}">
                                                                    <thead class="table-light">
                                                                        <tr>
                                                                            <th scope="col">No</th>
                                                                            <th scope="col">Property Name</th>
                                                                            <th scope="col">Agent</th>
                                                                            <th scope="col">Size</th>                                                                            
                                                                            <th scope="col">Price</th>
                                                                            <th scope="col">Property Address</th>
                                                                        </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                        @foreach ($cst as $property)
                                                                            <tr>
                                                                                <td>{{ $loop->iteration }}</td>
                                                                                <td>{{ $property->property_name }}</td>
                                                                                <td>{{ $property->agent_code }}</td>
                                                                                <td>200 m²</td>                                                                                
                                                                                <td>
                                                                                    <div class="d-block">
                                                                                        <h5 class="text-dark fw-medium mb-0" 
                                                                                        data-bs-toggle="modal" data-bs-target="#editMatchProperties-{{ $customerData->id }}" >
                                                                                            IDR 4.000.000.000
                                                                                        </h5>
                                                                                        <p class="fs-13 mb-0">USD 400.000</p>
                                                                                    </div>
                                                                                </td> 
                                                                                <td>{{ $property->property_address . ' ' . $property->sub_region . ', ' . $property->region }}</td>                                                                              
                                                                            </tr>
                                                                        @endforeach
                                                                    </tbody>
                                                                </table>
                                                            </div>
                                                                                                             
                                                            <script>
                                                                $(document).ready(function() {
                                                                    $('#seePropertiesLandDetailTable-{{ $customerData->id }}').DataTable();
                                                                });
                                                            </script>
                                                    </div> -->

                                                    <div class="modal-footer">
                                                        
                                                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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

                                        {{-- Modal Make Prospect --}}
                                        <div class="modal modal-lg fade" id="editMatchProperties-{{ $customerData->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Please check and update the prospect file : </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('leadsToProspect', $customerData->id) }}" method="POST">
                                                        @csrf

                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <x-form-input className="col-lg-3" type="text" name="leads_name" label="First Name" value="{{ $customerData->cust_name }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="leads_name" label="Last Name" value="{{ $customerData->cust_name }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="leads_email" label="Email" value="{{ $customerData->cust_email }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="leads_telp" label="Phone" value="{{ $customerData->cust_telp }}" />
                                                                <div class="col-lg-3 mb-3">
                                                                    <label for="leads_looking_for" class="form-label text-muted">Looking For</label>
                                                                    <div class="form-check">
                                                                        <input type="checkbox" class="form-check-input" id="customCheck3">
                                                                        <label class="form-check-label" for="customCheck3">
                                                                            <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                                <path d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z" fill="#063436"></path>
                                                                            </svg>
                                                                            Villa
                                                                        </label>
                                                                    </div>
                                                                    <div class="form-check form-check-inline">
                                                                        <input type="checkbox" class="form-check-input" id="customCheck4">
                                                                        <label class="form-check-label" for="customCheck4">
                                                                            <svg  xmlns="http://www.w3.org/2000/svg" width="16" height="16"  
                                                                            fill="#063436" viewBox="0 0 24 24" >
                                                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2M5 19V5h14v14z"></path><path d="M12 9h3v3h2V7h-5zM9 12H7v5h5v-2H9z"></path>
                                                                            </svg>  
                                                                            Land
                                                                        </label>
                                                                    </div>
                                                                </div>
                                                                <x-form-input className="col-lg-3" type="text" name="leads_date" label="Ready to buy*" value="{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}" />
                                                                <x-form-input className="col-lg-3" type="text" name="leads_nationality" label="Nationality" value="" placeholder="Nationality" />
                                                                <x-form-input className="col-lg-3" type="text" name="leads_passport" label="Passport" value="" placeholder="Passport Number" />
                                                                <!-- Field Looking Villa -->
                                                                <div class="row">
                                                                    <div class="text-center d-flex justify-items-center justify-content-center">
                                                                        <hr class="w-100" />
                                                                        <label class="w-100 text-success">
                                                                            <span class="nav-icon">
                                                                                <i class="ri-community-line"></i>
                                                                            </span>
                                                                            Looking For Villa
                                                                        </label>
                                                                        <hr class="w-100" />
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <label for="">Localisation*</label>
                                                                        <select class="form-control" data-choices name="choices-single-default" id="choices-single-default">
                                                                            <option value="{{ $customerData->localization }}">{{ $customerData->localization }}</option>
                                                                            <option value="Choice 1">Mengwi</option>
                                                                            <option value="Choice 2">Nyanyi</option>
                                                                            <option value="Choice 3">Kuta</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="row">
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Budget min*" value="" />
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Budget max*" value="" />
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Bedroom min*" value="" />
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Bedroom max*" value="" />
                                                                    </div>
                                                                </div>
                                                                <!-- Field Looking Land -->
                                                                <!-- <div class="row">
                                                                    <div class="text-center d-flex justify-items-center justify-content-center">
                                                                        <hr class="w-100" />
                                                                        <label class="w-100 text-warning">
                                                                            <span class="nav-icon">
                                                                                <iconify-icon icon="icon-park-solid:local-pin" class="fs-14 align-middle"></iconify-icon>
                                                                            </span>
                                                                            Looking For Land
                                                                        </label>
                                                                        <hr class="w-100" />
                                                                    </div>
                                                                    <div class="mb-4">
                                                                        <label for="">Localisation*</label>
                                                                        <select class="form-control" data-choices name="choices-single-default" id="choices-single-default">
                                                                            <option value="{{ $customerData->localization }}">{{ $customerData->localization }}</option>
                                                                            <option value="Choice 1">Mengwi</option>
                                                                            <option value="Choice 2">Nyanyi</option>
                                                                            <option value="Choice 3">Kuta</option>
                                                                        </select>
                                                                    </div>
                                                                    <div class="row">
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Budget min*" value="" />
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Budget max*" value="" />
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Size (m²) min*" value="" />
                                                                        <x-form-input className="col-lg-3" type="text" name="localisation_villa" label="Size (m²) max*" value="" />
                                                                    </div>  
                                                                                                                                        
                                                                </div> -->
                                                                <!-- <x-form-input className="col-lg-6" type="text" name="leads_budget" label="Budget" value="IDR {{ number_format($customerData->cust_budget, 2, ',', '.') }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="leads_localization" label="Localization" value="{{ $customerData->localization }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="leads_date" label="Date Submit" value="{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}" disabled /> -->

                                                                <!-- <div class="col-lg-6 text-capitalize mb-3" id="group_status_prospect">
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
                                                                </div> -->

                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-primary">Save and Make Prospect</button>
                                                        </div>
                                                    </form>

                                                </div>
                                            </div>
                                        </div>
                                        {{-- Modal Make Prospect --}}

                                        {{-- Modal Edit Data Leads --}}
                                        <div class="modal modal-lg fade" id="editLeads-{{ $customerData->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Data Leads</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <form action="{{ route('leads.update', $customerData->id) }}" method="POST">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                <x-form-input className="col-lg-6" type="text" name="leads_name" label="Name" value="{{ $customerData->cust_name }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="leads_email" label="Email" value="{{ $customerData->cust_email }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="leads_telp" label="Phone Number" value="{{ $customerData->cust_telp }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="leads_budget" label="Budget" value="{{ $customerData->cust_budget }}" />

                                                                {{-- if master user : can edit/change localization data, but agent, can't --}}

                                                                <div class="col-lg-6 mb-3" id="group_localization">
                                                                    <label for="localization" class="form-label">Localization</label>
                                                                    <select id="localization" class="form-select" name="localization">
                                                                        <option value="" disabled selected>Select Region</option>
                                                                        @foreach ($data_localization as $localization)
                                                                            <option value="{{ $localization->name }}" {{ $localization->name == $customerData->localization ? 'selected' : '' }}>{{ $localization->name }}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>

                                                                <x-form-input className="col-lg-6" type="text" name="leads_date" label="Date Submit" value="{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}" disabled />

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

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
