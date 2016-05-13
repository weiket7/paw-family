<?php namespace App\Models;

use App\Models\Enums\MainCategory;
use Eloquent, DB, Validator, Input;

class Category extends Eloquent {
  public $table = 'category';
  protected $primaryKey = 'category_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveCategory($input) {
    $this->name = $input['name'];
    $this->main_category = $input['main_category'];
    $this->slug = str_slug($input['name']);
    $this->save();
    return true;
  }
  
  public function getCategoryAllForMenu() {
    $data = Category::all();
    $res = [];
    foreach($data as $d) {
      $res[$d->main_category][] = $d;
    }
    return $res;
  }
  
  public function getCategoryForDropdown() {
    $data = Category::all();
    $res = [];
    foreach($data as $d) {
      $res[MainCategory::$values[$d->main_category]][$d->category_id] = $d->name;
    }
    return [''=>'']+$res;
  }

  public function getCategoryBySlug($slug)
  {
    return Category::where('slug', $slug)->firstOrFail();
  }

  public function updateProductCount($category_id) {
    $product_count = Product::where("category_id", $category_id)->count();

    $s = "UPDATE category set product_count = :product_count where category_id = :category_id";
    $p['category_id'] = $category_id;
    $p['product_count'] = $product_count;
    return DB::update($s, $p);
  }

  public function getValidation() {
    return $this->validation;
  }

}