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
                        <div class="modal-dialog modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title"><strong>Tambah Data {{ $title }}</strong></h5>
                                </div>

                                <div class="modal-body">
                                    <form action="{{ route('jpl.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">Pelatihan</label>
                                            <div class="col-sm-12">
                                                <input type="text" name="pelatihan" class="form-control form-control-normal" placeholder="Pelatihan" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">Tahun</label>
                                            <div class="col-sm-12">
                                                <input type="number" name="tahun" class="form-control form-control-normal" placeholder="Tahun" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">Anggaran</label>
                                            <div class="col-sm-12">
                                                <select name="anggaran" class="form-control form-control-normal" required>
                                                    <option>APBN</option>
                                                    <option>APBD</option>
                                                    <option>DAIS</option>
                                                    <option>DBHCHT</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">Kode</label>
                                            <div class="col-sm-12">
                                                <input type="number" name="kode" class="form-control form-control-normal" placeholder="Kode" required>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">JPL</label>
                                            <div class="col-sm-12">
                                                <input type="number" name="jpl" class="form-control form-control-normal" placeholder="JPL" required>
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
                                <th class="">Pelatihan</th>
                                <th class="">Tahun</th>
                                <th class="">Anggaran</th>
                                <th class="">Kode</th>
                                <th class="">JPL</th>
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
                                    <strong>{{ $dt->pelatihan }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $dt->tahun }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $dt->anggaran }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $dt->kode }}</strong>
                                </td>
                                <td>
                                    <strong>{{ $dt->jpl }}</strong>
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
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>Edit Data {{ $dt->pelatihan }} ?</strong></h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('jpl.update', $dt->id) }}" method="POST">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="form-group col-md-12 mb-3">
                                                        <label class="col-12 mb-2">Pelatihan</label>
                                                        <div class="col-sm-12">
                                                            <input type="text" value="{{ $dt->pelatihan }}" name="pelatihan" class="form-control form-control-normal" placeholder="Pelatihan" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-3">
                                                        <label class="col-12 mb-2">Tahun</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" value="{{ $dt->tahun }}" name="tahun" class="form-control form-control-normal" placeholder="Tahun" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-3">
                                                        <label class="col-12 mb-2">Anggaran</label>
                                                        <div class="col-sm-12">
                                                            <select name="anggaran" class="form-control form-control-normal" required>
                                                                <option @if($dt->anggaran == 'APBN') selected @endif>APBN</option>
                                                                <option @if($dt->anggaran == 'APBD') selected @endif>APBD</option>
                                                                <option @if($dt->anggaran == 'DAIS') selected @endif>DAIS</option>
                                                                <option @if($dt->anggaran == 'DBHCHT') selected @endif>DBHCHT</option>
                                                            </select>
                                                        </div>
                                                    </div>



                                                    <div class="form-group col-md-12 mb-3">
                                                        <label class="col-12 mb-2">Kode</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" value="{{ $dt->kode }}" name="kode" class="form-control form-control-normal" placeholder="Kode" required>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-3">
                                                        <label class="col-12 mb-2">JPL</label>
                                                        <div class="col-sm-12">
                                                            <input type="number" value="{{ $dt->jpl }}" name="jpl" class="form-control form-control-normal" placeholder="JPL" required>
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

                                <div class="modal fade" id="hapusData{{ $dt->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>Hapus Data {{ $dt->pelatihan }} ?</strong></h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('jpl.destroy', $dt->id) }}" method="POST">
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
