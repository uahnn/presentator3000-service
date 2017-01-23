<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Attachement extends Model
{
    public function user() {
        return $this->belongsTo('App\User');
    }

    public function presentation() {
        return $this->belongsTo('App\Presentation');
    }
}
