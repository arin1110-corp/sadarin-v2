<?php

namespace App\Http\Controllers\Homepage;

use App\Http\Controllers\Controller;
use App\Models\SadarinArchive;
use App\Models\SadarinArchiveFile;
use App\Services\SadarinAccessLogService;
use Google\Client;
use Google\Service\Drive;
use Illuminate\Http\Request;

class SadarinDriveController extends Controller
{
    /**
     * ================================================================
     * GOOGLE DRIVE BROWSER
     * ================================================================
     */
    public function index(Request $request, $archiveId)
    {
        /*
        |--------------------------------------------------------------------------
        | ARSIP
        |--------------------------------------------------------------------------
        */

        $archive = SadarinArchive::query()
            ->with(['unit', 'program', 'kegiatan', 'subKegiatan', 'documentType'])
            ->findOrFail($archiveId);

        /*
        |--------------------------------------------------------------------------
        | CARI RECORD DRIVE
        |--------------------------------------------------------------------------
        */

        $driveFile = SadarinArchiveFile::query()->where('archive_file_archive_id', $archive->archive_id)->whereNotNull('archive_file_drive_file_id')->where('archive_file_drive_file_id', '!=', '')->orderByDesc('archive_file_is_primary')->first();

        /*
        |--------------------------------------------------------------------------
        | DEFAULT
        |--------------------------------------------------------------------------
        */

        $driveFiles = collect();

        $driveError = null;

        $rootFolderId = null;

        $currentFolderId = null;

        $currentFolderName = 'Isi Folder';

        $currentFolderUrl = null;

        $currentFolderParents = [];

        /*
        |--------------------------------------------------------------------------
        | URL HALAMAN DRIVE
        |--------------------------------------------------------------------------
        */

        $archiveDriveUrl = route('sadarin.user.archive.files', $archive->archive_id);

        /*
        |--------------------------------------------------------------------------
        | JIKA DRIVE BELUM ADA
        |--------------------------------------------------------------------------
        */

        if (!$driveFile) {
            /*
            |--------------------------------------------------------------------------
            | LOG - DRIVE TIDAK TERSEDIA
            |--------------------------------------------------------------------------
            */

            SadarinAccessLogService::user(action: 'archive.files.view', archiveId: $archive->archive_id, objectType: 'archive', objectId: $archive->archive_id);

            return view('UserPage.archive-files', [
                'archive' => $archive,

                'driveFile' => null,

                'driveFiles' => collect(),

                'rootFolderId' => null,

                'currentFolderId' => null,

                'currentFolderName' => 'Isi Folder',

                'currentFolderUrl' => null,

                'currentFolderParents' => [],

                'archiveDriveUrl' => $archiveDriveUrl,

                'driveError' => 'Folder Google Drive belum tersedia pada arsip ini.',
            ]);
        }

        /*
        |--------------------------------------------------------------------------
        | ROOT FOLDER
        |--------------------------------------------------------------------------
        */

        $rootFolderId = trim($driveFile->archive_file_drive_file_id);

        /*
        |--------------------------------------------------------------------------
        | FOLDER YANG SEDANG DIBUKA
        |--------------------------------------------------------------------------
        */

        $hasFolderParameter = $request->filled('folder');

        $currentFolderId = trim($request->query('folder', $rootFolderId));

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        |
        | Tanpa parameter folder:
        |
        |     user membuka isi arsip
        |
        | Dengan parameter folder:
        |
        |     user membuka folder di dalam arsip
        |
        */

        if (!$hasFolderParameter) {
            SadarinAccessLogService::user(action: 'archive.files.view', archiveId: $archive->archive_id, objectType: 'archive', objectId: $archive->archive_id);
        } else {
            SadarinAccessLogService::user(action: 'folder.view', archiveId: $archive->archive_id, objectType: 'drive_folder', objectId: null);
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
            | INFORMASI FOLDER
            |--------------------------------------------------------------------------
            */

            $currentFolder = $service->files->get($currentFolderId, [
                'fields' => 'id,name,mimeType,webViewLink,parents',
            ]);

            /*
            |--------------------------------------------------------------------------
            | NAMA FOLDER
            |--------------------------------------------------------------------------
            */

            $currentFolderName = $currentFolder->getName() ?: 'Isi Folder';

            /*
            |--------------------------------------------------------------------------
            | LINK FOLDER
            |--------------------------------------------------------------------------
            */

            $currentFolderUrl = $currentFolder->getWebViewLink();

            /*
            |--------------------------------------------------------------------------
            | PARENT
            |--------------------------------------------------------------------------
            */

            $currentFolderParents = $currentFolder->getParents() ?? [];

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

            $driveFiles = collect();

            $driveError = 'Folder Google Drive tidak dapat dibaca. ' . $e->getMessage();
        }

        /*
        |--------------------------------------------------------------------------
        | RETURN
        |--------------------------------------------------------------------------
        */

        return view('UserPage.archive-files', [
            'archive' => $archive,

            'driveFile' => $driveFile,

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
     *
     * Semua klik "Buka di Google Drive" dicatat terlebih dahulu.
     */
    public function openDrive(Request $request, $archiveId)
    {
        /*
        |--------------------------------------------------------------------------
        | ARSIP
        |--------------------------------------------------------------------------
        */

        $archive = SadarinArchive::findOrFail($archiveId);

        /*
        |--------------------------------------------------------------------------
        | URL
        |--------------------------------------------------------------------------
        */

        $url = $request->input('url');

        /*
        |--------------------------------------------------------------------------
        | VALIDASI URL
        |--------------------------------------------------------------------------
        */

        if (!$url || !filter_var($url, FILTER_VALIDATE_URL)) {
            abort(404);
        }

        /*
        |--------------------------------------------------------------------------
        | CEGAH URL SEMBARANG
        |--------------------------------------------------------------------------
        */

        $host = parse_url($url, PHP_URL_HOST);

        $allowedHosts = ['drive.google.com', 'docs.google.com', 'sheets.google.com', 'slides.google.com'];

        if (!in_array($host, $allowedHosts, true)) {
            abort(403);
        }

        /*
        |--------------------------------------------------------------------------
        | DATA OBJEK
        |--------------------------------------------------------------------------
        */

        $objectType = $request->input('object_type', 'drive_file');

        $objectId = $request->input('object_id');

        $action = $request->input('action', 'open_drive');

        /*
        |--------------------------------------------------------------------------
        | ACCESS LOG
        |--------------------------------------------------------------------------
        */

        SadarinAccessLogService::user(action: $action, archiveId: $archive->archive_id, objectType: $objectType, objectId: $objectId);

        /*
        |--------------------------------------------------------------------------
        | REDIRECT GOOGLE DRIVE
        |--------------------------------------------------------------------------
        */

        return redirect()->away($url);
    }
}