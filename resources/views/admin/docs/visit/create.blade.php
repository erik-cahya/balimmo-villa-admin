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
        <form action="{{ route('visit.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-xl-8">
                    <div class="card">
                        <div class="card-header text-bg-primary d-flex justify-content-between align-items-center border-bottom" style="border-radius: 0px 0px 20px 0px">
                            <div>
                                <h4 class="card-title">Select Properties</h4>
                            </div>
                        </div>
                        <div class="card-body p-0">
                            <div class="table-responsive">
                                <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="propertiesTable">
                                    <thead class="bg-light-subtle">
                                        <tr>
                                            <th style="width: 20px;">
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="selectAll">
                                                    <label class="form-check-label" fid="selectAll"></label>
                                                </div>
                                            </th>
                                            <th>Properties Name</th>
                                            <th>Properties Price</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($data_property as $property)
                                            <tr>
                                                <td>
                                                    <div class="form-check">
                                                        <input type="checkbox" name="propertyId[]" class="form-check-input" id="{{ $property->propertyId }}" value="{{ $property->propertyId }}">
                                                        <label class="form-check-label" for="{{ $property->propertyId }}">&nbsp;</label>
                                                    </div>
                                                </td>
                                                <td class="fw-medium text-dark d-flex">
                                                    <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" class="avatar-sm rounded-circle me-2" alt="...">

                                                    <div class="d-flex flex-column">
                                                        {{ $property->property_name }}
                                                        <div class="d-flex">
                                                            <span class="fst-italic badge bg-dark text-light fs-11 px-3">{{ $property->property_code }}</span>
                                                        </div>
                                                        <span class="fst-italic fs-12">{{ Str::limit($property->property_address, 100) }}</span>
                                                    </div>

                                                </td>
                                                <td>
                                                    <div class="d-flex flex-column gap-1">
                                                        <span class="fst-italic fs-12">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                                        <span class="fst-italic fs-12">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                                    </div>
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

                <div class="col-xl-4">
                    <div class="card">
                        <div class="card-header text-bg-primary d-flex justify-content-between align-items-center border-bottom" style="border-radius: 0px 0px 20px 0px">
                            <div>
                                <h4 class="card-title">Select Clients</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <div class="col-lg-12 text-capitalize mb-3" id="group_dataClients">
                                <select class="form-control" id="dataClients" name="dataClients" data-choices data-choices-sorting-false data-toggle-target="{{ isset($toggle) ? $toggle : '' }}">
                                    <option value="" selected disabled>Choose Clients</option>
                                    @foreach ($data_client as $client)
                                        <option value="{{ $client['email'] }}||{{ $client['first_name'] }}||{{ $client['last_name'] }}||{{ $client['phone_number'] }}">
                                            {{ $client['first_name'] . ' ' . $client['last_name'] }}
                                        </option>
                                    @endforeach
                                </select>

                                @error('dataClient')
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
                        </div>
                    </div>
                    <div class="card">
                        <div class="card-header text-bg-primary d-flex justify-content-between align-items-center border-bottom" style="border-radius: 0px 0px 20px 0px">
                            <div>
                                <h4 class="card-title">Date Visit</h4>
                            </div>

                        </div>
                        <div class="card-body">
                            <x-form-input className="col-lg-12" type="text" name="date_visit" label="Date Visit" />
                        </div>
                    </div>
                    <button type="submit" class="btn btn-outline-primary">Create Document Visit</button>
                </div>

            </div>
        </form>
    </div>

    <div class="toast-container position-fixed end-0 top-0 p-3">
        <div id="liveToast2" class="toast text-bg-primary" role="alert" aria-live="assertive" aria-atomic="true">
            <div class="toast-header">
                <div class="auth-logo me-auto">
                    <img class="logo-dark" src="{{ asset('admin') }}/assets/images/logo-dark.png" alt="logo-dark" height="18" />
                    <img class="logo-light" src="{{ asset('admin') }}/assets/images/logo-light.png" alt="logo-light" height="18" />
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
            </div>
            <div class="toast-body">
                {{ $errors->first('propertiesNull') }}
            </div>
        </div>
    </div>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/flatpickr-min.js') }}"></script>

    @if ($errors->has('propertiesNull'))
        <script>
            window.addEventListener('DOMContentLoaded', (event) => {
                const toastLiveExample2 = document.getElementById('liveToast2');
                const toast = new bootstrap.Toast(toastLiveExample2);
                toast.show();
            });
        </script>
    @endif

    {{-- Flatpickr --}}
    <script>
        $("#date_visit").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>
    {{-- /* Flatpickr --}}

    {{-- Data Table --}}
    <script>
        $(document).ready(function() {
            $('#propertiesTable').DataTable();
            $('#clientTable').DataTable();
        });
    </script>
    {{-- /* Data Table --}}

    {{-- Checkbox check all --}}
    <script>
        $('#selectAll').on('change', function() {
            $('.form-check-input').prop('checked', this.checked);
        });
    </script>
    {{-- /* Checkbox check all --}}

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
