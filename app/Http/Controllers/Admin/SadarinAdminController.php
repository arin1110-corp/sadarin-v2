<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinArchive;
use App\Models\SadarinDocumentType;
use App\Models\SadarinKegiatan;
use App\Models\SadarinProgram;
use App\Models\SadarinSubKegiatan;
use App\Models\SadarinTag;
use App\Models\SadarinUnit;
use Illuminate\Support\Facades\DB;

class SadarinAdminController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | DASHBOARD
    |--------------------------------------------------------------------------
    */

    public function index()
    {
        /*
        |--------------------------------------------------------------------------
        | STATISTIK ARSIP
        |--------------------------------------------------------------------------
        */

        $totalArsip = SadarinArchive::count();

        /*
        |--------------------------------------------------------------------------
        | STATUS VERIFIKASI
        |--------------------------------------------------------------------------
        |
        | Sesuaikan nama value status jika di database berbeda.
        |
        */

        $menungguVerifikasi = SadarinArchive::where('archive_status', 'pending')->count();

        $terverifikasi = SadarinArchive::where('archive_status', 'verified')->count();

        $dikembalikan = SadarinArchive::where('archive_status', 'returned')->count();

        /*
        |--------------------------------------------------------------------------
        | PERSENTASE TERVERIFIKASI
        |--------------------------------------------------------------------------
        */

        $persentaseTerverifikasi = $totalArsip > 0 ? round(($terverifikasi / $totalArsip) * 100, 1) : 0;

        /*
        |--------------------------------------------------------------------------
        | ARSIP TERBARU
        |--------------------------------------------------------------------------
        */

        $arsipTerbaru = SadarinArchive::query()->latest('archive_created_at')->limit(5)->get();

        /*
        |--------------------------------------------------------------------------
        | AKTIVITAS TERBARU
        |--------------------------------------------------------------------------
        |
        | Untuk sementara mengambil access log.
        |
        */

        $aktivitasTerbaru = DB::table('sadarin_access_log')->latest('access_log_created_at')->limit(5)->get();

        /*
        |--------------------------------------------------------------------------
        | DATA KLASIFIKASI
        |--------------------------------------------------------------------------
        */

        $jumlahUnit = SadarinUnit::count();

        $jumlahProgram = SadarinProgram::count();

        $jumlahKegiatan = SadarinKegiatan::count();

        $jumlahSubKegiatan = SadarinSubKegiatan::count();

        $jumlahJenisDokumen = SadarinDocumentType::count();

        $jumlahTag = SadarinTag::count();

        /*
        |--------------------------------------------------------------------------
        | ARSIP BULAN INI
        |--------------------------------------------------------------------------
        */

        $arsipBulanIni = SadarinArchive::query()->whereMonth('archive_created_at', now()->month)->whereYear('archive_created_at', now()->year)->count();

        /*
        |--------------------------------------------------------------------------
        | RETURN DASHBOARD
        |--------------------------------------------------------------------------
        */

        return view('dashboard.index', compact('totalArsip', 'menungguVerifikasi', 'terverifikasi', 'dikembalikan', 'persentaseTerverifikasi', 'arsipTerbaru', 'aktivitasTerbaru', 'jumlahUnit', 'jumlahProgram', 'jumlahKegiatan', 'jumlahSubKegiatan', 'jumlahJenisDokumen', 'jumlahTag', 'arsipBulanIni'));
    }
}