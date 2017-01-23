<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Codefragment extends Model
{
    protected $fillable = ['path', 'ref', 'line_start', 'line_end'];

    protected $dates = ['last_updated'];

    public function codebase() {
        return $this->belongsTo('App\Codebase');
    }

    public function slides() {
        return $this->belongsToMany('App\Slide');
    }
}
