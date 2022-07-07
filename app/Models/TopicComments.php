<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TopicComments extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'topic_id', 'reply', 'comment_id', 'comment', 'status'];

    public function topic()
    {
        return $this->belongsTo(Topics::class);
    }
}
