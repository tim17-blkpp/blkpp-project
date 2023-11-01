<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use App\Models\JawabanUserModel;
use App\Models\HasilPelatihanModel;
use App\Models\SoalModel;
use Illuminate\Http\Request;
use App\Models\User;

class KerjakanTesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $toptitle = 'Kerjakan Tes';
        $title = 'Kerjakan Tes';
        $subtitle = 'Kerjakan Tes';

        $id_pelatihan = $request->id_pelatihan;

        // $all_data = SoalModel::where('id_pelatihan', $id_pelatihan)
        //     ->with('jawaban_user')
        //     ->with('pilihan_jawaban')
        //     ->get();

        $user_id = auth()->user()->id;

        // $all_data = SoalModel::select('soal.*', 'jawaban_user.jawaban as jawaban_user')
        //     ->join('jawaban_user', 'soal.id', '=', 'jawaban_user.id_soal')
        //     ->where('soal.id_pelatihan', $id_pelatihan)
        //     ->where('jawaban_user.id_user', auth()->user()->id)
        //     ->with('pilihan_jawaban')
        //     ->get();
        
        $all_data = SoalModel::select('soal.*', 'jawaban_user.jawaban as jawaban_user')
            ->leftJoin('jawaban_user', function($join) {
                $join->on('soal.id', '=', 'jawaban_user.id_soal')
                    ->where('jawaban_user.id_user', auth()->user()->id);
            })
            ->where('soal.id_pelatihan', $id_pelatihan)
            ->addSelect(\DB::raw('IFNULL(jawaban_user.jawaban, NULL) as jawaban_user'))
            ->with('pilihan_jawaban')
            ->get();

        // echo $all_data;
        // die();

        return view('kandidat.kerjakan_tes.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'all_data',
            'id_pelatihan',
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
            'jawaban' => 'required|array',
            // tambahkan validasi lainnya sesuai kebutuhan
        ]);

        $id_user = auth()->user()->id; // Ambil ID user dari sesi atau otentikasi
        $poin_total = 0;
        
        foreach ($request->id_soal as $index => $id_soal) {
            $jawaban_poin = explode("---", $request->jawaban[$id_soal]);
            $jawaban = $jawaban_poin[0];
            $poin = 0;
            if (count($jawaban_poin) > 1) {
                $poin = $jawaban_poin[1];
            }
            JawabanUserModel::updateOrCreate(
                [
                    'id_soal' => $id_soal,
                    'id_user' => $id_user,
                ],
                [
                    'jawaban' => $jawaban,
                    'poin' => $poin,
                    // tambahkan logika untuk menghitung poin jika diperlukan
                ]
            );
            
            $poin_total = $poin_total + $poin;
        }
        
        $hasil_pelatihan = HasilPelatihanModel::where('id_user', $id_user)
            ->where('id_pelatihan', $id)
            ->first();
        $dataSeleksi['hasil_seleksi_tes'] = 'Poin : ' . $poin_total;
        $hasil_pelatihan->update($dataSeleksi);

        return redirect()->route('kerjakan-tes.index', ['id_pelatihan' => $id])->with('success', 'Data Berhasil Disimpan');
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
