<?php

namespace App\Models;

use App\Traits\SadarinUid;
use Illuminate\Database\Eloquent\Model;

class SadarinSurvey extends Model
{
    use SadarinUid;

    protected $table = 'sadarin_survey';

    protected $primaryKey = 'survey_id';

    public $incrementing = true;

    protected $keyType = 'int';

    const CREATED_AT = 'survey_created_at';
    const UPDATED_AT = 'survey_updated_at';

    protected $fillable = ['survey_uid', 'survey_title', 'survey_description', 'survey_is_active', 'survey_started_at', 'survey_ended_at'];

    protected $casts = [
        'survey_is_active' => 'boolean',
        'survey_started_at' => 'datetime',
        'survey_ended_at' => 'datetime',
    ];

    public function responses()
    {
        return $this->hasMany(
            SadarinSurveyResponse::class,
            'survey_response_survey_id',
            'survey_id'
        );
    }
}