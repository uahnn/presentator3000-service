<?php
/**
 * Created by PhpStorm.
 * User: uahnn
 * Date: 23.01.17
 * Time: 10:30
 */

namespace App\Uahnn\Transformers;


class CodebaseTransformer extends Transformer
{
    public function transform($codebase) {

        return [
            'id' => $codebase['id'],
            'url' => $codebase['url'],
            'updated_at' => $codebase['updated_at']->format('Y-m-d h:m:s')
        ];
    }
}