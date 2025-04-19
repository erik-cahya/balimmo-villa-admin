<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Bootstrap demo</title>
    {{-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous"> --}}

  </head>
  <body>
    <link rel="stylesheet" href="{{ asset('styles/bootstrap.min.css') }}">
    <div class="px-4 py-5 my-5 text-center">
      <img class="d-block mx-auto mb-4" src="https://balimmo.properties/wp-content/uploads/2025/04/logo-balimmo-properties-green.png" alt="" width="500">
      <h2 class="display-6 fw-bold text-body-emphasis">Hi there 👋,</h2>
      
      <div class="col-lg-6 mx-auto">
        <p class="lead mb-4">here for the recommendation villa and fit with your information</p>
        
        <div class="row row-cols-1 row-cols-md-2 mb-3 text-center">
          
          @foreach ($villaData as $villa)
            
          <div class="col">
            <div class="card mb-4 rounded-3 shadow-sm border-primary">
              <div class="card-header py-3 text-bg-primary border-primary">
                <h4 class="my-0 fw-normal">{{ $villa->villa_name }}</h4>
              </div>
              <div class="text-center">
                <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" class="rounded mx-auto d-block" alt="..." width="200">
              </div>
              <div class="card-body">
                <h2 class="card-title pricing-card-title">Rp {{ number_format($villa->price, 0, ',', '.') }}<small class="text-body-secondary fw-light fs-6">/night</small></h2>
                <hr>
                <ul class="list-unstyled mt-3 mb-4">
                  <li>Bedrooms : {{ $villa->bedroom }}</li>
                  <li>Region : {{ $villa->sub_region }}</li>
                </ul>
                <a href="#" class="w-100 btn btn-lg btn-primary">Contact us</a>
              </div>
            </div>
          </div>
          
          @endforeach
        </div>

        
        <p class="lead mb-4">Our agent will contact you, if you have question please contact us on :</p>

        <div class="d-grid gap-2 d-sm-flex justify-content-sm-center">
          
          <a href="#" class="btn btn-primary btn-lg px-4 gap-3">WhatsApp Us</a>
          <a href="#" class="btn btn-primary btn-lg px-4 gap-3">Email Us</a>
        </div>
      </div>
    </div>
    

    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.min.js" integrity="sha384-VQqxDN0EQCkWoxt/0vsQvZswzTHUVOImccYmSyhJTp7kGtPed0Qcx8rK9h9YEgx+" crossorigin="anonymous"></script>
 
    @yield('scripts')
  </body>
</html>