<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use App\Models\HasilPelatihanModel;
use App\Models\ProfilModel;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class PelatihanKandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $toptitle = 'Pelatihan';
        $title = 'Pelatihan';
        $subtitle = 'Data Pelatihan';

        $all_data = HasilPelatihanModel::where('id_user', auth()->user()->id)
            ->with('pelatihan')
            ->with('sesi')
            ->get();

        return view('kandidat.hasil_pelatihan.index', compact(
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
            'id_pelatihan' => 'required',
            'id_sesi' => 'required',
        ]);

        // echo $request->id_pelatihan;
        // die();

        $data_input = HasilPelatihanModel::create([
            'id_pelatihan' => $request->id_pelatihan,
            'id_sesi' => $request->id_sesi,
            'id_user' => auth()->user()->id,
            'status_seleksi_administrasi' => 'Menunggu',
        ]);

        return redirect()->route('pelatihan-kandidat.index')->with(['success' => 'Data Berhasil Disimpan']);
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
        $hasil_pelatihan = HasilPelatihanModel::findOrFail($id);

        $pakta_integritas = $hasil_pelatihan->pakta_integritas;
        $sertifikat = $hasil_pelatihan->sertifikat;

        if ($request->status_seleksi_administrasi != null) {
            $dataSeleksi['status_seleksi_administrasi'] = $request->status_seleksi_administrasi;
            $dataSeleksi['hasil_seleksi_administrasi'] = $request->hasil_seleksi_administrasi;
        }

        if ($request->status_seleksi_tes != null) {
            $dataSeleksi['status_seleksi_tes'] = $request->status_seleksi_tes;
            $dataSeleksi['hasil_seleksi_tes'] = $request->hasil_seleksi_tes;
        }

        if ($request->status_seleksi_wawancara != null) {
            $dataSeleksi['status_seleksi_wawancara'] = $request->status_seleksi_wawancara;
            $dataSeleksi['hasil_seleksi_wawancara'] = $request->hasil_seleksi_wawancara;
        }

        if ($request->status_seleksi_daftar_ulang != null) {
            $dataSeleksi['status_seleksi_daftar_ulang'] = $request->status_seleksi_daftar_ulang;
            $dataSeleksi['hasil_seleksi_daftar_ulang'] = $request->hasil_seleksi_daftar_ulang;

            if ($request->hasFile('pakta_integritas')) {
                $file = $request->file('pakta_integritas');
                $fileName = auth()->user()->id . time() . uniqid() . '.' . $file->getClientOriginalExtension();
                $destinationPath = public_path() . '/berkas';
                $file->move($destinationPath, $fileName);
                try {
                    unlink(public_path() . '/' . $pakta_integritas);
                } catch (Exception $e) {
                }
                $pakta_integritas = 'berkas/' . $fileName;
                $dataSeleksi['pakta_integritas'] = $pakta_integritas;
            }
        }

        if ($request->keterangan != null) {
            $dataSeleksi['keterangan'] = $request->keterangan;

            if ($request->hasFile('sertifikat')) {
                $fileSertifikat = $request->file('sertifikat');
                $fileNameSertifikat = auth()->user()->id . time() . uniqid() . '.' . $fileSertifikat->getClientOriginalExtension();
                $destinationPathSertifikat = public_path() . '/berkas';
                $fileSertifikat->move($destinationPathSertifikat, $fileNameSertifikat);
                try {
                    unlink(public_path() . '/' . $pakta_integritas);
                } catch (Exception $e) {
                }
                $sertifikat = 'berkas/' . $fileNameSertifikat;
                $dataSeleksi['sertifikat'] = $sertifikat;
            }
        }

        $hasil_pelatihan->update($dataSeleksi);

        if (auth()->user()->role == 'Kandidat') {
            return redirect()->route('pelatihan-kandidat.index')->with(['success' => 'Data Berhasil Disimpan']);
        } else {
            return redirect()->route('sesi_pelatihan.show', $hasil_pelatihan->id_sesi)->with(['success' => 'Data Berhasil Disimpan']);
        }
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
