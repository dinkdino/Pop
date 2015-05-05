<?php namespace Pop\Http\Controllers\Api;

use Pop\Http\Requests;
use Pop\Http\Controllers\Controller;

use Illuminate\Http\Request;
use Pop\Product;
use Pop\Transformers\ProductTransformer;

class ProductsController extends ApiController {

    protected $transformer;

    function __construct(ProductTransformer $transformer)
    {
        $this->transformer = $transformer;
    }

    public function index(Request $request) {
        $limit = $request->input('limit', 10);
        if ($limit > 50) $limit = 50;

        $products = Product::paginate($limit);

        return $this->respondWithSuccess("Products", [
            'products' => $this->transformer->transformCollection($products->all()),
            'paginator' => [
                'limit' => $products->perPage(),
                'total_pages' => ceil($products->total() / $products->perPage()),
                'current_page' => $products->currentPage(),
                'total' => $products->total()
            ]
        ]);
    }

}
