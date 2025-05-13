@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Customers List</h4>
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
                                  <div class="text-md-end mt-3 mt-md-0">
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
                          <table class="table table-hover table-centered">
                              <thead class="table-light">
                                    <tr>
                                        <th scope="col">No</th>
                                        <th scope="col">Customer Name</th>
                                        <th scope="col">Phone Number</th>
                                        <th scope="col">Budget</th>
                                        <th scope="col">Property Name</th>
                                        <th scope="col">Localization</th>
                                        <th scope="col">Date</th>
                                        <th scope="col">Action</th>
                                    </tr>
                              </thead>
                              <tbody>
                                   @foreach ($data_customers as $customer)     
                                        <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>
                                             <div class="d-flex align-items-center gap-1">
                                                  <img src="{{ asset('admin') }}/assets/images/users/avatar-2.jpg" alt="" class="avatar-sm rounded-circle me-1">
                                                  <div class="d-block">
                                                       <h5 class="mb-0 text-dark fw-medium">{{ $customer->cust_name }}</h5>
                                                       <p class="fs-13 mb-0">{{ $customer->cust_email }}</p>
                                                  </div>
                                             </div>
                                        </td>
                                        <td>
                                             <p class="mb-0"><iconify-icon icon="mdi:phone" class="align-middle fs-16"></iconify-icon> {{ $customer->cust_telp }}</p>

                                        </td>
                                        <td>
                                             <p class="mb-0"><iconify-icon icon="tdesign:money-filled" class="align-middle fs-16"></iconify-icon> IDR {{ number_format($customer->cust_budget, 2, ',', '.') }}</p>
                                        </td>
                                        <td>
                                             <div class="d-block">
                                                  <p class="fs-13 mb-0 text-dark fw-medium">{{ $customer->property_name }}</p>
                                                  <p class="mb-0"><iconify-icon icon="solar:bed-broken" class="align-middle fs-16"></iconify-icon> {{ $customer->require_bedroom }}</p>
                                             </div>
                                        </td>
                                        <td>Badung Kedongaan</td>
                                        <td>20 Mei 2022</td>
                                        <td><a href="#!" class="btn btn-primary btn-sm w-100">Edit</a></td>
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
