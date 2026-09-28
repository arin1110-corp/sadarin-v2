<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SadarinOtp extends Model
{
    protected $table = 'sadarin_otp';

    protected $primaryKey = 'otp_id';

    public $timestamps = false;

    protected $fillable = ['otp_uid', 'otp_identifier', 'otp_type', 'otp_code_hash', 'otp_expires_at', 'otp_sent_at', 'otp_verified_at', 'otp_last_attempt_at', 'otp_attempt_count', 'otp_locked_until', 'otp_ip_address', 'otp_user_agent', 'otp_created_at', 'otp_updated_at'];

    protected $casts = [
        'otp_expires_at' => 'datetime',
        'otp_sent_at' => 'datetime',
        'otp_verified_at' => 'datetime',
        'otp_last_attempt_at' => 'datetime',
        'otp_locked_until' => 'datetime',
        'otp_created_at' => 'datetime',
        'otp_updated_at' => 'datetime',
    ];
}