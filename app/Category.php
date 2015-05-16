<?php namespace Pop;

use Illuminate\Database\Eloquent\Model;

class Category extends Model {

	//
    protected $fillable = ['name'];

    public function products() {
        return $this->hasMany('Pop\Product');
    }

    public function parent() {
        return $this->belongsTo('Pop\Category', 'category_id');
    }

    public function subCategories() {
        return $this->hasMany('Pop\Category');
    }

    public function attributes() {
        return $this->belongsToMany('Pop\Attribute', 'categories_attributes');
    }

}
