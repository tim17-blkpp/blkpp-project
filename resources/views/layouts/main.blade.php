<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8" />
    <title>{{ strtoupper($title) }} | SIBUKIN</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="A fully featured admin theme which can be used to build CRM, CMS, etc." name="description" />
    <meta content="Coderthemes" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('tema') }}/assets/images/favicon.ico">
    <script src="https://cdn.tiny.cloud/1/9mee81cnt82164mnab200pldy72f233vr4z7ryjvll85lmrq/tinymce/6/tinymce.min.js" referrerpolicy="origin"></script>

    <!-- third party css -->
    <link href="{{ asset('tema') }}/assets/libs/datatables.net-bs5/css/dataTables.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('tema') }}/assets/libs/datatables.net-responsive-bs5/css/responsive.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('tema') }}/assets/libs/datatables.net-buttons-bs5/css/buttons.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <link href="{{ asset('tema') }}/assets/libs/datatables.net-select-bs5/css//select.bootstrap5.min.css" rel="stylesheet" type="text/css" />
    <!-- third party css end -->

    <!-- App css -->

    <link href="{{ asset('tema') }}/assets/css/app.min.css" rel="stylesheet" type="text/css" id="app-style" />

    <!-- icons -->
    <link href="{{ asset('tema') }}/assets/css/icons.min.css" rel="stylesheet" type="text/css" />

    <style>
        .recap-user{
            background-color: white;
            margin: 10px;
            height: 110px; 
            border-radius: 10px; 
            font-size: 25px
        }
        .dropdown-filter{
            height: 50px;
            background-color: white;
            border-radius: 10px; 
            color: #6C757D;
            padding: 0px 31px;
            font-size: 18px;
            border: none
        }
        .table-radius{
            border-radius: 10px;
            overflow: hidden;
            text-align: center;
        }
        .dropdown-toggle::after {
            display: inline-block;
            margin-left: .5em;
            vertical-align: .25em;
            content: "";
            border-top: .3em solid;
            border-right: .3em solid transparent;
            border-bottom: 0;
            border-left: .3em solid transparent;
        }
    </style>

</head>

<!-- body start -->

