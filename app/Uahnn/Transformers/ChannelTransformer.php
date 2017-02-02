<?php
/**
 * Created by PhpStorm.
 * User: uahnn
 * Date: 02.02.17
 * Time: 20:38
 */

namespace App\Uahnn\Transformers;


class ChannelTransformer extends Transformer
{

    public function transform($channel)
    {
        return [
            'id' =>   $channel['id'],
            'title' => $channel['title'],
            'description' => $channel['description'],
            'presentations' => route('channel_presentations', [$channel['id']]),
            'updated_at' => $channel['updated_at']->format('Y-m-d h:m:s')
        ];
    }
}