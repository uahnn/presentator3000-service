<?php

namespace App\Uahnn\Transformers;

use App\Slide;
use App\User;

class CommentTransformer extends Transformer
{

    public function transform($comment)
    {
        return [
            'id' =>   $comment['id'],
            'slide' => route('slides.show', ['id' => $comment['slide_id']]),
            'user' => route('user.show', ['id' => $comment['user_id']]),
            'content' => $comment['content'],
            'updated_at' => $comment['updated_at']->format('Y-m-d h:m:s')
        ];
    }
}