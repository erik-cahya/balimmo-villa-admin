@extends('landing.layouts.master')
@section('title', 'Villas for sale in Bali | Find the best opportunities')
@section('meta_description', 'Explore our selection of villas for sale in Bali. Exceptional properties, tested for you. Find the perfect investment or holiday home today.')

@section('content')
    <!-- Breadcrumb section -->
    <section class="breadcrumb__section section--padding">
        <div class="container">
            <div class="breadcrumb__content text-center" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <h1 class="breadcrumb__title h2"><span>Listing</span> Page</h1>
                <ul class="breadcrumb__menu d-flex justify-content-center">
                    <li class="breadcrumb__menu--items"><a class="breadcrumb__menu--link" href="/">Home</a></li>
                    <li><span><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.22321 4.65179C5.28274 4.71131 5.3125 4.77976 5.3125 4.85714C5.3125 4.93452 5.28274 5.00298 5.22321 5.0625L1.0625 9.22321C1.00298 9.28274 0.934524 9.3125 0.857143 9.3125C0.779762 9.3125 0.71131 9.28274 0.651786 9.22321L0.205357 8.77679C0.145833 8.71726 0.116071 8.64881 0.116071 8.57143C0.116071 8.49405 0.145833 8.4256 0.205357 8.36607L3.71429 4.85714L0.205357 1.34821C0.145833 1.28869 0.116071 1.22024 0.116071 1.14286C0.116071 1.06548 0.145833 0.997023 0.205357 0.9375L0.651786 0.491071C0.71131 0.431547 0.779762 0.401785 0.857143 0.401785C0.934524 0.401785 1.00298 0.431547 1.0625 0.491071L5.22321 4.65179Z" fill="#706C6C" />
                            </svg>
                        </span></li>
                    <li><span class="breadcrumb__menu--text">Listing Page </span></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section .\ -->

    <!-- Listing page section -->
    <section class="listing__page--section section--padding">
        <div class="container">
            <div class="row column-reverse-md">
                <div class="col-lg-4">

                    <div class="listing__widget">
                        <div class="widget__search mb-30" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                            <div class="widget__search--input position-relative">
                                <input class="widget__search--input__field" id="search_props" placeholder="Search property" type="text">
                                <span class="widget__search--btn"><svg width="16" height="17" viewBox="0 0 15 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path
                                            d="M9.10714 9.54464C9.89286 8.75893 10.2857 7.81548 10.2857 6.71429C10.2857 5.61309 9.89286 4.67262 9.10714 3.89286C8.32738 3.10714 7.38691 2.71428 6.28571 2.71428C5.18452 2.71428 4.24107 3.10714 3.45536 3.89286C2.6756 4.67262 2.28571 5.61309 2.28571 6.71429C2.28571 7.81548 2.6756 8.75893 3.45536 9.54464C4.24107 10.3244 5.18452 10.7143 6.28571 10.7143C7.38691 10.7143 8.32738 10.3244 9.10714 9.54464ZM14.8571 14.1429C14.8571 14.4524 14.744 14.7202 14.5179 14.9464C14.2917 15.1726 14.0238 15.2857 13.7143 15.2857C13.3929 15.2857 13.125 15.1726 12.9107 14.9464L9.84822 11.8929C8.78274 12.631 7.59524 13 6.28571 13C5.43452 13 4.61905 12.8363 3.83929 12.5089C3.06548 12.1756 2.39583 11.7292 1.83036 11.1696C1.27083 10.6042 0.824405 9.93452 0.491071 9.16071C0.16369 8.38095 0 7.56548 0 6.71429C0 5.86309 0.16369 5.05059 0.491071 4.27678C0.824405 3.49702 1.27083 2.82738 1.83036 2.26786C2.39583 1.70238 3.06548 1.25595 3.83929 0.928571C4.61905 0.595237 5.43452 0.428571 6.28571 0.428571C7.13691 0.428571 7.94941 0.595237 8.72322 0.928571C9.50298 1.25595 10.1726 1.70238 10.7321 2.26786C11.2976 2.82738 11.744 3.49702 12.0714 4.27678C12.4048 5.05059 12.5714 5.86309 12.5714 6.71429C12.5714 8.02381 12.2024 9.21131 11.4643 10.2768L14.5268 13.3393C14.747 13.5595 14.8571 13.8274 14.8571 14.1429Z"
                                            fill="currentColor" />
                                    </svg>
                                </span>
                            </div>
                        </div>
                        <div class="listing__widget--inner" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                            {{-- <div class="widget__list mb-40">
                                    <h2 class="widget__title mb-30">Price Filtering (IDR)</h2>
                                    <div class="widget__price--filtering">
                                        <div class="price-input">
                                            <input type="number" class="input-min" value="2500">
                                            <div class="separator">-</div>
                                            <input type="number" class="input-max" value="10000000000">
                                        </div>
                                        <div class="price-slider">
                                            <div class="progress"></div>
                                        </div>
                                        <div class="range-input">
                                            <input type="range" name="price_min" class="range-min" min="0" max="10000" value="2500" step="100">
                                            <input type="range" name="price_max" class="range-max" min="0" max="10000" value="7500" step="100">
                                        </div>
                                    </div>
                                </div> --}}
                            <div class="widget__list mb-30">
                                <h2 class="widget__title mb-15">Properties Type</h2>
                                <ul class="widget__catagories">
                                    <li class="widget__catagories__list">
                                        <label class="widget__catagories--label" for="check1">Leasehold</label>
                                        <input class="widget__catagories--input" name="property_type[]" value="Leasehold" id="check1" type="checkbox">
                                        <span class="widget__catagories--checkmark"></span>
                                    </li>
                                    <li class="widget__catagories__list">
                                        <label class="widget__catagories--label" for="check2">Freehold</label>
                                        <input class="widget__catagories--input" name="property_type[]" value="Freehold" id="check2" type="checkbox">
                                        <span class="widget__catagories--checkmark"></span>
                                    </li>

                                </ul>
                            </div>
                            <div class="widget__list mb-30">
                                <h2 class="widget__title mb-15">Bedrooms</h2>
                                <ul class="widget__catagories">
                                    <select name="bedroom" class="add__listing--form__select">
                                        <option selected="" value="">All Bedroom</option>
                                        <option value="2">2 Bedrooms</option>
                                        <option value="3">3 Bedrooms</option>
                                        <option value="4">4 Bedrooms</option>
                                    </select>
                                </ul>
                            </div>

                            <div class="widget__list mb-0">
                                <h2 class="widget__title mb-30">Find By Location</h2>
                                <ul class="widget__location">
                                    @foreach ($regions as $rgn)
                                        <li class="widget__location--list">
                                            <label class="widget__location--label" for="{{ $rgn->name }}">{{ $rgn->name }}</label>
                                            <input class="widget__catagories--input" id="{{ $rgn->name }}" type="checkbox" name="location[]" value="{{ $rgn->name }}">
                                            <span class="widget__catagories--checkmark"></span>
                                        </li>
                                    @endforeach

                                </ul>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-lg-8">
                    <div class="listing__page--wrapper">
                        <div class="listing__header d-flex justify-content-between align-items-center" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="50">
                            <div class="listing__header--left">
                                <p class="results__cout--text">Showing 1 of {{ $data_property->count() }} Results</p>
                            </div>
                            <div class="listing__header--right d-flex align-items-center">
                                <div class="recently__select d-flex align-items-center">
                                    <span class="recently__select--icon"><svg width="14" height="13" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path fill-rule="evenodd" clip-rule="evenodd" d="M7.42426 9.76048L10.1339 12.6088C10.3985 12.8869 10.8273 12.8869 11.0919 12.6088L13.8016 9.76048C14.0661 9.48239 14.0661 9.03159 13.8016 8.7535C13.537 8.47541 13.1082 8.47541 12.8436 8.7535L11.2903 10.3862V0.712076C11.2903 0.318811 10.987 0 10.6129 0C10.2388 0 9.9355 0.318811 9.9355 0.712076V10.3862L8.38222 8.7535C8.11766 8.47541 7.68881 8.47541 7.42426 8.7535C7.1597 9.03159 7.1597 9.48239 7.42426 9.76048ZM3.86611 0.208562C3.60156 -0.0695178 3.17264 -0.0695178 2.90809 0.208562L0.19841 3.05687C-0.0661366 3.33495 -0.0661366 3.78581 0.19841 4.06389C0.462956 4.34197 0.891881 4.34197 1.15643 4.06389L2.70968 2.43118V12.1053C2.70968 12.4985 3.01297 12.8174 3.3871 12.8174C3.76123 12.8174 4.06452 12.4985 4.06452 12.1053V2.43118L5.6178 4.06389C5.88236 4.34197 6.31121 4.34197 6.57576 4.06389C6.84032 3.78581 6.84032 3.33495 6.57576 3.05687L3.86611 0.208562Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                    <div class="select">
                                        <select>
                                            <option selected value="1">Recently Added</option>
                                            <option value="2">Newest</option>
                                            <option value="3">Best Seller</option>
                                            <option value="4">Best Match</option>
                                            <option value="5">Price Low</option>
                                            <option value="6">Price High</option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="listing__main--content">
                            <div class="tab-content">
                                <div class="tab-pane fade show active" id="grid">
                                    <div class="listing__featured--grid">
                                        <div class="row mb--n30">
                                            <div id="loading-indicator" style="display:none; text-align:center;">
                                                <em>Loading...</em>
                                            </div>

                                            {{-- ####### Property List --}}
                                            <div class="row" id="property-list">
                                                @include('landing.listing.partials.property_list', ['data_property' => $data_property])
                                            </div>
                                            {{-- ####### Property List --}}

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="page__pagination--area">
                                <ul class="page__pagination--wrapper d-flex justify-content-center">
                                    <li class="page__pagination--list"><a class="page__pagination--link" href="#"><svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 5.12695C5.73633 5.39062 5.73633 5.83008 6 6.12305L9.98438 10.1074C10.2773 10.3711 10.7168 10.3711 10.9805 10.1074L11.6543 9.43359C11.918 9.14062 11.918 8.70117 11.6543 8.4375L8.8125 5.5957L11.6543 2.7832C11.918 2.51953 11.918 2.08008 11.6543 1.78711L10.9805 1.14258C10.7168 0.849609 10.2773 0.849609 9.98437 1.14258L6 5.12695ZM0.375 6.12305L4.35938 10.1074C4.65234 10.3711 5.0918 10.3711 5.35547 10.1074L6.0293 9.43359C6.29297 9.16992 6.29297 8.70117 6.0293 8.4375L3.1875 5.625L6.0293 2.7832C6.29297 2.51953 6.29297 2.08008 6.0293 1.78711L5.35547 1.14258C5.0918 0.849609 4.62305 0.849609 4.35937 1.14258L0.375 5.12695C0.111328 5.39063 0.111328 5.83008 0.375 6.12305Z" fill="currentColor" />
                                            </svg>
                                        </a></li>
                                    <li class="page__pagination--list"><a class="page__pagination--link" href="#">1
                                        </a></li>
                                    <li class="page__pagination--list"><a class="page__pagination--link active" href="#">2
                                        </a></li>
                                    <li class="page__pagination--list"><a class="page__pagination--link" href="#">3
                                        </a></li>
                                    <li class="page__pagination--list"><a class="page__pagination--link" href="#"><svg width="12" height="11" viewBox="0 0 12 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M6 5.87305C6.26367 5.60938 6.26367 5.16992 6 4.87695L2.01562 0.892578C1.72266 0.628906 1.2832 0.628906 1.01953 0.892578L0.345703 1.56641C0.0820312 1.85938 0.0820312 2.29883 0.345703 2.5625L3.1875 5.4043L0.345703 8.2168C0.0820312 8.48047 0.0820312 8.91992 0.345703 9.21289L1.01953 9.85742C1.2832 10.1504 1.72266 10.1504 2.01562 9.85742L6 5.87305ZM11.625 4.87695L7.64062 0.892578C7.34766 0.628906 6.9082 0.628906 6.64453 0.892578L5.9707 1.56641C5.70703 1.83008 5.70703 2.29883 5.9707 2.5625L8.8125 5.375L5.9707 8.2168C5.70703 8.48047 5.70703 8.91992 5.9707 9.21289L6.64453 9.85742C6.9082 10.1504 7.37695 10.1504 7.64062 9.85742L11.625 5.87305C11.8887 5.60938 11.8887 5.16992 11.625 4.87695Z" fill="currentColor" />
                                            </svg>
                                        </a></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Listing page section . -->
@endsection
@push('scripts')
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>
        function debounce(func, delay) {
            let timer;
            return function(...args) {
                clearTimeout(timer);
                timer = setTimeout(() => func.apply(this, args), delay);
            };
        }

        $(document).ready(function() {
            function fetchFilteredProperties() {
                let formData = {
                    query: $('#search_props').val(),
                    price_min: $('.input-min').val(),
                    price_max: $('.input-max').val(),
                    bedroom: $('[name="bedroom"]').val(),
                    property_type: [],
                    location: [],
                };

                // Ambil data dari checkbox
                $('[name="property_type[]"]:checked').each(function() {
                    formData.property_type.push($(this).val());
                });
                $('[name="location[]"]:checked').each(function() {
                    formData.location.push($(this).val());
                });

                $.ajax({
                    url: '{{ route('property.search') }}',
                    type: 'GET',
                    data: formData,
                    beforeSend: function() {
                        $('#property-list').html('<p>Loading...</p>');
                    },
                    success: function(data) {
                        $('#property-list').html(data);
                    }
                });
            }

            // Event untuk semua filter
            $('#search_props').on('keyup', debounce(fetchFilteredProperties, 300));
            $('.input-min, .input-max, [name="bedroom"], [name="property_type[]"], [name="location[]"]').on('change', fetchFilteredProperties);
        });
    </script>
@endpush
