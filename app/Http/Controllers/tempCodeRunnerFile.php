<?php
$penilaian = penilaianAtlet::all();
        $kriteria = kriteria::all();
        $subKriteria = subKriteria::all();
        $mahasiswa = mahasiswa::whereHas('penilaianAtlets')->get();
        $getAllMahasiswa = mahasiswa::All();
        $dataSAW = [];
        $dataBaru = [];
        foreach ($penilaian as $nilais) {
            foreach ($kriteria as $kriterias) {
                if ($nilais) {
                    foreach ($nilais->normalisasi($kriterias->id) as $dt) {
                        $dataSAW[] = $dt;
                    }
                }
            }
        }