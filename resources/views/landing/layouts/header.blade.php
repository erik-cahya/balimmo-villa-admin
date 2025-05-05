<header class="header__section ">
    <div class="header__sticky">
        <a class="humberger__menu" data-bs-toggle="offcanvas" href="#offcanvasExample">
            <svg width="28" height="22" viewBox="0 0 28 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path d="M0 1.03846C0 0.46523 0.465715 0 1.03954 0H19.0583C19.6321 0 20.0978 0.46523 20.0978 1.03846C20.0978 1.61169 19.6321 2.07692 19.0583 2.07692H1.03954C0.465715 2.07692 0 1.61169 0 1.03846ZM25.9885 9.6923H1.03954C0.465715 9.6923 0 10.1575 0 10.7308C0 11.304 0.465715 11.7692 1.03954 11.7692H25.9885C26.5624 11.7692 27.0281 11.304 27.0281 10.7308C27.0281 10.1575 26.5624 9.6923 25.9885 9.6923ZM13.514 19.3846H1.03954C0.465715 19.3846 0 19.8498 0 20.4231C0 20.9963 0.465715 21.4615 1.03954 21.4615H13.514C14.0879 21.4615 14.5536 20.9963 14.5536 20.4231C14.5536 19.8498 14.0879 19.3846 13.514 19.3846Z" fill="currentColor"/>
            </svg>
        </a>
        <div class="container-fluid padding-lr-120">
            <div class="main__header d-flex justify-content-between align-items-center">
                <div class="offcanvas__header--menu__open ">
                    <a class="offcanvas__header--menu__open--btn" href="javascript:void(0)" data-offcanvas>
                        <svg xmlns="http://www.w3.org/2000/svg" class="ionicon offcanvas__header--menu__open--svg" viewBox="0 0 512 512"><path fill="currentColor" stroke="currentColor" stroke-linecap="round" stroke-miterlimit="10" stroke-width="32" d="M80 160h352M80 256h352M80 352h352"/></svg>
                        <span class="visually-hidden">Offcanvas Menu Open</span>
                    </a>
                </div>
                <div class="main__logo">
                    <h1 class="main__logo--title"><a class="main__logo--link" href="index.html">
                        <img class="main__logo--img" src="{{ asset('landing') }}/assets/img/logo/nav-logo.png" alt="logo-img" width="250px">
                    </a></h1>
                </div>
                <div class="main__menu d-none d-lg-block">
                    <nav class="main__menu--navigation">
                        <ul class="main__menu--wrapper d-flex">
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="{{ route('landing-page.index') }}"><svg width="11" height="11" viewBox="0 0 11 11" fill="none" xmlns="http://www.w3.org/2000/svg">
                                    <path d="M5.5 0L0 4.125V11H3.72581V8.59381C3.72581 7.64165 4.51713 6.87506 5.5 6.87506C6.48287 6.87506 7.27419 7.64165 7.27419 8.59381V11H11V4.125L5.5 0Z" fill="#063436"/>
                                    </svg>
                                    Home                                  
                                </a>                                   
                            </li>
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="{{ route('landing-page.listing') }}"> Listing </a>                                      
                            </li>                                                           
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="{{ route('landing-page.about') }}">About Us</a>
                            </li>
                            <li class="main__menu--items">
                                <a class="main__menu--link" href="{{ route('landing-page.contact') }}">Contact Us</a>
                            </li>
                        
                        </ul>
                    </nav>
                </div>
                <div class="main__header--right d-flex align-items-center">
                    <a class="add__listing--btn solid__btn" href="{{ route('login') }}">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-users"><path d="M17 21v-2a4 4 0 0 0-4-4H5a4 4 0 0 0-4 4v2"></path><circle cx="9" cy="7" r="4"></circle><path d="M23 21v-2a4 4 0 0 0-3-3.87"></path><path d="M16 3.13a4 4 0 0 1 0 7.75"></path></svg> <span>Login</span></a>
                    
                </div>
            </div>
        </div>
    </div>
</header>