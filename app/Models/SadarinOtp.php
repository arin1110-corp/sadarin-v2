<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinOtp extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_otp';

    protected $primaryKey = 'otp_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'otp_created_at';
    const UPDATED_AT = 'otp_updated_at';

    protected $fillable = ['otp_uid', 'otp_identifier', 'otp_type', 'otp_code_hash', 'otp_expires_at', 'otp_verified_at', 'otp_last_attempt_at', 'otp_attempt_count', 'otp_ip_address', 'otp_user_agent'];

    protected $casts = [
        'otp_expires_at' => 'datetime',
        'otp_verified_at' => 'datetime',
        'otp_last_attempt_at' => 'datetime',
        'otp_attempt_count' => 'integer',
    ];
}