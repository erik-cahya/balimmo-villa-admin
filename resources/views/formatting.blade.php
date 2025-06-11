<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <!-- Date Formatting -->
    {{ \Carbon\Carbon::parse($client->created_at)->format('d F, Y') }}

    {{-- Price Formatting --}}
    {{ number_format($property->selling_price_idr, 2, ',', '.') }}

    {{-- Number Phone Formatting  --}}
    {{ implode('-', str_split(preg_replace('/\D/', '', $client->phone_number), 4)) }}

    {{-- String Limitter --}}
    {{ Str::limit($dt_surat->alamat_tuk, 50) }}

    @php
        // If Master : get all data
        $data['data_client'] = Auth::user()->role == 'Master' ? ClientModel::get() : ClientModel::where('reference_code', Auth::user()->reference_code)->get();
    @endphp
</body>

</html>
