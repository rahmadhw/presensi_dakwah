<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subKelas extends Model
{
    use HasFactory;
    protected $fillable = ['nama', 'kelas_id'];
}
