@extends('admin.layouts.master')
@section('content')
<div class="container">
  <main>
    <div class="row g-5 mt-5 justify-content-center">
      <div class="col-lg-12">
        <div class="d-flex justify-content-between align-items-center mb-3">

          {{-- <h1 class="mb-3 display-6 fw-normal text-body-emphasis">Recomendation Villas Form</h1> --}}

          <x-text-title type="display-6 fw-normal" message="Recomendation Villas"/>

          <a href="{{ route('customer.form') }}" class="btn btn-sm btn-warning">Create Customer Data</a>
        </div>
        
        <table class="table table-bordered text-center" style="font-size: 14px">
            <thead>
                <tr>
                  <th>No</th>
                  <th>Name</th>
                  <th>Telp</th>
                  <th>Email</th>
                  <th>Budget</th>
                  <th>Require Bedroom</th>
                  <th>Localization</th>
                  <th>Time</th>
                  <th>Action</th>
                </tr>
            </thead>
            <tbody>
              @foreach ($customers as $cst )  
                <tr>
                  <th scope="row">{{ $loop->iteration }}</th>
                  <td>{{ $cst->name }}</td>
                  <td>{{ $cst->telp }}</td>
                  <td>{{ $cst->email }}</td>
                  <td>{{ $cst->budget }}</td>
                  <td>{{ $cst->require_bedroom }}</td>
                  <td>{{ $cst->localization }}</td>
                  <td>{{ $cst->time }}</td>
                  <td class="align-items-center d-flex">
                      
                      @if($matchedVillas[$cst->id]->count() > 0)
                       
                        <form action="{{ route('customer.sendmail', $cst->id) }}" method="POST">
                          @csrf
                          <button type="submit" class="btn btn-sm btn-primary mx-2">Send Email</button>
                        </form>

                        <button class="btn btn-sm btn-primary toggle-villas" type="button" data-bs-toggle="collapse" data-bs-target="#villasForCustomer{{ $cst->id }}">
                            Tampilkan {{ $matchedVillas[$cst->id]->count() }} Villa
                        </button>
                      
                      @else
                          <span class="badge bg-danger">Tidak ada villa yang sesuai</span>
                      @endif
                  </td>

                </tr>
                <tr>
                  <td colspan="12">
                    <div class="collapse" id="villasForCustomer{{ $cst->id }}">
                      <div class="mt-3">
                        <div class="row">
                          @foreach($matchedVillas[$cst->id] as $villa)
                          <div class="col-lg-4">
                          <div class="card mb-2">
                              <div class="card-body">
                                  <h5 class="card-title">{{ $villa->villa_name }}</h5>
                                  <div class="row">
                                      <div class="col-md-6">
                                          <p class="mb-1"><strong>Harga:</strong> Rp {{ number_format($villa->price, 0, ',', '.') }}/malam</p>
                                          <p class="mb-1"><strong>Kamar Tidur:</strong> {{ $villa->bedroom }}</p>
                                          <p class="mb-1"><strong>Lokasi:</strong> {{ $villa->sub_region }}</p>
                                      </div>
                                      <div class="col-md-6 text-end">
                                          <a href="#" class="btn btn-sm btn-success">Pilih Villa</a>
                                      </div>
                                  </div>
                              </div>
                          </div>
                          </div>
                          @endforeach
                        </div>
                      </div>
                    </div>
                  </td>
                </tr>
              @endforeach
            </tbody>

        </table>
      </div>
    </div>

    <div class="row mt-4">
      <div class="col">
        {{-- <h4 class="mb-3">Villa Listing</h4> --}}

        <x-text-title type="display-6 fw-normal" message="Villa Listing"/>

        <table class="table table-bordered" style="font-size: 16px">
          <thead>
              <tr>
                <th>No</th>
                <th>Villa Name</th>
                <th>Price</th>
                <th>Bedroom</th>
                <th>Subregion</th>
              </tr>
          </thead>
          <tbody>
            @foreach ($villas as $vl )  
              <tr>
                <th scope="row">{{ $loop->iteration }}</th>
                <td>{{ $vl->villa_name }}</td>
                <td>{{ $vl->price }}</td>
                <td>{{ $vl->bedroom }}</td>
                <td>{{ $vl->sub_region }}</td>
              </tr>
            @endforeach
          </tbody>

      </table>
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

<script>
  // Script untuk animasi tombol toggle
  document.querySelectorAll('.toggle-villas').forEach(button => {
      button.addEventListener('click', function() {
          const icon = this.querySelector('i');
          if (icon) {
              icon.classList.toggle('ri-arrow-down-s-line');
              icon.classList.toggle('ri-arrow-up-s-line');
          } else {
              // Jika tidak ada icon, ubah teks tombol
              if (this.textContent.includes('Tampilkan')) {
                  this.textContent = this.textContent.replace('Tampilkan', 'Sembunyikan');
              } else {
                  this.textContent = this.textContent.replace('Sembunyikan', 'Tampilkan');
              }
          }
      });
  });
</script>
@endsection