<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class penilaianAtlet extends Model
{
    use HasFactory;
    protected $fillable = [
        'mahasiswa_id',
        'kriteria_id',
        'nilai',
    ];
    public function mahasiswas()
    {
        return $this->belongsTo(mahasiswa::class, 'mahasiswa_id');
    }
    public function kriterias()
    {
        return $this->belongsTo(kriteria::class, 'kriteria_id');
    }

    public function normalisasi($id)
    {
        $data = [];
        $kriteria = kriteria::find($id);

        // foreach ($kriteria as $kriterias) {
            if ($this->kriteria_id == $kriteria->id) {
                $max = penilaianAtlet::where('kriteria_id', $this->kriteria_id)
                    ->max('nilai');
                $min = penilaianAtlet::where('kriteria_id', $this->kriteria_id)
                    ->min('nilai');
                if (!$this->nilai == 0.00) {
                    if ($kriteria->kategori == "Benefit") {
                        $hasil_normalisasi = round($this->nilai / $max, 2);
                    } else {
                        $hasil_normalisasi = round($min / $this->nilai, 2);
                    }
                } else {
                    $hasil_normalisasi = 0.00;
                }

                $hasil_saw = $this->kriterias->bobot_kriteria * $hasil_normalisasi;

                $data[] = [
                    'mahasiswa_id' => $this->mahasiswa_id,
                    'nama' => $this->mahasiswas->nama,
                    'nilai_alternatif' => $this->nilai,
                    'kriteria_id' => $this->kriteria_id,
                    'nilai_kategori' => ($kriteria->kategori == "Benefit") ? $max : $min,
                    'bobot_kriteria' => $this->kriterias->bobot_kriteria,
                    'hasil_normalisasi' => $hasil_normalisasi,
                    'hasil_saw' => $hasil_saw
                ];
            }
        // }
        return $data;
    }
}
