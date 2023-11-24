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
                        <small>Anda dapat melihat data <span class="text-primary">{{ $title }}</span>.</small>
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
                                    <strong>{{ $dt->name }}</strong>
                                </td>
                                <td>
                                    {{ $dt->email }}
                                </td>
                                <td>
                                    @if($dt->profil != null)
                                    {{ $dt->profil->nomor_hp }}
                                    @endif
                                </td>
                                <td class="">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#hapusData{{ $dt->id }}" class="btn btn-danger btn-sm">
                                        <i class="ti ti-trash"></i>
                                    </a>
                                </td>

                                <div class="modal fade" id="hapusData{{ $dt->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>Hapus Data {{ $dt->name }} ?</strong></h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('kandidat.destroy', $dt->id) }}" method="POST">
                                                    @csrf
                                                    @method('delete')

                                                    <div class="col text-center">
                                                        <p>Tekan <strong>Hapus</strong> untuk menghapus data {{ $dt->name }} ! </p>

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
