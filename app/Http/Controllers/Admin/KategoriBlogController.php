<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\KategoriBlogModel;
use Illuminate\Http\Request;

class KategoriBlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toptitle = 'Daftar Kategori Blog';
        $title = 'Kategori Blog';
        $subtitle = 'Data Kategori Blog';

        $all_data = KategoriBlogModel::orderBy('nama', 'asc')->get();

        return view('admin.kategori_blog.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'all_data',
        ));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
        ]);

        $data_input = KategoriBlogModel::create([
            'nama' => $request->nama,
            'status' => 1,
        ]);
        return redirect()->route('kategori_blog.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $device = KategoriBlogModel::findOrFail($id);
        $dataUp['nama'] = $request->nama;

        $device->update($dataUp);
        return redirect()->route('kategori_blog.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = KategoriBlogModel::find($id);
        $kelas->delete();
        return redirect()->route('kategori_blog.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
