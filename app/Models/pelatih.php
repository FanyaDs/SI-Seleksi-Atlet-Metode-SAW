<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pelatih extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_pelatih',
        'no_telp',
        'jenis_kelamin',
        'spesialis_olahraga',
    ];
}