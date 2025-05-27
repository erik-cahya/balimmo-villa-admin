@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

                    <!-- ========== Page Title Start ========== -->
                    <div class="row">
                        <div class="col-12">
                            <div class="page-title-box">
                                <h4 class="mb-0 fw-semibold">Agent Overview</h4>
                                <ol class="breadcrumb mb-0">
                                    <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                                    <li class="breadcrumb-item active">Agent Overview</li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <!-- ========== Page Title End ========== -->

                    <div class="row justify-content-center">
                         <div class="col-xl-8 col-lg-12">
                              <div class="card">
                                   <div class="card-body">
                                        <div class="d-flex flex-wrap align-items-center gap-3">
                                             <div class="position-relative">
                                                  <img src="{{ asset('admin') }}/assets/images/users/avatar-2.jpg" alt="avatar-2" class="avatar-xl user-img img-thumbnail rounded-circle">
                                                  <div class="badge bg-success rounded-2 position-absolute bottom-0 start-50 translate-middle-x mb-n1 fs-11"># 1</div>
                                             </div>
                                             <div class="d-block">
                                                  <a href="#!" class="text-dark fw-medium fs-16">{{ $profile->name }}</a>
                                                  <p class="mb-0">{{ $profile->email }}</p>
                                             </div>
                                             <div class="ms-lg-auto">
                                                  <a href="#!" class="btn btn-primary">Edit Profile</a>
                                             </div>
                                        </div>
                                        <div class="mt-3">
                                             <p class="d-flex align-items-center gap-2"><iconify-icon icon="solar:map-point-wave-bold-duotone" class="fs-18 text-primary"></iconify-icon>{{ $profile->reference_code }}</p>
                                             <p class="d-flex align-items-center gap-2"><iconify-icon icon="ic:baseline-phone" class="fs-18 text-primary"></iconify-icon>{{ $profile->phone_number }}</p>
                                             <p class="d-flex align-items-center gap-2"><iconify-icon icon="ic:baseline-whatsapp" class="fs-18 text-primary"></iconify-icon>{{ $profile->phone_number }}</p>

                                             <h4 class="card-title mb-2 mt-3">Social Media :</h4>
                                             <ul class="list-inline d-flex gap-1 mb-0 mt-3 align-items-center">
                                                  <li class="list-inline-item">
                                                       <a href="javascript: void(0);" class="btn btn-soft-primary avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                            <i class="ri-facebook-fill"></i>
                                                       </a>
                                                  </li>

                                                  <li class="list-inline-item">
                                                       <a href="javascript: void(0);" class="btn btn-soft-danger avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                            <i class="ri-instagram-line"></i>
                                                       </a>
                                                  </li>

                                                  <li class="list-inline-item">
                                                       <a href="javascript: void(0);" class="btn btn-soft-info avatar-sm d-flex align-items-center justify-content-center  fs-20">
                                                            <i class="ri-twitter-line"></i>
                                                       </a>
                                                  </li>
                                                  <li class="list-inline-item">
                                                       <a href="javascript: void(0);" class="btn btn-soft-success avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                            <i class="ri-whatsapp-line"></i>
                                                       </a>
                                                  </li>
                                                  <li class="list-inline-item">
                                                       <a href="javascript: void(0);" class="btn btn-soft-warning avatar-sm d-flex align-items-center justify-content-center fs-20">
                                                            <i class="ri-mail-line"></i>
                                                       </a>
                                                  </li>
                                             </ul>
                                        </div>
                                        <div class="mt-4">
                                             <h4 class="card-title mb-2">About Michael :</h4>
                                             <p class="mb-2">Meet Michael, a dedicated and experienced real estate agent who is committed to making your real estate journey smooth and successful. With a passion for helping clients achieve their dreams, Michael brings a wealth of knowledge and expertise to every transaction.</p>
                                             <p class="mb-2">Michael has been a prominent figure in the real estate industry for over a decade. His career began with a focus on residential properties, quickly expanding to include commercial real estate and investment properties. Michael's extensive experience and deep understanding of the market allow him to navigate even the most complex transactions with ease.</p>                                        
                                             <p class="mb-2"><span class="fw-medium text-dark">Agency</span><span class="mx-2">:</span>Universo Realtors</p>
                                             <p class="mb-2"><span class="fw-medium text-dark">Agent License</span><span class="mx-2">:</span>LC-5758-2048-3944</p>
                                             <p class="mb-2"><span class="fw-medium text-dark">Text Number</span><span class="mx-2">:</span>TC-9275-PC-55685</p>
                                             <p class="mb-2"><span class="fw-medium text-dark">Services Area</span><span class="mx-2">:</span>Lincoln Drive Harrisburg</p>
                                             <div class="my-2">
                                                  <a href="#!" class="link-primary fw-medium">Viw More <i class="ri-arrow-right-line"></i></a>
                                             </div>
                                        </div>
                                      
                                        <h4 class="card-title mt-4">Property File :</h4>
                                        <div class="mt-3 d-flex flex-wrap gap-2">
                                             <div class="d-flex p-2 gap-2 bg-light-subtle align-items-center text-start position-relative border rounded">
                                                  <iconify-icon icon="solar:file-check-bold" class="text-danger fs-24"></iconify-icon>
                                                 <div>
                                                     <h4 class="fs-14 mb-1"><a href="#!" class="text-dark stretched-link">Property-File.pdf</a></h4>
                                                         <p class="fs-12 mb-0">2.4 MB</p>
                                                 </div>
                                                 <i class="ri-download-cloud-line fs-20 text-muted"></i><i class=''></i>
                                             </div>

                                             <div class="d-flex p-2 gap-2 bg-light-subtle align-items-center text-start position-relative border rounded">
                                                  <iconify-icon icon="solar:user-bold" class="text-primary fs-24"></iconify-icon>
                                                 <div>
                                                     <h4 class="fs-14 mb-1"><a href="#!" class="text-dark stretched-link">Client-List.pdf</a></h4>
                                                         <p class="fs-12 mb-0">1.6 MB</p>
                                                 </div>
                                                 <i class="ri-download-cloud-line fs-20 text-muted"></i>
                                             </div>
                                             <div class="d-flex p-2 gap-2 bg-light-subtle align-items-center text-start position-relative border rounded">
                                                  <iconify-icon icon="solar:gallery-minimalistic-bold" class="text-success fs-24"></iconify-icon>
                                                 <div>
                                                     <h4 class="fs-14 mb-1"><a href="#!" class="text-dark stretched-link">Property-Photo.pdf</a></h4>
                                                         <p class="fs-12 mb-0">23.2 MB</p>
                                                 </div>
                                                 <i class="ri-download-cloud-line fs-20 text-muted"></i>
                                             </div>
                                             <div class="d-flex p-2 gap-2 bg-light-subtle align-items-center text-start position-relative border rounded">
                                                  <iconify-icon icon="solar:streets-map-point-bold" class="text-warning fs-24"></iconify-icon>
                                                 <div>
                                                     <h4 class="fs-14 mb-1"><a href="#!" class="text-dark stretched-link">Area-sqft.png</a></h4>
                                                         <p class="fs-12 mb-0">2.3 MB</p>
                                                 </div>
                                                 <i class="ri-download-cloud-line fs-20 text-muted"></i>
                                             </div>
                                         </div>
                                   </div>
                              </div>
                         </div>
                         <div class="col-xl-4 col-lg-12">

                              <div class="card">
                                   <div class="card-header">
                                        <h4 class="card-title">Property Status</h4>
                                   </div>
                                   <div class="card-body">
                                        <div class="col-xl-12 col-lg-12">
                                                <div class="card mb-0 shadow-none border">
                                                    <div class="card-body">
                                                          <div class="row justify-content-between align-items-center">
                                                              <div class="col-xl-5">
                                                                    <div class="avatar bg-primary bg-opacity-10 rounded mb-3">
                                                                        <iconify-icon icon="solar:home-bold" class="fs-28 text-primary avatar-title"></iconify-icon>
                                                                    </div>
                                                                    <p class="fw-medium fs-15 mb-1">Total Listing</p>
                                                                    <p class="mb-0 fw-semibold text-dark fs-20">2043</p>
                                                              </div>
                                                              <div class="col-lg-6">
                                                                    <div id="property_sale1" class="apex-charts"></div>
                                                              </div>
                                                          </div>
                                                    </div>
                                                </div>
                                          </div>

                                          <div class="col-xl-12 col-lg-12 mt-3">
                                                <div class="card mb-0 shadow-none border">
                                                    <div class="card-body">
                                                          <div class="row justify-content-between align-items-center">
                                                              <div class="col-xl-5">
                                                                    <div class="avatar bg-primary bg-opacity-10 rounded mb-3">
                                                                        <iconify-icon icon="solar:wallet-money-bold" class="fs-28 text-primary avatar-title"></iconify-icon>
                                                                    </div>
                                                                    <p class="fw-medium fs-15 mb-1">Property Sold</p>
                                                                    <p class="mb-0 fw-semibold text-dark fs-20">6000</p>
                                                              </div>
                                                              <div class="col-xl-6">
                                                                    <div id="property_sale2" class="apex-charts"></div>
                                                              </div>
                                                          </div>
                                                    </div>
                                                </div>
                                          </div>
                                          <div class="col-xl-12 col-lg-12 mt-3">
                                                <div class="card mb-0 shadow-none border">
                                                    <div class="card-body">
                                                          <div class="row justify-content-between align-items-center">
                                                              <div class="col-xl-5">
                                                                    <div class="avatar bg-primary bg-opacity-10 rounded mb-3">
                                                                        <iconify-icon icon="solar:hand-money-bold" class="fs-28 text-primary avatar-title"></iconify-icon>
                                                                    </div>
                                                                    <p class="fw-medium fs-15 mb-1">Property Rent</p>
                                                                    <p class="mb-0 fw-semibold text-dark fs-20">105</p>
                                                              </div>
                                                              <div class="col-lg-6">
                                                                    <div id="property_sale3" class="apex-charts"></div>
                                                              </div>
                                                          </div>
                                                    </div>
                                                </div>
                                          </div>
                                   </div>
                              </div>
                         </div>
                    </div>

               </div>



               @php
    // Misal data statis
    $percentageSold = 80;
@endphp

@endsection
@push('scripts')
     <script src="{{ asset('admin') }}/assets/js/pages/agent-detail.js"></script>
     
<script>
    const options = {
        series: [{{ $percentageSold }}], // nilai langsung dari Blade
        chart: {
            width: 100,
            height: 100,
            type: "radialBar",
            sparkline: {
                enabled: true
            }
        },
        plotOptions: {
            radialBar: {
                hollow: {
                    margin: 0,
                    size: "60%"
                },
                track: {
                    margin: 0,
                    background: "#02bc9c"
                },
                dataLabels: {
                    show: false,
                    name: { show: false },
                    value: {
                        fontSize: '18px',
                        formatter: function (val) {
                            return val + "%";
                        }
                    }
                }
            }
        },
        stroke: {
            lineCap: "round"
        },
        labels: ["Property Sold"],
        colors: ["#47ad94"]
    };

    const chart = new ApexCharts(document.querySelector("#property_sale1"), options);
    chart.render();
</script>
@endpush