<body class="loading" data-layout-color="light" data-layout-mode="default" data-layout-size="fluid" data-topbar-color="light" data-leftbar-position="fixed" data-leftbar-color="light" data-leftbar-size='default' data-sidebar-user='true'>

    <!-- Begin page -->
    <div id="wrapper">

        <!-- Topbar Start -->
        <div class="navbar-custom">
            <ul class="list-unstyled topnav-menu float-end mb-0">

                <li class="dropdown notification-list topbar-dropdown">
                    <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown" href="#" role="button" aria-haspopup="false" aria-expanded="false">
                        <img src="{{ asset('berkas/user-avatar.png') }}" alt="user-image" class="rounded-circle">
                        <span class="pro-user-name ms-1">
                            {{ auth()->user()->name }} <i class="mdi mdi-chevron-down"></i>
                        </span>
                    </a>
                    <div class="dropdown-menu dropdown-menu-end profile-dropdown ">

                        <!-- item-->
                        <!-- <a href="#" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>Profil Saya</span>
                        </a> -->

                        <!-- item-->

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <a href="logout" onclick="event.preventDefault();
                                                this.closest('form').submit();" class="dropdown-item notify-item">
                                <i class="fe-log-out"></i>
                                <span>Logout</span>
                            </a>
                        </form>

                    </div>
                </li>

                <li class="dropdown notification-list">
                    <a href="javascript:void(0);" class="nav-link right-bar-toggle waves-effect waves-light">
                        <i class="fe-settings noti-icon"></i>
                    </a>
                </li>

            </ul>

            <!-- LOGO -->
            <div class="logo-box">
                <a href="" class="logo logo-light text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('/berkas/logo_sibukin.png') }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/berkas/logo_sibukin.png') }}" alt="" height="50">
                    </span>
                </a>
                <a href="" class="logo logo-dark text-center">
                    <span class="logo-sm">
                        <img src="{{ asset('/berkas/logo_sibukin.png') }}" alt="" height="50">
                    </span>
                    <span class="logo-lg">
                        <img src="{{ asset('/berkas/logo_sibukin.png') }}" alt="" height="50">
                    </span>
                </a>
            </div>

            <ul class="list-unstyled topnav-menu topnav-menu-left mb-0">
                <li>
                    <button class="button-menu-mobile disable-btn waves-effect">
                        <i class="fe-menu"></i>
                    </button>
                </li>

                <li>
                    <h4 class="page-title-main">{{ $title }}</h4>
                </li>

            </ul>

            <div class="clearfix"></div>

        </div>
        <!-- end Topbar -->

        <!-- ========== Left Sidebar Start ========== -->
        <div class="left-side-menu">

            <div class="h-100" data-simplebar>


                <!--- Sidemenu -->
                <div id="sidebar-menu">

                    @if(auth()->user()->role == 'Kandidat')
                    <ul id="side-menu">
                        <li class="menu-title">Navigation</li>

                        <li>
                            <a class="@if($title=='Dashboard') active @endif" href="{{ route('dashboard-kandidat.index') }}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="badge bg-success rounded-pill float-end">9+</span>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Akses Fitur</li>

                        <li>
                            <a class="@if($title=='Data Diri') active @endif" href="{{ route('data-diri-kandidat.index') }}">
                                <i class="mdi mdi-account-outline"></i>
                                <span> Data Diri </span>
                            </a>
                        </li>

                        <li>
                            <a class="@if($title=='Pelatihan Saya') active @endif" href="{{ route('pelatihan-kandidat.index') }}">
                                <i class="mdi mdi-book-outline"></i>
                                <span> Pelatihan Saya </span>
                            </a>
                        </li>

                        <li>
                            <a class="@if($title=='Sertifikat Pelatihan') active @endif" href="{{ route('sertifikat.index') }}">
                                <i class="mdi mdi-certificate"></i>
                                <span> Sertifikat Pelatihan </span>
                            </a>
                        </li>

                        <li>
                            <a class="@if($title=='Apply Lowongan Kerja') active @endif" href="{{ route('lowongan-kerja-apply.index') }}">
                                <i class="mdi mdi-clipboard-multiple-outline"></i>
                                <span> Apply Lowongan Kerja </span>
                            </a>
                        </li>

                    </ul>

                    <div class="text-center">
                        <a href="/" class="btn btn-primary">Kembali ke Website</a>
                    </div>

                    @elseif(auth()->user()->role == 'Perusahaan')

                    @else

                    <ul id="side-menu">

                        <li class="menu-title">Navigation</li>

                        <li>
                            <a class="@if($title=='Dashboard') active @endif" href="{{ route('dashboard.index') }}">
                                <i class="mdi mdi-view-dashboard-outline"></i>
                                <span class="badge bg-success rounded-pill float-end">9+</span>
                                <span> Dashboard </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Akses Umum</li>

                        <li>
                            <a href="#pelatihan" data-bs-toggle="collapse">
                                <i class="mdi mdi-book-outline"></i>
                                <span> Pelatihan </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="pelatihan">
                                <ul class="nav-second-level">
                                    <li>
                                        <a class="@if($title=='Kategori Pelatihan') active @endif" href="{{ route('kategori_pelatihan.index') }}">Kategori</a>
                                    </li>
                                    <li>
                                        <a class="@if($title=='Pelatihan') active @endif" href="{{ route('pelatihan.index') }}">Pelatihan</a>
                                    </li>
                                    <li>
                                        <a class="@if($title=='Sesi Pelatihan') active @endif" href="{{ route('sesi_pelatihan.index') }}">Sesi Pelatihan</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#lowongan_kerja" data-bs-toggle="collapse">
                                <i class="mdi mdi-clipboard-multiple-outline"></i>
                                <span> Lowongan Kerja </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="lowongan_kerja">
                                <ul class="nav-second-level">
                                    <li>
                                        <a class="@if($title=='Kategori Lowongan Kerja') active @endif" href="{{ route('kategori_lowongan_kerja.index') }}">Kategori</a>
                                    </li>
                                    <li>
                                        <a class="@if($title=='Lowongan Kerja') active @endif" href="{{ route('lowongan_kerja.index') }}">Lowongan</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a href="#blog" data-bs-toggle="collapse">
                                <i class="mdi mdi-calendar-blank-outline"></i>
                                <span> Blog </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="blog">
                                <ul class="nav-second-level">
                                    <li>
                                        <a class="@if($title=='Kategori Blog') active @endif" href="{{ route('kategori_blog.index') }}">Kategori</a>
                                    </li>
                                    <li>
                                        <a class="@if($title=='Blog') active @endif" href="{{ route('blog.index') }}">Blog</a>
                                    </li>
                                </ul>
                            </div>
                        </li>

                        <li>
                            <a class="@if($title=='Faq') active @endif" href="{{ route('faq.index') }}">
                                <i class="mdi mdi-comment-question-outline"></i>
                                <span> FAQ </span>
                            </a>
                        </li>

                        <!-- <li class="menu-title mt-2">Manajemen Pelatihan</li>

                        <li>
                            <a href="#">
                                <i class="mdi mdi-badge-account-horizontal-outline"></i>
                                <span> Seleksi Administrasi </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="mdi mdi-wechat"></i>
                                <span> Seleksi Wawancara </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="mdi mdi-clipboard-flow-outline"></i>
                                <span> Daftar Ulang </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="mdi mdi-certificate"></i>
                                <span> Hasil Pelatihan </span>
                            </a>
                        </li> -->

                        <li class="menu-title mt-2">Manajemen User</li>

                        <li>
                            <a class="@if($title=='kandidat') active @endif" href="{{ route('kandidat.index') }}">
                                <i class="mdi mdi-account-lock-outline"></i>
                                <span> Kandidat </span>
                            </a>
                        </li>

                        <li>
                            <a class="@if($title=='Siswa') active @endif" href="{{ route('siswa.index') }}">
                                <i class="mdi mdi-account-multiple-outline"></i>
                                <span> Siswa </span>
                            </a>
                        </li>

                        <li>
                            <a class="@if($title=='Alumni') active @endif" href="{{ route('alumni.index') }}">
                                <i class="mdi mdi-account-settings-outline"></i>
                                <span> Alumni </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="mdi mdi-code-equal"></i>
                                <span> Perusahaan </span>
                            </a>
                        </li>

                        <li class="menu-title mt-2">Konfigurasi</li>

                        <li>
                            <a class="@if($title=='JPL') active @endif" href="{{ route('jpl.index') }}">
                                <i class="mdi mdi-clipboard-list-outline"></i>
                                <span> JPL </span>
                            </a>
                        </li>

                        <li>
                            <a href="#">
                                <i class="mdi mdi-account-box-multiple-outline"></i>
                                <span> Kelola Admin </span>
                            </a>
                        </li>

                        <li>
                            <a class="@if($title=='Konfigurasi') active @endif" href="{{ route('konfigurasi.index') }}">
                                <i class="mdi mdi-tune"></i>
                                <span> Konfigurasi </span>
                            </a>
                        </li>

                    </ul>
                    @endif

                </div>
                <!-- End Sidebar -->

                <div class="clearfix"></div>

            </div>
            <!-- Sidebar -left -->

        </div>
        <!-- Left Sidebar End -->

        <div class="content-page">
            <div class="content">

                <!-- Start Content-->
                <div class="container-fluid">

                    @yield('content')

                </div> <!-- container-fluid -->

            </div> <!-- content -->

            <!-- Footer Start -->
            <footer class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <script>
                                document.write(new Date().getFullYear())
                            </script> &copy; Sibukin by <a href="">BLKPP D.I. Yogyakarta</a>
                        </div>

                    </div>
                </div>
            </footer>
            <!-- end Footer -->

        </div>
    </div>
    <!-- END wrapper -->

    <!-- Right Sidebar -->
    <div class="right-bar">

        <div data-simplebar class="h-100">

            <div class="rightbar-title">
                <a href="javascript:void(0);" class="right-bar-toggle float-end">
                    <i class="mdi mdi-close"></i>
                </a>
                <h4 class="font-16 m-0 text-white">Theme Customizer</h4>
            </div>

            <!-- Tab panes -->
            <div class="tab-content pt-0">

                <div class="tab-pane active" id="settings-tab" role="tabpanel">

                    <div class="p-3">
                        <div class="alert alert-warning" role="alert">
                            <strong>Customize </strong> the overall color scheme, Layout, etc.
                        </div>

                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Color Scheme</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="light" id="light-mode-check" checked />
                            <label class="form-check-label" for="light-mode-check">Light Mode</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-color" value="dark" id="dark-mode-check" />
                            <label class="form-check-label" for="dark-mode-check">Dark Mode</label>
                        </div>

                        <!-- Width -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Width</h6>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-size" value="fluid" id="fluid" checked />
                            <label class="form-check-label" for="fluid-check">Fluid</label>
                        </div>
                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="layout-size" value="boxed" id="boxed" />
                            <label class="form-check-label" for="boxed-check">Boxed</label>
                        </div>

                        <!-- Menu positions -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Menus (Leftsidebar and Topbar) Positon</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-position" value="fixed" id="fixed-check" checked />
                            <label class="form-check-label" for="fixed-check">Fixed</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-position" value="scrollable" id="scrollable-check" />
                            <label class="form-check-label" for="scrollable-check">Scrollable</label>
                        </div>

                        <!-- Left Sidebar-->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Color</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="light" id="light" />
                            <label class="form-check-label" for="light-check">Light</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="dark" id="dark" checked />
                            <label class="form-check-label" for="dark-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="brand" id="brand" />
                            <label class="form-check-label" for="brand-check">Brand</label>
                        </div>

                        <div class="form-check form-switch mb-3">
                            <input type="checkbox" class="form-check-input" name="leftbar-color" value="gradient" id="gradient" />
                            <label class="form-check-label" for="gradient-check">Gradient</label>
                        </div>

                        <!-- size -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Left Sidebar Size</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="default" id="default-size-check" checked />
                            <label class="form-check-label" for="default-size-check">Default</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="condensed" id="condensed-check" />
                            <label class="form-check-label" for="condensed-check">Condensed <small>(Extra Small
                                    size)</small></label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="leftbar-size" value="compact" id="compact-check" />
                            <label class="form-check-label" for="compact-check">Compact <small>(Small
                                    size)</small></label>
                        </div>

                        <!-- User info -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Sidebar User Info</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="sidebar-user" value="true" id="sidebaruser-check" />
                            <label class="form-check-label" for="sidebaruser-check">Enable</label>
                        </div>


                        <!-- Topbar -->
                        <h6 class="fw-medium font-14 mt-4 mb-2 pb-1">Topbar</h6>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="dark" id="darktopbar-check" checked />
                            <label class="form-check-label" for="darktopbar-check">Dark</label>
                        </div>

                        <div class="form-check form-switch mb-1">
                            <input type="checkbox" class="form-check-input" name="topbar-color" value="light" id="lighttopbar-check" />
                            <label class="form-check-label" for="lighttopbar-check">Light</label>
                        </div>

                        <div class="d-grid mt-4">
                            <button class="btn btn-primary" id="resetBtn">Reset to Default</button>
                        </div>

                    </div>

                </div>
            </div>

        </div> <!-- end slimscroll-menu-->
    </div>
    <!-- /Right-bar -->

    <!-- Right bar overlay-->
    <div class="rightbar-overlay"></div>

    <!-- Vendor -->
    <script src="{{ asset('tema') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/bootstrap/js/bootstrap.bundle.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/simplebar/simplebar.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/node-waves/waves.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/waypoints/lib/jquery.waypoints.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/jquery.counterup/jquery.counterup.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/feather-icons/feather.min.js"></script>

    <!-- knob plugin -->
    <script src="{{ asset('tema') }}/assets/libs/jquery-knob/jquery.knob.min.js"></script>

    <!--Morris Chart-->
    <script src="{{ asset('tema') }}/assets/libs/morris.js06/morris.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/chart.js/Chart.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/raphael/raphael.min.js"></script>

    <!-- third party js -->
    <script src="{{ asset('tema') }}/assets/libs/datatables.net/js/jquery.dataTables.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-bs5/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-responsive-bs5/js/responsive.bootstrap5.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-buttons-bs5/js/buttons.bootstrap5.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-buttons/js/buttons.html5.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-buttons/js/buttons.flash.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-buttons/js/buttons.print.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/datatables.net-select/js/dataTables.select.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/pdfmake/build/pdfmake.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/pdfmake/build/vfs_fonts.js"></script>
    <!-- third party js ends -->

    <!-- Datatables init -->
    {{-- <script src="{{ asset('tema') }}/assets/js/pages/datatables.init.js"></script> --}}

    <!-- Dashboard init js-->
    <script src="{{ asset('tema') }}/assets/libs/jquery/jquery.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/raphael/raphael.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/morris.js06/morris.min.js"></script>
    <script src="{{ asset('tema') }}/assets/libs/chart.js/Chart.min.js"></script>
    {{-- <script src="{{ asset('tema') }}/assets/js/pages/dashboard.init.js"></script> --}}

    <!-- App js-->
    <script src="{{ asset('tema') }}/assets/js/app.min.js"></script>

    <script>
        tinymce.init({
            selector: 'textarea',
            plugins: 'advlist autolink link image lists charmap print preview hr anchor pagebreak searchreplace wordcount visualblocks visualchars insertdatetime media nonbreaking table contextmenu directionality emoticons paste textcolor responsivefilemanager code',

            toolbar1: "undo redo | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | styleselect",

            toolbar2: "responsivefilemanager | link unlink anchor | image media | forecolor backcolor  | print preview code ",

            image_title: true,
            automatic_uploads: true,
            file_picker_types: 'image',
            file_picker_callback: function(cb, value, meta) {
                var input = document.createElement('input');
                input.setAttribute('type', 'file');
                input.setAttribute('accept', 'image/*');

                input.onchange = function() {
                    var file = this.files[0];

                    var reader = new FileReader();
                    reader.onload = function() {
                        var id = 'blobid' + (new Date()).getTime();
                        var blobCache = tinymce.activeEditor.editorUpload.blobCache;
                        var base64 = reader.result.split(',')[1];
                        var blobInfo = blobCache.create(id, file, base64);
                        blobCache.add(blobInfo);

                        cb(blobInfo.blobUri(), {
                            title: file.name
                        });
                    };
                    reader.readAsDataURL(file);
                };

                input.click();
            },
        });
    </script>

</body>

</html>
