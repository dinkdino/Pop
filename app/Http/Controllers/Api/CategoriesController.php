<?php namespace Pop\Http\Controllers\Api;

use Illuminate\Support\Facades\DB;
use Pop\Category;
use Pop\Transformers\AttributeTransformer;
use Pop\Transformers\AttributeValueTransformer;
use Pop\Transformers\CategoryTransformer;

class CategoriesController extends ApiController {

    protected $transformer;
    protected $attributeTransformer;
    protected $attributeValueTransformer;

    function __construct(CategoryTransformer $transformer, AttributeTransformer $attributeTransformer, AttributeValueTransformer $attributeValueTransformer)
    {
        $this->transformer = $transformer;
        $this->attributeTransformer = $attributeTransformer;
        $this->attributeValueTransformer = $attributeValueTransformer;
    }


    public function index() {

        $categories = Category::whereNull('category_id')
            ->with('subCategories.attributes.values')
            ->get();

        return $this->respondWithSuccess("Categories", [
            'categories' => $this->transformer->transformCollectionWithAttributes($categories->toArray() , $this->attributeTransformer, $this->attributeValueTransformer)
        ]);
    }


}