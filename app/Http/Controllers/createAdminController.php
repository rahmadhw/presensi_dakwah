<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Spatie\Permission\Models\Role;
use Illuminate\Support\Facades\Hash;

class createAdminController extends Controller
{
    public function index()
    {
        $user = User::role('admin')->get();
        return view('admin.createTU.index', ['user' => $user]);
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

        $dataadmin = User::create($data);

        $admin = Role::where('name' , '=', 'admin')->first();

        $dataadmin->assignRole($admin);

        return redirect()->route('admin.createAdmin.index')->with('success', 'Data admin berhasil Dibuat!');
    }

    public function edit(user $user)
    {
        return view('admin.createTU.edit', ['user' => $user]);
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

        return redirect()->route('admin.createAdmin.index')->with('success', 'Data Account TU berhasil diedit!');
    }

    public function hapus(user $user)
    {
        $user->delete();
        return response()->json(['success' => true, 'message' => 'Data berhasil dihapus.']);
    }
}
