<?php

namespace App\Http\Controllers;

use App\Models\fasilitasOlahraga;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class FasilitasController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data fasilitas
        $data = fasilitasOlahraga::all();

        return view('pages.fasilitasOlahraga.index', ['data' => $data]);
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
            'nama_fasilitas' => 'required',
            'lokasi' => 'required',
            'kapasitas' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses menambahkan data baru ke database
        $data = new fasilitasOlahraga([
            'nama_fasilitas' => $request->nama_fasilitas,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
        ]);
        $data->save();
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Created Successfully');
        // kembali ke halaman fasilitas
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
            'nama_fasilitas' => 'required',
            'lokasi' => 'required',
            'kapasitas' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman Fasilitas dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses update data
        fasilitasOlahraga::find($request->id)->update([
            'nama_fasilitas' => $request->nama_fasilitas,
            'lokasi' => $request->lokasi,
            'kapasitas' => $request->kapasitas,
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        fasilitasOlahraga::find($id)->delete();
        alert()->success('Success!', 'Deleted Successfully');
        return redirect()->route('fasilitas.index');
    }
}
