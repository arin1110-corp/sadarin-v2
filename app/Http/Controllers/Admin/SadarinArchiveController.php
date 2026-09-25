<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinArchive;
use App\Models\SadarinDocumentType;
use App\Models\SadarinUnit;
use App\Models\SadarinProgram;
use App\Models\SadarinKegiatan;
use App\Models\SadarinSubKegiatan;
use App\Models\SadarinTag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SadarinArchiveController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | INDEX
    |--------------------------------------------------------------------------
    */

    public function index(Request $request)
    {
        $search = trim($request->search);

        $archives = SadarinArchive::query()
            ->with(['unit', 'subKegiatan', 'documentType', 'tags'])
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                $q->where('archive_title', 'like', "%{$search}%")->orWhere('archive_description', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('archive_created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.arsip.index', [
            'archives' => $archives,
            'search' => $search,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | CREATE
    |--------------------------------------------------------------------------
    */

    public function create()
    {
        /*
        |--------------------------------------------------------------------------
        | UNIT
        |--------------------------------------------------------------------------
        */

        $units = SadarinUnit::query()->where('unit_is_active', true)->orderBy('unit_name')->get();

        /*
        |--------------------------------------------------------------------------
        | PROGRAM
        |--------------------------------------------------------------------------
        |
        | Program hanya digunakan sebagai master pilihan
        | untuk menentukan kegiatan dan sub kegiatan.
        |
        | Program tidak disimpan langsung ke sadarin_archive.
        |
        */

        $programs = SadarinProgram::query()->where('program_is_active', true)->orderBy('program_name')->get();

        /*
        |--------------------------------------------------------------------------
        | JENIS DOKUMEN
        |--------------------------------------------------------------------------
        */

        $documentTypes = SadarinDocumentType::query()->where('document_type_is_active', true)->orderBy('document_type_name')->get();

        /*
        |--------------------------------------------------------------------------
        | TAG
        |--------------------------------------------------------------------------
        */

        $tags = SadarinTag::query()->where('tag_is_active', true)->orderBy('tag_name')->get();

        return view('admin.arsip.create', [
            'units' => $units,
            'programs' => $programs,
            'documentTypes' => $documentTypes,
            'tags' => $tags,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | STORE
    |--------------------------------------------------------------------------
    */

    public function store(Request $request)
    {
        $validated = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | INFORMASI ARSIP
            |--------------------------------------------------------------------------
            */

            'archive_title' => ['required', 'string', 'max:255'],

            'archive_description' => ['nullable', 'string'],

            'archive_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],

            /*
            |--------------------------------------------------------------------------
            | PEMILIK / PENGAJU
            |--------------------------------------------------------------------------
            */

            'archive_user_id' => ['nullable', 'string', 'max:255'],

            /*
            |--------------------------------------------------------------------------
            | KLASIFIKASI
            |--------------------------------------------------------------------------
            */

            'archive_unit_id' => ['nullable', 'integer', 'exists:sadarin_unit,unit_id'],

            'archive_sub_kegiatan_id' => ['nullable', 'integer', 'exists:sadarin_sub_kegiatan,sub_kegiatan_id'],

            'archive_document_type_id' => ['nullable', 'integer', 'exists:sadarin_document_type,document_type_id'],

            /*
            |--------------------------------------------------------------------------
            | GOOGLE DRIVE
            |--------------------------------------------------------------------------
            */

            'archive_drive_url' => ['nullable', 'url', 'max:2048'],

            'archive_drive_folder_id' => ['nullable', 'string', 'max:255'],

            /*
            |--------------------------------------------------------------------------
            | HAK AKSES
            |--------------------------------------------------------------------------
            */

            'archive_access_level' => ['required', 'in:public,internal'],

            /*
            |--------------------------------------------------------------------------
            | TAG
            |--------------------------------------------------------------------------
            */

            'tag_ids' => ['nullable', 'array'],

            'tag_ids.*' => ['integer', 'exists:sadarin_tag,tag_id'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | STATUS AWAL
        |--------------------------------------------------------------------------
        */

        $validated['archive_status'] = 'draft';

        /*
        |--------------------------------------------------------------------------
        | USER PEMILIK / PENGAJU
        |--------------------------------------------------------------------------
        |
        | SADARIN menggunakan user dari SAMPERIN.
        |
        | Untuk sementara ID user diambil dari auth().
        |
        */

        if (empty($validated['archive_user_id'])) {
            $validated['archive_user_id'] = session('sadarin_user_nama');
        }

        /*
        |--------------------------------------------------------------------------
        | TAG
        |--------------------------------------------------------------------------
        |
        | tag_ids bukan kolom pada sadarin_archive.
        |
        */

        $tagIds = $validated['tag_ids'] ?? [];

        unset($validated['tag_ids']);

        /*
        |--------------------------------------------------------------------------
        | SIMPAN ARSIP
        |--------------------------------------------------------------------------
        */

        $archive = DB::transaction(function () use ($validated, $tagIds) {
            $archive = SadarinArchive::create($validated);

            /*
            |--------------------------------------------------------------------------
            | SIMPAN TAG
            |--------------------------------------------------------------------------
            */

            if (!empty($tagIds)) {
                $archive->tags()->sync(array_unique($tagIds));
            }

            return $archive;
        });

        return redirect()->route('sadarin.admin.archive.show', $archive->archive_id)->with('success', 'Arsip berhasil dibuat.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $archive = SadarinArchive::query()
            ->with(['unit', 'documentType', 'subKegiatan.kegiatan.program', 'tags'])
            ->findOrFail($id);

        return view('admin.arsip.show', [
            'archive' => $archive,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | EDIT
    |--------------------------------------------------------------------------
    */

    public function edit($id)
    {
        $archive = SadarinArchive::query()->with('tags')->findOrFail($id);

        /*
        |--------------------------------------------------------------------------
        | UNIT
        |--------------------------------------------------------------------------
        */

        $units = SadarinUnit::query()->where('unit_is_active', true)->orderBy('unit_name')->get();

        /*
        |--------------------------------------------------------------------------
        | PROGRAM
        |--------------------------------------------------------------------------
        |
        | Hanya digunakan untuk pilihan pada form.
        |
        */

        $programs = SadarinProgram::query()->where('program_is_active', true)->orderBy('program_name')->get();

        /*
        |--------------------------------------------------------------------------
        | JENIS DOKUMEN
        |--------------------------------------------------------------------------
        */

        $documentTypes = SadarinDocumentType::query()->where('document_type_is_active', true)->orderBy('document_type_name')->get();

        /*
        |--------------------------------------------------------------------------
        | TAG
        |--------------------------------------------------------------------------
        */

        $tags = SadarinTag::query()->where('tag_is_active', true)->orderBy('tag_name')->get();

        return view('admin.arsip.edit', [
            'archive' => $archive,
            'units' => $units,
            'programs' => $programs,
            'documentTypes' => $documentTypes,
            'tags' => $tags,
        ]);
    }

    /*
    |--------------------------------------------------------------------------
    | UPDATE
    |--------------------------------------------------------------------------
    */

    public function update(Request $request, $id)
    {
        $archive = SadarinArchive::findOrFail($id);

        $validated = $request->validate([
            /*
            |--------------------------------------------------------------------------
            | INFORMASI ARSIP
            |--------------------------------------------------------------------------
            */

            'archive_title' => ['required', 'string', 'max:255'],

            'archive_description' => ['nullable', 'string'],

            'archive_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],

            /*
            |--------------------------------------------------------------------------
            | PEMILIK / PENGAJU
            |--------------------------------------------------------------------------
            */

            'archive_user_id' => ['nullable', 'string', 'max:255',],

            /*
            |--------------------------------------------------------------------------
            | KLASIFIKASI
            |--------------------------------------------------------------------------
            */

            'archive_unit_id' => ['nullable', 'integer', 'exists:sadarin_unit,unit_id'],

            'archive_sub_kegiatan_id' => ['nullable', 'integer', 'exists:sadarin_sub_kegiatan,sub_kegiatan_id'],

            'archive_document_type_id' => ['nullable', 'integer', 'exists:sadarin_document_type,document_type_id'],

            /*
            |--------------------------------------------------------------------------
            | GOOGLE DRIVE
            |--------------------------------------------------------------------------
            */

            'archive_drive_url' => ['nullable', 'url', 'max:2048'],

            'archive_drive_folder_id' => ['nullable', 'string', 'max:255'],

            /*
            |--------------------------------------------------------------------------
            | HAK AKSES
            |--------------------------------------------------------------------------
            */

            'archive_access_level' => ['required', 'in:public,internal'],

            /*
            |--------------------------------------------------------------------------
            | STATUS
            |--------------------------------------------------------------------------
            */

            'archive_status' => ['nullable', 'in:draft,pending,verified,rejected'],

            /*
            |--------------------------------------------------------------------------
            | ALASAN PENOLAKAN
            |--------------------------------------------------------------------------
            */

            'archive_rejection_reason' => ['nullable', 'string'],

            /*
            |--------------------------------------------------------------------------
            | TAG
            |--------------------------------------------------------------------------
            */

            'tag_ids' => ['nullable', 'array'],

            'tag_ids.*' => ['integer', 'exists:sadarin_tag,tag_id'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | TAG
        |--------------------------------------------------------------------------
        */

        $tagIds = $validated['tag_ids'] ?? [];

        unset($validated['tag_ids']);

        /*
        |--------------------------------------------------------------------------
        | UPDATE
        |--------------------------------------------------------------------------
        */

        DB::transaction(function () use ($archive, $validated, $tagIds) {
            $archive->update($validated);

            /*
            |--------------------------------------------------------------------------
            | SYNC TAG
            |--------------------------------------------------------------------------
            */

            $archive->tags()->sync(array_unique($tagIds));
        });

        return redirect()->route('sadarin.admin.archive.show', $archive->archive_id)->with('success', 'Arsip berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $archive = SadarinArchive::findOrFail($id);

        DB::transaction(function () use ($archive) {
            /*
            |--------------------------------------------------------------------------
            | HAPUS RELASI TAG
            |--------------------------------------------------------------------------
            */

            $archive->tags()->detach();

            /*
            |--------------------------------------------------------------------------
            | HAPUS ARSIP
            |--------------------------------------------------------------------------
            */

            $archive->delete();
        });

        return redirect()->route('sadarin.admin.archive.index')->with('success', 'Arsip berhasil dihapus.');
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX - KEGIATAN
    |--------------------------------------------------------------------------
    */

    public function getKegiatan($programId)
    {
        $kegiatans = SadarinKegiatan::query()
            ->where('kegiatan_program_id', $programId)
            ->where('kegiatan_is_active', true)
            ->orderBy('kegiatan_name')
            ->get(['kegiatan_id', 'kegiatan_code', 'kegiatan_name']);

        return response()->json($kegiatans);
    }

    /*
    |--------------------------------------------------------------------------
    | AJAX - SUB KEGIATAN
    |--------------------------------------------------------------------------
    */

    public function getSubKegiatan($kegiatanId)
    {
        $subKegiatans = SadarinSubKegiatan::query()
            ->where('sub_kegiatan_kegiatan_id', $kegiatanId)
            ->where('sub_kegiatan_is_active', true)
            ->orderBy('sub_kegiatan_name')
            ->get(['sub_kegiatan_id', 'sub_kegiatan_code', 'sub_kegiatan_name']);

        return response()->json($subKegiatans);
    }
    public function verif($id)
    {
        $archive = SadarinArchive::query()
            ->with([
                'unit',
                'documentType',
                'subKegiatan.kegiatan.program',
                'tags',
            ])
            ->findOrFail($id);

        return view('admin.arsip.verification.verif', [
            'archive' => $archive,
        ]);
    }
    /*
|--------------------------------------------------------------------------
| VERIFIKASI ARSIP
|--------------------------------------------------------------------------
*/

    public function verify($id)
    {
        $archive = SadarinArchive::query()
            ->with([
                'unit',
                'documentType',
                'subKegiatan.kegiatan.program',
                'tags',
            ])
            ->findOrFail($id);

        return view('admin.arsip.verifikasi', [
            'archive' => $archive,
        ]);
    }


    /*
|--------------------------------------------------------------------------
| PROSES VERIFIKASI
|--------------------------------------------------------------------------
*/

    public function processVerify(Request $request, $id)
    {
        $archive = SadarinArchive::findOrFail($id);

        $validated = $request->validate([
            'action' => ['required', 'in:verified,rejected'],
            'archive_rejection_reason' => ['nullable', 'string'],
        ]);

        if ($validated['action'] === 'verified') {

            $archive->update([
                'archive_status' => 'verified',
                'archive_rejection_reason' => null,
            ]);

            return redirect()
                ->route('sadarin.admin.archive.verification')
                ->with('success', 'Arsip berhasil diverifikasi.');
        }

        /*
    |--------------------------------------------------------------------------
    | DITOLAK
    |--------------------------------------------------------------------------
    */

        if (empty($validated['archive_rejection_reason'])) {
            return back()
                ->withErrors([
                    'archive_rejection_reason' => 'Alasan penolakan wajib diisi.',
                ])
                ->withInput();
        }

        $archive->update([
            'archive_status' => 'rejected',
            'archive_rejection_reason' => $validated['archive_rejection_reason'],
        ]);

        return redirect()
            ->route('sadarin.admin.archive.verification')
            ->with('success', 'Arsip berhasil ditolak.');
    }
    /*
|--------------------------------------------------------------------------
| VERIFICATION
|--------------------------------------------------------------------------
*/

    public function verification(Request $request)
    {
        $search = trim($request->search);

        $archives = SadarinArchive::query()
            ->with([
                'unit',
                'documentType',
                'subKegiatan.kegiatan.program',
                'tags',
            ])
            ->where('archive_status', 'draft')
            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('archive_title', 'like', "%{$search}%")
                        ->orWhere('archive_description', 'like', "%{$search}%");
                });
            })
            ->orderByDesc('archive_created_at')
            ->paginate(10)
            ->withQueryString();

        return view('admin.arsip.verification.index', [
            'archives' => $archives,
            'search' => $search,
        ]);
    }
}