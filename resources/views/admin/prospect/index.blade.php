@extends('admin.layouts.master')
@push('style')
    <link rel="stylesheet" href="{{ asset('admin/assets/css/dataTable.min.css') }}">

    <style>
        .dataTables_filter input {
            border: 1px solid #eaedf1 !important;
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
        <!-- <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Prospect Client </h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Prospect</a></li>
                        <li class="breadcrumb-item active">Prospect Client List</li>
                    </ol>
                </div>
            </div>
        </div> -->

        <ul class="nav nav-tabs">
            <li class="nav-item">
                <a href="#villa" data-bs-toggle="tab" aria-expanded="true" class="nav-link active">
                    <span class="d-none d-sm-block">Villa</span>
                </a>
            </li>
            <li class="nav-item">
                <a href="#land" data-bs-toggle="tab" aria-expanded="false" class="nav-link">
                    <span class="d-block d-sm-none"><i class="bx bx-user"></i></span>
                    <span class="d-none d-sm-block">Land</span>
                </a>
            </li>            
        </ul>
        <div class="tab-content  text-muted">
            {{-- Prospect Client Villa --}}
            <div class="tab-pane show active" id="villa">
                {{-- Prospect Client Villa Data --}}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                                <div>
                                    <h4 class="card-title">Prospect Client Villa</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-hover table-centered table text-nowrap" id="myTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Prospect Name</th>
                                                @role('Master')
                                                    <th scope="col">Agent</th>
                                                @endrole
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Localization</th>
                                                <th scope="col">Ready to buy</th>
                                                <th scope="col">Villa Selected</th>                                        
                                                <th scope="col">Status</th>
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
                                                        <a href="{{ route('visit.create') }}" class="d-block">
                                                            <h5 class="text-dark fw-medium mb-0">{{ $customerData->cust_name }}</h5>
                                                            <p class="fs-13 mb-0 ">{{ $customer }}</p>
                                                        </a>
                                                    </td>
                                                    @role('Master')
                                                        <td>
                                                            <span class="badge bg-primary text-light"> {{ $customerData->agent_code }}</span>
                                                        </td>
                                                    @endrole
                                                    <td>
                                                        <p class="mb-0"> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</p>
                                                    </td>
                                                    <td>{{ $customerData->localization }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</td>
                                                    <td>{{ $cst->count() }}</td>
                                                    
                                                    @php
                                                        if ($customerData->docs_status == null) {
                                                            $customerData->docs_status = 'New Prospect';
                                                        } elseif ($customerData->docs_status == 0) {
                                                            $customerData->docs_status = 'Declined';
                                                        } elseif ($customerData->docs_status == 1) {
                                                            $customerData->docs_status = 'Visit';
                                                        } elseif ($customerData->docs_status == 2) {
                                                            $customerData->docs_status = 'Offering';
                                                        }
                                                    @endphp
                                                    <td class="fw-medium text-dark fst-italic">
                                                        <span class="badge bg-success me-1">{{ $customerData->docs_status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-1 me-1">
                                                            <input type="hidden" class="propertyId" value="{{ $customer }}">

                                                            <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $customerData->cust_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                                            {{-- <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}">See Properties</button> --}}
                                                            {{-- <button id="verticalDropdown" type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                More Action
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="verticalDropdown" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-0.555556px, 114.444px, 0px);" data-popper-placement="bottom-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}"><iconify-icon icon="weui:eyes-on-outlined" class="fs-12 align-middle"></iconify-icon> See Properties</a></li>
                                                                <li><a class="dropdown-item" href="{{ route('visit.create') }}"><iconify-icon icon="material-symbols:docs-sharp" class="fs-12 align-middle"></iconify-icon> Create Visit Docs</a></li>
                                                                <li><a class="dropdown-item" href="{{ route('offer-purchase.create') }}"><iconify-icon icon="streamline-ultimate:paper-write" class="fs-12 align-middle"></iconify-icon> Create Offering Docs</a></li>
                                                            </ul>
                                                            --}}
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
                                                                        <a href="{{ route('visit.create') }}" class="btn btn-sm btn-primary">Create Visit Docs</a>
                                                                        <a href="{{ route('offer-purchase.create') }}" class="btn btn-sm btn-primary">Create Offering Docs</a>
                                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
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
            </div>

            {{-- Prospect Client Land --}}
            <div class="tab-pane " id="land">
                {{-- Prospect Client Land Data --}}
                <div class="row">
                    <div class="col-xl-12">
                        <div class="card">
                            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                                <div>
                                    <h4 class="card-title">Prospect Client Land</h4>
                                </div>
                            </div>
                            <div class="card-body p-0">
                                <div class="table-responsive">
                                    <table class="table-hover table-centered table text-nowrap" id="myTable">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Prospect Name</th>
                                                @role('Master')
                                                    <th scope="col">Agent</th>
                                                @endrole
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Localization</th>
                                                <th scope="col">Ready to buy</th>
                                                <th scope="col">Land Selected</th>                                        
                                                <th scope="col">Status</th>
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
                                                        <a href="{{ route('visit.create') }}" class="d-block">
                                                            <h5 class="text-dark fw-medium mb-0">{{ $customerData->cust_name }}</h5>
                                                            <p class="fs-13 mb-0 ">{{ $customer }}</p>
                                                        </a>
                                                    </td>
                                                    @role('Master')
                                                        <td>
                                                            <span class="badge bg-primary text-light"> {{ $customerData->agent_code }}</span>
                                                        </td>
                                                    @endrole
                                                    <td>
                                                        <p class="mb-0"> {{ implode('-', str_split(preg_replace('/\D/', '', $customerData->cust_telp), 4)) }}</p>
                                                    </td>
                                                    <td>{{ $customerData->localization }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}</td>
                                                    <td>{{ $cst->count() }}</td>
                                                    
                                                    @php
                                                        if ($customerData->docs_status == null) {
                                                            $customerData->docs_status = 'New Prospect';
                                                        } elseif ($customerData->docs_status == 0) {
                                                            $customerData->docs_status = 'Declined';
                                                        } elseif ($customerData->docs_status == 1) {
                                                            $customerData->docs_status = 'Visit';
                                                        } elseif ($customerData->docs_status == 2) {
                                                            $customerData->docs_status = 'Offering';
                                                        }
                                                    @endphp
                                                    <td class="fw-medium text-dark fst-italic">
                                                        <span class="badge bg-success me-1">{{ $customerData->docs_status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-1 me-1">
                                                            <input type="hidden" class="propertyId" value="{{ $customer }}">

                                                            <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $customerData->cust_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                                            {{-- <button type="button" class="btn btn-xs btn-primary" data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}">See Properties</button> --}}
                                                            {{-- <button id="verticalDropdown" type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="true">
                                                                More Action
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="verticalDropdown" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(-0.555556px, 114.444px, 0px);" data-popper-placement="bottom-end">
                                                                <li><a class="dropdown-item" href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#seeProperties-{{ $customerData->id }}"><iconify-icon icon="weui:eyes-on-outlined" class="fs-12 align-middle"></iconify-icon> See Properties</a></li>
                                                                <li><a class="dropdown-item" href="{{ route('visit.create') }}"><iconify-icon icon="material-symbols:docs-sharp" class="fs-12 align-middle"></iconify-icon> Create Visit Docs</a></li>
                                                                <li><a class="dropdown-item" href="{{ route('offer-purchase.create') }}"><iconify-icon icon="streamline-ultimate:paper-write" class="fs-12 align-middle"></iconify-icon> Create Offering Docs</a></li>
                                                            </ul>
                                                            --}}
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
                                                                        <a href="{{ route('visit.create') }}" class="btn btn-sm btn-primary">Create Visit Docs</a>
                                                                        <a href="{{ route('offer-purchase.create') }}" class="btn btn-sm btn-primary">Create Offering Docs</a>
                                                                        <button type="button" class="btn btn-sm btn-secondary" data-bs-dismiss="modal">Close</button>
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
            </div>      
        </div>
        

    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>

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

                                    if (rowToDelete) {
                                        rowToDelete.remove();
                                    }
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
