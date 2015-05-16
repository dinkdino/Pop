<?php namespace Pop;

use Illuminate\Database\Eloquent\Model;

class Product extends Model {

	//
    public function category() {
        return $this->belongsTo('Pop\Category');
    }

}
