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

        <form action="{{ route('features.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col xl-12">
                    <div class="card">
                        <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center border-bottom" style="border-radius: 10px 10px 0px 0px">
                            <div>
                                <h4 class="card-title">Create Properties Feature</h4>
                            </div>
                        </div>

                        <div class="card-body p-0">
                            <div class="row mx-4 mt-4">
                                <x-form-input className="col-lg-4" type="text" name="name_category" label="Name" />
                                <x-form-select className="col-lg-4" name="feature_category" label="Feature Category"
                                    :options="['Indoor', 'Outdoor']" />
                            </div>
                        </div>

                        <div class="mx-4 mb-4 rounded">
                            <div class="row">
                                <div class="col-lg-2">
                                    <button type="submit" class="btn btn-outline-primary w-100">Create Feature List</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Latest Listing Properties</h4>
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
                                            <td>{{ $rgn->name }}</td>
                                            <td>
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
