<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SadarinArchive extends Model
{
    use SadarinUid, SoftDeletes;

    /*
    |--------------------------------------------------------------------------
    | TABLE
    |--------------------------------------------------------------------------
    */

    protected $table = 'sadarin_archive';


    /*
    |--------------------------------------------------------------------------
    | PRIMARY KEY
    |--------------------------------------------------------------------------
    */

    protected $primaryKey = 'archive_id';

    public $incrementing = true;

    protected $keyType = 'int';


    /*
    |--------------------------------------------------------------------------
    | CUSTOM TIMESTAMPS
    |--------------------------------------------------------------------------
    */

    const CREATED_AT = 'archive_created_at';

    const UPDATED_AT = 'archive_updated_at';

    const DELETED_AT = 'archive_deleted_at';


    /*
    |--------------------------------------------------------------------------
    | FILLABLE
    |--------------------------------------------------------------------------
    */

    protected $fillable = [

        // Identitas Arsip
        'archive_uid',
        'archive_title',
        'archive_description',

        // Klasifikasi
        'archive_unit_id',
        'archive_program_id',
        'archive_kegiatan_id',
        'archive_sub_kegiatan_id',
        'archive_document_type_id',

        // Informasi Arsip
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


    /*
    |--------------------------------------------------------------------------
    | CASTS
    |--------------------------------------------------------------------------
    */

    protected $casts = [

        'archive_date' => 'date',

        'archive_year' => 'integer',

    ];
}