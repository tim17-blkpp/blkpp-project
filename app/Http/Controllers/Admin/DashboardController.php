<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;
use App\Models\DeviceModel;
use App\Models\ProfilModel;
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

        $filter = $request->input('filter', 'hari_ini');

        return view('admin.dashboard.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'filter',
        ));
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
            'message' => 'sucess',
            'data' => [
                'total_siswa' => $total_siswa,
                'count_laki' => $count_lk,
                'count_perempuan' => $count_pr,
                'avg_umur' => $avg_umur,
                ]
            ], 200);
        // if ($login) {
        //     if (Auth::user()->role == 'Super Admin' || Auth::user()->role == 'Admin') {
        //         return response()->json([
        //             'response_code' => 200,
        //             'message' => 'sucess',
        //             'data' => [
        //                 'total_siswa' => $total_siswa,
        //                 'count_laki' => $count_laki,
        //                 'count_perempuan' => $count_perempuan,
        //                 'avg_umur' => $avg_umur,
        //             ]
        //         ]);
        //     }
        // }
        // return response()->json([
        //     'response_code' => 403,
        //     'message' => Auth::user()->can('show:statistic')
        // ])->setStatusCode(403);
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
