@extends('landing.layouts.master')
@section('title', 'Balimmo Properties | Contact us to buy your futur villa in Bali')
@section('meta_description', 'Contact Balimmo Properties to find your future investment with peace of mind or sell your villa. Our expert team is ready to help you manage your investment in Bali.')

@push('style')
    <link href="{{ asset('admin') }}/assets/css/vendor.min.css" rel="stylesheet" type="text/css" />
@endpush
@section('content')
    <!-- Breadcrumb section -->
    <section class="breadcrumb__section section--padding">
        <div class="container">
            <div class="breadcrumb__content text-center" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <h1 class="breadcrumb__title h2"><span>Contact</span> Us</h1>
                <ul class="breadcrumb__menu d-flex justify-content-center">
                    <li class="breadcrumb__menu--items"><a class="breadcrumb__menu--link" href="/">Home</a></li>
                    <li><span><svg width="6" height="10" viewBox="0 0 6 10" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M5.22321 4.65179C5.28274 4.71131 5.3125 4.77976 5.3125 4.85714C5.3125 4.93452 5.28274 5.00298 5.22321 5.0625L1.0625 9.22321C1.00298 9.28274 0.934524 9.3125 0.857143 9.3125C0.779762 9.3125 0.71131 9.28274 0.651786 9.22321L0.205357 8.77679C0.145833 8.71726 0.116071 8.64881 0.116071 8.57143C0.116071 8.49405 0.145833 8.4256 0.205357 8.36607L3.71429 4.85714L0.205357 1.34821C0.145833 1.28869 0.116071 1.22024 0.116071 1.14286C0.116071 1.06548 0.145833 0.997023 0.205357 0.9375L0.651786 0.491071C0.71131 0.431547 0.779762 0.401785 0.857143 0.401785C0.934524 0.401785 1.00298 0.431547 1.0625 0.491071L5.22321 4.65179Z" fill="#706C6C" />
                            </svg>
                        </span></li>
                    <li><span class="breadcrumb__menu--text">Contact Us </span></li>
                </ul>
            </div>
        </div>
    </section>
    <!-- Breadcrumb section .\ -->

    <!-- Contact page section -->
    <section class="contact__section section--padding">
        <div class="container">
            <div class="contact__inner">
                <div class="contact__wrapper d-flex mb-80">
                    <div class="contact__us--info" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                        <div class="contact__us--info__list d-flex align-items-center">
                            <span class="contact__us--info__icon"><svg width="64" height="64" viewBox="0 0 64 64" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <g clip-path="url(#clip0_474_5001)">
                                        <path d="M63.6998 20.3414L54.4316 13.7948V4.23243C54.3387 3.28519 53.609 2.52491 52.6663 2.39355H12.0633C11.1207 2.52505 10.3908 3.28519 10.2979 4.23243V13.7212L0.662001 20.3412C0.280316 20.6183 0.0385768 21.0481 0 21.5181V56.4573C0.125304 57.4163 0.879946 58.1711 1.83888 58.2962H62.8907C63.6998 58.2962 63.994 57.34 63.994 56.4573V21.5182C63.994 21.0769 64.0675 20.6355 63.6998 20.3414ZM54.4316 17.3255L60.7575 21.6652L54.4316 26.4464V17.3255ZM13.2402 5.33581H51.4894V28.7268L32.3647 43.1438L13.24 28.7268V5.33581H13.2402ZM10.2979 17.252V26.5201L3.97201 21.6654L10.2979 17.252ZM2.94226 24.6811L23.5381 40.275L2.94226 54.1772V24.6811ZM6.47302 55.3541L26.0389 42.1876L31.2615 46.1596C31.5571 46.3881 31.9177 46.5169 32.2912 46.5273C32.5855 46.5273 32.7326 46.3802 33.0267 46.1596L38.4698 41.9668L58.2565 55.3541H6.47302ZM61.0518 53.6623L40.8974 40.1279L61.0518 24.6811V53.6623Z" fill="currentColor"></path>
                                        <path d="M20.5961 14.8983H27.2161C28.0287 14.8983 28.6873 14.2397 28.6873 13.4272C28.6873 12.6147 28.0287 11.9561 27.2161 11.9561H20.5961C19.7836 11.9561 19.125 12.6147 19.125 13.4272C19.125 14.2397 19.7836 14.8983 20.5961 14.8983Z" fill="currentColor"></path>
                                        <path d="M20.5961 21.5184H44.1342C44.9467 21.5184 45.6053 20.8598 45.6053 20.0473C45.6053 19.2348 44.9467 18.5762 44.1342 18.5762H20.5961C19.7836 18.5762 19.125 19.2348 19.125 20.0473C19.125 20.8598 19.7836 21.5184 20.5961 21.5184Z" fill="currentColor"></path>
                                        <path d="M45.6052 26.6674C45.6052 25.8549 44.9466 25.1963 44.1341 25.1963H20.5961C19.7836 25.1963 19.125 25.8549 19.125 26.6674C19.125 27.4799 19.7836 28.1386 20.5961 28.1386H44.1342C44.9466 28.1386 45.6052 27.4799 45.6052 26.6674Z" fill="currentColor"></path>
                                    </g>
                                </svg>
                            </span>
                            <div class="contact__us--info__content">
                                <h3 class="contact__us--info__title">Mail address</h3>
                                <p class="contact__us--info__text">
                                    <a href="mailto:info@balimmo.properties">info@balimmo-properties.com</a> <br>
                                </p>
                            </div>
                        </div>
                        <div class="contact__us--info__list d-flex align-items-center">
                            <span class="contact__us--info__icon">
                                <svg width="58" height="65" viewBox="0 0 46 65" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M38.8868 52.6066C37.0927 51.7474 34.7762 51.0528 32.1029 50.5637C32.883 49.7529 33.6807 48.886 34.4804 47.9656C37.6741 44.2894 40.2225 40.5336 42.0549 36.8022C44.3712 32.0851 45.5457 27.3914 45.5457 22.8516C45.5457 10.2512 35.3298 0 22.7728 0C10.2159 0 0 10.2512 0 22.8516C0 27.3914 1.17445 32.0851 3.49082 36.8023C5.32315 40.5337 7.87156 44.2895 11.0653 47.9657C11.8649 48.8861 12.6627 49.7531 13.4428 50.5638C10.7695 51.0529 8.45303 51.7475 6.65891 52.6067C3.24665 54.2407 2.53032 56.1059 2.53032 57.3828C2.53032 58.9997 3.64479 61.2998 8.95365 63.0756C12.6637 64.3166 17.5714 65 22.7728 65C27.9743 65 32.882 64.3166 36.592 63.0756C41.9009 61.2998 43.0154 58.9997 43.0154 57.3828C43.0154 56.1059 42.299 54.2407 38.8868 52.6066ZM2.53032 22.8516C2.53032 11.6512 11.6111 2.53906 22.7728 2.53906C33.9346 2.53906 43.0154 11.6512 43.0154 22.8516C43.0154 32.2773 37.3572 40.7804 32.6106 46.2538C28.5331 50.9557 24.4062 54.2948 22.7728 55.5468C21.1391 54.2944 17.0122 50.9553 12.9351 46.254C8.18848 40.7804 2.53032 32.2773 2.53032 22.8516ZM35.7918 60.667C32.333 61.8238 27.7095 62.4609 22.7728 62.4609C17.8362 62.4609 13.2127 61.8238 9.75386 60.667C6.28973 59.5083 5.06063 58.1736 5.06063 57.3828C5.06063 56.0639 8.35776 53.7926 15.6671 52.7777C16.7496 53.8101 17.7575 54.7088 18.6383 55.4611C17.2962 55.9264 16.4471 56.6145 16.4471 57.3828C16.4471 58.7856 19.2797 59.9219 22.7728 59.9219C26.2659 59.9219 29.0986 58.7856 29.0986 57.3828C29.0986 56.6145 28.2495 55.9264 26.9074 55.4611C27.7882 54.7088 28.7961 53.8101 29.8786 52.7777C37.1879 53.7926 40.4851 56.0639 40.4851 57.3828C40.4851 58.1736 39.256 59.5083 35.7918 60.667Z"
                                        fill="currentColor"></path>
                                    <path d="M40.485 22.8516C40.485 13.0513 32.5393 5.07812 22.7728 5.07812C13.0062 5.07812 5.06055 13.0513 5.06055 22.8516C5.06055 32.6518 13.0062 40.625 22.7728 40.625C32.5393 40.625 40.485 32.6518 40.485 22.8516ZM7.59086 22.8516C7.59086 14.4513 14.4015 7.61719 22.7728 7.61719C31.1441 7.61719 37.9547 14.4513 37.9547 22.8516C37.9547 31.2518 31.1441 38.0859 22.7728 38.0859C14.4015 38.0859 7.59086 31.2518 7.59086 22.8516Z" fill="currentColor"></path>
                                    <path d="M24.038 31.7383C24.038 32.4394 24.6044 33.0078 25.3031 33.0078H30.3637C31.0625 33.0078 31.6289 32.4394 31.6289 31.7383V25.3906H34.1592C34.6845 25.3906 35.1551 25.065 35.3418 24.5723C35.5284 24.0796 35.3922 23.5224 34.9997 23.1722L23.6132 13.016C23.1339 12.5884 22.4116 12.5884 21.9322 13.016L10.5458 23.1722C10.1532 23.5224 10.0171 24.0796 10.2037 24.5723C10.3903 25.065 10.8611 25.3906 11.3864 25.3906H13.9167V31.7383C13.9167 32.4394 14.4831 33.0078 15.1818 33.0078H20.2425C20.9412 33.0078 21.5076 32.4394 21.5076 31.7383V27.9297H24.038V31.7383ZM20.2425 25.3906C19.5437 25.3906 18.9773 25.959 18.9773 26.6602V30.4687H16.447V24.1211C16.447 23.4199 15.8806 22.8516 15.1818 22.8516H14.714L22.7728 15.6633L30.8316 22.8516H30.3637C29.665 22.8516 29.0986 23.4199 29.0986 24.1211V30.4687H26.5683V26.6602C26.5683 25.959 26.0019 25.3906 25.3031 25.3906H20.2425Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="contact__us--info__content">
                                <h3 class="contact__us--info__title">Office address</h3>
                                <p class="contact__us--info__text desc">
                                    Jalan Pantai Batu Bolong No.15, Canggu, 80351 BALI
                                </p>
                            </div>
                        </div>
                        <div class="contact__us--info__list d-flex align-items-center">
                            <span class="contact__us--info__icon">
                                <svg width="58" height="58" viewBox="0 0 58 58" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="M45.7084 35.8604C44.5233 34.6264 43.0938 33.9666 41.5788 33.9666C40.076 33.9666 38.6343 34.6141 37.4003 35.8481L33.5394 39.6968C33.2218 39.5257 32.9041 39.3669 32.5987 39.208C32.1588 38.9881 31.7434 38.7804 31.3891 38.5605C27.7726 36.2635 24.486 33.2702 21.3338 29.3971C19.8066 27.4667 18.7803 25.8417 18.035 24.1923C19.0368 23.276 19.9654 22.323 20.8695 21.4066C21.2116 21.0645 21.5537 20.7102 21.8958 20.3681C24.4616 17.8024 24.4616 14.4791 21.8958 11.9134L18.5603 8.57788C18.1816 8.19912 17.7906 7.80815 17.4241 7.41718C16.691 6.65967 15.9213 5.87773 15.1271 5.14466C13.942 3.97174 12.5247 3.34863 11.0341 3.34863C9.54355 3.34863 8.10184 3.97174 6.88006 5.14466C6.86784 5.15688 6.86784 5.15688 6.85562 5.16909L2.70155 9.35982C1.13766 10.9237 0.24576 12.8297 0.0502747 15.0411C-0.242954 18.6087 0.807782 21.932 1.61416 24.1068C3.59345 29.446 6.55018 34.3942 10.9608 39.6968C16.3122 46.0867 22.7511 51.1327 30.1062 54.6881C32.9163 56.0198 36.6672 57.5959 40.8579 57.8647C41.1145 57.8769 41.3833 57.8892 41.6277 57.8892C44.45 57.8892 46.8202 56.8751 48.6774 54.8591C48.6896 54.8347 48.714 54.8225 48.7262 54.798C49.3616 54.0283 50.0946 53.3319 50.8644 52.5866C51.3897 52.0857 51.9273 51.5603 52.4527 51.0105C53.6622 49.7521 54.2976 48.2859 54.2976 46.7831C54.2976 45.2681 53.65 43.8142 52.416 42.5924L45.7084 35.8604ZM50.0824 48.7258C50.0702 48.7258 50.0702 48.738 50.0824 48.7258C49.6059 49.2389 49.1172 49.7032 48.5918 50.2163C47.7977 50.9739 46.9913 51.768 46.2338 52.6599C44.9998 53.9794 43.5459 54.6026 41.6399 54.6026C41.4566 54.6026 41.2611 54.6026 41.0779 54.5903C37.4491 54.3582 34.077 52.9409 31.5479 51.7314C24.6326 48.3837 18.5603 43.6309 13.5144 37.6075C9.34807 32.586 6.56239 27.9432 4.7175 22.9583C3.58124 19.916 3.16583 17.5458 3.3491 15.3099C3.47128 13.8804 4.02108 12.6953 5.03516 11.6812L9.20145 7.51492C9.80013 6.9529 10.4355 6.64745 11.0586 6.64745C11.8283 6.64745 12.4514 7.11173 12.8424 7.50271C12.8546 7.51492 12.8668 7.52714 12.879 7.53936C13.6243 8.23578 14.333 8.95663 15.0782 9.72636C15.457 10.1173 15.848 10.5083 16.2389 10.9115L19.5744 14.247C20.8695 15.5421 20.8695 16.7394 19.5744 18.0345C19.2201 18.3888 18.878 18.7431 18.5237 19.0852C17.4974 20.136 16.52 21.1134 15.457 22.0664C15.4326 22.0908 15.4081 22.103 15.3959 22.1275C14.3452 23.1782 14.5407 24.2045 14.7606 24.9009C14.7728 24.9376 14.785 24.9742 14.7972 25.0109C15.6647 27.1124 16.8865 29.0917 18.7436 31.4497L18.7558 31.4619C22.1279 35.616 25.6833 38.8537 29.6053 41.334C30.1062 41.6516 30.6194 41.9082 31.1081 42.1526C31.5479 42.3725 31.9633 42.5802 32.3176 42.8001C32.3665 42.8245 32.4154 42.8612 32.4643 42.8856C32.8797 43.0933 33.2706 43.1911 33.6738 43.1911C34.6879 43.1911 35.3232 42.5557 35.5309 42.348L39.7094 38.1695C40.1249 37.7541 40.7846 37.2532 41.5543 37.2532C42.3119 37.2532 42.935 37.7297 43.3137 38.1451C43.3259 38.1573 43.3259 38.1573 43.3382 38.1695L50.0702 44.9016C51.3286 46.1478 51.3286 47.4307 50.0824 48.7258Z"
                                        fill="currentColor"></path>
                                    <path d="M31.2424 13.7701C34.4435 14.3077 37.3514 15.8227 39.6728 18.1441C41.9942 20.4655 43.497 23.3733 44.0468 26.5744C44.1812 27.3808 44.8776 27.9428 45.6717 27.9428C45.7695 27.9428 45.855 27.9306 45.9527 27.9184C46.8569 27.7717 47.4555 26.9165 47.3089 26.0124C46.6492 22.1393 44.8165 18.6084 42.0186 15.8105C39.2207 13.0126 35.6897 11.1799 31.8167 10.5201C30.9126 10.3735 30.0695 10.9722 29.9107 11.8641C29.7519 12.756 30.3383 13.6235 31.2424 13.7701Z" fill="currentColor"></path>
                                    <path d="M57.7802 25.536C56.6929 19.1583 53.6873 13.3548 49.0689 8.73648C44.4506 4.11813 38.6471 1.11254 32.2694 0.0251462C31.3774 -0.133686 30.5344 0.477207 30.3756 1.36911C30.229 2.27323 30.8276 3.11626 31.7318 3.2751C37.4253 4.24031 42.6179 6.94045 46.7475 11.0579C50.8772 15.1875 53.5651 20.3801 54.5303 26.0736C54.6647 26.88 55.3611 27.442 56.1553 27.442C56.253 27.442 56.3385 27.4298 56.4363 27.4176C57.3282 27.2832 57.9391 26.4279 57.7802 25.536Z" fill="currentColor"></path>
                                </svg>
                            </span>
                            <div class="contact__us--info__content">
                                <h3 class="contact__us--info__title">Phone Number</h3>
                                <p class="contact__us--info__text">
                                    <a href="tel:+6285333777500">(+62) 85 333 777 500</a> <br>
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="contact__us--map" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d4252.736080202217!2d115.14375767501424!3d-8.63751849140902!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2dd2396ef65fc29b%3A0x8df0c383939f0356!2sBalimmo!5e1!3m2!1sen!2sid!4v1746007931838!5m2!1sen!2sid" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                    </div>
                </div>
                {{-- <div class="contact__form" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="20">
                    <div class="contact__form--header mb-40">
                        <h2 class="contact__form--title">Drop Us a Line</h2>
                        <p class="contact__form--desc">Your email address will not be published. Required fields are marked *</p>
                    </div>
                    <form action="#">
                        <div class="row mb--n30">
                            <div class="col-lg-6 col-md-6 mb-30">
                                <div class="contact__form--input position-relative">
                                    <input class="contact__form--input__field" placeholder="Enter Your Name*" type="text">
                                    <span class="contact__form--input__icon"><svg width="18" height="21" viewBox="0 0 18 21" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M12.4922 12.375C11.3594 12.375 10.8516 13 9.01562 13C7.14062 13 6.63281 12.375 5.5 12.375C2.60938 12.375 0.265625 14.7578 0.265625 17.6484V18.625C0.265625 19.6797 1.08594 20.5 2.14062 20.5H15.8906C16.9062 20.5 17.7656 19.6797 17.7656 18.625V17.6484C17.7656 14.7578 15.3828 12.375 12.4922 12.375ZM15.8906 18.625H2.14062V17.6484C2.14062 15.7734 3.625 14.25 5.5 14.25C6.08594 14.25 6.98438 14.875 9.01562 14.875C11.0078 14.875 11.9062 14.25 12.4922 14.25C14.3672 14.25 15.8906 15.7734 15.8906 17.6484V18.625ZM9.01562 11.75C12.1016 11.75 14.6406 9.25 14.6406 6.125C14.6406 3.03906 12.1016 0.5 9.01562 0.5C5.89062 0.5 3.39062 3.03906 3.39062 6.125C3.39062 9.25 5.89062 11.75 9.01562 11.75ZM9.01562 2.375C11.0469 2.375 12.7656 4.09375 12.7656 6.125C12.7656 8.19531 11.0469 9.875 9.01562 9.875C6.94531 9.875 5.26562 8.19531 5.26562 6.125C5.26562 4.09375 6.94531 2.375 9.01562 2.375Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <div class="contact__form--input position-relative">
                                    <input class="contact__form--input__field" placeholder="Enter Email Address*" type="email">
                                    <span class="contact__form--input__icon"><svg width="20" height="15" viewBox="0 0 20 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path d="M18.125 0H1.875C0.820312 0 0 0.859375 0 1.875V13.125C0 14.1797 0.820312 15 1.875 15H18.125C19.1406 15 20 14.1797 20 13.125V1.875C20 0.859375 19.1406 0 18.125 0ZM18.125 1.875V3.47656C17.2266 4.21875 15.8203 5.3125 12.8516 7.65625C12.1875 8.16406 10.8984 9.41406 10 9.375C9.0625 9.41406 7.77344 8.16406 7.10938 7.65625C4.14062 5.3125 2.73438 4.21875 1.875 3.47656V1.875H18.125ZM1.875 13.125V5.89844C2.73438 6.60156 4.02344 7.61719 5.9375 9.14062C6.79688 9.80469 8.32031 11.2891 10 11.25C11.6406 11.2891 13.125 9.80469 14.0234 9.14062C15.9375 7.61719 17.2266 6.60156 18.125 5.89844V13.125H1.875Z" fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <div class="contact__form--input select">
                                    <select class="contact__form--select">
                                        <option selected="" value="1">Property Type</option>
                                        <option value="2">Bungalow</option>
                                        <option value="3">Condo</option>
                                        <option value="4">Apartment</option>
                                        <option value="5">House</option>
                                        <option value="6">Single Family</option>
                                        <option value="7">Land</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-6 col-md-6 mb-30">
                                <div class="contact__form--input position-relative">
                                    <input class="contact__form--input__field" placeholder="Enter Phone Number" type="text">
                                    <span class="contact__form--input__icon"><svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M15.853 12.6964C15.853 12.8973 15.8158 13.1615 15.7414 13.4888C15.6669 13.8088 15.5888 14.0618 15.507 14.2478C15.3507 14.6198 14.8969 15.0141 14.1454 15.4308C13.446 15.8103 12.754 16 12.0695 16C11.8686 16 11.6714 15.9888 11.478 15.9665C11.2845 15.9368 11.0687 15.8884 10.8306 15.8214C10.6 15.7545 10.4251 15.7024 10.3061 15.6652C10.1945 15.6205 9.98986 15.5424 9.69224 15.4308C9.39462 15.3192 9.21233 15.2522 9.14537 15.2299C8.4162 14.9695 7.76516 14.6607 7.19224 14.3036C6.2473 13.7158 5.26516 12.9122 4.24581 11.8929C3.22647 10.8735 2.4229 9.89137 1.8351 8.94643C1.47796 8.37351 1.16918 7.72247 0.908761 6.9933C0.88644 6.92634 0.819475 6.74405 0.707868 6.44643C0.596261 6.14881 0.518136 5.9442 0.473493 5.83259C0.436291 5.71354 0.384208 5.53869 0.317243 5.30804C0.250279 5.06994 0.201916 4.85417 0.172154 4.66071C0.149833 4.46726 0.138672 4.27009 0.138672 4.0692C0.138672 3.38467 0.328404 2.69271 0.707868 1.9933C1.12454 1.24181 1.51888 0.787946 1.8909 0.631696C2.07692 0.549851 2.32989 0.471726 2.64983 0.397321C2.97721 0.322916 3.24135 0.285713 3.44224 0.285713C3.54641 0.285713 3.62454 0.296874 3.67662 0.319196C3.81055 0.363839 4.00772 0.646577 4.26814 1.16741C4.34998 1.30878 4.46159 1.50967 4.60296 1.77009C4.74433 2.03051 4.87454 2.2686 4.99358 2.48437C5.11263 2.69271 5.22796 2.88988 5.33957 3.07589C5.36189 3.10565 5.42513 3.19866 5.5293 3.35491C5.6409 3.51116 5.72275 3.64509 5.77483 3.7567C5.82692 3.86086 5.85296 3.96503 5.85296 4.0692C5.85296 4.21801 5.74507 4.40402 5.5293 4.62723C5.32096 4.85045 5.09031 5.05506 4.83733 5.24107C4.5918 5.42708 4.36114 5.62426 4.14537 5.83259C3.93704 6.04092 3.83287 6.21205 3.83287 6.34598C3.83287 6.41295 3.85147 6.49851 3.88867 6.60268C3.92587 6.6994 3.95564 6.77381 3.97796 6.82589C4.00772 6.87798 4.0598 6.96726 4.13421 7.09375C4.21605 7.22024 4.2607 7.29092 4.26814 7.3058C4.83361 8.32515 5.48093 9.1994 6.2101 9.92857C6.93927 10.6577 7.81352 11.3051 8.83287 11.8705C8.84775 11.878 8.91843 11.9226 9.04492 12.0045C9.17141 12.0789 9.2607 12.131 9.31278 12.1607C9.36486 12.183 9.43927 12.2128 9.53599 12.25C9.64016 12.2872 9.72573 12.3058 9.79269 12.3058C9.92662 12.3058 10.0977 12.2016 10.3061 11.9933C10.5144 11.7775 10.7116 11.5469 10.8976 11.3013C11.0836 11.0484 11.2882 10.8177 11.5114 10.6094C11.7347 10.3936 11.9207 10.2857 12.0695 10.2857C12.1736 10.2857 12.2778 10.3118 12.382 10.3638C12.4936 10.4159 12.6275 10.4978 12.7838 10.6094C12.94 10.7135 13.033 10.7768 13.0628 10.7991C13.2488 10.9107 13.446 11.026 13.6543 11.1451C13.8701 11.2641 14.1082 11.3943 14.3686 11.5357C14.629 11.6771 14.8299 11.7887 14.9713 11.8705C15.4921 12.131 15.7748 12.3281 15.8195 12.4621C15.8418 12.5141 15.853 12.5923 15.853 12.6964Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                            <div class="col-12 mb-30">
                                <div class="contact__form--textarea position-relative">
                                    <textarea class="contact__form--textarea__field" placeholder="Enter Your Messege here"></textarea>
                                    <span class="contact__form--textarea__icon"><svg width="22" height="18" viewBox="0 0 22 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                                            <path
                                                d="M10.9018 13.6786L12.3259 12.2545L10.4598 10.3884L9.03571 11.8125V12.5H10.2143V13.6786H10.9018ZM16.2913 5.24442C16.4304 5.10528 16.4345 4.97024 16.3036 4.83928C16.1726 4.70833 16.0376 4.71243 15.8984 4.85156L11.6016 9.14844C11.4624 9.28757 11.4583 9.42262 11.5893 9.55357C11.7202 9.68452 11.8553 9.68043 11.9944 9.54129L16.2913 5.24442ZM17.2857 12.1317V14.4643C17.2857 15.4382 16.9379 16.2731 16.2422 16.9687C15.5547 17.6562 14.724 18 13.75 18H3.53571C2.56176 18 1.72693 17.6562 1.03125 16.9687C0.34375 16.2731 0 15.4382 0 14.4643V4.25C0 3.27604 0.34375 2.44531 1.03125 1.75781C1.72693 1.06213 2.56176 0.714285 3.53571 0.714285H13.75C14.2656 0.714285 14.7444 0.816591 15.1864 1.0212C15.3092 1.0785 15.3828 1.17262 15.4074 1.30357C15.4319 1.44271 15.3951 1.56138 15.2969 1.6596L14.6953 2.26116C14.5807 2.37574 14.4498 2.40848 14.3025 2.35937C14.1142 2.31027 13.9301 2.28571 13.75 2.28571H3.53571C2.99554 2.28571 2.53311 2.47805 2.14844 2.86272C1.76376 3.2474 1.57143 3.70982 1.57143 4.25V14.4643C1.57143 15.0045 1.76376 15.4669 2.14844 15.8516C2.53311 16.2362 2.99554 16.4286 3.53571 16.4286H13.75C14.2902 16.4286 14.7526 16.2362 15.1373 15.8516C15.5219 15.4669 15.7143 15.0045 15.7143 14.4643V12.9174C15.7143 12.811 15.7511 12.721 15.8248 12.6473L16.6105 11.8616C16.7333 11.7388 16.8765 11.7102 17.0402 11.7757C17.2039 11.8411 17.2857 11.9598 17.2857 12.1317ZM16.1071 3.07143L19.6429 6.60714L11.3929 14.8571H7.85714V11.3214L16.1071 3.07143ZM21.558 4.69196L20.4286 5.82143L16.8929 2.28571L18.0223 1.15625C18.2515 0.927082 18.5298 0.812499 18.8571 0.812499C19.1845 0.812499 19.4628 0.927082 19.692 1.15625L21.558 3.02232C21.7872 3.25149 21.9018 3.52976 21.9018 3.85714C21.9018 4.18452 21.7872 4.4628 21.558 4.69196Z"
                                                fill="currentColor" />
                                        </svg>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <button class="contact__form--btn solid__btn">Post a Comment</button>
                    </form>
                </div> --}}
            </div>
        </div>
    </section>
    <!-- Contact page section . -->

    <!-- Contact Property section -->
    <section class="contact__property--section section--padding" style="padding-top: 0;">
        <div class="container">
            <div class="section__heading mb-50 text-center" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="100">
                <h3 class="section__heading--subtitle h5"><svg width="18" height="18" viewBox="0 0 18 18" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <g clip-path="url(#clip0_15_6)">
                            <path d="M9.00021 4.72925L2.5806 10.0215C2.5806 10.029 2.57872 10.04 2.57497 10.055C2.57129 10.0698 2.56934 10.0806 2.56934 10.0883V15.4473C2.56934 15.6408 2.64008 15.8085 2.78152 15.9497C2.92292 16.091 3.09037 16.1621 3.2839 16.1621H7.571V11.8747H10.4295V16.1622H14.7165C14.91 16.1622 15.0777 16.0913 15.2189 15.9497C15.3603 15.8086 15.4313 15.6408 15.4313 15.4473V10.0883C15.4313 10.0586 15.4272 10.0361 15.4201 10.0215L9.00021 4.72925Z" fill="#063436" />
                            <path d="M17.8758 8.81572L15.4309 6.78374V2.2285C15.4309 2.12437 15.3974 2.03872 15.3302 1.9717C15.2636 1.90475 15.178 1.87128 15.0736 1.87128H12.93C12.8258 1.87128 12.7401 1.90475 12.6731 1.9717C12.6062 2.03872 12.5727 2.1244 12.5727 2.2285V4.4056L9.8486 2.12792C9.61069 1.93439 9.3278 1.83765 9.00026 1.83765C8.67275 1.83765 8.3899 1.93439 8.15175 2.12792L0.124063 8.81572C0.0496462 8.87516 0.00885955 8.95517 0.00127316 9.05567C-0.00627412 9.15609 0.0197308 9.2438 0.079366 9.31818L0.771565 10.1444C0.831201 10.2113 0.909254 10.2523 1.00604 10.2673C1.09539 10.2748 1.18475 10.2486 1.27411 10.1891L9.00002 3.74687L16.726 10.1891C16.7857 10.241 16.8637 10.2669 16.9605 10.2669H16.994C17.0907 10.2522 17.1686 10.211 17.2285 10.1442L17.9208 9.31814C17.9803 9.2436 18.0064 9.15605 17.9987 9.05551C17.991 8.95528 17.9501 8.87527 17.8758 8.81572Z" fill="#063436" />
                        </g>
                        <defs>
                            <clipPath>
                                <rect width="18" height="18" fill="white" />
                            </clipPath>
                        </defs>
                    </svg>
                    Contact us</h3>
                <h2 class="section__heading--title">Find your property faster with our help</h2>
            </div>
            <div class="contact__property--inner d-flex">
                <div class="contact__property--content" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="150">
                    <p class="contact__property--desc">Trust a team who knows the market. Our experts are ready to help you find the place that perfectly fit your needs and makes you feel home.</p>
                    <ul class="contact__property--info">
                        <li class="contact__property--info__text"><svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.9001 1.62081C14.0668 1.78748 14.1501 1.98986 14.1501 2.22796C14.1501 2.46605 14.0668 2.66843 13.9001 2.8351L7.43583 9.29939L6.22154 10.5137C6.05487 10.6803 5.85249 10.7637 5.6144 10.7637C5.3763 10.7637 5.17392 10.6803 5.00725 10.5137L3.79297 9.29939L0.560826 6.06724C0.394159 5.90058 0.310826 5.6982 0.310826 5.4601C0.310826 5.222 0.394159 5.01962 0.560826 4.85296L1.77511 3.63867C1.94178 3.472 2.14416 3.38867 2.38225 3.38867C2.62035 3.38867 2.82273 3.472 2.9894 3.63867L5.6144 6.2726L11.4715 0.406528C11.6382 0.239862 11.8406 0.156528 12.0787 0.156528C12.3168 0.156528 12.5192 0.239862 12.6858 0.406528L13.9001 1.62081Z" fill="currentColor" />
                            </svg>
                            Leasehold or freehold.</li>
                        <li class="contact__property--info__text"><svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.9001 1.62081C14.0668 1.78748 14.1501 1.98986 14.1501 2.22796C14.1501 2.46605 14.0668 2.66843 13.9001 2.8351L7.43583 9.29939L6.22154 10.5137C6.05487 10.6803 5.85249 10.7637 5.6144 10.7637C5.3763 10.7637 5.17392 10.6803 5.00725 10.5137L3.79297 9.29939L0.560826 6.06724C0.394159 5.90058 0.310826 5.6982 0.310826 5.4601C0.310826 5.222 0.394159 5.01962 0.560826 4.85296L1.77511 3.63867C1.94178 3.472 2.14416 3.38867 2.38225 3.38867C2.62035 3.38867 2.82273 3.472 2.9894 3.63867L5.6144 6.2726L11.4715 0.406528C11.6382 0.239862 11.8406 0.156528 12.0787 0.156528C12.3168 0.156528 12.5192 0.239862 12.6858 0.406528L13.9001 1.62081Z" fill="currentColor" />
                            </svg>
                            Invest or living. </li>
                        <li class="contact__property--info__text"><svg width="15" height="11" viewBox="0 0 15 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M13.9001 1.62081C14.0668 1.78748 14.1501 1.98986 14.1501 2.22796C14.1501 2.46605 14.0668 2.66843 13.9001 2.8351L7.43583 9.29939L6.22154 10.5137C6.05487 10.6803 5.85249 10.7637 5.6144 10.7637C5.3763 10.7637 5.17392 10.6803 5.00725 10.5137L3.79297 9.29939L0.560826 6.06724C0.394159 5.90058 0.310826 5.6982 0.310826 5.4601C0.310826 5.222 0.394159 5.01962 0.560826 4.85296L1.77511 3.63867C1.94178 3.472 2.14416 3.38867 2.38225 3.38867C2.62035 3.38867 2.82273 3.472 2.9894 3.63867L5.6144 6.2726L11.4715 0.406528C11.6382 0.239862 11.8406 0.156528 12.0787 0.156528C12.3168 0.156528 12.5192 0.239862 12.6858 0.406528L13.9001 1.62081Z" fill="currentColor" />
                            </svg>
                            Anywhere you want in Bali</li>
                    </ul>
                    <div class="contact__property--thumb">
                        <img src="{{ asset('landing') }}/assets/img/other/contact-property-thumb.avif" alt="img">
                    </div>
                </div>
                <div class="contact__property--form" data-aos="fade-up" data-aos-duration="1200" data-aos-delay="200">
                    <form action="{{ route('booking') }}" method="POST">
                        @csrf
                        <h3 class="contact__property--form__title">Contact Us</h3>
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

                            <!-- Looking For Field -->
                            <div class="contact__property--form__input">
                                <label for="looking_for">Looking For*</label>
                                <ul class="interior__amenities--check d-flex gap-4" id="looking_for">
                                    <li class="interior__amenities--check__list mb-0">
                                        <label class="interior__amenities--check__label mb-0" style="padding-left: 2.5rem;" for="villa">
                                            <svg width="16" height="16" viewBox="0 0 14 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z" fill="#063436"></path>
                                            </svg>
                                            Villa
                                        </label>
                                        <input value="villa" name="looking_for" class="interior__amenities--check__input" id="villa" type="checkbox">
                                        <span class="interior__amenities--checkmark"></span>
                                    </li>
                                    <li class="interior__amenities--check__list mb-0">
                                        <label class="interior__amenities--check__label mb-0" style="padding-left: 2.5rem;" for="land">
                                            <svg  xmlns="http://www.w3.org/2000/svg" width="18" height="18"  
                                            fill="#063436" viewBox="0 0 24 24" >
                                            <path d="M19 3H5c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2M5 19V5h14v14z"></path><path d="M12 9h3v3h2V7h-5zM9 12H7v5h5v-2H9z"></path>
                                            </svg>    
                                            Land
                                        </label>
                                        <input value="land" name="looking_for" class="interior__amenities--check__input" id="land" type="checkbox">
                                        <span class="interior__amenities--checkmark"></span>
                                    </li>                                  
                                </ul>
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
                            <div id="looking_for_villa" style="display: none;">
                                <div class="text-center d-flex justify-items-center justify-content-center">
                                    <hr class="w-100" />
                                    <label class="w-100">Looking For Villa</label>
                                    <hr class="w-100" />
                                </div>
                                <div class="contact__property--form__input" id="villa_budget_idr" style="display: none;">
                                    <label for="budget_idr">Budget IDR*</label>
                                    <div class="widget__price--filtering">
                                        <div class="price-input">
                                            <input type="text" class="input-min bg-white" name="budget_idr_min" id="minPriceFilter" placeholder="IDR 100 000 000">
                                            <div class="separator">-</div>
                                            <input type="text" class="input-max bg-white" name="budget_idr_max" id="maxPriceFilter" placeholder="IDR 50 000 000 000">
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
                                            <input type="text" class="input-min bg-white" name="budget_usd_min" id="minPriceFilter" placeholder="$ 1 000">
                                            <div class="separator">-</div>
                                            <input type="text" class="input-max bg-white" name="budget_usd_max" id="maxPriceFilter" placeholder="$ 100 000">
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

                            <!-- looking_for_land -->
                            <div id="looking_for_land" style="display: none;">
                                <div class="text-center d-flex justify-items-center justify-content-center">
                                    <hr class="w-100" />
                                    <label class="w-100">Looking For Land</label>
                                    <hr class="w-100" />
                                </div>
                                <div class="contact__property--form__input" id="land_budget_idr" style="display: none;">
                                    <label for="budget_idr">Budget IDR*</label>
                                    <div class="widget__price--filtering">
                                        <div class="price-input">
                                            <input type="text" class="input-min bg-white" name="budget_idr_min" id="minPriceFilter" placeholder="IDR 100 000 000">
                                            <div class="separator">-</div>
                                            <input type="text" class="input-max bg-white" name="budget_idr_max" id="maxPriceFilter" placeholder="IDR 50 000 000 000">
                                        </div>                               
                                    </div>

                                    @error('budget_idr')
                                        <p class="text-danger my-2">{{ $message }}</p>
                                    @enderror
                                </div>
                            
                                <div class="contact__property--form__input" id="land_budget_usd" style="display: none;">
                                    <label for="budget_usd">Budget USD*</label>
                                    <div class="widget__price--filtering">
                                        <div class="price-input">
                                            <input type="text" class="input-min bg-white" name="budget_usd_min" id="minPriceFilter" placeholder="$ 1 000">
                                            <div class="separator">-</div>
                                            <input type="text" class="input-max bg-white" name="budget_usd_max" id="maxPriceFilter" placeholder="$ 100 000">
                                        </div>                               
                                    </div>

                                    @error('budget_usd')
                                        <p class="text-danger my-2">{{ $message }}</p>
                                    @enderror
                                </div>

                                <div class="contact__property--form__input" id="land_location">
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
                    </form>
                </div>
            </div>
        </div>
    </section>
    <!-- Contact Property section .\ -->

