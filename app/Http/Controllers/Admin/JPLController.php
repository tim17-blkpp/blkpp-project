<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\JPLModel;
use Illuminate\Http\Request;

class JPLController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toptitle = 'Daftar JPL';
        $title = 'JPL';
        $subtitle = 'Data JPL';

        $all_data = JPLModel::orderBy('kode', 'asc')->get();

        return view('admin.jpl.index', compact(
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
            'pelatihan' => 'required',
            'tahun' => 'required',
            'anggaran' => 'required',
            'kode' => 'required',
            'jpl' => 'required',
        ]);

        $data_input = JPLModel::create([
            'pelatihan' => $request->pelatihan,
            'tahun' => $request->tahun,
            'anggaran' => $request->anggaran,
            'kode' => $request->kode,
            'jpl' => $request->jpl,
            'status' => 1,
        ]);
        return redirect()->route('jpl.index')->with(['success' => 'Data Berhasil Disimpan']);
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
        $request->validate([
            'pelatihan' => 'required',
            'tahun' => 'required',
            'anggaran' => 'required',
            'kode' => 'required',
            'jpl' => 'required',
        ]);

        $device = JPLModel::findOrFail($id);
        $dataUp['pelatihan'] = $request->pelatihan;
        $dataUp['tahun'] = $request->tahun;
        $dataUp['anggaran'] = $request->anggaran;
        $dataUp['kode'] = $request->kode;
        $dataUp['jpls'] = $request->jpl;

        $device->update($dataUp);
        return redirect()->route('jpl.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = JPLModel::find($id);
        $kelas->delete();
        return redirect()->route('jpl.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
