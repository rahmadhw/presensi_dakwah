<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\mataPelajaran;

class mataPelajaranController extends Controller
{
    public function index()
    {
        $data = mataPelajaran::all();
        return view('admin.mataPelajaran.index', ['mataPelajaran' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required'
        ]);


        $data = [
            "nama_mapel" => $request->nama_mapel,
            'kode_mapel' => $request->kode_mapel
        ];


        mataPelajaran::create($data);

        return redirect()->route('admin.mataPelajaran.index')->with('success', 'Data tahun ajaran berhasil ditambahkan!');
    }

    public function edit(mataPelajaran $mataPelajaran)
    {
        return view('admin.mataPelajaran.edit', ['mataPelajaran' => $mataPelajaran]);
    }


    public function update(mataPelajaran $mataPelajaran, Request $request)
    {
        $request->validate([
            'nama_mapel' => 'required',
            'kode_mapel' => 'required'
        ]);


        $data = [
            "nama_mapel" => $request->nama_mapel,
            'kode_mapel' => $request->kode_mapel
        ];


        $mataPelajaran->update($data);

        return redirect()->route('admin.mataPelajaran.index')->with('success', 'Data tahun ajaran berhasil diubah!');
    }


    public function hapus(mataPelajaran $mataPelajaran)
    {
        $mataPelajaran->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
