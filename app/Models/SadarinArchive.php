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

    protected $fillable = [
        // Identitas
        'archive_uid',
        'archive_title',
        'archive_description',

        // Klasifikasi
        'archive_unit_id',
        'archive_program_id',
        'archive_kegiatan_id',
        'archive_sub_kegiatan_id',
        'archive_document_type_id',

        // Informasi
        'archive_date',
        'archive_year',

        // Hak Akses
        'archive_access_level',

        // Status
        'archive_status',

        // User
        'archive_created_by',
        'archive_updated_by',
    ];

    protected $casts = [
        'archive_date' => 'date',
        'archive_year' => 'integer',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    public function files()
    {
        return $this->hasMany(SadarinArchiveFile::class, 'archive_file_archive_id', 'archive_id');
    }

    public function tags()
    {
        return $this->hasMany(SadarinArchiveTag::class, 'archive_tag_archive_id', 'archive_id');
    }

    public function unit()
    {
        return $this->belongsTo(SadarinUnit::class, 'archive_unit_id', 'unit_id');
    }

    public function program()
    {
        return $this->belongsTo(SadarinProgram::class, 'archive_program_id', 'program_id');
    }

    public function kegiatan()
    {
        return $this->belongsTo(SadarinKegiatan::class, 'archive_kegiatan_id', 'kegiatan_id');
    }

    public function subKegiatan()
    {
        return $this->belongsTo(SadarinSubKegiatan::class, 'archive_sub_kegiatan_id', 'sub_kegiatan_id');
    }

    public function documentType()
    {
        return $this->belongsTo(SadarinDocumentType::class, 'archive_document_type_id', 'document_type_id');
    }
}