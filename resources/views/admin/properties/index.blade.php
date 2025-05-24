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
                              <p class="mb-2 fs-15 fw-medium">Earn of the Month</p>
                              <h3 class="text-dark fw-bold d-flex align-items-center gap-2 mb-0">$3548.09</h3>
                              </div>
                              <div>
                              <div class="avatar-md bg-primary bg-opacity-10 rounded">
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
                              <p class="mb-2 fs-15 fw-medium d-flex align-items-center gap-2">Earn Growth <span class="badge text-success bg-success-subtle fs-11"><i class="ri-arrow-up-line"></i>44%</span></p>
                              <h3 class="text-dark fw-bold d-flex align-items-center gap-2 mb-0">$67435.00</h3>
                              </div>
                              <div>
                              <div class="avatar-md bg-success bg-opacity-10 rounded">
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
                              <p class="mb-2 fs-15 fw-medium">Conversation Rate</p>
                              <h3 class="text-dark fw-bold d-flex align-items-center gap-2 mb-0">78.8%</h3>
                              </div>
                              <div>
                              <div class="avatar-md bg-warning bg-opacity-10 rounded">
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
                              <p class="mb-2 fs-15 fw-medium">Gross Profit Margin</p>
                              <h3 class="text-dark fw-bold d-flex align-items-center gap-2 mb-0">34.00%</h3>
                              </div>
                              <div>
                              <div class="avatar-md bg-info bg-opacity-10 rounded">
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
                        <table class="table align-middle text-nowrap table-hover table-centered mb-0 fs-13">
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
                                                      <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="" class="avatar-md rounded border border-light border-3" style="object-fit: cover">
                                                 </div>
                                                 <div class="d-flex flex-column">
                                                      <a href="#!" class="text-dark fw-medium fs-15">{{ $property->property_name }}</a>
                                                      <span class="fst-italic">{{ $property->property_code }}</span>
                                                 </div>
                                            </div>
                                       </td>
                                       <td><span class="badge bg-dark text-light py-1 px-2 fs-12">{{ $property->internal_reference }}</span></td>
                                       <td><span class="badge bg-primary-subtle text-primary py-1 px-2 fs-12">{{ $property->type_mandate }}</span></td>
                                       <td>
                                             <p class="d-flex align-items-center gap-2 mb-1"><iconify-icon icon="solar:bed-broken" class="fs-18 text-primary"></iconify-icon>{{ $property->bedroom }} Bedroom</p>
                                             <p class="d-flex align-items-center gap-2 mb-1"><iconify-icon icon="cil:bathroom" class="fs-18 text-primary"></iconify-icon>{{ $property->bathroom }} Bathroom</p>
                                       </td>
                                       <td class="text-capitalize">{{ $property->property_address }}</td>

                                       <td><span class="badge
                                             {{ $property->type_acceptance == 'pending' ? 'bg-warning' :
                                             ($property->type_acceptance == 'accept' ? 'bg-success' : 'bg-danger')  }}
                                        text-light py-1 px-2 fs-12 text-capitalize">{{ $property->type_acceptance }}</span></td>

                                       <td>
                                            <div class="d-flex gap-2">
                                                 <a href="{{ route('properties.details', $property->property_slug) }}" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                 <a href="{{ route('properties.edit', $property->property_slug) }}" class="btn btn-soft-warning btn-sm"><iconify-icon icon="tabler:edit" class="align-middle fs-18"></iconify-icon></a>

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
