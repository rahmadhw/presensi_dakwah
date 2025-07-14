<?php

namespace App\Http\Controllers;

use App\Models\guru as ModelsGuru;
use App\Models\mataPelajaran;
use App\Models\Kelas;
use App\Models\subKelas;
use App\Models\User;
use App\Models\tahunAjaran;
use Illuminate\Http\Request;

class guru extends Controller
{
    public function index()
    {
        $data = mataPelajaran::all();
        $guru = ModelsGuru::all();
        $tahunAjaran = tahunAjaran::all();
        return view('admin.guru.index', 
            [
                "data" => $data,   
                "guru" => $guru,
                "tahunAjaran" => $tahunAjaran
            ]
        );
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required',
        ]);


        $data = [
            "name" => $request->name,
            "email" => $request->email,
        ];


        ModelsGuru::create($data);

        return redirect()->route('admin.guru.index')->with('success', 'Data Guru berhasil ditambahkan!');
    }

    public function edit(ModelsGuru $ModelsGuru)
    {
        $user = User::role('guru')->get();
        return view('admin.guru.edit', ['data' => $ModelsGuru, 'user' => $user]);
    }


    public function update(ModelsGuru $ModelsGuru, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required',
        ]);


        $data = [
            "user_id" => $request->user_id,
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
