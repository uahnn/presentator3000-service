<?php

namespace App\Uahnn\Transformers;

class SlideTransformer extends Transformer
{

    public function transform($slide)
    {
        return [
            'content' => $slide['content'],
            'shared' => (boolean) $slide['shared']
        ];
    }
}