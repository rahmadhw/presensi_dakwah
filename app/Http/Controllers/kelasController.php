<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\mataPelajaran;
use App\Models\subKelas;
use App\Models\tahunAjaran;

class kelasController extends Controller
{
    public function index() 
    {
        $data = Kelas::all();
        $tahunAjaran = tahunAjaran::all();
        return view('admin.kelas.index', 
        [
            "kelas" => $data,
            'tahunAjaran' => $tahunAjaran
        ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
            'tahun_ajaran_id' => 'required'
        ]);


        $data = [
            "nama_kelas" => $request->nama_kelas,
            "tahun_ajaran_id" => $request->tahun_ajaran_id,
        ];


        $kelas = Kelas::create($data);


        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil ditambahkan!');
    }

    public function edit(kelas $kelas)
    {
        return view('admin.kelas.edit', ['kelas' => $kelas]);
    }

    public function detail(kelas $kelas)
    {
        $data = subKelas::where('kelas_id', '=', $kelas->id)->get();
        return view('admin.kelas.detail', ['kelas' => $data]);
    }


    public function update(kelas $kelas, Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required',
        ]);


        $data = [
            "nama_kelas" => $request->nama_kelas,
        ];


        $kelas->update($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data kelas berhasil diubah!');
    }

    public function hapus(kelas $kelas)
    {
        $kelas->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
