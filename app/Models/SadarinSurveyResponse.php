<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinSurveyResponse extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_survey_response';

    protected $primaryKey = 'survey_response_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'survey_response_created_at';
    const UPDATED_AT = 'survey_response_updated_at';

    protected $fillable = ['survey_response_uid', 'survey_response_survey_id', 'survey_response_guestbook_id', 'survey_response_samperin_user_id', 'survey_response_rating', 'survey_response_message'];

    protected $casts = [
        'survey_response_rating' => 'integer',
    ];
}