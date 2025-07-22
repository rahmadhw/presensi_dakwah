<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Kelas;
use App\Models\subKelas;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $roleAdmin = Role::create(['name' => 'admin']);
        $role_orang_tua = Role::create(['name' => 'orang_tua']);
        $role_guru = Role::create(['name' => 'guru']);

        $admin = User::create([
            'name' => 'Tata usaha',
            'email' => 'admintu@dakwah.com',
            'password' => Hash::make('1234')
        ]);

        $orangTua = User::create([
            'name' => 'orang tua 1',
            'email' => 'orangtua1@dakwah.com',
            'password' => Hash::make('1234')
        ]);

        $guru = User::create([
            'name' => 'guru 1',
            'email' => 'guru1@dakwah.com',
            'password' => Hash::make('1234')
        ]);

        $admin->assignRole($roleAdmin);
        $orangTua->assignRole($role_orang_tua);
        $guru->assignRole($role_guru);

        



        DB::table('tahun_ajarans')->insert([
            ['id' => 1, 'tahun_ajaran' => '2024/2025', 'status' => 'aktif'],
        ]);

        DB::table('kelas')->insert([
            ['id' => 1, 'nama_kelas' => 'VII A', 'tahun_ajaran_id' => 1],
        ]);


        DB::table('mata_pelajarans')->insert([
            ['id' => 1, 'nama_mapel' => 'Matematika', 'kode_mapel' => 'MTK'],
        ]);


        DB::table('siswas')->insert([
            ['id' => 1, 'nama' => 'Siswa 1', 'nis' => '220001', 'kelas_id' => 1, 'orang_tua_id' => 2],
            ['id' => 2, 'nama' => 'Siswa 2', 'nis' => '220002', 'kelas_id' => 1, 'orang_tua_id' => 2],
        ]);

        DB::table('guru_matkul_kelas')->insert([
            ['id' => 1, 'guru_id' => 3, 'kelas_id' => 1, 'mapel_id' => 1, 'tahun_ajaran_id' => 1],
        ]);


        DB::table('absensis')->insert([
            ['siswa_id' => 1, 'guru_id' => 3, 'mapel_id' => 1, 'kelas_id' => 1, 'tanggal' => now(), 'status' => 'hadir'],
            ['siswa_id' => 2, 'guru_id' => 3, 'mapel_id' => 1, 'kelas_id' => 1, 'tanggal' => now(), 'status' => 'izin'],
        ]);
        
        
    }
}
