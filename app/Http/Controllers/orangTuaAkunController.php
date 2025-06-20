<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class orangTuaAkunController extends Controller
{
    public function index()
    {
        return view('orang_tua.dashboard');
    }
}
