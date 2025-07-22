<?php

namespace App\Http\Controllers;

use App\Models\guruMatkulKelas;
use App\Models\Kelas;
use App\Models\mataPelajaran;
use App\Models\tahunAjaran;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class PengajarGuruController extends Controller
{
    public function index()
    {
        $kelas = Kelas::all();
        $mataPelajaran = mataPelajaran::all();
        $tahunAjaran = tahunAjaran::all();
        $users = User::role('guru')->get();
        $data = DB::table('guru_matkul_kelas as f')
                    ->select(
                        'f.*',
                        'f.kelas_id as a',
                        'f.mapel_id as c',
                        'f.tahun_ajaran_id as e',
                        'k.nama_kelas as nama_kelas',
                        'mp.nama_mapel as nama_mapel',
                        'ta.tahun_ajaran as tahun_ajaran',
                        'ga.name as nama_guru',
                    )
                    ->join('kelas as k', 'f.kelas_id', '=', 'k.id')
                    ->join('mata_pelajarans as mp', 'f.mapel_id', '=', 'mp.id')
                    ->join('tahun_ajarans as ta', 'f.tahun_ajaran_id', '=', 'ta.id')
                    ->join('users as ga', 'f.guru_id', '=', 'ga.id')
                    ->get();

        // dd($data);
        return view('admin.pengajaranGuru.index', ["data" => $data, "kelas" => $kelas, "mataPelajaran" => $mataPelajaran, "tahunAjaran" => $tahunAjaran, "users" => $users]);
    }


    public function store(Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'guru_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);


        $data = [
            'kelas_id'        => $request->kelas_id,
            'mapel_id'        => $request->mapel_id,
            'guru_id'         => $request->guru_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'hari'            => $request->hari,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai
        ];

        guruMatkulKelas::create($data);

         return redirect()->route('admin.pengajaranGuru.index')->with('success', 'Data Pengajaran ditambahkan!');
    }

    public function edit(guruMatkulKelas $guruMatkulKelas)
    {
        $kelas = Kelas::all();
        $mataPelajaran = mataPelajaran::all();
        $tahunAjaran = tahunAjaran::all();
        $guruMatkulKelas->load(['kelas', 'mapel', 'guru', 'tahunAjaran']);
        return view('admin.pengajaranGuru.edit', ['data' => $guruMatkulKelas, "kelas" => $kelas, "mataPelajaran" => $mataPelajaran,  "tahunAjaran" => $tahunAjaran]);
    }

    public function update(guruMatkulKelas $guruMatkulKelas, Request $request)
    {
        $request->validate([
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'guru_id' => 'required',
            'tahun_ajaran_id' => 'required',
            'hari' => 'required',
            'jam_mulai' => 'required',
            'jam_selesai' => 'required'
        ]);


        $data = [
            'kelas_id'        => $request->kelas_id,
            'mapel_id'        => $request->mapel_id,
            'guru_id'         => $request->guru_id,
            'tahun_ajaran_id' => $request->tahun_ajaran_id,
            'hari'            => $request->hari,
            'jam_mulai'       => $request->jam_mulai,
            'jam_selesai'     => $request->jam_selesai
        ];

        $guruMatkulKelas->update($data);
        return redirect()->route('admin.pengajaranGuru.index')->with('success', 'Data Jadwal Pengajaran berhasil diedit!');
    }

    public function hapus(guruMatkulKelas $guruMatkulKelas)
    {
        $guruMatkulKelas->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
