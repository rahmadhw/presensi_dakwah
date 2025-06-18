<?php

namespace App\Imports;

use App\Models\Siswa;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithStartRow;

class SiswaImport implements ToModel, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */



    public function model(array $row)
    {
        // dd(array_keys($row));
        return new Siswa([
            'nama'          => $row['nama'],
            'nis'           => $row['nis'],
            'kelas_id'      => $row['kelas_id'],
            'orang_tua_id'  => $row['orang_tua_id'],
        ]);

        //  dd($row);
    }
}
