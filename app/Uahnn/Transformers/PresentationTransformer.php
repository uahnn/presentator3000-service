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
    public function transform($presentation) {

        return [
            'id' => $presentation['id'],
            'title' => $presentation['title'],
            'description' => $presentation['description'],
            'slides' => route('presentation_slides', ['id' => $presentation['id']]),
            'attachements' => route('presentation_attachements', ['id' => $presentation['id']]),
            'updated_at' => $presentation['updated_at']->format('Y-m-d h:m:s')
        ];
    }
}