<?php

namespace App\Http\Controllers;

use App\Models\pelatih;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class PelatihController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // mengambil semua data dari table user
        $data = pelatih::all();

        return view('pages.pelatih.index', ['data' => $data]);
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
            'no_telp' => 'nullable || numeric',
            'jk' => 'nullable',
            'spesialis_olahraga' => 'nullable'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses menambahkan data baru ke database
        $data = new pelatih([
            'nama_pelatih' => $request->nama,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jk,
            'spesialis_olahraga' => $request->spesialis_olahraga,
        ]);
        $data->save();
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Pelatih Created Successfully');
        // kembali ke halaman pelatih
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
            'no_telp' => 'nullable || numeric',
            'jk' => 'nullable',
            'spesialis_olahraga' => 'nullable'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman Pelatih dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses update data
        pelatih::find($request->id)->update([
            'nama_pelatih' => $request->nama,
            'no_telp' => $request->no_telp,
            'jenis_kelamin' => $request->jk,
            'spesialis_olahraga' => $request->spesialis_olahraga,
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        pelatih::find($id)->delete();
        alert()->success('Success!', 'Deleted Successfully');
        return redirect()->route('pelatih.index');
    }
}
