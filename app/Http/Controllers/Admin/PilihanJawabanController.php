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

class PilihanJawabanController extends Controller
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
            'pilihan_jawaban' => 'required',
            'poin' => 'required',
        ]);

        $data_input = PilihanJawabanModel::create([
            'id_soal' => $request->id_soal,
            'pilihan_jawaban' => $request->pilihan_jawaban,
            'poin' => $request->poin,
            'status' => 1,
        ]);

        return redirect()->route('soal.show', $request->id_soal)->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'pilihan_jawaban' => 'required',
            'poin' => 'required',
        ]);

        $data_edit = PilihanJawabanModel::findOrFail($id);

        $dataUp['pilihan_jawaban'] = $request->pilihan_jawaban;
        $dataUp['poin'] = $request->poin;

        $data_edit->update($dataUp);
        return redirect()->route('soal.show', $data_edit->id_soal)->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function destroy($id)
    {
        $data_delete = PilihanJawabanModel::find($id);
        $id_soal = $data_delete->id_soal;
        $data_delete->delete();
        return redirect()->route('soal.show', $id_soal)->with(['success' => 'Data Berhasil Dihapus']);
    }
}
