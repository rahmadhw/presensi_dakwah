<?php

namespace App\Http\Controllers;

use App\Charts\adminDashboardChart;
use App\Models\Absensi;
use App\Models\Siswa;
use App\Models\Kelas;
use Illuminate\Http\Request;

class adminController extends Controller
{
    public function index() {

        // $data = kelas::selectRaw('siswa_id, status, COUNT(*) as total')
        //     ->groupBy('siswa_id', 'status')
        //     ->get()
        //     ->groupBy('siswa_id');

        // $labels = [];
        // $totals = [];

        // foreach ($data as $item) {
        //     foreach ($item as $items) {
        //         $siswa = Siswa::find($items->siswa_id);
        //         $labels[] = $siswa ? $siswa->nama : 'Unknown';
        //         $totals[] = $items->total;
        //     }
        // }

        // $chart = new adminDashboardChart;
        // $chart->labels($labels);
        // $chart->dataset('Total Absensi per Siswa', 'bar', $totals)
        //     ->backgroundColor('#4ade80');


        // Ambil total absensi per status
    $absensiStats = Absensi::select('status', \DB::raw('count(*) as total'))
        ->groupBy('status')
        ->get();

    // Siapkan data untuk chart
    $labels = $absensiStats->pluck('status');
    $data = $absensiStats->pluck('total');

        return view('admin.dashboard', compact('labels', 'data'));
    }
}
