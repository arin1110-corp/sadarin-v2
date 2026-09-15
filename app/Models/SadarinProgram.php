<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinProgram extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_program';

    protected $primaryKey = 'program_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'program_created_at';
    const UPDATED_AT = 'program_updated_at';

    protected $fillable = ['program_uid', 'program_code', 'program_name', 'program_description', 'program_is_active'];

    protected $casts = [
        'program_is_active' => 'boolean',
    ];
}