<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\SadarinArchive;
use App\Models\SadarinDocumentType;
use App\Models\SadarinKegiatan;
use App\Models\SadarinProgram;
use Google\Client;
use Google\Service\Drive;
use App\Models\SadarinSubKegiatan;
use App\Models\SadarinTag;
use App\Models\SadarinUnit;
use App\Services\SadarinAccessLogService;
use Illuminate\Http\Request;

class SadarinHomepageController extends Controller
{
    /**
     * ================================================================
     * HOMEPAGE / DAFTAR ARSIP SADARIN
     * ================================================================
     *
     * Struktur klasifikasi arsip:
     *
     * Archive
     *   └── Sub Kegiatan
     *          └── Kegiatan
     *                 └── Program
     *
     * Tag langsung berelasi dengan Archive.
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
        |
        | Program dan kegiatan tidak diambil dari kolom archive.
        |
        | Archive -> subKegiatan -> kegiatan -> program
        |
        | Tag langsung:
        | Archive -> tags
        |
        */

        $query = SadarinArchive::query()->with(['unit', 'documentType', 'subKegiatan.kegiatan.program', 'tags']);

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
                | JENIS DOKUMEN
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('documentType', function ($q) use ($search) {
                    $q->where('document_type_name', 'like', '%' . $search . '%');
                });

                /*
                |--------------------------------------------------------------------------
                | SUB KEGIATAN
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('subKegiatan', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('sub_kegiatan_name', 'like', '%' . $search . '%');

                        $q->orWhere('sub_kegiatan_code', 'like', '%' . $search . '%');
                    });
                });

                /*
                |--------------------------------------------------------------------------
                | KEGIATAN
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('subKegiatan.kegiatan', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('kegiatan_name', 'like', '%' . $search . '%');

                        $q->orWhere('kegiatan_code', 'like', '%' . $search . '%');
                    });
                });

                /*
                |--------------------------------------------------------------------------
                | PROGRAM
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('subKegiatan.kegiatan.program', function ($q) use ($search) {
                    $q->where(function ($q) use ($search) {
                        $q->where('program_name', 'like', '%' . $search . '%');

                        $q->orWhere('program_code', 'like', '%' . $search . '%');
                    });
                });

                /*
                |--------------------------------------------------------------------------
                | TAG
                |--------------------------------------------------------------------------
                */

