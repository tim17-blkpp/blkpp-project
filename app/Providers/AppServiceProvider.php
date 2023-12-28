<?php

namespace App\Providers;

use App\Models\KategoriBlogModel;
use App\Models\KategoriLowonganKerjaModel;
use App\Models\KategoriPelatihanModel;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (Schema::hasTable('kategori_pelatihan') && Schema::hasTable('kategori_lowongan_kerja') && Schema::hasTable('kategori_blog')) {
            Paginator::useBootstrap();
            $kategori_pelatihan = KategoriPelatihanModel::orderBy('nama', 'ASC')->get();
            $kategori_lowongan_kerja = KategoriLowonganKerjaModel::orderBy('nama', 'ASC')->get();
            $kategori_blog = KategoriBlogModel::orderBy('nama', 'ASC')->get();
            $data = array(
                'kategori_pelatihan' => $kategori_pelatihan,
                'kategori_lowongan_kerja' => $kategori_lowongan_kerja,
                'kategori_blog' => $kategori_blog,
            );

            View::share("service", $data);
        }
    }
}
