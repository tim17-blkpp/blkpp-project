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

                    <div class="col-md-12 mt-3">

                        <form class="row" action="{{ route('jawaban_user.update', $id_sesi) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="col-sm-12 mb-2" hidden>
                                <input type="number" name="id_user" value="{{ $id_user }}" class="form-control form-control-normal" placeholder="0">
                            </div>

                            @foreach($all_data as $dt)

                            <div class="form-group col-md-4 mb-3" hidden>
                                <label class="col-12 mb-2">ID Soal</label>
                                <div class="col-sm-12">
                                    <input type="number" value="{{ $dt->id }}" name="id_soal[]" class="form-control form-control-normal" placeholder="ID Soal">
                                </div>
                            </div>

                            <u><strong>{{ 'Nomor ' .  $dt->nomor . '.' }}</strong></u><br>
                            {!! $dt->pertanyaan !!}
                            @if($dt->tipe == 'Pilihan Ganda')
                            <div class="col-sm-12">
                                @foreach($dt->pilihan_jawaban as $dtpj)
                                <div class="form-check">
                                    <input type="radio" disabled @if($dt->jawaban_user == $dtpj->pilihan_jawaban) checked @endif class="form-check-input" id="{{ $dtpj->id }}" name="jawaban[]" value="{{ $dtpj->pilihan_jawaban .'---'. $dtpj->poin }}">
                                    <label class="form-check-label" for="{{ $dtpj->id }}">{!! $dtpj->pilihan_jawaban !!}</label>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="col-sm-12 mb-2">
                                <label class="col-12 mb-2">Jawaban</label>
                                <input type="text" name="jawaban[]" value="{{ $dt->jawaban_user }}" class="form-control form-control-normal" placeholder="Jawaban..." readonly>
                            </div>
                            @endif

                            <div class="col-sm-12 mb-2">
                                <label class="col-12 mb-2">Poin</label>
                                <input @if($dt->tipe == 'Pilihan Ganda') readonly @endif type="number" name="poin[]" value="{{ $dt->poin_user }}" class="form-control form-control-normal" placeholder="0">
                            </div>
                            <hr>

                            @endforeach

                            <div class="form-group col-md-12 mt-2">
                                <div class="col-sm-12">
                                    <button type="submit" class="btn btn-primary"><i class="far fa-save" style="margin-right: 8px;"></i> Simpan Jawaban</button>
                                </div>
                            </div>
                        </form>

                    </div>
                </div>

            </div>
        </div>
    </div>

</div>

@endsection
