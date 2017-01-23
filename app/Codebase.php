<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codebase extends Model
{
    protected $fillable = ['title', 'url'];

    public function codefragments() {
        return $this->hasMany('App\Codefragment');
    }
}
