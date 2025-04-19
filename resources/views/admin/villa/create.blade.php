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
            
            <x-forms name="villa_name" label="Villa name" type="text"/>
            <x-forms name="price" label="Price" type="number"/>
            <x-forms name="berdroom" label="Bedroom" type="number"/>
            <x-forms name="sub_region" label="Sub Region" type="text"/>

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