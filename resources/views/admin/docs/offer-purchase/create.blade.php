@extends('admin.layouts.master')
@push('style')
    <style>
        .choices {
            margin-bottom: 0px;
        }

        #lease_duration_group {
            display: none !important;
        }
    </style>
@endpush
@section('content')
    <form action="{{ route('offer-purchase.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
        @csrf
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box">
                        <h4 class="fw-semibold mb-0">Add Property</h4>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item"><a href="javascript: void(0);">Properties </a></li>
                            <li class="breadcrumb-item active">Listing Property</li>
                        </ol>
                    </div>
                </div>
            </div>

            <div class="row">

                <div class="col-xl-6 col-lg-6">
                    {{-- -------------------------------------------------------------------------  --}}
                    {{-- Properties Select Form  --}}
                    {{-- -------------------------------------------------------------------------  --}}
                    <div class="card">
                        <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                            <h4 class="card-title text-uppercase">Property</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold">
                                        <span class="nav-icon"><iconify-icon icon="lsicon:building-outline" class="fs-18 align-middle"></iconify-icon></span> Select The Property
                                    </h5>
                                    <hr>
                                    <div class="row my-3">

                                        <div class="col-lg-12 text-capitalize mb-3" id="group_select_property">
                                            <label for="select_property" class="form-label">Choose Property</label>

                                            <select class="form-control" id="select_property" name="id_property" data-choices data-choices-sorting-false data-toggle-target="select_property">
                                                <option value="" selected disabled>Choose Property</option>
                                                @foreach ($data_property as $property)
                                                    <option value="{{ $property->id }}">
                                                        {{ $property->property_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('select_property')
                                                <style>
                                                    .choices__inner {
                                                        border-color: #e96767 !important;
                                                    }
                                                </style>

                                                <div class="alert alert-danger m-0">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <x-form-input className="col-lg-12" type="text" name="property_name" label="Property Name" disabled="true" />
                                        <x-form-input className="col-lg-12" type="text" name="property_address" label="Property Address" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="number_bathroom" label="Number Bathroom" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="number_bedroom" label="Number Bedroom" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="title_type" label="Title Type" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="remaining_lease_period" label="Remaining Lease Period" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="idr_price" label="IDR Price" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="usd_price" label="USD Price" disabled="true" />
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- -------------------------------------------------------------------------  --}}
                    {{-- Offered Price Form  --}}
                    {{-- -------------------------------------------------------------------------  --}}
                    <div class="card">
                        <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                            <h4 class="card-title text-uppercase">Offered Price</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold">
                                        <span class="nav-icon"><iconify-icon icon="solar:tag-price-bold" class="fs-18 align-middle"></iconify-icon></span> Set the Offered Price
                                    </h5>
                                    <hr>
                                    <div class="row my-3">

                                        <x-form-input className="col-lg-6" type="text" name="price_idr_price" label="IDR Price" />
                                        <x-form-input className="col-lg-6" type="text" name="price_usd_price" label="USD Price" />
                                        <x-form-input className="col-lg-6" type="text" name="price_deposit_ammount" label="Deposit Ammount" />

                                        <p id="exchange_rate_info" class="text-muted fst-italic fs-12"></p>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- -------------------------------------------------------------------------  --}}
                    {{-- Contingency Clauses Form  --}}
                    {{-- -------------------------------------------------------------------------  --}}
                    <div class="card">
                        <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                            <h4 class="card-title text-uppercase">Contingency Clauses</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold">
                                        <span class="nav-icon"><iconify-icon icon="solar:tag-price-bold" class="fs-18 align-middle"></iconify-icon></span> Contingency Clauses Checkbox
                                    </h5>
                                    <hr>

                                    <div class="form-check form-checkbox-primary mb-2">
                                        <input type="checkbox" class="form-check-input" name="satisfactory_technical_inspection" id="sastisfactory_technical_inspection">
                                        <label class="form-check-label" for="sastisfactory_technical_inspection">Satisfactory Technical Inspection</label>
                                    </div>

                                    <div class="form-check form-checkbox-primary mb-2">
                                        <input type="checkbox" class="form-check-input" name="approval_loan" id="approval_loan">
                                        <label class="form-check-label" for="approval_loan">Loan Approval</label>
                                    </div>

                                    <div class="form-check form-checkbox-primary mb-2">
                                        <input type="checkbox" class="form-check-input" name="legal_due_diligence" id="legal_due_diligence">
                                        <label class="form-check-label" for="legal_due_diligence">Legal Due Diligence</label>
                                    </div>

                                    <x-form-input className="col-lg-12 mt-4" type="text" name="others_contingency" label="Others" />

                                </div>

                            </div>

                        </div>
                    </div>

                </div>

                <div class="col-xl-6 col-lg-6">

                    {{-- -------------------------------------------------------------------------  --}}
                    {{-- Client Select Form  --}}
                    {{-- -------------------------------------------------------------------------  --}}
                    <div class="card">
                        <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                            <h4 class="card-title text-uppercase">Clients</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Select Client</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <div class="col-lg-12 text-capitalize mb-3" id="group_select_client">
                                            <label for="select_client" class="form-label">Choose Client</label>

                                            <select class="form-control" id="select_client" name="id_client" data-choices data-choices-sorting-false data-toggle-target="select_client">
                                                <option value="" selected disabled>Choose Client</option>
                                                @foreach ($data_client as $client)
                                                    <option value="{{ $client->id }}">
                                                        {{ $client->first_name . ' ' . $client->last_name }}
                                                    </option>
                                                @endforeach
                                            </select>

                                            @error('select_client')
                                                <style>
                                                    .choices__inner {
                                                        border-color: #e96767 !important;
                                                    }
                                                </style>

                                                <div class="alert alert-danger m-0">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>

                                        <x-form-input className="col-lg-6" type="text" name="client_first_name" label="Client First Name" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="client_last_name" label="Client Last Name" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="client_email" label="Client Email" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="client_phone_number" label="Phone Number" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="client_passport_number" label="Passport Number" />
                                        <x-form-input className="col-lg-6" type="text" name="client_nationality" label="Nationality" />

                                    </div>
                                </div>
                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4" id="pt_pma_group">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><iconify-icon icon="hugeicons:legal-01" class="fs-18 align-middle"></iconify-icon></span> PT PMA</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <x-form-input className="col-lg-12" type="text" name="pma_company_name" label="PMA Company Name" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="pma_first_name" label="PMA First Name" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="pma_last_name" label="PMA Last Name" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="pma_email" label="PMA Email" disabled="true" />
                                        <x-form-input className="col-lg-6" type="text" name="pma_phone_number" label="PMA Phone Number" disabled="true" />

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- ------------------------------------------------------------------------- --}}
                    {{-- Validity Form  --}}
                    {{-- -------------------------------------------------------------------------  --}}
                    <div class="card">
                        <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                            <h4 class="card-title text-uppercase">Finance</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Financing Terms</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <div class="col-lg-12 mb-2">
                                            <div class="mb-3 mt-2" bis_skin_checked="1">
                                                <div class="form-check form-check-inline" bis_skin_checked="1">
                                                    <input class="form-check-input" type="radio" name="financing_terms" id="cash_purchase" value="Cash Purchase">
                                                    <label class="form-check-label" for="cash_purchase">Cash Purchase</label>
                                                </div>
                                                <div class="form-check form-check-inline" bis_skin_checked="1">
                                                    <input class="form-check-input" type="radio" name="financing_terms" id="loan_approval" value="Subject to Loan Approval">
                                                    <label class="form-check-label" for="loan_approval">Subject to Loan Approval</label>
                                                </div>
                                            </div>
                                        </div>

                                        <hr>

                                        <x-form-input className="col-lg-12" type="text" name="loan_ammount" label="Loan Ammount" />
                                        <x-form-input className="col-lg-6" type="text" name="bank_name" label="Bank Name" />
                                        <x-form-input className="col-lg-6" type="text" name="approval_deadline" label="Approval Deadline" />

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    {{-- ------------------------------------------------------------------------- --}}
                    {{-- Validity Form  --}}
                    {{-- -------------------------------------------------------------------------  --}}
                    <div class="card">
                        <div class="card-header text-bg-primary" style="border-radius: 0px 0px 20px 0px">
                            <h4 class="card-title text-uppercase">Validity</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Offer Validity</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <x-form-input className="col-lg-12" type="text" name="offer_validity" label="Input Offer Validity" />

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <div class="mb-3 rounded">
                        <div class="row justify-content-end g-2">
                            <div class="col-lg-3">
                                <button type="submit" class="btn btn-outline-primary w-100">Create Properties</button>
                            </div>
                            <div class="col-lg-2">
                                <a href="#!" class="btn btn-danger w-100">Cancel</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
    </form>
