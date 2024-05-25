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
        // Mengambil semua data penilaian atlet
        $penilaian = penilaianAtlet::all();

        // Mengambil semua data kriteria
        $kriteria = kriteria::all();

        // Mengambil semua data sub kriteria
        $subKriteria = subKriteria::all();

        // Mengambil semua data mahasiswa yang memiliki penilaian atlet
        $mahasiswa = mahasiswa::whereHas('penilaianAtlets')->get();

        // Mengambil semua data mahasiswa
        $getAllMahasiswa = mahasiswa::all();

        // Inisialisasi array untuk menyimpan hasil SAW
        $dataSAW = [];

        // Inisialisasi array untuk menyimpan data mahasiswa baru beserta hasil SAW
        $dataBaru = [];

        // Menghitung nilai SAW untuk setiap kriteria
        foreach ($penilaian as $nilais) {
            foreach ($kriteria as $kriterias) {
                if ($nilais) {
                    foreach ($nilais->normalisasi($kriterias->id) as $dt) {
                        $dataSAW[] = $dt;
                    }
                }
            }
        }

        // Jika terdapat data SAW
        if ($dataSAW) {
            foreach ($mahasiswa as $mhs) {
                $akhir = 0;

                // Menghitung nilai akhir SAW untuk setiap mahasiswa
                foreach ($dataSAW as $key) {
                    if ($key['mahasiswa_id'] == $mhs->id) {
                        $found = false;
                        $akhir += $key['hasil_saw'];

                        // Mencari dan memperbarui nilai SAW yang sudah ada dalam array $dataBaru
                        foreach ($dataBaru as &$item) {
                            if ($item['mahasiswa_id'] == $key['mahasiswa_id']) {
                                $found = true;
                                $item['hasil_saw'] = $akhir;
                                break;
                            }
                        }

                        // Jika nilai SAW untuk mahasiswa belum ada, tambahkan ke array $dataBaru
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

                // Mengurutkan data mahasiswa berdasarkan nilai SAW dari yang tertinggi ke terendah
                usort($dataBaru, function ($a, $b) {
                    return $b['hasil_saw'] <=> $a['hasil_saw'];
                });

                // Memberikan peringkat pada setiap mahasiswa berdasarkan nilai SAW
                $ranking = 1;
                foreach ($dataBaru as &$item) {
                    $item['ranking'] = $ranking;
                    $ranking++;
                }

                // Memperbarui atau membuat entri baru pada tabel perankingan untuk setiap mahasiswa
                perankingan::updateOrCreate(
                    ['mahasiswa_id' => $mhs->id],
                    ['nilai_hasil' => $akhir]
                );
            }
        }

        // Data yang akan dikirimkan ke view
        $data = [
            'penilaian' => $penilaian,
            'kriteria' => $kriteria,
            'subKriteria' => $subKriteria,
            'mahasiswa' => $mahasiswa,
            'getAllMahasiswa' => $getAllMahasiswa,
            'ranking' => $dataBaru,
            'dataSAW' => $dataSAW
        ];

        // Mengembalikan view dengan data yang sudah disiapkan
        return view('pages.penilaian.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     */
        public function cetak()
        {
            // Mengumpulkan data dari beberapa model yang dibutuhkan
            $penilaian = penilaianAtlet::all();
            $kriteria = kriteria::all();
            $subKriteria = subKriteria::all();
            $mahasiswa = mahasiswa::whereHas('penilaianAtlets')->get();
            $getAllMahasiswa = mahasiswa::All();

            // Array untuk menyimpan hasil perhitungan SAW
            $dataSAW = [];

            // Array untuk menyimpan data peringkat setiap mahasiswa
            $dataBaru = [];

            // Melintasi setiap nilai dalam $penilaian dan menghitung hasil SAW
            foreach ($penilaian as $nilais) {
                foreach ($kriteria as $kriterias) {
                    if ($nilais) {
                        foreach ($nilais->normalisasi($kriterias->id) as $dt) {
                            $dataSAW[] = $dt;
                        }
                    }
                }
            }

            // Jika terdapat data hasil SAW
            if ($dataSAW) {
                // Melintasi setiap mahasiswa
                foreach ($mahasiswa as $mhs) {
                    $akhir = 0;

                    // Menghitung total hasil SAW untuk setiap mahasiswa
                    foreach ($dataSAW as $key) {
                        if ($key['mahasiswa_id'] == $mhs->id) {
                            $found = false;
                            $akhir += $key['hasil_saw'];

                            // Memperbarui hasil SAW jika mahasiswa sudah ada dalam $dataBaru
                            foreach ($dataBaru as &$item) {
                                if ($item['mahasiswa_id'] == $key['mahasiswa_id']) {
                                    $found = true;
                                    $item['hasil_saw'] = $akhir;
                                    break;
                                }
                            }

                            // Jika mahasiswa belum ada dalam $dataBaru, tambahkan data baru
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

                    // Mengurutkan data berdasarkan hasil SAW
                    usort($dataBaru, function ($a, $b) {
                        return $b['hasil_saw'] <=> $a['hasil_saw'];
                    });

                    // Memberikan peringkat pada setiap mahasiswa
                    $ranking = 1;
                    foreach ($dataBaru as &$item) {
                        $item['ranking'] = $ranking;
                        $ranking++;
                    }

                    // Memperbarui atau membuat data peringkat pada model perankingan
                    perankingan::updateOrCreate(
                        ['mahasiswa_id' => $mhs->id],
                        ['nilai_hasil' => $akhir]
            );
        }
    }

        // Menyiapkan data untuk ditampilkan dalam PDF
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

        // Memuat halaman cetak dengan menggunakan pustaka Pdf
        $pdf = Pdf::loadView('pages.penilaian.print', $data);

        // Mengunduh PDF dengan nama file 'penilaian.pdf'
        return $pdf->download('penilaian.pdf');

    }   

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Mengambil semua data kriteria dari database
    $kriteria = kriteria::all();
    
    // Melakukan iterasi untuk setiap kriteria
    foreach ($kriteria as $kriterias) {
        
        // Jika kriteria memiliki subkriteria
        if ($kriterias->subKriterias->count() > 0) {
            $nilai = 0; // Inisialisasi variabel nilai
            
            // Iterasi untuk setiap subkriteria dari kriteria
            foreach ($kriterias->subKriterias as $subKriterias) {
                // Menghitung nilai berdasarkan bobot subkriteria dan nilai yang diberikan
                $nilai += ($subKriterias->bobot_sub / 100) * $request->sub_kriteria[$subKriterias->id];
            }
            
            // Membuat objek baru dari model penilaianAtlet dengan data yang sudah dihitung
            $penilaian = new penilaianAtlet([
                'mahasiswa_id' => $request->mahasiswa,
                'kriteria_id' => $kriterias->id,
                'nilai' => $nilai
            ]);
            // Menyimpan data penilaian ke database
            $penilaian->save();
        } else {
            // Jika kriteria tidak memiliki subkriteria
            // Membuat objek baru dari model penilaianAtlet dengan data yang diterima dari request
            $penilaian = new penilaianAtlet([
                'mahasiswa_id' => $request->mahasiswa,
                'kriteria_id' => $kriterias->id,
                'nilai' => $request->data[str_replace(' ', '_', $kriterias->nama_kriteria)]
            ]);
            // Menyimpan data penilaian ke database
            $penilaian->save();
        }
    }

    // Menampilkan alert sukses ketika data berhasil ditambahkan
    Alert::success('Success!', 'Created Successfully');
    
    // Mengembalikan respon redirect ke halaman sebelumnya
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