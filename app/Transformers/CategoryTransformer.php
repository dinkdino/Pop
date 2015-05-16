<?php namespace Pop\Transformers;

class CategoryTransformer extends Transformer {

    public function transform($item)
    {
        $attrs = [
              'name'  => $item['name'],
        ];

        $subCategories = [];
        if(array_key_exists('sub_categories', $item) AND count($item['sub_categories']) > 0) {
            $subCategories['sub_categories'] = $this->transformCollection($item['sub_categories']);
        }

        return array_merge($attrs, $subCategories);
    }

    public function transformCollectionWithAttributes($items, AttributeTransformer $attributeTransformer, AttributeValueTransformer $attributeValueTransformer) {

        $resultArray = [];
        foreach($items as $item) {
            $resultArray[] = $this->transformWithAttributes($item, $attributeTransformer, $attributeValueTransformer);
        }

        return $resultArray;
    }

    public function transformWithAttributes($item, AttributeTransformer $attributeTransformer, AttributeValueTransformer $attributeValueTransformer) {
        $attrs = [
            'id' => (int)$item['id'],
            'name'  => $item['name']
        ];

        if(array_key_exists('sub_categories', $item) AND count($item['sub_categories']) > 0) {
            $attrs['sub_categories'] = $this->transformCollectionWithAttributes($item['sub_categories'], $attributeTransformer, $attributeValueTransformer);
        }

        if(array_key_exists('attributes', $item) AND count($item['attributes']) > 0) {
            $attrs['attributes'] = $attributeTransformer->transformCollectionWithValues($item['attributes'], $attributeValueTransformer);
        }

        return $attrs;
    }
}