<!DOCTYPE html>
<html lang="en">

<head>
    <title>Dokumen SPK</title>
    <link rel="stylesheet" type="text/css" href="{{ public_path('bootstrap/css/bootstrap/bootstrap.css') }}">
    <script defer src="https://unpkg.com/pagedjs/dist/paged.polyfill.js"></script>
    <style type="text/css">
        html {
            padding: 0 !important;
            margin: 0 !important;
            font-family: "Times New Roman";
        }

        table,
        th,
        td {
            border-collapse: collapse;
            vertical-align: top;
        }

        .p1 {
            font-size: 11px;
        }

        .p2 {
            font-size: 11px;
            text-align: justify;
            line-height: 20px;
        }

        .p3 {
            font-size: 11px;
            text-align: center;
        }

        .p4 {
            font-size: 10px;
        }

        .inf {
            font-weight: bold;
        }

        .warning {
            font-style: italic;
            color: red;
        }

        @page {
            margin: 10mm;
        }

        body {
            line-height: 1.3;
            margin-top: 95px;
            margin-bottom: 50px;
        }

        .page-number:before {
            counter-reset: pages;
            counter-increment: pages;
            content: counter(page);
        }

        ul {
            list-style: none;
            /* Remove default list styling */
            padding: 0;
            margin-bottom: 10px;
            font-size: 11px;
            margin-left: 20px;
            text-align: justify;
        }

        li {
            margin-left: 20px;
            /* Adjust margin as needed */
            position: relative;
            font-size: 11px;
            margin-bottom: 10px;
            text-align: justify;
        }

        .header {
            position: fixed;
            top: 10px;
            width: 30%;
            height: 65px;
            margin-left: 50px;
            border: 1px solid black;
            padding-left: 5px;
            padding-bottom: 10px;
        }

        .footer {
            position: fixed;
            bottom: 0;
            width: 100%;
            height: 50px;
            font-size: 6pt;
            color: #777;
        }

        .page {
            margin-top: 10px;
            margin-bottom: 50px;
            padding: 0px 80px;
        }

        .page-number:before {
            counter-reset: pages;
            counter-increment: pages;
            content: counter(page) " of " counters(pages);
            /* content: counter(page); */
        }

        .page-number {
            text-align: right;
            color: black;
            font-size: 12px;
            font-weight: bold;
        }

        .details {
            border: 0.5px solid black;
            padding: 3px;
            border-collapse: collapse;
            width: 100%;
        }

        .details-center {
            border: 0.5px solid black;
            padding: 3px;
            border-collapse: collapse;
            font-size: 11px;
            text-align: center;
            line-height: 20px;
        }

        .details-right {
            border: 0.5px solid black;
            padding: 3px;
            border-collapse: collapse;
            font-size: 11px;
            text-align: right;
            line-height: 20px;
        }

        .details-left {
            border: 0.5px solid black;
            padding: 3px;
            border-collapse: collapse;
            font-size: 11px;
            text-align: left;
            line-height: 20px;
        }
    </style>
</head>

<body>

    <div class="content">
        <h1>Halaman 1</h1>
        <p>Ini adalah konten halaman pertama. Tambahkan konten sebanyak mungkin agar terlihat efeknya.</p>

        @for ($i = 1; $i <= 100; $i++)
            <p>Baris konten {{ $i }}</p>
        @endfor
    </div>

    <!-- Footer akan muncul di semua halaman -->
    <footer class="footer">
        <table style="width: 96%; ">
            <tr class="">
                <td width="20%">
                    <p style="text-align: right;color: black;font-size: 10px;">
                        Page <span class="page-number"></span>
                    </p>
                </td>
            </tr>
        </table>
    </footer>

</body>

</html>
