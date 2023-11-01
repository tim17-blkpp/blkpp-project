<?php

namespace App\Http\Controllers;

use App\Models\LowonganKerjaModel;
use App\Models\KategoriLowonganKerjaModel;
use App\Models\LowonganKerjaApplyModel;
use Illuminate\Http\Request;

class LowonganKerjaUserController extends Controller
{
    public function get(Request $request)
    {
        $toptitle = 'Lowongan Pekerjaan';
        $title = 'Lowongan Pekerjaan';
        $subtitle = 'Data Lowongan Pekerjaan';
        $nama_kategori = null;
        $kata_kunci = null;
        $kategori = KategoriLowonganKerjaModel::all();

        $query = LowonganKerjaModel::with('kategori')->orderBy('id', 'DESC');

        // Filter berdasarkan judul blog
        if ($request->has('kata_kunci')) {
            $query->where('judul', 'like', '%' . $request->kata_kunci . '%');
            $kata_kunci = $request->kata_kunci;
        }

        // Filter berdasarkan kategori
        if ($request->id_kategori != null && $request->id_kategori != '') {
            $query->where('id_kategori', $request->id_kategori);
            $nama_kategori = KategoriLowonganKerjaModel::where('id', $request->id_kategori)->first()->nama;
        }

        $lokers = $query->paginate(6)->appends([
            'id_kategori' => $request->id_kategori,
            'kata_kunci' => $request->kata_kunci, // Menambahkan pencarian judul_blog ke dalam tautan paginasi
        ]);

        $terbaru = LowonganKerjaModel::with('kategori')
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        return view('landing.lowongan_pekerjaan.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'lokers',
            'kategori',
            'terbaru',
            'nama_kategori',
            'kata_kunci',
        ));
    }

    public function detail(Request $request)
    {
        $toptitle = 'Detail Lowongan Pekerjaan';
        $title = 'Detail Lowongan Pekerjaan';
        $subtitle = 'Data Detail Lowongan Pekerjaan';
        $kata_kunci = $request->kata_kunci;

        $detail = LowonganKerjaModel::with('kategori')
            ->with('perusahaan')
            ->where('id', $request->id)
            ->first();

        $lowongan_kerja_apply = null;
        if (auth()->user() != null) {
            $lowongan_kerja_apply = LowonganKerjaApplyModel::where('id_lowongan_kerja', $request->id)
                ->where('id_user', auth()->user()->id)
                ->first();
        }

        $kategori = KategoriLowonganKerjaModel::all();

        $terbaru = LowonganKerjaModel::with('kategori')
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        $sesuai = LowonganKerjaModel::with('kategori')
            ->where('id_kategori', $detail->id_kategori)
            ->orderBy('id', 'DESC')
            ->take(2)
            ->get();

        return view('landing.lowongan_pekerjaan.detail', compact(
            'toptitle',
            'title',
            'subtitle',
            'detail',
            'kategori',
            'terbaru',
            'sesuai',
            'kata_kunci',
            'lowongan_kerja_apply',
        ));
    }
}
