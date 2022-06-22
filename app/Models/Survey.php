<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
//trait 'Spatie\Sluggable\SlugOptions';
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Survey extends Model
{
    use HasFactory, HasSlug;
    // Table name
    //protected $table = 'survey';
    // Primary Key
    //public $primaryKey = 'id';
    // Timestamps

    protected $fillable = ['user_id', 'image', 'title', 'slug', 'status', 'description', 'expire_date'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }
}
