<?php

namespace App\Uahnn\Transformers;

class SlideTransformer extends Transformer
{

    public function transform($slide)
    {
        return [
            'id' =>   $slide['id'],
            'content' => $slide['content'],
            'shared' => (boolean) $slide['shared']
        ];
    }
}