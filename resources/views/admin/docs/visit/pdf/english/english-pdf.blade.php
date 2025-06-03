<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
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
            <p><span class="label">Date de la visite:</span> [....DATE OF PRINT...]</p>
            <p><span class="label">Name:</span> [..........AUTO............]</p>
            <p><span class="label">Surname:</span> [..........AUTO............]</p>
            <p><span class="label">Phone:</span> [..........AUTO............]</p>
        </div>
        <div class="col right">
            <p><span class="label">Name of Agent:</span> [..........AUTO............]</p>
            <p><span class="label">Email:</span> [..........AUTO............]</p>
            <p><span class="label">N° Passport:</span> [..........MANUAL............]</p>
            <p><span class="label">Nationality:</span> [..........MANUAL............]</p>
        </div>
    </div>

    <h3 style="text-align: center; margin-top: 30px;">LIST VISIT OF THE DAY:</h3>

    <table>
        <thead>
            <tr>
                <th>NAME VILLA</th>
                <th>ADDRESS</th>
                <th>PRICE IDR</th>
                <th>PRICE $</th>
            </tr>
        </thead>
        <tbody>
            {{-- @foreach ($villas as $villa)
                <tr>
                    <td><em>{{ $villa->name }}</em></td>
                    <td><em>{{ $villa->address }}</em></td>
                    <td>{{ number_format($villa->price_idr, 0, ',', '.') }} IDR</td>
                    <td><em>{{ number_format($villa->price_usd, 0, ',', '.') }}$</em></td>
                </tr>
            @endforeach --}}

            <tr>
                <td><em>Grand Villa Ubud</em></td>
                <td><em>Grand Villa Ubud</em></td>
                <td><em>Grand Villa Ubud</em></td>
                <td><em>Grand Villa Ubud</em></td>

            </tr>

        </tbody>
    </table>

</body>

</html>
