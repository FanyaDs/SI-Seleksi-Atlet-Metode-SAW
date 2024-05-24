<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\mahasiswa;
use App\Models\penilaianAtlet;
use App\Models\perankingan;
use App\Models\subKriteria;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;
use Barryvdh\DomPDF\Facade\Pdf;

class PenilaianController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
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

        if ($dataSAW) {
            foreach ($mahasiswa as $mhs) {
                $akhir = 0;

                foreach ($dataSAW as $key) {
                    if ($key['mahasiswa_id'] == $mhs->id) {
                        $found = false;
                        $akhir += $key['hasil_saw'];

                        foreach ($dataBaru as &$item) {
                            if ($item['mahasiswa_id'] == $key['mahasiswa_id']) {
                                $found = true;
                                $item['hasil_saw'] = $akhir;
                                break;
                            }
                        }

                        if (!$found) {
                            $dataBaru[] = [
                                'mahasiswa_id' => $key['mahasiswa_id'],
                                'nama' => $key['nama'],
                                'bobot_kriteria' => $key['bobot_kriteria'],
                                'hasil_normalisasi' => $key['hasil_normalisasi'],
                                'hasil_saw' => $akhir
                            ];
                        }
                    }
                }

                usort($dataBaru, function ($a, $b) {
                    return $b['hasil_saw'] <=> $a['hasil_saw'];
                });

                $ranking = 1;
                foreach ($dataBaru as &$item) {
                    $item['ranking'] = $ranking;
                    $ranking++;
                }
                // $topThree = array_slice($dataBaru, 0, $lowker->batas_diterima);
                perankingan::updateOrCreate(
                    ['mahasiswa_id' => $mhs->id],
                    ['nilai_hasil' => $akhir]
                );
            }
        }

        $data = [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'subKriteria' => $subKriteria,
            'mahasiswa' => $mahasiswa,
            'getAllMahasiswa' => $getAllMahasiswa,
            'ranking' => $dataBaru,
            'dataSAW' => $dataSAW
        ];

        return view('pages.penilaian.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function cetak()
    {
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

        if ($dataSAW) {
            foreach ($mahasiswa as $mhs) {
                $akhir = 0;

                foreach ($dataSAW as $key) {
                    if ($key['mahasiswa_id'] == $mhs->id) {
                        $found = false;
                        $akhir += $key['hasil_saw'];

                        foreach ($dataBaru as &$item) {
                            if ($item['mahasiswa_id'] == $key['mahasiswa_id']) {
                                $found = true;
                                $item['hasil_saw'] = $akhir;
                                break;
                            }
                        }

                        if (!$found) {
                            $dataBaru[] = [
                                'mahasiswa_id' => $key['mahasiswa_id'],
                                'nama' => $key['nama'],
                                'bobot_kriteria' => $key['bobot_kriteria'],
                                'hasil_normalisasi' => $key['hasil_normalisasi'],
                                'hasil_saw' => $akhir
                            ];
                        }
                    }
                }

                usort($dataBaru, function ($a, $b) {
                    return $b['hasil_saw'] <=> $a['hasil_saw'];
                });

                $ranking = 1;
                foreach ($dataBaru as &$item) {
                    $item['ranking'] = $ranking;
                    $ranking++;
                }
                // $topThree = array_slice($dataBaru, 0, $lowker->batas_diterima);
                perankingan::updateOrCreate(
                    ['mahasiswa_id' => $mhs->id],
                    ['nilai_hasil' => $akhir]
                );
            }
        }

        $data = [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'subKriteria' => $subKriteria,
            'mahasiswa' => $mahasiswa,
            'getAllMahasiswa' => $getAllMahasiswa,
            'ranking' => $dataBaru,
            'dataSAW' => $dataSAW,
            'date' => date("d-M-Y"),
        ];

        $pdf = Pdf::loadView('pages.penilaian.print', $data);
        return $pdf->download('penilaian.pdf');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $kriteria = kriteria::all();
        foreach ($kriteria as $kriterias) {
            if ($kriterias->subKriterias->count() > 0) {
                $nilai = 0;
                foreach ($kriterias->subKriterias as $subKriterias) {
                    $nilai += ($subKriterias->bobot_sub / 100) * $request->sub_kriteria[$subKriterias->id];
                }
                $penilaian = new penilaianAtlet([
                    'mahasiswa_id' => $request->mahasiswa,
                    'kriteria_id' => $kriterias->id,
                    'nilai' => $nilai
                ]);
                $penilaian->save();
            } else {
                $penilaian = new penilaianAtlet([
                    'mahasiswa_id' => $request->mahasiswa,
                    'kriteria_id' => $kriterias->id,
                    'nilai' => $request->data[str_replace(' ', '_', $kriterias->nama_kriteria)]
                ]);
                $penilaian->save();
            }
        }

        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Created Successfully');
        // kembali ke halaman kriteria
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        penilaianAtlet::where('mahasiswa_id', $id)->delete();
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Created Successfully');
        return redirect()->back();
    }
}
