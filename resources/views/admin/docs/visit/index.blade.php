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
                            <table class="table-hover table-centered fs-14 table text-nowrap" id="visitDocsTable">
                                <thead class="table-light">
                                    <tr>
                                        <th>No</th>
                                        <th>Customer Name</th>
                                        <th>Property Name</th>
                                        <th>Docs Created</th>
                                        <th>Date Visit</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visit_docs as $visit)
                                        <tr>
                                            <td>{{ $loop->iteration }}</td>
                                            <td>
                                                <div class="d-flex flex-column">
                                                    <a href="#!" class="text-dark fw-medium fs-15"><iconify-icon icon="qlementine-icons:user-16" class="fs-16 align-middle"></iconify-icon> {{ $visit->first_name . ' ' . $visit->last_name }}</a>
                                                    <div>

                                                        <span class="fst-italic fs-12">{{ $visit->email }}</span>
                                                        |
                                                        <span class="fst-italic fs-12">{{ implode('-', str_split(preg_replace('/\D/', '', $visit->phone_number), 4)) }}</span>
                                                    </div>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="d-flex flex-wrap gap-1">
                                                    @foreach ($property_list[$visit->id] ?? [] as $properties)
                                                        <span class="badge bg-dark text-light" style="font-size: 10px"><iconify-icon icon="f7:house-fill" class="fs-10 align-middle"></iconify-icon> {{ $properties->property_name }}</span>
                                                    @endforeach
                                                </div>
                                            </td>
                                            <td class="fs-12">
                                                <iconify-icon icon="eos-icons:modified-date-outlined" class="fs-20 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($visit->created_at)->format('d F, Y') }}
                                            </td>
                                            <td class="fs-12">
                                                <iconify-icon icon="fluent-mdl2:event-date" class="fs-20 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($visit->visit_date)->format('d F, Y') }}
                                            </td>
                                            <td>
                                                @if ($visit->status_docs == 0)
                                                    {{-- Cancel --}}
                                                    <span class="badge text-danger bg-danger-subtle fs-12 px-2 py-1">Cancel</span>
                                                @elseif ($visit->status_docs == 1)
                                                    {{-- Accept --}}
                                                    <span class="badge text-success bg-success-subtle fs-12 px-2 py-1">Done Visit</span>
                                                @else
                                                    {{-- Pending --}}
                                                    <span class="badge text-warning bg-warning-subtle fs-12 px-2 py-1">Pending</span>
                                                @endif
                                            </td>
                                            <td>
                                                <div class="btn-group mb-1 me-1">

                                                    {{-- Edit Btn --}}
                                                    <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#resetPasswordModal"><iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon></button>

                                                    {{-- Delete Btn --}}
                                                    <input type="hidden" class="propertyId" value="{{ $visit->id }}">
                                                    <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="{{ $visit->first_name . ' ' . $visit->last_name }}"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                                    {{-- Download Btn --}}
                                                    <button id="dropdown" type="button" class="btn btn-xs btn-primary text-light dropdown-toggle fw-medium" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Download
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown">
                                                        <li>
                                                            <form action="{{ route('visit.pdf.english.post') }}" method="POST">
                                                                @csrf
                                                                {{-- {{ dd($visit->phone_number) }} --}}
                                                                <input type="hidden" name="email" value="{{ $visit->email }}">
                                                                <input type="hidden" name="phone_number" value="{{ $visit->phone_number }}">
                                                                <input type="hidden" name="first_name" value="{{ $visit->first_name }}">
                                                                <input type="hidden" name="last_name" value="{{ $visit->last_name }}">
                                                                <input type="hidden" name="visit_date" value="{{ $visit->visit_date }}">

                                                                <input type="hidden" name="internal_reference" value="{{ $property_list[$visit->id][0]->internal_reference }}">
                                                                @foreach ($property_list[$visit->id] ?? [] as $index => $properties)
                                                                    {{-- {{ dd($properties) }} --}}
                                                                    <input type="hidden" name="properties[{{ $index }}][name]" value="{{ $properties->property_name }}">
                                                                    <input type="hidden" name="properties[{{ $index }}][address]" value="{{ $properties->property_address }}">
                                                                    <input type="hidden" name="properties[{{ $index }}][selling_price_idr]" value="{{ $properties->selling_price_idr }}">
                                                                    <input type="hidden" name="properties[{{ $index }}][selling_price_usd]" value="{{ $properties->selling_price_usd }}">
                                                                @endforeach
                                                                <button type="submit" class="dropdown-item"><iconify-icon icon="material-symbols:download-rounded" class="fs-12 align-middle"></iconify-icon> Download Document</button>
                                                            </form>
                                                        </li>
                                                        {{-- <li><a class="dropdown-item disabled" href="javascript:void(0);" target="_blank"><iconify-icon icon="openmoji:flag-indonesia" class="fs-12 align-middle"></iconify-icon> Indonesia Version</a></li> --}}
                                                        {{-- <li><a class="dropdown-item disabled" href="javascript:void(0);" target="_blank"><iconify-icon icon="openmoji:flag-france" class="fs-12 align-middle"></iconify-icon> France Version</a></li> --}}
                                                    </ul>
                                                </div>

                                                <!-- Modal Edit-->
                                                <div class="modal modal-lg fade" id="resetPasswordModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <form action="{{ route('visit.update', $visit->id) }}" method="POST">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Edit Data Docs</h5>
                                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                </div>
                                                                <div class="modal-body">
                                                                    <div class="row">
                                                                        {{-- <input type="hidden" name="reference_code" value="{{ $profile->id }}"> --}}
                                                                        <x-form-input className="col-lg-6" type="text" name="customer_first_name" label="First Name" value="{{ $visit->first_name }}" />
                                                                        <x-form-input className="col-lg-6" type="text" name="customer_last_name" label="Last Name" value="{{ $visit->last_name }}" />
                                                                        <x-form-input className="col-lg-6" type="text" name="customer_email" label="Customer Email" value="{{ $visit->email }}" />
                                                                        <x-form-input className="col-lg-6" type="text" name="customer_phone" label="No Phone" value="{{ $visit->phone_number }}" />
                                                                        <x-form-input className="col-lg-6" type="date" name="date_visit" label="Date Visit" value="{{ $visit->visit_date }}" />
                                                                        <x-form-select className="col-lg-6" name="status_visit" label="Status Visit"
                                                                            :options="['Cancel', 'Done Visit', 'Pending Visit']" />
                                                                    </div>

                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                    <button type="submit" class="btn btn-primary">Edit Data</button>
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
                        text: "Delete Document Visit " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/visit/' + propertyId, {
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
