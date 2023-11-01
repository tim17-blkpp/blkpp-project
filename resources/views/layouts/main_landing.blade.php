<!doctype html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <title>{{ strtoupper('SIBUKIN – ' . $title) }} </title>
    <meta name="description" content="">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Place favicon.ico in the root directory -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('landing') }}/assets/img/favicon.png">
    <!-- CSS here -->
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/preloader.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/meanmenu.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/animate.min.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/owl.carousel.min.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/swiper-bundle.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/backToTop.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/jquery.fancybox.min.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/fontAwesome5Pro.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/elegantFont.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/default.css">
    <link rel="stylesheet" href="{{ asset('landing') }}/assets/css/style.css">
</head>

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="https://browsehappy.com/">upgrade your browser</a> to improve your experience and security.</p>
      <![endif]-->

    <!-- Add your site or application content here -->

    <!-- pre loader area start -->
    <div id="loading">
        <div id="loading-center">
            <div id="loading-center-absolute">
                <div class="loading-content">
                    <img class="loading-logo-text" height="120" src="{{ asset('berkas') }}/logo_sibukin.png" alt="">
                    <div class="loading-stroke">
                        <img class="loading-logo-icon" src="{{ asset('landing') }}/assets/img/logo/logo-icon.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- pre loader area end -->

    <!-- back to top start -->
    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
        </svg>
    </div>
    <!-- back to top end -->

    <!-- header area start -->
    <header>
        <div id="header-sticky" class="header__area header__transparent header__padding @if($title != 'Landing' && $title != 'Auth') header__white @endif">
            <div class="container-fluid">
                <div class="row align-items-center">
                    <div class="col-xxl-3 col-xl-3 col-lg-4 col-md-2 col-sm-4 col-6">
                        <div class="header__left d-flex">
                            <div class="logo">
                                <a href="/">
                                    @if($title=='Landing' || $title=='Auth')
                                    <img width="160" src="{{ asset('berkas') }}/logo_sibukin.png" alt="logo">
                                    @else
                                    <img class="logo-black" width="160" src="{{ asset('berkas') }}/logo_sibukin.png" alt="logo">
                                    <img class="logo-white" width="160" src="{{ asset('berkas') }}/logo_sibukin_putih.png" alt="logo">
                                    @endif
                                </a>
                            </div>
                        </div>
                    </div>
                    <div class="col-xxl-9 col-xl-9 col-lg-8 col-md-10 col-sm-8 col-6">
                        <div class="header__right d-flex justify-content-end align-items-center">
                            <div class="main-menu  @if($title != 'Landing' && $title != 'Auth') main-menu-3 @endif">
                                <nav id="mobile-menu">
                                    <ul>
                                        <li><a href="/">Beranda</a></li>
                                        <li class="has-dropdown">
                                            <a href="{{ route('pelatihan.get') }}">Pelatihan</a>
                                            <ul class="submenu">
                                                @foreach($service['kategori_pelatihan'] as $dt_kat_pelatihan)
                                                <li><a href="{{ route('pelatihan.get') . '?id_kategori=' . $dt_kat_pelatihan->id }}">{{ $dt_kat_pelatihan->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="{{ route('blog.get') }}">Blog</a>
                                            <ul class="submenu">
                                                @foreach($service['kategori_blog'] as $dt_kat_blog)
                                                <li><a href="{{ route('blog.get') . '?id_kategori=' . $dt_kat_blog->id }}">{{ $dt_kat_blog->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li class="has-dropdown">
                                            <a href="{{ route('lowongan_pekerjaan.get') }}">Lowongan Kerja</a>
                                            <ul class="submenu">
                                                @foreach($service['kategori_lowongan_kerja'] as $dt_kat_lowongan_kerja)
                                                <li><a href="{{ route('lowongan_pekerjaan.get') . '?id_kategori=' . $dt_kat_lowongan_kerja->id }}">{{ $dt_kat_lowongan_kerja->nama }}</a></li>
                                                @endforeach
                                            </ul>
                                        </li>
                                        <li><a href="{{ route('kontak.get') }}">Profil</a></li>
                                    </ul>
                                </nav>
                            </div>

                            @if(auth()->user() != null)
                            <div class="header__btn ml-20 d-none d-sm-block">
                                @if(auth()->user()->role == 'Kandidat')
                                <a href="{{ route('dashboard-kandidat.index') }}" class="e-btn">Dashboard</a>
                                @else
                                <a href="{{ route('dashboard.index') }}" class="e-btn">Dashboard</a>
                                @endif
                            </div>
                            @else
                            <div class="header__btn ml-20 d-none d-sm-block">
                                <a href="{{ route('login') }}" class="e-btn">Login</a>
                            </div>
                            @endif

                            <div class="sidebar__menu d-xl-none">
                                <div class="sidebar-toggle-btn ml-30" id="sidebar-toggle">
                                    <span class="line"></span>
                                    <span class="line"></span>
                                    <span class="line"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- header area end -->

    <div class="body-overlay"></div>
    <!-- cart mini area end -->


    <!-- sidebar area start -->
    <div class="sidebar__area">
        <div class="sidebar__wrapper">
            <div class="sidebar__close">
                <button class="sidebar__close-btn" id="sidebar__close-btn">
                    <span><i class="fal fa-times"></i></span>
                    <span>close</span>
                </button>
            </div>
            <div class="sidebar__content">
                <div class="logo mb-40">
                    <a href="/">
                        <img width="160" src="{{ asset('berkas') }}/logo_sibukin.png" alt="logo">
                    </a>
                </div>
                <div class="mobile-menu fix"></div>

            </div>
        </div>
    </div>
    <!-- sidebar area end -->
    <div class="body-overlay"></div>
    <!-- sidebar area end -->


    @yield('content')

    <!-- footer area start -->
    <footer>
        <div class="footer__area footer-bg">
            <div class="footer__top pt-190 pb-40">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-3 col-xl-3 col-lg-3 col-md-4 col-sm-6">
                            <div class="footer__widget mb-50">
                                <div class="footer__widget-head mb-22">
                                    <div class="footer__logo">
                                        <a href="/">
                                            <img src="{{ asset('berkas/logo_sibukin_putih.png') }}" alt="" height="40">
                                        </a>
                                    </div>
                                </div>
                                <div class="footer__widget-body">
                                    <p>Ada tiga hal yang menjadi kunci sukses. Kemampuan adalah yang bisa kamu lakukan. Motivasi menentukan apa yang akan kamu lakukan. Sikap menunjukkan seberapa baik kamu melakukannya.</p>

                                    <div class="footer__social">
                                        <ul>
                                            <li><a href="#"><i class="social_facebook"></i></a></li>
                                            <li><a href="#" class="tw"><i class="social_twitter"></i></a></li>
                                            <li><a href="#" class="pin"><i class="social_pinterest"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 offset-xxl-1 col-xl-2 offset-xl-1 col-lg-3 offset-lg-0 col-md-2 offset-md-1 col-sm-5 offset-sm-1">
                            <div class="footer__widget mb-50">
                                <div class="footer__widget-head mb-22">
                                    <h3 class="footer__widget-title">Fitur</h3>
                                </div>
                                <div class="footer__widget-body">
                                    <div class="footer__link">
                                        <ul>
                                            <li><a href="{{ route('pelatihan.get') }}">Pelatihan</a></li>
                                            <li><a href="{{ route('blog.get') }}">Blog</a></li>
                                            <li><a href="{{ route('lowongan_pekerjaan.get') }}">Lowongan Pekerjaan</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-2 col-xl-2 col-lg-2 offset-lg-0 col-md-3 offset-md-1 col-sm-6">
                            <div class="footer__widget mb-50">
                                <div class="footer__widget-head mb-22">
                                    <h3 class="footer__widget-title">Tautan Terkait</h3>
                                </div>
                                <div class="footer__widget-body">
                                    <div class="footer__link">
                                        <ul>
                                            <li><a href="https://karirhub.kemnaker.go.id/">Kemnaker RI</a></li>
                                            <li><a href="https://www.jobstreet.co.id/">Jobstreet</a></li>
                                            <li><a href="https://www.udemy.com/">Udemy</a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-5 col-sm-6">
                            <div class="footer__widget footer__pl-70 mb-50">
                                <div class="footer__widget-head mb-22">
                                    <h3 class="footer__widget-title">Langganan</h3>
                                </div>
                                <div class="footer__widget-body">
                                    <div class="footer__subscribe">
                                        <form action="#">
                                            <div class="footer__subscribe-input mb-15">
                                                <input type="email" placeholder="Alamat email anda..">
                                                <button type="submit">
                                                    <i class="far fa-arrow-right"></i>
                                                    <i class="far fa-arrow-right"></i>
                                                </button>
                                            </div>
                                        </form>
                                        <p>Terima informasi terbaru dengan berlangganan.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footer__bottom">
                <div class="container">
                    <div class="row">
                        <div class="col-xxl-12">
                            <div class="footer__copyright text-center">
                                <p>© 2023 Sibukin, All Rights Reserved. Design By <a href="/">Sibukin</a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <!-- footer area end -->
    <!-- JS here -->
    <script src="{{ asset('landing') }}/assets/js/vendor/jquery-3.5.1.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/vendor/waypoints.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/jquery.meanmenu.js"></script>
    <script src="{{ asset('landing') }}/assets/js/swiper-bundle.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/owl.carousel.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/jquery.fancybox.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/isotope.pkgd.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/parallax.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/backToTop.js"></script>
    <script src="{{ asset('landing') }}/assets/js/purecounter.js"></script>
    <script src="{{ asset('landing') }}/assets/js/ajax-form.js"></script>
    <script src="{{ asset('landing') }}/assets/js/wow.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/imagesloaded.pkgd.min.js"></script>
    <script src="{{ asset('landing') }}/assets/js/main.js"></script>
</body>

</html>