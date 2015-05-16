<?php namespace Pop;

use Illuminate\Database\Eloquent\Model;

class Attribute extends Model {

    protected $fillable = ['name','code'];

    public function categories() {
        return $this->belongsToMany('Pop\Category', 'categories_attributes');
    }

    public function values() {
        return $this->hasMany('Pop\AttributeValue');
    }
}
