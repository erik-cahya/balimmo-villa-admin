@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Customer Overview</h4>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Customers</a></li>
                                    <li class="breadcrumb-item active">Customer Overview</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- ========== Page Title End ========== -->

                    <div class="row">
                         <div class="col-xl-8 col-lg-12">
                              <div class="card">
                                   <div class="card-body">
                                        
                                        <div class="d-flex align-items-center my-3 gap-3">
                                             <img src="{{ asset('admin') }}/assets/images/users/avatar-2.jpg" alt="" class="rounded-circle avatar-xl img-thumbnail">
                                             <div>
                                                  <h3 class="fw-semibold mb-1">{{ $profile->name }}</h3>
                                                  <a href="#!" class="link-primary fw-medium fs-14">EastTribune.nl</a>
                                             </div>

                                        </div>
                                        <div class="d-flex flex-wrap align-items-start justify-content-between gap-3 mt-3">

                                             <div>
                                                  <a href="mailto:{{ $profile->email }}" class="btn btn-primary"><i class="ri-mail-fill"></i> Email Us</a>
                                                  <a href="#!" class="btn btn-outline-primary"><i class="ri-phone-fill"></i> Phone</a>
                                             </div>
                                             <div class="d-flex gap-1">
                                                  <a href="javascript: void(0);" class="btn btn-dark avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                       <i class="ri-edit-fill"></i>
                                                  </a>
                                                  <a href="javascript: void(0);" class="btn btn-primary avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                       <i class="ri-share-fill"></i>
                                                  </a>
                                             </div>
                                        </div>

                                        <div class="row my-4">
                                             <div class="col-lg-3">
                                                  <p class="text-dark fw-semibold fs-16 mb-1">Email Address :</p>
                                                  <p class="mb-0">{{ $profile->email == null ? '-' : $profile->email }}</p>
                                             </div>
                                             <div class="col-lg-3">
                                                  <p class="text-dark fw-semibold fs-16 mb-1">Phone Number :</p>
                                                  <p class="mb-0">{{ $profile->phone_number == null ? '-' : $profile->phone_number  }}</p>
                                             </div>
                                             <div class="col-lg-4">
                                                  <p class="text-dark fw-semibold fs-16 mb-1">Address :</p>
                                                  <p class="mb-0">{{ $profile->address == null ? '-' : $profile->address }}</p>
                                             </div>
                                             <div class="col-lg-2">
                                                  <p class="text-dark fw-semibold fs-16 mb-1">Status :</p>
                                                  <p class="mb-0"><span class="badge bg-success text-white fs-12 px-2 py-1">Available</span> </p>
                                             </div>
                                        </div>

                                        <div class="row">
                                             <div class="col-lg-4">                                                  
                                                  <h4 class="card-title mb-2">Social Media :</h4>
                                                  <ul class="list-inline d-flex gap-1 mb-0 align-items-center mt-3">
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="btn btn-soft-primary avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                                 <i class="ri-facebook-fill"></i>
                                                            </a>
                                                       </li>
          
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="btn btn-soft-danger avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                                 <i class="ri-instagram-fill"></i>
                                                            </a>
                                                       </li>
          
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="btn btn-soft-info avatar-sm d-flex align-items-center justify-content-center  fs-20">
                                                                 <i class="ri-twitter-fill"></i>
                                                            </a>
                                                       </li>
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="btn btn-soft-success avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                                 <i class="ri-whatsapp-fill"></i>
                                                            </a>
                                                       </li>
                                                       <li class="list-inline-item">
                                                            <a href="javascript: void(0);" class="btn btn-soft-warning avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                                 <i class="ri-mail-fill"></i>
                                                            </a>
                                                       </li>
                                                  </ul>
                                             </div>
                                             <div class="col-lg-8">
                                                  <h4 class="card-title mb-2">Description :</h4>
                                                  <p class="mb-0">{{ $profile->description == null ? '-' : $profile->description }}</p>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                              <div class="card">
                                   <div class="card-body">
                                        <div class="row">
                                             <div class="col-lg-4">
                                                  <div class="border p-2 rounded">
                                                       <div class="d-flex gap-3 align-items-center">
                                                            <div class="avatar bg-success bg-opacity-10 rounded">
                                                                 <iconify-icon icon="solar:home-2-bold" class="fs-28 text-success avatar-title"></iconify-icon>
                                                            </div>
                                                            <div>
                                                                 <p class="text-dark fw-semibold fs-16 mb-0">Active Property</p>
                                                                 <p class="mb-0">350 Property Active</p>
                                                            </div>
                                                       </div>
                                                       <div class="d-flex justify-content-between mt-4">
                                                            <p class="mb-1 text-dark  fw-medium fa-15">View Property</p>
                                                            <div>
                                                                 <p class="mb-0 text-dark fw-semibold fs-15">231</p>
                                                            </div>

                                                       </div>
                                                       <div class="progress mt-2" style="height: 10px;">
                                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-success" role="progressbar" style="width: 60%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70"></div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-4">
                                                  <div class="border p-2 rounded">
                                                       <div class="d-flex gap-3 align-items-center">
                                                            <div class="avatar bg-warning bg-opacity-10 rounded">
                                                                 <iconify-icon icon="solar:home-bold" class="fs-28 text-warning avatar-title"></iconify-icon>
                                                            </div>
                                                            <div>
                                                                 <p class="text-dark fw-semibold fs-16 mb-0">View Property</p>
                                                                 <p class="mb-0">231 Property View</p>
                                                            </div>
                                                       </div>
                                                       <div class="d-flex justify-content-between mt-4">
                                                            <p class="mb-1 text-dark  fw-medium fa-15">Own Property</p>
                                                            <div>
                                                                 <p class="mb-0 text-dark fw-semibold fs-15">27</p>
                                                            </div>

                                                       </div>
                                                       <div class="progress mt-2" style="height: 10px;">
                                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-warning" role="progressbar" style="width: 20%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70"></div>
                                                       </div>
                                                  </div>
                                             </div>
                                             <div class="col-lg-4">
                                                  <div class="border p-2 rounded">
                                                       <div class="d-flex gap-3 align-items-center">
                                                            <div class="avatar bg-primary bg-opacity-10 rounded">
                                                                 <iconify-icon icon="solar:money-bag-bold" class="fs-28 text-primary avatar-title"></iconify-icon>
                                                            </div>
                                                            <div>
                                                                 <p class="text-dark fw-semibold fs-16 mb-0">Own Property</p>
                                                                 <p class="mb-0">27 Property Own</p>
                                                            </div>
                                                       </div>
                                                       <div class="d-flex justify-content-between mt-4">
                                                            <p class="mb-1 text-dark  fw-medium fa-15">Invest On Property</p>
                                                            <div>
                                                                 <p class="mb-0 text-dark fw-semibold fs-15">$928,128</p>
                                                            </div>

                                                       </div>
                                                       <div class="progress mt-2" style="height: 10px;">
                                                            <div class="progress-bar progress-bar  progress-bar-striped progress-bar-animated bg-primary" role="progressbar" style="width: 80%" aria-valuenow="70" aria-valuemin="0" aria-valuemax="70"></div>
                                                       </div>
                                                  </div>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-xl-4 col-lg-12">
                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Transactions </h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="p-3 bg-primary bg-gradient rounded-4 border border-light border-2 shadow-sm">
                                             <div class="d-flex align-items-center">
                                                  <img src="{{ asset('admin') }}/assets/images/chip.png" alt="" class="avatar">
                                                  <div class="ms-auto">
                                                       <img src="{{ asset('admin') }}/assets/images/card/mastercard.svg" alt="" class="avatar">
                                                  </div>
                                             </div>
                                             <div class="mt-5">

                                                  <h4 class="text-white d-flex gap-2"><span class="text-white-50">XXXX</span> <span class="text-white-50">XXXX</span> <span class="text-white-50">XXXX</span> 3467</h4>
                                             </div>
                                             <div class="d-flex align-items-center justify-content-between mt-4">
                                                  <div>
                                                       <p class="text-white-50 mb-2">Holder Name</p>
                                                       <h4 class="mb-0 text-white">Ray C. Nichols</h4>
                                                  </div>
                                                  <div>
                                                       <p class="text-white-50 mb-2">Valid</p>
                                                       <h4 class="mb-0 text-white">05/26</h4>
                                                  </div>
                                                  <img src="{{ asset('admin') }}/assets/images/contactless-payment.png" alt="" class="img-fluid">
                                             </div>
                                        </div>
                                        <div class="mt-4">
                                             <div class="d-flex align-items-center gap-3 border-bottom pb-3">
                                                  <div class="avatar bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:square-transfer-horizontal-bold" class="fs-28 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                                  <div>
                                                       <p class="mb-1 text-dark fw-medium fs-15">Michael A. Miner</p>
                                                       <p class="text-muted mb-0">michaelminer@dayrep.com</p>
                                                  </div>
                                                  <div class="ms-auto">
                                                       <p class="mb-1 fs-16 text-dark fw-medium">$13,987 <span><i class="ri-checkbox-circle-line text-success ms-1"></i></span></p>
                                                       <p class="mb-0 fs-13">TXN-341220</p>
                                                  </div>
                                             </div>
                                             <div class="d-flex align-items-center gap-3 pt-3 rounded">
                                                  <div class="avatar bg-primary bg-opacity-10 rounded">
                                                       <iconify-icon icon="solar:square-transfer-horizontal-bold" class="fs-28 text-primary avatar-title"></iconify-icon>
                                                  </div>
                                                  <div>
                                                       <p class="mb-1 text-dark fw-medium fs-15">Theresa T. Brose</p>
                                                       <p class="text-muted mb-0">theresbrosea@dayrep.com</p>
                                                  </div>
                                                  <div class="ms-auto">
                                                       <p class="mb-1 fs-16 text-dark fw-medium">$2,710 <span><i class="ri-checkbox-circle-line text-success ms-1"></i></span></p>
                                                       <p class="mb-0 fs-13">TXN-836451</p>
                                                  </div>
                                             </div>
                                             <div class="mt-4">
                                                  <a href="#!" class="link-primary fw-medium">View More</a>
                                             </div>
                                        </div>
                                   </div>
                              </div>
                         </div>
                    </div>
               </div>


@endsection
