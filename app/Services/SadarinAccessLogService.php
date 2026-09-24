<?php

namespace App\Services;

use App\Models\SadarinAccessLog;

class SadarinAccessLogService
{
    /**
     * ================================================================
     * LOG ACCESS
     * ================================================================
     */
    public static function log(string $action, ?int $archiveId = null, ?string $userType = null, ?int $samperinUserId = null, ?int $guestbookId = null, ?string $objectType = null, ?string $objectId = null): SadarinAccessLog
    {
        return SadarinAccessLog::create([
            'access_log_object_type' => $objectType,

            'access_log_object_id' => $objectId,

            'access_log_archive_id' => $archiveId,

            'access_log_user_type' => self::normalizeUserType($userType),

            'access_log_samperin_user_id' => $samperinUserId,

            'access_log_guestbook_id' => $guestbookId,

            'access_log_action' => $action,

            'access_log_ip_address' => request()->ip(),

            'access_log_user_agent' => request()->userAgent(),

            'access_log_created_at' => now(),
        ]);
    }

    /**
     * ================================================================
     * NORMALISASI USER TYPE
     * ================================================================
     */
    private static function normalizeUserType(?string $userType): ?string
    {
        if (!$userType) {
            return null;
        }

        return match (strtolower(trim($userType))) {
            'administrator', 'admin' => 'admin',

            'arsiparis' => 'arsiparis',

            'pengguna internal', 'pengguna', 'user' => 'user',

            'guest' => 'guest',

            default => $userType,
        };
    }

    /**
     * ================================================================
     * LOG USER INTERNAL
     * ================================================================
     */
    public static function user(string $action, ?int $archiveId = null, ?string $objectType = null, ?string $objectId = null): SadarinAccessLog
    {
        return self::log(
            action: $action,

            archiveId: $archiveId,

            userType: session('sadarin_role_name'),

            samperinUserId: session('sadarin_user_id'),

            objectType: $objectType,

            objectId: $objectId,
        );
    }

    /**
     * ================================================================
     * LOG GUEST
     * ================================================================
     */
    public static function guest(string $action, ?int $guestbookId = null, ?int $archiveId = null, ?string $objectType = null, ?string $objectId = null): SadarinAccessLog
    {
        return self::log(
            action: $action,

            archiveId: $archiveId,

            userType: 'guest',

            guestbookId: $guestbookId,

            objectType: $objectType,

            objectId: $objectId,
        );
    }
}