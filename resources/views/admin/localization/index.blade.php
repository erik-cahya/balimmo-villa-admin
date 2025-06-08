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
        <!-- ========== Page Title Start ========== -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Feature List Properties</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                        <li class="breadcrumb-item active">Orders</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ========== Page Title End ========== -->

        <div class="row ">

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center border-bottom" style="border-radius: 10px 10px 0px 0px">
                        <div>
                            <h4 class="card-title">Create Region Data</h4>
                        </div>
                    </div>
                    <form action="{{ route('localization.addRegion') }}" method="POST">
                        @csrf
                        <div class="card-body p-0">
                            <div class="row mx-4 mt-4">
                                <x-form-input className="col-lg-12" type="text" name="region" label="Region Name" />
                            </div>
                        </div>

                        <div class="mx-4 mb-4 rounded">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-outline-primary w-100">Create New Region</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center border-bottom" style="border-radius: 10px 10px 0px 0px">
                        <div>
                            <h4 class="card-title">Create Sub Region</h4>
                        </div>
                    </div>
                    <form action="{{ route('localization.store') }}" method="POST">
                        @csrf
                        <div class="card-body p-0">
                            <div class="row mx-4 mt-4">
                                <div class="col-lg-6 text-capitalize mb-3" id="group_region">
                                    <label for="region" class="form-label">Select Region</label>

                                    <select class="form-control" id="region" name="region" data-choices data-choices-sorting-false data-toggle-target="region">
                                        <option value="" selected disabled>Choose Region</option>
                                        @foreach ($region as $rgn)
                                            <option value="{{ $rgn->id }}">
                                                {{ $rgn->name }}
                                            </option>
                                        @endforeach
                                    </select>

                                    @error('region')
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
                                <x-form-input className="col-lg-6" type="text" name="sub_region" label="Sub Region" />
                            </div>
                        </div>

                        <div class="mx-4 mb-4 rounded">
                            <div class="row">
                                <div class="col-lg-12">
                                    <button type="submit" class="btn btn-outline-primary w-100">Create New Sub Region</button>
                                </div>
                            </div>
                        </div>
                    </form>

                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Region & Sub Region List</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered align-center mb-0 table" id="myTable">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th>Region</th>
                                        <th>Sub Region</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($region as $rgn)
                                        <tr>
                                            <td class="text-dark fw-medium fs-15">{{ $rgn->name }}</td>
                                            <td class="fs-15">
                                                @foreach ($subRegion->where('region_id', $rgn->id) as $subRgn)
                                                    <span class="badge bg-primary me-1">{{ $subRgn->name }}</span>
                                                @endforeach
                                            </td>
                                        </tr>
                                    @endforeach

                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
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
                        text: "Delete property " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, delete it!'
                    }).then((result) => {
                        if (result.isConfirmed) {
                            // Kirim DELETE request manual lewat JavaScript
                            fetch('/properties/features/' + propertyId, {
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
