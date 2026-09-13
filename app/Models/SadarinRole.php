<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinRole extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_role';

    protected $primaryKey = 'role_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'role_created_at';
    const UPDATED_AT = 'role_updated_at';

    protected $fillable = ['role_uid', 'role_name', 'role_description', 'role_is_active'];

    protected $casts = [
        'role_is_active' => 'boolean',
    ];
}