<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document Properties Visit</title>
    <style>
        body {
            /* font-family: sans-serif; */
            font-size: 14px;
        }

        .row {
            width: 100%;
        }

        .col {
            width: 40%;
            display: inline-block;
            vertical-align: top;
            /* background-color: red; */
        }

        .col.right {
            float: right;
        }

        .label {
            font-weight: bold;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }

        table,
        td,
        th {
            border: 1px solid black;
            padding: 6px;
        }

        th {
            background-color: #eee;
        }
    </style>
</head>

<body>
    <div style="text-align: center">

        <img src="{{ public_path('/admin/assets/images/logo-dark.png') }}" alt="" style="width: 300px;">
        <p>Jl. Pantai Batu Bolong No.15, Canggu, Kec. Kuta Utara,
            <br>Kabupaten Badung, Bali 80351, Indonesia
            <br>+62-85-333-777-500
        </p>
        <p><strong>Email : </strong>hello@balimmo.properties
            <br><strong>Nomor : </strong>0055/SK-Keanggotaan/DDP-AREBI/2025
        </p>
    </div>

    <div class="row">
        <div class="col" style="margin-left: 50px">
            <p><span class="label">Date de la visite:</span> [ {{ $visit_date }} ]</p>
            <p><span class="label">Name:</span> [ {{ $first_name . ' ' . $last_name }} ]</p>
            <p><span class="label">Surname:</span> [ {{ $first_name }} ]</p>
            <p><span class="label">Phone:</span> [ {{ $phone_number }} ] </p>

        </div>
        <div class="col right">
            <p><span class="label">Name of Agent:</span> [ {{ $agentData->name }} ]</p>
            <p><span class="label">Email:</span> [ {{ $agentData->email }} ]</p>
            <p><span class="label">N° Passport:</span> [............................]</p>
            <p><span class="label">Nationality:</span> [............................]</p>
        </div>
    </div>

    <h3 style="text-align: center; margin-top: 30px;">LIST VISIT OF THE DAY:</h3>

    <table>
        <thead>
            <tr>
                <th width="100">NAME VILLA</th>
                <th width="100">ADDRESS</th>
                <th width="20">PRICE IDR</th>
                <th width="20">PRICE $</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($property as $props)
                <tr>
                    <td><em>{{ $props['name'] }}</em></td>
                    <td><em>{{ $props['address'] }}</em></td>
                    <td><em>IDR {{ number_format($props['selling_price_idr'], 2, ',', '.') }}</em></td>
                    <td><em>$ {{ number_format($props['selling_price_usd'], 2, ',', '.') }}</em></td>
                </tr>
            @endforeach

        </tbody>
    </table>

    <div style="text-align: center">
        <h2>Confidentiality Clause</h2>
        <p>I, the undersigned, acknowledge having visited the above-mentioned property through BALIMMO PROPERTIES. I undertake not to contact the property owner directly, nor to negotiate or conclude any transaction concerning this property without going through the BALIMMO PROPERTIES agency. In the event of non-compliance with this commitment, I acknowledge that I will be liable for agency fees and may be prosecuted in the Denpasar (Bali) court.</p>

        <h2>Inspection Certificate</h2>
        <p>I certify that the property inspection was carried out through BALIMMO PROPERTIES.</p>

        <h2 style="margin-top: 40px">Signatures</h2>
    </div>

    <div class="row">
        <div class="col" style="margin-left: 50px">
            <p><span class="label">Visiteur :</span></p>
            <p><span class="label"></span> with mention "Accept this visit"</p>
            <p>Signature : </p>

        </div>
        <div class="col right">
            <p><span class="label">Agent Balimmo Properties : </span></p>
            <p>Agent : {{ $agentData->name }}</p>
            <p>Signature : </p>
        </div>
    </div>

</body>

</html>
