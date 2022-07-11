<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;

class Topics extends Model
{
    use HasFactory, HasSlug;

    protected $fillable = ['user_id', 'image', 'title', 'slug', 'content', 'status'];

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()->generateSlugsFrom('title')->saveSlugsTo('slug');
    }


    public function topicComment()
    {
        return $this->hasMany(TopicComments::class);
    }
}
