<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator; // Menggunakan Validator untuk melakukan validasi data.
use RealRashid\SweetAlert\Facades\Alert; // Menggunakan SweetAlert untuk menampilkan alert.

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data dari tabel mahasiswa.
        $data = mahasiswa::all();

        // Mengembalikan view 'pages.mahasiswa.index' dengan data mahasiswa.
        return view('pages.mahasiswa.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Melakukan validasi terhadap data yang diterima dari formulir.
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jurusan' => 'required',
            'email' => 'required || email',
            'ttl' => 'nullable || date',
            'no_telp' => 'nullable || numeric',
            'jk' => 'nullable',
            'alamat' => 'nullable',
            'agama' => 'nullable',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dan tampilkan alert error.
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // Proses menambahkan data baru ke database.
        $data = new mahasiswa([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'ttl' => $request->ttl,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jk,
            'alamat' => $request->alamat,
            'agama' => $request->agama,
        ]);
        $data->save();

        // Menampilkan alert success ketika menambahkan data berhasil.
        Alert::success('Success!', 'Mahasiswa Created Successfully');

        // Kembali ke halaman sebelumnya.
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Melakukan validasi terhadap data yang diterima dari formulir.
        $validator = Validator::make($request->all(), [
            'nama' => 'required',
            'jurusan' => 'required',
            'email' => 'required || email',
            'ttl' => 'nullable || date',
            'no_telp' => 'nullable || numeric',
            'jk' => 'nullable',
            'alamat' => 'nullable',
            'agama' => 'nullable',
        ]);

        // Jika validasi gagal, kembali ke halaman sebelumnya dan tampilkan alert error.
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // Proses update data mahasiswa.
        mahasiswa::find($request->id)->update([
            'nama' => $request->nama,
            'jurusan' => $request->jurusan,
            'email' => $request->email,
            'ttl' => $request->ttl,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jk,
            'alamat' => $request->alamat,
            'agama' => $request->agama
        ]);

        // Menampilkan alert success ketika data berhasil diperbarui.
        Alert::toast('Updated Successfully', 'success');

        // Kembali ke halaman sebelumnya.
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Menghapus data mahasiswa berdasarkan ID.
        mahasiswa::find($id)->delete();

        // Menampilkan alert success ketika data berhasil dihapus.
        alert()->success('Success!', 'Deleted Successfully');

        // Kembali ke halaman daftar mahasiswa.
        return redirect()->route('mahasiswa.index');
    }
}