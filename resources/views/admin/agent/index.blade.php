@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Agent List</h4>
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
                                                       <input type="search" class="form-control" placeholder="Search Agent" autocomplete="off" value="">
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
                                   <div class="text-md-end mt-3 mt-md-0">
                                        <button type="button" class="btn btn-sm btn-outline-primary me-1"><i class="ri-search-line me-1"></i> Search</button>
                                        <button type="button" class="btn btn-sm btn-outline-dark rounded me-1" data-bs-toggle="collapse" data-bs-target="#addNewAgent" aria-expanded="false" aria-controls="addNewAgent"><i class="ri-add-line me-1"></i> Add New Agent</button>
                                   </div>
                              </div>

                         </div>
                    </div>
               </div>
          </div>

          <form action="{{ route('agent.store') }}" method="POST">
               @csrf
               <div class="collapse {{ $errors->any() ? 'show' : '' }}" id="addNewAgent">
                    <div class="card">
                         <div class="card-header text-bg-dark" style="border-radius: 20px 0px 20px 0px">
                              <h5 class="card-title">Add Data Agent</h5>
                         </div>
                         <div class="card-body">
                              <div class="row">

                                   <x-form-input className="col-lg-4" type="text" name="name" label="Agent Name"/>
                                   <x-form-input className="col-lg-4" type="text" name="initial_name" label="Intial Name"/>
                                   <x-form-input className="col-lg-4" type="email" name="email" label="Email Agent"/>

                                   <x-form-input className="col-lg-4" type="number" name="phone_number" label="Phone Number"/>
                                   <x-form-select className="col-lg-4" name="role" label="User Role" 
                                        :options="['Agent', 'Master']"
                                   />
                                   <x-form-input className="col-lg-4" type="password" name="password" label="Password Login"/>

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
                             <table class="table align-middle text-nowrap table-hover table-centered mb-0">
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
                                             <th>Registered</th>
                                             <th>Action</th>
                                       </tr>
                                  </thead>
                                  <tbody>
                                   @foreach ($data_agent as $agent )
                                       <tr class="{{ Auth::user()->id === $agent->id ? 'table-active' : '' }}">

                                            <td>
                                                 <div class="form-check">
                                                      <input type="checkbox" class="form-check-input" id="customCheck2">
                                                      <label class="form-check-label" for="customCheck2">&nbsp;</label>
                                                 </div>
                                            </td>
                                            <td class="text-dark fw-medium">#{{ $agent->reference_code }}</td>

                                            <td>
                                                 <div class="d-flex align-items-center gap-2">
                                                      <div>
                                                           <img src="{{ asset('admin') }}/assets/images/no-pic.png" alt="" class="avatar-sm rounded-circle">
                                                      </div>
                                                      <div>
                                                           <a href="#!" class="text-dark fw-medium fs-15">{{ $agent->name }}</a>
                                                      </div>
                                                 </div>

                                            </td>
                                            <td>{{ $agent->email }}</td>
                                            <td>{{ $agent->phone_number }}</td>
                                            <td>{{ $agent->properties_count }} Property</td>
                                            {{-- <td ><span class="badge badge-soft-secondary me-1">{{ $agent->reference_code }}</span></td> --}}
                                            <td class="text-capitalize"><span class="badge {{ ($agent->role === "master") ? "bg-danger" : "bg-primary" }} text-white fs-11">{{ $agent->role }}</span></td>
                                            <td>{{ \Carbon\Carbon::parse($agent->created_at)->format('d F, Y') }}</td>

                                            <td>
                                                 <div class="d-flex gap-2">
                                                      <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                      <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>

                                                      @if (Auth::user()->id !== $agent->id)
                                                        {{-- <a href="#!" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a> --}}
                                                        {{-- Delete Button --}}
                                                       <input type="hidden" class="propertyId" value="{{ $agent->id }}">
                                                       <button type="button" class="btn btn-soft-danger btn-sm deleteButton" data-nama="{{ $agent->name }}"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></button>
                                                       {{-- /. Delete Button --}}
                                                      @endif

                                                      
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
