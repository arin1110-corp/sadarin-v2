<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SadarinArchiveFileTag extends Model
{
    protected $table = 'sadarin_archive_file_tag';

    protected $primaryKey = 'archive_file_tag_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'archive_file_tag_created_at';

    const UPDATED_AT = 'archive_file_tag_updated_at';

    protected $fillable = ['archive_file_tag_archive_file_id', 'archive_file_tag_tag_id'];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function file()
    {
        return $this->belongsTo(SadarinArchiveFile::class, 'archive_file_tag_archive_file_id', 'archive_file_id');
    }

    public function tag()
    {
        return $this->belongsTo(SadarinTag::class, 'archive_file_tag_tag_id', 'tag_id');
    }
}