<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Resources\DashboardResource;
use App\Http\Resources\PelatihanResource;
use App\Http\Resources\SesiPelatihanResource;
use App\Models\DeviceModel;
use App\Models\HasilPelatihanModel;
use App\Models\PelatihanModel;
use App\Models\ProfilModel;
use App\Models\SesiPelatihanModel;
use App\Models\KategoriPelatihanModel;
use App\Models\User;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Symfony\Component\HttpKernel\Profiler\Profile;

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
        // $kategori = KategoriPelatihanModel::all();
        // $pelatihan = PelatihanModel::all();
        $kategori = KategoriPelatihanModel::select('nama')->distinct()->get();
        $pelatihan = PelatihanModel::select('judul')->distinct()->get();
        $sesi_pelatihan = SesiPelatihanModel::all();
        $angkatan = SesiPelatihanModel::select('angkatan')->distinct()->get();

        $filter = $request->input('filter', 'hari_ini');

        return view('admin.dashboard.index', compact(
            'toptitle',
            'title',
            'subtitle',
            'filter',
            'kategori',
            'pelatihan',
            'sesi_pelatihan',
            'angkatan'
        ));
    }

    public function getDataPelatihan(Request $request) {
        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $angkatan = $request->input('angkatan');
        $kategori = $request->input('kategori');
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
        if ($kategori) {
            $query->whereHas('pelatihan.kategori', function($q) use ($kategori) {
                $q->where('nama', 'like', '%'.$kategori.'%');
            });
        }
        if ($pelatihan) {
            $query->whereHas('pelatihan', function($q) use ($pelatihan) {
                $q->where('judul', 'like', '%'.$pelatihan.'%');
            });
        }
        $query = $query->get();
        // $query = $query->paginate(10);

        $all_sesi = SesiPelatihanModel::with('pelatihan')->get();
        return response()->json([
            'response_code' => 200,
            'message' => 'success',
            'data' => SesiPelatihanResource::collection($query)
        ], 200);
    }

    public function getDataUmur(Request $request) {
        $umurRanges = ['17-20', '21-30', '31-40', '41-50', '51-60', '61-100'];
        $total = 0;
        $data = [];

        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $kategori = $request->input('kategori');
        $pelatihan = $request->input('pelatihan');
        $angkatan = $request->input('angkatan');

        $query = HasilPelatihanModel::with(['pelatihan', 'sesi', 'user.profil'])->get();

        if ($tahun) {
            $query = $query->filter(function ($hasil) use ($tahun) {
                return $hasil->pelatihan->jpl->tahun == $tahun;
            });
        }
        if ($anggaran) {
            $query = $query->filter(function ($hasil) use ($anggaran) {
                return $hasil->pelatihan->jpl->anggaran == $anggaran;
            });
        }
        if ($kategori) {
            $query = $query->filter(function ($hasil) use ($kategori) {
                return $hasil->pelatihan->kategori->nama == $kategori;
            });
        }
        if ($pelatihan) {
            $query = $query->filter(function ($hasil) use ($pelatihan) {
                return $hasil->pelatihan->judul == $pelatihan;
            });
        }
        if ($angkatan) {
            $query = $query->filter(function ($hasil) use ($angkatan) {
                return $hasil->sesi->angkatan == $angkatan;
            });
        }

        foreach ($umurRanges as $range) {
            $age = explode('-', $range);
            $users = $query->filter(function ($user) use ($age) {
                return (date('Y') - date('Y', strtotime($user->user->profil->tanggal_lahir))) >= $age[0] &&
                       (date('Y') - date('Y', strtotime($user->user->profil->tanggal_lahir))) <= $age[1];
            });

            $lk = $users->where('user.profil.jenis_kelamin', 'L')->count();
            $pr = $users->count() - $lk;

            $data["u{$age[0]}_lk"] = $lk;
            $data["u{$age[0]}_pr"] = $pr;

            $total += $users->count();
        }

        return [
            'data' => $data,
            'total' => $total
        ];
    }

    public function getDataPendidikan(Request $request) {
        $query = HasilPelatihanModel::with(['pelatihan', 'sesi', 'user.profil'])->get();

        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $kategori = $request->input('kategori');
        $pelatihan = $request->input('pelatihan');
        $angkatan = $request->input('angkatan');

        if ($tahun) {
            $query = $query->filter(function ($hasil) use ($tahun) {
                return $hasil->pelatihan->jpl->tahun == $tahun;
            });
        }
        if ($anggaran) {
            $query = $query->filter(function ($hasil) use ($anggaran) {
                return $hasil->pelatihan->jpl->anggaran == $anggaran;
            });
        }
        if ($kategori) {
            $query = $query->filter(function ($hasil) use ($kategori) {
                return $hasil->pelatihan->kategori->nama == $kategori;
            });
        }
        if ($pelatihan) {
            $query = $query->filter(function ($hasil) use ($pelatihan) {
                return $hasil->pelatihan->judul == $pelatihan;
            });
        }
        if ($angkatan) {
            $query = $query->filter(function ($hasil) use ($angkatan) {
                return $hasil->sesi->angkatan == $angkatan;
            });
        }

        // $users = User::with('profil')->where('role', 'Kandidat')->get();
        $pendidikan = [
            'S3' => 0,
            'S2' => 0,
            'S1' => 0,
            'SMA' => 0,
            'SMP' => 0,
            'SD' => 0,
        ];
        foreach ($query as $user) {
            if ($user->user->profil->pendidikan_s3 != null) {
                $pendidikan['S3'] += 1;
            } elseif ($user->user->profil->pendidikan_s2 != null) {
                $pendidikan['S2'] += 1;
            } elseif ($user->user->profil->pendidikan_s1 != null) {
                $pendidikan['S1'] += 1;
            } elseif ($user->user->profil->pendidikan_sma != null) {
                $pendidikan['SMA'] += 1;
            } elseif ($user->user->profil->pendidikan_smp != null) {
                $pendidikan['SMP'] += 1;
            } elseif ($user->user->profil->pendidikan_sd != null) {
                $pendidikan['SD'] += 1;
            }
        }
        return $pendidikan;
    }

    public function getDataAnggaran(Request $request) {
        $query = HasilPelatihanModel::with(['pelatihan', 'sesi'])->get();

        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $kategori = $request->input('kategori');
        $pelatihan = $request->input('pelatihan');
        $angkatan = $request->input('angkatan');

        if ($tahun) {
            $query = $query->filter(function ($hasil) use ($tahun) {
                return $hasil->pelatihan->jpl->tahun == $tahun;
            });
        }
        if ($anggaran) {
            $query = $query->filter(function ($hasil) use ($anggaran) {
                return $hasil->pelatihan->jpl->anggaran == $anggaran;
            });
        }
        if ($kategori) {
            $query = $query->filter(function ($hasil) use ($kategori) {
                return $hasil->pelatihan->kategori->nama == $kategori;
            });
        }
        if ($pelatihan) {
            $query = $query->filter(function ($hasil) use ($pelatihan) {
                return $hasil->pelatihan->judul == $pelatihan;
            });
        }
        if ($angkatan) {
            $query = $query->filter(function ($hasil) use ($angkatan) {
                return $hasil->sesi->angkatan == $angkatan;
            });
        }

        $anggaran = [
            'APBN' => 0,
            'APBD' => 0,
            'APBN Covid' => 0,
        ];

        $tahun_anggaran = [
            '2020' => $anggaran,
            '2021' => $anggaran,
            '2022' => $anggaran,
            '2023' => $anggaran
        ];

        foreach ($query as $data) {
            $tahun = $data->pelatihan->jpl->tahun;
            $jenis = $data->pelatihan->jpl->anggaran;
            $tahun_anggaran[$tahun][$jenis] += 1;
        }

        return $tahun_anggaran;
    }

    public function getDataKompetensi(Request $request) {
        $query = HasilPelatihanModel::with(['pelatihan', 'sesi', 'user.profil'])->get();

        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $kategori = $request->input('kategori');
        $pelatihan = $request->input('pelatihan');
        $angkatan = $request->input('angkatan');

        if ($tahun) {
            $query = $query->filter(function ($hasil) use ($tahun) {
                return $hasil->pelatihan->jpl->tahun == $tahun;
            });
        }
        if ($anggaran) {
            $query = $query->filter(function ($hasil) use ($anggaran) {
                return $hasil->pelatihan->jpl->anggaran == $anggaran;
            });
        }
        if ($kategori) {
            $query = $query->filter(function ($hasil) use ($kategori) {
                return $hasil->pelatihan->kategori->nama == $kategori;
            });
        }
        if ($pelatihan) {
            $query = $query->filter(function ($hasil) use ($pelatihan) {
                return $hasil->pelatihan->judul == $pelatihan;
            });
        }
        if ($angkatan) {
            $query = $query->filter(function ($hasil) use ($angkatan) {
                return $hasil->sesi->angkatan == $angkatan;
            });
        }

        $kompetensi = [
            'Lulus' => 0,
            'Tidak Lulus' => 0,
            'Proses' => 0,
        ];
        foreach ($query as $data) {
            $id_user = $data->user->id;
            // $status = $data->status_seleksi_daftar_ulang;
            $status = $data->keterangan;
            if ($status != null) {
                $kompetensi[$status] = $data->where('keterangan', $status)->count();
            }
            elseif ($status == null) {
                $kompetensi['Proses'] = $data->where('keterangan', $status)->count();
            }
        }

        return $kompetensi;
    }

    public function getStatistik(Request $request) {
        // kamingsun ganti pengecekan lewat pelatihan buat cari siswa bukan kandidat
        // $kandidat = ProfilModel::with('user')->where('role', 'Kandidat')->get();
        $kandidat = HasilPelatihanModel::with(['pelatihan', 'sesi', 'user.profil'])
                    ->whereHas('user.profil', function ($query) {
                        $query->where('role', 'Kandidat');
                    })
                    ->get();

        $tahun = $request->input('tahun');
        $anggaran = $request->input('anggaran');
        $kategori = $request->input('kategori');
        $pelatihan = $request->input('pelatihan');
        $angkatan = $request->input('angkatan');

        if ($tahun) {
            $kandidat = $kandidat->filter(function ($hasil) use ($tahun) {
                return $hasil->pelatihan->jpl->tahun == $tahun;
            });
        }
        if ($anggaran) {
            $kandidat = $kandidat->filter(function ($hasil) use ($anggaran) {
                return $hasil->pelatihan->jpl->anggaran == $anggaran;
            });
        }
        if ($kategori) {
            $kandidat = $kandidat->filter(function ($hasil) use ($kategori) {
                return $hasil->pelatihan->kategori->nama == $kategori;
            });
        }
        if ($pelatihan) {
            $kandidat = $kandidat->filter(function ($hasil) use ($pelatihan) {
                return $hasil->pelatihan->judul == $pelatihan;
            });
        }
        if ($angkatan) {
            $kandidat = $kandidat->filter(function ($hasil) use ($angkatan) {
                return $hasil->sesi->angkatan == $angkatan;
            });
        }
        $total_siswa = $kandidat->count();

        $count_lk = $kandidat->where('user.profil.jenis_kelamin', 'L')->count();
        $count_pr = $kandidat->where('user.profil.jenis_kelamin', 'P')->count();

        $avg_umur = round($kandidat->avg(function ($user) {
                        return optional($user->user->profil)->tanggal_lahir
                            ? Carbon::parse($user->user->profil->tanggal_lahir)->age
                            : null;
                    }), 2);

        // TO DO
        // count masing-masing laki & perempuan per tahun
        // count jumlah siswa kompeten & tidak kompeten
        // count perbandingan jumlah siswa dengan anggaran APBN, APBD, dll
        // chart pendidikan tertinggi siswa

        return response()->json([
            'response_code' => 200,
            'message' => 'success',
            'data' => [
                'non_chart' => [
                    'total_siswa' => $total_siswa,
                    'count_laki' => $count_lk,
                    'count_perempuan' => $count_pr,
                    'avg_umur' => $avg_umur,
                ],
                'chart' => [
                    'umur' => $this->getDataUmur($request),
                    'kompetensi' => $this->getDataKompetensi($request),
                    'anggaran' => $this->getDataAnggaran($request),
                    'pendidikan' => $this->getDataPendidikan($request),
                ]
            ]
        ]);
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
