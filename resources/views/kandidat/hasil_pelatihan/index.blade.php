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
                        <small>Anda dapat melakukan melihat dan membatalkan mengikuti <span class="text-primary">{{ $title }}</span>.</small>
                    </div>
                </div>

                <div class="table-responsive">
                    <table id="responsive-datatable" class="table table-bordered table-bordered nowrap">
                        <thead class="">
                            <tr>
                                <th class="">No.</th>
                                <th class="">Pelatihan</th>
                                <th class="">Seleksi Administrasi</th>
                                <th class="">Seleksi Tes</th>
                                <th class="">Seleksi Wawancara</th>
                                <th class="">Seleksi Daftar Ulang / Pakta Integritas</th>
                                <!-- <th class="">Aksi</th> -->
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
                                    @if($dt->hasil_seleksi_administrasi != null && $dt->hasil_seleksi_administrasi != '')
                                    <u>{{ $dt->hasil_seleksi_administrasi }}</u>
                                    <br>
                                    @endif

                                    @if($dt->status_seleksi_administrasi == 'Menunggu')
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_administrasi }}</i></u></small>
                                    @elseif($dt->status_seleksi_administrasi == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_administrasi }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_administrasi }}</i></u></small>
                                    @endif
                                </td>
                                <td>
                                    @if($dt->status_seleksi_administrasi=='Lolos')
                                    @if($dt->hasil_seleksi_tes != null && $dt->hasil_seleksi_tes != '')
                                    <u>{{ $dt->hasil_seleksi_tes }}</u>
                                    <br>
                                    @endif

                                    @if($dt->status_seleksi_tes == 'Menunggu' || $dt->status_seleksi_tes == null)
                                    <a href="{{ route('kerjakan-tes.index') . '?id_pelatihan=' . $dt->id_pelatihan }}"><u class="text-success"><i class="ti ti-pencil" style="margin-right: 2px;"></i> <i>Kerjakan Tes</i></u></a>
                                    <br>
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_tes }}</i></u></small>
                                    @elseif($dt->status_seleksi_tes == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_tes }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_tes }}</i></u></small>
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if($dt->status_seleksi_tes=='Lolos')
                                    @if($dt->hasil_seleksi_wawancara != null && $dt->hasil_seleksi_wawancara != '')
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#hasil_wawancara{{ $dt->id }}"><u class="text-warning"><i class="ti ti-eye" style="margin-right: 2px;"></i> <i>Lihat Hasil Wawancara</i></u></a>

                                    <div class="modal fade" id="hasil_wawancara{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Hasil Wawancara : </strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    {!! $dt->hasil_seleksi_wawancara !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @endif

                                    @if($dt->status_seleksi_wawancara == 'Menunggu')
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_wawancara }}</i></u></small>
                                    @elseif($dt->status_seleksi_wawancara == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_wawancara }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_wawancara }}</i></u></small>
                                    @endif
                                    @endif
                                </td>
                                <td>
                                    @if($dt->status_seleksi_wawancara=='Lolos')
                                    @if($dt->hasil_seleksi_daftar_ulang != null && $dt->hasil_seleksi_daftar_ulang != '')
                                    {{ $dt->hasil_seleksi_daftar_ulang }} |
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#daftar_ulang{{ $dt->id }}"><u class="text-warning"><i class="ti ti-eye" style="margin-right: 2px;"></i> <i>Lihat Detail</i></u></a>

                                    <div class="modal fade" id="daftar_ulang{{ $dt->id }}">
                                        <div class="modal-dialog modal-dialog-centered">
                                            <div class="modal-content">

                                                <div class="modal-header">
                                                    <h5 class="modal-title"><strong>Hasil Daftar Ulang : </strong></h5>
                                                </div>

                                                <div class="modal-body">
                                                    Lihat Pakta Integritas : <a href="{{ asset($dt->pakta_integritas) }}" target="_blank"><u class="text-warning"><i class="ti ti-eye" style="margin-right: 2px;"></i> <i>Lihat Berkas</i></u></a>
                                                    <br><br>
                                                    {!! $dt->hasil_seleksi_wawancara !!}
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <br>
                                    @endif

                                    @if($dt->status_seleksi_daftar_ulang == 'Menunggu')
                                    <small>Status: <u class="text-primary"><i>{{ $dt->status_seleksi_daftar_ulang }}</i></u></small>
                                    @elseif($dt->status_seleksi_daftar_ulang == 'Lolos')
                                    <small>Status: <u class="text-success"><i>{{ $dt->status_seleksi_daftar_ulang }}</i></u></small>
                                    @else
                                    <small>Status: <u class="text-danger"><i>{{ $dt->status_seleksi_daftar_ulang }}</i></u></small>
                                    @endif
                                    @endif
                                </td>
                                <!-- <td class="">
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#hapusData{{ $dt->id }}" class="btn btn-danger btn-sm">
                                        <i class="ti ti-trash" style="margin-right: 8px;"></i> Batal Mengikuti
                                    </a>
                                </td>

                                <div class="modal fade" id="hapusData{{ $dt->id }}">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">

                                            <div class="modal-header">
                                                <h5 class="modal-title"><strong>Hapus Data {{ $dt->judul }} ?</strong></h5>
                                            </div>

                                            <div class="modal-body">
                                                <form action="{{ route('sesi_pelatihan.destroy', $dt->id) }}" method="POST">
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
                                </div> -->

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