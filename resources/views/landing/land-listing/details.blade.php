@php
    // Lifestyle URL
    $lifestyle = null;
    $urlLifestyle = $attachment->firstWhere('name', 'url_lifestyle');
    if ($urlLifestyle) {
        $lifestyle = $urlLifestyle->path_attachment;
    }

    // Virtual Tour URL
    $virtualTour = null;
    $urlVirtualTour = $attachment->firstWhere('name', 'url_virtual_tour');
    if ($urlVirtualTour) {
        $virtualTour = $urlVirtualTour->path_attachment;
    }

    // Experience URL
    $experience = null;
    $urlExperience = $attachment->firstWhere('name', 'url_experience');
    if ($urlExperience) {
        $experience = $urlExperience->path_attachment;
    }
@endphp

@extends('landing.layouts.master')
@push('style')
    <link href="{{ asset('admin') }}/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('title')
    Villa for sale in Bali | {{ $property->property_name }}
@endsection

@section('meta_description')
    {{ $property->property_description }}
@endsection

@section('content')

    <!-- Hero section -->
    <section class="listing__hero--section">
        <div class="listing__hero--section__inner position-relative">
            <div class="listing__hero--slider">
                <div class="swiper hero__swiper--column1">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="listing__hero--slider__items position-relative">
                                {{-- <img class="listing__hero--slider__media" src="{{ asset($property->featuredImage->image_path) }}" alt="img"> --}}
                                <img class="listing__hero--slider__media" src="{{ asset($property?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="img">
                                <div class="listing__hero--slider__container">
                                    <div class="container">
                                        <!-- Hero Content -->
                                        <div class="listing__hero--slider__content">
                                            <div class="listing__hero--slider__content--top d-flex align-items-center justify-content-between">
                                                <h3 class="listing__hero--slider__title">{{ $property->property_name }}</h3>
                                                <span class="listing__hero--slider__price" style="font-size: 2.2rem">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                            </div>
                                            <p class="listing__hero--slider__text"><svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path d="M5.48287 0C2.45013 0 0 2.4501 0 5.48288C0 5.85982 0.0343013 6.21958 0.102785 6.57945C0.514031 9.69783 4.42055 11.9767 5.51712 16.4144C6.5966 12.0452 11 8.824 11 5.48288H10.9657C10.9657 2.45013 8.51548 0 5.48282 0H5.48287ZM5.48287 2.17592C7.21338 2.17592 8.61839 3.58097 8.61839 5.31144C8.61839 7.04191 7.21335 8.44696 5.48287 8.44696C3.7524 8.44696 2.34736 7.04191 2.34736 5.31144C2.34736 3.58097 3.75228 2.17592 5.48287 2.17592Z" fill="#ddab70" />
                                                </svg>
                                                {{ $property->property_address }}</p>
                                        </div>
                                        <!-- Hero Content .\ -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>
    <!-- Hero section .\ -->

    <!-- Listing details section -->
    <section class="listing__details--section section--padding" style="padding-bottom: 0rem">
        <div class="container">
            <div class="row">
                <div class="col-lg-8">
                    <div class="listing__details--wrapper">
                        <div class="listing__details--content">
                            <div class="listing__details--content__top mb-25 d-flex align-items-center justify-content-between">
                                <div class="listing__details--meta">
                                    <ul class="listing__details--meta__wrapper d-flex align-items-center">
                                        <li><span class="listing__details--badge">{{ $property->legalStatus }}</span></li>
                                        <li><span class="listing__details--badge two">
                                                <svg width="13" height="15" viewBox="0 0 13 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                    <path
                                                        d="M1 13.0469H3.25V10.7969H1V13.0469ZM3.75 13.0469H6.25V10.7969H3.75V13.0469ZM1 10.2969H3.25V7.79687H1V10.2969ZM3.75 10.2969H6.25V7.79687H3.75V10.2969ZM1 7.29687H3.25V5.04688H1V7.29687ZM6.75 13.0469H9.25V10.7969H6.75V13.0469ZM3.75 7.29687H6.25V5.04688H3.75V7.29687ZM9.75 13.0469H12V10.7969H9.75V13.0469ZM6.75 10.2969H9.25V7.79687H6.75V10.2969ZM4 3.54687V1.29687C4 1.22917 3.97396 1.17187 3.92188 1.125C3.875 1.07292 3.81771 1.04687 3.75 1.04687H3.25C3.18229 1.04687 3.1224 1.07292 3.07031 1.125C3.02344 1.17187 3 1.22917 3 1.29687V3.54687C3 3.61458 3.02344 3.67448 3.07031 3.72656C3.1224 3.77344 3.18229 3.79687 3.25 3.79687H3.75C3.81771 3.79687 3.875 3.77344 3.92188 3.72656C3.97396 3.67448 4 3.61458 4 3.54687ZM9.75 10.2969H12V7.79687H9.75V10.2969ZM6.75 7.29687H9.25V5.04688H6.75V7.29687ZM9.75 7.29687H12V5.04688H9.75V7.29687ZM10 3.54687V1.29687C10 1.22917 9.97396 1.17187 9.92188 1.125C9.875 1.07292 9.81771 1.04687 9.75 1.04687H9.25C9.18229 1.04687 9.1224 1.07292 9.07031 1.125C9.02344 1.17187 9 1.22917 9 1.29687V3.54687C9 3.61458 9.02344 3.67448 9.07031 3.72656C9.1224 3.77344 9.18229 3.79687 9.25 3.79687H9.75C9.81771 3.79687 9.875 3.77344 9.92188 3.72656C9.97396 3.67448 10 3.61458 10 3.54687ZM13 3.04687V13.0469C13 13.3177 12.901 13.5521 12.7031 13.75C12.5052 13.9479 12.2708 14.0469 12 14.0469H1C0.729167 14.0469 0.494792 13.9479 0.296875 13.75C0.0989583 13.5521 0 13.3177 0 13.0469V3.04687C0 2.77604 0.0989583 2.54167 0.296875 2.34375C0.494792 2.14583 0.729167 2.04687 1 2.04687H2V1.29687C2 0.953124 2.1224 0.658853 2.36719 0.414062C2.61198 0.16927 2.90625 0.046874 3.25 0.046874H3.75C4.09375 0.046874 4.38802 0.16927 4.63281 0.414062C4.8776 0.658853 5 0.953124 5 1.29687V2.04687H8V1.29687C8 0.953124 8.1224 0.658853 8.36719 0.414062C8.61198 0.16927 8.90625 0.046874 9.25 0.046874H9.75C10.0938 0.046874 10.388 0.16927 10.6328 0.414062C10.8776 0.658853 11 0.953124 11 1.29687V2.04687H12C12.2708 2.04687 12.5052 2.14583 12.7031 2.34375C12.901 2.54167 13 2.77604 13 3.04687Z"
                                                        fill="currentColor" />
                                                </svg> {{ \Carbon\Carbon::parse($property->created_at)->format('d F, Y') }}</span></li>
                                    </ul>
                                </div>

                            </div>
                            <div class="listing__details--content__step">
                                <h2 class="listing__details--title mb-25">{{ $property->property_name }}</h2>
                                <div class="listing__details--price__id d-flex align-items-center">
                                    <div class="listing__details--price d-flex">
                                        <span class="listing__details--price__new">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                        |
                                        <span class="listing__details--price__new">$ {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                        {{-- <span class="listing__details--price__old">$16000</span> --}}

                                    </div>
                                </div>
                                <p class="listing__details--location__text"><svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M5.48287 0C2.45013 0 0 2.4501 0 5.48288C0 5.85982 0.0343013 6.21958 0.102785 6.57945C0.514031 9.69783 4.42055 11.9767 5.51712 16.4144C6.5966 12.0452 11 8.824 11 5.48288H10.9657C10.9657 2.45013 8.51548 0 5.48282 0H5.48287ZM5.48287 2.17592C7.21338 2.17592 8.61839 3.58097 8.61839 5.31144C8.61839 7.04191 7.21335 8.44696 5.48287 8.44696C3.7524 8.44696 2.34736 7.04191 2.34736 5.31144C2.34736 3.58097 3.75228 2.17592 5.48287 2.17592Z" fill="#063436" />
                                    </svg>
                                    {{ $property->property_address . ', ' . $property->sub_region }}
                                </p>

                            </div>
                        </div>
                        <div class="listing__details--main__content">
                            <div class="listing__details--content__step mb-80">
                                <h3 class="listing__details--content__title">Description:</h3>
                                <p class="listing__details--content__desc">{{ $property->property_description }}</p>
                                <div class="apartment__info listing__d--info">
                                    <div class="apartment__info--wrapper d-flex">
                                        <div class="apartment__info--list">
                                            <span class="apartment__info--icon"><img src="{{ asset('landing') }}/assets/img/icon/bed-realistic.png" alt="img"></span>
                                            <p>
                                                <span class="apartment__info--count">{{ $property->bedroom }}</span>
                                                <span class="apartment__info--title">Bedrooms</span>
                                            </p>
                                        </div>
                                        <div class="apartment__info--list">
                                            <span class="apartment__info--icon"><img src="{{ asset('landing') }}/assets/img/icon/bathroom.png" alt="img"></span>
                                            <p>
                                                <span class="apartment__info--count">{{ $property->bathroom }}</span>
                                                <span class="apartment__info--title">Bathrooms</span>
                                            </p>
                                        </div>
                                        <div class="apartment__info--list">
                                            <span class="apartment__info--icon"><img src="{{ asset('landing') }}/assets/img/icon/land.png" alt="img"></span>
                                            <p>
                                                <span class="apartment__info--count">{{ $property->total_land_area }} m²</span>
                                                <span class="apartment__info--title">Land</span>
                                            </p>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="listing__details--content__step properties__info mb-80">
                                <h3 class="listing__details--content__title mb-40">Properties Details:</h3>
                                <ul class="properties__details--info__wrapper d-flex">
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Price:</span>
                                        <div class="d-flex flex-column">
                                            <span class="properties__details--info__subtitle">IDR {{ number_format($property->selling_price_idr, 2, ',', '.') }}</span>
                                            <span class="properties__details--info__subtitle">USD {{ number_format($property->selling_price_usd, 2, ',', '.') }}</span>
                                        </div>
                                    </li>
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Property ID:</span>
                                        <span class="properties__details--info__subtitle">{{ $property->property_code }}</span>
                                    </li>
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Living Area:</span>
                                        <span class="properties__details--info__subtitle">{{ $property->villa_area }} m²</span>
                                    </li>
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Land Area Size:</span>
                                        <span class="properties__details--info__subtitle">{{ $property->total_land_area }} m²</span>
                                    </li>
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Bedrooms:</span>
                                        <span class="properties__details--info__subtitle">{{ $property->bedroom }}</span>
                                    </li>
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Bathrooms:</span>
                                        <span class="properties__details--info__subtitle">{{ $property->bathroom }}</span>
                                    </li>
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Year Built</span>
                                        <span class="properties__details--info__subtitle">{{ $property->year_construction }}</span>
                                    </li>
                                    <li class="properties__details--info__list d-flex justify-content-between">
                                        <span class="properties__details--info__title">Year Renovation</span>
                                        <span class="properties__details--info__subtitle">{{ $property->year_renovated }}</span>
                                    </li>
                                </ul>
                            </div>
                            <div class="listing__details--content__step properties__amenities mb-80">
                                <h3 class="listing__details--content__title mb-40">Properties Amenities</h3>

                                <div class="container">
                                    <div class="row g-2">

                                        @if ($feature_list->count() == 0)
                                            <p>No Data</p>
                                        @else
                                            @foreach ($feature_list as $feature)
                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-2">
                                                            <span class="properties__amenities--mark__icon"><svg width="16" height="15" viewBox="0 0 16 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                                    <path d="M15.794 2.174C14.426 3.422 13.094 4.874 11.798 6.53C10.67 7.958 9.656 9.422 8.756 10.922C7.94 12.266 7.346 13.418 6.974 14.378C6.962 14.414 6.938 14.444 6.902 14.468C6.866 14.504 6.824 14.522 6.776 14.522C6.764 14.534 6.752 14.54 6.74 14.54C6.656 14.54 6.596 14.516 6.56 14.468L0.134 7.934C0.122 7.922 0.278 7.766 0.602 7.466C0.926 7.154 1.244 6.872 1.556 6.62C1.904 6.332 2.09 6.2 2.114 6.224L5.642 8.996C6.674 7.784 7.832 6.584 9.116 5.396C11.048 3.62 13.04 2.108 15.092 0.86C15.128 0.86 15.266 1.028 15.506 1.364L15.866 1.886C15.878 1.934 15.878 1.988 15.866 2.048C15.854 2.096 15.83 2.138 15.794 2.174Z" fill="currentColor" />
                                                                </svg>
                                                            </span>
                                                        </div>
                                                        <div class="col-10">
                                                            <span class="properties__amenities--text">{{ $feature->feature_name }}</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </div>
                            </div>

                            @if ($image_gallery->count() >= 1)
                                <div class="listing__details--content__step mb-80">
                                    <h3 class="listing__details--content__title mb-40">Gallery</h3>

                                    <div class="container">
                                        <div class="row g-3">
                                            @foreach ($image_gallery as $gallery)
                                                <div class="col-6 col-md-4 col-lg-3">
                                                    <a class="chat__profile--photos__link glightbox" href="{{ asset($gallery->image_path) }}" data-gallery="gallery"><img class="chat__profile--photos__media" src="{{ asset($gallery->image_path) }}" alt="img" style="width: 20rem; max-height: 10rem; object-fit:cover; border-radius: 10px"></a>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            @endif

                            <div class="listing__details--content__step mb-80">
                                <div class="listing__details--location__header d-flex justify-content-between mb-40">
                                    <div class="listing__details--location__header--left">
                                        <h3 class="listing__details--content__title m-0">Location</h3>
                                    </div>
                                </div>
                                <div class="location__google--maps__info d-flex">
                                    <ul class="location__google--maps__info--step">
                                        <li class="location__google--maps__info--list d-flex">
                                            <span class="location__google--maps__info--title">Region: </span>
                                            <span class="location__google--maps__info--subtitle">{{ $property->region }}</span>
                                        </li>
                                        <li class="location__google--maps__info--list d-flex">
                                            <span class="location__google--maps__info--title">Subregion: </span>
                                            <span class="location__google--maps__info--subtitle">{{ $property->sub_region }}</span>
                                        </li>
                                    </ul>
                                    <ul class="location__google--maps__info--step">
                                        <li class="location__google--maps__info--list d-flex">
                                            <span class="location__google--maps__info--title">Address:</span>
                                            <span class="location__google--maps__info--subtitle">{{ $property->property_address }}</span>
                                        </li>
                                        <li class="location__google--maps__info--list d-flex">
                                            <span class="location__google--maps__info--title">Property Type: </span>
                                            <span class="location__google--maps__info--subtitle">{{ $property->legalStatus }}</span>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            @if ($lifestyle !== null)
                                <div class="listing__details--content__step mb-80">
                                    <h3 class="listing__details--content__title mb-40">Lifestyle</h3>
                                    <div class="listing__details--video__thumbnail position-relative">
                                        @if ($lifestyle === null)
                                            <p class="admin__profile--desc">No Data</p>
                                        @else
                                            <img src="https://img.youtube.com/vi/{{ $lifestyle }}/maxresdefault.jpg" alt="img">
                                            <div class="bideo__play">
                                                <a class="bideo__play--icon glightbox" href="https://www.youtube.com/embed/{{ $lifestyle }}" data-gallery="video">
                                                    <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.9358 7.28498C12.5203 7.67662 12.5283 8.53339 11.9512 8.93591L1.99498 15.8809C1.33555 16.3409 0.430441 15.8741 0.422904 15.0701L0.294442 1.36797C0.286904 0.563996 1.1831 0.0802964 1.85104 0.527837L11.9358 7.28498Z" fill="currentColor" />
                                                    </svg>
                                                    <span class="visually-hidden">Video Play</span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif
                            @if ($virtualTour !== null)
                                <div class="listing__details--content__step mb-80">
                                    <h3 class="listing__details--content__title mb-40">Virtual Tour</h3>
                                    <div class="listing__details--video__thumbnail position-relative">
                                        @if ($virtualTour === null)
                                            <p class="admin__profile--desc">No Data</p>
                                        @else
                                            <img src="https://img.youtube.com/vi/{{ $virtualTour }}/maxresdefault.jpg" alt="img">
                                            <div class="bideo__play">
                                                <a class="bideo__play--icon glightbox" href="https://www.youtube.com/embed/{{ $virtualTour }}" data-gallery="video">
                                                    <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.9358 7.28498C12.5203 7.67662 12.5283 8.53339 11.9512 8.93591L1.99498 15.8809C1.33555 16.3409 0.430441 15.8741 0.422904 15.0701L0.294442 1.36797C0.286904 0.563996 1.1831 0.0802964 1.85104 0.527837L11.9358 7.28498Z" fill="currentColor" />
                                                    </svg>
                                                    <span class="visually-hidden">Video Play</span>
                                                </a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            @endif

                            @if ($experience !== null)
                                <div class="listing__details--content__step mb-80">
                                    <h3 class="listing__details--content__title mb-40">Experience</h3>
                                    <div class="listing__details--video__thumbnail position-relative">
                                        @if ($experience === null)
                                            <p class="admin__profile--desc">No Data</p>
                                        @else
                                            <img src="https://img.youtube.com/vi/{{ $experience }}/maxresdefault.jpg" alt="img">
                                            <div class="bideo__play">
                                                <a class="bideo__play--icon glightbox" href="https://www.youtube.com/embed/{{ $experience }}" data-gallery="video">
                                                    <svg width="13" height="17" viewBox="0 0 13 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                        <path d="M11.9358 7.28498C12.5203 7.67662 12.5283 8.53339 11.9512 8.93591L1.99498 15.8809C1.33555 16.3409 0.430441 15.8741 0.422904 15.0701L0.294442 1.36797C0.286904 0.563996 1.1831 0.0802964 1.85104 0.527837L11.9358 7.28498Z" fill="currentColor" />
                                                    </svg>
                                                    <span class="visually-hidden">Video Play</span>
                                                </a>
                                            </div>
                                        @endif

                                    </div>
                                </div>
                            @endif

                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="listing__widget">
                        <div class="widget__admin--profile mb-30 text-center">
                            <div class="admin__profile--thumbnail">
                                <img src="{{ asset('admin') }}{{ $property->profilePicture == null ? '/assets/images/users/dummy-avatar.jpg' : '/profile-image/' . $property->agent_code . '/' . $property->profilePicture }}" alt="img" style="width: 20rem; max-height: 20rem; object-fit:cover; border-radius: 10px">
                            </div>
                            <div class="admin__profile--content">
                                <h3 class="admin__profile--name">{{ $property->agent_name }}</h3>
                                <h5 class="admin__profile--subtitle">{{ $property->agent_tagline }}</h5>
                                <hr>
                                <p class="admin__profile--desc">{{ Str::limit($property->agent_description, 160) }}</p>
                                <a class="admin__profile--email" href="mailto:{{ $property->agent_email }}">{{ $property->agent_email }}</a>
                            </div>
                        </div>

                        <div class="widget__step mb-30" style="background-color: #F6F8FB">
                            <h2 class="widget__step--title">Booking this {{ $property->type_properties }}</h2>
                            <div class="widget__form">
                                {{-- Booking Form --}}
                                <form action="{{ route('booking.slug', $property->property_slug) }}" method="POST">
                                    @csrf
                                    @if ($property->type_properties == 'Properties')
                                        <div class="contact__property--form__inner">
                                            <div class="d-flex gap-4">
                                                <div class="contact__property--form__input">
                                                    <label for="first_name">First Name*</label>
                                                    <input id="first_name" name="first_name" placeholder="Enter your name" type="text">
                                                    @error('first_name')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="contact__property--form__input">
                                                    <label for="last_name">Last Name*</label>
                                                    <input id="last_name" name="last_name" placeholder="Enter your name" type="text">
                                                    @error('last_name')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="contact__property--form__input w-full">
                                                <label for="phone_number">Phone number*</label>
                                                <input id="phone_number" class="w-full" name="phone_number" type="tel" placeholder="+33 44 55 678" required>

                                                @error('phone_number')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="contact__property--form__input">
                                                <label for="email">Email*</label>
                                                <input id="email" name="email" placeholder="Enter your email" type="text">
                                                @error('email')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="contact__property--form__input w-full">
                                                <label for="budget_currency">Select Budget Currency*</label>

                                                <select id="budget_currency" name="budget_currency">
                                                    <option selected disabled>Select Currency</option>
                                                    <option value="usd">Dollar (USD)</option>
                                                    <option value="idr">Rupiah (IDR)</option>
                                                </select>

                                                @error('budget_currency')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- looking_for_villa -->
                                            <div id="">
                                                <div class="d-flex justify-content-center justify-items-center text-center">
                                                    <hr class="w-50" />
                                                    <label class="w-100">Looking For Villa</label>
                                                    <hr class="w-50" />
                                                </div>
                                                <div class="contact__property--form__input" id="villa_budget_idr" style="display: none;">
                                                    <label for="budget_idr">Budget IDR*</label>
                                                    <div class="widget__price--filtering">
                                                        <div class="price-input">
                                                            <input type="text" class="input-min bg-white" name="budget_idr_min" id="budget_idr_min" placeholder="IDR 100 000 000">
                                                            <div class="separator">-</div>
                                                            <input type="text" class="input-max bg-white" name="budget_idr_max" id="budget_idr_max" placeholder="IDR 50 000 000 000">
                                                        </div>
                                                    </div>

                                                    @error('budget_idr')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="contact__property--form__input" id="villa_budget_usd" style="display: none;">
                                                    <label for="budget_usd">Budget USD*</label>
                                                    <div class="widget__price--filtering">
                                                        <div class="price-input">
                                                            <input type="text" class="input-min bg-white" name="budget_usd_min" id="budget_usd_min" placeholder="$ 1 000">
                                                            <div class="separator">-</div>
                                                            <input type="text" class="input-max bg-white" name="budget_usd_max" id="budget_usd_max" placeholder="$ 100 000">
                                                        </div>
                                                    </div>

                                                    @error('budget_usd')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="contact__property--form__input" id="villa_location">
                                                    <label for="location">Location*</label>
                                                    <select name="location">
                                                        <option selected disabled>Property Location</option>
                                                        @foreach ($sub_regions as $rgn)
                                                            <option value="{{ $rgn->name }}">{{ $rgn->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('location')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="contact__property--form__input" id="villa_bedroom">
                                                    <label for="villa_bedroom">Bedroom*</label>
                                                    <div class="widget__price--filtering">
                                                        <div class="price-input">
                                                            <input type="number" class="input-min bg-white" name="bedroom_min" id="bedroom_min" placeholder="Bedroom min">
                                                            <div class="separator">-</div>
                                                            <input type="number" class="input-max bg-white" name="bedroom_max" id="bedroom_max" placeholder="Bedroom max">
                                                        </div>
                                                    </div>

                                                    @error('villa_bedroom')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="contact__property--form__input">
                                                <label for="timing">Ready to buy*</label>
                                                <input id="timing" name="timing" placeholder="Timing" type="text">

                                                @error('timing')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="contact__property--form__input">
                                                <label for="email">Message</label>
                                                <textarea id="text" name="message" placeholder="Enter your message"></textarea>

                                                @error('message')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button class="contact__property--btn solid__btn" type="submit">Send message</button>
                                        </div>
                                    @else
                                        <div class="contact__property--form__inner">
                                            <div class="d-flex gap-4">
                                                <div class="contact__property--form__input">
                                                    <label for="first_name">First Name*</label>
                                                    <input id="first_name" name="first_name" placeholder="Enter your name" type="text">
                                                    @error('first_name')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                                <div class="contact__property--form__input">
                                                    <label for="last_name">Last Name*</label>
                                                    <input id="last_name" name="last_name" placeholder="Enter your name" type="text">
                                                    @error('last_name')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>
                                            <div class="contact__property--form__input w-full">
                                                <label for="phone_number">Phone number*</label>
                                                <input id="phone_number" class="w-full" name="phone_number" type="tel" placeholder="+33 44 55 678" required>

                                                @error('phone_number')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="contact__property--form__input">
                                                <label for="email">Email*</label>
                                                <input id="email" name="email" placeholder="Enter your email" type="text">
                                                @error('email')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="contact__property--form__input w-full">
                                                <label for="budget_currency">Select Budget Currency*</label>

                                                <select id="budget_currency" name="budget_currency">
                                                    <option selected disabled>Select Currency</option>
                                                    <option value="usd">Dollar (USD)</option>
                                                    <option value="idr">Rupiah (IDR)</option>
                                                </select>

                                                @error('budget_currency')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <!-- looking_for_villa -->
                                            <div id="">
                                                <div class="d-flex justify-content-center justify-items-center text-center">
                                                    <hr class="w-50" />
                                                    <label class="w-100">Looking For Land</label>
                                                    <hr class="w-50" />
                                                </div>
                                                <div class="contact__property--form__input" id="villa_budget_idr" style="display: none;">
                                                    <label for="budget_idr">Budget IDR*</label>
                                                    <div class="widget__price--filtering">
                                                        <div class="price-input">
                                                            <input type="text" class="input-min bg-white" name="budget_idr_min" id="budget_idr_min" placeholder="IDR 100 000 000">
                                                            <div class="separator">-</div>
                                                            <input type="text" class="input-max bg-white" name="budget_idr_max" id="budget_idr_max" placeholder="IDR 50 000 000 000">
                                                        </div>
                                                    </div>

                                                    @error('budget_idr')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="contact__property--form__input" id="villa_budget_usd" style="display: none;">
                                                    <label for="budget_usd">Budget USD*</label>
                                                    <div class="widget__price--filtering">
                                                        <div class="price-input">
                                                            <input type="text" class="input-min bg-white" name="budget_usd_min" id="budget_usd_min" placeholder="$ 1 000">
                                                            <div class="separator">-</div>
                                                            <input type="text" class="input-max bg-white" name="budget_usd_max" id="budget_usd_max" placeholder="$ 100 000">
                                                        </div>
                                                    </div>

                                                    @error('budget_usd')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="contact__property--form__input" id="villa_location">
                                                    <label for="location">Location*</label>
                                                    <select name="location">
                                                        <option selected disabled>Property Location</option>
                                                        @foreach ($sub_regions as $rgn)
                                                            <option value="{{ $rgn->name }}">{{ $rgn->name }}</option>
                                                        @endforeach
                                                    </select>

                                                    @error('location')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>

                                                <div class="contact__property--form__input" id="land_size">
                                                    <label for="land_size">Land size*</label>
                                                    <div class="widget__price--filtering">
                                                        <div class="price-input">
                                                            <input type="number" class="input-min bg-white" name="land_size_min" id="land_size_min" placeholder="Land size min">
                                                            <div class="separator">-</div>
                                                            <input type="number" class="input-max bg-white" name="land_size_max" id="land_size_max" placeholder="Land size max">
                                                        </div>
                                                    </div>

                                                    @error('land_size')
                                                        <p class="text-danger my-2">{{ $message }}</p>
                                                    @enderror
                                                </div>
                                            </div>

                                            <div class="contact__property--form__input">
                                                <label for="timing">Ready to buy*</label>
                                                <input id="timing" name="timing" placeholder="Timing" type="text">

                                                @error('timing')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>

                                            <div class="contact__property--form__input">
                                                <label for="email">Message</label>
                                                <textarea id="text" name="message" placeholder="Enter your message"></textarea>

                                                @error('message')
                                                    <p class="text-danger my-2">{{ $message }}</p>
                                                @enderror
                                            </div>
                                            <button class="contact__property--btn solid__btn" type="submit">Send message</button>
                                        </div>
                                    @endif
                                </form>
                                {{-- END Booking Form --}}

                            </div>
                        </div>

                        <div class="widget__step mb-30">
                            <h2 class="widget__step--title">Other Properties</h2>

                            @foreach ($other_properties as $oth_props)
                                <div class="widget__featured--properties" style="margin-top: 20px; border: 1px solid #D9D9D9; padding-bottom: 20px">
                                    <div class="widget__featured--properties__thumbnail position-relative">
                                        <img src="{{ asset($oth_props?->featuredImage->image_path ?? 'admin/assets/images/placeholder.webp') }}" alt="img">
                                        <div class="featured__badge">
                                            <span class="badge__field">{{ $oth_props->region }}</span>
                                        </div>
                                    </div>
                                    <div class="widget__featured--properties__content">
                                        <div class="widget__featured--properties__content--top d-flex align-items-center justify-content-between">
                                            <div class="widget__featured--properties__author">
                                                <img src="{{ asset('admin') }}{{ $property->profilePicture == null ? '/assets/images/users/dummy-avatar.jpg' : '/profile-image/' . $property->agent_code . '/' . $property->profilePicture }}" alt="img" style="width: 6rem; max-height: 6rem; object-fit:cover; ">
                                            </div>
                                        </div>
                                        <p class="widget__featured--properties__desc"><svg width="11" height="17" viewBox="0 0 11 17" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.48287 0C2.45013 0 0 2.4501 0 5.48288C0 5.85982 0.0343013 6.21958 0.102785 6.57945C0.514031 9.69783 4.42055 11.9767 5.51712 16.4144C6.5966 12.0452 11 8.824 11 5.48288H10.9657C10.9657 2.45013 8.51548 0 5.48282 0H5.48287ZM5.48287 2.17592C7.21338 2.17592 8.61839 3.58097 8.61839 5.31144C8.61839 7.04191 7.21335 8.44696 5.48287 8.44696C3.7524 8.44696 2.34736 7.04191 2.34736 5.31144C2.34736 3.58097 3.75228 2.17592 5.48287 2.17592Z" fill="#063436"></path>
                                            </svg>
                                            {{ $oth_props->property_address }}
                                        </p>
                                        <h3 class="widget__featured--properties__title">{{ $oth_props->property_name }}</h3>

                                        <a href="{{ route('landing-page.listing.detail', $oth_props->property_slug) }}" class="solid__btn">View Properties</a>

                                    </div>
                                </div>
                            @endforeach
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Listing page section . -->

    <!-- Agents Consult section -->
    <section class="agents__consult--section section--padding pb-0" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
        <div class="container">
            <div class="agents__consult--inner position-relative">
                <div class="agents__consult__content">
                    <h5 class="agents__consult--subtitle">About Real Estate</h5>
                    <h2 class="agents__consult--title">Consult with agents for listing</h2>
                    <p class="agents__consult--desc">Our company provides a full range of services for the construction</p>
                    <a class="agents__consult--link" href="javascript:void(0)">Let's Get Started</a>
                </div>
                <div class="agents__consult--thumb">
                    <img src="{{ asset('landing') }}/assets/img/other/agents-thumb.png" alt="img">
                </div>
            </div>
        </div>
    </section>
    <!-- Agents Consult section .\ -->

@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/flatpickr-min.js') }}"></script>
    <script>
        function toggleSections() {
            const selected_villa = $()
        }
    </script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            // Get elements
            const villaCheckbox = document.getElementById("villa");
            const landCheckbox = document.getElementById("land");
            const currencySelect = document.getElementById("budget_currency");

            const villaSection = document.getElementById("looking_for_villa");
            const landSection = document.getElementById("looking_for_land");

            const villaIDR = document.getElementById("villa_budget_idr");
            const villaUSD = document.getElementById("villa_budget_usd");

            const villaLOCATION = document.getElementById("villa_location");
            const landIDR = document.getElementById("land_budget_idr");
            const landUSD = document.getElementById("land_budget_usd");
            const landLOCATION = document.getElementById("land_location");

            // Function to update visibility
            function updateVisibility() {

                const currency = currencySelect.value;

                villaIDR.style.display = (currency === "idr") ? "block" : "none";
                villaUSD.style.display = (currency === "usd") ? "block" : "none";
            }

            currencySelect.addEventListener("change", updateVisibility);

            villaSection.style.display = "none";
            landSection.style.display = "none";
        });
    </script>

    <script>
        $("#timing").flatpickr({
            dateFormat: "d-m-Y"
        });
    </script>

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
@endpush
