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
    // Menampilkan halaman login
    public function index()
    {
        return view('auth.login');
    }

    // Menangani permintaan login
    public function login(Request $request)
    {
        // Validasi data permintaan
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        // Jika validasi gagal, kembali ke halaman login dengan pesan error
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // Mengambil data user berdasarkan username
        $data = User::where('username', $request->username)->first();

        if ($data) {
            // Memeriksa apakah password yang diberikan sesuai dengan password yang tersimpan (hash)
            if (Hash::check($request->password, $data->password)) {
                Log::info('Password benar');
                // Regenerasi session ID untuk mencegah serangan session fixation
                $request->session()->regenerate();
                // Menyimpan informasi user dalam session
                $request->session()->put('user', [
                    'username' => $data->username,
                    'role' => $data->role,
                ]);
                // Mengarahkan ke dashboard
                return redirect(route('dashboard'));
            } else {
                // Mencatat percobaan password yang salah dan menampilkan pesan error
                Log::info('Password salah');
                Alert::toast('Password Anda Salah', 'error');
                return back();
            }
        } else {
            // Mencatat percobaan username yang tidak ditemukan dan menampilkan pesan error
            Log::info('Username tidak ditemukan');
            Alert::toast('Username Tidak Ditemukan', 'error');
            return back();
        }
    }

    // Menangani permintaan registrasi
    public function register(Request $request)
    {
        // Validasi data permintaan
        $validator = Validator::make($request->all(), [
            'username' => 'required',
            'password' => 'required',
        ]);

        // Jika validasi gagal, kembali ke halaman registrasi dengan pesan error
        if ($validator->fails()) {
            $msg = $validator->messages()->all();
            Alert::toast($msg, 'error');
            return back();
        }

        // Membuat instance user baru dan menyimpannya ke database
        $user = new User([
            'username' => $request->username,
            'password' => Hash::make($request->password),
            'role' => 'Admin'
        ]);
        $user->save();

        // Menampilkan pesan sukses setelah registrasi berhasil
        Alert::success('Success!', 'Register Successfully');

        // Mengarahkan ke halaman login
        return redirect()->route('auth.index');
    }

    // Menangani permintaan logout
    public function logout()
    {
        // Menginvaliasi session yang sedang berjalan
        session()->invalidate();
        // Mengarahkan ke halaman utama
        return redirect('/');
    }
}