<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\SadarinArchive;
use App\Models\SadarinDocumentType;
use App\Models\SadarinKegiatan;
use App\Models\SadarinProgram;
use App\Models\SadarinSubKegiatan;
use App\Models\SadarinTag;
use App\Models\SadarinUnit;
use Illuminate\Http\Request;

class SadarinHomepageController extends Controller
{
    /**
     * ================================================================
     * HOMEPAGE SADARIN
     * ================================================================
     */
    public function index(Request $request)
    {
        $search = trim($request->input('q', ''));

        /*
        |--------------------------------------------------------------------------
        | KLASIFIKASI
        |--------------------------------------------------------------------------
        | Semua data dikirim ke homepage agar popup dapat menampilkan
        | seluruh data yang tersedia dari database.
        */

        $units = SadarinUnit::query()->orderBy('unit_name')->get();

        $programs = SadarinProgram::query()->orderBy('program_name')->get();

        $kegiatans = SadarinKegiatan::query()->orderBy('kegiatan_name')->get();

        $subKegiatans = SadarinSubKegiatan::query()->orderBy('sub_kegiatan_name')->get();

        $documentTypes = SadarinDocumentType::query()->where('document_type_is_active', true)->orderBy('document_type_name')->get();

        /*
        |--------------------------------------------------------------------------
        | TAG
        |--------------------------------------------------------------------------
        | Tag berada pada BERKAS/FILE, bukan langsung pada archive.
        |
        | Karena itu kita ambil tag melalui relasi file.
        |--------------------------------------------------------------------------
        */

        $tags = SadarinTag::query()->orderBy('tag_name')->get();

        /*
        |--------------------------------------------------------------------------
        | ARSIP TERBARU
        |--------------------------------------------------------------------------
        |
        | JANGAN menggunakan archive_is_active karena field tersebut
        | tidak ada di tabel sadarin_archive.
        |
        | Soft delete tetap otomatis ditangani oleh Model SadarinArchive
        | melalui archive_deleted_at.
        |--------------------------------------------------------------------------
        */

        $latestArchives = SadarinArchive::query()
            ->with(['unit', 'program', 'kegiatan', 'subKegiatan', 'documentType', 'files.tags'])
            ->orderByDesc('archive_created_at')
            ->limit(6)
            ->get();

        /*
        |--------------------------------------------------------------------------
        | HASIL PENCARIAN
        |--------------------------------------------------------------------------
        */

        $searchResults = collect();

        if ($search !== '') {
            $searchResults = SadarinArchive::query()
                ->with(['unit', 'program', 'kegiatan', 'subKegiatan', 'documentType', 'files.tags'])
                ->where(function ($query) use ($search) {
                    /*
                    |--------------------------------------------------------------------------
                    | JUDUL ARSIP
                    |--------------------------------------------------------------------------
                    */

                    $query->where('archive_title', 'like', '%' . $search . '%');

                    /*
                    |--------------------------------------------------------------------------
                    | TAHUN
                    |--------------------------------------------------------------------------
                    */

                    $query->orWhere('archive_year', 'like', '%' . $search . '%');

                    /*
                    |--------------------------------------------------------------------------
                    | UNIT
                    |--------------------------------------------------------------------------
                    */

                    $query->orWhereHas('unit', function ($q) use ($search) {
                        $q->where('unit_name', 'like', '%' . $search . '%');
                    });

                    /*
                    |--------------------------------------------------------------------------
                    | PROGRAM
                    |--------------------------------------------------------------------------
                    */

                    $query->orWhereHas('program', function ($q) use ($search) {
                        $q->where('program_name', 'like', '%' . $search . '%');
                    });

                    /*
                    |--------------------------------------------------------------------------
                    | KEGIATAN
                    |--------------------------------------------------------------------------
                    */

                    $query->orWhereHas('kegiatan', function ($q) use ($search) {
                        $q->where('kegiatan_name', 'like', '%' . $search . '%');
                    });

                    /*
                    |--------------------------------------------------------------------------
                    | SUB KEGIATAN
                    |--------------------------------------------------------------------------
                    */

                    $query->orWhereHas('subKegiatan', function ($q) use ($search) {
                        $q->where('sub_kegiatan_name', 'like', '%' . $search . '%');
                    });

                    /*
                    |--------------------------------------------------------------------------
                    | JENIS DOKUMEN
                    |--------------------------------------------------------------------------
                    */

                    $query->orWhereHas('documentType', function ($q) use ($search) {
                        $q->where('document_type_name', 'like', '%' . $search . '%');
                    });

                    /*
                    |--------------------------------------------------------------------------
                    | TAG
                    |--------------------------------------------------------------------------
                    |
                    | TAG berada pada FILE.
                    |--------------------------------------------------------------------------
                    */

                    $query->orWhereHas('files.tags', function ($q) use ($search) {
                        $q->where('tag_name', 'like', '%' . $search . '%');
                    });
                })
                ->orderByDesc('archive_created_at')
                ->limit(30)
                ->get();
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN HOMEPAGE
        |--------------------------------------------------------------------------
        */

        return view('UserPage.index', [
            'userName' => 'Nama Pengguna',

            'userRole' => 'Pegawai',

            'search' => $search,

            'searchResults' => $searchResults,

            'latestArchives' => $latestArchives,

            'units' => $units,

            'programs' => $programs,

            'kegiatans' => $kegiatans,

            'subKegiatans' => $subKegiatans,

            'documentTypes' => $documentTypes,

            'tags' => $tags,
        ]);
    }

    /**
     * Menampilkan daftar arsip SADARIN.
     *
     * Mendukung filter:
     * - unit
     * - program
     * - kegiatan
     * - sub_kegiatan
     * - document_type
     * - tag
     * - q
     */
    public function showArchive(Request $request)
    {
        $query = SadarinArchive::query()
            ->with([
                'unit',
                'program',
                'kegiatan',
                'subKegiatan',
                'documentType',
                'files.tags',
            ]);

        /*
    |--------------------------------------------------------------------------
    | SEARCH
    |--------------------------------------------------------------------------
    */

        if ($request->filled('q')) {

            $search = trim($request->q);

            $query->where(function ($q) use ($search) {

                $q->where(
                    'archive_title',
                    'like',
                    '%' . $search . '%'
                )

                    ->orWhere(
                        'archive_year',
                        'like',
                        '%' . $search . '%'
                    )

                    ->orWhereHas('unit', function ($q) use ($search) {
                        $q->where(
                            'unit_name',
                            'like',
                            '%' . $search . '%'
                        );
                    })

                    ->orWhereHas('program', function ($q) use ($search) {
                        $q->where(
                            'program_name',
                            'like',
                            '%' . $search . '%'
                        );
                    })

                    ->orWhereHas('kegiatan', function ($q) use ($search) {
                        $q->where(
                            'kegiatan_name',
                            'like',
                            '%' . $search . '%'
                        );
                    })

                    ->orWhereHas('subKegiatan', function ($q) use ($search) {
                        $q->where(
                            'sub_kegiatan_name',
                            'like',
                            '%' . $search . '%'
                        );
                    })

                    ->orWhereHas('documentType', function ($q) use ($search) {
                        $q->where(
                            'document_type_name',
                            'like',
                            '%' . $search . '%'
                        );
                    })

                    /*
            |--------------------------------------------------------------------------
            | TAG ADA DI FILE
            |--------------------------------------------------------------------------
            */

                    ->orWhereHas('files.tags', function ($q) use ($search) {
                        $q->where(
                            'tag_name',
                            'like',
                            '%' . $search . '%'
                        );
                    });
            });
        }


        /*
    |--------------------------------------------------------------------------
    | FILTER UNIT
    |--------------------------------------------------------------------------
    */

        if ($request->filled('unit')) {

            $query->where(
                'archive_unit_id',
                $request->unit
            );
        }


        /*
    |--------------------------------------------------------------------------
    | FILTER PROGRAM
    |--------------------------------------------------------------------------
    */

        if ($request->filled('program')) {

            $query->where(
                'archive_program_id',
                $request->program
            );
        }


        /*
    |--------------------------------------------------------------------------
    | FILTER KEGIATAN
    |--------------------------------------------------------------------------
    */

        if ($request->filled('kegiatan')) {

            $query->where(
                'archive_kegiatan_id',
                $request->kegiatan
            );
        }


        /*
    |--------------------------------------------------------------------------
    | FILTER SUB KEGIATAN
    |--------------------------------------------------------------------------
    */

        if ($request->filled('sub_kegiatan')) {

            $query->where(
                'archive_sub_kegiatan_id',
                $request->sub_kegiatan
            );
        }


        /*
    |--------------------------------------------------------------------------
    | FILTER JENIS DOKUMEN
    |--------------------------------------------------------------------------
    */

        if ($request->filled('document_type')) {

            $query->where(
                'archive_document_type_id',
                $request->document_type
            );
        }


        /*
    |--------------------------------------------------------------------------
    | FILTER TAG
    |--------------------------------------------------------------------------
    |
    | Tag berada di file.
    |
    */

        if ($request->filled('tag')) {

            $tagId = $request->tag;

            $query->whereHas('files.tags', function ($q) use ($tagId) {

                $q->where(
                    'tag_id',
                    $tagId
                );
            });
        }


        /*
    |--------------------------------------------------------------------------
    | DATA ARSIP
    |--------------------------------------------------------------------------
    */

        $archives = $query
            ->orderByDesc('archive_created_at')
            ->paginate(12)
            ->withQueryString();


        /*
    |--------------------------------------------------------------------------
    | DATA SIDEBAR
    |--------------------------------------------------------------------------
    */

        $units = SadarinUnit::query()
            ->orderBy('unit_name')
            ->get();

        $programs = SadarinProgram::query()
            ->orderBy('program_name')
            ->get();

        $kegiatans = SadarinKegiatan::query()
            ->orderBy('kegiatan_name')
            ->get();

        $subKegiatans = SadarinSubKegiatan::query()
            ->orderBy('sub_kegiatan_name')
            ->get();

        $documentTypes = SadarinDocumentType::query()
            ->where('document_type_is_active', true)
            ->orderBy('document_type_name')
            ->get();

        $tags = SadarinTag::query()
            ->orderBy('tag_name')
            ->get();


        return view('UserPage.archive-show', [

            'archives' => $archives,

            'units' => $units,

            'programs' => $programs,

            'kegiatans' => $kegiatans,

            'subKegiatans' => $subKegiatans,

            'documentTypes' => $documentTypes,

            'tags' => $tags,

        ]);
    }

    /**
     * ================================================================
     * HALAMAN LOGIN
     * ================================================================
     */
    public function showLogin()
    {
        return view('LoginPage.index');
    }

    /**
     * ================================================================
     * LOGIN INTERNAL
     * ================================================================
     *
     * Placeholder sementara.
     */
    public function loginInternal(Request $request)
    {
        return back()->with('error', 'Proses login pegawai belum tersedia.');
    }

    /**
     * ================================================================
     * LOGIN PUBLIK
     * ================================================================
     *
     * Placeholder sementara.
     */
    public function loginPublic(Request $request)
    {
        return back()->with('error', 'Proses login publik belum tersedia.');
    }

    /**
     * ================================================================
     * LOGOUT
     * ================================================================
     */
    public function logout(Request $request)
    {
        return redirect()->route('sadarin.login')->with('success', 'Anda telah keluar dari SADARIN.');
    }
}