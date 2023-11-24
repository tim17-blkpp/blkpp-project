<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LowonganKerjaModel;
use App\Models\KategoriLowonganKerjaModel;
use App\Models\LowonganKerjaApplyModel;
use Exception;
use Illuminate\Http\Request;

class LowonganKerjaController extends Controller
{
    public function index()
    {
        $toptitle = 'Daftar Lowongan Kerja';
        $title = 'Lowongan Kerja';
        $subtitle = 'Data Lowongan Kerja';

        if (auth()->user()->role == 'Perusahaan') {
            $all_data = LowonganKerjaModel::with('kategori')->where('id_perusahaan', auth()->user()->id)->orderBy('id', 'DESC')->get();
        } else {
            $all_data = LowonganKerjaModel::with('kategori')->orderBy('id', 'DESC')->get();
        }
        $kategori = KategoriLowonganKerjaModel::orderBy('id', 'DESC')->get();

        return view('admin.lowongan_kerja.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'kategori',
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
            'judul' => 'required',
            'gaji_min' => 'required',
            'gaji_max' => 'required',
            'tipe_pekerjaan' => 'required',
            'deskripsi' => 'required',
            'gambar' => 'image|mimes:jpeg,png,jpg|max:500|dimensions:min_width=1000,min_height=500,max_width=1000,max_height=500',
        ]);

        $gambar = "";
        $id_perusahaan = null;

        if (auth()->user()->role == 'Perusahaan') {
            $id_perusahaan = auth()->user()->id;
        }

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');
            $fileName = auth()->user()->id . time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/berkas';
            $file->move($destinationPath, $fileName);
            $gambar = 'berkas/' . $fileName;
        }

        $data_input = LowonganKerjaModel::create([
            'id_perusahaan' => $id_perusahaan,
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'gaji_min' => $request->gaji_min,
            'gaji_max' => $request->gaji_max,
            'tipe_pekerjaan' => $request->tipe_pekerjaan,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'dilihat' => 0,
            'status' => 1,
        ]);

        return redirect()->route('lowongan_kerja.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        $lowongan_kerja = LowonganKerjaModel::where('id', $id)->first();

        $toptitle = 'Daftar Pelamar';
        $title = 'Daftar Pelamar';
        $subtitle = 'Data Daftar Pelamar | ' . $lowongan_kerja->judul;

        $all_data = LowonganKerjaApplyModel::where('id_lowongan_kerja', $id)
            ->with('lowongan_kerja')
            ->with('user')
            ->get();

        return view('admin.lowongan_kerja.daftar_apply', compact(
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
            'id_kategori' => 'required',
            'judul' => 'required',
            'gaji_min' => 'required',
            'gaji_max' => 'required',
            'tipe_pekerjaan' => 'required',
            'deskripsi' => 'required',
        ]);

        $data_edit = LowonganKerjaModel::findOrFail($id);

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
        $dataUp['judul'] = $request->judul;
        $dataUp['gaji_min'] = $request->gaji_min;
        $dataUp['gaji_max'] = $request->gaji_max;
        $dataUp['tipe_pekerjaan'] = $request->tipe_pekerjaan;
        $dataUp['gambar'] = $gambar;
        $dataUp['deskripsi'] = $request->deskripsi;
        $dataUp['status'] = 1;

        $data_edit->update($dataUp);
        return redirect()->route('lowongan_kerja.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function destroy($id)
    {
        $kelas = LowonganKerjaModel::find($id);
        $kelas->delete();
        return redirect()->route('lowongan_kerja.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
