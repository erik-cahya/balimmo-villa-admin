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
                                @role('Master')
                                    <th scope="col">Leads From</th>
                                @endrole
                                <th scope="col">Phone Number</th>
                                <th scope="col">Localization</th>
                                <th scope="col">Ready to Buy</th>
                                <th scope="col">Looking For</th>

                                <th scope="col">Action</th>
                            </tr>
                        </thead>
                        <tbody>

                            @foreach ($data_leads as $customer)
                                @php
                                    $customerData = $customer;
                                @endphp

                                {{-- {{ dd($customerData) }} --}}

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}">
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                            <div class="d-block">
                                                <h5 class="text-dark fw-medium mb-0">{{ $customerData->first_name . ' ' . $customerData->last_name }}</h5>
                                                <p class="fs-13 mb-0">{{ $customerData->cust_email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    @role('Master')
                                        <td>
                                            <span class="badge bg-primary text-light"> {{ $customerData->agent_code }}</span>
                                        </td>
                                    @endrole
                                    <td>
                                        <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_phone), 4)) }}</p>
                                    </td>
                                    <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> {{ $customerData->localization }}</td>

                                    <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</td>
                                    <td>
                                        <span class="text-capitalize fw-medium badge bg-success">Villa</span>
                                        <span class="text-capitalize fw-medium badge bg-danger">Land</span>
                                    </td>
                                    <td>
                                        <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#makeProspect-{{ $customerData->id }}">
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
                                                        <div class="d-flex gap-2">
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-10 align-middle"></iconify-icon> {{ $customerData->cust_name }}</span>
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> {{ $customerData->cust_email }}</span>
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</span>
                                                            <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-10 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</span>
                                                        </div>
                                                        <div class="table-responsive">
                                                            <table class="table-hover table-centered table text-nowrap" id="seePropertiesDetailTable-{{ $customerData->id }}">
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
                                                                        <td>Villa</td>
                                                                        <td>Villa</td>
                                                                        <td>Villa</td>
                                                                        <td>Villa</td>
                                                                        <td>Villa</td>
                                                                        <td>Villa</td>

                                                                    </tr>
                                                                </tbody>
                                                            </table>
                                                        </div>

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

                                        {{-- Modal Make to Prospect --}}

                                        {{-- END Modal Make to Prospect --}}

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
