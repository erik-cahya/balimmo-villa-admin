@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

    <!-- ========== Page Title Start ========== -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Listing List</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
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
                             <p class="mb-0"><span class="text-success fw-medium mb-0"><i class="ri-arrow-up-line"></i>34.4%</span> vs last month</p>
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
                                  <p class="text-muted fw-medium fs-22 mb-0">{{ $data_property_count }} Unit</p>
                             </div>
                             <div>
                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                       <iconify-icon icon="solar:home-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                  </div>
                             </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                             <p class="mb-0"><span class="text-danger fw-medium mb-0"><i class="ri-arrow-down-line"></i>8.5%</span> vs last month</p>

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
                                  <p class="text-muted fw-medium fs-22 mb-0">893 Unit</p>
                             </div>
                             <div>
                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                       <iconify-icon icon="solar:dollar-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                  </div>
                             </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                             <p class="mb-0"><span class="text-success fw-medium mb-0"><i class="ri-arrow-up-line"></i>17%</span> vs last month</p>
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
                                  <p class="text-muted fw-medium fs-22 mb-0">459 Unit</p>
                             </div>
                             <div>
                                  <div class="avatar-md bg-primary bg-opacity-10 rounded">
                                       <iconify-icon icon="solar:key-minimalistic-square-broken" class="fs-32 text-primary avatar-title"></iconify-icon>
                                  </div>
                             </div>
                        </div>
                        <div class="d-flex align-items-center justify-content-between mt-3">
                             <p class="mb-0"><span class="text-danger fw-medium mb-0"><i class="ri-arrow-down-line"></i>12%</span> vs last month</p>
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
                             <h4 class="card-title mb-0">All Properties List</h4>
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
                                       <th>Size</th>
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
                                                      <img src="{{ asset('admin') }}/assets/images/properties/p-1.jpg" alt="" class="avatar-md rounded border border-light border-3">
                                                 </div>
                                                 <div>
                                                      <a href="#!" class="text-dark fw-medium fs-15">{{ $property->property_name }}</a>
                                                 </div>
                                            </div>

                                       </td>
                                       <td>1400ft</td>
                                       <td class="text-capitalize">{{ $property->property_type }}</td>
                                       <td> <span class="badge bg-success-subtle text-success py-1 px-2 fs-13">Rent</span></td>
                                       <td>
                                            <p class="mb-0"><iconify-icon icon="solar:bed-broken" class="align-middle fs-16"></iconify-icon> 5</p>
                                       </td>
                                       <td>France</td>
                                       <td>$8,930.00</td>
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