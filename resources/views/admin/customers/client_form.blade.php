@extends('admin.layouts.master')
@section('content')
<div class="container">
  <main>
    <div class="row g-5 mt-5 justify-content-center">
      <div class="col-lg-6">
        <h4 class="mb-3">Recomendation Villas Form</h4>
        
        <form class="needs-validation" action="{{ route('customer.store') }}" method="POST">
          @csrf
          <div class="row g-3">
            
            <div class="col-12">
              <label for="name" class="form-label">Customer Name</label>
              <input type="text" class="form-control" id="name" name="name">
            </div>
            
            <div class="col-12">
              <label for="telp" class="form-label">Telp</label>
              <input type="text" class="form-control" id="telp" name="telp">
            </div>
            <div class="col-12">
              <label for="email" class="form-label">Email</label>
              <input type="text" class="form-control" id="email" name="email">
            </div>
            <div class="col-12">
              <label for="budget" class="form-label">Budget</label>
              <input type="number" class="form-control" id="budget" name="budget">
            </div>

            <div class="col-12">
              <label for="require_bedroom" class="form-label">Require Bedroom</label>
              <input type="number" class="form-control" id="require_bedroom" name="require_bedroom">
            </div>

            <div class="col-12">
              <label for="localization" class="form-label">Localization</label>
              <input type="text" class="form-control" id="localization" name="localization">
            </div>

            <div class="col-12">
              <label for="time" class="form-label">Time</label>
              <input type="date" class="form-control" id="time" name="time">
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