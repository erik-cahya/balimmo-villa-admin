{{-- partials/property_list.blade.php --}}
@foreach ($data_property as $property)
    <div class="col-lg-6 col-md-6 col-sm-6 mb-30" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="50">
        <article class="featured__card">
            <div class="featured__thumbnail position-relative">
                <div class="media">
                    <a class="featured__thumbnail--link" href="{{ route('landing-page.land.listing.detail', $property->land_slug) }}">
                        <img class="featured__thumbnail--img" src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="featured-img" style="height: 26rem; object-fit: cover">
                    </a>
                </div>
                <div class="featured__badge">
                    <span class="badge__field style2">{{ $property->sub_region }}</span>
                </div>
            </div>
            <div class="featured__content">
                <div class="featured__content--top d-flex align-items-center justify-content-between">
                    <h3 class="featured__card--title"><a href="{{ route('landing-page.listing.detail', $property->land_slug) }}">{{ $property->land_name }}</a></h3>
                    {{-- <span class="featured__card--price">{{ $property->formatted_price }}</span> --}}
                </div>

                <div class="d-flex flex-column justify-content-between mt-4">
                    <span class="fst-italic fw-bold" style="font-size: 14px">IDR {{ number_format($property->selling_price_idr) }}</span>
                    <span class="fst-italic fw-bold" style="font-size: 14px">$ {{ number_format($property->selling_price_usd, 2) }}</span>
                </div>
                <hr>
                <!-- <p class="featured__content--desc"><svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M5.48287 0C2.45013 0 0 2.4501 0 5.48288C0 5.85982 0.0343013 6.21958 0.102785 6.57945C0.514031 9.69783 4.42055 11.9767 5.51712 16.4144C6.5966 12.0452 11 8.824 11 5.48288H10.9657C10.9657 2.45013 8.51548 0 5.48282 0H5.48287ZM5.48287 2.17592C7.21338 2.17592 8.61839 3.58097 8.61839 5.31144C8.61839 7.04191 7.21335 8.44696 5.48287 8.44696C3.7524 8.44696 2.34736 7.04191 2.34736 5.31144C2.34736 3.58097 3.75228 2.17592 5.48287 2.17592Z" fill="#063436" />
                    </svg>
                    {{ $property->sub_region . ', ' . $property->region }}
                </p> -->
                <ul class="featured__info d-flex">                    
                    <li class="featured__info--items">
                        <span class="featured__info--icon">
                            {{ $property->land_width . ' x ' . $property->land_length }} m                            
                        </span>
                        <span class="featured__info--text">Land Size</span>
                    </li>
                    <li class="featured__info--items">
                        <span class="featured__info--icon">
                            {{ $property->total_land_area }} m²
                            <svg width="19" height="20" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path
                                    d="M17.8417 17.2754L0.685046 0.116923C0.569917 0.00263286 0.39646 -0.0311375 0.247421 0.0301228C0.097685 0.0938982 0 0.239308 0 0.401336L0.00181414 17.593C0.00181414 17.8144 0.178622 17.994 0.400928 17.994H17.5973C17.8196 17.994 18 17.8145 18 17.593C17.9997 17.4634 17.9371 17.3485 17.8419 17.2756L17.8417 17.2754ZM0.80258 17.1915V1.36951L2.73813 3.30506L1.77607 4.26741C1.62006 4.42384 1.62006 4.67906 1.77607 4.83525C1.85366 4.91284 1.95735 4.95289 2.06019 4.95289C2.16207 4.95289 2.26491 4.91284 2.3425 4.83525L3.30595 3.87265L5.02184 5.58868L4.0602 6.55113C3.90419 6.70854 3.90419 6.96168 4.0602 7.11783C4.13779 7.19639 4.24064 7.23547 4.34433 7.23547C4.44717 7.23547 4.55002 7.19625 4.62761 7.11783L5.58996 6.15677L7.29369 7.86011L6.33135 8.82396C6.17547 8.97956 6.17547 9.23407 6.33135 9.39094C6.41061 9.46937 6.5136 9.50858 6.61547 9.50858C6.71832 9.50858 6.82116 9.46937 6.89959 9.39094L7.86194 8.42835L9.56639 10.1331L8.60351 11.0957C8.4493 11.2517 8.4493 11.5062 8.60351 11.6631C8.68277 11.7415 8.78576 11.7807 8.88944 11.7807C8.99229 11.7807 9.09248 11.7415 9.17273 11.6621L10.1339 10.7001L11.8393 12.4053L10.8773 13.3677C10.7203 13.5237 10.7203 13.7782 10.8773 13.9342C10.9549 14.0136 11.0576 14.0531 11.1611 14.0531C11.2641 14.0531 11.3658 14.0139 11.4434 13.9342L12.4063 12.9726L14.1117 14.6779L13.1491 15.6395C12.9921 15.7945 12.9921 16.0492 13.1491 16.2083C13.2267 16.2859 13.3301 16.3241 13.433 16.3241C13.535 16.3241 13.6373 16.2859 13.7154 16.2083L14.6787 15.2454L16.625 17.1917L0.80258 17.1915Z"
                                    fill="black"></path>
                                <path d="M3.52378 9.14585C3.40949 9.02946 3.23715 8.99583 3.08726 9.05821C2.93823 9.11961 2.83984 9.26544 2.83984 9.42871V14.7534C2.83984 14.9755 3.0193 15.1552 3.2416 15.1552H8.5717C8.794 15.1552 8.97442 14.9757 8.97442 14.7534C8.97442 14.6242 8.91176 14.5098 8.81673 14.4365L3.52378 9.14585ZM3.64324 14.353L3.64142 10.3976L7.59863 14.3534L3.64324 14.353Z" fill="black"></path>
                            </svg>
                        </span>
                        <span class="featured__info--text">Total Land Size</span>
                    </li>
                </ul>
            </div>
        </article>
    </div>
@endforeach
