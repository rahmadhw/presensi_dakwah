<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\tahunAjaran;


class tahunAjaranController extends Controller
{
    public function index()
    {
        $data = tahunAjaran::all();
        return view('admin.tahunAjaran.index', ['tahun_ajaran' => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required'
        ]);


        $data = [
            "tahun_ajaran" => $request->tahun_ajaran
        ];


        tahunAjaran::create($data);

        return redirect()->route('admin.tahunAjaran.index')->with('success', 'Data tahun ajaran berhasil ditambahkan!');

    } 

    public function edit(tahunAjaran $tahunAjaran)
    {
        return view('admin.tahunAjaran.edit', ["tahunAjaran" => $tahunAjaran]);
    }

    public function update(tahunAjaran $tahunAjaran, Request $request)
    {
        $request->validate([
            'tahun_ajaran' => 'required'
        ]);


        $data = [
            "tahun_ajaran" => $request->tahun_ajaran
        ];

        $tahunAjaran->update($data);

         return redirect()->route('admin.tahunAjaran.index')->with('success', 'Data tahun ajaran berhasil diubah!');
    }


    public function hapus(tahunAjaran $tahunAjaran)
    {
        $hapus =$tahunAjaran::findOrFail($tahunAjaran->id);
        $hapus->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
