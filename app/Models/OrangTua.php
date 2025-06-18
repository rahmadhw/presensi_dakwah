<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    use HasFactory;

     protected $fillable = ['nama', 'no_hp', 'alamat', 'user_id'];

    public function siswa()
    {
        return $this->hasMany(Siswa::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
