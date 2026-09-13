<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SadarinUserRole extends Model
{
    protected $table = 'sadarin_user_role';

    protected $primaryKey = 'user_role_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'user_role_created_at';
    const UPDATED_AT = 'user_role_updated_at';

    protected $fillable = ['user_role_samperin_user_id', 'user_role_role_id'];
}