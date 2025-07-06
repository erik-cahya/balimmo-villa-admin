@php

    // dd($properties)
    foreach ($properties as $props) {
        return $property = $props->first();
    }

@endphp
<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Villa Recommendation</title>
</head>

<body style="font-family: Arial, sans-serif; background-color: #f6f6f6; margin: 0; padding: 20px;">

    @if ($properties->count() >= 1)
        <!-- Header -->
        <div style="text-align: center; margin-bottom: 40px;">
            <img src="{{ asset('admin') }}/assets/images/logo-dark.png" alt="Logo" width="200">
            <h2 style="margin-top: 30px;">Hi there 👋,</h2>
            <p style="color: #555;">Here are some villa recommendations that fit your needs.</p>
        </div>

        <!-- Wrapper -->
        <div style="max-width: 640px; margin: 0 auto;">
            <!-- Container for properties -->
            <div style="font-size: 0;">
                @foreach ($properties as $props)
                    @php
                        $propderty = $props->first();
                        dd($property);
                    @endphp
                    {{-- {{ dd($property->featuredImage->image_path) }} --}}
                    {{-- ============================================== --}}
                    <div style="display: inline-block; vertical-align: top; width: 300px; margin: 10px; background: #fff; border-radius: 10px; box-shadow: 0 4px 12px rgba(0,0,0,0.1); overflow: hidden;">
                        <!-- Image -->
                        <div style="position: relative;">
                            <img src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="Villa Image" style="width: 100%; height: 180px; object-fit: cover;">

                            <div style="margin-top:6px; background: rgba(0,0,0,0.7); color: white; padding: 4px 8px; border-radius: 4px; font-size: 14px;">
                                IDR {{ $property->selling_price_idr }}
                            </div>
                            <div style="margin-top:6px; background: rgba(0,0,0,0.7); color: white; padding: 4px 8px; border-radius: 4px; font-size: 14px;">
                                USD {{ $property->selling_price_usd }}
                            </div>
                        </div>

                        <!-- Info -->
                        <div style="padding: 15px;">
                            <h3 style="font-size: 16px; color: #333; margin: 0 0 6px;">{{ $property->property_name }}</h3>
                            <p style="font-size: 14px; color: #666; margin: 0 0 8px;">📍 {{ $property->property_address }}</p>
                            <p style="font-size: 13px; color: #555; margin: 0 0 12px;">
                                🛏️ {{ $property->bedroom }} Bedroom &nbsp;&nbsp; 🚿 {{ $property->bathroom }} Bathroom
                            </p>
                            <a href="{{ route('landing-page.listing.detail', $property->property_slug) }}" style="display: inline-block; background-color: #4CAF50; color: white; padding: 8px 12px; text-decoration: none; border-radius: 6px; font-size: 13px;">See Detail</a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    @else
        <div style="text-align: center; margin-bottom: 40px;">
            <img src="{{ asset('admin') }}/assets/images/logo-dark.png" alt="Logo" width="200">
            <h2 style="margin-top: 30px;">Hi there 👋,</h2>
            <p style="color: #555;">
                We couldn't find any villas that match your selected budget and location. <br> You can try widening your criteria or contact us — our team would be happy to assist you in finding the perfect villa.
            </p>

            <a href="#" style="display: inline-block; background-color: #4CAF50; color: white; padding: 8px 12px; text-decoration: none; border-radius: 6px; font-size: 13px;">Contact US</a>

        </div>
    @endif

    <!-- Footer -->
    <div style="text-align: center; font-size: 12px; color: #999; margin-top: 40px;">
        &copy; {{ date('Y') }} Balimmo Properties. All rights reserved.
    </div>

</body>

</html>
