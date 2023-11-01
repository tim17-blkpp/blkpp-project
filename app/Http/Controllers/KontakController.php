<?php

namespace App\Http\Controllers;

use App\Models\KonfigurasiModel;
use Illuminate\Http\Request;

class KontakController extends Controller
{
    public function get(Request $request)
    {
        $toptitle = 'Kontak';
        $title = 'Kontak';
        $subtitle = 'Data Kontak';
        
        $kontak = KonfigurasiModel::first();

        return view('landing.kontak.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'kontak',
        ));
    }

}
