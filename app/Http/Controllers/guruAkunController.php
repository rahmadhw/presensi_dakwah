<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class guruAkunController extends Controller
{
    public function index()
    {
        return view('guru.dashboard');
    }
}
