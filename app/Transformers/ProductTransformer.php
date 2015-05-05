<?php namespace Pop\Transformers;

class ProductTransformer extends Transformer {

    /**
     * @param $product
     * @return array
     */
    public function transform($product)
    {
        return [
            'id' => $product['id'],
            'name'  => $product['name'],
            'description' => $product['description'],
            'price' => (double)$product['price'],
            'quantity' => (int)$product['quantity']
        ];
    }
}