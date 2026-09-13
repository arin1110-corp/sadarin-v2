<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SadarinArchive extends Model
{
    use SadarinUid, SoftDeletes;

    protected $table = 'sadarin_archive';

    protected $primaryKey = 'archive_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'archive_created_at';
    const UPDATED_AT = 'archive_updated_at';
    const DELETED_AT = 'archive_deleted_at';

    protected $fillable = ['archive_uid', 'archive_title', 'archive_description', 'archive_document_type_id', 'archive_date', 'archive_year', 'archive_access_level', 'archive_status', 'archive_created_by', 'archive_updated_by'];

    protected $casts = [
        'archive_date' => 'date',
        'archive_year' => 'integer',
    ];
}