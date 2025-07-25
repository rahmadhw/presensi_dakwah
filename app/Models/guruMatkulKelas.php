<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guruMatkulKelas extends Model
{
    use HasFactory;

    protected $fillable = ['kelas_id', 'mapel_id', 'guru_id', 'tahun_ajaran_id', 'hari', 'jam_mulai', 'jam_selesai'];

    // public function kelas()
    // {
    //     return $this->belongsTo(Kelas::class);
    // }

    public function mapel()
    {
        return $this->belongsTo(mataPelajaran::class, 'mapel_id');
    }

    public function guru()
    {
        return $this->belongsTo(User::class, 'id');
    }

    public function tahunAjaran()
    {
        return $this->belongsTo(tahunAjaran::class);
    }


    // public function guruMatkulKelas()
    // {
    //     return $this->hasMany(GuruMatkulKelas::class, 'mapel_id');
    // }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class);
    }
}
