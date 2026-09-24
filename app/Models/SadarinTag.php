<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SadarinTag extends Model
{
    protected $table = 'sadarin_tag';

    protected $primaryKey = 'tag_id';

    public $timestamps = false;

    protected $fillable = ['tag_name'];

    /**
     * ============================================================
     * FILE YANG MENGGUNAKAN TAG INI
     * ============================================================
     */
    public function files()
    {
        return $this->belongsToMany(SadarinArchiveFile::class, 'sadarin_archive_file_tag', 'archive_file_tag_tag_id', 'archive_file_id', 'tag_id', 'archive_file_id');
    }
}