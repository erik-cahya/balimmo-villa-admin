@extends('admin.layouts.master')
@section('content')

<div class="album py-5 bg-body-tertiary">
  <div class="container">

    <a href="{{ route('villa.create') }}" class="btn btn-primary mb-3">Create Villa Listing</a>

    <div class="row row-cols-1 row-cols-sm-2 row-cols-md-3 g-3">
      
      @foreach ($data_villa as $villa)
        
      <div class="col">
        <div class="card shadow-sm">
          <svg class="bd-placeholder-img card-img-top" width="100%" height="225" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: Thumbnail" preserveAspectRatio="xMidYMid slice"><title>Placeholder</title><rect width="100%" height="100%" fill="#55595c"></rect><text x="50%" y="50%" fill="#eceeef" dy=".3em">Thumbnail</text></svg>
          <div class="card-body">
          <h4>{{ $villa->villa_name }} | {{ $villa->sub_region }}</h4>

            <p class="card-text">Price : {{ $villa->price }}</p>
            <p class="card-text">Bedroom : {{ $villa->bedroom }}</p>
            
            <div class="d-flex justify-content-between align-items-center">
              <div class="btn-group">
                <button type="button" class="btn btn-sm btn-outline-secondary">View</button>
                <button type="button" class="btn btn-sm btn-outline-secondary">Edit</button>
              </div>
              <small class="text-body-secondary">9 mins</small>
            </div>
          </div>
        </div>
      </div>
      @endforeach

     

      
      

    </div>
  </div>
</div>

@endsection