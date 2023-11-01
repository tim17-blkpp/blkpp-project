@extends('layouts.main_landing')
@section('content')


<main>

    <section class="page__title-area page__title-height-2 page__title-overlay d-flex align-items-center" data-background="{{ asset($detail->gambar) }}">
        <div class="page__title-shape">
            <img class="page-title-shape-1" src="assets/img/page-title/page-title-shape-1.png" alt="">
            <img class="page-title-shape-2" src="assets/img/page-title/page-title-shape-2.png" alt="">
            <img class="page-title-shape-3" src="assets/img/page-title/page-title-shape-3.png" alt="">
            <img class="page-title-shape-4" src="assets/img/page-title/page-title-shape-4.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-10 col-xl-10 col-lg-10 ">
                    <div class="page__title-wrapper mt-110">
                        <span class="page__title-pre">{{ $detail->kategori->nama }}</span>
                        <h3 class="page__title-2">{{ $detail->judul }}</h3>
                        <div class="blog__meta d-flex align-items-center">
                            <div class="blog__author d-flex align-items-center mr-40">
                                <div class="blog__author-thumb mr-10">
                                    <img src="{{ asset('berkas/icon_admin.png') }}" alt="">
                                </div>
                                <div class="blog__author-info blog__author-info-2">
                                    <h5>Admin</h5>
                                </div>
                            </div>
                            <div class="blog__date blog__date-2 d-flex align-items-center">
                                <i class="fal fa-clock"></i>
                                <span>{{ $detail->created_at }}</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- page title area end -->

    <!-- blog area start -->
    <section class="blog__area pt-120 pb-120">
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 col-xl-8 col-lg-8">
                    <div class="blog__wrapper">
                        {!! $detail->deskripsi !!}
                        <div class="blog__line"></div>

                        <div class="blog__recent mb-65">
                            <div class="section__title-wrapper mb-40">
                                <h2 class="section__title">Blog <span class="yellow-bg-sm">yang Sesuai <img src="assets/img/shape/yellow-bg-4.png" alt=""> </span></h2>
                                <p>Berikut adalah blog/artikel yang sesuai.</p>
                            </div>
                            <div class="row">

                                @foreach($sesuai as $dts)
                                <div class="col-xxl-6 col-xl-6 col-lg-6 col-md-6">
                                    <div class="blog__item white-bg mb-30 transition-3 fix">
                                        <div class="blog__thumb w-img fix">
                                            <a href="{{ route('blog.detail') . '?id=' . $dts->id }}">
                                                <img src="{{ asset($dts->gambar) }}" alt="">
                                            </a>
                                        </div>
                                        <div class="blog__content">
                                            <div class="blog__tag">
                                                <a href="{{ route('blog.get') . '?id_kategori=' . $dts->kategori->id }}">{{ $dts->kategori->nama }}</a>
                                            </div>
                                            <h3 class="blog__title"><a href="{{ route('blog.detail') . '?id=' . $dts->id }}">{{ $dts->judul }}</a></h3>

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
                                                    <span>{{ $dts->created_at }}</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                        </div>

                    </div>
                </div>

                <div class="col-xxl-4 col-xl-4 col-lg-4">
                    <div class="blog__sidebar pl-70">
                        <div class="sidebar__widget-head mb-35">
                            <h3 class="sidebar__widget-title">Filter</h3>
                        </div>

                        <form action="{{ route('blog.get') }}" method="GET">

                            <div class="sidebar__widget mb-60">
                                <div class="sidebar__widget-content">
                                    <div class="sidebar__search p-relative">

                                        <input type="text" name="kata_kunci" value="{{ $kata_kunci }}" placeholder="Kata kunci...">
                                        <button type="submit">
                                            <svg version="1.1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 584.4 584.4" style="enable-background:new 0 0 584.4 584.4;" xml:space="preserve">
                                                <g>
                                                    <g>
                                                        <path class="st0" d="M565.7,474.9l-61.1-61.1c-3.8-3.8-8.8-5.9-13.9-5.9c-6.3,0-12.1,3-15.9,8.3c-16.3,22.4-36,42.1-58.4,58.4    c-4.8,3.5-7.8,8.8-8.3,14.5c-0.4,5.6,1.7,11.3,5.8,15.4l61.1,61.1c12.1,12.1,28.2,18.8,45.4,18.8c17.1,0,33.3-6.7,45.4-18.8    C590.7,540.6,590.7,499.9,565.7,474.9z" />
                                                        <path class="st1" d="M254.6,509.1c140.4,0,254.5-114.2,254.5-254.5C509.1,114.2,394.9,0,254.6,0C114.2,0,0,114.2,0,254.5    C0,394.9,114.2,509.1,254.6,509.1z M254.6,76.4c98.2,0,178.1,79.9,178.1,178.1s-79.9,178.1-178.1,178.1S76.4,352.8,76.4,254.5    S156.3,76.4,254.6,76.4z" />
                                                    </g>
                                                </g>
                                            </svg>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </form>

                        <div class="sidebar__widget mb-55">
                            <div class="sidebar__widget-head mb-35">
                                <h3 class="sidebar__widget-title">Terbaru</h3>
                            </div>
                            <div class="sidebar__widget-content">
                                <div class="rc__post-wrapper">
                                    @foreach($terbaru as $tbr)
                                    <div class="rc__post d-flex align-items-center">
                                        <div class="rc__thumb mr-20">
                                            <a href="{{ route('blog.detail') . '?id=' . $tbr->id }}"><img src="{{ asset($tbr->gambar) }}" alt=""></a>
                                        </div>
                                        <div class="rc__content">
                                            <div class="rc__meta">
                                                <span>{{ $tbr->created_at }}</span>
                                            </div>
                                            <h6 class="rc__title"><a href="{{ route('blog.detail') . '?id=' . $tbr->id }}">{{ $tbr->judul }}</a></h6>
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="sidebar__widget mb-55">
                            <div class="sidebar__widget-head mb-35">
                                <h3 class="sidebar__widget-title">Kategori</h3>
                            </div>
                            <div class="sidebar__widget-content">
                                <div class="sidebar__category">
                                    <ul>
                                        @foreach($kategori as $ktg)
                                        <li><a href="{{ route('blog.get') . '?id_kategori=' . $ktg->id }}">{{ $ktg->nama }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- blog area end -->

</main>


@endsection