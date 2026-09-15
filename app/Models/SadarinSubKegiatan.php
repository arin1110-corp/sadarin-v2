<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinSubKegiatan extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_sub_kegiatan';

    protected $primaryKey = 'sub_kegiatan_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'sub_kegiatan_created_at';
    const UPDATED_AT = 'sub_kegiatan_updated_at';

    protected $fillable = ['sub_kegiatan_uid', 'sub_kegiatan_kegiatan_id', 'sub_kegiatan_code', 'sub_kegiatan_name', 'sub_kegiatan_description', 'sub_kegiatan_is_active'];

    protected $casts = [
        'sub_kegiatan_is_active' => 'boolean',
    ];
}