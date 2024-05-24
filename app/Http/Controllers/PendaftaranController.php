<?php

namespace App\Http\Controllers;

use App\Models\mahasiswa;
use App\Models\pendaftaran;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PendaftaranController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data dari table user
        $pendaftaran = pendaftaran::all();
        $mahasiswa = mahasiswa::all();

        // menampung data pendaftaran dan mahasiswa lalu dikirimkan ke view untuk di tampilkan
        $data = [
            'pendaftaran' => $pendaftaran,
            'mahasiswa' => $mahasiswa
        ];

        return view('pages.pendaftaran.index', $data);
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
            'mahasiswa' => 'required',
            'tgl_pendaftaran' => 'required|date',
            'status' => 'nullable',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses menambahkan data baru ke database
        $data = new pendaftaran([
            'mahasiswa_id' => $request->mahasiswa,
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'status' => $request->status == '' ? 'Proses' : $request->status,
        ]);
        $data->save();
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'pendaftaran Created Successfully');
        // kembali ke halaman pendaftaran
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
            'tgl_pendaftaran' => 'required|date',
            'status' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman Pelatih dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses update data
        pendaftaran::find($request->id)->update([
            'tgl_pendaftaran' => $request->tgl_pendaftaran,
            'status' => $request->status,
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        pendaftaran::find($id)->delete();
        alert()->success('Success!', 'Deleted Successfully');
        return redirect()->route('pendaftaran.index');
    }
}
