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
        <div class="tab-content text-muted">
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
                                    <table class="table-hover table-centered table text-nowrap" id="villaProspect">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Prospect Name</th>
                                                <th scope="col">Agent</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Area</th>
                                                <th scope="col">Ready to buy</th>
                                                <th scope="col">Villa Selected</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($data_prospect_villa as $prospect_villa)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('prospects.details', $prospect_villa->customer_id) }}" class="d-block">
                                                            <h5 class="text-dark fw-medium mb-0">{{ $prospect_villa->first_name . ' ' . $prospect_villa->last_name }}</h5>
                                                            <p class="fs-13 mb-0">{{ $prospect_villa->cust_email }}</p>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary text-light">{{ $prospect_villa->agent_code }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">{{ implode('-', str_split(preg_replace('/\D/', '', $prospect_villa->cust_phone), 4)) }}</p>
                                                    </td>
                                                    <td class="text-capitalize">{{ $prospect_villa->localization }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($prospect_villa->date)->format('d F, Y') }}</td>
                                                    <td>1</td>

                                                    <td class="fw-medium text-dark fst-italic">
                                                        <span class="badge bg-success text-capitalize me-1">{{ $prospect_villa->status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-1 me-1">
                                                            <input type="hidden" class="propertyId" value="{{ $prospect_villa->first_name . ' ' . $prospect_villa->last_name }}">
                                                            <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $prospect_villa->first_name . ' ' . $prospect_villa->last_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                                        </div>
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
            <div class="tab-pane" id="land">
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
                                    <table class="table-hover table-centered table text-nowrap" id="landProspect">
                                        <thead class="table-light">
                                            <tr>
                                                <th scope="col">No</th>
                                                <th scope="col">Prospect Name</th>
                                                <th scope="col">Agent</th>
                                                <th scope="col">Phone Number</th>
                                                <th scope="col">Area</th>
                                                <th scope="col">Ready to buy</th>
                                                <th scope="col">Land Selected</th>
                                                <th scope="col">Status</th>
                                                <th scope="col">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            @foreach ($data_prospect_land as $prospect_land)
                                                <tr>
                                                    <td>{{ $loop->iteration }}</td>
                                                    <td>
                                                        <a href="{{ route('prospects.details', $prospect_land->customer_id) }}" class="d-block">
                                                            <h5 class="text-dark fw-medium mb-0">{{ $prospect_land->first_name . ' ' . $prospect_land->last_name }}</h5>
                                                            <p class="fs-13 mb-0">{{ $prospect_land->cust_email }}</p>
                                                        </a>
                                                    </td>
                                                    <td>
                                                        <span class="badge bg-primary text-light">{{ $prospect_land->agent_code }}</span>
                                                    </td>
                                                    <td>
                                                        <p class="mb-0">{{ implode('-', str_split(preg_replace('/\D/', '', $prospect_land->cust_phone), 4)) }}</p>
                                                    </td>
                                                    <td class="text-capitalize">{{ $prospect_land->localization }}</td>
                                                    <td>{{ \Carbon\Carbon::parse($prospect_land->date)->format('d F, Y') }}</td>
                                                    <td>1</td>

                                                    <td class="fw-medium text-dark fst-italic">
                                                        <span class="badge bg-success text-capitalize me-1">{{ $prospect_land->status }}</span>
                                                    </td>
                                                    <td>
                                                        <div class="btn-group mb-1 me-1">
                                                            <input type="hidden" class="propertyId" value="{{ $prospect_land->first_name . ' ' . $prospect_land->last_name }}">
                                                            <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $prospect_land->first_name . ' ' . $prospect_land->last_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                                        </div>
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
            $('#villaProspect').DataTable({
                pageLength: 50
            });
            $('#landProspect').DataTable({
                pageLength: 50
            });
            $('#myTable').DataTable({
                pageLength: 50
            });
            $('#specificPropertyTable').DataTable({
                pageLength: 50
            });
            $('#seePropertiesTable-' + this.getAttribute('data-nama')).DataTable({
                pageLength: 50
            });
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
