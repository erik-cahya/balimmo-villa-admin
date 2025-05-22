{{-- @php
  dd($properties);
@endphp --}}
<!DOCTYPE html>
<html>
<body>
  
  <div style="display: flex; justify-content: center">

    <img style="display: flex; justify-content: center" src="https://balimmo.properties/wp-content/uploads/2025/04/logo-balimmo-properties-green.png" alt="" width="500">
  </div>
    
    <h2 style="font-weight: 700; text-align: center">Hi there 👋,</h2>
    <p style="text-align: center">here for the recommendation villa and fit with your information</p>
    
    <div style="display: flex; flex-direction: row; justify-content: center">
    @foreach ($properties as $property)
    <div style="width: 300px; border-radius: 12px; overflow: hidden; margin:10px;box-shadow: 0 4px 12px rgba(0,0,0,0.1); background: white;">

        <div style="position: relative; height: 180px; overflow: hidden;">
            <img src="https://images.unsplash.com/photo-1566073771259-6a8506099945?ixlib=rb-1.2.1&auto=format&fit=crop&w=500&q=80" alt="Villa" style="width: 100%; height: 100%; object-fit: cover;">
            <div style="position: absolute; top: 15px; right: 15px; background: rgba(0,0,0,0.7); color: white; padding: 5px 10px; border-radius: 4px; font-weight: bold; font-size: 14px;">
              IDR 200.000/malam
            </div>
        </div>

        <!-- Info Villa -->
        <div style="padding: 16px;">
            <h3 style="font-size: 18px; font-weight: 700; color: #333; margin-bottom: 6px;">{{ $property['name'] }}</h3>
            <div style="display: flex; align-items: center; font-size: 14px; color: #666; margin-bottom: 10px;">
                <span style="margin-right: 5px;">📍</span>
                <span>Sanur Denpasar, Bali</span>
            </div>
            <div style="display: flex; align-items: center; font-size: 14px; color: #555; margin-bottom: 15px;">
                <span style="margin-right: 5px;">🛏️</span>
                <span>40 Bedrooms</span>
            </div>
            <a href="#" style="display: inline-block; background: #4CAF50; color: white; padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; font-weight: 500;">Lihat Detail</a>
        </div>
    </div>
    @endforeach

  </div>
    <p style="text-align: center">Our agent will contact you, if you have question please contact us on :</p>


</body>
</html>