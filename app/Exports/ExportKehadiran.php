<?php

namespace App\Exports;

use App\Models\Absensi;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ExportKehadiran implements FromCollection, WithHeadings, WithMapping
{
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $data = Absensi::with(['siswa', 'mapel'])->get();
        return $data;
    }

    public function headings(): array
    {
        return [
            'Nama Siswa',
            'Nama Mapel',
            'Tanggal',
            'Status',
        ];
    }

    public function map($absensi): array
    {
        return [
            $absensi->siswa->nama ?? '-',
            $absensi->mapel->nama_mapel ?? '-',
            $absensi->tanggal,
            $absensi->status,
        ];
    }
}
