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
    </style>
@endpush
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Client List</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Clients</a></li>
                        <li class="breadcrumb-item active">Clients List</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row justify-content-between">
                            <div class="col-lg-6">
                                <div class="row align-items-center">
                                    <div class="col-lg-6">
                                        <form class="app-search d-md-block me-auto">
                                            <div class="position-relative">
                                                <input type="text" id="search_props" class="form-control" placeholder="Search Clients" autocomplete="off">
                                                <iconify-icon icon="solar:magnifer-broken" class="search-widget-icon"></iconify-icon>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="text-dark fw-medium mb-0"> <span class="text-muted">{{ $data_client->count() }} Client</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-md-end mt-md-0 mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1" data-bs-toggle="modal" data-bs-target="#addNewClientModal"><i class="ri-add-line me-1"></i> Add New Clients</button>
                                    {{-- <button type="button" class="btn btn-sm btn-outline-primary btn-disabled me-1" data-bs-toggle="modal" data-bs-target="#importProspect"><i class="ri-user-line me-1"></i> Import From Prospects</button> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Add New Clients Modal -->
        <div class="modal modal-lg fade" id="addNewClientModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('clients.store') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Add New Client</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <x-form-input className="col-lg-12" type="text" name="client_name" label="Input First Name" />
                                <x-form-input className="col-lg-6" type="email" name="client_email" label="Input Email" />
                                <x-form-input className="col-lg-6" type="number" name="client_phone" label="Input Phone Number" />
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Add Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <!-- Import from prospect Modal -->
        <div class="modal modal-lg fade" id="importProspect" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <form action="{{ route('client.fromLeads') }}" method="POST">
                        @csrf
                        <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Import From Data Prospect <span class="badge bg-danger text-capitalize me-1">{{ $data_leads->count() }}</span></h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="table-responsive">
                                <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="myTable">
                                    <thead class="bg-light-subtle">
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                    <label class="form-check-label" id="selectAll"></label>
                                                </div>
                                            </th>
                                            <th>Customer Name </th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_leads as $leads)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="leadsData[]" class="form-check-input" id="{{ $leads['id'] }}" value="{{ $leads['id'] }}">
                                                        <label class="form-check-label" for="{{ $leads['id'] }}">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="d-flex align-items-center gap-2">
                                                        <div>
                                                            <img src="{{ asset('admin') }}/assets/images/users/default.jpg" alt="" class="avatar-sm rounded-circle">
                                                        </div>
                                                        <div>
                                                            <a href="#!" class="text-dark fw-medium fs-15">{{ $leads['cust_name'] }}</a>
                                                        </div>
                                                    </div>

                                                </td>
                                                <td>{{ $leads['cust_email'] }}</td>
                                                <td>{{ implode('-', str_split(preg_replace('/\D/', '', $leads['cust_telp']), 4)) }}</td>
                                            </tr>
                                        @endforeach

                                    </tbody>
                                </table>
                            </div>

                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                            <button type="submit" class="btn btn-primary">Save Data</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="row d-flex justify-content-center">
            <div class="col-xl-10">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h4 class="card-title">All Customers List</h4>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered table text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Client Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Phone Number</th>
                                        @role('Master')
                                            <th scope="col">From Agent</th>
                                        @endrole
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody id="property-list">
                                    @include('admin.clients.partials.data-clients', ['data_client' => $data_client])
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="card-footer">
                        <nav aria-label="Page navigation example">
                            <ul class="pagination justify-content-end mb-0">
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Previous</a></li>
                                <li class="page-item active"><a class="page-link" href="javascript:void(0);">1</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">2</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">3</a></li>
                                <li class="page-item"><a class="page-link" href="javascript:void(0);">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>

        </div>

        <div class="toast-container position-fixed end-0 top-0 p-3">
            <div id="liveToast2" class="toast text-bg-danger" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="toast-header">
                    <div class="auth-logo me-auto">
                        <img class="logo-dark" src="{{ asset('admin') }}/assets/images/logo-dark.png" alt="logo-dark" height="18" />
                        <img class="logo-light" src="{{ asset('admin') }}/assets/images/logo-light.png" alt="logo-light" height="18" />
                    </div>
                    {{-- <small class="text-muted">2 seconds ago</small> --}}
                    <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
                </div>
                <div class="toast-body">
                    {{ $errors->first('dataLeads') }}
                </div>
            </div>
        </div>

    </div>
@endsection
@push('scripts')
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    @if ($errors->has('dataLeads'))
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const toastLiveExample2 = document.getElementById('liveToast2');
                const toast = new bootstrap.Toast(toastLiveExample2);
                toast.show();
            });
        </script>
    @endif

    @if ($errors->any() && !$errors->has('dataLeads'))
        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var resetModal = new bootstrap.Modal(document.getElementById('addNewClientModal'));
                resetModal.show();
            });
        </script>
    @endif

    {{-- Checkbox --}}
    <script>
        $('#selectAll').on('change', function() {
            $('.form-check-input').prop('checked', this.checked);
        });
    </script>
    {{-- /* Checkbox --}}

    {{-- Search --}}
    <script>
        function debounce(func, delay) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        $(document).ready(function() {
            function fetchFilteredProperties() {
                let formData = {
                    query: $('#search_props').val(),
                };

                $.ajax({
                    url: '{{ route('client.search') }}',
                    type: 'GET',
                    data: formData,
                    success: function(data) {
                        $('#property-list').html(data);
                    }
                });
            }

            // Event untuk semua filter
            $('#search_props').on('keyup', debounce(fetchFilteredProperties, 300));
        });
    </script>
    {{-- /*Search --}}

    {{-- Sweet Alert Delete --}}
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const deleteButtons = document.querySelectorAll('.deleteButton');

            deleteButtons.forEach(button => {
                button.addEventListener('click', function(e) {
                    e.preventDefault();

                    let propertyName = this.getAttribute('data-nama');
                    let propertyId = this.parentElement.querySelector('.propertyId').value;

                    const rowToDelete = this.closest('tr');

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete clients " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            fetch('/clients/' + propertyId, {
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

    {{-- /* End Sweet Alert Delete --}}

@endpush
