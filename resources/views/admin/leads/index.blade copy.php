@extends('admin.layouts.master')
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
                                    <h5 class="text-dark fw-medium mb-0">{{ $data_customers->count() }} <span class="text-muted"> Customers</span></h5>
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
                <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                    <div>
                        <h4 class="card-title">All Customers List</h4>
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
                                    <th scope="col">Property Selected</th>
                                    <th scope="col">Localization</th>
                                    <th scope="col">Date</th>
                                    @role('Master')
                                    <th scope="col">Leads From</th>
                                    @endrole
                                    <th scope="col">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $authUser = Auth::user();
                                $referenceCode = $authUser->role === 'Master' ? null : $authUser->reference_code;
                                // $filteredLeads = $referenceCode ? $data_customers->where('agent_code', $referenceCode) : $data_customers;
                                $filteredLeads = $data_customers;

                                @endphp
                                @foreach ($filteredLeads as $customer)
                                @php

                                // dd($data_customers);
                                $referenceCode = $authUser->role === 'Master' ? null : $authUser->reference_code;
                                // Ambil properti yang sudah difilter
                                $filteredProperties = $referenceCode ? $matchProperties[$customer->id]->where('internal_reference', $referenceCode) : $matchProperties[$customer->id];
                                @endphp

                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>
                                        <div class="d-flex align-items-center gap-1">
                                            <img src="{{ asset('admin') }}/assets/images/users/dummy-avatar.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                            <div class="d-block">
                                                <h5 class="text-dark fw-medium mb-0">{{ $customer->cust_name }}</h5>
                                                <p class="fs-13 mb-0">{{ $customer->cust_email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        <p class="mb-0"><iconify-icon icon="mdi:phone" class="fs-16 align-middle"></iconify-icon> {{ $customer->cust_telp }}</p>

                                    </td>
                                    <td>
                                        <p class="mb-0"><iconify-icon icon="tdesign:money-filled" class="fs-16 align-middle"></iconify-icon> IDR {{ number_format($customer->cust_budget, 2, ',', '.') }}</p>
                                    </td>
                                    <td>
                                        @if (isset($customer->property_name) || isset($customer->require_bedroom))
                                        <div class="d-block">
                                            <p class="fs-13 text-dark fw-medium mb-0">{{ $customer->property_name }}</p>
                                            <p class="d-inline mx-1 mb-0">Require : <iconify-icon icon="solar:bed-broken" class="fs-16 align-middle"></iconify-icon> {{ $customer->require_bedroom }}</p>
                                        </div>
                                        @else
                                        <span class="badge bg-danger text-light fs-12 px-2 py-1">Property Not Specified</span>
                                        @endif
                                    </td>
                                    <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> {{ $customer->localization }}</td>
                                    <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse($customer->date)->format('d F, Y') }}</td>
                                    @role('Master')
                                    <td>
                                        <span class="badge bg-primary text-capitalize me-1">{{ $customer->agent_code }}</span>
                                    </td>
                                    @endrole
                                    <td>
                                        <div class="d-flex">
                                            @if ($matchProperties[$customer->id]->count() == 0)
                                            <span class="btn btn-sm btn-primary">No Match Properties</span>
                                            @else
                                            <button class="btn btn-sm btn-primary toggle-villas" type="button" data-bs-toggle="collapse" data-bs-target="#villasForCustomer{{ $customer->id }}" aria-expanded="false" aria-controls="flush-collapseOne">
                                                Show {{ $filteredProperties->count() }} Properties
                                            </button>
                                            @endif
                                            <div class="dropdown">
                                                <a href="#" class="dropdown-toggle btn btn-sm btn-outline-dark mx-2 rounded" data-bs-toggle="dropdown" aria-expanded="true">
                                                    More
                                                </a>
                                                <div class="dropdown-menu dropdown-menu-end" style="position: absolute; inset: 0px 0px auto auto; margin: 0px; transform: translate3d(0px, 33.3333px, 0px);" data-popper-placement="bottom-end">

                                                    @if ($matchProperties[$customer->id]->count() >= 1)
                                                    <form action="{{ route('leads.sendmail') }}" method="POST">
                                                        @csrf
                                                        @foreach ($filteredProperties as $properties)
                                                        {{-- {{ dd($properties) }} --}}
                                                        <input type="hidden" name="image_path[]" value="{{ $properties->featuredImage->image_path }}">
                                                        <input type="hidden" name="property_name[]" value="{{ $properties->property_name }}">
                                                        <input type="hidden" name="property_address[]" value="{{ $properties->property_address }}">
                                                        <input type="hidden" name="bedroom[]" value="{{ $properties->bedroom }}">
                                                        <input type="hidden" name="bathroom[]" value="{{ $properties->bathroom }}">
                                                        <input type="hidden" name="sub_region[]" value="{{ $properties->sub_region }}">
                                                        <input type="hidden" name="property_slug[]" value="{{ $properties->property_slug }}">
                                                        <input type="hidden" name="selling_price_idr[]" value="{{ number_format($properties->selling_price_idr, 2, ',', '.') }}">
                                                        <input type="hidden" name="selling_price_usd[]" value="{{ number_format($properties->selling_price_usd, 2, ',', '.') }}">
                                                        @endforeach
                                                        <input type="hidden" name="cust_email" value="{{ $customer->cust_email }}">
                                                        <button type="submit" class="dropdown-item pb-2 pt-2">Send Email To Customer</button>
                                                    </form>
                                                    @endif

                                                    <input type="hidden" class="propertyId" value="{{ $customer->id }}">
                                                    <a href="javascript:void(0);" class="dropdown-item deleteButton pb-2 pt-2" data-nama="{{ $customer->cust_name }}">Delete</a>
                                                </div>
                                            </div>
                                        </div>

                                    </td>
                                </tr>

                                <tr id="villasForCustomer{{ $customer->id }}" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                    <td colspan="8" class="accordion-body">
                                        <div class="row">
                                            <div class="col-12">
                                                <div class="page-title-box">
                                                    <h4 class="fw-semibold mx-4 mb-0">Properties Recomendation</h4>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            @foreach ($filteredProperties as $properties)
                                            {{-- {{ dd($filteredProperties) }} --}}
                                            {{-- {{ dd($properties->internal_reference) }} --}}
                                            <div class="col-md-6 col-xl-4">
                                                <div class="card bg-primary bg-gradient">
                                                    <div class="card-body">
                                                        <div class="row align-items-center justify-content-between">
                                                            <div class="col-xl-7 col-lg-6 col-md-6">
                                                                <h3 class="fw-bold fs-18 text-white">{{ $properties->property_name }}</h3>
                                                                <hr>
                                                                <div class="row">
                                                                    <div class="col-lg-6 col-lg-6 col-md-6 col-6">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="avatar-sm flex-shrink-0">
                                                                                <span class="avatar-title bg-success rounded bg-opacity-50 text-white">
                                                                                    <iconify-icon icon="solar:bed-broken" class="fs-16 align-middle"></iconify-icon>
                                                                                </span>
                                                                            </div>
                                                                            <div class="d-block">
                                                                                <h5 class="fw-medium mb-0 text-white">{{ $properties->bedroom }}</h5>
                                                                                <p class="text-white-50 mb-0">Bedroom</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-lg-6 col-lg-6 col-md-6 col-6">
                                                                        <div class="d-flex gap-2">
                                                                            <div class="avatar-sm flex-shrink-0">
                                                                                <span class="avatar-title bg-danger rounded bg-opacity-50 text-white">
                                                                                    <iconify-icon icon="solar:bed-broken" class="fs-16 align-middle"></iconify-icon>
                                                                                </span>
                                                                            </div>
                                                                            <div class="d-block">
                                                                                <h5 class="fw-medium mb-0 text-white">{{ $properties->bathroom }}</h5>
                                                                                <p class="text-white-50 mb-0">Bathrom</p>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <hr>
                                                                <h3 class="fw-normal fs-16 fst-italic text-white">IDR {{ number_format($properties->selling_price_idr, 2, ',', '.') }}</h3>
                                                                <h3 class="fw-normal fs-16 fst-italic text-white">{{ $properties->region }}</h3>
                                                                <h3 class="fw-normal fs-16 fst-italic text-white">{{ $properties->internal_reference }}</h3>

                                                            </div>
                                                            <div class="col-xl-5 col-lg-4 col-md-4">
                                                                <img src="{{ asset('admin') }}/assets/images/home.png" alt="" class="img-fluid">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                    </td>
                                </tr>
                                @endforeach

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
                    text: "Delete leads " + propertyName + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, delete it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Kirim DELETE request manual lewat JavaScript
                        fetch('/leads/' + propertyId, {
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
                                // $('#table-id').DataTable().ajax.reload();
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