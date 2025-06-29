@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Notary List</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Notary</a></li>
                        <li class="breadcrumb-item active">Notary List</li>
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
                                                <input type="text" class="form-control" id="search_props" placeholder="Search Notary" autocomplete="off">
                                                <iconify-icon icon="solar:magnifer-broken" class="search-widget-icon"></iconify-icon>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="text-dark fw-medium mb-0">{{ $data_notary->count() }} <span class="text-muted"> Notary</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-md-end mt-md-0 mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-dark me-1 rounded" data-bs-toggle="collapse" data-bs-target="#addNewAgent" aria-expanded="false" aria-controls="addNewAgent"><i class="ri-add-line me-1"></i> Add New Notary</button>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>

            <form action="{{ route('agent.store') }}" method="POST">
                @csrf
                <div class="{{ $errors->any() ? 'show' : '' }} collapse" id="addNewAgent">
                    <div class="card">
                        <div class="card-header text-bg-dark" style="border-radius: 20px 0px 20px 0px">
                            <h5 class="card-title">Add Data Notary</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <x-form-input className="col-lg-4" type="text" name="name" label="Notary Name" />
                                <x-form-input className="col-lg-4" type="email" name="email" label="Email Notary" />

                                <x-form-input className="col-lg-4" type="number" name="phone_number" label="Phone Number" />

                                <div class="col-md-6" id="group_role">
                                    <label for="role" class="form-label">User Role</label>
                                    <div class="input-group">
                                        <input type="text" class="form-control" placeholder="Initial Name" value="Notary" disabled>
                                        <input type="hidden" name="role" value="Notary">
                                    </div>
                                </div>
                                {{-- <x-form-select className="col-lg-6" name="role" label="User Role" :options="['Agent', 'Master', 'Notary']" /> --}}

                                <div class="col-md-6" id="group_month_rented_per_year">
                                    <label for="month_rented_per_year" class="form-label">Reference ID</label>
                                    <div class="input-group">
                                        <span class="input-group-text" id="prefix-text">BPN</span>
                                        <input type="text" name="initial_name" class="form-control @error('initial_name') validation-form @enderror" placeholder="Initial Name" value="{{ old('initial_name') }}">
                                        <input type="text" name="number_id" maxlength="4" class="form-control @error('number_id') validation-form @enderror" min="1" max="9999" placeholder="Number ID" pattern="[0-9]{4}" value="{{ old('number_id') }}">
                                    </div>
                                    @error('initial_name')
                                        <div class="alert alert-danger p-1" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                    @error('number_id')
                                        <div class="alert alert-danger p-1" role="alert">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>

                                <x-form-input className="col-lg-6 mt-3" type="password" name="password" label="Password Login" />
                                <x-form-input className="col-lg-6 mt-3" type="password" name="password_confirmation" label="Confirm Password" />

                            </div>
                            <div class="mb-3 rounded">
                                <div class="row justify-content-end g-2">
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-outline-primary w-100">Add Notary</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </form>

        </div>

        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h4 class="card-title">All Notary List</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered mb-0 table text-nowrap align-middle">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>Reference ID</th>

                                        <th>Notary Name</th>
                                        <th>Email</th>
                                        <th>Contact</th>
                                        <th>Listing Property</th>
                                        <th>Roles</th>
                                        <th>Status</th>
                                        <th>Registered</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody id="property-list">
                                    @include('admin.notary.partials.data-notary')
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
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const roleSelect = document.getElementById('role');
            const prefixText = document.getElementById('prefix-text');
            roleSelect.addEventListener('change', function() {
                if (roleSelect.value === 'Agent') {
                    prefixText.textContent = 'BPA';
                } else if (roleSelect.value === 'Notary') {
                    prefixText.textContent = 'BPN'
                } else {
                    prefixText.textContent = 'BPM';
                }
            });
        });
    </script>

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
                    url: '{{ route('agent.search') }}',
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
                        text: "Disabled notary " + propertyName + "?",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: 'Yes, disabled it!'
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
