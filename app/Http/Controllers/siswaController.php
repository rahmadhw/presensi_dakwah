<?php

namespace App\Http\Controllers;

use App\Imports\SiswaImport;
use App\Models\Siswa;
use App\Models\Kelas;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use DataTables;

class siswaController extends Controller
{
    public function index()
    {

        $kelas = Kelas::all();
        $orangTua = User::role('orang_tua')->get();
        $data = Siswa::with('kelas')->get();
        return view('admin.siswa.index', ['data' => $data, 'kelas' => $kelas, 'orangTua' => $orangTua]);
    }

    

    public function import(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx,xls,csv',
        ]);

        Excel::import(new SiswaImport, $request->file('file'));

        return back()->with('success', 'Data siswa berhasil diimport!');
    }

    public function edit(siswa $siswa)
    {
       $kelas = Kelas::all();
       return view('admin.siswa.edit', ['data' => $siswa, 'kelas' => $kelas]);
   }

   public function store(Request $request)
   {
     $data = [
        'nama' => $request->nama,
        'nis' => $request->nis,
        'kelas_id' => $request->kelas_id,
        'orang_tua_id' => $request->orang_tua_id
    ];

    Siswa::create($data);
    return back()->with('success', 'Data siswa berhasil ditambahkan');
}

public function update(siswa $siswa, Request $request)
{
    $request->validate([
        'nama' => 'required',
        'nis' =>'required',
        'kelas_id' => 'required'
    ]);


    $data = [
        "nama" => $request->nama,
        "nis" => $request->nis,
        "kelas_id" => $request->kelas_id
    ];


    $siswa->update($data);

    return redirect()->route('admin.siswa.index')->with('success', 'Data siswa berhasil diedit!');
}

public function hapus(siswa $siswa)
{
    $siswa->delete();
    return redirect()->back()->with('success', 'Data berhasil dihapus.');
}
}
