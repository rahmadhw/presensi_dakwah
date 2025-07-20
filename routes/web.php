<?php

use App\Helpers\TelegramHelper;
use App\Http\Controllers\adminController;
use App\Http\Controllers\adminReportPresensi;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\kelasController;
use App\Http\Controllers\tahunAjaranController;
use App\Http\Controllers\mataPelajaranController;
use App\Http\Controllers\guru;
use App\Http\Controllers\orangTuaController;
use App\Http\Controllers\siswaController;
use App\Http\Controllers\createAdminController;
use App\Http\Controllers\createGuruController;
use App\Http\Controllers\createOrangTuaController;
use App\Http\Controllers\guruAkunController;
use App\Http\Controllers\guruPresensiController;
use App\Http\Controllers\orangTuaAkunController;
use App\Http\Controllers\orangTuaRiwayatPresensi;
use App\Http\Controllers\PengajarGuruController;
use App\Http\Controllers\tahunAjaranAktif;
use App\Models\Siswa;
use Illuminate\Support\Facades\Http;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});


Route::get('/test-telegram', function () {
    $chatId = '1218904647';
    $pesan = "✅ Test pesan Telegram berhasil dari Laravel.";

    TelegramHelper::sendMessage($chatId, $pesan);
});


Route::get('/sync-telegram-orangtua', function () {
    $token = config('services.telegram.bot_token');
    $response = Http::get("https://api.telegram.org/bot{$token}/getUpdates");

    $updates = $response->json()['result'];

    foreach ($updates as $update) {
        if (!isset($update['message']['text'])) continue;

        $message = $update['message'];
        $chatId = $message['chat']['id'];
        $text = strtolower($message['text']);

        // Misal pesan: "saya orang tua dari budi"
        preg_match('/orang tua dari (.+)/', $text, $matches);

        if (isset($matches[1])) {
            $namaSiswa = trim($matches[1]);

            $siswa = Siswa::where('nama', 'like', "%{$namaSiswa}%")->first();

            if ($siswa && $siswa->orangTua) {
                $ortu = $siswa->orangTua;
                $ortu->telegram_chat_id = $chatId;
                $ortu->save();
                logger("✅ Chat ID disimpan untuk orang tua siswa: {$siswa->nama}");
            } else {
                logger("⚠️ Tidak ditemukan siswa dengan nama: {$namaSiswa}");
            }
        }
    }

    return '✅ Sinkronisasi chat ID selesai.';
});


Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function() {
    // Route::get('/dashboard', 'dashboard')->name('dashboard');

    Route::controller(adminController::class)->prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(kelasController::class)->prefix('kelas')->name('kelas.')->group(function () {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{kelas}', 'edit')->name('edit');
        Route::get('/detail/{kelas}', 'detail')->name('detail');
        Route::post('/update/{kelas}', 'update')->name('update');
        Route::get('/hapus/{kelas}', 'hapus')->name('hapus');
    });

    Route::controller(tahunAjaranController::class)->prefix('tahun-ajaran')->name('tahunAjaran.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{tahunAjaran}', 'edit')->name('edit');
        Route::post('/update/{tahunAjaran}', 'update')->name('update');
        Route::get('/hapus/{tahunAjaran}', 'hapus')->name('hapus');
    });

    Route::controller(mataPelajaranController::class)->prefix('mata-pelajaran')->name('mataPelajaran.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{mataPelajaran}', 'edit')->name('edit');
        Route::post('/update/{mataPelajaran}', 'update')->name('update');
        Route::get('/hapus/{mataPelajaran}', 'hapus')->name('hapus');
    });

    Route::controller(guru::class)->prefix('guru')->name('guru.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{ModelsGuru}', 'edit')->name('edit');
        Route::post('/update/{ModelsGuru}', 'update')->name('update');
        Route::get('/hapus/{ModelsGuru}', 'hapus')->name('hapus');
    });

    Route::controller(orangTuaController::class)->prefix('orang-tua')->name('orangTua.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{orangTua}', 'edit')->name('edit');
        Route::post('/update/{orangTua}', 'update')->name('update');
        Route::get('/hapus/{orangTua}', 'hapus')->name('hapus');
    });

    Route::controller(siswaController::class)->prefix('siswa')->name('siswa.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/get-data-siswa', 'get-data-siswa')->name('getDataSiswa');
        Route::post('/import', 'import')->name('import');
        Route::get('/edit/{siswa}', 'edit')->name('edit');
        Route::post('/update/{siswa}', 'update')->name('update');
        Route::get('/hapus/{siswa}', 'hapus')->name('hapus');
    });

    Route::controller(createAdminController::class)->prefix('create-admin')->name('createAdmin.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::post('/update/{user}', 'update')->name('update');
        Route::get('/hapus/{user}', 'hapus')->name('hapus');
    });

    Route::controller(createGuruController::class)->prefix('create-guru')->name('createGuru.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::post('/update/{user}', 'update')->name('update');
        Route::get('/hapus/{user}', 'hapus')->name('hapus');
    });

    Route::controller(createOrangTuaController::class)->prefix('create-orang-tua')->name('createOrangTua.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{user}', 'edit')->name('edit');
        Route::post('/update/{user}', 'update')->name('update');
        Route::get('/hapus/{user}', 'hapus')->name('hapus');
    });

    Route::controller(adminReportPresensi::class)->prefix('admin-report-presensi')->name('adminReportPresensi.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/report', 'report')->name('report');
        Route::get('/export-excel', 'exportExcel')->name('exportExcel');
    });

    Route::controller(tahunAjaranAktif::class)->prefix('tahun-ajaran-aktif')->name('tahunAjaranAktif.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/aktif/{tahunAjaran}', 'aktif')->name('aktif');
        Route::get('/nonaktif/{tahunAjaran}', 'nonaktif')->name('nonaktif');
    });

    Route::controller(PengajarGuruController::class)->prefix('jadwal-pengajaran')->name('pengajaranGuru.')->group(function(){
        Route::get('/', 'index')->name('index');
        Route::post('/store', 'store')->name('store');
        Route::get('/edit/{guruMatkulKelas}', 'edit')->name('edit');
        Route::post('/update/{guruMatkulKelas}', 'update')->name('update');
        Route::get('/hapus/{guruMatkulKelas}', 'hapus')->name('hapus');
    });

});




Route::middleware(['auth', 'role:guru'])->prefix('guru')->name('guru.')->group(function() {
    Route::controller(guruAkunController::class)->prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(guruPresensiController::class)->prefix('presensi')->name('presensi.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/jadwal-pengajaran', 'jadwalPengajaran')->name('jadwalPengajaran');
        Route::get('/riwayat-presensi', 'riwayatPresensi')->name('riwayatPresensi');
        Route::get('/laporan', 'laporan')->name('Laporan');
        Route::post('/store', 'store')->name('store');

    });
});


Route::middleware(['auth', 'role:orang_tua'])->prefix('orang-tua')->name('orangTua.')->group(function() {
    Route::controller(orangTuaAkunController::class)->prefix('dashboard')->name('dashboard.')->group(function() {
        Route::get('/', 'index')->name('index');
    });

    Route::controller(orangTuaRiwayatPresensi::class)->prefix('riwayat-presensi')->name('riwayatPresensi.')->group(function() {
        Route::get('/', 'index')->name('index');
        Route::get('/riwayat', 'riwayat')->name('Riwayat');
    });
});



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
