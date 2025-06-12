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
            <p><span class="label">Date de la visite:</span> ................................</p>
        </div>
        <div class="col right">
            <p><span class="label">Name of Agent:</span> ................................</p>
        </div>
    </div>

    <h2 style="text-align: center; margin-top: 30px; font-size: 18px;">Buyer Information 1:</h2>

    <div class="row">
        <div class="col" style="margin-left: 50px">
            <p><span class="label">Name:</span> {{ $docs_offering->first_name . ' ' . $docs_offering->last_name }}</p>
            <p><span class="label">Surname:</span> {{ $docs_offering->last_name }}</p>
            <p><span class="label">Phone:</span> {{ $docs_offering->phone_number }}</p>
        </div>
        <div class="col right">
            <p><span class="label">Email:</span> {{ $docs_offering->email }}</p>
            <p><span class="label">N Passport:</span> {{ $docs_offering->client_passport_number }} </p>
            <p><span class="label">Nationality:</span> {{ $docs_offering->client_nationality }} </p>
        </div>
    </div>

    @if ($docs_offering->company_name !== null)
        <h3 style="text-align: center; margin-top: 30px; font-size: 18px;">Buyer Information 2 (IF COMPANY PT PMA)</h3>

        <div class="row">
            <div class="col" style="margin-left: 50px">
                <p><span class="label">Name:</span> {{ $docs_offering->company_name }} </p>
                <p><span class="label">Surname:</span> {{ $docs_offering->rep_first_name . ' ' . $docs_offering->rep_last_name }} </p>
                <p><span class="label">Phone:</span> {{ $docs_offering->rep_phone }} </p>
            </div>
            <div class="col right">
                <p><span class="label">Email:</span> {{ $docs_offering->rep_email }} </p>
                <p><span class="label">N Passport:</span> ................................</p>
                <p><span class="label">Nationality:</span> ................................</p>
            </div>
        </div>
    @endif

    <h2 style="text-align: center; margin-top: 30px; font-size: 18px;">Property Details</h2>

    <div class="" style="margin-left: 50px">
        <p><span class="label">Villa Name:</span> {{ $docs_offering->property_name }} </p>
        <p><span class="label">Full Adress:</span> {{ $docs_offering->property_address . ', ' . $docs_offering->sub_region . ', ' . $docs_offering->region }}</p>
        <p><span class="label">Description:</span> Bedroom : {{ $docs_offering->bedroom }} | Bathroom : {{ $docs_offering->bathroom }} | Villa Area : {{ $docs_offering->villa_area }} m²
        <p>
        <p><span class="label">Surface Land:</span> {{ $docs_offering->total_land_area }} m²</p>
    </div>

    <div style="margin-left: 50px;">
        @if ($docs_offering->legal_status == 'Leasehold')
            <p><span class="label">Leasehold:</span> {{ $docs_offering->rest_times }}</p>
        @else
            <p><span class="label">Freehold:</span> {{ \Carbon\Carbon::parse($docs_offering->purchase_date)->format('d F, Y') }}</p>
        @endif
    </div>

    <h2 style="text-align: center; margin-top: 30px; font-size: 18px;">Offered Price :</h2>
    <div style="margin-left: 50px; margin-top: 20px">
        <p><span class="label">Montant en IDR / Amount in IDR:</span> IDR {{ number_format($docs_offering->idr_price, 0, ',', '.') }}</p>
        <p><span class="label">Montant en USD / Amount in USD:</span> USD {{ number_format($docs_offering->usd_price, 0, ',', '.') }}</p>
    </div>
    <p style="text-align: center; margin-top: 10px;">*Base on IDR / $ = {{ $docs_offering->usdRates }} (Just for information, the price will be pay on IDR ) </p>

    <h2 style="text-align: center; margin-top: 10px; page-break-before: always; font-size: 18px;">Financing Terms :</h2>

    <div style="margin-left: 50px; margin-top: 20px">
        <input type="checkbox" {{ $docs_offering->financing_terms == 'Cash Purchase' ? 'checked' : '' }} style="vertical-align: middle;">
        <label for="vehicle1" style="vertical-align: middle;"> Cash Purchase ready</label><br>
        <input type="checkbox" {{ $docs_offering->financing_terms == 'Subject to Loan Approval' ? 'checked' : '' }} style="vertical-align: middle;">
        <label for="vehicle1" style="vertical-align: middle;"> Subject to Loan Approval</label><br>
    </div>
    <div style="margin-left: 50px">
        <ul>
            <li style="margin-top: 10px">Loan Ammount : {{ $docs_offering->loan_ammount !== null ? number_format($docs_offering->loan_ammount, 2, ',', '.') : '......................................................................................' }}</li>
            <li style="margin-top: 10px">Bank : {{ $docs_offering->bank_name !== null ? $docs_offering->bank_name : '......................................................................................' }}</li>
            <li style="margin-top: 10px">Approval Deadline : {{ $docs_offering->approval_deadline !== null ? \Carbon\Carbon::parse($docs_offering->approval_deadline)->format('d F, Y') : '......................................................................................' }}</li>
        </ul>

        <p><span class="label">Déposit proposition :</span> IDR {{ number_format($docs_offering->deposit_ammount, 0, ',', '.') }}</p>

    </div>

    <h2 style="text-align: center; margin-top: 10px; font-size: 18px;">Contingency Clauses</h2>
    <div style="margin-left: 50px; margin-top: 20px">
        <input type="checkbox" style="vertical-align: middle;" {{ $docs_offering->satisfactory_technical_inspection == 1 ? 'checked' : '' }}>
        <label for="vehicle1" style="vertical-align: middle;"> Satisfactory Technical Inspection</label><br>
        <input type="checkbox" style="vertical-align: middle;" {{ $docs_offering->loan_approval == 1 ? 'checked' : '' }}>
        <label for="vehicle1" style="vertical-align: middle;"> Loan Approval</label><br>
        <input type="checkbox" style="vertical-align: middle;" {{ $docs_offering->legal_due_diligence == 1 ? 'checked' : '' }}>
        <label for="vehicle1" style="vertical-align: middle;"> Legal Due Diligence</label><br>
        <input type="checkbox" style="vertical-align: middle;" {{ $docs_offering->others_contingency !== null ? 'checked' : '' }}>
        <label for="vehicle1" style="vertical-align: middle;"> Autres / Others:</label><br>

        <p style="font-weight: bold"> {{ $docs_offering->others_contingency !== null ? $docs_offering->others_contingency : '............................................................................................................................................................................................' }} </p>
    </div>


    <h2 style="text-align: center; margin-top: 10px; font-size: 18px;">Offer Validity Period</h2>
    <div style="margin-left: 50px; margin-top: 20px">
        <p>This offer is valid until : {{ \Carbon\Carbon::parse($docs_offering->offer_validity)->format('d / m / Y') }} </p>
    </div>

    <h2 style="text-align: center; margin-top: 10px; font-size: 18px;">Signature</h2>
    <div style=" margin-top: 20px">
        <p style="text-align: center; margin-top: 10px;">Signature preceded by the statement "Good for purchase"</p>
        <p style="text-align: center; margin-top: 10px;">Signed in: [..................................................], on: [........../........../..........]</p>
    </div>


    <h2 style="text-align: center; margin-top: 10px; page-break-before: always;">Seller's Response / Tanggapan Penjual</h2>
    <p style="text-align: center"><strong>Property:</strong> [Property Name / Nama Properti] : {{ $docs_offering->property_name }}</p>

    <div style="margin-top: 20px; border: 1px solid #000000; padding: 12px">
        <input type="checkbox" style="vertical-align: middle;">
        <label for="vehicle1" style="vertical-align: middle; font-size: 18px; font-weight: bold"> Acceptance of the Offer / Penerimaan Penawaran</label><br>
        <p>I, the undersigned seller, hereby accept the purchase offer as presented by the buyer.
            <br>Saya, penjual yang bertanda tangan di bawah ini, dengan ini menerima penawaran pembelian seperti yang diajukan oleh pembeli.
        </p>
    </div>

    <div style="margin-top: 20px; border: 1px solid #000000; padding: 12px">
        <input type="checkbox" style="vertical-align: middle;">
        <label for="vehicle1" style="vertical-align: middle; font-size: 18px; font-weight: bold"> Conditional Acceptance / Penerimaan Bersyarat</label><br>
        <p>I, the undersigned seller, accept the purchase offer under the following condition(s)
            <br>Saya, penjual yang bertanda tangan di bawah ini, menerima penawaran pembelian dengan syarat berikut:
        </p>
        <ul>
            <li style="margin-top: 10px">Loan Ammount : [Specify condition(s) / Sebutkan syarat] : </li>

        </ul>
    </div>

    <div style="margin-top: 20px; border: 1px solid #000000; padding: 12px">
        <input type="checkbox" style="vertical-align: middle;">
        <label for="vehicle1" style="vertical-align: middle; font-size: 18px; font-weight: bold"> Counter-Offer / Penawaran Balik</label><br>
        <p>I, the undersigned seller, propose the following counter-offer:
            <br>Saya, penjual yang bertanda tangan di bawah ini, mengajukan penawaran balik sebagai berikut:
        </p>
        <p style="font-weight: bold">Price in IDR / Harga dalam IDR: </p>
        <p style="font-weight: bold">Price in IDR / Harga dalam USD: </p>
        <p>This counter-offer is valid until: </p>
        <p>Penawaran balik ini berlaku hingga: </p>
    </div>

    <div style="margin-top: 20px; border: 1px solid #000000; padding: 12px">
        <input type="checkbox" style="vertical-align: middle;">
        <label for="vehicle1" style="vertical-align: middle; font-size: 18px; font-weight: bold"> Refusal of the Offer / Penolakan Penawaran</label><br>
        <p>I, the undersigned seller, hereby decline the purchase offer presented by the buyer.
            <br>Saya, penjual yang bertanda tangan di bawah ini, dengan ini menolak penawaran pembelian yang diajukan oleh pembeli
        </p>

    </div>

    <h2 style="font-size: 20px; text-align: center; margin-top: 30px;">Seller's Signature / Tanda Tangan Penjual</h2>
    <p>Signed in / Ditandatangani di: </p>
    <p>Date / Tanggal : </p>
    <p style="font-weight: bold">Name / Nama : </p>
    <p style="font-weight: bold">Signature / Tanda Tangan : </p>










</body>

</html>
