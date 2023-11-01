@extends('layouts.main_landing')
@section('content')


<main>

    <!-- page title area start -->
    <section class="page__title-area page__title-height page__title-overlay d-flex align-items-center" data-background="{{ asset('berkas/bg_kontak.png') }}">
        <div class="container">
            <div class="row">
                <div class="col-xxl-12">
                    <div class="page__title-wrapper mt-110">
                        <h3 class="page__title">Profil</h3>
                        <nav aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="/">Beranda</a></li>
                                <li class="breadcrumb-item active" aria-current="page">Profil</li>
                            </ol>
                        </nav>
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
                <div class="col-xxl-12 col-xl-12 col-lg-12 text-center">
                    <h2>{{ $kontak->nama_sistem }}</h2><br>
                    <strong>{{ $kontak->nama_instansi }}</strong><br>
                    <strong>{{ $kontak->telp }}</strong><br>
                    <strong>{{ $kontak->email }}</strong><br>
                    <strong>{{ $kontak->alamat }}</strong><br>
                </div>

            </div>
        </div>
    </section>
    <!-- blog area end -->

</main>


@endsection