<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinAccessLog extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_access_log';

    protected $primaryKey = 'access_log_id';

    public $incrementing = true;

    protected $keyType = 'int';

    public $timestamps = false;

    protected $fillable = ['access_log_uid', 'access_log_object_type', 'access_log_object_id', 'access_log_archive_id', 'access_log_user_type', 'access_log_samperin_user_id', 'access_log_guestbook_id', 'access_log_action', 'access_log_ip_address', 'access_log_user_agent', 'access_log_created_at'];
    protected $casts = [
        'access_log_created_at' => 'datetime',
    ];
}