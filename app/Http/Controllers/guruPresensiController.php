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
use Illuminate\Support\Facades\DB;

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

        $data = guruMatkulKelas::with('kelas')->where('guru_id', Auth::user()->id)->get();


        foreach ($data as $key => $value) {
            $kelas_id = $value->kelas_id;
            $mapel_id = $value->mapel_id;
        }

        $guruId = Auth::user()->id;
        $kelasId = $kelas_id; // misalnya dari routing
       $now = Carbon::now(); // waktu sekarang
        $hariIni = strtolower($now->translatedFormat('l')); // "senin", "selasa", dst
        $jamSekarang = $now->format('H:i:s');


        $jadwalSekarang = guruMatkulKelas::where('guru_id', $guruId)
        ->where('kelas_id', $kelasId)
        ->where('hari', $hariIni)
        ->where('jam_mulai', '<=', $jamSekarang)
        ->where('jam_selesai', '>=', $jamSekarang)
        ->first();

        $errors = '';
        if (!$jadwalSekarang) {
           $errors = "Mohon maaf tidak ada yang diabsen.";
       }

        // dd($jadwalSekarang);

       $siswa = Siswa::whereHas('kelas', function ($query) use ($guruId) {
        $query->whereHas('mapelGuru', function ($subQuery) use ($guruId) {
            $subQuery->where('guru_id', $guruId);
        });
    })->get();

       return view('guru.presensi.index', compact('siswa', 'tahun', 'error', 'kelas_id', 'mapel_id', 'jadwalSekarang', 'errors'));
   }

   public function jadwalPengajaran()
   {
    $guruId = Auth::user()->id;
    $data = DB::table('guru_matkul_kelas as f')
    ->select(
        'f.*',
        'f.kelas_id as a',
        'f.mapel_id as c',
        'f.tahun_ajaran_id as e',
        'k.nama_kelas as nama_kelas',
        'mp.nama_mapel as nama_mapel',
        'ta.tahun_ajaran as tahun_ajaran',
        'ga.name as nama_guru',
    )
    ->where('f.guru_id', '=', $guruId)
    ->join('kelas as k', 'f.kelas_id', '=', 'k.id')
    ->join('mata_pelajarans as mp', 'f.mapel_id', '=', 'mp.id')
    ->join('tahun_ajarans as ta', 'f.tahun_ajaran_id', '=', 'ta.id')
    ->join('users as ga', 'f.guru_id', '=', 'ga.id')

    ->get();
    return view('guru.presensi.jadwalPengajaran', ["data" => $data]);
}


public function riwayatPresensi(Request $request)
{

   $guruId = Auth::user()->id;
   $data = Absensi::with('kelas', 'mapel', 'siswa')->where('guru_id', $guruId)->get();
   return view('guru.presensi.riwayatPresensi', compact('data'));
}

public function Laporan(Request $request)

{
    // $kelas = Kelas::all();
    // $mapel = mataPelajaran::all();
    // $selectedKelas = $request->kelas_id;
    // $selectedMapel = $request->mapel_id;

    // $rekap = [];

    // $selectedKelas = $request->kelas_id;
    // $selectedMapel = $request->mapel_id;

    // if ($selectedKelas && $selectedMapel) {
    //     $startDate = now()->startOfDay();
    //     $endDate = now()->addDays(6)->endOfDay();

    //     $siswa = Siswa::where('kelas_id', $selectedKelas)->get();

    //     foreach ($siswa as $s) {
    //         $absensi = Absensi::where('siswa_id', $s->id)
    //         ->where('mapel_id', $selectedMapel)
    //         ->whereBetween('tanggal', [$startDate, $endDate])
    //         ->selectRaw('status, COUNT(*) as total')
    //         ->groupBy('status')
    //         ->pluck('total', 'status');

    //         $rekap[] = [
    //             'nama' => $s->nama,
    //             'hadir' => $absensi['hadir'] ?? 0,
    //             'izin' => $absensi['izin'] ?? 0,
    //             'sakit' => $absensi['sakit'] ?? 0,
    //             'alpha' => $absensi['alpha'] ?? 0,
    //         ];
    //     }
    // }


    $bulan = $request->bulan;
    $tanggalAwal = $bulan . '-01';
    $tanggalAkhir = Carbon::parse($tanggalAwal)->endOfMonth()->toDateString();

    // Ambil data absensi dalam bulan tersebut
    $absensi = Absensi::with(['siswa', 'kelas', 'mapel'])
    ->where('guru_id', auth()->id())
    ->whereBetween('tanggal', [$tanggalAwal, $tanggalAkhir])
    ->orderBy('tanggal')
    ->get();


    // Kelompokkan berdasarkan siswa dan hitung status
    $laporan = $absensi->groupBy('siswa_id')->map(function ($item) {
        return [
            'siswa_nama' => $item->first()->siswa->nama ?? '-',
            'kelas' => $item->first()->kelas->nama_kelas ?? '-',
            'mapel' => $item->first()->mapel->nama_mapel ?? '-',
            'hadir' => $item->where('status', 'hadir')->count(),
            'izin' => $item->where('status', 'izin')->count(),
            'sakit' => $item->where('status', 'sakit')->count(),
            'alpha' => $item->where('status', 'alpha')->count(),
        ];
    });





    return view('guru.presensi.laporan', compact('laporan', 'bulan'));
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
        $guruId = Auth::user()->id;
        Absensi::updateOrCreate(
            [
                'tanggal' => $request->tanggal,
                'siswa_id' => $siswa_id,
                'guru_id' => $guruId,
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


public function kelas ()
{
    $data = Kelas::all();
    $tahunAjaran = tahunAjaran::all();
    return view('guru.presensi.kelas', ['kelas' => $data, 'tahunAjaran' => $tahunAjaran]);
}

public function kelasStore(Request $request)
{
    $request->validate([
        'nama_kelas' => 'required',
        'tahun_ajaran_id' => 'required'
    ]);


    $data = [
        "nama_kelas" => $request->nama_kelas,
        "tahun_ajaran_id" => $request->tahun_ajaran_id,
    ];


    $kelas = Kelas::create($data);


    return redirect()->route('guru.presensi.kelas')->with('success', 'Data Kelas berhasil ditambahkan!');
}
}
