<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\subKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class KriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = kriteria::all();

        return view('pages.kriteria.index', ['data' => $data]);
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
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'kategori' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman kriteria dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses menambahkan data baru ke database
        $data = new kriteria([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot_kriteria' => $request->bobot_kriteria,
            'kategori' => $request->kategori,
        ]);
        $data->save();

        if ($request->sub_kriteria) {
            $jml = count($request->sub_kriteria);
            for ($i = 0; $i < $jml; $i++) {
                $sub_kriteria = new subKriteria([
                    'kriteria_id' => $data->id,
                    'nama_sub' => $request->sub_kriteria[$i],
                    'bobot_sub' => $request->bobot_sub_kriteria[$i],
                ]);
                $sub_kriteria->save();
            }
        }
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Created Successfully');
        // kembali ke halaman kriteria
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
            'nama_kriteria' => 'required',
            'bobot_kriteria' => 'required',
            'kategori' => 'required'
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman kriteria dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses update data
        kriteria::find($request->id)->update([
            'nama_kriteria' => $request->nama_kriteria,
            'bobot_kriteria' => $request->bobot_kriteria,
            'kategori' => $request->kategori
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        kriteria::find($id)->delete();
        alert()->success('Success!', 'Deleted Successfully');
        return redirect()->route('kriteria.index');
    }
}
