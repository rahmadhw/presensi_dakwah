<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kelas extends Model
{
    use HasFactory;

    protected $fillable = ['nama_kelas', 'tahun_ajaran_id'];

    public function mapelGuru()
	{
	    return $this->hasMany(GuruMatkulKelas::class);
	}
}
