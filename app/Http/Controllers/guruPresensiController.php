<?php

namespace App\Http\Controllers;

use App\Helpers\TelegramHelper;
use Illuminate\Http\Request;
use App\Models\Kelas;
use App\Models\mataPelajaran;
use App\Models\Siswa;
use App\Models\guru;
use App\Models\Absensi;
use App\Models\OrangTua;
use App\Models\tahunAjaran;
use App\Models\guruMatkulKelas;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;

class guruPresensiController extends Controller
{
    public function index(Request $request)
    {

        $tahun = tahunAjaran::where('status', 'aktif')->first();

        if (!$tahun) {
            $error = "Mohon maaf, tahun ajaran belum aktif.";
        } else {
            $error = null;
        }

        $guru = guru::where('user_id', Auth::id())->first();
        $data = guruMatkulKelas::with('guru', 'mapel')->where('guru_id', $guru->id)->get();

        $kelas_id;
        $mapel_id;

        foreach ($data as $key => $value) {
            $kelas_id = $value->kelas_id;
            $mapel_id = $value->mapel_id;
        }

        $siswa = Siswa::all();

        return view('guru.presensi.index', compact('siswa', 'tahun', 'error', 'data', 'kelas_id', 'mapel_id'));
    }


    public function riwayatPresensi(Request $request)
    {
        // $kelas = Kelas::all();

        $guru = guru::where('user_id', Auth::id())->first();
        $data = guruMatkulKelas::with('guru', 'mapel')->where('guru_id', $guru->id)->get();

        $kelas_id;
        $mapel_id;

        foreach ($data as $key => $value) {
            $kelas_id = $value->kelas_id;
            $mapel_id = $value->mapel_id;
        }

        $selectedKelas = $kelas_id;
        $tanggal = $request->tanggal ?? now()->toDateString();
        $data = [];

        if ($selectedKelas) {
            $data = Absensi::with(['siswa', 'mapel'])
                ->where('kelas_id', $selectedKelas)
                ->where('tanggal', $tanggal)
                ->orderBy('siswa_id')
                ->orderBy('mapel_id')
                ->get();
        }

        $data = collect($data);



        return view('guru.presensi.riwayatPresensi', compact('selectedKelas', 'tanggal', 'data'));
    }

    public function Laporan(Request $request)

    {
        $kelas = Kelas::all();
        $mapel = mataPelajaran::all();
        $selectedKelas = $request->kelas_id;
        $selectedMapel = $request->mapel_id;

        $rekap = [];

        $selectedKelas = $request->kelas_id;
        $selectedMapel = $request->mapel_id;

        if ($selectedKelas && $selectedMapel) {
            $startDate = now()->startOfDay();
            $endDate = now()->addDays(6)->endOfDay();

            $siswa = Siswa::where('kelas_id', $selectedKelas)->get();

            foreach ($siswa as $s) {
                $absensi = Absensi::where('siswa_id', $s->id)
                    ->where('mapel_id', $selectedMapel)
                    ->whereBetween('tanggal', [$startDate, $endDate])
                    ->selectRaw('status, COUNT(*) as total')
                    ->groupBy('status')
                    ->pluck('total', 'status');

                $rekap[] = [
                    'nama' => $s->nama,
                    'hadir' => $absensi['hadir'] ?? 0,
                    'izin' => $absensi['izin'] ?? 0,
                    'sakit' => $absensi['sakit'] ?? 0,
                    'alpha' => $absensi['alpha'] ?? 0,
                ];
            }
        }

        return view('guru.presensi.laporan', compact('kelas', 'mapel', 'rekap', 'selectedKelas', 'selectedMapel'));
    }


    public function store(Request $request)
    {
        // dd($request->all());


        $request->validate([
            'kelas_id' => 'required',
            'mapel_id' => 'required',
            'absensi' => 'required|array',
            'catatan' => 'array'
        ]);

        foreach ($request->absensi as $siswa_id => $status) {
            $siswa = Siswa::with('orangTua')->find($siswa_id);
            if ($status === 'izin' && empty($request->catatan[$siswa_id])) {
                return redirect()->back()->withErrors(["catatan.$siswa_id" => 'Catatan wajib diisi untuk izin.'])->withInput();
            }

            Absensi::updateOrCreate(
                [
                    'tanggal' => $request->tanggal,
                    'siswa_id' => $siswa_id,
                    'mapel_id' => $request->mapel_id,
                ],
                [
                    'kelas_id' => $request->kelas_id,
                    'status' => $status,
                    'catatan' => $request->catatan[$siswa_id] ?? null
                ]
            );

            $orangTua = $siswa->orangTua;

            if ($orangTua && $orangTua->telegram_chat_id && $status !== 'hadir') {
                $catatan = $request->catatan[$siswa_id] ?? '-';
                $pesan = "📚 Absensi Hari Ini\n"
                    . "🧑 Nama: {$siswa->nama}\n"
                    . "📆 Tanggal: " . now()->format('d-m-Y') . "\n"
                    . "📖 Mapel ID: {$request->mapel_id}\n"
                    . "❗ Status: " . ucfirst($status) . "\n"
                    . "📝 Catatan: {$catatan}";

                TelegramHelper::sendMessage($orangTua->telegram_chat_id, $pesan);
            }
        }

        return redirect()->route('guru.presensi.index')->with('success', 'Absensi berhasil!');
    }
}
