<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;

class Post extends Model
{
    use Sluggable;

    public function sluggable(){
        return ['slug' => ['source' => 'title']];
    }

    protected $fillable = ['user_id', 'category_id', 'title', 'content', 'is_approved', 'slug'];

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function category(){
        return $this->belongsTo('App\Category');
    }

    public function medias(){
        return $this->morphOne("App\Media", "imageable");
    }

}
