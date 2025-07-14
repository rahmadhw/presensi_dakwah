<?php

namespace App\Http\Controllers;

use App\Models\OrangTua;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Http\Request;

class orangTuaController extends Controller
{
    public function index()
    {
        $data = OrangTua::all();
        return view('admin.orangTua.index', ["data" => $data]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required',
            'no_hp' =>'required',
            'alamat' => 'required'
        ]);


        $data = [
            "nama" => $request->nama,
            "no_hp" => $request->no_hp,
            "alamat" => $request->alamat
        ];


        OrangTua::create($data);

        return redirect()->route('admin.orangTua.index')->with('success', 'Data Orang Tua berhasil ditambahkan!');
    }

    public function edit(orangTua $orangTua)
    {
        $user = User::role('orang_tua')->get();
        return view('admin.orangTua.edit', ['orangTua' => $orangTua, 'user' => $user]);
    }

    public function update(orangTua $orangTua, Request $request)
    {
        $request->validate([
            "nama" => "required",
            "no_hp" => "required",
            "alamat" => "required"
        ]);


        $data = [
            "user_id" => $request->user_id,
            "nama" => $request->nama,
            "no_hp" => $request->no_hp,
            "alamat" => $request->alamat
        ];


        $orangTua->update($data);

        return redirect()->route('admin.orangTua.index')->with('success', 'Data Orang Tua berhasil diubah!');
    }

     public function hapus(orangTua $orangTua)
    {
        $orangTua->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
