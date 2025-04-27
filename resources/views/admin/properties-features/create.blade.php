@extends('admin.layouts.master')
@section('content')
<div class="container-fluid">

    <!-- ========== Page Title Start ========== -->
    <div class="row">
        <div class="col-12">
            <div class="page-title-box">
                <h4 class="mb-0 fw-semibold">Customers Add</h4>
                <ol class="breadcrumb mb-0">
                    <li class="breadcrumb-item"><a href="javascript: void(0);">Real Estate</a></li>
                    <li class="breadcrumb-item active">Customers Add</li>
                </ol>
            </div>
        </div>
    </div>
    <!-- ========== Page Title End ========== -->

    <div class="row">
         

         <div class="col-xl-9 col-lg-12 ">
              
              <div class="card">
                   <div class="card-header">
                        <h4 class="card-title">Customer Information</h4>
                   </div>
                   <div class="card-body">
                        <div class="row">
                             <div class="col-lg-6">
                                  <form>
                                       <div class="mb-3">
                                            <label for="customer-name" class="form-label">Feature Name</label>
                                            <input type="text" id="customer-name" class="form-control" placeholder="Full Name">
                                       </div>
                                  </form>
                             </div>
                             <div class="col-lg-6">
                                   <div class="mb-3">
                                        <form>
                                             <label for="choices-country" class="form-label">Type Feature Form</label>
                                             <select class="form-control" id="choices-country" data-choices data-choices-groups data-placeholder="Select Country" name="choices-country">
                                                  <option value="">Choose a country</option>
                                                  <option value="text">Text</option>
                                                  <option value="option">Option</option>
                                                  <option value="radio">Radio</option>
                                             </select>
                                        </form>
                                   </div>
                             </div>
                             <div class="col-lg-6">
                              <div id="dynamic-inputs">
                                   <div class="input-group">
                                     <input type="text" class="form-control" name="answers[]" placeholder="Enter value">
                                   </div>
                                 </div>
                               
                                 <button type="button" id="add-input" class="btn btn-primary mt-2">+ Add More</button>
                                 <br><br>
                                 <button type="submit">Submit</button>
                             </div>
                         </div>
                             
                         

                        </div>
                   </div>
              </div>

              <div class="mb-3 rounded">
                   <div class="row justify-content-end g-2">
                        <div class="col-lg-2">
                             <a href="#!" class="btn btn-outline-primary w-100">Create Customer</a>
                        </div>
                        <div class="col-lg-2">
                             <a href="#!" class="btn btn-danger w-100">Cancel</a>
                        </div>
                   </div>
              </div>
         </div>
    </div>

</div>
@endsection
@push('scripts')
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>

<script>
     $(document).ready(function(){
       $('#add-input').click(function(){
         $('#dynamic-inputs').append(`
           <div class="input-group">
             <input type="text" class="form-control mt-2" name="answers[]" placeholder="Enter value">
             <button type="button" class="remove-input btn btn-danger mt-2">Remove</button>
           </div>
         `);
       });
     
       $(document).on('click', '.remove-input', function(){
         $(this).parent('.input-group').remove();
       });
     });
     </script>
@endpush