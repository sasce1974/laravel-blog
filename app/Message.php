<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Message extends Model
{
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    protected $fillable = ['author', 'sent_to', 'subject', 'content', 'viewed', 'starred'];

    public function user(){
        return $this->belongsTo('App\User', 'author', 'id');
    }

    public function sentTo(){
        return $this->belongsTo('App\User', 'sent_to', 'id');
    }




}
