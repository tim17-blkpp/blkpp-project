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

                <div class="row justify-content-between">
                    <div class="col-md-12 mb-2">
                        <strong><i class="fas fa-list-alt"></i> {{ $subtitle }}</strong><br>
                        <small>Anda dapat melakukan penambahan dan perubahan data <span class="text-primary">{{ $title }}</span>.</small><br>
                        <hr>
                        <a href="{{ route('cv-kandidat.show',auth()->user()->id ) }}" class="btn btn-sm btn-danger" target="_blank" rel="noopener noreferrer">Generate CV</a>
                    </div>

                    <form class="col-md-12" action="{{ route('data-diri-kandidat.update', auth()->user()->id) }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="row">

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Nama Lengkap (Sesuai KTP)</label>
                                <div class="col-sm-12">
                                    <input type="text" name="name" value="{{ auth()->user()->name }}" class="form-control form-control-normal" placeholder="Nama Lengkap" required>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2" for="jenis_kelamin">Jenis Kelamin</label>
                                <div class="col-sm-12">
                                    <select name="jenis_kelamin" id="jenis_kelamin" class="form-control form-control-normal" placeholder="Jenis Kelamin" disabled>
                                        <option value="Laki - Laki" @if(auth()->user()->profil->jenis_kelamin=='L') selected @endif>Laki - Laki</option>
                                        <option value="Perempuan" @if(auth()->user()->profil->jenis_kelamin=='P') selected @endif>Perempuan</option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Email</label>
                                <div class="col-sm-12">
                                    <input type="email" name="email" value="{{ auth()->user()->email }}" class="form-control form-control-normal" placeholder="Email" required>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">NIK</label>
                                <div class="col-sm-12">
                                    <input type="number" name="nik" value="{{ $profil->nik }}" class="form-control form-control-normal" placeholder="0" required>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">No. HP</label>
                                <div class="col-sm-12">
                                    <input type="tel" name="nomor_hp" id="nomor_hp" value="{{ $profil->nomor_hp }}" class="form-control form-control-normal" placeholder="No. HP" required>
                                </div>
                            </div>

                            <script>
                                const inputTelepon = document.getElementById('nomor_hp');

                                inputTelepon.addEventListener('input', function(event) {
                                    let inputValue = event.target.value.replace(/\D/g, '');
                                    if (inputValue.length > 0) {
                                        inputValue = inputValue.match(/.{1,4}/g).join('');
                                    }
                                    event.target.value = inputValue;
                                });
                            </script>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Tempat Lahir</label>
                                <div class="col-sm-12">
                                    <input type="text" name="tempat_lahir" value="{{ $profil->tempat_lahir }}" class="form-control form-control-normal" placeholder="Tempat Lahir">
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Tanggal Lahir (Bulan/Tanggal/Tahun)</label>
                                <div class="col-sm-12">
                                    <input type="date" name="tanggal_lahir" value="{{ \Carbon\Carbon::parse($profil->tanggal_lahir)->format('Y-m-d') }}" class="form-control form-control-normal" placeholder="Tanggal Lahir">
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Alamat Lengkap (Sesuai KTP)</label>
                                <div class="col-sm-12">
                                    <input type="text" name="alamat" value="{{ $profil->alamat }}" class="form-control form-control-normal" placeholder="Alamat">
                                </div>
                            </div>

                            {{-- <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Alamat Domisili</label>
                                <div class="col-sm-12">
                                    <input type="text" name="alamat_domisili" value="{{ $profil->alamat_domisili }}" class="form-control form-control-normal" placeholder="Alamat Domisili">
                                </div>
                            </div> --}}

                            <div class="form-group text-center col-md-12 mb-3">
                                <hr>
                                <h4>RIWAYAT PENDIDIKAN</h4>
                                <small>Tuliskan dengan lengkap <span class="text-primary"> instansi, jurusan, tahun lulus! </span>.</small>
                                <hr>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Instansi SD</label>
                                <div class="col-sm-12">
                                    <input type="text" name="instansi_sd" value="{{ explode(' | ', $profil->pendidikan_sd)[0] }}" class="form-control form-control-normal" placeholder="Instansi SD">
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Tahun Lulus SD</label>
                                <div class="col-sm-12">
                                    <input type="number" name="tahun_lulus_sd" value="@if($profil->pendidikan_sd != null){{ explode(' | ', $profil->pendidikan_sd)[1] }}@endif" class="form-control form-control-normal" placeholder="Tahun Lulus SD">
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Instansi SMP</label>
                                <div class="col-sm-12">
                                    <input type="text" name="instansi_smp" value="{{ explode(' | ', $profil->pendidikan_smp)[0] }}" class="form-control form-control-normal" placeholder="Instansi SMP">
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Tahun Lulus SMP</label>
                                <div class="col-sm-12">
                                    <input type="number" name="tahun_lulus_smp" value="@if($profil->pendidikan_smp != null){{ explode(' | ', $profil->pendidikan_smp)[1] }}@endif" class="form-control form-control-normal" placeholder="Tahun Lulus SMP">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Instansi SMA/SMK</label>
                                <div class="col-sm-12">
                                    <input type="text" name="instansi_sma" value="{{ explode(' | ', $profil->pendidikan_sma)[0] }}" class="form-control form-control-normal" placeholder="Instansi SMA/SMK">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Jurusan SMA/SMK</label>
                                <div class="col-sm-12">
                                    <input type="text" name="jurusan_sma" value="@if($profil->pendidikan_sma != null){{ explode(' | ', $profil->pendidikan_sma)[1] }}@endif" class="form-control form-control-normal" placeholder="Jurusan SMA/SMK">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Tahun Lulus SMA/SMK</label>
                                <div class="col-sm-12">
                                    <input type="number" name="tahun_lulus_sma" value="@if($profil->pendidikan_sma != null){{ explode(' | ', $profil->pendidikan_sma)[2] }}@endif" class="form-control form-control-normal" placeholder="Tahun Lulus SMA/SMK">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Instansi S1</label>
                                <div class="col-sm-12">
                                    <input type="text" name="instansi_s1" value="{{ explode(' | ', $profil->pendidikan_s1)[0] }}" class="form-control form-control-normal" placeholder="Instansi S1">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Jurusan S1</label>
                                <div class="col-sm-12">
                                    <input type="text" name="jurusan_s1" value="@if($profil->pendidikan_s1 != null){{ explode(' | ', $profil->pendidikan_s1)[1] }}@endif" class="form-control form-control-normal" placeholder="Jurusan S1">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Tahun Lulus S1</label>
                                <div class="col-sm-12">
                                    <input type="number" name="tahun_lulus_s1" value="@if($profil->pendidikan_s1 != null){{ explode(' | ', $profil->pendidikan_s1)[2] }}@endif" class="form-control form-control-normal" placeholder="Tahun Lulus S1">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Instansi S2</label>
                                <div class="col-sm-12">
                                    <input type="text" name="instansi_s2" value="{{ explode(' | ', $profil->pendidikan_s2)[0] }}" class="form-control form-control-normal" placeholder="Instansi S2">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Jurusan S2</label>
                                <div class="col-sm-12">
                                    <input type="text" name="jurusan_s2" value="@if($profil->pendidikan_s2 != null){{ explode(' | ', $profil->pendidikan_s2)[1] }}@endif" class="form-control form-control-normal" placeholder="Jurusan S2">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Tahun Lulus S2</label>
                                <div class="col-sm-12">
                                    <input type="number" name="tahun_lulus_s2" value="@if($profil->pendidikan_s2 != null){{ explode(' | ', $profil->pendidikan_s2)[2] }}@endif" class="form-control form-control-normal" placeholder="Tahun Lulus S2">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Instansi S3</label>
                                <div class="col-sm-12">
                                    <input type="text" name="instansi_s3" value="{{ explode(' | ', $profil->pendidikan_s3)[0] }}" class="form-control form-control-normal" placeholder="Instansi S3">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Jurusan S3</label>
                                <div class="col-sm-12">
                                    <input type="text" name="jurusan_s3" value="@if($profil->pendidikan_s3 != null){{ explode(' | ', $profil->pendidikan_s3)[1] }}@endif" class="form-control form-control-normal" placeholder="Jurusan S3">
                                </div>
                            </div>

                            <div class="form-group col-md-4 mb-3">
                                <label class="col-12 mb-2">Tahun Lulus S3</label>
                                <div class="col-sm-12">
                                    <input type="number" name="tahun_lulus_s3" value="@if($profil->pendidikan_s3 != null){{ explode(' | ', $profil->pendidikan_s3)[2] }}@endif" class="form-control form-control-normal" placeholder="Tahun Lulus S3">
                                </div>
                            </div>

                            <div class="form-group text-center col-md-12 mb-3">
                                <hr>
                                <h4>DOKUMEN PENDAFTARAN</h4>
                                <small>Dokumen ini digunakan untuk verifikasi data <span class="text-primary"> saat mendaftar pelatihan </span>.</small>
                                <hr>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Foto (3x4)</label>
                                <div class="col-sm-12">
                                    <input type="file" name="avatar" id="avatar" value="{{ $profil->pendidikan }}" class="form-control form-control-normal">
                                    <img src="{{ asset($profil->avatar) }}" alt="Gambar yang Dipilih" class="mt-1" id="gambarAvatar" height="80">
                                    <script>
                                        const inputAvatar = document.getElementById('avatar');
                                        const gambarAvatar = document.getElementById('gambarAvatar');

                                        inputAvatar.addEventListener('change', function(event) {
                                            const file = event.target.files[0];
                                            const reader = new FileReader();

                                            reader.onload = function() {
                                                gambarAvatar.src = reader.result;
                                            };

                                            if (file) {
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">KTP</label>
                                <div class="col-sm-12">
                                    <input type="file" name="ktp" id="ktp" class="form-control form-control-normal">
                                    <img src="{{ asset($profil->ktp) }}" alt="Gambar yang Dipilih" class="mt-1" id="gambarKTP" height="80">
                                    <script>
                                        const inputKTP = document.getElementById('ktp');
                                        const gambarKTP = document.getElementById('gambarKTP');

                                        inputKTP.addEventListener('change', function(event) {
                                            const file = event.target.files[0];
                                            const reader = new FileReader();

                                            reader.onload = function() {
                                                gambarKTP.src = reader.result;
                                            };

                                            if (file) {
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Ijazah Terakhir</label>
                                <div class="col-sm-12">
                                    <input type="file" name="ijazah" id="ijazah" class="form-control form-control-normal">
                                    <img src="{{ asset($profil->ijazah) }}" alt="Gambar yang Dipilih" class="mt-1" id="gambarIjazah" height="80">
                                    <script>
                                        const inputIjazah = document.getElementById('ijazah');
                                        const gambarIjazah = document.getElementById('gambarIjazah');

                                        inputIjazah.addEventListener('change', function(event) {
                                            const file = event.target.files[0];
                                            const reader = new FileReader();

                                            reader.onload = function() {
                                                gambarIjazah.src = reader.result;
                                            };

                                            if (file) {
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Sertifikat Vaksin</label>
                                <div class="col-sm-12">
                                    <input type="file" name="sertifikat_vaksin" id="sertifikat_vaksin" class="form-control form-control-normal">
                                    <img src="{{ asset($profil->sertifikat_vaksin) }}" alt="Gambar yang Dipilih" class="mt-1" id="gambarVaksin" height="80">
                                    <script>
                                        const inputVaksin = document.getElementById('sertifikat_vaksin');
                                        const gambarVaksin = document.getElementById('gambarVaksin');

                                        inputVaksin.addEventListener('change', function(event) {
                                            const file = event.target.files[0];
                                            const reader = new FileReader();

                                            reader.onload = function() {
                                                gambarVaksin.src = reader.result;
                                            };

                                            if (file) {
                                                reader.readAsDataURL(file);
                                            }
                                        });
                                    </script>
                                </div>
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save" style="margin-right: 8px;"></i> Simpan Perubahan</button>
                                </div>
                            </div>

                            <div class="form-group text-center col-md-12 mb-3">
                                <hr>
                                <h4>UBAH PASSWORD</h4>
                                <small>Jika tidak ingin mengubah password maka pastikan <span class="text-primary"> form password baru dan ulangi password kosong </span>.</small>
                                <hr>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Password Baru</label>
                                <div class="col-sm-12">
                                    <input type="password" name="password" value="" class="form-control form-control-normal" placeholder="********">
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Ulangi Password</label>
                                <div class="col-sm-12">
                                    <input type="password" name="password_confirmation" value="" class="form-control form-control-normal" placeholder="********">
                                </div>
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save" style="margin-right: 8px;"></i> Simpan Perubahan</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </div>
</div>

@endsection
