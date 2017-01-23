<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Template extends Model
{
    protected $fillable = ['title', 'markup'];

    public function user() {
        $this->belongsTo('App\User');
    }
}
