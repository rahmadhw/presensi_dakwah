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
}
