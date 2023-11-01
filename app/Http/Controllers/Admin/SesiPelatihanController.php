<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPelatihanModel;
use App\Models\SesiPelatihanModel;
use App\Models\PelatihanModel;
use Exception;
use Illuminate\Http\Request;

class SesiPelatihanController extends Controller
{
    public function index()
    {
        $toptitle = 'Daftar Sesi Pelatihan';
        $title = 'Sesi Pelatihan';
        $subtitle = 'Data Sesi Pelatihan';

        $all_data = SesiPelatihanModel::with('pelatihan')->orderBy('id', 'DESC')->get();
        $pelatihan = PelatihanModel::orderBy('id', 'DESC')->get();

        return view('admin.sesi_pelatihan.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'pelatihan',
            'all_data',
        ));
    }

    public function create()
    {
        //
    }

    public function store(Request $request)
    {
        $request->validate([
            'id_pelatihan' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'jumlah_peserta' => 'required',
        ]);

        $data_input = SesiPelatihanModel::create([
            'id_pelatihan' => $request->id_pelatihan,
            'judul' => $request->judul,
            'jumlah_peserta' => $request->jumlah_peserta,
            'deskripsi' => $request->deskripsi,
            'status' => 1,
        ]);

        return redirect()->route('sesi_pelatihan.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        $sesi_pelatihan = SesiPelatihanModel::with('pelatihan')
            ->where('id', $id)
            ->first();

        $toptitle = 'Daftar Peserta';
        $title = 'Sesi Pelatihan';
        $subtitle = 'Daftar Peserta | Pelatihan ' . $sesi_pelatihan->pelatihan->judul . ' - ' . $sesi_pelatihan->judul;

        $sesi_pelatihan = SesiPelatihanModel::with('pelatihan')
            ->where('id', $id)
            ->first();

        $all_data = HasilPelatihanModel::where('id_sesi', $id)
            ->with('pelatihan')
            ->with('sesi')
            ->with('user.profil')
            ->get();

        return view('admin.sesi_pelatihan.daftar_peserta', compact(
            'toptitle',
            'title',
            'subtitle',
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
            'id_pelatihan' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'jumlah_peserta' => 'required',
        ]);

        $data_edit = SesiPelatihanModel::findOrFail($id);

        $dataUp['id_kategori'] = $request->id_kategori;
        $dataUp['judul'] = $request->judul;
        $dataUp['jumlah_peserta'] = $request->jumlah_peserta;
        $dataUp['deskripsi'] = $request->deskripsi;
        $dataUp['status'] = 1;

        $data_edit->update($dataUp);
        return redirect()->route('sesi_pelatihan.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function destroy($id)
    {
        $kelas = SesiPelatihanModel::find($id);
        $kelas->delete();
        return redirect()->route('sesi_pelatihan.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
