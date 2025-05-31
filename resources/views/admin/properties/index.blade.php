@extends('admin.layouts.master')
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
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="fs-15 fw-medium mb-2">Earn of the Month</p>
                                <h3 class="text-dark fw-bold d-flex align-items-center mb-0 gap-2">$3548.09</h3>
                            </div>
                            <div>
                                <div class="avatar-md bg-primary rounded bg-opacity-10">
                                    <iconify-icon icon="solar:calendar-date-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="fs-15 fw-medium d-flex align-items-center mb-2 gap-2">Earn Growth <span class="badge text-success bg-success-subtle fs-11"><i class="ri-arrow-up-line"></i>44%</span></p>
                                <h3 class="text-dark fw-bold d-flex align-items-center mb-0 gap-2">$67435.00</h3>
                            </div>
                            <div>
                                <div class="avatar-md bg-success rounded bg-opacity-10">
                                    <iconify-icon icon="solar:graph-new-broken" class="fs-32 text-success avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="fs-15 fw-medium mb-2">Conversation Rate</p>
                                <h3 class="text-dark fw-bold d-flex align-items-center mb-0 gap-2">78.8%</h3>
                            </div>
                            <div>
                                <div class="avatar-md bg-warning rounded bg-opacity-10">
                                    <iconify-icon icon="solar:user-plus-broken" class="fs-32 text-warning avatar-title"></iconify-icon>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-xl-3">
                <div class="card">
                    <div class="card-body">
                        <div class="d-flex align-items-center justify-content-between">
                            <div>
                                <p class="fs-15 fw-medium mb-2">Gross Profit Margin</p>
                                <h3 class="text-dark fw-bold d-flex align-items-center mb-0 gap-2">34.00%</h3>
                            </div>
                            <div>
                                <div class="avatar-md bg-info rounded bg-opacity-10">
                                    <iconify-icon icon="solar:chart-2-broken" class="fs-32 text-info avatar-title"></iconify-icon>
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
                            <h4 class="card-title mb-0">All Properties List <span class="badge bg-danger ms-1">10 </span></h4>
                        </div>
                    </div>
                    <div class="table-responsive">
                        <table class="table-hover table-centered fs-13 mb-0 table text-nowrap align-middle">
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
                                    <th>Bedrooms</th>
                                    <th>Location</th>
                                    <th>Status Listing</th>
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
                                            <div class="d-flex align-items-center gap-2">
                                                <div>
                                                    <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="" class="avatar-md border-light border-3 rounded border" style="object-fit: cover">
                                                </div>
                                                <div class="d-flex flex-column">
                                                    <a href="#!" class="text-dark fw-medium fs-15">{{ $property->property_name }}</a>
                                                    <span class="fst-italic">{{ $property->property_code }}</span>
                                                </div>
                                            </div>
                                        </td>
                                        <td><span class="badge bg-dark text-light fs-12 px-2 py-1">{{ $property->internal_reference }}</span></td>
                                        <td><span class="badge bg-primary-subtle text-primary fs-12 px-2 py-1">{{ $property->type_mandate }}</span></td>
                                        <td>
                                            <p class="d-flex align-items-center mb-1 gap-2"><iconify-icon icon="solar:bed-broken" class="fs-18 text-primary"></iconify-icon>{{ $property->bedroom }} Bedroom</p>
                                            <p class="d-flex align-items-center mb-1 gap-2"><iconify-icon icon="cil:bathroom" class="fs-18 text-primary"></iconify-icon>{{ $property->bathroom }} Bathroom</p>
                                        </td>
                                        <td class="text-capitalize">{{ $property->property_address }}</td>

                                        <td><span class="badge {{ $property->type_acceptance == 'pending' ? 'bg-warning' : ($property->type_acceptance == 'accept' ? 'bg-success' : 'bg-danger') }} text-light fs-12 text-capitalize px-2 py-1">{{ $property->type_acceptance }}</span></td>

                                        <td>
                                            <div class="d-flex gap-2">
                                                <a href="{{ route('properties.details', $property->property_slug) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="fs-18 align-middle"></iconify-icon></a>
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
