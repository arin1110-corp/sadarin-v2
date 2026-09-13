<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SadarinRolePermission extends Model
{
    protected $table = 'sadarin_role_permission';

    protected $primaryKey = 'role_permission_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'role_permission_created_at';
    const UPDATED_AT = 'role_permission_updated_at';

    protected $fillable = ['role_permission_role_id', 'role_permission_permission_id'];
}