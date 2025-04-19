@extends('admin.layouts.master')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">Daftar Customer dengan Rekomendasi Villa</h4>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Nama Customer</th>
                                    <th>Kontak</th>
                                    <th>Lokasi</th>
                                    <th>Budget</th>
                                    <th>Kamar Dibutuhkan</th>
                                    <th>Villa yang Cocok</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($customers as $customer)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $customer->name }}</td>
                                    <td>
                                        {{ $customer->telp }}<br>
                                        {{ $customer->email }}
                                    </td>
                                    <td>{{ $customer->localization }}</td>
                                    <td>Rp {{ number_format($customer->budget, 0, ',', '.') }}</td>
                                    <td>{{ $customer->require_bedroom }} Kamar</td>
                                    <td>
                                        @if($matchedVillas[$customer->id]->count() > 0)
                                            <button class="btn btn-sm btn-primary toggle-villas" 
                                                    type="button" 
                                                    data-bs-toggle="collapse" 
                                                    data-bs-target="#villasForCustomer{{ $customer->id }}">
                                                Tampilkan {{ $matchedVillas[$customer->id]->count() }} Villa
                                            </button>
                                            
                                            <div class="collapse" id="villasForCustomer{{ $customer->id }}">
                                                <div class="mt-3">
                                                    @foreach($matchedVillas[$customer->id] as $villa)
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
                                                    @endforeach
                                                </div>
                                            </div>
                                        @else
                                            <span class="badge bg-danger">Tidak ada villa yang sesuai</span>
                                        @endif
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

    <div class="row mt-4">
      <div class="col">
        <h4 class="mb-3">Villa Listing</h4>
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
                <td>Rp. {{ number_format($vl->price, 0, ',', '.') }}</td>
                <td>{{ $vl->bedroom }}</td>
                <td>{{ $vl->sub_region }}</td>
              </tr>
            @endforeach
          </tbody>

      </table>
      </div>
    </div>
</div>
@endsection

@section('scripts')
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