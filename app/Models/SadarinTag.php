<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinTag extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_tag';

    protected $primaryKey = 'tag_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'tag_created_at';
    const UPDATED_AT = 'tag_updated_at';

    protected $fillable = ['tag_uid', 'tag_name', 'tag_slug', 'tag_description', 'tag_is_active'];

    protected $casts = [
        'tag_is_active' => 'boolean',
        'tag_created_at' => 'datetime',
        'tag_updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | ARCHIVE
    |--------------------------------------------------------------------------
    |
    | Satu tag dapat digunakan oleh banyak archive.
    |
    */

    public function archives()
    {
        return $this->belongsToMany(SadarinArchive::class, 'sadarin_archive_tag', 'archive_tag_tag_id', 'archive_tag_archive_id', 'tag_id', 'archive_id')->withPivot(['archive_tag_id', 'archive_tag_uid', 'archive_tag_created_at', 'archive_tag_updated_at']);
    }
}