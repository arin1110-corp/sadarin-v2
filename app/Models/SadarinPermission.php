<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinPermission extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_permission';

    protected $primaryKey = 'permission_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'permission_created_at';
    const UPDATED_AT = 'permission_updated_at';

    protected $fillable = ['permission_uid', 'permission_name', 'permission_label', 'permission_description', 'permission_is_active'];

    protected $casts = [
        'permission_is_active' => 'boolean',
    ];
}