<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama',
        'jurusan',
        'no_telp',
        'email',
        'jenis_kelamin',
        'ttl',
        'alamat',
        'agama',
    ];

    public function pendaftarans()
    {
        return $this->hasMany(pendaftaran::class);
    }

    public function penilaianAtlets()
    {
        return $this->hasMany(penilaianAtlet::class);
    }
    public function perankingans()
    {
        return $this->hasMany(perankingan::class);
    }
}
