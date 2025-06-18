<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Absensi extends Model
{
    use HasFactory;

    protected $fillable = ['siswa_id', 'kelas_id', 'mapel_id', 'tanggal', 'status', 'catatan'];


    public function siswa()
    {
        return $this->belongsTo(Siswa::class);
    }

    public function mapel()
    {
        return $this->belongsTo(mataPelajaran::class, 'mapel_id');
    }
}
