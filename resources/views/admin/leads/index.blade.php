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
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Property Leads </h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Leads</a></li>
                        <li class="breadcrumb-item active">Leads Property List</li>
                    </ol>
                </div>
            </div>
        </div>

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

        {{-- Mathce Properties --}}
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
                                        <th scope="col">Budget</th>
                                        <th scope="col">Localization</th>
                                        <th scope="col">Leads Message</th>
                                        <th scope="col">Date</th>

                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>

                                    @foreach ($data_leads_matches as $matchLeads)
                                        @php
                                            $authUser = Auth::user();
                                            $referenceCode = $authUser->role === 'Master' ? null : $authUser->reference_code;
                                            // Ambil properti yang sudah difilter
                                            $filteredMatchLeads = $referenceCode ? $matchProperties[$matchLeads->id]->where('internal_reference', $referenceCode) : $matchProperties[$matchLeads->id];
                                        @endphp
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex align-items-center gap-1">
                                                    <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                                    <div class="d-block">
                                                        <h5 class="text-dark fw-medium mb-0">{{ $matchLeads->cust_name }}</h5>
                                                        <p class="fs-13 mb-0">{{ $matchLeads->cust_email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', $matchLeads->cust_telp), 4)) }}</p>

                                            </td>
                                            <td>

                                                <p class="mb-0"><iconify-icon icon="tdesign:money-filled" class="fs-16 align-middle"></iconify-icon> IDR {{ number_format($matchLeads->cust_budget, 2, ',', '.') }}</p>

                                            </td>
                                            <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> {{ $matchLeads->localization }}</td>

                                            <td>{{ $matchLeads->message }}</td>
                                            <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($matchLeads->date)->format('d F, Y') }}</td>

                                            <td>
                                                @if ($filteredMatchLeads->count() == 0)
                                                    <span class="btn btn-sm btn-primary">No Match Properties</span>
                                                @else
                                                    <button class="btn btn-sm btn-primary toggle-villas" type="button" data-bs-toggle="modal" data-bs-target="#matchProperties">
                                                        Show {{ $filteredMatchLeads->count() }} Properties
                                                    </button>
                                                @endif
                                            </td>
                                        </tr>
                                        <!-- Modal -->
                                        <div class="modal modal-xl fade" id="matchProperties" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('agent.changePassword') }}" method="POST">
                                                    @csrf
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Reset User Password</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
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
                                                                                        <h3 class="fw-normal fs-16 fst-italic text-white">IDR {{ number_format($properties->selling_price_idr, 2, ',', '.') }}</h3>
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
                                                            <button type="submit" class="btn btn-primary">Change Password</button>
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
                                                </form>
                                            </div>
                                        </div>
                                        <!-- /* Modal -->
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        {{-- /* Mathce Properties --}}

    </div>
@endsection
@push('scripts')
    {{-- <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script> --}}

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
            $('#specificPropertyTable').DataTable();
            $('#seePropertiesTable-' + this.getAttribute('data-nama')).DataTable();
        });
    </script>
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
                    console.log(propertyId);

                    const rowToDelete = this.closest('tr');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete leads " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/leads/' + propertyId, {
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

                                    // Hapus baris dari DOM tanpa reload halaman
                                    if (rowToDelete) {
                                        rowToDelete.remove();
                                    }

                                    // Atau jika menggunakan DataTables, refresh tabel:
                                    // $('#table-id').DataTable().ajax.reload();
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
@endpush
