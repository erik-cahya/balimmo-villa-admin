@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

    <!-- ========== Page Title Start ========== -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Property Overview</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                    <li class="breadcrumb-item active">Property Overview</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ========== Page Title End ========== -->


    <div class="row">
         <div class="col-xl-3 col-lg-4">
              <div class="card">
                   <div class="card-header bg-light-subtle">
                        <h4 class="card-title">Property Agent Details</h4>
                   </div>
                   <div class="card-body">
                        <div class="text-center">
                             <img src="{{ asset('admin') }}/assets/images/users/avatar-1.jpg" alt="" class="avatar-xl rounded-circle border border-2 border-light mx-auto">
                             <div class="mt-2">
                                  <a href="#!" class="fw-medium text-dark fs-16 text-uppercase">{{ $agent_data->name }}</a>
                                  <p class="mb-0 text-capitalize">({{ $agent_data->role }})</p>
                             </div>
                             
                             <div class="mt-3">
                                  <ul class="list-inline justify-content-center d-flex gap-1 mb-0 align-items-center">
                                       <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-primary fs-20">
                                                 <i class='ri-facebook-fill'></i>
                                            </a>
                                       </li>

                                       <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-danger fs-20">
                                                 <i class='ri-instagram-fill'></i>
                                            </a>
                                       </li>

                                       <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-info fs-20">
                                                 <i class='ri-twitter-fill'></i>
                                            </a>
                                       </li>
                                       <li class="list-inline-item">
                                            <a href="javascript: void(0);" class="btn btn-light avatar-sm d-flex align-items-center justify-content-center text-success fs-20">
                                                 <i class='ri-whatsapp-fill'></i>
                                            </a>
                                       </li>
                                  </ul>
                             </div>
                        </div>
                        <div class="mt-4">
                              <p class="mb-2"><span class="fw-medium text-dark">Reference Code</span><span class="mx-2">:</span>{{ $agent_data->reference_code }} </p>
                              <p class="mb-2"><span class="fw-medium text-dark">E-Mail</span><span class="mx-2">:</span>{{ $agent_data->email }}</p>
                         </div>
                   </div>
                   <div class="card-footer bg-light-subtle">
                        <div class="row g-2">
                             <div class="col-lg-12">
                                  <a href="#!" class="btn btn-primary w-100"><iconify-icon icon="solar:phone-calling-bold-duotone" class="align-middle fs-18"></iconify-icon> Call Us</a>
                             </div>
                        </div>
                   </div>
              </div>

              <div class="card">
               <div class="card-header d-flex justify-content-between align-items-center">
                    <h4 class="card-title">Details Properties</h4>
               </div> <!-- end card-header-->
               <div class="card-body p-0">
                    <div class="px-3" data-simplebar style="max-height: 406px;">
                         <table class="table table-hover text-nowrap table-hover table-centered mb-0 table-centered">
                              <tbody>
                                   <tr>
                                        <td>Barbeque Area Size</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon> 20m²</td>
                                   </tr>
                                   <tr>
                                        <td>Pool Size</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon> 20m²</td>
                                   </tr>
                                   <tr>
                                        <td>Pool Depth</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon> 20m²</td>
                                   </tr>
                                   <tr>
                                        <td>Air Conditioning</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon> 20m²</td>
                                   </tr>
                                   <tr>
                                        <td>Water Reservoir</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon> 20 Liters</td>
                                   </tr>
                                   <tr>
                                        <td>Water Filteration System</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon> Yes</td>
                                   </tr>
                                   <tr>
                                        <td>Backup Generator</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon>Yes</td>
                                   </tr>
                                   <tr>
                                        <td>Internet Wi-Fi</td>
                                        <td class="align-items-center d-flex"><iconify-icon icon="lets-icons:check-fill" class="text-success fs-24"></iconify-icon>200Mbps</td>
                                   </tr>
                              </tbody>
                         </table>
                    </div>
               </div> <!-- end card body -->
          </div> <!-- end card-->
         </div>
         <div class="col-xl-9 col-lg-8">
              <div class="card">
                   <div class="card-body">
                        <div class="position-relative">
                             <img src="{{ asset('admin') }}/uploads/images/{{ $featuredImage }}" alt="" class="img-fluid rounded" style="width: 100%; height: 30rem; object-fit: cover" >
                             <span class="position-absolute top-0 start-0 p-2">
                                  <span class="badge bg-warning text-light px-2 py-1 fs-16">For {{ $data_properties->property_status }}</span>
                             </span>
                        </div>
                        <div class="d-flex flex-wrap justify-content-between my-3 gap-2">
                             <div>
                                  <a href="#!" class="fs-20 text-dark fw-medium text-capitalize">{{ $data_properties->property_name }} - {{ $data_properties->region }}</a>
                                  <p class="d-flex align-items-center gap-1 mt-1 mb-0"><iconify-icon icon="solar:map-point-wave-bold-duotone" class="fs-18 text-primary"></iconify-icon>{{ isset($data_properties->property_address) ? $data_properties->property_address : 'Data Not Found' }}</p>
                             </div>
                             <div>
                                  <ul class="list-inline float-end d-flex gap-1 mb-0 align-items-center">
                                        <div class="d-flex align-items-center gap-2">
                                             <div class="avatar-sm bg-success-subtle rounded">
                                                  <iconify-icon icon="solar:wallet-money-bold-duotone" class="fs-24 text-success avatar-title"></iconify-icon>
                                             </div>
                                             <p class="fw-medium text-dark fs-18 mb-0">$80,675.00 </p>
                                        </div>
                                        <li class="list-inline-item fs-20 dropdown d-none d-md-flex">
                                             <a href="javascript: void(0);" class="dropdown-toggle arrow-none text-dark" data-bs-toggle="dropdown" aria-expanded="false">
                                                  <i class="ri-more-2-fill"></i>
                                             </a>
                                             <div class="dropdown-menu dropdown-menu-end">
                                                  <a class="dropdown-item" href="javascript: void(0);"><i class="ri-user-6-line me-2"></i>View Profile</a>
                                                  <a class="dropdown-item" href="javascript: void(0);"><i class="ri-music-2-line me-2"></i>Media, Links and Docs</a>
                                                  <a class="dropdown-item" href="javascript: void(0);"><i class="ri-search-2-line me-2"></i>Search</a>
                                                  <a class="dropdown-item" href="javascript: void(0);"><i class="ri-image-line me-2"></i>Wallpaper</a>
                                                  <a class="dropdown-item" href="javascript: void(0);"><i class="ri-arrow-right-circle-line me-2"></i>More</a>
                                             </div>
                                        </li>
                                  </ul>
                             </div>
                        </div>
                        
                        <div class="bg-light-subtle p-2 mt-3 rounded border border-dashed">
                             <div class="row align-items-center text-center justify-content-center g-2">
                                  <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                       <p class="text-muted mb-0 fs-12 fw-medium d-flex align-items-center justify-content-center gap-1"><iconify-icon icon="solar:bed-broken" class="fs-18 text-primary"></iconify-icon> {{ $propertyFeatures['bedrooms'][0] }} Bedroom
                                       </p>
                                  </div>
                                  <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                       <p class="text-muted mb-0 fs-12 fw-medium d-flex align-items-center justify-content-center gap-1"><iconify-icon icon="solar:bath-broken" class="fs-18 text-primary"></iconify-icon> {{ $propertyFeatures['bathroom'][0] }} Bathrooms
                                       </p>
                                  </div>
                                  <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                       <p class="text-muted mb-0 fs-12 fw-medium d-flex align-items-center justify-content-center gap-1"><iconify-icon icon="emojione-monotone:kitchen-knife" class="fs-18 text-primary"></iconify-icon> Close Kitchen
                                       </p>
                                  </div>

                                  @if (isset($propertyFeatures['number_of_floors']))     
                                        <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                             <p class="text-muted mb-0 fs-12 fw-medium d-flex align-items-center justify-content-center gap-1"><iconify-icon icon="solar:double-alt-arrow-up-broken" class="fs-18 text-primary"></iconify-icon> {{ $propertyFeatures['number_of_floors'][0] }} Floor
                                             </p>
                                        </div>
                                  @endif

                                  <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                       <p class="text-muted mb-0 fs-12 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <iconify-icon icon="guidance:garden" class="fs-18 text-primary"></iconify-icon>Garden

                                       </p>
                                  </div>
                                  <div class="col-xl-2 col-lg-3 col-md-6 col-6 border-end">
                                       <p class="text-muted mb-0 fs-12 fw-medium d-flex align-items-center justify-content-center gap-1">
                                            <iconify-icon icon="streamline:pool-ladder" class="fs-18 text-primary"></iconify-icon>Swimming Pool

                                       </p>
                                  </div>

                             </div>
                        </div>
                        <h5 class="text-dark fw-medium mt-3">Some Facility :</h5>
                        <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1 text-center" data-bs-placement="top" data-bs-toggle="popover" data-bs-trigger="hover" data-bs-content="200 m²" title="Barbeque Area Size!">Barbeque Area</span>
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Gazebo/Bale Bengong </span>
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Big Size Garden </span>
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">3 Motorcycle & 1 Car Parking </span>
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">24/7 Electricity </span>
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Private Gym </span>
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Private Cinema </span>
                             <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Electric Water Heater </span>

                        </div>
                        <div class="row my-3">
                              <div class="col-lg-4">
                                   <h5 class="text-dark fw-medium mt-3">Properties View :</h5>
                                   <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Jungle</span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Mountain </span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Sky City </span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Rice Field </span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Sea </span>
           
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <h5 class="text-dark fw-medium mt-3">Security :</h5>
                                   <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Alarm System </span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Security Guard </span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">CCTV </span>
           
                                   </div>
                              </div>
                              <div class="col-lg-4">
                                   <h5 class="text-dark fw-medium mt-3">Security :</h5>
                                   <div class="d-flex flex-wrap align-items-center gap-2 mt-3">
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Alarm System </span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">Security Guard </span>
                                        <span class="badge bg-light-subtle text-muted border fw-medium fs-13 px-2 py-1">CCTV </span>
           
                                   </div>
                              </div>
                        </div>
                        
                        <h5 class="text-dark fw-medium mt-3">Property Details :</h5>
                        <p class="mt-2">Property refers to any item that an individual or a business holds legal title to. This can include tangible items, such as houses, cars, or appliances, as well as intangible items that hold potential future value, such as stock and bond certificates. Legally, property is classified into two categories: personal property and real property. This distinction originates from English common law, and our contemporary legal system continues to differentiate between these two types.</p>
                        
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
                         <div class="d-flex align-items-center justify-content-end">
                              <div>
                                   <p class="mb-0 d-flex align-items-center gap-1"><iconify-icon icon="solar:calendar-date-broken" class="fs-18 text-primary"></iconify-icon> 10 May 2024</p>
                              </div>
                         </div>
                   </div>

              </div>
         </div>
    </div>
    <div class="row">
         <div class="col-lg-12">
              <div class="mapouter">
                   <div class="gmap_canvas mb-2"><iframe class="gmap_iframe rounded" width="100%" style="height: 400px;" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=1980&amp;height=400&amp;hl=en&amp;q=University of Oxford&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe></div>
              </div>
         </div>
    </div>
</div>
@endsection