@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script src="{{ asset('admin/assets/js/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cleave-phone.us.js') }}"></script>
    <script src="{{ asset('admin/assets/js/flatpickr-min.js') }}"></script>

    {{-- <script src="{{ asset('admin/assets/js/custom/custom-toggle.js') }}"></script> --}}
    {{-- <script src="{{ asset('admin/assets/js/custom/currency-format.js') }}"></script> --}}

    <script src="{{ asset('admin/assets/js/axios.min.js') }}"></script>

    {{-- Currency Format --}}
    <script>
        const cleaveFields = [{
                id: '#price_deposit_ammount',
                options: {
                    prefix: 'IDR '
                }
            }, {
                id: '#price_idr_price',
                options: {
                    prefix: 'IDR '
                }
            },
            {
                id: '#price_usd_price',
                options: {
                    prefix: 'USD ',
                    numeralDecimalMark: '.',
                    delimiter: ',',
                }
            }
        ];

        cleaveFields.forEach(field => {
            new Cleave(field.id, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: '$ ',
                noImmediatePrefix: true,
                numeralDecimalMark: ',',
                delimiter: '.',
                ...field.options // spread operator untuk custom config
            });
        });
    </script>

    <script>
        $(document).ready(function() {

            // Hide & Show Loan Ammount
            $('#group_loan_ammount').hide();
            $('#group_bank_name').hide();
            $('#group_approval_deadline').hide();
            $('#pt_pma_group').hide();



            $('input[name="financing_terms"]').change(function() {
                if ($('#loan_approval').is(':checked')) {
                    $('#group_loan_ammount').show();
                    $('#group_bank_name').show();
                    $('#group_approval_deadline').show();
                } else {
                    $('#group_loan_ammount').hide();
                    $('#group_bank_name').hide();
                    $('#group_approval_deadline').hide();
                }
            });

            // /* Hide & Show Loan Ammount

            // Get Dynamic Properties Data
            $('#group_remaining_lease_period').hide();

            $('#select_property').change(function() {
                let id_property = $('#select_property').val();
                $.ajax({
                    url: '/getDataProperties/' + id_property,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#property_name').val(response['data'].property_name);
                        $('#property_address').val(response['data'].property_address);
                        $('#number_bathroom').val(response['data'].bathroom);
                        $('#number_bedroom').val(response['data'].bedroom);
                        $('#title_type').val(response['data'].legal_status);

                        $('#pma_company_name').val(response['data'].company_name);
                        $('#pma_first_name').val(response['data'].rep_first_name);
                        $('#pma_last_name').val(response['data'].rep_last_name);
                        $('#pma_email').val(response['data'].rep_email);
                        $('#pma_phone_number').val(response['data'].rep_phone);

                        $('#idr_price').val(formatCurrency(response['data'].selling_price_idr, 'id-ID', 'IDR', 0));
                        $('#usd_price').val(formatCurrency(response['data'].selling_price_usd, 'en-US', 'USD'));

                        $('#price_idr_price').val(formatCurrency(response['data'].selling_price_idr, 'id-ID', 'IDR', 0));
                        $('#price_usd_price').val(formatCurrency(response['data'].selling_price_usd, 'en-US', 'USD'));


                        if (response['data'].legal_status == 'Leasehold') {
                            $('#group_remaining_lease_period').show();
                        } else {
                            $('#group_remaining_lease_period').hide();
                        }
                        $('#remaining_lease_period').val(response['data'].datasProperty);

                        if (response['data'].company_name !== null) {
                            console.log('tidak kosong')
                            $('#pt_pma_group').show();
                        } else {
                            console.log('kosong')
                            $('#pt_pma_group').hide();
                        }

                    }
                })
            })
            // /* Get Dynamic Properties Data


            // Get Dynamic Client Data
            $('#select_client').change(function() {
                let id_client = $('#select_client').val();
                console.log(id_client);
                $.ajax({
                    url: '/getDataClients/' + id_client,
                    type: 'GET',
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        $('#client_first_name').val(response['data'].first_name);
                        $('#client_last_name').val(response['data'].last_name);
                        $('#client_email').val(response['data'].email);
                        $('#client_phone_number').val(response['data'].phone_number);

                    }
                })
            })
            // /* Get Dynamic Client Data


            // Get Data Kurs/Rate
            const cacheKey = 'usd_to_idr_rate';
            const cacheTimeKey = 'usd_to_idr_time';
            const cacheTTL = 1000 * 60 * 60; // 1 jam
            const defaultKurs = 15000;

            function formatCurrency(value, locale = 'id-ID', currency = 'IDR', fractionDigits = 0) {
                return new Intl.NumberFormat(locale, {
                    style: 'currency',
                    currency: currency,
                    currencyDisplay: 'code',
                    minimumFractionDigits: fractionDigits,
                    maximumFractionDigits: fractionDigits
                }).format(value);
            }

            async function getExchangeRate() {
                const now = new Date().getTime();
                const storedRate = localStorage.getItem(cacheKey);
                const storedTime = localStorage.getItem(cacheTimeKey);

                if (storedRate && storedTime && (now - parseInt(storedTime)) < cacheTTL) {
                    return parseFloat(storedRate);
                }

                try {
                    const response = await axios.get('https://api.exchangerate-api.com/v4/latest/USD');
                    const rate = response.data.rates.IDR;
                    localStorage.setItem(cacheKey, rate);
                    localStorage.setItem(cacheTimeKey, now);
                    return rate;
                } catch (error) {
                    console.error("Gagal mengambil kurs dari API:", error);
                    return defaultKurs;
                }
            }

            // Jalankan saat halaman dimuat
            (async () => {
                const rate = await getExchangeRate();
                document.getElementById('exchange_rate_info').textContent = `1 USD = ${formatCurrency(rate, 'id-ID', 'IDR', 0)}`;
            })();

            // /* Get Data Kurs/Rate

        });
    </script>

    {{-- Convert IDR to USD --}}
    <script>
        const defaultKurs = 15000;
        const cacheKey = 'usd_to_idr_rate';
        const cacheTimeKey = 'usd_to_idr_rate_time';
        const cacheTTL = 10 * 60 * 2000; // 20 minutes

        // debounce / batasi eksekusi fungsi (ketika user ketik angka)
        function debounce(func, delay) {
            let timeout;
            return function(...args) {
                clearTimeout(timeout);
                timeout = setTimeout(() => func.apply(this, args), delay);
            };
        }

        function formatCurrency(value, locale, currency, fraction = 2) {
            return new Intl.NumberFormat(locale, {
                style: 'currency',
                currency: currency,
                currencyDisplay: 'code',
                minimumFractionDigits: fraction
            }).format(value);
        }

        async function getExchangeRate() {
            const now = new Date().getTime();
            const storedRate = localStorage.getItem(cacheKey);
            const storedTime = localStorage.getItem(cacheTimeKey);

            if (storedRate && storedTime && (now - parseInt(storedTime)) < cacheTTL) {
                return parseFloat(storedRate);
            }

            try {
                const response = await axios.get('https://api.exchangerate-api.com/v4/latest/USD');
                const rate = response.data.rates.IDR;
                localStorage.setItem(cacheKey, rate);
                localStorage.setItem(cacheTimeKey, now);
                return rate;
            } catch (error) {
                console.error("Gagal mengambil kurs dari API:", error);
                return defaultKurs;
            }
        }

        async function handleIDRInput() {

            const idrInput = document.getElementById('idr_price');
            const commissionRateInput = document.getElementById('commision_rate');
            const idrValue = parseFloat(idrInput.value.replace(/[^0-9]/g, '')) || 0;
            let commissionPercent = parseFloat(commissionRateInput.value) / 100 || 0;

            // Balimmo Properties Fees
            if (idrValue < '15000000000') {
                document.getElementById('commision_rate').value = '5%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;

            } else if (idrValue >= '15000000000' && idrValue <= '34000000000') {
                document.getElementById('commision_rate').value = '4%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;
            } else if (idrValue > '34000000000' && idrValue <= '70000000000') {
                document.getElementById('commision_rate').value = '3%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;
            } else {
                document.getElementById('commision_rate').value = '2.5%';
                commissionPercent = parseFloat(commissionRateInput.value) / 100;
            }

            if (idrValue <= 0) return;

            const rate = await getExchangeRate();
            document.getElementById('exchange_rate_info').textContent = `1 USD = ${formatCurrency(rate, 'id-ID', 'IDR', 0)}`;
            const usdValue = idrValue / rate;

            // Update USD values
            document.getElementById('usd_price').value = formatCurrency(usdValue, 'en-US', 'USD');
            document.getElementById('usd_price_raw').value = usdValue.toFixed(2);

            // Komisi & Net Seller (IDR)
            const idrCommission = idrValue * commissionPercent;
            const idrNetSeller = idrValue - idrCommission;

            document.getElementById('estimated_commision_idr').value = formatCurrency(idrCommission, 'id-ID', 'IDR', 0);
            document.getElementById('net_seller_price_idr').value = formatCurrency(idrNetSeller, 'id-ID', 'IDR', 0);

            // Komisi & Net Seller (USD)
            const usdCommission = usdValue * commissionPercent;
            const usdNetSeller = usdValue - usdCommission;
            document.getElementById('estimated_commision_usd').value = formatCurrency(usdCommission, 'en-US', 'USD');
            document.getElementById('net_seller_price_usd').value = formatCurrency(usdNetSeller, 'en-US', 'USD');
        }

        document.getElementById('idr_price').addEventListener('input', debounce(handleIDRInput, 400));
    </script>
    {{-- /* Convert IDR to USD --}}

    {{-- Flatpickr --}}
    <script>
        $("#offer_validity").flatpickr({
            dateFormat: "d-m-Y"
        });
        $("#approval_deadline").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>
    {{-- /* Flatpickr --}}
@endpush
