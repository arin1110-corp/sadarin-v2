<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinSession extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_session';

    protected $primaryKey = 'session_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'session_created_at';
    const UPDATED_AT = 'session_updated_at';

    protected $fillable = ['session_uid', 'session_type', 'session_samperin_user_id', 'session_guestbook_id', 'session_token', 'session_expires_at', 'session_ip_address', 'session_user_agent'];

    protected $casts = [
        'session_expires_at' => 'datetime',
    ];
}