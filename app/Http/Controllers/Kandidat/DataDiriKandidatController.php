<?php

namespace App\Http\Controllers\Kandidat;

use App\Http\Controllers\Controller;
use App\Models\ProfilModel;
use App\Models\User;
use Illuminate\Http\Request;
use Exception;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;

class DataDiriKandidatController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $toptitle = 'Data Diri';
        $title = 'Data Diri';
        $subtitle = 'Data Diri';

        $profil = ProfilModel::where('id_user', auth()->user()->id)->first();

        return view('kandidat.data_diri.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'profil',
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
        //
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
            'name' => 'required',
            'email' => 'required',
            'nik' => 'required',
        ]);

        $data_user = User::findOrFail($id);
        $data_profil = ProfilModel::where('id_user', $data_user->id)->first();


        $avatar = $data_profil->avatar;
        $ktp = $data_profil->ktp;
        $ijazah = $data_profil->ijazah;

        if ($request->hasFile('avatar')) {
            $fileAvatar = $request->file('avatar');
            $fileNameAvatar = auth()->user()->id . time() . uniqid() . '.' . $fileAvatar->getClientOriginalExtension();
            $destinationPath = public_path() . '/berkas';
            $fileAvatar->move($destinationPath, $fileNameAvatar);
            try {
                unlink(public_path() . '/' . $avatar);
            } catch (Exception $e) {
            }
            $avatar = 'berkas/' . $fileNameAvatar;
        }

        if ($request->hasFile('ktp')) {
            $fileKtp = $request->file('ktp');
            $fileNameKtp = auth()->user()->id . time() . uniqid() . '.' . $fileKtp->getClientOriginalExtension();
            $destinationPath = public_path() . '/berkas';
            $fileKtp->move($destinationPath, $fileNameKtp);
            try {
                unlink(public_path() . '/' . $ktp);
            } catch (Exception $e) {
            }
            $ktp = 'berkas/' . $fileNameKtp;
        }

        if ($request->hasFile('ijazah')) {
            $fileIjazah = $request->file('ijazah');
            $fileNameIjazah = auth()->user()->id . time() . uniqid() . '.' . $fileIjazah->getClientOriginalExtension();
            $destinationPath = public_path() . '/berkas';
            $fileIjazah->move($destinationPath, $fileNameIjazah);
            try {
                unlink(public_path() . '/' . $ijazah);
            } catch (Exception $e) {
            }
            $ijazah = 'berkas/' . $fileNameIjazah;
        }

        $jenis_kelamin = 'L';
        if ((int)(substr($request->nik, 6, 2)) > 40) {
            $jenis_kelamin = 'P';
        }

        $dataUserUp['id_kategori'] = $request->name;
        $dataUserUp['judul'] = $request->email;

        $dataProfilUp['nik'] = $request->nik;
        $dataProfilUp['jenis_kelamin'] = $jenis_kelamin;
        $dataProfilUp['tempat_lahir'] = $request->tempat_lahir;
        $dataProfilUp['tanggal_lahir'] = Carbon::createFromFormat('Y-m-d', $request->tanggal_lahir);
        $dataProfilUp['pendidikan'] = $request->pendidikan;
        $dataProfilUp['tahun_pendidikan'] = $request->tahun_pendidikan;
        $dataProfilUp['alamat'] = $request->alamat;
        $dataProfilUp['alamat_domisili'] = $request->alamat_domisili;
        $dataProfilUp['nomor_hp'] = $request->nomor_hp;

        $pendidikan_sd = $request->instansi_sd . ' | ' . $request->tahun_lulus_sd;
        $pendidikan_smp = $request->instansi_smp . ' | ' . $request->tahun_lulus_smp;
        $pendidikan_sma = $request->instansi_sma . ' | ' . $request->jurusan_sma . ' | ' . $request->tahun_lulus_sma;
        $pendidikan_s1 = $request->instansi_s1 . ' | ' . $request->jurusan_s1 . ' | ' . $request->tahun_lulus_s1;
        $pendidikan_s2 = $request->instansi_s2 . ' | ' . $request->jurusan_s2 . ' | ' . $request->tahun_lulus_s2;
        $pendidikan_s3 = $request->instansi_s3 . ' | ' . $request->jurusan_s3 . ' | ' . $request->tahun_lulus_s3;

        $dataProfilUp['pendidikan_sd'] = $pendidikan_sd;
        $dataProfilUp['pendidikan_smp'] = $pendidikan_smp;
        $dataProfilUp['pendidikan_sma'] = $pendidikan_sma;
        $dataProfilUp['pendidikan_s1'] = $pendidikan_s1;
        $dataProfilUp['pendidikan_s2'] = $pendidikan_s2;
        $dataProfilUp['pendidikan_s3'] = $pendidikan_s3;

        $dataProfilUp['avatar'] = $avatar;
        $dataProfilUp['ktp'] = $ktp;
        $dataProfilUp['ijazah'] = $ijazah;

        $eror_pass = '';

        if ($request->password != null) {
            if ($request->password == $request->password_confirmation) {
                $dataProfilUp['password'] = Hash::make($request->password);
            } else {
                $eror_pass = ', Terjadi kesalahan saat merubah password.';
            }
        }

        $data_user->update($dataUserUp);
        $data_profil->update($dataProfilUp);

        return redirect()->route('data-diri-kandidat.index')->with(['success' => 'Data Berhasil Disimpan' . $eror_pass]);
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
