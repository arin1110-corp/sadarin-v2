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

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function archives()
    {
        return $this->hasMany(SadarinArchive::class, 'archive_program_id', 'program_id');
    }

    public function kegiatans()
    {
        return $this->hasMany(SadarinKegiatan::class, 'kegiatan_program_id', 'program_id');
    }
}