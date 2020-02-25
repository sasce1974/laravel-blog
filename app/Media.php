<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Media extends Model
{
    protected $fillable = ['user_id', 'file', 'is_approved'];

//    public function user(){
//        return $this->belongsTo('App\User');
//    }

    public function imageable(){
        return $this->morphTo();
    }





}
