<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinSetting extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_setting';

    protected $primaryKey = 'setting_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'setting_created_at';
    const UPDATED_AT = 'setting_updated_at';

    protected $fillable = ['setting_uid', 'setting_key', 'setting_value', 'setting_type', 'setting_description'];
}