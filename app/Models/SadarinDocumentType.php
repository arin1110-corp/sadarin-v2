<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinDocumentType extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_document_type';

    protected $primaryKey = 'document_type_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'document_type_created_at';
    const UPDATED_AT = 'document_type_updated_at';

    protected $fillable = ['document_type_uid', 'document_type_name', 'document_type_description', 'document_type_is_active'];

    protected $casts = [
        'document_type_is_active' => 'boolean',
    ];
}