<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\BlogModel;
use App\Models\KategoriBlogModel;
use Exception;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    public function index()
    {
        $toptitle = 'Daftar Blog';
        $title = 'Blog';
        $subtitle = 'Data Blog';

        $all_data = BlogModel::with('kategori')->orderBy('id', 'DESC')->get();
        $kategori = KategoriBlogModel::orderBy('id', 'DESC')->get();

        return view('admin.blog.index', compact(
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
            'deskripsi' => 'required',
        ]);

        $gambar = "";

        if ($request->hasFile('gambar')) {

            $file = $request->file('gambar');
            $fileName = auth()->user()->id . time() . uniqid() . '.' . $file->getClientOriginalExtension();
            $destinationPath = public_path() . '/berkas';
            $file->move($destinationPath, $fileName);
            $gambar = 'berkas/' . $fileName;
        }

        $data_input = BlogModel::create([
            'id_kategori' => $request->id_kategori,
            'judul' => $request->judul,
            'gambar' => $gambar,
            'deskripsi' => $request->deskripsi,
            'dilihat' => 0,
            'status' => 1,
        ]);

        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function show($id)
    {
        //
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
            'deskripsi' => 'required',
        ]);

        $data_edit = BlogModel::findOrFail($id);

        $gambar = $data_edit->gambar;

        if ($request->hasFile('gambar')) {
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
        $dataUp['gambar'] = $gambar;
        $dataUp['deskripsi'] = $request->deskripsi;
        $dataUp['status'] = 1;

        $data_edit->update($dataUp);
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    public function destroy($id)
    {
        $kelas = BlogModel::find($id);
        $kelas->delete();
        return redirect()->route('blog.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
