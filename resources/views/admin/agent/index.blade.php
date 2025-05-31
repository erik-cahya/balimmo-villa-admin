@extends('admin.layouts.master')
@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Agent List</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Agents</a></li>
                        <li class="breadcrumb-item active">Agent List</li>
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
                                                <input type="text" class="form-control" id="search_props" placeholder="Search Agent" autocomplete="off">
                                                <iconify-icon icon="solar:magnifer-broken" class="search-widget-icon"></iconify-icon>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="col-lg-4">
                                        <h5 class="text-dark fw-medium mb-0">{{ $data_agent->count() }} <span class="text-muted"> Agent</span></h5>
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="text-md-end mt-md-0 mt-3">
                                    <button type="button" class="btn btn-sm btn-outline-dark me-1 rounded" data-bs-toggle="collapse" data-bs-target="#addNewAgent" aria-expanded="false" aria-controls="addNewAgent"><i class="ri-add-line me-1"></i> Add New Agent</button>
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
                            <h5 class="card-title">Add Data Agent</h5>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <x-form-input className="col-lg-4" type="text" name="name" label="Agent Name" />
                                <x-form-input className="col-lg-4" type="text" name="initial_name" label="Intial Name" />
                                <x-form-input className="col-lg-4" type="email" name="email" label="Email Agent" />

                                <x-form-input className="col-lg-4" type="number" name="phone_number" label="Phone Number" />
                                <x-form-select className="col-lg-4" name="role" label="User Role" :options="['Agent', 'Master']" />
                                <x-form-input className="col-lg-4" type="password" name="password" label="Password Login" />

                            </div>
                            <div class="mb-3 rounded">
                                <div class="row justify-content-end g-2">
                                    <div class="col-lg-2">
                                        <button type="submit" class="btn btn-outline-primary w-100">Add Agent</button>
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
                            <h4 class="card-title">All Agent List</h4>
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

                                        <th>Agent Name</th>
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
                                    @include('admin.agent.partials.data-agent', ['data_agent' => $data_agent])
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

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
                        text: "Disabled agent " + propertyName + "?",
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
