<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class subKriteria extends Model
{
    use HasFactory;
    protected $fillable = [
        'kriteria_id',
        'nama_sub',
        'bobot_sub',
    ];

    public function kriterias()
    {
        return $this->belongsTo(kriteria::class, 'kriteria_id');
    }
}
