<div class="row mt-4">
    <div class="col-xl-12">
        <div class="card">
            <div class="card-header d-flex justify-content-between align-items-center border-bottom">
                <div>
                    <h4 class="card-title">Specific Property List</h4>
                </div>

            </div>
            <div class="card-body p-0">
                <div class="table-responsive">
                    <table class="table-hover table-centered table text-nowrap" id="myTable">
                        <thead class="table-light">
                            <tr>
                                <th scope="col">No</th>
                                <th scope="col">Customer Name</th>
                                @role('Master')
                                    <th scope="col">Agent Name</th>
                                @endrole
                                <th scope="col">Property Selected</th>
                                <th scope="col">Property Address</th>
                                <th scope="col">Price</th>
                                <th scope="col">Date</th>

                                <th scope="col">Status / Action</th>
                            </tr>
                        </thead>
                        <tbody>


                            <tr>
                                <td>1</td>
                                <td>
                                    <div class="d-block" data-bs-toggle="modal" data-bs-target="#seeProperties-1" style="cursor: pointer">
                                        <h5 class="text-dark fw-medium mb-0 " >Erik Cahya Pradana</h5>
                                        <p class="fs-13 mb-0">erikcp38@gmail.com</p>
                                    </div>
                                </td>
                                @role('Master')
                                <td>
                                    <div class="d-block">
                                        <h5 class="text-dark fw-medium mb-0">Deva Mahayana</h5>
                                        <p class="fs-13 mb-0">deva@balimmo-properties.com</p>
                                    </div>
                                </td>
                                @endrole
                                <td><iconify-icon icon="material-symbols:house-outline" class="fs-16 align-middle"></iconify-icon> Villa Teratai Biru</td>
                                <td><iconify-icon icon="flowbite:map-pin-solid" class="fs-16 align-middle"></iconify-icon> Jl Raya Canggu No 66</td>
                                <td>
                                    <div class="d-block">
                                        <h5 class="text-dark fw-medium mb-0">IDR 4.000.000.000</h5>
                                        <p class="fs-13 mb-0">USD 245.324</p>
                                    </div>
                                </td>
                                

                                
                                <td><iconify-icon icon="uiw:date" class="fs-16 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse('2025-7-3')->format('d F, Y') }}</td>
                                <td>
                                    <!-- <button type="button" class="btn btn-xs btn-light" data-bs-toggle="modal" data-bs-target="#seeProperties-1">MOU/LOI Signed</button> -->

                                    <button type="button" class="btn btn-xs btn-light" data-bs-toggle="offcanvas" data-bs-target="#rightOffcanvas" aria-controls="rightOffcanvas">MOU/LOI Signed</button>

                                    <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="modal" data-bs-target="#editLeads-1">
                                        <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                    </button>                                    

                                    <input type="hidden" class="propertyId" value="1">

                                    <button type="button" class="btn btn-xs btn-danger deleteButton" data-nama="Erik Cahya Pradana"><iconify-icon icon="pepicons-pop:trash" class="fs-12 align-middle"></iconify-icon></button>
                                    
                                    <!-- right offcanvas -->
                                    <div class="offcanvas offcanvas-end" style="width: 40%" tabindex="-1" id="rightOffcanvas" aria-labelledby="rightOffcanvasLabel">
                                        <div class="offcanvas-header">
                                            <h3 class="offcanvas-title mt-0" id="rightOffcanvasLabel">Status</h3>
                                            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
                                        </div>
                                        <div class="offcanvas-body w-full d-flex flex-column gap-4">
                                            <div class="d-flex gap-1">
                                                <ul class="list-group container">
                                                    <li class="list-group-item active" aria-current="true">Client Information</li>
                                                    <li class="list-group-item">Name : Erik Cahya Pradana</li>
                                                    <li class="list-group-item">Email : erikcp38@gmail.com</li>
                                                    <li class="list-group-item">Telephone : +62 323 2342 4322</li>
                                                    <li class="list-group-item">Property : Villa Teratai Biru</li>                                                
                                                </ul>
                                                <ul class="list-group container">
                                                    <li class="list-group-item active" aria-current="true">Agent Information</li>
                                                    <li class="list-group-item">Name : Deva Mahayana</li>
                                                    <li class="list-group-item">Email : deva@balimmo-properties.com</li>
                                                    <li class="list-group-item">Telephone : +62 323 2342 4322</li>
                                                </ul>
                                            </div>
                                            
                                            <table class="table table-centered">
                                                <thead>
                                                    <tr>
                                                        <th scope="col">Status</th>
                                                        <th scope="col">Step</th>
                                                        <th scope="col">Docs</th>
                                                        <th scope="col">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <!-- Step Progress Start -->
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-success me-1">Done</span>
                                                        </td>
                                                        <td data-bs-toggle="collapse" data-bs-target="#MOULOISigned" aria-expanded="false" aria-controls="MOULOISigned" class="cursor-pointer">
                                                            MOU/LOI Signed
                                                        </td>
                                                        <td class="container">
                                                            <!-- File Uploaded (Downloadable) -->
                                                            <button type="button" class="btn btn-xs btn-primary me-1">
                                                                MOU/LOI Signed.pdf 
                                                                <iconify-icon icon="tabler:download" class="fs-18 align-middle"></iconify-icon>
                                                            </button>
                                                        </td>
                                                        <td class="d-flex gap-1">
                                                            <!-- Button Upload File -->
                                                            <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="collapse" data-bs-target="#MOULOISigned" aria-expanded="false" aria-controls="MOULOISigned">
                                                                <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                                            </button>      
                                                            <!-- Button Change Status -->
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Status
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                                                    <li><a class="dropdown-item" href="#">On Progress</a></li>
                                                                    <li><a class="dropdown-item" href="#">Done</a></li>                                                                    
                                                                </ul>
                                                            </div>                                                                                                                       
                                                        </td>
                                                    </tr>

                                                        <!-- Collapse Section For Add/Update File -->
                                                        <tr class="collapse" id="MOULOISigned">                                                                
                                                            <td></td>
                                                            <td></td>
                                                            <td colspan="2" class="d-flex gap-1">
                                                                <input type="file" name="doc-progress" class="form-control">
                                                                <button type="button" class="btn btn-primary">
                                                                    Save
                                                                </button>   
                                                            </td>                                                        
                                                        </tr>
                                                    <!-- Step Progress End -->


                                                    <!-- Step Progress Start -->
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-warning me-1">On Progress</span>
                                                        </td>
                                                        <td data-bs-toggle="collapse" data-bs-target="#PPJBExecuted" aria-expanded="false" aria-controls="PPJBExecuted" class="cursor-pointer">
                                                            PPJB Executed
                                                        </td>
                                                        <td class="container">
                                                            <!-- File Uploaded (Downloadable) -->
                                                            <button type="button" class="btn btn-xs btn-light me-1"
                                                            data-bs-toggle="collapse" data-bs-target="#PPJBExecuted" aria-expanded="false" aria-controls="PPJBExecuted" class="cursor-pointer">
                                                                No file choosen 
                                                            </button>
                                                        </td>
                                                        <td class="d-flex gap-1">
                                                            <!-- Button Upload File -->
                                                            <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="collapse" data-bs-target="#PPJBExecuted" aria-expanded="false" aria-controls="PPJBExecuted">
                                                                <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                                            </button>      
                                                            <!-- Button Change Status -->
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Status
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                                                    <li><a class="dropdown-item" href="#">On Progress</a></li>
                                                                    <li><a class="dropdown-item" href="#">Done</a></li>                                                                    
                                                                </ul>
                                                            </div>                                                                                                                       
                                                        </td>
                                                    </tr>

                                                        <!-- Collapse Section For Add/Update File -->
                                                        <tr class="collapse" id="PPJBExecuted">                                                                
                                                            <td></td>
                                                            <td></td>
                                                            <td colspan="2" class="d-flex gap-1">
                                                                <input type="file" name="doc-progress" class="form-control">
                                                                <button type="button" class="btn btn-primary">
                                                                    Save
                                                                </button>   
                                                            </td>                                                        
                                                        </tr>
                                                    <!-- Step Progress End -->

                                                    <!-- Step Progress Start -->
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-danger me-1">Pending</span>
                                                        </td>
                                                        <td data-bs-toggle="collapse" data-bs-target="#DepositSecured" aria-expanded="false" aria-controls="DepositSecured" class="cursor-pointer">
                                                            Deposit Secured
                                                        </td>
                                                        <td class="container">
                                                            <!-- File Uploaded (Downloadable) -->
                                                            <button type="button" class="btn btn-xs btn-light me-1"
                                                            data-bs-toggle="collapse" data-bs-target="#DepositSecured" aria-expanded="false" aria-controls="DepositSecured" class="cursor-pointer">
                                                                No file choosen 
                                                            </button>
                                                        </td>
                                                        <td class="d-flex gap-1">
                                                            <!-- Button Upload File -->
                                                            <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="collapse" data-bs-target="#DepositSecured" aria-expanded="false" aria-controls="DepositSecured">
                                                                <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                                            </button>      
                                                            <!-- Button Change Status -->
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Status
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                                                    <li><a class="dropdown-item" href="#">On Progress</a></li>
                                                                    <li><a class="dropdown-item" href="#">Done</a></li>                                                                    
                                                                </ul>
                                                            </div>                                                                                                                       
                                                        </td>
                                                    </tr>

                                                        <!-- Collapse Section For Add/Update File -->
                                                        <tr class="collapse" id="DepositSecured">                                                                
                                                            <td></td>
                                                            <td></td>
                                                            <td colspan="2" class="d-flex gap-1">
                                                                <input type="file" name="doc-progress" class="form-control">
                                                                <button type="button" class="btn btn-primary">
                                                                    Save
                                                                </button>   
                                                            </td>                                                        
                                                        </tr>
                                                    <!-- Step Progress End -->

                                                    <!-- Step Progress Start -->
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-danger me-1">Pending</span>
                                                        </td>
                                                        <td data-bs-toggle="collapse" data-bs-target="#DueDiligence" aria-expanded="false" aria-controls="DueDiligence" class="cursor-pointer">
                                                            Due Diligence 
                                                        </td>
                                                        <td class="container">
                                                            <!-- File Uploaded (Downloadable) -->
                                                            <button type="button" class="btn btn-xs btn-light me-1"
                                                            data-bs-toggle="collapse" data-bs-target="#DueDiligence" aria-expanded="false" aria-controls="DueDiligence" class="cursor-pointer">
                                                                No file choosen 
                                                            </button>
                                                        </td>
                                                        <td class="d-flex gap-1">
                                                            <!-- Button Upload File -->
                                                            <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="collapse" data-bs-target="#DueDiligence" aria-expanded="false" aria-controls="DueDiligence">
                                                                <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                                            </button>      
                                                            <!-- Button Change Status -->
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Status
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                                                    <li><a class="dropdown-item" href="#">On Progress</a></li>
                                                                    <li><a class="dropdown-item" href="#">Done</a></li>                                                                    
                                                                </ul>
                                                            </div>                                                                                                                       
                                                        </td>
                                                    </tr>

                                                        <!-- Collapse Section For Add/Update File -->
                                                        <tr class="collapse" id="DueDiligence">                                                                
                                                            <td></td>
                                                            <td></td>
                                                            <td colspan="2" class="d-flex gap-1">
                                                                <input type="file" name="doc-progress" class="form-control">
                                                                <button type="button" class="btn btn-primary">
                                                                    Save
                                                                </button>   
                                                            </td>                                                        
                                                        </tr>
                                                    <!-- Step Progress End -->

                                                    <!-- Step Progress Start -->
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-danger me-1">Pending</span>
                                                        </td>
                                                        <td data-bs-toggle="collapse" data-bs-target="#AJBSigned" aria-expanded="false" aria-controls="AJBSigned" class="cursor-pointer">
                                                            AJB Signed 
                                                        </td>
                                                        <td class="container">
                                                            <!-- File Uploaded (Downloadable) -->
                                                            <button type="button" class="btn btn-xs btn-light me-1"
                                                            data-bs-toggle="collapse" data-bs-target="#AJBSigned" aria-expanded="false" aria-controls="AJBSigned" class="cursor-pointer">
                                                                No file choosen 
                                                            </button>
                                                        </td>
                                                        <td class="d-flex gap-1">
                                                            <!-- Button Upload File -->
                                                            <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="collapse" data-bs-target="#AJBSigned" aria-expanded="false" aria-controls="AJBSigned">
                                                                <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                                            </button>      
                                                            <!-- Button Change Status -->
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Status
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                                                    <li><a class="dropdown-item" href="#">On Progress</a></li>
                                                                    <li><a class="dropdown-item" href="#">Done</a></li>                                                                    
                                                                </ul>
                                                            </div>                                                                                                                       
                                                        </td>
                                                    </tr>

                                                        <!-- Collapse Section For Add/Update File -->
                                                        <tr class="collapse" id="AJBSigned">                                                                
                                                            <td></td>
                                                            <td></td>
                                                            <td colspan="2" class="d-flex gap-1">
                                                                <input type="file" name="doc-progress" class="form-control">
                                                                <button type="button" class="btn btn-primary">
                                                                    Save
                                                                </button>   
                                                            </td>                                                        
                                                        </tr>
                                                    <!-- Step Progress End -->

                                                    <!-- Step Progress Start -->
                                                    <tr>
                                                        <td>
                                                            <span class="badge bg-danger me-1">Pending</span>
                                                        </td>
                                                        <td data-bs-toggle="collapse" data-bs-target="#TransactionRegistered" aria-expanded="false" aria-controls="TransactionRegistered" class="cursor-pointer">
                                                            Transaction Registered 
                                                        </td>
                                                        <td class="container">
                                                            <!-- File Uploaded (Downloadable) -->
                                                            <button type="button" class="btn btn-xs btn-light me-1"
                                                            data-bs-toggle="collapse" data-bs-target="#TransactionRegistered" aria-expanded="false" aria-controls="TransactionRegistered" class="cursor-pointer">
                                                                No file choosen 
                                                            </button>
                                                        </td>
                                                        <td class="d-flex gap-1">
                                                            <!-- Button Upload File -->
                                                            <button type="button" class="btn btn-xs btn-warning" data-bs-toggle="collapse" data-bs-target="#TransactionRegistered" aria-expanded="false" aria-controls="TransactionRegistered">
                                                                <iconify-icon icon="tabler:edit" class="fs-12 align-middle"></iconify-icon>
                                                            </button>      
                                                            <!-- Button Change Status -->
                                                            <div class="dropdown">
                                                                <button type="button" class="btn btn-xs btn-primary dropdown-toggle" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    Status
                                                                </button>
                                                                <ul class="dropdown-menu">
                                                                    <li><a class="dropdown-item" href="#">Pending</a></li>
                                                                    <li><a class="dropdown-item" href="#">On Progress</a></li>
                                                                    <li><a class="dropdown-item" href="#">Done</a></li>                                                                    
                                                                </ul>
                                                            </div>                                                                                                                       
                                                        </td>
                                                    </tr>

                                                        <!-- Collapse Section For Add/Update File -->
                                                        <tr class="collapse" id="TransactionRegistered">                                                                
                                                            <td></td>
                                                            <td></td>
                                                            <td colspan="2" class="d-flex gap-1">
                                                                <input type="file" name="doc-progress" class="form-control">
                                                                <button type="button" class="btn btn-primary">
                                                                    Save
                                                                </button>   
                                                            </td>                                                        
                                                        </tr>
                                                    <!-- Step Progress End -->
                                                </tbody>
                                            </table>

                                        </div>
                                    </div>
                                    
                                    <!-- Modal See Properties Select -->
                                    <div class="modal modal-xl fade" id="seeProperties-1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Properties Selected </h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="d-flex gap-2">
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="solar:user-bold" class="fs-10 align-middle"></iconify-icon> Erik Cahya Pradana</span>
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> erikcp38@gmail.com</span>
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="material-symbols:mail-outline" class="fs-10 align-middle"></iconify-icon> {{ \Carbon\Carbon::parse('2025-07-08')->format('d F, Y') }}</span>
                                                        <span class="badge bg-dark text-light p-1" style="font-size: 14px"><iconify-icon icon="ic:round-phone" class="fs-10 align-middle"></iconify-icon> {{ implode('-', str_split(preg_replace('/\D/', '', '08901903123'), 4)) }}</span>
                                                    </div>
                                                    <div class="table-responsive">
                                                        <table class="table-hover  table-centered table text-nowrap" id="seePropertiesDetailTable-1">
                                                            <thead class="table-light">
                                                                <tr>
                                                                    <th scope="col">No</th>
                                                                    <th scope="col">Property Name</th>
                                                                    <th scope="col">Property Address</th>
                                                                    <th scope="col">Require Customer Bedroom</th>
                                                                    <th scope="col">Customer Budget</th>
                                                                    <th scope="col">Customer USD</th>
                                                                    <th scope="col">Customer Message</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>

                                                                <tr>
                                                                    <td>1</td>
                                                                    <td>Grand Villa Ubud</td>
                                                                    <td>Jln. Gilimanuk Tabanan, Tabanan, Bali</td>
                                                                    <td>20</td>
                                                                    <td>IDR {{ number_format(200000000, 0, ',', '.') }}</td>
                                                                    <td>USD {{ number_format(200.0, 2, ',', '.') }}</td>
                                                                    <td>Hello im Erik</td>
                                                                </tr>

                                                            </tbody>
                                                        </table>
                                                    </div>

                                                    <script>
                                                        $(document).ready(function() {
                                                            $('#seePropertiesDetailTable-1').DataTable();
                                                        });
                                                    </script>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                </div>

                                                @if ($errors->any())
                                                    <div class="alert alert-danger">
                                                        <ul class="mb-0">
                                                            @foreach ($errors->all() as $message)
                                                                <li>{{ $message }}</li>
                                                            @endforeach
                                                        </ul>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                    <!-- /* Modal See Properties Select -->

                                    {{-- Modal Make Prospect --}}
                                    {{-- <div class="modal modal-lg fade" id="editMatchProperties-1" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Make to Prospect</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                </div>
                                                <form action="{{ route('leadsToProspect', $customerData->id) }}" method="POST">
                                                    @csrf

                                                    <div class="modal-body">
                                                        <div class="row">
                                                            <x-form-input className="col-lg-6" type="text" name="leads_name" label="Name" value="{{ $customerData->cust_name }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_email" label="Email" value="{{ $customerData->cust_email }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_telp" label="Phone Number" value="{{ $customerData->cust_telp }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_budget" label="Budget" value="IDR {{ number_format($customerData->cust_budget, 2, ',', '.') }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_localization" label="Localization" value="{{ $customerData->localization }}" disabled />
                                                            <x-form-input className="col-lg-6" type="text" name="leads_date" label="Date Submit" value="{{ \Carbon\Carbon::parse($customerData->date)->format('d F, Y') }}" disabled />

                                                            <div class="col-lg-6 text-capitalize mb-3" id="group_status_prospect">
                                                                <label for="status_prospect" class="form-label">Make It Prospect</label>
                                                                <select class="form-control" id="status_prospect" name="status_prospect">
                                                                    <option value="Yes">Yes</option>
                                                                    <option value="No" selected>No</option>
                                                                </select>

                                                                @error('status_prospect')
                                                                    <style>
                                                                        .choices__inner {
                                                                            border-color: #e96767 !important;
                                                                        }
                                                                    </style>

                                                                    <div class="alert alert-danger m-0">
                                                                        {{ $message }}
                                                                    </div>
                                                                @enderror
                                                            </div>

                                                        </div>

                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                        <button type="submit" class="btn btn-primary">Save to Prospect</button>
                                                    </div>
                                                </form>

                                            </div>
                                        </div>
                                    </div> --}}
                                    {{-- Modal Make Prospect --}}



                                </td>

                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

</div>
