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
                    <div class="col-md-12">
                        <strong><i class="fas fa-list-alt"></i> {{ $subtitle }}</strong><br>
                        <small>Anda dapat melakukan penambahan dan perubahan data <span class="text-primary">{{ $title }}</span>.</small>
                    </div>

                    <div class="col-md-12 my-3">
                        <a href="{{ route('pelatihan.index') }}" class="ms-auto border-radius-sm btn btn-danger"><i class="ti ti-arrow-left" style="margin-right: 6px;"></i> Kembali </a>
                        <a href="#" class="ms-auto border-radius-sm btn btn-primary" data-bs-toggle="modal" data-bs-target="#createData"><i class="ti ti-plus" style="margin-right: 6px;"></i> Tambah Pertanyaan</a>
                    </div>

                    <div class="modal fade" id="createData">
                        <div class="modal-dialog modal-xl modal-dialog-centered">
                            <div class="modal-content">

                                <div class="modal-header">
                                    <h5 class="modal-title"><strong>Tambah Soal?</strong></h5>
                                </div>

                                <div class="modal-body">
                                    <form class="row" action="{{ route('soal.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf

                                        <div class="form-group col-md-6 mb-3" hidden>
                                            <label class="col-12 mb-2">ID Pelatihan</label>
                                            <div class="col-sm-12">
                                                <input type="number" name="id_pelatihan" value="{{ $id_pelatihan }}" class="form-control form-control-normal" placeholder="ID Pelatihan">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Nomor</label>
                                            <div class="col-sm-12">
                                                <input type="number" name="nomor" class="form-control form-control-normal" placeholder="0">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-6 mb-3">
                                            <label class="col-12 mb-2">Tipe Soal</label>
                                            <div class="col-sm-12">
                                                <select class="form-control" id="tipe" name="tipe">
                                                    <option>Pilihan Ganda</option>
                                                    <option>Essay</option>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4 mb-3" hidden>
                                            <label class="col-12 mb-2">Jawaban (A/B/dll)</label>
                                            <div class="col-sm-12">
                                                <input type="text" name="kunci_jawaban" class="form-control form-control-normal" placeholder="Kunci Jawaban">
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12 mb-3">
                                            <label class="col-12 mb-2">Pertanyaan</label>
                                            <div class="col-sm-12">
                                                <textarea name="pertanyaan" placeholder="Pertanyaan..." class="form-control"></textarea>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-12">
                                            <div class="col-sm-12">
                                                <button type="submit" class="btn btn-primary"><i class="far fa-save" style="margin-right: 8px;"></i> Simpan Perubahan</button>
                                            </div>
                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table id="responsive-datatable" class="table table-bordered table-bordered">
                                <thead class="">
                                    <tr>
                                        <th class="">No.</th>
                                        <th class="">Pertanyaan</th>
                                        <th class="">Tipe Soal</th>
                                        <th class="">Pilihan Jawaban</th>
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
                                            {{ $dt->nomor }}
                                        </td>
                                        <td>
                                            {!! $dt->pertanyaan !!}
                                        </td>
                                        <td>
                                            <strong class="text-primary"><u><i>{{ $dt->tipe }}</i></u></strong>
                                        </td>
                                        <td>
                                            @if($dt->tipe == 'Pilihan Ganda')
                                            <a href="{{ route('soal.show', $dt->id) }}" class="btn btn-sm btn-info">
                                                Edit Pilihan Jawaban
                                            </a>
                                            @endif
                                        </td>

                                        <td class="">
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#editData{{ $dt->id }}" class="btn btn-info btn-sm mb-1">
                                                <i class="ti ti-pencil"></i>
                                            </a>
                                            <a href="#" data-bs-toggle="modal" data-bs-target="#hapusData{{ $dt->id }}" class="btn btn-danger btn-sm mb-1">
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
                                                        <form action="{{ route('soal.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                            @csrf
                                                            @method('PUT')
                                                            <div class="row">

                                                                <div class="form-group col-md-6 mb-3">
                                                                    <label class="col-12 mb-2">Nomor</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="number" name="nomor" value="{{ $dt->nomor }}" class="form-control form-control-normal" placeholder="0">
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-6 mb-3">
                                                                    <label class="col-12 mb-2">Tipe Soal</label>
                                                                    <div class="col-sm-12">
                                                                        <select class="form-control" id="tipe" name="tipe">
                                                                            <option @if($dt->tipe == 'Pilihan Ganda') selected @endif>Pilihan Ganda</option>
                                                                            <option @if($dt->tipe == 'Essay') selected @endif>Essay</option>
                                                                        </select>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-12 mb-3">
                                                                    <label class="col-12 mb-2">Pertanyaan</label>
                                                                    <div class="col-sm-12">
                                                                        <textarea name="pertanyaan" placeholder="Pertanyaan..." class="form-control">{{ $dt->pertanyaan }}</textarea>
                                                                    </div>
                                                                </div>

                                                                <div class="form-group col-md-6 mb-3" hidden>
                                                                    <label class="col-12 mb-2">Kunci Jawaban (A/B/C/dll)</label>
                                                                    <div class="col-sm-12">
                                                                        <input type="text" name="kunci_jawaban" value="{{ $dt->kunci_jawaban }}" class="form-control form-control-normal" placeholder="Kunci Jawaban">
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
                                                        <h5 class="modal-title"><strong>Hapus Soal Nomor {{ $dt->nomor }} ?</strong></h5>
                                                    </div>

                                                    <div class="modal-body">
                                                        <form action="{{ route('soal.destroy', $dt->id) }}" method="POST">
                                                            @csrf
                                                            @method('delete')

                                                            <div class="col text-center">
                                                                <p>Tekan <strong>Hapus</strong> untuk menghapus soal nomor {{ $dt->nomor }} ! </p>

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
    </div>

</div>

@endsection
