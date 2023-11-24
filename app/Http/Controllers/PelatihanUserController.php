<?php

namespace App\Http\Controllers;

use App\Models\HasilPelatihanModel;
use App\Models\PelatihanModel;
use App\Models\KategoriPelatihanModel;
use Illuminate\Http\Request;

class PelatihanUserController extends Controller
{
    public function get(Request $request)
    {
        $toptitle = 'Pelatihan';
        $title = 'Pelatihan';
        $subtitle = 'Data Pelatihan';
        $nama_kategori = null;
        $kata_kunci = null;
        $kategori = KategoriPelatihanModel::all();

        $query = PelatihanModel::with('kategori')
            ->where('status', 1)
            ->orderBy('id', 'DESC');

        // Filter berdasarkan judul blog
        if ($request->has('kata_kunci')) {
            $query->where('judul', 'like', '%' . $request->kata_kunci . '%');
            $kata_kunci = $request->kata_kunci;
        }

        // Filter berdasarkan kategori
        if ($request->id_kategori != null && $request->id_kategori != '') {
            $query->where('id_kategori', $request->id_kategori);
            $nama_kategori = KategoriPelatihanModel::where('id', $request->id_kategori)->first()->nama;
        }

        $blogs = $query->paginate(6)->appends([
            'id_kategori' => $request->id_kategori,
            'kata_kunci' => $request->kata_kunci, // Menambahkan pencarian judul_blog ke dalam tautan paginasi
        ]);

        $terbaru = PelatihanModel::with('kategori')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        return view('landing.pelatihan.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'blogs',
            'kategori',
            'terbaru',
            'nama_kategori',
            'kata_kunci',
        ));
    }

    public function detail(Request $request)
    {
        $toptitle = 'Detail Pelatihan';
        $title = 'Detail Pelatihan';
        $subtitle = 'Data Detail Pelatihan';
        $kata_kunci = $request->kata_kunci;

        $detail = PelatihanModel::with('kategori')
            ->with('jpl')
            ->with(['sesi' => function ($query) {
                $query->where('status', 1);
            }])
            ->where('id', $request->id)
            ->first();

        $hasil_pelatihan = null;
        if (auth()->user() != null) {
            $hasil_pelatihan = HasilPelatihanModel::where('id_pelatihan', $request->id)
                ->where('id', $request->id)
                ->where('id_user', auth()->user()->id)
                ->first();
        }

        $kategori = KategoriPelatihanModel::all();

        $terbaru = PelatihanModel::with('kategori')
            ->where('status', 1)
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        $sesuai = PelatihanModel::with('kategori')
            ->where('status', 1)
            ->where('id_kategori', $detail->id_kategori)
            ->orderBy('id', 'DESC')
            ->take(2)
            ->get();

        return view('landing.pelatihan.detail', compact(
            'toptitle',
            'title',
            'subtitle',
            'detail',
            'hasil_pelatihan',
            'kategori',
            'terbaru',
            'sesuai',
            'kata_kunci',
        ));
    }
}
