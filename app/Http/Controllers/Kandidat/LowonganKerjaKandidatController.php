<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use App\Models\LowonganKerjaApplyModel;
use Illuminate\Http\Request;

class LowonganKerjaKandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $toptitle = 'Apply Lowongan Kerja';
        $title = 'Apply Lowongan Kerja';
        $subtitle = 'Data Apply Lowongan Kerja';

        $all_data = LowonganKerjaApplyModel::where('id_user', auth()->user()->id)
            ->with('lowongan_kerja')
            ->get();

        return view('kandidat.lowongan_kerja.index', compact(
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
            'id_lowongan_kerja' => 'required',
        ]);

        $data_input = LowonganKerjaApplyModel::create([
            'id_lowongan_kerja' => $request->id_lowongan_kerja,
            'id_user' => auth()->user()->id,
            'keterangan' => 'Menunggu',
        ]);

        return redirect()->route('lowongan-kerja-apply.index')->with(['success' => 'Data Berhasil Disimpan']);
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
        $lowongan_kerja_apply = LowonganKerjaApplyModel::findOrFail($id);

        $dataSeleksi['keterangan'] = $request->keterangan;

        $lowongan_kerja_apply->update($dataSeleksi);

        return redirect()->route('lowongan_kerja.show', $lowongan_kerja_apply->id_lowongan_kerja)->with(['success' => 'Data Berhasil Disimpan']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
