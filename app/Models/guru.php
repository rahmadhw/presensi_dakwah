<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class guru extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'email', 'user_id', 'mapel_id', 'kelas_id', 'tahun_ajaran_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
