<x-mail::message>
# Introduction
# Hi {{ $booking->cust_name }},


Thank you for your booking!

Here are your details:

- **Email:** {{ $booking->cust_email }}
- **Phone:** {{ $booking->cust_telp }}
- **Budget:** Rp {{ number_format($booking->cust_budget, 0, ',', '.') }}
- **Location:** {{ $booking->localization }}
- **Timing:** {{ \Carbon\Carbon::parse($booking->date)->format('d M Y') }}

@if($booking->require_bedroom)
- **Required Bedroom(s):** {{ $booking->require_bedroom }}
@endif

We will contact you soon.

<x-mail::button :url="''">
Button Text
</x-mail::button>

Thanks,<br>
{{ config('app.name') }}
</x-mail::message>
