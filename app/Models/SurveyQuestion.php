<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SurveyQuestion extends Model
{
    // Table name
   // protected $table = 'survey_questions';
    // Primary Key
    //public $primaryKey = 'id';
    // Timestamps

    use HasFactory;

    protected $fillable = ['question', 'data', 'type', 'survey_id', 'description'];

    public function survey() {
        return $this->belongsTo(Survey::class);
    }
}
