<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Kelas;

class kelasController extends Controller
{
    public function index() 
    {
        $data = Kelas::all();
        return view('admin.kelas.index', ["kelas" => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required'
        ]);


        $data = [
            "nama_kelas" => $request->nama_kelas
        ];


        Kelas::create($data);

        return redirect()->route('admin.kelas.index')->with('success', 'Data Kelas berhasil ditambahkan!');
    }

    public function edit(kelas $kelas)
    {
        return view('admin.kelas.edit', ['kelas' => $kelas]);
    }

    public function update(kelas $kelas, Request $request)
    {
        $request->validate([
            'nama_kelas' => 'required'
        ]);


        $data = [
            "nama_kelas" => $request->nama_kelas
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
