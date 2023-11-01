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
                                <label class="col-12 mb-2">Pendidikan</label>
                                <div class="col-sm-12">
                                    <input type="text" name="pendidikan" value="{{ $profil->pendidikan }}" class="form-control form-control-normal" placeholder="Pendidikan">
                                </div>
                            </div>

                            <div class="form-group col-md-6 mb-3">
                                <label class="col-12 mb-2">Tahun Pendidikan</label>
                                <div class="col-sm-12">
                                    <input type="text" name="tahun_pendidikan" value="{{ $profil->tahun_pendidikan }}" class="form-control form-control-normal" placeholder="Tahun Pendidikan">
                                </div>
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <label class="col-12 mb-2">Alamat Lengkap (Sesuai KTP)</label>
                                <div class="col-sm-12">
                                    <input type="text" name="alamat" value="{{ $profil->alamat }}" class="form-control form-control-normal" placeholder="Alamat">
                                </div>
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

                            <div class="form-group col-md-12 mb-3">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save" style="margin-right: 8px;"></i> Simpan Perubahan</button>
                                </div>
                            </div>

                            <div class="form-group text-center col-md-12 mb-3">
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