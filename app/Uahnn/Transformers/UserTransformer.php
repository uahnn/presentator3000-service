<?php
/**
 * Created by PhpStorm.
 * User: uahnn
 * Date: 02.02.17
 * Time: 14:13
 */

namespace App\Uahnn\Transformers;


class UserTransformer
{
    public function transform($user)
    {
        return [
            'id' =>   $user['id'],
            'name' => $user['name'],
            'email' => $user['email'],
            'userspace' => $user['userspace'],
        ];
    }
}