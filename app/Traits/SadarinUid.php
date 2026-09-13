<?php

namespace App\Traits;

use Illuminate\Support\Str;

trait SadarinUid
{
    protected static function bootSadarinUid(): void
    {
        static::creating(function ($model) {
            $uidField = $model->getUidField();

            if ($uidField && empty($model->{$uidField})) {
                $model->{$uidField} = (string) Str::uuid();
            }
        });
    }

    public function getUidField(): ?string
    {
        $map = [
            'sadarin_role' => 'role_uid',
            'sadarin_permission' => 'permission_uid',
            'sadarin_document_type' => 'document_type_uid',
            'sadarin_tag' => 'tag_uid',
            'sadarin_archive' => 'archive_uid',
            'sadarin_archive_file' => 'archive_file_uid',
            'sadarin_otp' => 'otp_uid',
            'sadarin_guestbook' => 'guestbook_uid',
            'sadarin_session' => 'session_uid',
            'sadarin_access_log' => 'access_log_uid',
            'sadarin_survey' => 'survey_uid',
            'sadarin_survey_response' => 'survey_response_uid',
            'sadarin_setting' => 'setting_uid',
        ];

        return $map[$this->getTable()] ?? null;
    }
}