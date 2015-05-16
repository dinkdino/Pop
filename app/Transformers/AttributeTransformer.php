<?php namespace Pop\Transformers;

class AttributeTransformer extends Transformer {

    public function transform($item)
    {
        return [
            'id'   => (int)$item['id'],
            'name' => $item['name']
        ];
    }

    public function transformCollectionWithValues($items, AttributeValueTransformer $attributeValueTransformer) {
        $resultArray = [];
        foreach($items as $item) {
            $resultArray[] = $this->transformWithValues($item, $attributeValueTransformer);
        }

        return $resultArray;
    }

    public function transformWithValues($item, AttributeValueTransformer $attributeValueTransformer) {
        $attrs = [
            'id' => (int)$item['id'],
            'name'  => $item['name']
        ];

        if(array_key_exists('values', $item) AND count($item['values']) > 0) {
            $attrs['values'] = $attributeValueTransformer->transformCollection($item['values']);
        }

        return $attrs;
    }
}