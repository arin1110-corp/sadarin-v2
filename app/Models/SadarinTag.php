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
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function archiveTags()
    {
        return $this->hasMany(SadarinArchiveTag::class, 'archive_tag_tag_id', 'tag_id');
    }
}