<?php

namespace App\Http\Controllers;

use App\Models\FaqModel;
use App\Models\LowonganKerjaModel;
use App\Models\PelatihanModel;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;

class LandingController extends Controller
{
    public function get(Request $request)
    {
        $toptitle = 'Landing';
        $title = 'Landing';
        $subtitle = 'Data Landing';

        $pelatihan = PelatihanModel::with('kategori')
            ->orderBy('id', 'DESC')
            ->take(6)
            ->get();

        $lowongan_kerja = LowonganKerjaModel::with('kategori')
            ->with('perusahaan')
            ->orderBy('id', 'DESC')
            ->take(6)
            ->get();

        $faq = FaqModel::orderBy('judul', 'ASC')
            ->get();

        return view('landing.landing.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'pelatihan',
            'lowongan_kerja',
            'faq',
        ));
    }
}
