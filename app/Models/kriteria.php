<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class kriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'nama_kriteria',
        'bobot_kriteria',
        'kategori',
    ];

    public function subKriterias()
    {
        return $this->hasMany(subKriteria::class);
    }

    public function penilaianAtlets()
    {
        return $this->hasMany(penilaianAtlet::class);
    }
}
