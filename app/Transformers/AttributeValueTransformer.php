<?php namespace Pop\Transformers;

class AttributeValueTransformer extends Transformer {

    public function transform($item)
    {
        return [
            'id'   => (int)$item['id'],
            'name' => $item['name']
        ];
    }
}