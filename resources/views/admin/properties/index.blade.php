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
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
@endpush
@section('content')
    <div class="container-fluid">

        <!-- ========== Page Title Start ========== -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <h4 class="fw-semibold mb-0">Listing List</h4>
                    <ol class="breadcrumb mb-0">
                        <li class="breadcrumb-item"><a href="javascript: void(0);">Properties</a></li>
                        <li class="breadcrumb-item active">Listing List</li>
                    </ol>
                </div>
            </div>
        </div>
        <!-- ========== Page Title End ========== -->
        <div class="row">
            <div class="col-xl-12">
                <div class="card">
                    <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                        <div>
                            <h4 class="card-title mb-0">All Properties List <span class="badge bg-danger ms-1">{{ $data_property->count() }} </span></h4>
                        </div>
                        <a href="{{ route('properties.create') }}" class="btn btn-success width-md">Add Villa</a>
                    </div>
                    <div class="table-responsive">
                        <table class="table-hover table-centered fs-13 mb-0 table text-nowrap align-middle" id="tableProperties">
                            <thead class="bg-light-subtle">
                                <tr>
                                    <th style="width: 20px;">
                                        <div class="form-check">
                                            <input type="checkbox" class="form-check-input" id="customCheck1">
                                            <label class="form-check-label" for="customCheck1"></label>
                                        </div>
                                    </th>
                                    <th>Properties Photo & Name</th>
                                    <th>Agent</th>
                                    <th>Mandates</th>                                    
                                    <th>Localization</th>
                                    <th>Bedroom</th>
                                    <th>Price</th>
                                    <th>Status</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($data_property as $property)
                                    <tr>
                                        <td>
                                            <div class="form-check">
                                                <input type="checkbox" class="form-check-input" id="customCheck2">
                                                <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                            </div>
                                        </td>

                                        <td>
                                            <a href="{{ route('properties.details', $property->property_slug) }}" class="d-flex align-items-center gap-2">
                                                <div>
                                                    <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="" class="avatar-md border-light border-3 rounded border" style="object-fit: cover">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <span class="text-dark fw-medium fs-15" style="text-overflow: ellipsis; max-width: 200px; overflow: hidden; white-space: nowrap">{{ $property->property_name }}</span>
                                                    <span class="text-gray-400 fst-italic">{{ $property->property_code }}</span>
                                                </div>
                                            </a>
                                        </td>
                                        <td>
                                            <span class="badge {{ $property->status === 0 ? 'bg-danger' : 'bg-dark' }} text-light fs-12 px-2 py-1">{{ $property->internal_reference }}</span>
                                        </td>
                                        @php
                                            $cleanType = str_replace('Mandate', '', $property->type_mandate);
                                        @endphp

                                        @if (str_contains($property->type_mandate, 'Booster') || str_contains($property->type_mandate, 'Essentials'))
                                            <td><span class="badge bg-primary-subtle text-primary fs-12 px-2 py-1">{{ trim($cleanType) }}</span></td>
                                        @endif
                                        
                                        <td class="text-capitalize">
                                            <span class="text-dark fw-medium fs-15">{{ $property->region }}</span>
                                        </td>
                                        <td>
                                            <span class="text-dark fw-medium fs-15">{{ $property->bedroom }} </span>
                                        </td>                                   
                                        <td>
                                            <div class="d-flex flex-column">
                                                <span class="text-dark fw-medium fs-15">IDR 2 500 000 000 </span>
                                                <span class="text-gray-400 fst-italic">USD 239 000</span>
                                            </div>
                                        </td>

                                        @php
                                            switch ($property->type_acceptance) {
                                                case 'accept':
                                                    $badgeClass = 'bg-success';
                                                    $popOverContent = 'Your property has been listed on the Balimmo Properties website.';
                                                    $popOverTitle = '👍 Great, your property has been successfully listed!';
                                                    break;
                                                case 'pending':
                                                    $badgeClass = 'bg-warning';
                                                    $popOverContent = 'We are checking your data, please wait or contact the Balimmo Properties admin.';
                                                    $popOverTitle = '👋 Hello, we are reviewing your property!';
                                                    break;
                                                case 'decline':
                                                    $badgeClass = 'bg-danger';
                                                    $popOverContent = 'Unfortunately, your property listing was declined. Please contact the Balimmo Properties admin for more details or to make corrections.';
                                                    $popOverTitle = '❌ Listing Declined';
                                                    break;
                                                default:
                                                    $badgeClass = 'bg-secondary';
                                                    $popOverContent = 'Status unknown. Please contact Balimmo Properties admin for clarification.';
                                                    $popOverTitle = 'ℹ️ Status Unknown';
                                                    break;
                                            }
                                        @endphp
                                        <td>
                                            <span class="badge {{ $badgeClass }} text-light fs-12 text-capitalize px-2 py-1" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="{{ $popOverContent }}" title="{{ $popOverTitle }}">
                                                {{ $property->type_acceptance }}
                                            </span>
                                        </td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('properties.edit', $property->property_slug) }}" class="btn btn-soft-warning btn-sm"><iconify-icon icon="tabler:edit" class="fs-18 align-middle"></iconify-icon></a>

                                                {{-- Delete Button --}}
                                                <input type="hidden" class="propertyId" value="{{ $property->id }}">
                                                <button type="button" class="btn btn-soft-danger btn-sm deleteButton" data-nama="{{ $property->property_name }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="fs-18 align-middle"></iconify-icon></button>
                                                {{-- /. Delete Button --}}
                                            </div>

                                            </form>
                                            {{-- End Delete Button --}}
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
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/dataTables.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cleave-phone.us.js') }}"></script>
    {{-- Data Table --}}
    <script>
        $(document).ready(function() {
            $('#tableProperties').DataTable();
        });
    </script>
    {{-- /* Data Table --}}
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
                            fetch('/properties/' + propertyId, {
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
