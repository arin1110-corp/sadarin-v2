<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinArchiveTag extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_archive_tag';

    protected $primaryKey = 'archive_tag_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'archive_tag_created_at';

    const UPDATED_AT = 'archive_tag_updated_at';

    protected $fillable = ['archive_tag_uid', 'archive_tag_archive_id', 'archive_tag_tag_id'];

    /*
    |--------------------------------------------------------------------------
    | ARCHIVE
    |--------------------------------------------------------------------------
    */

    public function archive()
    {
        return $this->belongsTo(SadarinArchive::class, 'archive_tag_archive_id', 'archive_id');
    }

    /*
    |--------------------------------------------------------------------------
    | TAG
    |--------------------------------------------------------------------------
    */

    public function tag()
    {
        return $this->belongsTo(SadarinTag::class, 'archive_tag_tag_id', 'tag_id');
    }
}