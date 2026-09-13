<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinGuestbook extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_guestbook';

    protected $primaryKey = 'guestbook_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'guestbook_created_at';
    const UPDATED_AT = 'guestbook_updated_at';

    protected $fillable = ['guestbook_uid', 'guestbook_name', 'guestbook_email', 'guestbook_organization', 'guestbook_phone', 'guestbook_purpose'];
}