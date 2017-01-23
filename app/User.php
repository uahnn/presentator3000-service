<?php

namespace App;

use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{

    protected $table = 'users';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function presentations() {
        return $this->hasMany('App\Presentation');
    }

    public function comments() {
        return $this->hasMany('App\Comment');
    }

    public function attachements() {
        return $this->hasMany('App\Attachement');
    }

    public function channels() {
        return $this->hasMany('App\Channel');
    }

    public function plan() {
        return $this->hasOne('App\Plan');
    }
}
