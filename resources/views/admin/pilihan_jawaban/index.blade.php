@extends('layouts.main')
@section('content')

<div class="row">

    <div class="col-md-6">

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

                    <div class="col-md-12 mt-3">

                        <form class="row" action="{{ route('pilihan_jawaban.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf

                            <div class="form-group col-md-6 mb-3" hidden>
                                <label class="col-12 mb-2">ID Soal</label>
                                <div class="col-sm-12">
                                    <input type="number" name="id_soal" value="{{ $soal->id }}" class="form-control form-control-normal" placeholder="ID Soal">
                                </div>
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <strong><u>Pertanyaan Nomor {{ $soal->nomor }}: </u></strong><br><br>
                                {!! $soal->pertanyaan !!}
                            </div>

                            <hr>

                            <div class="form-group col-md-12 mb-3">
                                <label class="col-12 mb-2">Pilihan Jawaban</label>
                                <div class="col-sm-12">
                                    <textarea name="pilihan_jawaban" height="120" placeholder="Pilihan Jawaban..." class="form-control"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-12 mb-3">
                                <label class="col-12 mb-2">Poin</label>
                                <div class="col-sm-12">
                                    <input type="number" name="poin" class="form-control form-control-normal" placeholder="0">
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
    </div>

    <div class="col-md-6">

        <div class="card border-radius-md">
            <div class="card-body">
                <div class="row justify-content-between">

                    <div class="table-responsive">
                        <table id="responsive-datatable" class="table table-bordered table-bordered nowrapd">
                            <thead class="">
                                <tr>
                                    <th class="">Pilihan Jawaban</th>
                                    <th class="">Poin</th>
                                    <th class="">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $no = 'a';
                                @endphp
                                @foreach ($all_data as $dt)
                                <tr>
                                    <td class="">
                                        {!! $dt->pilihan_jawaban !!}
                                    </td>
                                    <td>
                                        {{ $dt->poin }}
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
                                                    <form action="{{ route('pilihan_jawaban.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                        @csrf
                                                        @method('PUT')
                                                        <div class="row">

                                                            <div class="form-group col-md-6 mb-3">
                                                                <label class="col-12 mb-2">Pilihan Jawaban</label>
                                                                <div class="col-sm-12">
                                                                    <textarea name="pilihan_jawaban" placeholder="Pilihan Jawaban..." class="form-control">{{ $dt->pilihan_jawaban }}</textarea>
                                                                </div>
                                                            </div>

                                                            <div class="form-group col-md-6 mb-3">
                                                                <label class="col-12 mb-2">Poin</label>
                                                                <div class="col-sm-12">
                                                                    <input type="number" name="poin" value="{{ $dt->poin }}" class="form-control form-control-normal" placeholder="0">
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
                                                    <h5 class="modal-title"><strong>Hapus Data ?</strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    <form action="{{ route('pilihan_jawaban.destroy', $dt->id) }}" method="POST">
                                                        @csrf
                                                        @method('delete')

                                                        <div class="col text-center">
                                                            <p>Tekan <strong>Hapus</strong> untuk menghapus data tersebut ! </p>

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

@endsection