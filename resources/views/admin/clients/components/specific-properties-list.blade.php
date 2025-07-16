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
                                <th scope="col">Customer Name</th>
                                @role('Master')
                                    <th scope="col">Leads From</th>
                                @endrole
                                <th scope="col">Phone Number</th>
                                <th scope="col">Localization</th>
                                <th scope="col">Property Selected</th>
                                <th scope="col">Date</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-flex align-items-center gap-1">
                                        <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                        <div class="d-block">
                                            <h5 class="text-dark fw-medium mb-0">Erik Cahya Pradana</h5>
                                            <p class="fs-13 mb-0">erikcp38@gmail.com</p>
                                        </div>
                                    </div>
                                </td>
                                @role('Master')
                                    <td>
                                        <span class="badge bg-primary text-light"> BLM-221-12</span>
                                    </td>
                                @endrole
                                <td>
                                    <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', '0895529231'), 4)) }}</p>
                                </td>
                                <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> Badung</td>

                                <td><iconify-icon icon="material-symbols:house-outline" class="fs-16 align-middle"></iconify-icon> 20 Properties Selected</td>
                                <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse('2002-2-3')->format('d F, Y') }}</td>
                                <td>

                                    <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#editLeads-1">
                                        <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                    </button>

                                    <button type="button" class="btn btn-xs btn-secondary" data-bs-toggle="modal" data-bs-target="#editMatchProperties-1">
                                        Make to Prospect
                                    </button>

                                    <input type="hidden" class="propertyId" value="1">

                                    <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="Erik Cahya Pradana"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                    <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#seeProperties-1">See Properties Select</button>

                                    <!-- Modal See Properties Select -->
                                    <div class="modal modal-xl fade" id="seeProperties-1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Properties Selected </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex gap-2">
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-10 align-middle"></iconify-icon> Erik Cahya Pradana</span>
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> erikcp38@gmail.com</span>
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse('2025-07-08')->format('d F, Y') }}</span>
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-10 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', '08901903123'), 4)) }}</span>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table-hover  table-centered table text-nowrap" id="seePropertiesDetailTable-1">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Property Name</th>
                                                                    <th scope="col">Property Address</th>
                                                                    <th scope="col">Require Customer Bedroom</th>
                                                                    <th scope="col">Customer Budget</th>
                                                                    <th scope="col">Customer USD</th>
                                                                    <th scope="col">Customer Message</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Grand Villa Ubud</td>
                                                                    <td>Jln. Gilimanuk Tabanan, Tabanan, Bali</td>
                                                                    <td>20</td>
                                                                    <td>IDR {{ number_format(200000000, 0, ',', '.') }}</td>
                                                                    <td>USD {{ number_format(200.0, 2, ',', '.') }}</td>
                                                                    <td>Hello im Erik</td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#seePropertiesDetailTable-1').DataTable();
                                                        });
                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
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
                                    <!-- /* Modal See Properties Select -->

                                    {{-- Modal Make Prospect --}}
                                    {{-- <div class="modal modal-lg fade" id="editMatchProperties-1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Make to Prospect</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('leadsToProspect', $customerData->id) }}" method="POST">
                                                    @csrf

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <x-form-input className="col-lg-6" type="text" name="leads_name" label="Name" value="{{ $customerData->cust_name }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_email" label="Email" value="{{ $customerData->cust_email }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_telp" label="Phone Number" value="{{ $customerData->cust_telp }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_budget" label="Budget" value="IDR {{ number_format($customerData->cust_budget, 2, ',', '.') }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_localization" label="Localization" value="{{ $customerData->localization }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_date" label="Date Submit" value="{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}" disabled />

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

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save to Prospect</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- Modal Make Prospect --}}



                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
