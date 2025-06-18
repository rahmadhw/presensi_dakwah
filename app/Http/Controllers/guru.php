<?php

namespace App\Http\Controllers;

use App\Models\guru as ModelsGuru;
use App\Models\mataPelajaran;
use Illuminate\Http\Request;

class guru extends Controller
{
    public function index()
    {
        $data = mataPelajaran::all();
        $guru = ModelsGuru::all();
        return view('admin.guru.index', ["data" => $data, "guru" => $guru]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required',
            'mapel_id' => 'required'
        ]);


        $data = [
            "name" => $request->name,
            "email" => $request->email,
            "mapel_id" => $request->mapel_id
        ];


        ModelsGuru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru berhasil ditambahkan!');
    }

    public function edit(ModelsGuru $ModelsGuru)
    {
        return view('admin.guru.edit', ['data' => $ModelsGuru]);
    }


    public function update(ModelsGuru $ModelsGuru, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required',
        ]);


        $data = [
            "name" => $request->name,
            "email" => $request->email,
        ];


        $ModelsGuru->update($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru berhasil diedit!');
    }

    public function hapus(ModelsGuru $ModelsGuru)
    {
        $ModelsGuru->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
