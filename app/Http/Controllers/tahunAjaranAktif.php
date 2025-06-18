<?php

namespace App\Http\Controllers;

use App\Models\tahunAjaran;
use Illuminate\Http\Request;

class tahunAjaranAktif extends Controller
{
    public function index()
    {
        $data = tahunAjaran::all();
        return view('admin.tahunAjaranAktif.index', ["data" => $data]);
    }

    public function aktif(tahunAjaran $tahunAjaran)
    {
         $data = [
            "status" => "aktif"
        ];


        $tahunAjaran->update($data);
         return redirect()->route('admin.tahunAjaranAktif.index')->with('success', 'Data berhasil diubah!');
    }

    public function nonaktif(tahunAjaran $tahunAjaran)
    {
         $data = [
            "status" => "nonaktif"
        ];


        $tahunAjaran->update($data);
         return redirect()->route('admin.tahunAjaranAktif.index')->with('success', 'Data berhasil diubah!');
    }
}
