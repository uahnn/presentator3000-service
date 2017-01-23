<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Plan extends Model
{
    protected $table = "plan";

    protected $fillable = ['cost_per_month', 'max_presentations', 'max_slides_pp', 'max_codebases', 'enable_channels', 'enable_attachements', 'enable_templates'];

    public function user()
    {
        $this->belongsTo('App\User');
    }
}
