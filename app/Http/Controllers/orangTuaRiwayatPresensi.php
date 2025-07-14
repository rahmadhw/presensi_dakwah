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
        $kelas = Kelas::all();
        $selectedKelas = $request->kelas_id;
        $tanggal = $request->tanggal ?? now()->toDateString();
        $data = [];

        if ($selectedKelas) {
            $data = Absensi::with(['siswa', 'mapel'])
                ->where('kelas_id', $selectedKelas)
                ->where('tanggal', $tanggal)
                ->orderBy('siswa_id')
                ->orderBy('mapel_id')
                ->get();
        }

        $data = collect($data);

        return view('orang_tua.riwayat_presensi.index', compact('kelas', 'selectedKelas', 'tanggal', 'data'));
    }


    public function Riwayat(Request $request)
    {
        

    }
}
