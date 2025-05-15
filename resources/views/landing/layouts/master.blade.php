<!doctype html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <title>Balimmo Properties - Real Estate</title>
  <meta name="description" content="Morden Bootstrap HTML5 Template">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landing') }}/assets/img/favicon.ico">

   <!-- ======= All CSS Plugins here ======== -->
  <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/plugins/swiper-bundle.min.css">

  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800;900&family=Nunito:wght@300;400;500;600;700&display=swap" rel="stylesheet">

  <!-- Plugin css -->
  <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/vendor/bootstrap.min.css">
  <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/plugins/swiper-bundle.min.css">
  <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/plugins/glightbox.min.css">
  <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/plugins/aos.css">

  <!-- Custom Style CSS -->
  <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/style.css">
  <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/rtl.css">

  @stack('style')



</head>

<body>
    <!-- Preloader start -->
    <div id="preloader">
        <div class="loader--border"></div>
    </div>
    <!-- Preloader end -->
    <!-- Start header area -->
    @include('landing.layouts.header')
    <!-- End header area -->

    @include('landing.layouts.off-canvas')

    <main class="main__content_wrapper">
        
       @yield('content')
    
        <!-- Start footer section -->
        <footer class="footer footer__section color-offwhite">
            <div class="container">
                <div class="main__footer">
                    <div class="row ">
                        <div class="col-xl-5 col-lg-4 col-md-5">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title about">About Us <button class="footer__widget--button" aria-label="footer widget button"></button>
                                    <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                        <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                                    </svg>
                                </h2>
                                <div class="footer__widget--inner">
                                    <div class="footer__logo">
                                        <a class="footer__logo--link display-block" href="index.html">
                                            <img class="footer__logo--img" src="{{ asset('landing') }}/assets/img/logo/nav-log-white.png" width="200px" alt="logo-img">
                                        </a>
                                    </div>
                                    <p class="footer__widget--desc">Discover leading properties and secure your dream home with us. <br> Expert guidance and support at every step.</p>
                                    <ul class="footer__widget--info">
                                        <li class="footer__widget--info_list">
                                            <svg class="footer__widget--info__icon" width="22" height="23" viewBox="0 0 22 23" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M11.3641 0C6.97117 0 3.39868 3.86831 3.39868 8.625C3.39868 14.6036 10.5888 22.4581 10.8941 22.7901C11.0242 22.9296 11.1942 23 11.3641 23C11.534 23 11.704 22.9296 11.8341 22.7901C12.1394 22.4581 19.3295 14.6036 19.3295 8.625C19.3295 3.86831 15.757 0 11.3641 0ZM11.3641 21.2419C9.77898 19.4048 4.72625 13.1919 4.72625 8.625C4.72625 4.66181 7.70399 1.4375 11.3641 1.4375C15.0242 1.4375 18.002 4.66181 18.002 8.625C18.002 13.1876 12.9492 19.4048 11.3641 21.2419Z" fill="#063436"/>
                                                <path d="M11.3638 4.3125C9.16801 4.3125 7.3811 6.24737 7.3811 8.625C7.3811 11.0026 9.16801 12.9375 11.3638 12.9375C13.5596 12.9375 15.3465 11.0026 15.3465 8.625C15.3465 6.24737 13.5596 4.3125 11.3638 4.3125ZM11.3638 11.5C9.8995 11.5 8.70867 10.2106 8.70867 8.625C8.70867 7.03944 9.8995 5.75 11.3638 5.75C12.8281 5.75 14.019 7.03944 14.019 8.625C14.019 10.2106 12.8281 11.5 11.3638 11.5Z" fill="#063436"/>
                                            </svg>
                                            <p class="footer__widget--info__text">Jalan Pantai Batu Bolong No.15, Canggu, 80351 BALI</p>
                                        </li>
                                        <li class="footer__widget--info_list">                                     
                                            <svg class="footer__widget--info__icon" width="22" height="22" viewBox="0 0 22 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M2.51763 19.6352C2.20325 19.6334 1.90222 19.4974 1.67992 19.2567C1.45762 19.016 1.33199 18.69 1.33032 18.3496V7.77586C1.332 7.07078 1.59142 6.39509 2.05186 5.89652C2.5123 5.39795 3.13632 5.11705 3.78748 5.11523H15.3749C16.0271 5.11523 16.6528 5.39533 17.1146 5.89409C17.5764 6.39286 17.8367 7.06959 17.8384 7.77586V14.8227C17.8384 15.529 17.5797 16.2065 17.1191 16.7065C16.6584 17.2066 16.0335 17.4884 15.3812 17.4902H5.71765C5.6079 17.4912 5.50123 17.5297 5.41289 17.6002L3.2351 19.3809C3.02744 19.547 2.77583 19.6362 2.51763 19.6352ZM3.78748 6.49023C3.4731 6.49204 3.17207 6.62807 2.94977 6.86878C2.72747 7.10949 2.60184 7.43545 2.60017 7.77586V18.1777L4.65098 16.5002C4.95955 16.2521 5.33329 16.1172 5.71765 16.1152H15.3749C15.6914 16.1152 15.995 15.9791 16.2189 15.7367C16.4428 15.4943 16.5685 15.1655 16.5685 14.8227V7.77586C16.5669 7.43545 16.4412 7.10949 16.2189 6.86878C15.9966 6.62807 15.6956 6.49204 15.3812 6.49023H3.78748Z" fill="currentColor"/>
                                                <path d="M12.0855 12.0522C12.436 12.0522 12.7202 11.7444 12.7202 11.3647C12.7202 10.9851 12.436 10.6772 12.0855 10.6772C11.7351 10.6772 11.4509 10.9851 11.4509 11.3647C11.4509 11.7444 11.7351 12.0522 12.0855 12.0522Z" fill="currentColor"/>
                                                <path d="M9.62168 12.0522C9.97216 12.0522 10.2563 11.7444 10.2563 11.3647C10.2563 10.9851 9.97216 10.6772 9.62168 10.6772C9.27119 10.6772 8.98706 10.9851 8.98706 11.3647C8.98706 11.7444 9.27119 12.0522 9.62168 12.0522Z" fill="currentColor"/>
                                                <path d="M7.08237 12.0522C7.43286 12.0522 7.71698 11.7444 7.71698 11.3647C7.71698 10.9851 7.43286 10.6772 7.08237 10.6772C6.73188 10.6772 6.44775 10.9851 6.44775 11.3647C6.44775 11.7444 6.73188 12.0522 7.08237 12.0522Z" fill="currentColor"/>
                                                <path d="M19.7433 12.6777C19.5749 12.6777 19.4134 12.6053 19.2944 12.4764C19.1753 12.3474 19.1084 12.1726 19.1084 11.9902V5.02586C19.1067 4.68545 18.9811 4.35949 18.7588 4.11878C18.5365 3.87807 18.2355 3.74204 17.9211 3.74023H5.14005C4.97166 3.74023 4.81016 3.6678 4.69109 3.53887C4.57202 3.40994 4.50513 3.23507 4.50513 3.05273C4.50513 2.8704 4.57202 2.69553 4.69109 2.5666C4.81016 2.43767 4.97166 2.36523 5.14005 2.36523H17.9211C18.5723 2.36705 19.1963 2.64795 19.6567 3.14652C20.1172 3.64509 20.3766 4.32078 20.3782 5.02586V11.9902C20.3782 12.1726 20.3114 12.3474 20.1923 12.4764C20.0732 12.6053 19.9117 12.6777 19.7433 12.6777Z" fill="currentColor"/>
                                            </svg>
                                            <a class="footer__widget--info__text" href="mailto:hello@balimmo.properties">hello@balimmo.properties</a>
                                        </li>
                                        <li class="footer__widget--info_list">
                                            <svg class="footer__widget--info__icon" width="20" height="20" viewBox="0 0 20 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M13.31 1.52371L18.6133 2.11296C18.6133 2.11296 19.2026 7.41627 13.31 13.3088C7.41748 19.2014 2.11303 18.6133 2.11303 18.6133L1.52377 13.31L5.64971 10.9529L7.71153 13.0148C7.71153 13.0148 9.18467 12.7201 10.9524 10.9524C12.7202 9.18461 13.0148 7.71147 13.0148 7.71147L10.953 5.64965L13.31 1.52371Z" stroke="currentColor" stroke-width="2"></path>
                                            </svg>
                                            <a class="footer__widget--info__text" href="tel:+6285333777500">: (+62) 85 333 777 500</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>                    
                        <div class="col-xl-2 col-lg-2 col-md-3">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title ">Quick Links <button class="footer__widget--button" aria-label="footer widget button"></button>
                                    <svg class="footer__widget--title__arrowdown--icon" xmlns="http://www.w3.org/2000/svg" width="12.355" height="8.394" viewBox="0 0 10.355 6.394">
                                        <path d="M15.138,8.59l-3.961,3.952L7.217,8.59,6,9.807l5.178,5.178,5.178-5.178Z" transform="translate(-6 -8.59)" fill="currentColor"></path>
                                    </svg>
                                </h2>
                                <ul class="footer__widget--menu footer__widget--inner">                                    
                                    <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ route('landing-page.about') }}">About Us</a></li>
                                    <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ route('landing-page.listing') }}">Listing</a></li>
                                    <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ route('landing-page.contact') }}">Contact Us</a></li>
                                    <li class="footer__widget--menu__list"><a class="footer__widget--menu__text" href="{{ route('landing-page.login') }}">Login</a></li>
                                </ul>
                            </div>
                        </div>
                        <div class="col-xl-2 col-lg-5 col-md-6 mb-4">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title ">Our Social Media</h2>
                                <ul class=" footer__social d-flex align-items-center">
                                    <li class="footer__social--list">
                                        <a class="footer__social--icon" target="_blank" href="https://www.facebook.com/people/Balimmo/61557243686168/">
                                            <svg width="10" height="17" viewBox="0 0 9 15" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.62891 8.625L8.01172 6.10938H5.57812V4.46875C5.57812 3.75781 5.90625 3.10156 7 3.10156H8.12109V0.941406C8.12109 0.941406 7.10938 0.75 6.15234 0.75C4.15625 0.75 2.84375 1.98047 2.84375 4.16797V6.10938H0.601562V8.625H2.84375V14.75H5.57812V8.625H7.62891Z" fill="currentColor"></path>
                                            </svg>
                                            <span class="visually-hidden">Facebook</span>
                                        </a>
                                    </li>                       
                                    <li class="footer__social--list">
                                        <a class="footer__social--icon" target="_blank" href="https://www.instagram.com/balimmo_villa/?igsh=MXJhY2xkMXBnaGplbA%3D%3D#">
                                            <svg width="16" height="16" viewBox="0 0 14 13" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M7.125 3.60547C5.375 3.60547 3.98047 5.02734 3.98047 6.75C3.98047 8.5 5.375 9.89453 7.125 9.89453C8.84766 9.89453 10.2695 8.5 10.2695 6.75C10.2695 5.02734 8.84766 3.60547 7.125 3.60547ZM7.125 8.80078C6.00391 8.80078 5.07422 7.89844 5.07422 6.75C5.07422 5.62891 5.97656 4.72656 7.125 4.72656C8.24609 4.72656 9.14844 5.62891 9.14844 6.75C9.14844 7.89844 8.24609 8.80078 7.125 8.80078ZM11.1172 3.49609C11.1172 3.08594 10.7891 2.75781 10.3789 2.75781C9.96875 2.75781 9.64062 3.08594 9.64062 3.49609C9.64062 3.90625 9.96875 4.23438 10.3789 4.23438C10.7891 4.23438 11.1172 3.90625 11.1172 3.49609ZM13.1953 4.23438C13.1406 3.25 12.9219 2.375 12.2109 1.66406C11.5 0.953125 10.625 0.734375 9.64062 0.679688C8.62891 0.625 5.59375 0.625 4.58203 0.679688C3.59766 0.734375 2.75 0.953125 2.01172 1.66406C1.30078 2.375 1.08203 3.25 1.02734 4.23438C0.972656 5.24609 0.972656 8.28125 1.02734 9.29297C1.08203 10.2773 1.30078 11.125 2.01172 11.8633C2.75 12.5742 3.59766 12.793 4.58203 12.8477C5.59375 12.9023 8.62891 12.9023 9.64062 12.8477C10.625 12.793 11.5 12.5742 12.2109 11.8633C12.9219 11.125 13.1406 10.2773 13.1953 9.29297C13.25 8.28125 13.25 5.24609 13.1953 4.23438ZM11.8828 10.3594C11.6914 10.9062 11.2539 11.3164 10.7344 11.5352C9.91406 11.8633 8 11.7812 7.125 11.7812C6.22266 11.7812 4.30859 11.8633 3.51562 11.5352C2.96875 11.3164 2.55859 10.9062 2.33984 10.3594C2.01172 9.56641 2.09375 7.65234 2.09375 6.75C2.09375 5.875 2.01172 3.96094 2.33984 3.14062C2.55859 2.62109 2.96875 2.21094 3.51562 1.99219C4.30859 1.66406 6.22266 1.74609 7.125 1.74609C8 1.74609 9.91406 1.66406 10.7344 1.99219C11.2539 2.18359 11.6641 2.62109 11.8828 3.14062C12.2109 3.96094 12.1289 5.875 12.1289 6.75C12.1289 7.65234 12.2109 9.56641 11.8828 10.3594Z" fill="currentColor"></path>
                                            </svg>  
                                            <span class="visually-hidden">Instagram</span>
                                        </a>
                                    </li>
                                    <li class="footer__social--list">
                                        <a class="footer__social--icon" target="_blank" href="https://www.tiktok.com/@balimmo?_t=8losSwiYXXW&_r=1">
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M19.59 6.69a4.83 4.83 0 0 1-3.77-4.25V2h-3.45v13.67a2.89 2.89 0 0 1-5.2 1.74 2.89 2.89 0 0 1 2.31-4.64 2.93 2.93 0 0 1 .88.13V9.4a6.84 6.84 0 0 0-1-.05A6.33 6.33 0 0 0 5 20.1a6.34 6.34 0 0 0 10.86-4.43v-7a8.16 8.16 0 0 0 4.77 1.52v-3.4a4.85 4.85 0 0 1-1-.1z" fill="currentColor"></path>
                                            </svg>  
                                            <span class="visually-hidden">Tiktok</span>
                                        </a>
                                    </li>
                                    <li class="footer__social--list">
                                        <a class="footer__social--icon" target="_blank" href="https://www.youtube.com/@Balimmo_villa">                                       
                                            <svg width="20" viewBox="0 0 24 24" fill="none" xmlns="http://www.w3.org/2000/svg">
                                                <path d="M21.593 7.203a2.506 2.506 0 0 0-1.762-1.766C18.265 5.007 12 5 12 5s-6.264-.007-7.831.404a2.56 2.56 0 0 0-1.766 1.778c-.413 1.566-.417 4.814-.417 4.814s-.004 3.264.406 4.814c.23.857.905 1.534 1.763 1.765 1.582.43 7.83.437 7.83.437s6.265.007 7.831-.403a2.515 2.515 0 0 0 1.767-1.763c.414-1.565.417-4.812.417-4.812s.02-3.265-.407-4.831zM9.996 15.005l.005-6 5.207 3.005-5.212 2.995z"  fill="currentColor"></path>
                                            </svg>
                                            <span class="visually-hidden">Youtube</span>
                                        </a>
                                    </li>                                    
                                </ul>  
                            </div>
                        </div>

                        <div class="col-xl-3 col-lg-5 col-md-6">
                            <div class="footer__widget">
                                <h2 class="footer__widget--title ">Asosiasi Real Estate Broker Indonesia</h2>
                                <img src="{{ asset('landing') }}/assets/img/logo/logo-arebi.png" alt="arebi logo" width="75" class="mb-4">
                                <p class="footer__widget--desc">Member Number: 2025000055A</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="footer__bottom">
                <div class="container">
                    <div class="footer__bottom--inner d-flex justify-content-between align-items-center">
                        <p class="copyright__content mb-0"><span class="text__secondary">PT BALIMMO DEVELOPMENT GROUP © 2021 - 2025. All rights reserved</span></p>
                        <div class="footer__payment">
                            <img src="{{ asset('landing') }}/assets/img/icon/payment-img.png" alt="payment-img">
                        </div>
                        <ul class="footer__bottom--menu d-flex">
                            <li><a href="./admin/create-listing.html">Terms of Use</a></li>
                            <li><a href="./admin/create-listing.html">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </footer>
        <!-- End footer section -->
    
    </main>
    
  

    <!-- Scroll top bar -->
    <button id="scroll__top"><svg xmlns="http://www.w3.org/2000/svg" class="ionicon" viewBox="0 0 512 512"><path fill="none" stroke="currentColor" stroke-linecap="round"  stroke-width="48" d="M112 244l144-144 144 144M256 120v292"/></svg></button>
    
   <!-- All Script JS Plugins here  -->
   <script src="{{ asset('landing') }}/assets/js/vendor/popper.js" defer="defer"></script>
   <script src="{{ asset('landing') }}/assets/js/vendor/bootstrap.min.js" defer="defer"></script>
   <script src="{{ asset('landing') }}/assets/js/plugins/swiper-bundle.min.js"></script>
   <script src="{{ asset('landing') }}/assets/js/plugins/glightbox.min.js"></script>
   <script src="{{ asset('landing') }}/assets/js/plugins//aos.js"></script>


  <!-- Customscript js -->
  <script src="{{ asset('landing') }}/assets/js/script.js"></script>

  @stack('scripts')

  
</body>
</html>