<?php
/**
 * Created by PhpStorm.
 * User: uahnn
 * Date: 02.02.17
 * Time: 20:01
 */

namespace App\Uahnn\Transformers;


class TemplateTransformer extends Transformer
{

    public function transform($template)
    {
        return [
            'id' =>   $template['id'],
            'title' => $template['title'],
            'markup' => $template['markup'],
        ];
    }
}