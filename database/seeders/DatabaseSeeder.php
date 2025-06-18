<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use App\Models\Kelas;

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


        $data = [

            ['nama_kelas' => '7A'],
            ['nama_kelas' => '7B'],
            ['nama_kelas' => '7C'],
            ['nama_kelas' => '8A'],
            ['nama_kelas' => '8B'],
            ['nama_kelas' => '8C'],
            ['nama_kelas' => '9A'],
            ['nama_kelas' => '9B'],
            ['nama_kelas' => '9C']

        ];


        Kelas::insert($data);
    }
}
