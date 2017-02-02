<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Slide extends Model
{
    protected $fillable = ['content', 'shared'];

    /*
    public function presentation() {
        return $this->hasMany('App\Presentation');
    }
    */

    /*
    public function codefragments() {
        return $this->hasMany('App\Codefragment');
    }
    */

    public function comments() {
        return $this->hasMany('App\Comment');
    }
}
