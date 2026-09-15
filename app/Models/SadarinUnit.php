<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinUnit extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_unit';

    protected $primaryKey = 'unit_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'unit_created_at';
    const UPDATED_AT = 'unit_updated_at';

    protected $fillable = ['unit_uid', 'unit_type', 'unit_code', 'unit_name', 'unit_description', 'unit_is_active'];

    protected $casts = [
        'unit_is_active' => 'boolean',
    ];
}