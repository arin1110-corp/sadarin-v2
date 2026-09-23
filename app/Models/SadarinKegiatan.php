<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinKegiatan extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_kegiatan';

    protected $primaryKey = 'kegiatan_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'kegiatan_created_at';

    const UPDATED_AT = 'kegiatan_updated_at';

    protected $fillable = ['kegiatan_uid', 'kegiatan_program_id', 'kegiatan_code', 'kegiatan_name', 'kegiatan_description', 'kegiatan_is_active'];

    protected $casts = [
        'kegiatan_is_active' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function program()
    {
        return $this->belongsTo(SadarinProgram::class, 'kegiatan_program_id', 'program_id');
    }

    public function archives()
    {
        return $this->hasMany(SadarinArchive::class, 'archive_kegiatan_id', 'kegiatan_id');
    }

    public function subKegiatans()
    {
        return $this->hasMany(SadarinSubKegiatan::class, 'sub_kegiatan_kegiatan_id', 'kegiatan_id');
    }
}