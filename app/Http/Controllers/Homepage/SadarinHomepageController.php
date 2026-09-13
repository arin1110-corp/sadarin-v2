<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class SadarinHomepageController extends Controller
{
    /**
     * Menampilkan halaman login SADARIN.
     */
    public function showLogin()
    {
        return view('LoginPage.index');
    }

    /**
     * Login pegawai.
     *
     * Untuk sementara hanya placeholder.
     * Proses validasi SAMPERIN + OTP akan dibuat
     * pada tahap authentication berikutnya.
     */
    public function loginInternal(Request $request)
    {
        return back()->with('error', 'Proses login pegawai belum tersedia.');
    }

    /**
     * Login publik.
     *
     * Untuk sementara hanya placeholder.
     * Proses email + OTP + guestbook akan dibuat
     * pada tahap authentication berikutnya.
     */
    public function loginPublic(Request $request)
    {
        return back()->with('error', 'Proses login publik belum tersedia.');
    }

    /**
     * Logout SADARIN.
     *
     * Akan kita lengkapi setelah session authentication
     * selesai dibuat.
     */
    public function logout(Request $request)
    {
        return redirect()->route('sadarin.login')->with('success', 'Anda telah keluar dari SADARIN.');
    }
}