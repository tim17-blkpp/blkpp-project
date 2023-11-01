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
                        <small>Anda dapat melakukan mengelola data <span class="text-primary">{{ $title }}</span>.</small>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered nowrap">
                        <thead class="">
                            <tr>
                                <th class="">No.</th>
                                <th class="">Nama</th>
                                <th class="">Email</th>
                                <th class="">Nomor HP</th>
                                <th class="">Status</th>
                                <th class="">Unduh</th>
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
                                <td class="">
                                    {{ $dt->user->name }}
                                </td>
                                <td class="">
                                    {{ $dt->user->email }}
                                </td>
                                <td>
                                    @if($dt->user->profil != null)
                                    {{ $dt->user->profil->nomor_hp }}
                                    @else
                                    -
                                    @endif
                                </td>
                                <td>
                                    @if($dt->keterangan == 'Diterima')
                                    <u class="text-success"><i>{{ $dt->keterangan }}</i></u>
                                    @elseif($dt->keterangan == 'Ditolak')
                                    <u class="text-danger"><i>{{ $dt->keterangan }}</i></u>
                                    @else
                                    <u class="text-warning"><i>{{ $dt->keterangan }}</i></u>
                                    @endif
                                </td>
                                <td class="">
                                    <a href="{{ route('cv-kandidat.show', $dt->id_user ) }}" target="_blank" class="btn btn-sm btn-success">Unduh CV</a>
                                </td>
                                <td class="">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#ubah{{ $dt->id }}" class="btn btn-sm btn-primary">Ubah Status</a>
                                </td>

                                <div class="modal fade" id="ubah{{ $dt->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>{{ $dt->user->name }} | Ubah Status Pelamar</strong></h5>
                                            </div>

                                            <div class="modal-body">

                                                <form action="{{ route('lowongan-kerja-apply.update', $dt->id) }}" method="POST" enctype="multipart/form-data">
                                                    @csrf
                                                    @method('PUT')

                                                    <div class="row">

                                                        <div class="form-group col-md-12 mb-3">
                                                            <label class="col-12 mb-2">Ubah Status Pelamar : </label>
                                                            <div class="col-sm-12">
                                                                <select class="form-control" name="keterangan">
                                                                    <option @if($dt->keterangan=='Menunggu') selected @endif>Menunggu</option>
                                                                    <option @if($dt->keterangan=='Interview') selected @endif>Interview</option>
                                                                    <option @if($dt->keterangan=='Diterima') selected @endif>Diterima</option>
                                                                    <option @if($dt->keterangan=='Ditolak') selected @endif>Ditolak</option>
                                                                </select>
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