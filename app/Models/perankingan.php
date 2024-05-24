<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class perankingan extends Model
{
    use HasFactory;
    protected $fillable = [
        'mahasiswa_id',
        'nilai_hasil',
    ];

    public function mahasiswas()
    {
        return $this->belongsTo(mahasiswa::class, 'mahasiswa_id');
    }
}
