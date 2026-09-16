<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\SadarinAccessLog;
use App\Models\SadarinUnit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SadarinAccessLogController extends Controller
{
    public function index(Request $request)
    {
        /*
        |--------------------------------------------------------------------------
        | FILTER
        |--------------------------------------------------------------------------
        */

        $search = trim($request->search ?? '');
        $action = trim($request->action ?? '');
        $userType = trim($request->user_type ?? '');
        $objectType = trim($request->object_type ?? '');

        /*
        |--------------------------------------------------------------------------
        | QUERY ACCESS LOG
        |--------------------------------------------------------------------------
        */

        $logs = SadarinAccessLog::query()

            ->when($search, function ($query) use ($search) {
                $query->where(function ($q) use ($search) {
                    $q->where('access_log_action', 'like', "%{$search}%")

                        ->orWhere('access_log_ip_address', 'like', "%{$search}%")

                        ->orWhere('access_log_user_agent', 'like', "%{$search}%")

                        ->orWhere('access_log_samperin_user_id', 'like', "%{$search}%")

                        ->orWhere('access_log_object_type', 'like', "%{$search}%")

                        ->orWhere('access_log_object_id', 'like', "%{$search}%");
                });
            })

            ->when($action, function ($query) use ($action) {
                $query->where('access_log_action', $action);
            })

            ->when($userType, function ($query) use ($userType) {
                $query->where('access_log_user_type', $userType);
            })

            ->when($objectType, function ($query) use ($objectType) {
                $query->where('access_log_object_type', $objectType);
            })

            ->orderByDesc('access_log_created_at')

            ->paginate(25)

            ->withQueryString();

        /*
        |--------------------------------------------------------------------------
        | SAMPERIN API
        |--------------------------------------------------------------------------
        */

        $samperinApiUrl = rtrim(env('SAMPERIN_API_URL', ''), '/');

        /*
        |--------------------------------------------------------------------------
        | AMBIL NAMA PEGAWAI
        |--------------------------------------------------------------------------
        |
        | access_log_samperin_user_id
        | contoh: 1919
        |
        | API:
        | /api/pegawai/1919
        |
        */

        $userNames = [];

        if ($samperinApiUrl !== '') {
            $userIds = $logs
                ->getCollection()

                ->pluck('access_log_samperin_user_id')

                ->filter()

                ->unique()

                ->values();

            foreach ($userIds as $userId) {
                try {
                    $response = Http::timeout(5)
                        ->acceptJson()
                        ->get($samperinApiUrl . '/pegawai/' . (int) $userId);

                    if ($response->successful()) {
                        $data = $response->json('data');

                        if (is_array($data) && !empty($data['user_nama'])) {
                            $userNames[(int) $userId] = $data['user_nama'];
                        }
                    }
                } catch (\Throwable $e) {
                    // Abaikan jika API gagal.
                    // Access Log tetap tampil.
                }
            }
        }

        /*
        |--------------------------------------------------------------------------
        | AMBIL UNIT
        |--------------------------------------------------------------------------
        */

        $unitIds = $logs
            ->getCollection()

            ->where('access_log_object_type', 'unit')

            ->pluck('access_log_object_id')

            ->filter()

            ->unique()

            ->values();

        $units = collect();

        if ($unitIds->isNotEmpty()) {
            $units = SadarinUnit::query()

                ->whereIn('unit_id', $unitIds)

                ->get()

                ->keyBy('unit_id');
        }

        /*
        |--------------------------------------------------------------------------
        | TEMPEL NAMA KE LOG
        |--------------------------------------------------------------------------
        */

        $logs->getCollection()->transform(function ($log) use ($userNames, $units) {
            /*
                |--------------------------------------------------------------------------
                | USER NAME
                |--------------------------------------------------------------------------
                */

            $userId = (int) ($log->access_log_samperin_user_id ?? 0);

            $log->user_name = $userNames[$userId] ?? null;

            /*
                |--------------------------------------------------------------------------
                | OBJECT NAME
                |--------------------------------------------------------------------------
                */

            $log->object_name = null;

            /*
                |--------------------------------------------------------------------------
                | UNIT
                |--------------------------------------------------------------------------
                */

            if ($log->access_log_object_type === 'unit' && $log->access_log_object_id) {
                $unit = $units->get((int) $log->access_log_object_id);

                if ($unit) {
                    $log->object_name = $unit->unit_name;
                }
            }

            return $log;
        });

        /*
        |--------------------------------------------------------------------------
        | ACTION OPTIONS
        |--------------------------------------------------------------------------
        */

        $actions = SadarinAccessLog::query()

            ->whereNotNull('access_log_action')

            ->where('access_log_action', '<>', '')

            ->distinct()

            ->orderBy('access_log_action')

            ->pluck('access_log_action');

        /*
        |--------------------------------------------------------------------------
        | USER TYPE OPTIONS
        |--------------------------------------------------------------------------
        */

        $userTypes = [
            'guest' => 'Guest',

            'user' => 'Pengguna Internal',

            'admin' => 'Administrator',

            'arsiparis' => 'Arsiparis',
        ];

        /*
        |--------------------------------------------------------------------------
        | OBJECT TYPE OPTIONS
        |--------------------------------------------------------------------------
        */

        $objectTypes = [
            'role' => 'Role',

            'permission' => 'Permission',

            'unit' => 'Unit',

            'program' => 'Program',

            'kegiatan' => 'Kegiatan',

            'sub_kegiatan' => 'Sub Kegiatan',

            'document_type' => 'Jenis Dokumen',

            'tag' => 'Tag',

            'user' => 'Pengguna',

            'archive' => 'Arsip',

            'guestbook' => 'Guestbook',
        ];

        /*
        |--------------------------------------------------------------------------
        | RETURN VIEW
        |--------------------------------------------------------------------------
        */

        return view('admin.access-log.index', [
            'logs' => $logs,

            'search' => $search,

            'action' => $action,

            'userType' => $userType,

            'objectType' => $objectType,

            'actions' => $actions,

            'userTypes' => $userTypes,

            'objectTypes' => $objectTypes,
        ]);
    }
}