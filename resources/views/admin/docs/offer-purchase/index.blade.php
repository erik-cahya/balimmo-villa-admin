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
                    <h4 class="fw-semibold mb-0">Visit List</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Visit</a></li>
                        <li class="breadcrumb-item active">Docs Visit List</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h4 class="card-title">All Document Visit List</h4>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered table text-nowrap" id="visitDocsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Customer Name</th>
                                        <th>Property Name</th>
                                        <th>Deposit Ammount</th>
                                        <th>Client Nationality</th>
                                        <th>Docs Created</th>
                                        @role('Master')
                                            <th>Reference</th>
                                        @endrole
                                        <th>Letter Status</th>

                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($offering_docs as $offering)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="#!" class="text-dark fw-medium"><iconify-icon icon="qlementine-icons:user-16" class="fs-16 align-middle"></iconify-icon> {{ $offering->custName }}</a>
                                                    <div>

                                                        <span class="fst-italic fs-12">{{ $offering->email }}</span>
                                                        |
                                                        <span class="fst-italic fs-12">{{ implode('-', str_split(preg_replace('/\D/', '', $offering->cust_telp), 4)) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <span class="badge bg-dark text-light fs-12"><iconify-icon icon="f7:house-fill" class="align-middle"></iconify-icon> {{ $offering->property_name }}</span>
                                            </td>
                                            <td class="fs-13 fw-medium">
                                                <iconify-icon icon="ph:hand-deposit-duotone" class="fs-20 align-middle"></iconify-icon>IDR {{ number_format($offering->deposit_ammount, 2, ',', '.') }}
                                            </td>
                                            <td class="fs-12 text-uppercase">
                                                <iconify-icon icon="streamline-ultimate:flag-bold" class="fs-20 align-middle"></iconify-icon> {{ $offering->client_nationality }}
                                            </td>
                                            <td class="fs-12">
                                                <iconify-icon icon="fluent-mdl2:event-date" class="fs-20 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($offering->created_at)->format('d F, Y') }}

                                            </td>
                                            @role('Master')
                                                <td>
                                                    <span class="badge bg-dark text-light fs-12"><iconify-icon icon="si:user-fill" class="align-middle"></iconify-icon> {{ $offering->reference_code }}</span>
                                                </td>
                                            @endrole
                                            <td>
                                                <div class="d-flex flex-column gap-2">
                                                    @php
                                                        if ($offering->status_docs == 'New Offering') {
                                                            $className = 'bg-secondary';
                                                        } elseif ($offering->status_docs == 'Offer Accepted') {
                                                            $className = 'bg-success';
                                                        } elseif ($offering->status_docs == 'Counter Offer') {
                                                            $className = 'bg-warning';
                                                        } else {
                                                            $className = 'bg-danger';
                                                        }
                                                    @endphp
                                                    <span class="badge {{ $className }} text-light fs-12"><iconify-icon icon="pajamas:status" class="align-middle"></iconify-icon> {{ $offering->status_docs }}</span>
                                                    @if ($offering->response_docs_path !== null)
                                                        <a target="_blank" href="{{ asset('admin/attachment/' . $offering->property_slug . '/' . $offering->response_docs_path) }}" class="btn btn-xs btn-primary"><iconify-icon icon="material-symbols-light:download-rounded" class="fs-20 align-middle"></iconify-icon> Download Response</a>
                                                    @endif
                                                </div>
                                            </td>
                                            <td>
                                                <div class="btn-group mb-1 me-1">

                                                    @if ($offering->status_docs == 'Offer Accepted')
                                                        <form action="{{ route('client.fromOffering') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" name="cust_id" value="{{ $offering->client_id }}">
                                                            <button type="submit" class="btn btn-xs btn-outline-primary">Make Client</button>
                                                        </form>
                                                    @endif

                                                    {{-- Download Btn --}}
                                                    <button id="dropdown" type="button" class="btn btn-xs btn-primary text-light dropdown-toggle fw-medium" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Download
                                                    </button>
                                                    <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"><iconify-icon icon="ep:edit" class="fs-12 align-middle"></iconify-icon></button>

                                                    {{-- Delete Btn --}}
                                                    <input type="hidden" class="propertyId" value="{{ $offering->id }}">
                                                    <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $offering->first_name . ' ' . $offering->last_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>

                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown">
                                                        <li>
                                                            <form action="{{ route('offer-purchase.pdf.english') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="offering_id" value="{{ $offering->id }}">
                                                                {{-- <input type="hidden" name="last_name" value="{{ $offering->last_name }}">
                                                                <input type="hidden" name="phone_number" value="{{ $offering->phone_number }}">
                                                                <input type="hidden" name="email" value="{{ $offering->email }}"> --}}

                                                                <button type="submit" class="dropdown-item"><iconify-icon icon="material-symbols:download-rounded" class="fs-12 align-middle"></iconify-icon> Download Offering Docs</button>
                                                            </form>
                                                        </li>
                                                        @if ($offering->response_docs_path !== null)
                                                            <li><a class="dropdown-item" href="{{ asset('admin/attachment/' . $offering->property_slug . '/' . $offering->response_docs_path) }}" target="_blank"><iconify-icon icon="material-symbols:download-rounded" class="fs-12 align-middle"></iconify-icon> Download Response Docs</a></li>
                                                        @endif
                                                        {{-- <li><a class="dropdown-item disabled" href="javascript:void(0);" target="_blank"><iconify-icon icon="openmoji:flag-france" class="fs-12 align-middle"></iconify-icon> France Version</a></li> --}}
                                                    </ul>
                                                </div>
                                            </td>
                                        </tr>

                                        <!-- Modal Edit-->
                                        <div class="modal modal-lg fade" id="resetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <form action="{{ route('offer-purchase.update', $offering->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="modal-content">
                                                        <div class="modal-header">
                                                            <h5 class="modal-title" id="staticBackdropLabel">Edit Offering Docs</h5>
                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                        </div>
                                                        <div class="modal-body">
                                                            <div class="row">
                                                                {{-- {{ dd($offering) }} --}}
                                                                {{-- <input type="hidden" name="reference_code" value="{{ $profile->id }}"> --}}
                                                                <x-form-input className="col-lg-6" type="text" name="customer_first_name" label="Customer Name" value="{{ $offering->custName }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="customer_nationality" label="Customer Nationality" value="{{ $offering->client_nationality }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="customer_email" label="Customer Email" value="{{ $offering->email }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="customer_phone" label="No Phone" value="{{ $offering->cust_telp }}" disabled />
                                                                <x-form-input className="col-lg-6" type="date" name="date_visit" label="Offer Validity" value="{{ $offering->offer_validity }}" disabled />
                                                                <x-form-input className="col-lg-6" type="text" name="deposit_ammount" label="Deposit Ammount" value="{{ $offering->offer_validity }}" disabled />

                                                                <hr>
                                                                <div class="col-lg-6">
                                                                    <label class="form-label" for="status_docs">Status Docs</label>
                                                                    <select name="status_docs" id="status_docs" class="form-control">
                                                                        <option value="" selected disabled>Choose Status Docs</option>
                                                                        <option value="New Offering" {{ $offering->status_docs == 'New Offering' ? 'selected' : '' }}>New Offering</option>
                                                                        <option value="Offer Accepted" {{ $offering->status_docs == 'Offer Accepted' ? 'selected' : '' }}>Offer Accepted</option>
                                                                        <option value="Counter Offer" {{ $offering->status_docs == 'Counter Offer' ? 'selected' : '' }}>Counter Offer</option>
                                                                        <option value="Refused"{{ $offering->status_docs == 'Refused' ? 'selected' : '' }}>Refused</option>
                                                                    </select>
                                                                </div>
                                                                <div class="col-lg-6 mb-3">
                                                                    <label for="response_docs" class="form-label">Upload Response Docs</label>
                                                                    <input type="file" id="response_docs" name="response_docs" class="form-control" placeholder="">
                                                                </div>
                                                            </div>

                                                        </div>
                                                        <div class="modal-footer">
                                                            <button type="button" class="btn btn-xs btn-secondary" data-bs-dismiss="modal">Close</button>
                                                            <button type="submit" class="btn btn-xs btn-primary">Save Data Offering</button>
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
                                        <!-- /* Modal Edit-->
                                    @endforeach

                                </tbody>
                            </table>
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
            $('#visitDocsTable').DataTable({
                ordering: false
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

                    const rowToDelete = this.closest('tr');


                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete Offering Docs " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/offer-purchase/' + propertyId, {
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
                                    // $('#visitDocsTable').DataTable().ajax.reload();
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
