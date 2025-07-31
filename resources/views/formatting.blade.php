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

    {{-- Make First Name & Last Name --}}
    @php
        $fullName = $dataLeads->cust_name;
        $parts = explode(' ', $fullName);

        $firstName = array_shift($parts);
        $lastName = implode(' ', $parts);

        ClientModel::create([
            'reference_code' => Auth::user()->reference_code,
            'first_name' => $firstName,
            'last_name' => $lastName,
            'email' => $dataLeads->cust_email,
            'phone_number' => $dataLeads->cust_telp,
        ]);
    @endphp

    @php
        // If Master : get all data
        $data['data_client'] = Auth::user()->role == 'Master' ? ClientModel::get() : ClientModel::where('reference_code', Auth::user()->reference_code)->get();
    @endphp

    {{-- Cleave / Formatting Currency --}}
    <script>
        const cleaveFields = [
            '#budget_usd_min',
            '#budget_usd_max',
            '#budget_idr_min',
            '#budget_idr_max',
        ];

        cleaveFields.forEach(selector => {
            const isIDR = selector.includes('_idr_');
            const options = isIDR ? {
                prefix: 'IDR ',
                numeral: true
            } : {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: '$ ',
                noImmediatePrefix: true,
                numeralDecimalMark: '.',
                delimiter: ',',
            };

            new Cleave(selector, options);
        });
    </script>
</body>

</html>
