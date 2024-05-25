<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class mahasiswa extends Model
{
    use HasFactory;

    // Mendefinisikan kolom-kolom yang dapat diisi secara massal
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

    // Mendefinisikan relasi antara model Mahasiswa dan Pendaftaran
    public function pendaftarans()
    {
        return $this->hasMany(pendaftaran::class);
    }

    // Mendefinisikan relasi antara model Mahasiswa dan PenilaianAtlet
    public function penilaianAtlets()
    {
        return $this->hasMany(penilaianAtlet::class);
    }

    // Mendefinisikan relasi antara model Mahasiswa dan Perankingan
    public function perankingans()
    {
        return $this->hasMany(perankingan::class);
    }
}