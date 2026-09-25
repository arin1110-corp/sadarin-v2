<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinArchive extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_archive';

    protected $primaryKey = 'archive_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'archive_created_at';

    const UPDATED_AT = 'archive_updated_at';

    protected $fillable = [
        // ============================================================
        // IDENTITAS
        // ============================================================

        'archive_uid',

        // ============================================================
        // PEMILIK / PENGAJU
        // ============================================================

        'archive_user_id',

        // ============================================================
        // KLASIFIKASI
        // ============================================================

        'archive_unit_id',
        'archive_sub_kegiatan_id',
        'archive_document_type_id',

        // ============================================================
        // INFORMASI ARSIP
        // ============================================================

        'archive_title',
        'archive_description',
        'archive_year',

        // ============================================================
        // LINK GOOGLE DRIVE
        // ============================================================

        'archive_drive_url',
        'archive_drive_folder_id',

        // ============================================================
        // HAK AKSES
        // ============================================================

        'archive_access_level',

        // ============================================================
        // STATUS
        // ============================================================

        'archive_status',
        'archive_rejection_reason',
    ];

    protected $casts = [
        'archive_year' => 'integer',
        'archive_created_at' => 'datetime',
        'archive_updated_at' => 'datetime',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIPS
    |--------------------------------------------------------------------------
    */

    /*
    |--------------------------------------------------------------------------
    | UNIT
    |--------------------------------------------------------------------------
    */

    public function unit()
    {
        return $this->belongsTo(SadarinUnit::class, 'archive_unit_id', 'unit_id');
    }

    /*
    |--------------------------------------------------------------------------
    | SUB KEGIATAN
    |--------------------------------------------------------------------------
    */

    public function subKegiatan()
    {
        return $this->belongsTo(SadarinSubKegiatan::class, 'archive_sub_kegiatan_id', 'sub_kegiatan_id');
    }

    /*
    |--------------------------------------------------------------------------
    | JENIS DOKUMEN
    |--------------------------------------------------------------------------
    */

    public function documentType()
    {
        return $this->belongsTo(SadarinDocumentType::class, 'archive_document_type_id', 'document_type_id');
    }

    /*
    |--------------------------------------------------------------------------
    | TAGS
    |--------------------------------------------------------------------------
    */

    public function tags()
    {
        return $this->belongsToMany(SadarinTag::class, 'sadarin_archive_tag', 'archive_id', 'tag_id');
    }
}