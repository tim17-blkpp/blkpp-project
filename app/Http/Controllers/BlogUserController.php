<?php

namespace App\Http\Controllers;

use App\Models\BlogModel;
use App\Models\KategoriBlogModel;
use Illuminate\Http\Request;

class BlogUserController extends Controller
{
    public function get(Request $request)
    {
        $toptitle = 'Blog';
        $title = 'Blog';
        $subtitle = 'Data Blog';
        $nama_kategori = null;
        $kata_kunci = null;
        $kategori = KategoriBlogModel::all();

        $query = BlogModel::with('kategori')->orderBy('id', 'DESC');

        // Filter berdasarkan judul blog
        if ($request->has('kata_kunci')) {
            $query->where('judul', 'like', '%' . $request->kata_kunci . '%');
            $kata_kunci = $request->kata_kunci;
        }

        // Filter berdasarkan kategori
        if ($request->id_kategori != null && $request->id_kategori != '') {
            $query->where('id_kategori', $request->id_kategori);
            $nama_kategori = KategoriBlogModel::where('id', $request->id_kategori)->first()->nama;
        }

        $blogs = $query->paginate(6)->appends([
            'id_kategori' => $request->id_kategori,
            'kata_kunci' => $request->kata_kunci, // Menambahkan pencarian judul_blog ke dalam tautan paginasi
        ]);

        $terbaru = BlogModel::with('kategori')
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        return view('landing.blog.index', compact(
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
        $toptitle = 'Detail Blog';
        $title = 'Detail Blog';
        $subtitle = 'Data Detail Blog';
        $kata_kunci = $request->kata_kunci;

        $detail = BlogModel::with('kategori')
            ->where('id', $request->id)
            ->first();

        $kategori = KategoriBlogModel::all();

        $terbaru = BlogModel::with('kategori')
            ->orderBy('id', 'DESC')
            ->take(5)
            ->get();

        $sesuai = BlogModel::with('kategori')
            ->where('id_kategori', $detail->id_kategori)
            ->orderBy('id', 'DESC')
            ->take(2)
            ->get();

        return view('landing.blog.detail', compact(
            'toptitle',
            'title',
            'subtitle',
            'detail',
            'kategori',
            'terbaru',
            'sesuai',
            'kata_kunci',
        ));
    }
}
