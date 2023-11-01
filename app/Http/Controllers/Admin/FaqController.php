<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\FaqModel;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $toptitle = 'Daftar Faq';
        $title = 'Faq';
        $subtitle = 'Data Faq';

        $all_data = FaqModel::orderBy('judul', 'asc')->get();

        return view('admin.faq.index', compact(
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
            'judul' => 'required',
        ]);

        $data_input = FaqModel::create([
            'judul' => $request->judul,
            'deskripsi' => $request->deskripsi,
            'status' => 1,
        ]);
        return redirect()->route('faq.index')->with(['success' => 'Data Berhasil Disimpan']);
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
        $device = FaqModel::findOrFail($id);
        $dataUp['judul'] = $request->judul;
        $dataUp['deskripsi'] = $request->deskripsi;

        $device->update($dataUp);
        return redirect()->route('faq.index')->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $kelas = FaqModel::find($id);
        $kelas->delete();
        return redirect()->route('faq.index')->with(['success' => 'Data Berhasil Dihapus']);
    }
}
