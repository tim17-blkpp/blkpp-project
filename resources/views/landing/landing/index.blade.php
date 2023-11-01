@extends('layouts.main_landing')
@section('content')

<main>

    <!-- hero area start -->
    <section class="hero__area hero__height d-flex align-items-center grey-bg-2 p-relative">
        <div class="hero__shape">
            <img class="hero-1-circle" src="{{ asset('landing') }}/assets/img/shape/hero/hero-1-circle.png" alt="">
            <img class="hero-1-circle-2" src="{{ asset('landing') }}/assets/img/shape/hero/hero-1-circle-2.png" alt="">
            <img class="hero-1-dot-2" src="{{ asset('landing') }}/assets/img/shape/hero/hero-1-dot-2.png" alt="">
        </div>
        <div class="container">
            <div class="hero__content-wrapper mt-90">
                <div class="row align-items-center">
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="hero__content p-relative z-index-1">
                            <h3 class="hero__title">
                                <span>Lebih dari 1000</span>
                                <span class="yellow-shape">Pelatihan <img src="{{ asset('landing') }}/assets/img/shape/yellow-bg.png" alt="yellow-shape"> </span>
                                Keahlian Untuk Anda.
                            </h3>
                            <p>Mari bergabung dengan layanan ini.</p>
                            <a href="{{ route('pelatihan.get') }}" class="e-btn">Lihat Semua Pelatihan</a>
                        </div>
                    </div>
                    <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                        <div class="hero__thumb d-flex p-relative">
                            <div class="hero__thumb-shape">
                                <img class="hero-1-dot" src="{{ asset('landing') }}/assets/img/shape/hero/hero-1-dot.png" alt="">
                                <img class="hero-1-circle-3" src="{{ asset('landing') }}/assets/img/shape/hero/hero-1-circle-3.png" alt="">
                                <img class="hero-1-circle-4" src="{{ asset('landing') }}/assets/img/shape/hero/hero-1-circle-4.png" alt="">
                            </div>
                            <div class="hero__thumb-big mr-30">
                                <img src="{{ asset('berkas/gambar_landing_1.png') }}" alt="">
                                <div class="hero__quote hero__quote-animation">
                                    <span>Daftar Sekarang</span>
                                    <h4>“Pelatihan Keahlian yang Hebat” Menunggu Anda!</h4>
                                </div>
                            </div>
                            <div class="hero__thumb-sm mt-50 d-none d-lg-block">
                                <img src="{{ asset('berkas/gambar_landing_2.png') }}" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- hero area end -->

    <!-- category area start -->
    <section class="category__area pt-120 pb-70">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                    <div class="section__title-wrapper mb-45">
                        <h2 class="section__title">Kategori <br>Pelatihan <span class="yellow-bg">Keahlian <img src="{{ asset('landing') }}/assets/img/shape/yellow-bg-2.png" alt=""> </span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($service['kategori_pelatihan'] as $dt_pel)
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="category__item mb-30 transition-3 d-flex align-items-center">
                        <div class="category__icon mr-30">
                            <svg viewBox="0 0 512 512">
                                <g>
                                    <path class="st0" d="M81.5,276c0-92.5,58.2-171.5,140-202.2c-9.2-7.6-21.6-11.2-34.4-8.2C91.4,87.7,20,173.5,20,276   c0,119.6,96.3,216,216,216c10.4,0,20.7-0.8,30.7-2.2C161.7,475,81.5,385.2,81.5,276z" />
                                    <path class="st1" d="M236,512c-63.2,0-122.5-24.5-167-69S0,339.2,0,276c0-53.6,18.5-106.2,52.1-147.9c33.1-41.1,79.4-70.2,130.5-82   c17.9-4.1,36.3,0,50.7,11.5s22.7,28.6,22.7,47V236c0,11,9,20,20,20h131.4c18.4,0,35.6,8.3,47,22.7c11.4,14.4,15.6,32.9,11.5,50.7   c-11.8,51.1-41,97.4-82,130.5C342.1,493.5,289.6,512,236,512L236,512z M196.1,84.6c-1.5,0-3,0.2-4.5,0.5   C102.3,105.7,40,184.2,40,276c0,52.5,20.3,101.8,57.3,138.7c36.9,37,86.2,57.3,138.7,57.3c91.8,0,170.3-62.3,190.9-151.6   c1.4-5.9,0-12-3.8-16.8s-9.6-7.6-15.7-7.6H276c-33.1,0-60-26.9-60-60V104.6c0-6.1-2.8-11.9-7.6-15.7   C204.8,86,200.5,84.6,196.1,84.6L196.1,84.6z M187.1,65.6L187.1,65.6L187.1,65.6z" />
                                    <path class="st2" d="M450.6,216h-93.2c-33.9,0-61.4-27.6-61.4-61.4V61.4c0-19.7,9.1-37.7,24.9-49.4c15.9-11.7,35.9-15,54.9-9.2   c31.3,9.7,60.1,27,83.2,50.2c23.2,23.2,40.5,51.9,50.2,83.2c5.9,18.9,2.5,38.9-9.3,54.8C488.3,206.9,470.3,216,450.6,216L450.6,216   z M357.4,40c-4.5,0-9,1.4-12.8,4.2c-5.5,4.1-8.7,10.3-8.7,17.2v93.2c0,11.8,9.6,21.4,21.4,21.4h93.2c6.9,0,13.1-3.2,17.2-8.7   c4.1-5.6,5.3-12.6,3.2-19.3c-7.8-25.1-21.7-48.2-40.3-66.8C412.1,62.7,389,48.8,363.9,41C361.8,40.4,359.6,40,357.4,40z" />
                                </g>
                            </svg>
                        </div>
                        <div class="category__content">
                            <h4 class="category__title"><a href="{{ route('pelatihan.get') . '?id_kategori=' . $dt_pel->id }}">{{ $dt_pel->nama }}</a></h4>
                            <!-- <p>Data is Everything</p> -->
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- category area end -->


    <!-- course area start -->
    <section class="course__area pt-115 pb-120 grey-bg">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xxl-5 col-xl-6 col-lg-6">
                    <div class="section__title-wrapper mb-60">
                        <h2 class="section__title">Pelatihan Keahlian<br><span class="yellow-bg yellow-bg-big">Untuk<img src="{{ asset('landing') }}/assets/img/shape/yellow-bg.png" alt=""></span> Anda</h2>
                        <p>Berikut adalah pelatihan keahlian terbaru untuk anda.</p>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-4">
                    <div class="category__more mb-50 float-md-end fix">
                        <a href="{{ route('pelatihan.get') }}" class="link-btn">
                            Lihat Semua
                            <i class="far fa-arrow-right"></i>
                            <i class="far fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row grid">

                @foreach($pelatihan as $dtb)
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item cat2">
                    <div class="blog__wrapper">
                        <div class="blog__item white-bg mb-30 transition-3 fix">
                            <div class="blog__thumb w-img fix">
                                <a href="{{ route('pelatihan.detail') . '?id=' . $dtb->id }}">
                                    <img src="{{ asset($dtb->gambar) }}" alt="">
                                </a>
                            </div>
                            <div class="blog__content">
                                <div class="blog__tag">
                                    <a href="{{ route('pelatihan.get') . '?id_kategori=' . $dtb->kategori->id }}">{{ $dtb->kategori->nama }}</a>
                                </div>
                                <h3 class="blog__title"><a href="{{ route('pelatihan.detail') . '?id=' . $dtb->id }}">{{ $dtb->judul }}</a></h3>

                                <div class="blog__meta d-flex align-items-center justify-content-between">
                                    <div class="blog__author d-flex align-items-center">
                                        <div class="blog__author-thumb mr-10">
                                            <img src="{{ asset('berkas/icon_admin.png') }}" alt="">
                                        </div>
                                        <div class="blog__author-info">
                                            <h5>Admin</h5>
                                        </div>
                                    </div>
                                    <div class="blog__date d-flex align-items-center">
                                        <i class="fal fa-clock"></i>
                                        <span>{{ $dtb->created_at }}</span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- course area end -->

    <!-- category area start -->
    <section class="category__area pt-120 pb-70">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-8">
                    <div class="section__title-wrapper mb-45">
                        <h2 class="section__title">Kategori <br>Lowongan <span class="yellow-bg">Pekerjaan <img src="{{ asset('landing') }}/assets/img/shape/yellow-bg-2.png" alt=""> </span>
                        </h2>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($service['kategori_lowongan_kerja'] as $dt_kat_loker)
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 col-sm-6">
                    <div class="category__item mb-30 transition-3 d-flex align-items-center">
                        <div class="category__icon mr-30">
                            <svg viewBox="0 0 512 512">
                                <g>
                                    <path class="st0" d="M178.7,492H120c-55.2,0-100-44.8-100-100V120C20,64.8,64.8,20,120,20h58.7C123.7,20,81,64.8,81,120v272   C81,447.2,123.7,492,178.7,492z M355.5,204.8l18.9-85.5c4.8-24.1,16.7-46.3,34.1-63.7l35.4-35.4c-15.1-1.4-30.7,3.7-42.3,15.3   l-61.1,61.1c-17.4,17.4-29.3,39.6-34.1,63.7L295,217l56.7-11.3C352.9,205.4,354.2,205.1,355.5,204.8L355.5,204.8z" />
                                    <path class="st1" d="M299,512H120C53.8,512,0,458.2,0,392V120C0,53.8,53.8,0,120,0h183c11,0,20,9,20,20s-9,20-20,20H120   c-44.1,0-80,35.9-80,80v272c0,44.1,35.9,80,80,80h179c44.1,0,80-35.9,80-80V272c0-11,9-20,20-20s20,9,20,20v120   C419,458.2,365.2,512,299,512z M298.9,236.6l56.7-11.3c28.1-5.6,53.7-19.3,73.9-39.6l61.1-61.1c28.5-28.5,28.5-74.8,0-103.2   c-28.5-28.5-74.8-28.5-103.2,0l-61.1,61.1c-20.3,20.3-33.9,45.8-39.6,73.9l-11.3,56.7c-1.3,6.6,0.7,13.3,5.5,18.1   c3.8,3.8,8.9,5.9,14.1,5.9C296.3,237,297.6,236.9,298.9,236.6L298.9,236.6z M462.4,49.7c6.2,6.2,9.7,14.5,9.7,23.3   s-3.4,17.1-9.7,23.3l-61.1,61.1c-14.7,14.7-33.2,24.6-53.5,28.6l-27.3,5.4l5.4-27.3c4.1-20.3,14-38.8,28.6-53.5l61.1-61.1   c6.2-6.2,14.5-9.7,23.3-9.7S456.1,43.4,462.4,49.7L462.4,49.7z" />
                                    <path class="st2" d="M319,352H101c-11,0-20-9-20-20s9-20,20-20h218c11,0,20,9,20,20S330.1,352,319,352z M211,387   c-13.8,0-25,11.2-25,25s11.2,25,25,25s25-11.2,25-25S224.8,387,211,387z" />
                                </g>
                            </svg>
                        </div>

                        <div class="category__content">
                            <h4 class="category__title"><a href="{{ route('lowongan_pekerjaan.get') . '?id_kategori=' . $dt_kat_loker->id }}">{{ $dt_kat_loker->nama }}</a></h4>
                            <!-- <p>Data is Everything</p> -->
                        </div>

                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- category area end -->


    <!-- course area start -->
    <section class="course__area pt-115 pb-120 grey-bg">
        <div class="container">
            <div class="row align-items-end">
                <div class="col-xxl-5 col-xl-6 col-lg-6">
                    <div class="section__title-wrapper mb-60">
                        <h2 class="section__title">Lowongan Pekerjaan<br><span class="yellow-bg yellow-bg-big">Untuk<img src="{{ asset('landing') }}/assets/img/shape/yellow-bg.png" alt=""></span> Anda</h2>
                        <p>Berikut adalah lowongan pekerjaan terbaru untuk anda.</p>
                    </div>
                </div>
                <div class="col-xxl-7 col-xl-6 col-lg-6 col-md-4">
                    <div class="category__more mb-50 float-md-end fix">
                        <a href="{{ route('lowongan_pekerjaan.get') }}" class="link-btn">
                            Lihat Semua
                            <i class="far fa-arrow-right"></i>
                            <i class="far fa-arrow-right"></i>
                        </a>
                    </div>
                </div>
            </div>
            <div class="row grid">

                @foreach($lowongan_kerja as $lk)
                <div class="col-xxl-4 col-xl-4 col-lg-4 col-md-6 grid-item cat2">
                    <div class="course__item white-bg mb-30 fix">
                        <div class="course__thumb w-img p-relative fix">
                            <a href="{{ route('lowongan_pekerjaan.detail') . '?id=' . $lk->id }}">
                                <img src="{{ asset($lk->gambar) }}" alt="">
                            </a>
                            <div class="course__tag">
                                <a href="#" class="sky-blue">{{ $lk->kategori->nama }}</a>
                            </div>
                        </div>
                        <div class="course__content">

                            <h3 class="course__title"><a href="{{ route('lowongan_pekerjaan.detail') . '?id=' . $lk->id }}">{{ $lk->judul }}</a></h3>

                            <div class="course__teacher d-flex align-items-center">
                                <div class="course__teacher-thumb mr-15">
                                    <img src="{{ asset('berkas/logo_perusahaan.png') }}" alt="">
                                </div>
                                <h6>
                                    <a href="instructor-details.html">
                                        @if($lk->perusahaan != null){{ $lk->perusahaan->name }}@else - @endif
                                    </a>
                                </h6>
                            </div>
                            <br>
                            Gaji: {{ 'Rp ' . number_format($lk->gaji_min, 0, ",", ".") .' - '. 'Rp ' . number_format($lk->gaji_max, 0, ",", ".") }}
                        </div>
                        <div class="course__more d-flex justify-content-between align-items-center">
                            <div class="course__status">
                                <span class="sky-blue">{{ $lk->tipe_pekerjaan }}</span>
                            </div>
                            <div class="course__btn">
                                <a href="{{ route('lowongan_pekerjaan.detail') . '?id=' . $lk->id }}" class="link-btn">
                                    Detail
                                    <i class="far fa-arrow-right"></i>
                                    <i class="far fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- course area end -->

    <!-- events area start -->
    <section class="events__area pt-115 pb-120 p-relative">
        <div class="events__shape">
            <img class="events-1-shape" src="{{ asset('landing') }}/assets/img/events/events-shape.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-4 offset-xxl-4">
                    <div class="section__title-wrapper mb-60 text-center">
                        <h2 class="section__title">FAQ <span class="yellow-bg yellow-bg-big">SIBUKIN<img src="{{ asset('landing') }}/assets/img/shape/yellow-bg.png" alt=""></span></h2>
                        <p>Pertanyaan singkat dapat terjawab melalui informasi berikut.</p>
                    </div>
                </div>
            </div>
            <div class="row">

                @foreach($faq as $f)
                <div class="col-xxl-10 offset-xxl-1 col-xl-10 offset-xl-1 col-lg-10 offset-lg-1">
                    <div class="events__item mb-10 hover__active">
                        <div class="events__item-inner d-sm-flex align-items-center justify-content-between white-bg">
                            <div class="events__content">
                                <h3 class="events__title">{{ $f->judul }}</h3>
                                <div class="events__meta">
                                    {{ $f->deskripsi }}
                                </div>
                            </div>
                            <div class="events__more">
                                <a href="#" class="link-btn">
                                    Tanya Via Whatsapp
                                    <i class="far fa-arrow-right"></i>
                                    <i class="far fa-arrow-right"></i>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </section>
    <!-- events area end -->

</main>

@endsection