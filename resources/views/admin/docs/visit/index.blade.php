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
                    <h4 class="fw-semibold mb-0">Customers List</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                        <li class="breadcrumb-item active">Customers List</li>
                    </ol>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h4 class="card-title">All Customers List</h4>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered table text-nowrap" id="propertiesTable">
                                <thead class="table-light">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>No</th>
                                        <th>Customer Name</th>
                                        <th>Property Name</th>
                                        <th>Created</th>
                                        <th>Date Visit</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($visit_docs as $visit)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
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
                                                        <span class="badge bg-dark text-light fs-10 px-2 py-1"><iconify-icon icon="f7:house-fill" class="fs-10 align-middle"></iconify-icon> {{ $properties->property_name }}</span>
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
                                                <div class="btn-group mb-1 me-1">
                                                    <button type="button" class="btn btn-sm btn-warning"><iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon></button>
                                                    <button type="button" class="btn btn-sm btn-danger"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                                    <button id="dropdown" type="button" class="btn btn-sm btn-primary text-light dropdown-toggle fw-medium" data-bs-toggle="dropdown" aria-expanded="false">
                                                        Download
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdown">
                                                        {{-- <li><a class="dropdown-item" href="{{ route('visit.pdf.english') }}" target="_blank"><iconify-icon icon="twemoji:flag-liberia" class="fs-12 align-middle"></iconify-icon> English Version</a></li> --}}
                                                        <li>
                                                            <form action="{{ route('visit.pdf.english.post') }}" method="POST">
                                                                @csrf
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
                                                                <button type="submit" class="dropdown-item" target="_blank"><iconify-icon icon="twemoji:flag-liberia" class="fs-12 align-middle"></iconify-icon> English Version</button>
                                                            </form>
                                                        </li>
                                                        <li><a class="dropdown-item disabled" href="javascript:void(0);" target="_blank"><iconify-icon icon="openmoji:flag-indonesia" class="fs-12 align-middle"></iconify-icon> Indonesia Version</a></li>
                                                        <li><a class="dropdown-item disabled" href="javascript:void(0);" target="_blank"><iconify-icon icon="openmoji:flag-france" class="fs-12 align-middle"></iconify-icon> France Version</a></li>
                                                    </ul>
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
        <div class="row">

            <div class="accordion-item">

            </div>

        </div>

    </div>

    <script>
        // Script untuk animasi tombol toggle
        document.querySelectorAll('.toggle-villas').forEach(button => {
            button.addEventListener('click', function() {
                const icon = this.querySelector('i');
                if (icon) {
                    icon.classList.toggle('ri-arrow-down-s-line');
                    icon.classList.toggle('ri-arrow-up-s-line');
                } else {
                    // Jika tidak ada icon, ubah teks tombol
                    if (this.textContent.includes('Show')) {
                        this.textContent = this.textContent.replace('Show', 'Hide');
                    } else {
                        this.textContent = this.textContent.replace('Hide', 'Show');
                    }
                }
            });
        });
    </script>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#propertiesTable').DataTable({
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

                    Swal.fire({
                        title: 'Are you sure?',
                        text: "Delete agent " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/agent/' + propertyId, {
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

                                    // Optional: reload table / halaman
                                    setTimeout(() => {
                                        location.reload();
                                    }, 1500);
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
