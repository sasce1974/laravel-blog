<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Auth;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'role_id', 'is_active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function isAdmin(){
        if(Auth::check()) {
            if ($this->role_id == 1) {
                return true;
            } else {
                return false;
            }
        }else{
            return false;
        }
    }

    public function isActive(){
        if($this->is_active == 1){
            return true;
        }else{
            return false;
        }
    }

    public function role(){
        return $this->belongsTo('App\Role');
    }

    public function posts(){
        return $this->hasMany('App\Post');
    }

    public function comments(){
        return $this->hasMany('App\Comment');
    }

    public function replies(){
        return $this->hasMany('App\Reply');
    }

    public function medias(){
        return $this->morphOne('App\Media','imageable');
    }

    public function receivedMessages(){
        return $this->hasMany('App\Message', 'sent_to', 'id');
    }

    public function sentMessages(){
        return $this->hasMany('App\Message', 'author', 'id');
    }

}
