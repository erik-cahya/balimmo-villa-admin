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
            <p><span class="label">Date de la visite:</span> [ .....MANUAL.... ]</p>
        </div>
        <div class="col right">
            <p><span class="label">Name of Agent:</span> [ .....MANUAL.... ]</p>
        </div>
    </div>

    <h3 style="text-align: center; margin-top: 10px;">Buyer Information 1:</h3>

    <div class="row">
        <div class="col" style="margin-left: 50px">
            <p><span class="label">Name:</span> [ .....AUTO.... ]</p>
            <p><span class="label">Surname:</span> [ .....AUTO.... ]</p>
            <p><span class="label">Phone:</span> [ .....AUTO.... ]</p>
        </div>
        <div class="col right">
            <p><span class="label">Email:</span> [ .....AUTO.... ]</p>
            <p><span class="label">N Passport:</span> [ .....MANUAL.... ]</p>
            <p><span class="label">Nationality:</span> [ .....MANUAL.... ]</p>
        </div>
    </div>

    <h3 style="text-align: center; margin-top: 10px;">Buyer Information 2 (IF COMPANY PT PMA)</h3>

    <div class="row">
        <div class="col" style="margin-left: 50px">
            <p><span class="label">Name:</span> [ .....AUTO.... ]</p>
            <p><span class="label">Surname:</span> [ .....AUTO.... ]</p>
            <p><span class="label">Phone:</span> [ .....AUTO.... ]</p>
        </div>
        <div class="col right">
            <p><span class="label">Email:</span> [ .....AUTO.... ]</p>
            <p><span class="label">N Passport:</span> [ .....MANUAL.... ]</p>
            <p><span class="label">Nationality:</span> [ .....MANUAL.... ]</p>
        </div>
    </div>

    <h3 style="text-align: center; margin-top: 10px;">Property Details</h3>

    <div class="" style="margin-left: 50px">
        <p><span class="label">Villa Name:</span> [ .....AUTO.... ]</p>
        <p><span class="label">Full Adress:</span> [ .....AUTO STREET.... ], [ .....AUTO CITY.... ], [ .....AUTO COUNTRY.... ]</p>
        <p><span class="label">Description:</span> [ .....AUTO NUMBER BEDROOM, BATHROMM, SQM AREA.... ]</p>
        <p><span class="label">Surface Land:</span> [ .....AUTO LAND.... ]</p>
    </div>

    <div style="margin-left: 50px; margin-top: 20px">
        <p><span class="label">Leasehold:</span> [ .....AUTO REST TIMES.... ]</p>
        <p><span class="label">Freehold:</span> [ .....AUTO ADD.... ]</p>
    </div>

    <h3 style="text-align: center; margin-top: 10px;">Offered Price :</h3>
    <div style="margin-left: 50px; margin-top: 20px">
        <p><span class="label">Montant en IDR / Amount in IDR:</span> [ .....ADD AUTO AFTER ASK INFORMATION.... ]</p>
        <p><span class="label">Montant en USD / Amount in USD:</span> [ .....ADD AUTO AFTER ASK INFORMATION.... ]</p>
    </div>
    <p style="text-align: center; margin-top: 10px;">*Base on IDR / $ = 16 …. (Just for information, the price will be pay on IDR ) </p>

</body>

</html>
