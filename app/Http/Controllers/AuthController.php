<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use RealRashid\SweetAlert\Facades\Alert;

class AuthController extends Controller
{
    public function index()
    {
        return view('auth.login');
    }

    public function login(Request $request)
    {
        //validasi request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman login dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        $data = User::where('username', $request->username)->first();

        if ($data) {
            if (Hash::check($request->password, $data->password)) {
                Log::info('Password is correct');
                $request->session()->regenerate();
                $request->session()->put('user', [
                    'username' => $data->username,
                    'role' => $data->role,
                ]);
                return redirect(route('dashboard'));
            } else {
                Log::info('Password is incorrect');
                Alert::toast('Password Anda Salah', 'error');
                return back();
            }
        } else {
            Log::info('Username not found');
            Alert::toast('Username Tidak Ditemukan', 'error');
            return back();
        }
    }

    public function register(Request $request)
    {
        // validasi $request
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);
        // jika validasi terdapat bernilai false maka dikembalikan ke halaman user dan menampilkan alert toast
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }
        // proses menambahkan data baru ke database
        $user = new User([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'Admin'
        ]);
        $user->save();
        // alert succes ketika menambahkan data berhasil
        Alert::success('Success!', 'Register Successfully');
        // kembali ke halaman user
        return redirect()->route('auth.index');
    }

    public function logout()
    {
        session()->invalidate();
        return redirect('/');
    }
}
