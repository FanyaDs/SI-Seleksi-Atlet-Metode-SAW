<?php

namespace App\Http\Controllers;

use App\Models\kriteria;
use App\Models\subKriteria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class SubKriteriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $kriteria = kriteria::all();
        $subKriteria = subKriteria::all();
        $data = [
            'kriteria' => $kriteria,
            'subKriteria' => $subKriteria
        ];
        return view('pages.subKriteria.index', $data);
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
            'kriteria' => 'required',
            'nama_sub' => 'required',
            'bobot_sub' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman kriteria dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // proses menambahkan data baru ke database
        $data = new subKriteria([
            'kriteria_id' => $request->kriteria,
            'bobot_sub' => $request->bobot_sub,
            'nama_sub' => $request->nama_sub,
        ]);
        $data->save();

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
            'kriteria' => 'required',
            'nama_sub' => 'required',
            'bobot_sub' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman kriteria dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        subKriteria::find($request->id)->update([
            'kriteria_id' => $request->kriteria,
            'nama_sub' => $request->nama_sub,
            'bobot_sub' => $request->bobot_sub,
        ]);

        Alert::toast('Updated Successfully', 'success');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        subKriteria::find($id)->delete();
        Alert::toast('Delete Successfully', 'success');
        return redirect()->back();
    }
}
