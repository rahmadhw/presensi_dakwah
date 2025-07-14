<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\mataPelajaran;
use App\Models\Siswa;
use App\Models\tahunAjaran;
use Illuminate\Http\Request;

class orangTuaRiwayatPresensi extends Controller
{
    public function index(Request $request)
    {
       $absensi = Absensi::with('siswa')
            ->whereHas('siswa', function ($query) {
                $query->where('orang_tua_id', Auth::user()->id);
            })
            ->get();

        dd($absensi);

        return view('orang_tua.riwayat_presensi.index', compact('kelas', 'selectedKelas', 'tanggal', 'data'));
    }


    public function Riwayat(Request $request)
    {
        

    }
}
