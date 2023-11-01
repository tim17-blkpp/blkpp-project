<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JPLModel;
use App\Models\PelatihanModel;
use App\Models\KategoriPelatihanModel;
use App\Models\PilihanJawabanModel;
use App\Models\SoalModel;
use Exception;
use Illuminate\Http\Request;

class SoalController extends Controller
{
    public function index()
    {
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'tipe' => 'required',
            'pertanyaan' => 'required',
        ]);

        $data_input = SoalModel::create([
            'id_pelatihan' => $request->id_pelatihan,
            'nomor' => $request->nomor,
            'tipe' => $request->tipe,
            'pertanyaan' => $request->pertanyaan,
            'kunci_jawaban' => $request->kunci_jawaban,
            'status' => 1,
        ]);

        return redirect()->route('pelatihan.show', $request->id_pelatihan)->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        $soal = SoalModel::findOrFail($id);

        $toptitle = 'Pilihan Jawaban';
        $title = 'Pelatihan';
        $subtitle = 'Pilihan Jawaban';
        $all_data = PilihanJawabanModel::where('id_soal', $id)
            ->orderBy('id', 'ASC')
            ->get();

        return view('admin.pilihan_jawaban.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'soal',
            'all_data',
        ));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tipe' => 'required',
            'pertanyaan' => 'required',
        ]);

        $data_edit = SoalModel::findOrFail($id);

        $dataUp['nomor'] = $request->nomor;
        $dataUp['tipe'] = $request->tipe;
        $dataUp['pertanyaan'] = $request->pertanyaan;
        $dataUp['kunci_jawaban'] = $request->kunci_jawaban;

        $data_edit->update($dataUp);
        return redirect()->route('pelatihan.show', $data_edit->id_pelatihan)->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function destroy($id)
    {
        $data_delete = SoalModel::find($id);
        $id_pelatihan = $data_delete->id_pelatihan;
        $data_delete->delete();
        return redirect()->route('pelatihan.show', $id_pelatihan)->with(['success' => 'Data Berhasil Dihapus']);
    }
}
