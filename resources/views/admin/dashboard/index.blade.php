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
                    <h4 class="fw-semibold mb-0">Analytics</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                        <li class="breadcrumb-item active">Analytics</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ========== Page Title End ========== -->

        <!-- Start here.... -->
        <div class="row d-flex align-items-center">
            <div class="{{ Auth::user()->role === 'Master' ? 'col-md-6 col-xl-4' : 'col-md-6 col-xl-6' }}">
                <div class="card">
                    <div class="card-body pb-0">
                        <div class="d-flex align-items-center justify-content-between mb-2">
                            <div>
                                <p class="fs-15 fw-medium mb-2">Total Properties</p>
                                <h3 class="text-dark fw-bold d-flex align-items-center mb-0 gap-2">{{ $data_properties->count() }} Property</h3>
                            </div>
                            <div>
                                <div class="avatar-md bg-success-subtle rounded">
                                    <iconify-icon icon="solar:calendar-date-broken" class="fs-32 text-success avatar-title"></iconify-icon>
                                </div>
                            </div>

                        </div>
                        <div class="d-flex gap-3">
                            <p><i class="ri-circle-fill text-success"></i> {{ $data_properties->where('type_acceptance', 'accept')->count() }} Accept</p>
                            <p><i class="ri-circle-fill text-warning"></i> {{ $data_properties->where('type_acceptance', 'pending')->count() }} Pending</p>
                            <p><i class="ri-circle-fill text-danger"></i> {{ $data_properties->where('type_acceptance', 'decline')->count() }} Decline</p>
                        </div>
                    </div>
                </div>
            </div>
            @if (Auth::user()->role === 'Master')
                <div class="{{ Auth::user()->role === 'Master' ? 'col-md-6 col-xl-4' : 'col-md-6 col-xl-6' }}">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-center justify-content-between">
                                <div>
                                    <p class="fs-15 fw-medium mb-2">Total Agents</p>
                                    <h3 class="text-dark fw-bold d-flex align-items-center mb-0 gap-2">{{ $data_agent->count() }} Agent</h3>
                                </div>
                                <div>
                                    <div class="avatar-md bg-success-subtle rounded">
                                        <iconify-icon icon="solar:calendar-date-broken" class="fs-32 text-success avatar-title"></iconify-icon>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
            <div class="{{ Auth::user()->role === 'Master' ? 'col-md-6 col-xl-4' : 'col-md-6 col-xl-6' }}">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="fs-15 fw-medium mb-2">Total Leads/Customers</p>
                                <h3 class="text-dark fw-bold d-flex align-items-center mb-0 gap-2">{{ $data_leads->count() }} Lead</h3>
                            </div>
                            <div>
                                <div class="avatar-md bg-success-subtle rounded">
                                    <iconify-icon icon="solar:calendar-date-broken" class="fs-32 text-success avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div> <!-- end row -->

        <div class="row">
            <div class="{{ Auth::user()->role === 'Master' ? 'col-xl-9' : 'col-xl-12' }}">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center">
                        <div>
                            <h4 class="card-title">Latest Listing Properties</h4>
                        </div>
                    </div>
                    <div class="card-body p-0">
                        <div class="table-responsive">
                            <table class="table-hover table-centered mb-0 table text-nowrap align-middle" id="myTable">
                                <thead class="bg-light-subtle">
                                    <tr>
                                        <th style="width: 20px;">
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck1">
                                                <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                        </th>
                                        <th>ID Properties</th>
                                        <th>Agent Name</th>
                                        <th>Property Name</th>
                                        <th>Location</th>
                                        <th>Status Listing</th>
                                        <th>Listing Date</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($data_properties as $property)
                                        <tr>
                                            <td>
                                                <div class="form-check">
                                                    <input type="checkbox" class="form-check-input" id="customCheck2">
                                                    <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                </div>
                                            </td>
                                            <td><a href="javascript: void(0);" class="text-dark fw-medium">#{{ $property->property_code }}</a> </td>
                                            <td>
                                                <div class="d-flex align-items-center">
                                                    <div>
                                                        <img src="{{ asset('admin') }}{{ $property->profile == null ? '/assets/images/users/dummy-avatar.jpg' : '/profile-image/' . $property->reference_code . '/' . $property->profile }}" class="avatar-sm rounded-circle me-2" alt="profile picture" style="width: 3rem; height: 3rem; object-fit:cover; border-radius: 10px">

                                                    </div>
                                                    <div class="d-flex flex-column">
                                                        <a href="#!" class="text-dark fw-medium fs-15"> {{ $property->name }}</a>
                                                        <span class="fst-italic"> {{ $property->reference_code }}</span>
                                                    </div>
                                                </div>

                                            </td>
                                            <td>{{ $property->property_name }}</td>
                                            <td>{{ $property->region }}</td>
                                            @php
                                                switch ($property->type_acceptance) {
                                                    case 'accept':
                                                        $badgeClass = 'bg-success-subtle text-success';
                                                        $popOverContent = 'Your property has been listed on the Balimmo Properties website.';
                                                        $popOverTitle = '👍 Great, your property has been successfully listed!';
                                                        break;
                                                    case 'pending':
                                                        $badgeClass = 'bg-warning-subtle text-warning';
                                                        $popOverContent = 'We are checking your data, please wait or contact the Balimmo Properties admin.';
                                                        $popOverTitle = '👋 Hello, we are reviewing your property!';
                                                        break;
                                                    case 'decline':
                                                        $badgeClass = 'bg-danger-subtle text-danger';
                                                        $popOverContent = 'Unfortunately, your property listing was declined. Please contact the Balimmo Properties admin for more details or to make corrections.';
                                                        $popOverTitle = '❌ Listing Declined';
                                                        break;
                                                    default:
                                                        $badgeClass = 'bg-secondary-subtle text-muted';
                                                        $popOverContent = 'Status unknown. Please contact Balimmo Properties admin for clarification.';
                                                        $popOverTitle = 'ℹ️ Status Unknown';
                                                        break;
                                                }
                                            @endphp
                                            <td>
                                                <span class="badge {{ $badgeClass }} fs-12 text-capitalize px-2 py-1" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="{{ $popOverContent }}" title="{{ $popOverTitle }}">
                                                    {{ $property->type_acceptance }}
                                                </span>
                                            </td>
                                            <td>
                                                {{ Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $property->created_at)->locale('en')->isoFormat('dddd, DD MMMM YYYY') }}
                                            </td>
                                            <td>
                                                <div class="d-flex gap-2">
                                                    <a href="{{ route('properties.details', $property->property_slug) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="fs-18 align-middle"></iconify-icon></a>
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

            @if (Auth::user()->role === 'Master')
                <div class="col-xl-3">
                    <div class="card">
                        <div class="card-header d-flex justify-content-between align-items-center border-0">
                            <div>
                                <h4 class="card-title mb-1">Recent Join Agent</h4>
                                <p class="fs-13 mb-0">{{ $data_agent->count() }} Agent Join</p>
                            </div>
                        </div>
                        <div class="card-body pt-2">

                            @foreach ($data_agent->take(4) as $agent)
                                <div class="d-flex align-items-center justify-content-between border-bottom mt-2 flex-wrap gap-2 pb-2">
                                    <div class="d-flex align-items-center gap-2">
                                        <div class="avatar">
                                            <img src="{{ asset('admin') }}{{ $agent->profile == null ? '/assets/images/users/default.jpg' : '/profile-image/' . $agent->reference_code . '/' . $agent->profile }}" alt="avatar-3" class="img-fluid rounded-circle" style="width: 3rem; height: 3rem; object-fit:cover; border-radius: 10px">
                                        </div>
                                        <div class="d-block">
                                            <span class="text-dark">
                                                <a href="#!" class="text-dark fw-medium fs-15">{{ $agent->name }}</a>
                                            </span>
                                            <p class="fs-13 text-muted mb-0">{{ $agent->email }}</p>
                                        </div>
                                    </div>
                                    <div>
                                        <p class="text-muted fw-medium mb-0">
                                            {{ Illuminate\Support\Carbon::createFromFormat('Y-m-d H:i:s', $agent->created_at)->locale('en')->isoFormat('DD MMMM YYYY') }}
                                        </p>
                                    </div>
                                </div>
                            @endforeach

                        </div>
                        <div class="card-footer border-top">
                            <a href="{{ route('agent.index') }}" class="btn btn-primary w-100">View All</a>
                        </div>
                    </div>
                </div>
            @endif

        </div>

    </div>
@endsection

@push('scripts')
    <!-- Vector Map Js -->
    {{-- <script src="{{ asset('admin') }}/assets/vendor/jsvectormap/js/jsvectormap.min.js"></script> --}}
    {{-- <script src="{{ asset('admin') }}/assets/vendor/jsvectormap/maps/world-merc.js"></script> --}}
    {{-- <script src="{{ asset('admin') }}/assets/vendor/jsvectormap/maps/world.js"></script> --}}

    <!-- Dashboard Js -->
    {{-- <script src="{{ asset('admin') }}/assets/js/pages/dashboard-analytics.js"></script> --}}

    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#myTable').DataTable();
        });
    </script>
@endpush
