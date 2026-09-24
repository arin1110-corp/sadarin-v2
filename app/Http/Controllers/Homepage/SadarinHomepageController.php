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
use App\Services\SadarinAccessLogService;

class SadarinHomepageController extends Controller
{
    /**
     * ================================================================
     * HOMEPAGE / DAFTAR ARSIP SADARIN
     * ================================================================
     *
     * Semua daftar arsip sekarang menggunakan method index().
     *
     * Filter:
     * - unit
     * - program
     * - kegiatan
     * - sub_kegiatan
     * - document_type
     * - tag
     * - q
     */
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        $search = trim($request->input('q', ''));

        /*
        |--------------------------------------------------------------------------
        | QUERY ARSIP
        |--------------------------------------------------------------------------
        */

        $query = SadarinArchive::query()->with(['unit', 'program', 'kegiatan', 'subKegiatan', 'documentType', 'files.tags']);

        /*
        |--------------------------------------------------------------------------
        | SEARCH
        |--------------------------------------------------------------------------
        */

        if ($search !== '') {
            $query->where(function ($q) use ($search) {
                /*
                |--------------------------------------------------------------------------
                | JUDUL
                |--------------------------------------------------------------------------
                */

                $q->where('archive_title', 'like', '%' . $search . '%');

                /*
                |--------------------------------------------------------------------------
                | TAHUN
                |--------------------------------------------------------------------------
                */

                $q->orWhere('archive_year', 'like', '%' . $search . '%');

                /*
                |--------------------------------------------------------------------------
                | UNIT
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('unit', function ($q) use ($search) {
                    $q->where('unit_name', 'like', '%' . $search . '%');
                });

                /*
                |--------------------------------------------------------------------------
                | PROGRAM
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('program', function ($q) use ($search) {
                    $q->where('program_name', 'like', '%' . $search . '%');
                });

                /*
                |--------------------------------------------------------------------------
                | KEGIATAN
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('kegiatan', function ($q) use ($search) {
                    $q->where('kegiatan_name', 'like', '%' . $search . '%');
                });

                /*
                |--------------------------------------------------------------------------
                | SUB KEGIATAN
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('subKegiatan', function ($q) use ($search) {
                    $q->where('sub_kegiatan_name', 'like', '%' . $search . '%');
                });

                /*
                |--------------------------------------------------------------------------
                | JENIS DOKUMEN
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('documentType', function ($q) use ($search) {
                    $q->where('document_type_name', 'like', '%' . $search . '%');
                });

                /*
                |--------------------------------------------------------------------------
                | TAG
                |--------------------------------------------------------------------------
                |
                | Tag berada di file.
                |
                */

                $q->orWhereHas('files.tags', function ($q) use ($search) {
                    $q->where('tag_name', 'like', '%' . $search . '%');
                });
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER UNIT
        |--------------------------------------------------------------------------
        */

        if ($request->filled('unit')) {
            $query->where('archive_unit_id', $request->input('unit'));
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER PROGRAM
        |--------------------------------------------------------------------------
        */

        if ($request->filled('program')) {
            $query->where('archive_program_id', $request->input('program'));
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER KEGIATAN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('kegiatan')) {
            $query->where('archive_kegiatan_id', $request->input('kegiatan'));
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER SUB KEGIATAN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('sub_kegiatan')) {
            $query->where('archive_sub_kegiatan_id', $request->input('sub_kegiatan'));
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER JENIS DOKUMEN
        |--------------------------------------------------------------------------
        */

        if ($request->filled('document_type')) {
            $query->where('archive_document_type_id', $request->input('document_type'));
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
            $tagId = $request->input('tag');

            $query->whereHas('files.tags', function ($q) use ($tagId) {
                $q->where('tag_id', $tagId);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | DATA ARSIP
        |--------------------------------------------------------------------------
        |
        | Tidak menggunakan archive_is_active.
        |
        | Soft delete menggunakan archive_deleted_at
        | melalui model SadarinArchive.
        |
        */

        $archives = $query->orderByDesc('archive_created_at')->paginate(12)->withQueryString();

        /*
|--------------------------------------------------------------------------
| ACCESS LOG - USER MEMBUKA DAFTAR ARSIP
|--------------------------------------------------------------------------
*/

        SadarinAccessLogService::user(action: 'archive.index');
        /*
        |--------------------------------------------------------------------------
        | DATA SIDEBAR - UNIT
        |--------------------------------------------------------------------------
        */

        $units = SadarinUnit::query()->orderBy('unit_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA SIDEBAR - PROGRAM
        |--------------------------------------------------------------------------
        */

        $programs = SadarinProgram::query()->orderBy('program_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA SIDEBAR - KEGIATAN
        |--------------------------------------------------------------------------
        */

        $kegiatans = SadarinKegiatan::query()->orderBy('kegiatan_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA SIDEBAR - SUB KEGIATAN
        |--------------------------------------------------------------------------
        */

        $subKegiatans = SadarinSubKegiatan::query()->orderBy('sub_kegiatan_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA SIDEBAR - JENIS DOKUMEN
        |--------------------------------------------------------------------------
        */

        $documentTypes = SadarinDocumentType::query()->where('document_type_is_active', true)->orderBy('document_type_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA SIDEBAR - TAG
        |--------------------------------------------------------------------------
        */

        $tags = SadarinTag::query()->orderBy('tag_name')->get();

        /*
        |--------------------------------------------------------------------------
        | SELECTED FILTER
        |--------------------------------------------------------------------------
        |
        | Digunakan Blade untuk menampilkan:
        | - judul filter aktif
        | - badge filter aktif
        |
        */

        $selectedUnit = null;

        if ($request->filled('unit')) {
            $selectedUnit = SadarinUnit::find($request->input('unit'));
        }

        $selectedProgram = null;

        if ($request->filled('program')) {
            $selectedProgram = SadarinProgram::find($request->input('program'));
        }

        $selectedKegiatan = null;

        if ($request->filled('kegiatan')) {
            $selectedKegiatan = SadarinKegiatan::find($request->input('kegiatan'));
        }

        $selectedSubKegiatan = null;

        if ($request->filled('sub_kegiatan')) {
            $selectedSubKegiatan = SadarinSubKegiatan::find($request->input('sub_kegiatan'));
        }

        $selectedDocumentType = null;

        if ($request->filled('document_type')) {
            $selectedDocumentType = SadarinDocumentType::find($request->input('document_type'));
        }

        $selectedTag = null;

        if ($request->filled('tag')) {
            $selectedTag = SadarinTag::find($request->input('tag'));
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        |
        | SEKARANG SEMUA DAFTAR ARSIP LANGSUNG KE:
        |
        | resources/views/UserPage/index.blade.php
        |
        */

        return view('UserPage.index', [
            'archives' => $archives,

            'units' => $units,

            'programs' => $programs,

            'kegiatans' => $kegiatans,

            'subKegiatans' => $subKegiatans,

            'documentTypes' => $documentTypes,

            'tags' => $tags,

            'selectedUnit' => $selectedUnit,

            'selectedProgram' => $selectedProgram,

            'selectedKegiatan' => $selectedKegiatan,

            'selectedSubKegiatan' => $selectedSubKegiatan,

            'selectedDocumentType' => $selectedDocumentType,

            'selectedTag' => $selectedTag,

            'search' => $search,
        ]);
    }
}