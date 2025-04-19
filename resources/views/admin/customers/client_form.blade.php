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
            

            <x-forms name="name" label="Customer Name" type="text"/>
            <x-forms name="telp" label="Telp" type="text"/>
            <x-forms name="email" label="Email" type="email"/>
            <x-forms name="budget" label="Enter Your Budget" type="number"/>
            <x-forms name="require_bedroom" label="Require Bedroom" type="number"/>
            <x-forms name="localization" label="Localization" type="text"/>
            <x-forms name="time" label="Time" type="date"/>


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