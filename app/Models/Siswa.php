<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

     protected $fillable = ['nama', 'nis', 'kelas_id', 'orang_tua_id'];

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }

    public function kelas()
    {
        return $this->belongsTo(kelas::class, 'kelas_id');
    }


}
