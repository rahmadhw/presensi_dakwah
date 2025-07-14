<?php

namespace App\Http\Controllers;

use App\Exports\ExportKehadiran;
use App\Models\Absensi;
use App\Models\Siswa;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class adminReportPresensi extends Controller
{
    public function index()
    {
        return view('admin.reportPresensi.index');
    }

    public function report(Request $request)
    {
        $rekap = [];

        if ($request->from && $request->to) {
            // Ambil hanya siswa yang memiliki absensi di rentang tanggal
            $absensi = Absensi::whereBetween('tanggal', [$request->from, $request->to])
                ->selectRaw('siswa_id, status, COUNT(*) as total')
                ->groupBy('siswa_id', 'status')
                ->get()
                ->groupBy('siswa_id');

            // Ambil data siswa yang ID-nya muncul dalam absensi
            $siswaIds = $absensi->keys();
            $siswaList = Siswa::whereIn('id', $siswaIds)->get()->keyBy('id');

            foreach ($absensi as $siswaId => $data) {
                $statusCount = $data->pluck('total', 'status');

                $rekap[] = [
                    'nama' => $siswaList[$siswaId]->nama ?? '-',
                    'hadir' => $statusCount['hadir'] ?? 0,
                    'izin' => $statusCount['izin'] ?? 0,
                    'sakit' => $statusCount['sakit'] ?? 0,
                    'alpha' => $statusCount['alpha'] ?? 0,
                ];
            }
        }

        return view('admin.reportPresensi.index', compact('rekap'));
    }

    public function exportExcel()
    {
        return Excel::download(new ExportKehadiran, "laporan_kehadiran.xlsx");
    }
}
