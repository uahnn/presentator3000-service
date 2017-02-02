<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    protected $fillable = ['title', 'description'];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function presentations() {
        return $this->belongsToMany('App\Presentation');
    }
}
