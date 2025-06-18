<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class createOrangTuaController extends Controller
{
    public function index()
    {
        $user = User::role('orang_tua')->get();
        return view('admin.createOrangTua.index', ['user' => $user]);
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'password' => 'required'
        ]);


        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'password' => hash::make($request->password)
        ];

        $dataOrangTua = User::create($data);

        $roleorangtua = Role::where('name' , '=', 'orang_tua')->first();

        $dataOrangTua->assignRole($roleorangtua);

        return redirect()->route('admin.createOrangTua.index')->with('success', 'Data Orang Tua berhasil Dibuat!');
    }


     public function edit(user $user)
    {
        return view('admin.createOrangTua.edit', ['user' => $user]);
    }

    public function update(user $user, Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' =>'required',
        ]);


        $data = [
            "name" => $request->name,
            "email" => $request->email,
        ];


        $user->update($data);

        return redirect()->route('admin.createOrangTua.index')->with('success', 'Data Account Orang Tua berhasil diedit!');
    }

    public function hapus(user $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
