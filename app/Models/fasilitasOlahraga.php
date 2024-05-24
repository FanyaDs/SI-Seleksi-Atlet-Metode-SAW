<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class fasilitasOlahraga extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_fasilitas',
        'lokasi',
        'kapasitas',
    ];
}
