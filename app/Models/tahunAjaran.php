<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tahunAjaran extends Model
{
    use HasFactory;

    protected $fillable = ['tahun_ajaran', 'status'];

    public function subkelas()
    {
        return $this->hasMany(tahunAjaran::class);
    }
}
