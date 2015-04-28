<?php namespace Pop\Transformers;

class UserTransformer extends Transformer {

    public function transform($user)
    {
        return [
            'name'  => $user['name'],
            'email' => $user['email']
        ];
    }

}