@endsection
@push('scripts')
    <script src="{{ asset('admin/assets/js/jquery.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/cleave.min.js') }}"></script>
    <script src="{{ asset('admin/assets/js/flatpickr-min.js') }}"></script>

    <script>
    document.addEventListener("DOMContentLoaded", function () {
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

        // Villa
        if (villaCheckbox.checked) {
            villaSection.style.display = "block";
            villaIDR.style.display = (currency === "idr") ? "block" : "none";
            villaUSD.style.display = (currency === "usd") ? "block" : "none";
        } else {
            villaSection.style.display = "none";
        }

        // Land
        if (landCheckbox.checked) {
            landSection.style.display = "block";
            landIDR.style.display = (currency === "idr") ? "block" : "none";
            landUSD.style.display = (currency === "usd") ? "block" : "none";
        } else {
            landSection.style.display = "none";
        }
        }

        // Bind change listeners
        villaCheckbox.addEventListener("change", updateVisibility);
        landCheckbox.addEventListener("change", updateVisibility);
        currencySelect.addEventListener("change", updateVisibility);

        // Hide all on load
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
        const cleaveFields = [{
                id: '#budget_idr',
                options: {
                    prefix: 'IDR '
                }
            },
            {
                id: '#budget_usd',
                options: {
                    numeral: true,
                    numeralThousandsGroupStyle: 'thousand',
                    prefix: '$ ',
                    noImmediatePrefix: true,
                    numeralDecimalMark: '.',
                    delimiter: ',',
                }
            },
            {
                id: '#minPriceFilter',
                options: {
                    prefix: 'IDR '
                }
            },
            {
                id: '#maxPriceFilter',
                options: {
                    prefix: 'IDR '
                }
            },
        ];

        cleaveFields.forEach(field => {
            new Cleave(field.id, {
                numeral: true,
                numeralThousandsGroupStyle: 'thousand',
                prefix: '$ ',
                noImmediatePrefix: true,
                numeralDecimalMark: '.',
                delimiter: ',',
                ...field.options // spread operator untuk custom config
            });
        });
    </script>
@endpush
