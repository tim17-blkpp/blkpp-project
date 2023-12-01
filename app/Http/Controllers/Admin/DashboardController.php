<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;
use App\Http\Resources\PelatihanResource;
use App\Http\Resources\SesiPelatihanResource;
use App\Models\DeviceModel;
use App\Models\PelatihanModel;
use App\Models\ProfilModel;
use App\Models\SesiPelatihanModel;
use App\Models\KategoriPelatihanModel;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $toptitle = 'Dashboard';
        $title = 'Dashboard';
        $subtitle = 'Data Dashboard';
        $kategori = KategoriPelatihanModel::all();
        $pelatihan = PelatihanModel::all();
        $sesipelatihan = SesiPelatihanModel::all();

        $filter = $request->input('filter', 'hari_ini');

        return view('admin.dashboard.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'filter',
            'kategori',
            'pelatihan',
            'sesipelatihan'
        ));
    }

    public function getDataPelatihan(Request $request) {
        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $angkatan = $request->input('angkatan');
        $kejuruan = $request->input('kejuruan');
        $pelatihan = $request->input('pelatihan');

        $query = SesiPelatihanModel::with('pelatihan');
        if ($tahun) {
            $query->whereHas('pelatihan.jpl', function($q) use ($tahun) {
                $q->where('tahun', $tahun);
            });
        }
        if ($anggaran) {
            $query->whereHas('pelatihan.jpl', function($q) use ($anggaran) {
                $q->where('anggaran', $anggaran);
            });
        }
        if ($angkatan) {
            $query->where('angkatan', $angkatan);
        }
        if ($kejuruan) {
            $query->whereHas('pelatihan', function($q) use ($kejuruan) {
                $q->where('judul', 'like', '%'.$kejuruan.'%');
            });
        }
        if ($pelatihan) {
            $query->whereHas('pelatihan.jpl', function($q) use ($pelatihan) {
                $q->where('pelatihan', 'like', '%'.$pelatihan.'%');
            });
        }
        $query = $query->get();

        $all_sesi = SesiPelatihanModel::with('pelatihan')->get();
        return response()->json([
            'response_code' => 200,
            'message' => 'success',
            'data' => SesiPelatihanResource::collection($query)
        ], 200);
    }

    public function getStatistik(Request $request) {
        $kandidat = User::where('role', 'Kandidat')->get();
        $total_siswa = $kandidat->count();
        // coming soon cari di database
        $count_lk = ProfilModel::join('users', 'profil.id_user', '=', 'users.id')
                    ->whereIn('users.id', $kandidat->pluck('id'))
                    ->where('profil.jenis_kelamin', 'L')
                    ->count();
        $count_pr = ProfilModel::join('users', 'profil.id_user', '=', 'users.id')
                    ->whereIn('users.id', $kandidat->pluck('id'))
                    ->where('profil.jenis_kelamin', 'P')
                    ->count();
        $avg_umur = round(ProfilModel::join('users', 'profil.id_user', '=', 'users.id')
                    ->whereIn('users.id', $kandidat->pluck('id'))
                    ->avg(DB::raw('YEAR(CURDATE()) - YEAR(tanggal_lahir)'))
                    , 2);

        return response()->json([
            'response_code' => 200,
            'message' => 'success',
            'data' => [
                'total_siswa' => $total_siswa,
                'count_laki' => $count_lk,
                'count_perempuan' => $count_pr,
                'avg_umur' => $avg_umur,
                ]
            ], 200);
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
        //
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
