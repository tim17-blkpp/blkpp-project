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
                </div>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered nowrap">
                        <thead class="">
                            <tr>
                                <th class="">No.</th>
                                <th class="">Pelatihan</th>
                                <th class="">Hasil</th>
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
                                    {{ $dt->pelatihan->judul }}
                                    <br>
                                    <small>Sesi: <u class="text-primary"><i>{{ $dt->sesi->judul }}</i></u></small>
                                </td>
                                <td>
                                    @if($dt->keterangan == 'Lulus')
                                    <small>Status: <u class="text-success"><i>{{ $dt->keterangan }}</i></u></small>
                                    <br>
                                    <strong>
                                        <small>
                                            <a target="_blank" href="{{ asset($dt->sertifikat) }}">
                                                <u class="text-info"><i>Lihat Sertifikat</i></u>
                                            </a>
                                        </small>
                                    </strong>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->keterangan }}</i></u></small>
                                    @endif
                                </td>
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