                $q->orWhereHas('tags', function ($q) use ($search) {
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
        |
        | Archive -> Sub Kegiatan -> Kegiatan -> Program
        |
        */

        if ($request->filled('program')) {
            $programId = $request->input('program');

            $query->whereHas('subKegiatan.kegiatan.program', function ($q) use ($programId) {
                $q->where('program_id', $programId);
            });
        }

        /*
        |--------------------------------------------------------------------------
        | FILTER KEGIATAN
        |--------------------------------------------------------------------------
        |
        | Archive -> Sub Kegiatan -> Kegiatan
        |
        */

        if ($request->filled('kegiatan')) {
            $kegiatanId = $request->input('kegiatan');

            $query->whereHas('subKegiatan.kegiatan', function ($q) use ($kegiatanId) {
                $q->where('kegiatan_id', $kegiatanId);
            });
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
        | Tag sekarang langsung berelasi dengan Archive.
        |
        */

        if ($request->filled('tag')) {
            $tagId = $request->input('tag');

            $query->whereHas('tags', function ($q) use ($tagId) {
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
        | Soft delete:
        | archive_deleted_at
        |
        | di-handle oleh model SadarinArchive.
        |
        */

        $archives = $query->orderByDesc('archive_created_at')->paginate(12)->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::user(action: 'archive.index');

        /*
        |--------------------------------------------------------------------------
        | DATA FILTER - UNIT
        |--------------------------------------------------------------------------
        */

        $units = SadarinUnit::query()->orderBy('unit_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FILTER - PROGRAM
        |--------------------------------------------------------------------------
        */

        $programs = SadarinProgram::query()->orderBy('program_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FILTER - KEGIATAN
        |--------------------------------------------------------------------------
        */

        $kegiatans = SadarinKegiatan::query()->orderBy('kegiatan_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FILTER - SUB KEGIATAN
        |--------------------------------------------------------------------------
        */

        $subKegiatans = SadarinSubKegiatan::query()->orderBy('sub_kegiatan_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FILTER - JENIS DOKUMEN
        |--------------------------------------------------------------------------
        */

        $documentTypes = SadarinDocumentType::query()->where('document_type_is_active', true)->orderBy('document_type_name')->get();

        /*
        |--------------------------------------------------------------------------
        | DATA FILTER - TAG
        |--------------------------------------------------------------------------
        */

        $tags = SadarinTag::query()->orderBy('tag_name')->get();

        /*
        |--------------------------------------------------------------------------
        | SELECTED UNIT
        |--------------------------------------------------------------------------
        */

        $selectedUnit = null;

        if ($request->filled('unit')) {
            $selectedUnit = SadarinUnit::find($request->input('unit'));
        }

        /*
        |--------------------------------------------------------------------------
        | SELECTED PROGRAM
        |--------------------------------------------------------------------------
        */

        $selectedProgram = null;

        if ($request->filled('program')) {
            $selectedProgram = SadarinProgram::find($request->input('program'));
        }

        /*
        |--------------------------------------------------------------------------
        | SELECTED KEGIATAN
        |--------------------------------------------------------------------------
        */

        $selectedKegiatan = null;

        if ($request->filled('kegiatan')) {
            $selectedKegiatan = SadarinKegiatan::find($request->input('kegiatan'));
        }

        /*
        |--------------------------------------------------------------------------
        | SELECTED SUB KEGIATAN
        |--------------------------------------------------------------------------
        */

        $selectedSubKegiatan = null;

        if ($request->filled('sub_kegiatan')) {
            $selectedSubKegiatan = SadarinSubKegiatan::find($request->input('sub_kegiatan'));
        }

        /*
        |--------------------------------------------------------------------------
        | SELECTED DOCUMENT TYPE
        |--------------------------------------------------------------------------
        */

        $selectedDocumentType = null;

        if ($request->filled('document_type')) {
            $selectedDocumentType = SadarinDocumentType::find($request->input('document_type'));
        }

        /*
        |--------------------------------------------------------------------------
        | SELECTED TAG
        |--------------------------------------------------------------------------
        */

        $selectedTag = null;

        if ($request->filled('tag')) {
            $selectedTag = SadarinTag::find($request->input('tag'));
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
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

    /**
     * ================================================================
     * DETAIL / ISI ARSIP
     * ================================================================
     *
     * Archive
     *   └── Sub Kegiatan
     *          └── Kegiatan
     *                 └── Program
     *
     * Google Drive:
     * - Folder utama diambil dari archive_drive_folder_id
     * - Folder dapat dibuka bertingkat menggunakan ?folder=
     * - Isi folder dibaca langsung menggunakan Google Drive API
     * - Tidak menggunakan SadarinGoogleDriveService
     * - Tidak menggunakan SadarinArchiveFile
     */
    public function showArchive(Request $request, $archiveId)
    {
        /*
    |--------------------------------------------------------------------------
    | ARSIP
    |--------------------------------------------------------------------------
    */

        $archive = SadarinArchive::query()
            ->with(['unit', 'documentType', 'subKegiatan.kegiatan.program', 'tags'])
            ->findOrFail($archiveId);

        /*
    |--------------------------------------------------------------------------
    | ROOT DRIVE
    |--------------------------------------------------------------------------
    |
    | archive_drive_folder_id dapat berisi:
    |
    | 1. ID folder
    | 2. URL folder
    | 3. ID file
    | 4. URL file
    |
    */

        $rootValue = trim((string) $archive->archive_drive_folder_id);

        /*
    |--------------------------------------------------------------------------
    | EXTRACT GOOGLE DRIVE ID
    |--------------------------------------------------------------------------
    */

        $rootFolderId = $rootValue;

        if (filter_var($rootValue, FILTER_VALIDATE_URL)) {
            $parsedUrl = parse_url($rootValue);

            $path = $parsedUrl['path'] ?? '';

            /*
        | /file/d/ID/view
        */

            if (preg_match('#/file/d/([^/]+)#', $path, $matches)) {
                $rootFolderId = $matches[1];
            }
            /*
        | /folders/ID
        */ elseif (preg_match('#/folders/([^/]+)#', $path, $matches)) {
                $rootFolderId = $matches[1];
            }
            /*
        | ?id=ID
        */ elseif (!empty($parsedUrl['query'])) {
                parse_str($parsedUrl['query'], $query);

                if (!empty($query['id'])) {
                    $rootFolderId = $query['id'];
                }
            }
        }

        $rootFolderId = trim((string) $rootFolderId);

        /*
    |--------------------------------------------------------------------------
    | FOLDER YANG SEDANG DIBUKA
    |--------------------------------------------------------------------------
    */

        $hasFolderParameter = $request->filled('folder');

        $currentFolderId = trim($request->query('folder', $rootFolderId));

        /*
    |--------------------------------------------------------------------------
    | DEFAULT
    |--------------------------------------------------------------------------
    */

        $driveFile = null;

        $driveFiles = collect();

        $driveError = null;

        $currentFolderName = $archive->archive_title;

        $currentFolderUrl = $archive->archive_drive_url;

        $currentFolderParents = [];

        /*
    |--------------------------------------------------------------------------
    | URL HALAMAN ARSIP
    |--------------------------------------------------------------------------
    */

        $archiveDriveUrl = route('sadarin.user.archive.show', $archive->archive_id);

        /*
    |--------------------------------------------------------------------------
    | DRIVE BELUM TERSEDIA
    |--------------------------------------------------------------------------
    */

        if ($rootFolderId === '') {
            SadarinAccessLogService::user(action: 'archive.files.view', archiveId: $archive->archive_id, objectType: 'archive', objectId: $archive->archive_id);

            return view('UserPage.show', [
                'archive' => $archive,

                'driveFile' => null,

                'driveFiles' => collect(),

                'rootFolderId' => null,

                'currentFolderId' => null,

                'currentFolderName' => $archive->archive_title,

                'currentFolderUrl' => $archive->archive_drive_url,

                'currentFolderParents' => [],

                'archiveDriveUrl' => $archiveDriveUrl,

                'driveError' => 'Berkas Google Drive belum tersedia pada arsip ini.',
            ]);
        }

        /*
    |--------------------------------------------------------------------------
    | ACCESS LOG
    |--------------------------------------------------------------------------
    */

        if (!$hasFolderParameter) {
            SadarinAccessLogService::user(action: 'archive.files.view', archiveId: $archive->archive_id, objectType: 'archive', objectId: $archive->archive_id);
        } else {
            SadarinAccessLogService::user(action: 'folder.view', archiveId: $archive->archive_id, objectType: 'drive_folder', objectId: $currentFolderId);
        }

        /*
    |--------------------------------------------------------------------------
    | GOOGLE DRIVE CLIENT
    |--------------------------------------------------------------------------
    */

        try {
            /*
        |--------------------------------------------------------------------------
        | CLIENT
        |--------------------------------------------------------------------------
        */

            $client = new Client();

            $client->setApplicationName('SADARIN');

            /*
        |--------------------------------------------------------------------------
        | CREDENTIAL
        |--------------------------------------------------------------------------
        */

            $client->setAuthConfig(config('services.google_drive.credentials'));

            /*
        |--------------------------------------------------------------------------
        | READ ONLY
        |--------------------------------------------------------------------------
        */

            $client->addScope(Drive::DRIVE_READONLY);

            /*
        |--------------------------------------------------------------------------
        | SERVICE
        |--------------------------------------------------------------------------
        */

            $service = new Drive($client);

            /*
        |--------------------------------------------------------------------------
        | AMBIL OBJECT GOOGLE DRIVE
        |--------------------------------------------------------------------------
        */

            $currentObject = $service->files->get($currentFolderId, [
                'fields' => 'id,name,mimeType,size,modifiedTime,webViewLink,parents',
            ]);

            /*
        |--------------------------------------------------------------------------
        | CEK APAKAH FOLDER
        |--------------------------------------------------------------------------
        */

            $isFolder = $currentObject->getMimeType() === 'application/vnd.google-apps.folder';

            /*
        |--------------------------------------------------------------------------
        | JIKA FILE
        |--------------------------------------------------------------------------
        |
        | Root arsip ternyata langsung menunjuk ke file.
        |
        */

            if (!$isFolder) {
                /*
            | File hanya boleh muncul sebagai
            | root arsip, bukan sebagai ?folder=
            */

                if ($hasFolderParameter) {
                    throw new \RuntimeException('Objek Google Drive yang diminta bukan folder.');
                }

                /*
            |--------------------------------------------------------------------------
            | SIMPAN FILE
            |--------------------------------------------------------------------------
            */

                $driveFile = $currentObject;

                /*
            |--------------------------------------------------------------------------
            | NAMA FILE
            |--------------------------------------------------------------------------
            */

                $currentFolderName = $currentObject->getName() ?: $archive->archive_title;

                /*
            |--------------------------------------------------------------------------
            | URL FILE
            |--------------------------------------------------------------------------
            */

                $currentFolderUrl = $currentObject->getWebViewLink();

                /*
            |--------------------------------------------------------------------------
            | TIDAK ADA CHILD FILE
            |--------------------------------------------------------------------------
            */

                $driveFiles = collect();
            } else {
                /*
            |--------------------------------------------------------------------------
            | FOLDER
            |--------------------------------------------------------------------------
            */

                $currentFolderName = $currentObject->getName() ?: $archive->archive_title;

                /*
            |--------------------------------------------------------------------------
            | LINK FOLDER
            |--------------------------------------------------------------------------
            */

                $currentFolderUrl = $currentObject->getWebViewLink();

                /*
            |--------------------------------------------------------------------------
            | PARENT FOLDER
            |--------------------------------------------------------------------------
            */

                $currentFolderParents = $currentObject->getParents() ?? [];

                /*
            |--------------------------------------------------------------------------
            | BACA ISI FOLDER
            |--------------------------------------------------------------------------
            */

                $response = $service->files->listFiles([
                    'q' => "'" . $currentFolderId . "' in parents and trashed = false",

                    'pageSize' => 1000,

                    'fields' => 'files(id,name,mimeType,size,modifiedTime,webViewLink,parents)',

                    'orderBy' => 'folder,name',
                ]);

                /*
            |--------------------------------------------------------------------------
            | COLLECTION
            |--------------------------------------------------------------------------
            */

                $driveFiles = collect($response->getFiles());
            }

            /*
        |--------------------------------------------------------------------------
        | BERHASIL
        |--------------------------------------------------------------------------
        */

            $driveError = null;
        } catch (\Throwable $e) {
            /*
        |--------------------------------------------------------------------------
        | ERROR
        |--------------------------------------------------------------------------
        */

            report($e);

            $driveFile = null;

            $driveFiles = collect();

            $driveError = 'Google Drive tidak dapat dibaca. ' . $e->getMessage();
        }

        /*
    |--------------------------------------------------------------------------
    | RETURN
    |--------------------------------------------------------------------------
    */

        return view('UserPage.show', [
            'archive' => $archive,

            /*
        | Jika root adalah file,
        | object Google Drive masuk ke sini.
        */

            'driveFile' => $driveFile,

            /*
        | Jika root adalah folder,
        | isi folder masuk ke sini.
        */

            'driveFiles' => $driveFiles,

            'rootFolderId' => $rootFolderId,

            'currentFolderId' => $currentFolderId,

            'currentFolderName' => $currentFolderName,

            'currentFolderUrl' => $currentFolderUrl,

            'currentFolderParents' => $currentFolderParents,

            'archiveDriveUrl' => $archiveDriveUrl,

            'driveError' => $driveError,
        ]);
    }
    /**
     * ================================================================
     * OPEN DRIVE
     * ================================================================
     */
    public function openDrive(Request $request, $archiveId)
    {
        $archive = SadarinArchive::findOrFail($archiveId);

        $url = $request->input('url');

        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            abort(404);
        }

        $host = parse_url($url, PHP_URL_HOST);

        $allowedHosts = ['drive.google.com', 'docs.google.com', 'sheets.google.com', 'slides.google.com'];

        if (!in_array($host, $allowedHosts, true)) {
            abort(403);
        }

        $objectType = $request->input('object_type', 'drive_file');
        $objectId = $request->input('object_id');
        $action = $request->input('action', 'open_drive');

        SadarinAccessLogService::user(action: $action, archiveId: $archive->archive_id, objectType: $objectType, objectId: $objectId);

        return redirect()->away($url);
    }
}
