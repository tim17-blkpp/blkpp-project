<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HasilPelatihanModel;
use App\Models\JawabanUserModel;
use App\Models\SesiPelatihanModel;
use App\Models\SoalModel;
use Illuminate\Http\Request;
use Exception;

class JawabanUserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $toptitle = 'Jawaban Peserta';
        $title = 'Jawaban Peserta';
        $subtitle = 'Jawaban Peserta';

        $id_hasil_seleksi = $request->id_hasil_seleksi;

        $hasil_pelatihan = HasilPelatihanModel::findOrFail($id_hasil_seleksi);

        $id_user = $hasil_pelatihan->id_user;
        $id_sesi = $hasil_pelatihan->id_sesi;

        // echo $id_user . ' --- ' . $id_sesi;
        // die();


        $all_data = SoalModel::select('soal.*', 'jawaban_user.jawaban as jawaban_user', 'jawaban_user.poin as poin_user')
            ->join('jawaban_user', 'soal.id', '=', 'jawaban_user.id_soal')
            ->where('soal.id_pelatihan', $hasil_pelatihan->id_pelatihan)
            ->where('jawaban_user.id_user', $id_user)
            ->with('pilihan_jawaban')
            ->get();

        return view('admin.jawaban_user.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'all_data',
            'id_sesi',
            'id_user',
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
            'id_soal' => 'required|array',
            'id_user' => 'required',
            'poin' => 'required|array',
        ]);

        $poin = 0;

        foreach ($request->id_soal as $index => $id_soal) {
            JawabanUserModel::updateOrCreate(
                [
                    'id_soal' => $id_soal,
                    'id_user' => $request->id_user,
                ],
                [
                    'poin' => $request->poin[$index],
                ]
            );

            $poin = $poin + $request->poin[$index];
        }

        $hasil_pelatihan = HasilPelatihanModel::where('id_user', $request->id_user)
            ->where('id_sesi', $id)
            ->first();
        $dataSeleksi['hasil_seleksi_tes'] = 'Poin : ' . $poin;
        $hasil_pelatihan->update($dataSeleksi);

        return redirect()->route('sesi_pelatihan.show', $id)->with('success', 'Data Berhasil Disimpan');
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
