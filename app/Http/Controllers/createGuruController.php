<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class createGuruController extends Controller
{
    public function index()
    {
        $user = User::role('guru')->get();
        return view('admin.createGuru.index', ['user' => $user]);
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

        $dataGuru = User::create($data);

        $roleguru = Role::where('name' , '=', 'guru')->first();

        $dataGuru->assignRole($roleguru);

        return redirect()->route('admin.createGuru.index')->with('success', 'Data Guru berhasil Dibuat!');
    }


    public function edit(user $user)
    {
        return view('admin.createGuru.edit', ['user' => $user]);
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

        return redirect()->route('admin.createGuru.index')->with('success', 'Data Account Guru berhasil diedit!');
    }

    public function hapus(user $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
