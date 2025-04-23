@extends('admin.layouts.master')
@push('plugin-styles')
    <link href="{{ asset('/admin/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.css') }}" rel="stylesheet" />
@endpush
@section('content')
    <nav class="page-breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="#">Villa</a></li>
            <li class="breadcrumb-item active" aria-current="page">Villa Listing</li>
        </ol>
    </nav>

    <div class="d-flex justify-content-between align-items-center flex-wrap grid-margin">
        <div>
          <h4 class="">Villa Listings</h4>
        </div>
        <div class="d-flex align-items-center flex-wrap text-nowrap">
          <button type="button" class="btn btn-primary btn-icon-text mb-2 mb-md-0">
            <i class="mdi mdi-home-plus fs-5"></i>                        
            Add New Villa
          </button>
        </div>
      </div>

    <div class="row">
        <div class="col-12 col-xl-12 stretch-card">
          <div class="row flex-grow-1">
            
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <h6 class="card-title mb-0" style="font-weight: 800">Total Properties</h6>
                        <h3 class="mt-auto fs-4">{{ $data_villa_count }} Properties</h3>
                    </div>
                    <div class="bg-primary text-light rounded px-3">
                        <i class="mdi mdi-home-analytics" style="font-size: 40px"></i> 
                    </div>
                  </div>
                </div>
              </div>
            </div>

            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <h6 class="card-title" style="font-weight: 800">Unit Rent</h6>
                        <h3 class="mt-auto fs-4">2 Unit</h3>
                    </div>
                    <div class="bg-primary text-light rounded px-3">
                        <i class="mdi mdi-cash-multiple" style="font-size: 40px"></i> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-4 grid-margin stretch-card">
              <div class="card">
                <div class="card-body">
                  <div class="d-flex justify-content-between">
                    <div class="d-flex flex-column">
                        <h6 class="card-title" style="font-weight: 800">Unit Rent</h6>
                        <h3 class="mt-auto fs-4">2 Unit</h3>
                    </div>
                    <div class="bg-primary text-light rounded px-3">
                        <i class="mdi mdi-cash-multiple" style="font-size: 40px"></i> 
                    </div>
                  </div>
                </div>
              </div>
            </div>
            
          </div>
        </div>
      </div> <!-- row -->
  
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    {{-- <table id="dataTableExample" class="table table-bordered border-top"> --}}
                    <table id="dataTableExample" class="table">
                    <thead>
                        <tr>
                            <th class="text-center">No</th>
                            <th class="text-center">Villa Name</th>
                            <th class="text-center">Price</th>
                            <th class="text-center">Bedroom</th>
                            <th class="text-center">Sub Region</th>
                            <th class="text-center">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data_villa as $villa )
                            <tr class="align-middle">
                                <td class="text-center">{{ $loop->iteration }}</td>
                                <td class="d-flex align-items-center">
                                    <img src="https://techzaa.in/lahomes/admin/assets/images/properties/p-1.jpg" class="rounded me-3" style="width: 55px; height: 55px;" alt="user">

                                    {{ $villa->villa_name }}
                                </td>
                                
                                <td class="text-center fs-5"><span class="badge bg-success">Rp. {{ number_format($villa->price, 0, ',', '.') }}</span></td>
                                
                                <td class="align-items-center fs-5">           
                                    <p class="d-flex align-items-center justify-content-center">
                                        <i class="mdi mdi-bed-king-outline fs-4 me-1"></i> {{ $villa->bedroom }}
                                    </p>
                                </td>
                                <td class="text-center fs-5"><span class="badge bg-primary">{{ $villa->sub_region }}</span></td>

                                <td class="text-center">
                                    <div class="btn-group btn-group-sm" role="group" aria-label="Basic example">

                                        <button type="button" class="btn btn-secondary" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="See Data Villa">
                                            <i class="link-icon" data-feather="eye"  height="14"></i>
                                        </button>
                                        <button type="button" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Edit Data Villa">
                                            <i class="link-icon" data-feather="edit"  height="14"></i>
                                        </button>
                                        <button type="button" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="top" data-bs-title="Delete Data Villa">
                                            <i class="link-icon" data-feather="trash-2"  height="14"></i>
                                        </button>
                                        
                                    </div>
                                </td>
                            </tr>
                        @endforeach

                    </tbody>
                    </table>
                </div>
            </div>
        </div>
        </div>
    </div>
@endsection

@push('plugin-scripts')
  <script src="{{ asset('/admin/assets/plugins/datatables-net/jquery.dataTables.js') }}"></script>
  <script src="{{ asset('/admin/assets/plugins/datatables-net-bs5/dataTables.bootstrap5.js') }}"></script>
@endpush

@push('custom-scripts')
  <script src="{{ asset('/admin/assets/js/data-table.js') }}"></script>
@endpush