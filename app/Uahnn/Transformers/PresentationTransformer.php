<?php
/**
 * Created by PhpStorm.
 * User: uahnn
 * Date: 23.01.17
 * Time: 10:30
 */

namespace App\Uahnn\Transformers;


class PresentationTransformer extends Transformer
{
    public function transform($presentation)
    {
        return [
            'title' => $presentation['title'],
            'description' => $presentation['description'],
        ];
    }
}