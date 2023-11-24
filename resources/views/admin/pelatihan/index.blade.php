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
                                    <form class="row" action="{{ route('pelatihan.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Kategori</label>
                                            <div class="col-12">
                                                <select class="form-control" id="id_kategori" name="id_kategori">
                                                    @foreach($kategori as $dt)
                                                    <option value="{{ $dt->id }}">{{ $dt->nama }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">JPL</label>
                                            <div class="col-12">
                                                <select class="form-control" id="id_jpl" name="id_jpl">
                                                    @foreach($jpl as $dtj)
                                                    <option value="{{ $dtj->id }}">{{ $dtj->pelatihan .' | '. $dtj->tahun .' | '.$dtj->kode }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Judul</label>
                                            <div class="col-12">
                                                <input type="text" name="judul" class="form-control form-control-normal" placeholder="Judul" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Gambar (1000 x 500) px</label>
                                            <div class="col-12">
                                                <input type="file" name="gambar" class="form-control form-control-normal" placeholder="Gambar">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Status</label>
                                            <div class="col-12">
                                                <select class="form-control" id="sts" name="sts">
                                                    <option value="0">Simpan Sebagai Draf</option>
                                                    <option value="1">Tampilkan di Landing</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">Deskripsi</label>
                                            <div class="col-12">
                                                <textarea name="deskripsi" id="deskripsi" placeholder="Deskripsi..." class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <div class="col-12">
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
                                <th class="">Pelatihan</th>
                                <th class="">Informasi</th>
                                <th class="">Kelola</th>
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
                                    <img class="border" src="{{ asset($dt->gambar) }}" height="80" alt="">
                                    <br>
                                    <small><strong><u>Judul: </u></strong></small>
                                    <br>
                                    {{ $dt->judul }}
                                    <br>
                                    <small><strong><u>Kode Pelatihan: </u></strong></small>
                                    <br>
                                    {{ sprintf('%04d', $dt->id) }}.1.{{ $dt->jpl->kode }}.@if($dt->jpl->jpl >= 200){{ '2' }}@else {{ '1' }}@endif.{{ substr($dt->jpl->tahun, -2); }}
                                </td>
                                <td>
                                    <small><strong><u>Kategori: </u></strong></small>
                                    <br>
                                    {{ $dt->kategori->nama }}
                                    <br>
                                    <small><strong><u>JPL: </u></strong></small>
                                    <br>
                                    {{ $dt->jpl->pelatihan .' | '. $dt->jpl->tahun .' | '.$dt->jpl->kode }}
                                    <br>
                                    <small><strong><u>Status: </u></strong></small>
                                    <br>
                                    @if($dt->status == 0)
                                    <div class="text-warning">Disimpan Sebagai Draf</div>
                                    @else
                                    <div class="text-success">Ditampilkan di Landing</div>
                                    @endif
                                </td>
                                <td>
                                    <a href="{{ route('sesi_pelatihan.index') . '?id_pelatihan=' . $dt->id }}" class="btn btn-success btn-sm mb-1">
                                        <i class="ti ti-layout-list-thumb" style="margin-right: 8px;"></i> Kelola Sesi
                                    </a>
                                    <br>
                                    <a href="{{ route('pelatihan.show', $dt->id) }}" class="btn btn-success btn-sm mb-1">
                                        <i class="ti ti-layout-list-thumb" style="margin-right: 8px;"></i> Kelola Tes
                                    </a>
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
                                                <form action="{{ route('pelatihan.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')
                                                    <div class="row">
                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">Kategori</label>
                                                            <div class="col-12">
                                                                <select class="form-control" id="id_kategori" name="id_kategori">
                                                                    @foreach($kategori as $dtk)
                                                                    <option value="{{ $dtk->id }}" @if($dt->id_kategori==$dtk->id) selected @endif>{{ $dtk->nama }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>


                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">JPL</label>
                                                            <div class="col-12">
                                                                <select class="form-control" id="id_jpl" name="id_jpl">
                                                                    @foreach($jpl as $dtj)
                                                                    <option value="{{ $dtj->id }}" @if($dt->id_jpl==$dtj->id) selected @endif>{{ $dtj->pelatihan .' | '. $dtj->tahun .' | '.$dtj->kode }}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">Judul</label>
                                                            <div class="col-12">
                                                                <input type="text" name="judul" value="{{ $dt->judul }}" class="form-control form-control-normal" placeholder="Judul" required>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">Gambar (1000 x 500) px</label>
                                                            <div class="col-12">
                                                                <input type="file" name="gambar" class="form-control form-control-normal" placeholder="Gambar">
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-6 mb-3">
                                                            <label class="col-12 mb-2">Status</label>
                                                            <div class="col-12">
                                                                <select class="form-control" id="sts" name="sts">
                                                                    <option value="0" @if($dt->status==0) selected @endif>Simpan Sebagai Draf</option>
                                                                    <option value="1" @if($dt->status==1) selected @endif>Tampilkan di Landing</option>
                                                                </select>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 mb-3">
                                                            <label class="col-12 mb-2">Deskripsi</label>
                                                            <div class="col-12">
                                                                <textarea name="deskripsi" id="deskripsi" placeholder="Daskripsi..." class="form-control">{{ $dt->deskripsi }}</textarea>
                                                            </div>
                                                        </div>

                                                        <div class="form-group col-md-12 mb-3">
                                                            <div class="col-12">
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
                                                <form action="{{ route('pelatihan.destroy', $dt->id) }}" method="POST">
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
