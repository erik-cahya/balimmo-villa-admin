@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

    <!-- ========== Page Title Start ========== -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Listing List</h4>
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
                                  <h4 class="card-title mb-2 ">Total Incomes</h4>
                                  <p class="text-muted fw-medium fs-22 mb-0">$12,7812.09</p>
                             </div>
                             <div>
                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                       <iconify-icon icon="solar:wallet-money-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                  </div>
                             </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                             <div>
                                  <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

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
                                  <h4 class="card-title mb-2 ">Total Villas</h4>
                                  <p class="text-muted fw-medium fs-22 mb-0">10 Unit</p>
                             </div>
                             <div>
                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                       <iconify-icon icon="solar:home-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                  </div>
                             </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                             <div>
                                  <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

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
                                  <h4 class="card-title mb-2 ">Unit Sold</h4>
                                  <p class="text-muted fw-medium fs-22 mb-0">10 Unit</p>
                             </div>
                             <div>
                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                       <iconify-icon icon="solar:dollar-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                  </div>
                             </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                             <div>
                                  <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

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
                                  <h4 class="card-title mb-2 ">Unit Rent</h4>
                                  <p class="text-muted fw-medium fs-22 mb-0">10 Unit</p>
                             </div>
                             <div>
                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                       <iconify-icon icon="solar:key-minimalistic-square-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                  </div>
                             </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                             <div>
                                  <a href="#!" class="link-primary fw-medium">See Details <i class='ri-arrow-right-line align-middle'></i></a>

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
                        <table class="table align-middle text-nowrap table-hover table-centered mb-0">
                             <thead class="bg-light-subtle">
                                  <tr>
                                       <th style="width: 20px;">
                                            <div class="form-check">
                                                 <input type="checkbox" class="form-check-input" id="customCheck1">
                                                 <label class="form-check-label" for="customCheck1"></label>
                                            </div>
                                       </th>
                                       <th>Properties Photo & Name</th>
                                       <th>Internal Reference</th>
                                       <th>Property Type</th>
                                       <th>Rent/Sale</th>
                                       <th>Bedrooms</th>
                                       <th>Location</th>
                                       <th>Price</th>
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
                                                      <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="" class="avatar-md rounded border border-light border-3" style="object-fit: cover">
                                                 </div>
                                                 <div>
                                                      <a href="#!" class="text-dark fw-medium fs-15">{{ $property->property_name }}</a>
                                                 </div>
                                            </div>
                                       </td>


                                       <td>{{ $property->internal_reference }}</td>
                                       <td class="text-capitalize">{{ $property->property_type }}</td>
                                       <td> <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">{{ $property->property_status }}</span></td>
                                       <td>
                                            <p class="mb-0"><iconify-icon icon="solar:bed-broken" class="align-middle fs-16"></iconify-icon> {{ $property->bedroom }}</p>
                                       </td>
                                       <td class="text-capitalize">{{ $property->region }}</td>
                                       <td>$8,930.00</td>
                                       <td>
                                            <div class="d-flex gap-2">
                                                 <a href="{{ route('properties.details', $property->property_slug) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>

                                                 {{-- Delete Button --}}
                                                 <input type="hidden" class="propertyId" value="{{ $property->id }}">
                                                 <button type="button" class="btn btn-soft-danger btn-sm deleteButton" data-nama="{{ $property->property_name }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
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
