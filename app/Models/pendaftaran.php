<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = [
        'mahasiswa_id',
        'tgl_pendaftaran',
        'status',
    ];

    public function mahasiswas()
    {
        return $this->belongsTo(mahasiswa::class, 'mahasiswa_id');
    }
}
