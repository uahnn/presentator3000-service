<?php

namespace App\Uahnn\Transformers;

use App\Slide;
use App\User;

class AttachementTransformer extends Transformer
{

    public function transform($attachement)
    {
        return [
            'id' =>   $attachement['id'],
            'filename' => $attachement['filename'],
            'presentation' => route('presentations.show', ['id' => $attachement['presentation_id']]),
            'updated_at' => $attachement['updated_at']->format('Y-m-d h:m:s')
        ];
    }
}