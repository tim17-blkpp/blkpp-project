@extends('layouts.main')
@section('content')

<div class="row">

    <div class="col-md-12">

        @if(Session::has('success'))
        <div class="alert alert-success py-2 px-4" role="alert">
            <small>
                <span class="alert-icon"><i class="ni ni-like-2"></i></span>
                <strong>Berhasil! </strong> {{ Session('success') }}
            </small>
        </div>
        @endif

        @if ($errors->any())
        <div class="alert alert-danger py-2 px-4" role="alert">
            <ul>
                @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
        @endif

        <div class="card border-radius-md">
            <div class="card-body">

                <div class="row justify-content-between mb-4">
                    <div class="col-md-12">
                        <strong><i class="fas fa-list-alt"></i> {{ $subtitle }}</strong><br>
                        <small>Anda dapat melakukan melihat dan membatalkan mengikuti <span class="text-primary">{{ $title }}</span>.</small>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered nowrap">
                        <thead class="">
                            <tr>
                                <th class="">No.</th>
                                <th class="">Peserta</th>
                                <th class="">Seleksi Administrasi</th>
                                <th class="">Seleksi Tes</th>
                                <th class="">Seleksi Wawancara</th>
                                <th class="">Seleksi Daftar Ulang / Pakta Integritas</th>
                            </tr>
                        </thead>
                        <tbody>
                            @php
                            $no = 1;
                            @endphp
                            @foreach ($all_data as $dt)
                            <tr>
                                <td class="">
                                    {{ $no++ }}
                                </td>
                                <td>
                                    {{ $dt->user->name }}
                                    <br>
                                    @if($dt->user->profil != null)
                                    <small>No. HP: <u class="text-primary"><i>{{ $dt->user->profil->nomor_hp }}</i></u></small>
                                    @endif
                                    @if($dt->status_seleksi_administrasi=='Lolos' && $dt->status_seleksi_tes=='Lolos' && $dt->status_seleksi_wawancara=='Lolos' && $dt->status_seleksi_daftar_ulang=='Lolos')
                                    <br>

                                    @if($dt->keterangan == 'Lulus')
                                    <small>Status: <u class="text-success"><i>{{ $dt->keterangan }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->keterangan }}</i></u></small>
                                    @endif
                                    <br>

                                    <strong>
                                        <small>
                                            Tindakan : <a href="#" data-bs-toggle="modal" data-bs-target="#sertifikat{{ $dt->id }}">
                                                <u class="text-info"><i>Edit Hasil Pelatihan</i></u>
                                            </a>
                                        </small>
                                    </strong>

                                    <div class="modal fade" id="sertifikat{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>{{ $dt->user->name }} | Hasil Pelatihan</strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row p-2">
                                                        <a class="col-md-12 p-2 text-center border" href="{{ asset($dt->sertifikat) }}" target="_blank">
                                                            <strong><u>Hasil Pelatihan :</u></strong><br><br>
                                                            <img src="{{ asset($dt->sertifikat) }}" height="160" alt="">
                                                        </a>
                                                    </div>

                                                    <form action="{{ route('pelatihan-kandidat.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row">

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Lulus / Tidak Lulus Pelatihan : </label>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="keterangan">
                                                                        <option @if($dt->keterangan=='Lulus') selected @endif>Lulus</option>
                                                                        <option @if($dt->keterangan=='Tidak Lulus') selected @endif>Tidak Lulus</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Sertifikat (Optional) : </label>
                                                                <div class="col-sm-12">
                                                                    <input type="file" name="sertifikat" class="form-control form-control-normal" placeholder="Pakta Integritas">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <button class="btn btn-primary btn-sm" type="submit">Simpan Perubahan</button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                            </div>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @endif
                                </td>
                                <td>
                                    @if($dt->hasil_seleksi_administrasi != null && $dt->hasil_seleksi_administrasi != '')
                                    <u>{{ $dt->hasil_seleksi_administrasi }}</u>
                                    <br>
                                    @endif

                                    @if($dt->status_seleksi_administrasi == 'Menunggu')
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_administrasi }}</i></u></small>
                                    @elseif($dt->status_seleksi_administrasi == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_administrasi }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_administrasi }}</i></u></small>
                                    @endif
                                    <br>

                                    <strong>
                                        <small>
                                            Tindakan: <a href="#" data-bs-toggle="modal" data-bs-target="#seleksi_administrasi{{ $dt->id }}">
                                                <u class="text-info"><i>Edit Hasil Seleksi</i></u>
                                            </a>
                                        </small>
                                    </strong>

                                    <div class="modal fade" id="seleksi_administrasi{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>{{ $dt->user->name }} | Seleksi Administrasi</strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="row p-2">
                                                        @if($dt->user->profil != null)
                                                        <div class="col-12 p-2 bg-warning text-center border"><strong>DATA DIRI</strong></div>
                                                        <table class="table border">
                                                            <tbody>
                                                                <tr>
                                                                    <td><strong>Nama Lengkap</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->name }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Alamat Email</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->email }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Nomor HP.</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->profil->nomor_hp }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Tempat, Tanggal Lahir</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->profil->tempat_lahir .', '. $dt->user->profil->tanggal_lahir }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>NIK / No. KTP</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->profil->nik }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Alamat Domisili</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->profil->alamat }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Pendidikan</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->profil->pendidikan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Tahun</strong></td>
                                                                    <td><strong>:</strong> {{ $dt->user->profil->tahun_pendidikan }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>Riwayat Pelatihan</strong></td>
                                                                    <td>
                                                                        @if($dt->user->hasil_pelatihan != null)
                                                                        @foreach($dt->user->hasil_pelatihan as $hpl)
                                                                        -
                                                                        @if($hpl->pelatihan != null)
                                                                        {{ $hpl->pelatihan->judul }}
                                                                        @endif
                                                                        @if($hpl->sesi != null)
                                                                        {{ ' | ' . $hpl->sesi->judul }}
                                                                        @endif
                                                                        {{ ' | ' . $hpl->keterangan }}
                                                                        <br>
                                                                        @endforeach
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                            </tbody>
                                                        </table>
                                                        <div class="col-12 p-2 bg-warning text-center border"><strong>DOKUMEN IDENTITAS</strong></div>
                                                        <a class="col-md-6 p-2 text-center border" href="{{ asset($dt->user->profil->avatar) }}" target="_blank">
                                                            <strong><u>Foto :</u></strong><br><br>
                                                            <img src="{{ asset($dt->user->profil->avatar) }}" height="120" alt="">
                                                        </a>
                                                        <a class="col-md-6 p-2 text-center border" href="{{ asset($dt->user->profil->ktp) }}" target="_blank">
                                                            <strong><u>KTP :</u></strong><br><br>
                                                            <img src="{{ asset($dt->user->profil->ktp) }}" height="120" alt="">
                                                        </a>
                                                        <a class="col-md-6 p-2 text-center border" href="{{ asset($dt->user->profil->ijazah) }}" target="_blank">
                                                            <strong><u>Ijazah :</u></strong><br><br>
                                                            <img src="{{ asset($dt->user->profil->ijazah) }}" height="120" alt="">
                                                        </a>
                                                        @endif
                                                    </div>
                                                    <br>
                                                    <form action="{{ route('pelatihan-kandidat.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row">

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Lolos / Tidak Lolos</label>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="status_seleksi_administrasi">
                                                                        <option @if($dt->status_seleksi_administrasi=='Menunggu') selected @endif>Menunggu</option>
                                                                        <option @if($dt->status_seleksi_administrasi=='Lolos') selected @endif>Lolos</option>
                                                                        <option @if($dt->status_seleksi_administrasi=='Tidak Lolos') selected @endif>Tidak Lolos</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Hasil / Catatan</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="hasil_seleksi_administrasi" value="{{ $dt->hasil_seleksi_administrasi }}" class="form-control form-control-normal" placeholder="Hasil / Catatan">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <button class="btn btn-primary btn-sm" type="submit">Simpan Perubahan</button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                            </div>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </td>

                                <td>
                                    @if($dt->status_seleksi_administrasi=='Lolos')
                                    @if($dt->hasil_seleksi_tes != null && $dt->hasil_seleksi_tes != '')
                                    <u>{{ $dt->hasil_seleksi_tes }}</u> | <a href="{{ route('jawaban_user.index') . '?id_hasil_seleksi=' . $dt->id }}"><u class="text-warning"><i class="ti ti-eye" style="margin-right: 2px;"></i> <i>Lihat Jawaban</i></u></a>
                                    <br>
                                    @endif

                                    @if($dt->status_seleksi_tes == null)
                                    <small>Status: <u class="text-primary"><i>-</i></u></small>
                                    @elseif($dt->status_seleksi_tes == 'Menunggu')
                                    <!--<a href="{{ route('jawaban_user.index') . '?id_hasil_seleksi=' . $dt->id }}"><u class="text-warning"><i class="ti ti-eye" style="margin-right: 2px;"></i> <i>Lihat Jawaban</i></u></a>-->
                                    <!--<br>-->
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_tes }}</i></u></small>
                                    @elseif($dt->status_seleksi_tes == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_tes }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_tes }}</i></u></small>
                                    @endif
                                    <br>

                                    <strong>
                                        <small>
                                            Tindakan: <a href="#" data-bs-toggle="modal" data-bs-target="#seleksi_tes{{ $dt->id }}">
                                                <u class="text-info"><i>Edit Hasil Seleksi</i></u>
                                            </a>
                                        </small>
                                    </strong>

                                    <div class="modal fade" id="seleksi_tes{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>{{ $dt->user->name }} | Seleksi Tes</strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('pelatihan-kandidat.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row">

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Lolos / Tidak Lolos</label>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="status_seleksi_tes">
                                                                        <option @if($dt->status_seleksi_tes=='Menunggu') selected @endif>Menunggu</option>
                                                                        <option @if($dt->status_seleksi_tes=='Lolos') selected @endif>Lolos</option>
                                                                        <option @if($dt->status_seleksi_tes=='Tidak Lolos') selected @endif>Tidak Lolos</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Hasil / Catatan</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="hasil_seleksi_tes" value="{{ $dt->hasil_seleksi_tes }}" class="form-control form-control-normal" placeholder="Hasil / Catatan">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <button class="btn btn-primary btn-sm" type="submit">Simpan Perubahan</button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                            </div>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                                <td>
                                    @if($dt->status_seleksi_tes=='Lolos')
                                    @if($dt->hasil_seleksi_wawancara != null && $dt->hasil_seleksi_wawancara != '')
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#hasil_wawancara{{ $dt->id }}"><u class="text-warning"><i class="ti ti-eye" style="margin-right: 2px;"></i> <i>Lihat Hasil Wawancara</i></u></a>

                                    <div class="modal fade" id="hasil_wawancara{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Hasil Wawancara : </strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    {!! $dt->hasil_seleksi_wawancara !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @endif

                                    @if($dt->status_seleksi_wawancara == null)
                                    <small>Status: <u class="text-primary"><i>-</i></u></small>
                                    @elseif($dt->status_seleksi_wawancara == 'Menunggu')
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_wawancara }}</i></u></small>
                                    @elseif($dt->status_seleksi_wawancara == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_wawancara }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_wawancara }}</i></u></small>
                                    @endif
                                    <br>

                                    <strong>
                                        <small>
                                            Tindakan: <a href="#" data-bs-toggle="modal" data-bs-target="#seleksi_wawancara{{ $dt->id }}">
                                                <u class="text-info"><i>Edit Hasil Seleksi</i></u>
                                            </a>
                                        </small>
                                    </strong>

                                    <div class="modal fade" id="seleksi_wawancara{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered modal-xl">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>{{ $dt->user->name }} | Seleksi Wawancara</strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('pelatihan-kandidat.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row">

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Lolos / Tidak Lolos</label>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="status_seleksi_wawancara">
                                                                        <option @if($dt->status_seleksi_wawancara=='Menunggu') selected @endif>Menunggu</option>
                                                                        <option @if($dt->status_seleksi_wawancara=='Lolos') selected @endif>Lolos</option>
                                                                        <option @if($dt->status_seleksi_wawancara=='Tidak Lolos') selected @endif>Tidak Lolos</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Hasil / Catatan</label>
                                                                <div class="col-sm-12">
                                                                    <textarea name="hasil_seleksi_wawancara" class="form-control form-control-normal" placeholder="Hasil / Catatan">{{ $dt->hasil_seleksi_wawancara }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <button class="btn btn-primary btn-sm" type="submit">Simpan Perubahan</button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                            </div>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                                <td>
                                    @if($dt->status_seleksi_wawancara=='Lolos')
                                    @if($dt->hasil_seleksi_daftar_ulang != null && $dt->hasil_seleksi_daftar_ulang != '')

                                    @endif

                                    <div class="modal fade" id="pakta_integritas{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered modal-lg modal-dialog-scrollable" style=" max-width: 80%;">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Pakta Integritas : </strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    <div class="col-12">
                                                        <iframe src="{{ route('landing.pakta') }}" class="border" height="400" style="width: 100%;"></iframe>
                                                        <br><br>
                                                        <input disabled type="checkbox" value="Menunggu" name="status_seleksi_daftar_ulang" @if($dt->status_seleksi_daftar_ulang=='Menunggu') checked @endif><strong> Pakta Integritas Disetujui</strong>
                                                        <br><br>
                                                        <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Tutup</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    @if($dt->status_seleksi_daftar_ulang == null)
                                    <small>Status: <u class="text-primary"><i>-</i></u></small>
                                    @elseif($dt->status_seleksi_daftar_ulang == 'Menunggu')
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#pakta_integritas{{ $dt->id }}"><u class="text-primary"><i class="ti ti-check" style="margin-right: 2px;"></i> <i>Pakta Integritas Disetujui</i></u></a>
                                    <br>
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_daftar_ulang }}</i></u></small>
                                    @elseif($dt->status_seleksi_daftar_ulang == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_daftar_ulang }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_daftar_ulang }}</i></u></small>
                                    @endif
                                    <br>

                                    <strong>
                                        <small>
                                            Tindakan: <a href="#" data-bs-toggle="modal" data-bs-target="#seleksi_daftar_ulang{{ $dt->id }}">
                                                <u class="text-info"><i>Edit Hasil Seleksi</i></u>
                                            </a>
                                        </small>
                                    </strong>

                                    <div class="modal fade" id="seleksi_daftar_ulang{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>{{ $dt->user->name }} | Daftar Ulang / Pakta Integritas</strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('pelatihan-kandidat.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')

                                                        <div class="row">

                                                            <div class="form-group col-md-12 mb-3">
                                                                <label class="col-12 mb-2">Lolos / Tidak Lolos</label>
                                                                <div class="col-sm-12">
                                                                    <select class="form-control" name="status_seleksi_daftar_ulang">
                                                                        <option @if($dt->status_seleksi_daftar_ulang=='Menunggu') selected @endif>Menunggu</option>
                                                                        <option @if($dt->status_seleksi_daftar_ulang=='Lolos') selected @endif>Lolos</option>
                                                                        <option @if($dt->status_seleksi_daftar_ulang=='Tidak Lolos') selected @endif>Tidak Lolos</option>
                                                                    </select>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-3" hidden>
                                                                <label class="col-12 mb-2">Hasil / Catatan</label>
                                                                <div class="col-sm-12">
                                                                    <input type="text" name="hasil_seleksi_daftar_ulang" value="{{ $dt->hasil_seleksi_daftar_ulang }}" class="form-control form-control-normal" placeholder="Hasil / Catatan">
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-12 mb-3" hidden>
                                                                <label class="col-12 mb-2">Pakta Integritas</label>
                                                                <div class="col-sm-12">
                                                                    <input type="file" name="pakta_integritas" class="form-control form-control-normal" placeholder="Pakta Integritas">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-12 text-center">
                                                                <button class="btn btn-primary btn-sm" type="submit">Simpan Perubahan</button>
                                                                <button type="button" class="btn btn-danger btn-sm" data-bs-dismiss="modal">Batal</button>
                                                            </div>

                                                        </div>

                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </td>

                            </tr>
                            @endforeach

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
