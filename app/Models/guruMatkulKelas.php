<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guruMatkulKelas extends Model
{
    use HasFactory;

    protected $fillable = ['kelas_id', 'mapel_id', 'guru_id', 'tahun_ajaran_id', 'hari', 'jam_mulai', 'jam_selesai'];

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }

    public function mapel()
    {
        return $this->belongsTo(mataPelajaran::class);
    }

    public function guru()
    {
        return $this->belongsTo(guru::class);
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahunAjaran::class);
    }
}
