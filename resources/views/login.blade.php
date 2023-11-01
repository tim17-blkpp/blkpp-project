@extends('layouts.main_landing')
@section('content')

<main>

    <!-- sign up area start -->
    <section class="signup__area po-rel-z1 pt-100 pb-145">
        <div class="sign__shape">
            <img class="man-1" src="{{ asset('landing') }}/assets/img/icon/sign/man-1.png" alt="">
            <img class="man-2" src="{{ asset('landing') }}/assets/img/icon/sign/man-2.png" alt="">
            <img class="circle" src="{{ asset('landing') }}/assets/img/icon/sign/circle.png" alt="">
            <img class="zigzag" src="{{ asset('landing') }}/assets/img/icon/sign/zigzag.png" alt="">
            <img class="dot" src="{{ asset('landing') }}/assets/img/icon/sign/dot.png" alt="">
            <img class="bg" src="{{ asset('landing') }}/assets/img/icon/sign/sign-up.png" alt="">
        </div>
        <div class="container">
            <div class="row">
                <div class="col-xxl-8 offset-xxl-2 col-xl-8 offset-xl-2">
                    <div class="section__title-wrapper text-center mb-55">
                        <h2 class="section__title">Login</h2>
                        <p>Gunakan email dan password anda!</p>
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
                            <form method="POST" action="{{ route('login') }}">
                                @csrf
                                <div class="sign__input-wrapper mb-25">
                                    <h5>Email</h5>
                                    <div class="sign__input">
                                        <input type="emial" name="email" value="{{ old('email') }}" placeholder="Email">
                                        <i class="fal fa-envelope"></i>
                                    </div>
                                </div>
                                <div class="sign__input-wrapper mb-10">
                                    <h5>Password</h5>
                                    <div class="sign__input">
                                        <input type="password" name="password" placeholder="********">
                                        <i class="fal fa-lock"></i>
                                    </div>
                                </div>
                                <div class="sign__action d-sm-flex justify-content-between mb-30">
                                    <div class="sign__agree d-flex align-items-center">
                                        <input class="m-check-input" type="checkbox" id="m-agree" name="remember">
                                        <label class="m-check-label" for="m-agree">Ingat saya?
                                        </label>
                                    </div>
                                    <div class="sign__forgot">
                                        <a href="{{ route('password.request') }}">Lupa password?</a>
                                    </div>
                                </div>
                                <button class="e-btn  w-100"> <span></span> LOGIN</button>
                                <div class="sign__new text-center mt-20">
                                    <p>Belum memiliki akun? <a href="{{ route('register') }}">Daftar disini!</a></p>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- sign up area end -->

</main>

@endsection