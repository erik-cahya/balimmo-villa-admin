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
    <form action="{{ route('properties.store') }}" method="POST" enctype="multipart/form-data" id="galleryForm">
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
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Select The Property</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <div class="col-lg-12 text-capitalize mb-3" id="group_select_property">
                                            <label for="select_property" class="form-label">Choose Property</label>

                                            <select class="form-control" id="select_property" name="select_property" data-choices data-choices-sorting-false data-toggle-target="select_property">
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

                                        <x-form-input className="col-lg-12" type="text" name="property_name" label="Property Name" />
                                        <x-form-input className="col-lg-12" type="text" name="property_address" label="Property Address" />
                                        <x-form-input className="col-lg-6" type="text" name="number_bathroom" label="Number Bathroom" />
                                        <x-form-input className="col-lg-6" type="text" name="number_bedroom" label="Number Bedroom" />
                                        <x-form-input className="col-lg-6" type="text" name="title_type" label="Title Type" />
                                        <x-form-input className="col-lg-6" type="text" name="remaining_lease_period" label="Remaining Lease Period" />
                                        <x-form-input className="col-lg-6" type="text" name="idr_price" label="IDR Price" />
                                        <x-form-input className="col-lg-6" type="text" name="usd_price" label="USD Price" />

                                    </div>
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
                            <h4 class="card-title text-uppercase">Property</h4>
                        </div>
                        <div class="card-body">
                            <div class="row">

                                <div class="bg-light-subtle border-dark mb-4 rounded border px-3 pt-4">
                                    <h5 class="text-dark fw-semibold"><span class="nav-icon"><i class="ri-user-line"></i></span> Select Client</h5>
                                    <hr>
                                    <div class="row my-3">

                                        <div class="col-lg-12 text-capitalize mb-3" id="group_select_client">
                                            <label for="select_client" class="form-label">Choose Client</label>

                                            <select class="form-control" id="select_client" name="select_client" data-choices data-choices-sorting-false data-toggle-target="select_client">
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

                                        <x-form-input className="col-lg-6" type="text" name="client_first_name" label="Client First Name" />
                                        <x-form-input className="col-lg-6" type="text" name="client_last_name" label="Client Last Name" />
                                        <x-form-input className="col-lg-6" type="text" name="client_email" label="Client Email" />
                                        <x-form-input className="col-lg-6" type="text" name="client_phone_number" label="Phone Number" />

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
    <script src="{{ asset('admin/assets/js/custom/currency-format.js') }}"></script>

    <script src="{{ asset('admin/assets/js/axios.min.js') }}"></script>

    {{-- Get Dynamic Data --}}
    <script>
        $(document).ready(function() {
            $('#group_remaining_lease_period').hide();

            $('#select_property').change(function() {
                let id_property = $('#select_property').val();
                // console.log(id_property);
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
                        $('#idr_price').val(response['data'].selling_price_idr);
                        $('#usd_price').val(response['data'].selling_price_usd);
                        if (response['data'].legal_status == 'Leasehold') {
                            $('#group_remaining_lease_period').attr('style', 'display: block !important');
                        } else {
                            $('#group_remaining_lease_period').hide();
                        }
                        $('#remaining_lease_period').val(response['data'].datasProperty);

                    }
                })
            })

            $('#select_client').change(function() {
                let id_client = $('#select_client').val();
                console.log(id_client);
                // $.ajax({
                //     url: '/getDataProperties/' + id_client,
                //     type: 'GET',
                //     dataType: 'json',
                //     success: function(response) {
                //         console.log(response);
                //         $('#property_name').val(response['data'].property_name);
                //         $('#property_address').val(response['data'].property_address);
                //         $('#number_bathroom').val(response['data'].bathroom);
                //         $('#number_bedroom').val(response['data'].bedroom);
                //         $('#title_type').val(response['data'].legal_status);
                //         $('#idr_price').val(response['data'].selling_price_idr);
                //         $('#usd_price').val(response['data'].selling_price_usd);
                //         if (response['data'].legal_status == 'Leasehold') {
                //             $('#group_remaining_lease_period').attr('style', 'display: block !important');
                //         } else {
                //             $('#group_remaining_lease_period').hide();
                //         }
                //         $('#remaining_lease_period').val(response['data'].datasProperty);

                //     }
                // })
            })
        });
    </script>

    {{-- Custom Toggle --}}
    <script>
        $(document).ready(function() {
            // Sembunyikan semua grup toggle
            $('.toggle-group').hide();

            // Handle semua toggle sekaligus
            $('[data-toggle-target]').on('change', function() {
                const target = $(this).data('toggle-target');
                const showCondition = $(this).val() === 'yes' || $(this).val() === 'Yes'; // Sesuaikan dengan value Anda

                $(target).toggle(showCondition);
            });
        });

        $(document).ready(function() {

            $('#leasehold_group').hide();
            $('#freehold_group').hide();
            $('#extension_leasehold_group').hide();

            // Cek nilai old dari server
            const oldLegalCategory = "{{ old('legal_category') }}";

            console.log(oldLegalCategory);

            if (oldLegalCategory === 'Leasehold') {
                $('#leasehold_group').attr('style', 'display: block !important');
                $('#freehold_group').attr('style', 'display: none !important');
                $('#extension_leasehold_group').attr('style', 'display: block !important');
            } else if (oldLegalCategory === 'Freehold') {
                $('#leasehold_group').attr('style', 'display: none !important');
                $('#freehold_group').attr('style', 'display: block !important');
                $('#extension_leasehold_group').attr('style', 'display: none !important');
            }

            // Saat user mengganti pilihan
            $('#legal_category').on('change', function() {
                if ($(this).val() === 'Leasehold') {
                    $('#leasehold_group').attr('style', 'display: block !important');
                    $('#freehold_group').attr('style', 'display: none !important');
                    $('#extension_leasehold_group').attr('style', 'display: block !important');
                } else {
                    $('#leasehold_group').attr('style', 'display: none !important');
                    $('#freehold_group').attr('style', 'display: block !important');
                    $('#extension_leasehold_group').attr('style', 'display: none !important');
                }
            });
        });
    </script>
    {{-- /* Custom Toggle */ --}}

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

    <script>
        $("#leasehold_start_date").flatpickr({
            dateFormat: "d-m-Y"
        });
        $("#leasehold_end_date").flatpickr({
            dateFormat: "d-m-Y"
        });
        $("#freehold_purchase_date").flatpickr({
            dateFormat: "d-m-Y"
        });
        $("#leasehold_deadline_payment").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>
@endpush
