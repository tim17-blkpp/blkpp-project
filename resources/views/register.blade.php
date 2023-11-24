@extends('layouts.main_landing')
@section('content')

<main>

    <!-- sign up area start -->
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="sign__shape">
            <img class="man-1" src="{{ asset('landing') }}/assets/img/icon/sign/man-3.png" alt="">
            <img class="man-2 man-22" src="{{ asset('landing') }}/assets/img/icon/sign/man-2.png" alt="">
            <img class="circle" src="{{ asset('landing') }}/assets/img/icon/sign/circle.png" alt="">
            <img class="zigzag" src="{{ asset('landing') }}/assets/img/icon/sign/zigzag.png" alt="">
            <img class="dot" src="{{ asset('landing') }}/assets/img/icon/sign/dot.png" alt="">
            <img class="bg" src="{{ asset('landing') }}/assets/img/icon/sign/sign-up.png" alt="">
            <img class="flower" src="{{ asset('landing') }}/assets/img/icon/sign/flower.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Register</h2>
                        <p>Isi data pendaftaran dengan benar!</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xxl-6 offset-xxl-3 col-xl-6 offset-xl-3 col-lg-8 offset-lg-2">
                    <div class="sign__wrapper white-bg">

                        @if ($errors->any())
                        <div class="alert alert-danger py-2 px-4" role="alert">
                            <ul>
                                @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif

                        <div class="sign__form">
                            <form method="POST" action="{{ route('register') }}">
                                @csrf
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Sebagai</h5>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="role1" name="role" value="Kandidat" checked>Peserta
                                        <label class="form-check-label" for="role1"></label>
                                    </div>
                                    <div class="form-check form-check-inline">
                                        <input type="radio" class="form-check-input" id="role2" name="role" value="Perusahaan">Perusahaan
                                        <label class="form-check-label" for="role2"></label>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Nama Lengkap</h5>
                                    <div class="sign__input">
                                        <input type="text" name="name" value="{{ old('name') }}" placeholder="Nama Lengkap">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25" id="nik">
                                    <h5>NIK</h5>
                                    <div class="sign__input">
                                        <input type="number" name="nik" value="{{ old('nik') }}" placeholder="NIK">
                                        <i class="fal fa-credit-card"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Email</h5>
                                    <div class="sign__input">
                                        <input type="emial" name="email" value="{{ old('email') }}" placeholder="Email">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Password</h5>
                                    <div class="sign__input">
                                        <input type="password" name="password" placeholder="********">
                                        <i class="fal fa-lock"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Ulangi Password</h5>
                                    <div class="sign__input">
                                        <input type="password" name="password_confirmation" placeholder="********">
                                        <i class="fal fa-lock"></i>
                                    </div>
                                </div>
                                <div class="sign__action d-sm-flex justify-content-between mb-30">
                                    <div class="sign__agree d-flex align-items-center">
                                        <input class="m-check-input" type="checkbox" id="m-agree" name="remember">
                                        <label class="m-check-label" for="m-agree">Saya telah mematuhi aturan yang berlaku?
                                        </label>
                                    </div>
                                </div>
                                <button class="e-btn  w-100"> <span></span> DAFTAR</button>
                                <div class="sign__new text-center mt-20">
                                    <p>Sudah memiliki akun? <a href="{{ route('login') }}">Login disini!</a></p>
                                </div>
                            </form>

                            <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
                            <script>
                                $(document).ready(function() {
                                    $('input[name="role"]').change(function() {
                                        if ($(this).val() === 'Kandidat') {
                                            $('#nik').show();
                                        } else {
                                            $('#nik').hide();
                                        }
                                    });
                                });
                            </script>

                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sign up area end -->

</main>

@endsection
