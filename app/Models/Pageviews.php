<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pageviews extends Model
{
    use HasFactory;

    protected $fillable = ['topic_id', 'views'];
}
