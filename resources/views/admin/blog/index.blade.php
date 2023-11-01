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
                        <small>Anda dapat melakukan penambahan dan perubahan data <span class="text-primary">{{ $title }}</span>.</small>
                    </div>

                    <div class="col-md-12 mt-3">
                        <a href="#" class="ms-auto border-radius-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#createData"><i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Data {{ $title }}</a>
                    </div>
                    <div class="modal fade" id="createData">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title"><strong>Tambah Data {{ $title }}!</strong></h5>
                                </div>

                                <div class="modal-body">
                                    <form class="row" action="{{ route('blog.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Kategori</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="id_kategori" name="id_kategori">
                                                    @foreach($kategori as $dt)
                                                    <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Judul</label>
                                            <div class="col-sm-12">
                                                <input type="text" name="judul" class="form-control form-control-normal" placeholder="Judul" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Gambar (1000 x 500) px</label>
                                            <div class="col-sm-12">
                                                <input type="file" name="gambar" class="form-control form-control-normal" placeholder="Gambar">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">Deskripsi</label>
                                            <div class="col-sm-12">
                                                <textarea name="deskripsi" id="deskripsi" placeholder="Daskripsi..." class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary"><i class="far fa-save" style="margin-right: 8px;"></i> Simpan Perubahan</button>
                                            </div>
                                        </div>

                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered nowrap">
                        <thead class="">
                            <tr>
                                <th class="">No.</th>
                                <th class="">Kategori</th>
                                <th class="">Judul</th>
                                <th class="">Gambar</th>
                                <th class="">Aksi</th>
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
                                    <strong>{{ $dt->kategori->nama }}</strong>
                                </td>
                                <td>
                                    {{ $dt->judul }}
                                </td>
                                <td>
                                    <img src="{{ asset($dt->gambar) }}" height="80" alt="">
                                </td>

                                <td class="">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#editData{{ $dt->id }}" class="btn btn-info btn-sm">
                                        <i class="ti ti-pencil"></i>
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#hapusData{{ $dt->id }}" class="btn btn-danger btn-sm">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>

                                <div class="modal fade" id="editData{{ $dt->id }}">
                                    <div class="modal-dialog modal-xl modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>Edit Data {{ $dt->judul }} ?</strong></h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('blog.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row">

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">Kategori</label>
                                                            <div class="col-sm-12">
                                                                <select class="form-control" id="id_kategori" name="id_kategori">
                                                                    @foreach($kategori as $dtk)
                                                                    <option value="{{ $dtk->id }}" @if($dt->id_kategori==$dtk->id) selected @endif>{{ $dtk->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">Judul</label>
                                                            <div class="col-sm-12">
                                                                <input type="text" name="judul" value="{{ $dt->judul }}" class="form-control form-control-normal" placeholder="Judul" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">Gambar (1000 x 500) px</label>
                                                            <div class="col-sm-12">
                                                                <input type="file" name="gambar" class="form-control form-control-normal" placeholder="Gambar">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 mb-3">
                                                            <label class="col-12 mb-2">Deskripsi</label>
                                                            <div class="col-sm-12">
                                                                <textarea name="deskripsi" id="deskripsi" placeholder="Daskripsi..." class="form-control">{{ $dt->deskripsi }}</textarea>
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

                                <div class="modal fade" id="hapusData{{ $dt->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>Hapus Data {{ $dt->judul }} ?</strong></h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('blog.destroy', $dt->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')

                                                    <div class="col text-center">
                                                        <p>Tekan <strong>Hapus</strong> untuk menghapus data {{ $dt->nama }} ! </p>

                                                        <button class="btn btn-danger btn-sm" type="submit">Hapus</button>
                                                        <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Batal</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

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