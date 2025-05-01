@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

    <!-- ========== Page Title Start ========== -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Customer List</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                    <li class="breadcrumb-item active">Customer List</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ========== Page Title End ========== -->

    <div class="row d-none">
         <div class="col-lg-12">
              <div class="card">
                   <div class="card-header border-0">
                        <div class="row justify-content-between">
                             <div class="col-lg-6">
                                  <div class="row align-items-center">
                                       <div class="col-lg-6">
                                            <form class="app-search d-none d-md-block me-auto">
                                                 <div class="position-relative">
                                                      <input type="search" class="form-control" placeholder="Search Customer" autocomplete="off" value="">
                                                      <iconify-icon icon="solar:magnifer-broken" class="search-widget-icon"></iconify-icon>
                                                 </div>
                                            </form>
                                       </div>
                                       <div class="col-lg-4">
                                            <h5 class="text-dark fw-medium mb-0">501 <span class="text-muted"> Customers</span></h5>
                                       </div>
                                  </div>
                             </div>
                             <div class="col-lg-6">
                                  <div class="text-md-end mt-3 mt-md-0">
                                       <button type="button" class="btn btn-outline-primary me-1"><i class="ri-settings-2-line me-1"></i>More Setting</button>
                                       <button type="button" class="btn btn-outline-primary me-1"><i class="ri-filter-line me-1"></i> Filters</button>
                                       <button type="button" class="btn btn-success me-1"><i class="ri-add-line"></i> New Customer</button>
                                  </div>
                             </div><!-- end col-->
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
                             <h4 class="card-title">All Customer List</h4>
                        </div>
                        <div class="dropdown">
                             <a href="#" class="dropdown-toggle btn btn-sm btn-outline-light rounded" data-bs-toggle="dropdown" aria-expanded="false">
                                  This Month
                             </a>
                             <div class="dropdown-menu dropdown-menu-end">
                                  <!-- item-->
                                  <a href="#!" class="dropdown-item">Download</a>
                                  <!-- item-->
                                  <a href="#!" class="dropdown-item">Export</a>
                                  <!-- item-->
                                  <a href="#!" class="dropdown-item">Import</a>
                             </div>
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
                                            <th>Customer Photo & Name</th>
                                            <th>Email</th>
                                            <th>Contact</th>
                                            <th>Reference ID</th>
                                            <th>Roles</th>
                                            <th>Action</th>
                                       </tr>
                                  </thead>
                                  <tbody>
                                   @foreach ($data_agent as $agent )
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
                                                           <img src="{{ asset('admin') }}/assets/images/no-pic.png" alt="" class="avatar-sm rounded-circle">
                                                      </div>
                                                      <div>
                                                           <a href="#!" class="text-dark fw-medium fs-15">{{ $agent->name }}</a>
                                                      </div>
                                                 </div>

                                            </td>
                                            <td>{{ $agent->email }}</td>
                                            <td>+231 06-75820711</td>
                                            <td><span class="badge badge-soft-secondary me-1">{{ $agent->reference_code }}</span>
                                            </td>
                                            <td class="text-capitalize"><span class="badge {{ ($agent->role === "master") ? "bg-danger" : "bg-primary" }} text-white fs-11">{{ $agent->role }}</span></td>
                                            <td>
                                                 <div class="d-flex gap-2">
                                                      <a href="#!" class="btn btn-light btn-sm"><iconify-icon icon="solar:eye-broken" class="align-middle fs-18"></iconify-icon></a>
                                                      <a href="#!" class="btn btn-soft-primary btn-sm"><iconify-icon icon="solar:pen-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                      <a href="#!" class="btn btn-soft-danger btn-sm"><iconify-icon icon="solar:trash-bin-minimalistic-2-broken" class="align-middle fs-18"></iconify-icon></a>
                                                 </div>
                                            </td>
                                       </tr>
                                   @endforeach


                                       

                                  </tbody>
                             </table>
                        </div>
                        <!-- end table-responsive -->
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