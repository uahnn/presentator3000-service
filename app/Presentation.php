<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Presentation extends Model
{
    protected $fillable = ['title', 'description'];

    public function slides()
    {
        return $this->belongsToMany('App\Slide')->withPivot('slide_prev', 'slide_next');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}