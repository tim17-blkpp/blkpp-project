<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JPLModel;
use App\Models\PelatihanModel;
use App\Models\KategoriPelatihanModel;
use App\Models\SoalModel;
use Exception;
use Illuminate\Http\Request;

class PelatihanController extends Controller
{
    public function index()
    {
        $toptitle = 'Daftar Pelatihan';
        $title = 'Pelatihan';
        $subtitle = 'Data Pelatihan';

        $all_data = PelatihanModel::with('kategori')->orderBy('id', 'DESC')->get();
        $kategori = KategoriPelatihanModel::orderBy('id', 'DESC')->get();
        $jpl = JPLModel::orderBy('kode', 'DESC')->get();

        return view('admin.pelatihan.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'kategori',
            'jpl',
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
            'id_kategori' => 'required',
            'id_jpl' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:500|dimensions:min_width=1000,min_height=500,max_width=1000,max_height=500',
        ]);

        $gambar = "";

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');
            $fileName = auth()->user()->id . time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/berkas';
            $file->move($destinationPath, $fileName);
            $gambar = 'berkas/' . $fileName;
        }

        $data_input = PelatihanModel::create([
            'id_kategori' => $request->id_kategori,
            'id_jpl' => $request->id_jpl,
            'judul' => $request->judul,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'dilihat' => 0,
            'status' => $request->sts,
        ]);

        return redirect()->route('pelatihan.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        $toptitle = 'Soal Tes';
        $title = 'Pelatihan';
        $subtitle = 'Data Soal Tes';
        $id_pelatihan = $id;

        $all_data = SoalModel::with('pilihan_jawaban')
            ->where('id_pelatihan', $id)
            ->orderBy('nomor', 'ASC')
            ->get();

        return view('admin.soal.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'all_data',
            'id_pelatihan',
        ));
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'id_kategori' => 'required',
            'id_jpl' => 'required',
            'judul' => 'required',
            'deskripsi' => 'required',
        ]);

        $data_edit = PelatihanModel::findOrFail($id);

        $gambar = $data_edit->gambar;

        if ($request->hasFile('gambar')) {
            $request->validate([
                'gambar' => 'image|mimes:jpeg,png,jpg|max:500|dimensions:min_width=1000,min_height=500,max_width=1000,max_height=500',
            ]);
            $file = $request->file('gambar');
            $fileName = auth()->user()->id . time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/berkas';
            $file->move($destinationPath, $fileName);
            try {
                unlink(public_path() . '/' . $gambar);
            } catch (Exception $e) {
            }
            $gambar = 'berkas/' . $fileName;
        }

        $dataUp['id_kategori'] = $request->id_kategori;
        $dataUp['id_jpl'] = $request->id_jpl;
        $dataUp['judul'] = $request->judul;
        $dataUp['gambar'] = $gambar;
        $dataUp['deskripsi'] = $request->deskripsi;
        $dataUp['status'] = $request->sts;

        $data_edit->update($dataUp);
        return redirect()->route('pelatihan.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function destroy($id)
    {
        $kelas = PelatihanModel::find($id);
        $kelas->delete();
        return redirect()->route('pelatihan.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
