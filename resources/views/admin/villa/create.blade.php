@extends('admin.layouts.master')
@section('content')
<div class="container">
  <main>
    <div class="row g-5 mt-5 justify-content-center">
      <div class="col-lg-6">
        <h4 class="mb-3">Billing address</h4>
        
        <form class="needs-validation" action="{{ route('villa.store') }}" method="POST">
          @csrf
          <div class="row g-3">
            
            <div class="col-12">
              <label for="firstName" class="form-label">Villa Name</label>
              <input type="text" class="form-control" id="firstName" name="villa_name">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="firstName" class="form-label">Price</label>
              <input type="number" class="form-control" id="firstName" name="price">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="firstName" class="form-label">Bedroom</label>
              <input type="number" class="form-control" id="firstName" name="bedroom" >
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>

            <div class="col-12">
              <label for="firstName" class="form-label">Sub Region</label>
              <input type="text" class="form-control" id="firstName" name="sub_region">
              <div class="invalid-feedback">
                Valid first name is required.
              </div>
            </div>
          <hr class="my-4">

          <button class="w-100 btn btn-primary btn-lg" type="submit">Input Villa</button>
        </form>
      </div>
    </div>
  </main>

  <footer class="my-5 pt-5 text-body-secondary text-center text-small">
    <p class="mb-1">© 2017–2025 Company Name</p>
    <ul class="list-inline">
      <li class="list-inline-item"><a href="#">Privacy</a></li>
      <li class="list-inline-item"><a href="#">Terms</a></li>
      <li class="list-inline-item"><a href="#">Support</a></li>
    </ul>
  </footer>
</div>
@endsection