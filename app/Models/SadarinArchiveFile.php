<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SadarinArchiveFile extends Model
{
    use SadarinUid, SoftDeletes;

    protected $table = 'sadarin_archive_file';

    protected $primaryKey = 'archive_file_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'archive_file_created_at';

    const UPDATED_AT = 'archive_file_updated_at';

    const DELETED_AT = 'archive_file_deleted_at';

    protected $fillable = ['archive_file_uid', 'archive_file_archive_id', 'archive_file_original_name', 'archive_file_stored_name', 'archive_file_extension', 'archive_file_mime_type', 'archive_file_size', 'archive_file_drive_file_id', 'archive_file_drive_url', 'archive_file_is_primary'];

    protected $casts = [
        'archive_file_size' => 'integer',
        'archive_file_is_primary' => 'boolean',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    public function archive()
    {
        return $this->belongsTo(SadarinArchive::class, 'archive_file_archive_id', 'archive_id');
    }
}