<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data dari table user
        $data = mahasiswa::all();

        return view('pages.mahasiswa.index', ['data' => $data]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // validasi $request
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
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses menambahkan data baru ke database
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
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Mahasiswa Created Successfully');
        // kembali ke halaman mahasiswa
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // validasi $request
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
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses update data
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

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        mahasiswa::find($id)->delete();
        alert()->success('Success!', 'Deleted Successfully');
        return redirect()->route('mahasiswa.index');
    }
}
