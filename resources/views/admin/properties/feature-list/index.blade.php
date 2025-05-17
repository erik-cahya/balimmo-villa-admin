@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Feature List Properties</h4>
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
                                                    :options="['Indoor', 'Outdoor']"
                                            />
                                        </div>
                                    </div>

                                    <div class="mx-4 mb-4 rounded ">
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
                         <div class="col-xl-6   ">
                              <div class="card">
                                   <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center border-bottom" style="border-radius: 10px 10px 0px 0px">
                                        <div>
                                             <h4 class="card-title">Indoor</h4>
                                        </div>
                                   </div>

                                   <div class="card-body p-0">
                                        <div class="table-responsive">
                                             <table class="table align-middle text-nowrap table-hover table-centered mb-0">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            <th>Feature Name</th>
                                                            <th>Slug</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($feature_indoor as $indoor)
                                                       <tr>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div>
                                                                           <a href="#!" class="text-dark fw-medium fs-15">{{ $indoor->name }}</a>
                                                                      </div>
                                                                 </div>

                                                            </td>
                                                            <td>{{ $indoor->slug }}</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">
                                                                      <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                                      {{-- Delete Button --}}
                                                                        <input type="hidden" class="propertyId" value="{{ $indoor->id }}">
                                                                        <button type="button" class="btn btn-soft-danger btn-sm deleteButton" data-nama="{{ $indoor->name }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                                    {{-- /. Delete Button --}}
                                                                 </div>
                                                            </td>
                                                       </tr>
                                                    @endforeach

                                                  </tbody>
                                             </table>
                                        </div> <!-- end table-responsive -->
                                   </div>
                              </div>
                         </div>
                         <div class="col-xl-6   ">
                              <div class="card">
                                   <div class="card-header bg-dark text-light d-flex justify-content-between align-items-center border-bottom" style="border-radius: 10px 10px 0px 0px">
                                        <div>
                                             <h4 class="card-title">Outdoor</h4>
                                        </div>
                                   </div>

                                   <div class="card-body p-0">
                                        <div class="table-responsive">
                                             <table class="table align-middle text-nowrap table-hover table-centered mb-0">
                                                  <thead class="bg-light-subtle">
                                                       <tr>
                                                            <th>Feature Name</th>
                                                            <th>Slug</th>
                                                            <th>Action</th>
                                                       </tr>
                                                  </thead>
                                                  <tbody>
                                                    @foreach ($feature_outdoor as $outdoor)

                                                       <tr>
                                                            <td>
                                                                 <div class="d-flex align-items-center gap-2">
                                                                      <div>
                                                                           <a href="#!" class="text-dark fw-medium fs-15">{{ $outdoor->name }}</a>
                                                                      </div>
                                                                 </div>

                                                            </td>
                                                            <td>{{ $outdoor->slug }}</td>
                                                            <td>
                                                                 <div class="d-flex gap-2">

                                                                    <!-- Button trigger modal -->
                                                                    <button type="button" class="btn btn-soft-primary btn-sm" data-bs-toggle="modal" data-bs-target="#modalFeature_{{ $outdoor->slug }}">
                                                                        <iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon>
                                                                    </button>

                                                                    <!-- Modal -->
                                                                    <form action="{{ route('features.update', $outdoor->id) }}" method="POST">
                                                                        @csrf
                                                                        @method('PATCH')
                                                                        <div class="modal fade" id="modalFeature_{{ $outdoor->slug }}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                                            <div class="modal-dialog modal-dialog-centered">
                                                                                <div class="modal-content">
                                                                                    <div class="modal-header">
                                                                                        <h5 class="modal-title" id="staticBackdropLabel">Edit Feature Properties</h5>
                                                                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                                    </div>
                                                                                    <div class="modal-body">
                                                                                        <div class="row">
                                                                                            <x-form-input className="col-lg-12" type="text" name="name_category" label="Name" value="{{ $outdoor->name }}"/>
                                                                                            <x-form-select className="col-lg-12" name="feature_category" label="Feature Category"
                                                                                                :options="['Indoor', 'Outdoor']"
                                                                                                :selected="old('feature_category', $outdoor->type ?? '')"
                                                                                            />
                                                                                        </div>
                                                                                    </div>
                                                                                    <div class="modal-footer">
                                                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                        <button type="submit" class="btn btn-primary">Submit</button>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </form>

                                                                    {{-- Delete Button --}}
                                                                        <input type="hidden" class="propertyId" value="{{ $outdoor->id }}">
                                                                        <button type="button" class="btn btn-soft-danger btn-sm deleteButton" data-nama="{{ $outdoor->name }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                                    {{-- /. Delete Button --}}
                                                                 </div>
                                                            </td>
                                                       </tr>
                                                    @endforeach

                                                  </tbody>
                                             </table>
                                        </div> <!-- end table-responsive -->
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
