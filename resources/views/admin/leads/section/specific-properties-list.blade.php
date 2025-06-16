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

                            @foreach ($data_leads as $customer => $cst)
                                @php
                                    $customerData = $cst->first();
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                            <div class="d-block">
                                                <h5 class="text-dark fw-medium mb-0">{{ $customerData->cust_name }}</h5>
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
                                        <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</p>
                                    </td>
                                    <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> {{ $customerData->localization }}</td>

                                    <td><iconify-icon icon="material-symbols:house-outline" class="fs-16 align-middle"></iconify-icon> {{ $cst->count() }} Properties Selected</td>
                                    <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</td>
                                    <td>
                                        <div class="btn-group mb-1 me-1">
                                            <button type="button" class="btn btn-xs btn-warning"><iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon></button>

                                            <input type="hidden" class="propertyId" value="{{ $customer }}">

                                            <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $customerData->cust_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                            <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}">See Properties</button>
                                        </div>

                                        <!-- Modal -->
                                        <div class="modal modal-xl fade" id="seeProperties-{{ $customerData->id }}" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Properties Selected </h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div class="d-flex gap-2">
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-10 align-middle"></iconify-icon> {{ $customerData->cust_name }}</span>
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> {{ $customerData->cust_email }}</span>
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</span>
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-10 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</span>
                                                        </div>
                                                        <table class="table-hover table-centered table text-nowrap" id="seePropertiesDetailTable-{{ $customerData->id }}">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Property Name</th>
                                                                    <th scope="col">Property Address</th>
                                                                    <th scope="col">Require Customer Bedroom</th>
                                                                    <th scope="col">Customer Budget</th>
                                                                    <th scope="col">Customer Message</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                @foreach ($cst as $property)
                                                                    <tr>
                                                                        <td>{{ $loop->iteration }}</td>
                                                                        <td>{{ $property->property_name }}</td>
                                                                        <td>{{ $property->property_address . ' ' . $property->sub_region . ', ' . $property->region }}</td>
                                                                        <td>{{ $property->require_bedroom }}</td>
                                                                        <td>IDR {{ number_format($property->cust_budget, 2, ',', '.') }}</td>
                                                                        <td>{{ $property->message }}</td>
                                                                    </tr>
                                                                @endforeach
                                                            </tbody>
                                                        </table>

                                                        <script>
                                                            $(document).ready(function() {
                                                                $('#seePropertiesDetailTable-{{ $customerData->id }}').DataTable();
                                                            });
                                                        </script>
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
