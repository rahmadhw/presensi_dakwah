<?php

namespace App\Http\Controllers;

use App\Models\Absensi;
use App\Models\Kelas;
use App\Models\mataPelajaran;
use App\Models\Siswa;
use App\Models\tahunAjaran;
use App\Models\OrangTua;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class orangTuaRiwayatPresensi extends Controller
{
    public function index(Request $request)
    {

        $orangTua  = OrangTua::where('user_id', Auth::user()->id)->first();
       $data = Absensi::with('siswa')
            ->whereHas('siswa', function ($query) use ($orangTua) {
                $query->where('orang_tua_id', $orangTua->id);
            })
            ->get();


        return view('orang_tua.riwayat_presensi.index', compact('data'));
    }


    public function Riwayat(Request $request)
    {
        

    }
}
