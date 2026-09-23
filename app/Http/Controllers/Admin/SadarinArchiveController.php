<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinArchive;
use App\Models\SadarinDocumentType;
use App\Models\SadarinUnit;
use App\Models\SadarinArchiveFile;
use App\Models\SadarinProgram;
use App\Models\SadarinKegiatan;
use App\Models\SadarinSubKegiatan;
use Illuminate\Http\Request;

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
            ->with(['unit', 'program', 'kegiatan', 'subKegiatan', 'documentType'])
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
        $units = SadarinUnit::query()->where('unit_is_active', true)->orderBy('unit_name')->get();

        $programs = SadarinProgram::query()->where('program_is_active', true)->orderBy('program_name')->get();

        $documentTypes = SadarinDocumentType::query()->where('document_type_is_active', true)->orderBy('document_type_name')->get();

        return view('admin.arsip.create', [
            'units' => $units,
            'programs' => $programs,
            'documentTypes' => $documentTypes,
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
            'archive_title' => ['required', 'string', 'max:255'],

            'archive_description' => ['nullable', 'string'],

            'archive_unit_id' => ['nullable', 'integer'],

            'archive_program_id' => ['nullable', 'integer'],

            'archive_kegiatan_id' => ['nullable', 'integer'],

            'archive_sub_kegiatan_id' => ['nullable', 'integer'],

            'archive_document_type_id' => ['nullable', 'integer'],

            'archive_date' => ['nullable', 'date'],

            'archive_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],

            'archive_access_level' => ['required', 'in:public,internal,restricted'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | STATUS
        |--------------------------------------------------------------------------
        */

        $validated['archive_status'] = 'draft';

        /*
        |--------------------------------------------------------------------------
        | USER PEMBUAT
        |--------------------------------------------------------------------------
        */

        $validated['archive_created_by'] = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | SIMPAN
        |--------------------------------------------------------------------------
        */

        SadarinArchive::create($validated);

        return redirect()->route('sadarin.admin.archive.index')->with('success', 'Arsip berhasil dibuat.');
    }

    /*
    |--------------------------------------------------------------------------
    | SHOW
    |--------------------------------------------------------------------------
    */

    public function show($id)
    {
        $archive = SadarinArchive::findOrFail($id);

        $archive->load(['files', 'tags.tag', 'unit', 'program', 'kegiatan', 'subKegiatan', 'documentType']);

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
        $archive = SadarinArchive::findOrFail($id);

        $units = SadarinUnit::query()->where('unit_is_active', true)->orderBy('unit_name')->get();

        $programs = SadarinProgram::query()->where('program_is_active', true)->orderBy('program_name')->get();

        $kegiatans = SadarinKegiatan::query()->where('kegiatan_is_active', true)->orderBy('kegiatan_name')->get();

        $subKegiatans = SadarinSubKegiatan::query()->where('sub_kegiatan_is_active', true)->orderBy('sub_kegiatan_name')->get();

        $documentTypes = SadarinDocumentType::query()->where('document_type_is_active', true)->orderBy('document_type_name')->get();

        return view('admin.arsip.edit', [
            'archive' => $archive,
            'units' => $units,
            'programs' => $programs,
            'kegiatans' => $kegiatans,
            'subKegiatans' => $subKegiatans,
            'documentTypes' => $documentTypes,
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
            'archive_title' => ['required', 'string', 'max:255'],

            'archive_description' => ['nullable', 'string'],

            'archive_unit_id' => ['nullable', 'integer'],

            'archive_program_id' => ['nullable', 'integer'],

            'archive_kegiatan_id' => ['nullable', 'integer'],

            'archive_sub_kegiatan_id' => ['nullable', 'integer'],

            'archive_document_type_id' => ['nullable', 'integer'],

            'archive_date' => ['nullable', 'date'],

            'archive_year' => ['nullable', 'integer', 'min:1900', 'max:2100'],

            'archive_access_level' => ['required', 'in:public,internal,restricted'],
        ]);

        /*
        |--------------------------------------------------------------------------
        | USER UPDATE
        |--------------------------------------------------------------------------
        */

        $validated['archive_updated_by'] = auth()->id();

        /*
        |--------------------------------------------------------------------------
        | UPDATE DATA
        |--------------------------------------------------------------------------
        */

        $archive->update($validated);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT KE DETAIL
        |--------------------------------------------------------------------------
        */

        return redirect()
            ->route('sadarin.admin.archive.show', [
                'id' => $archive->archive_id,
            ])
            ->with('success', 'Arsip berhasil diperbarui.');
    }

    /*
    |--------------------------------------------------------------------------
    | DESTROY
    |--------------------------------------------------------------------------
    */

    public function destroy($id)
    {
        $archive = SadarinArchive::findOrFail($id);

        $archive->delete();

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

    /*
|--------------------------------------------------------------------------
| FILE - CREATE
|--------------------------------------------------------------------------
*/

    public function fileCreate(SadarinArchive $archive)
    {
        return view('admin.arsip.file-create', [
            'archive' => $archive,
        ]);
    }

    /*
|--------------------------------------------------------------------------
| FILE - STORE
|--------------------------------------------------------------------------
*/

    public function fileStore(Request $request, SadarinArchive $archive)
    {
        $validated = $request->validate([
            'archive_file_original_name' => [
                'required',
                'string',
                'max:255',
            ],

            'archive_file_drive_file_id' => [
                'required',
                'string',
                'max:255',
            ],

            'archive_file_drive_url' => [
                'required',
                'url',
            ],

            'archive_file_is_primary' => [
                'nullable',
                'boolean',
            ],
        ]);

        /*
    |--------------------------------------------------------------------------
    | Jika dijadikan primary,
    | primary sebelumnya dinonaktifkan
    |--------------------------------------------------------------------------
    */

        if ($request->boolean('archive_file_is_primary')) {
            SadarinArchiveFile::where(
                'archive_file_archive_id',
                $archive->archive_id
            )->update([
                'archive_file_is_primary' => false,
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | SIMPAN
    |--------------------------------------------------------------------------
    */

        SadarinArchiveFile::create([
            'archive_file_archive_id' => $archive->archive_id,

            'archive_file_original_name' =>
            $validated['archive_file_original_name'],

            'archive_file_drive_file_id' =>
            $validated['archive_file_drive_file_id'],

            'archive_file_drive_url' =>
            $validated['archive_file_drive_url'],

            'archive_file_is_primary' =>
            $request->boolean('archive_file_is_primary'),
        ]);

        return redirect()
            ->route('sadarin.admin.archive.show', $archive)
            ->with('success', 'Berkas berhasil ditambahkan.');
    }

    /*
|--------------------------------------------------------------------------
| FILE - DESTROY
|--------------------------------------------------------------------------
*/

    public function fileDestroy(
        SadarinArchive $archive,
        SadarinArchiveFile $file
    ) {
        abort_unless(
            $file->archive_file_archive_id == $archive->archive_id,
            404
        );

        $file->delete();

        return redirect()
            ->route('sadarin.admin.archive.show', $archive)
            ->with('success', 'Berkas berhasil dihapus.');
    }
}