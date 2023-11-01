@extends('layouts.main')
@section('content')

@if(Session::has('success'))
<div class="alert alert-success py-2 px-4" role="alert">
    <small>
        <span class="alert-icon"><i class="ni ni-like-2"></i></span>
        <strong>Berhasil! </strong> {{ Session('success') }}
    </small>
</div>
@endif

@if ($errors->any())
<div class="alert alert-danger">
    <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
    </ul>
</div>
@endif

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <h5>{{ $subtitle }}</h5>
                <span>Isikan <code> form data </code> dengan benar! </span>
                <form class="row mt-3" method="POST" action="{{ route('konfigurasi.update', $data_edit->id) }}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    <div class="form-group col-md-6 mb-3">
                        <label class="col-12 mb-2">Nama Sistem</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $data_edit->nama_sistem }}" name="nama_sistem" class="form-control form-control-normal" placeholder="Nama Sistem">
                        </div>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label class="col-12 mb-2">Nama Instansi</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $data_edit->nama_instansi }}" name="nama_instansi" class="form-control form-control-normal " placeholder="Nama Instansi">
                        </div>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label class="col-12 mb-2">Telp</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $data_edit->telp }}" name="telp" class="form-control form-control-normal " placeholder="Telp">
                        </div>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label class="col-12 mb-2">Alamat</label>
                        <div class="col-sm-12">
                            <input type="text" value="{{ $data_edit->alamat }}" name="alamat" class="form-control form-control-normal " placeholder="Alamat">
                        </div>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label class="col-12 mb-2">Email</label>
                        <div class="col-sm-12">
                            <input type="email" value="{{ $data_edit->email }}" name="email" class="form-control form-control-normal " placeholder="Email">
                        </div>
                    </div>

                    <div class="form-group col-md-6 mb-3">
                        <label class="col-12 mb-2">Logo</label>
                        <div class="col-12">
                            <input onchange="readURL(this);" type="file" name="logo" class="form-control form-control-normal mb-2" placeholder="Logo">
                            <img style="border: solid gray 1px; padding:6px; border-radius:6px;" height="80px" id="logo" src="{{ asset($data_edit->logo) }}" alt="" />
                        </div>
                        <script>
                            function readURL(input) {
                                if (input.files && input.files[0]) {
                                    var reader = new FileReader();
                                    reader.onload = function(e) {
                                        $('#logo').attr('src', e.target.result);
                                    };
                                    reader.readAsDataURL(input.files[0]);
                                }
                            }
                        </script>
                    </div>

                    <div class="form-group">
                        <div class="col-sm-12">
                            <button type="submit" class="btn btn-primary"><i class="far fa-save" style="margin-right: 8px;"></i> Simpan Perubahan </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@endsection