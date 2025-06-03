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
                    <h4 class="fw-semibold mb-0">Create Document Visit</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Docs Visit</a></li>
                        <li class="breadcrumb-item active">Create Document Visit</li>
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
                                                <input type="search" class="form-control" placeholder="Search Customer" autocomplete="off" value="">
                                                <iconify-icon icon="solar:magnifer-broken" class="search-widget-icon"></iconify-icon>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="text-dark fw-medium mb-0"> <span class="text-muted"> Customers</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-md-end mt-md-0 mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-primary me-1"><i class="ri-search-line me-1"></i> Search</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Properties Listing</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="propertiesTable">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>ID Properties</th>
                                        <th>Properties Name</th>
                                        <th>Address</th>
                                        <th>Price IDR</th>
                                        <th>Price USD</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>
                                        <td><a href="javascript: void(0);" class="text-dark fw-medium">#TZ2540</a> </td>
                                        <td class="fw-medium text-dark"><img src="{{ asset('admin') }}/assets/images/users/avatar-2.jpg" class="avatar-sm rounded-circle me-2" alt="..."> Michael A. Miner</td>

                                        <td class="text-capitalize">
                                            <div class="d-flex flex-column">
                                                <a href="#!" class="text-dark fw-medium fs-14"><iconify-icon icon="pajamas:location" class="fs-18 align-middle"></iconify-icon> Badung, Jimbaran</a>
                                                <span class="fst-italic fs-12">Jl. Yoga Perkanthi, Jimbaran, Kec. Kuta Sel., Kabu...</span>
                                            </div>

                                        </td>
                                        <td> Mastercard </td>
                                        <td> <span class="badge bg-success-subtle text-success fs-12 px-2 py-1">Completed</span> </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                        <!-- end table-responsive -->
                    </div>
                </div>
            </div>

            <div class="col-xl-6">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h4 class="card-title">Clients</h4>
                        </div>

                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered table text-nowrap">
                                <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Budget</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Localization</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                        <td>1</td>
                                    </tr>

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
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#propertiesTable').DataTable();
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
