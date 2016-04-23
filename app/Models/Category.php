<?php namespace App\Models;

use Eloquent, DB, Validator, Input;

class Category extends Eloquent {
  public $table = 'category';
  protected $primaryKey = 'category_id';
  protected $validation;

  public function getCategoryAllForMenu() {
    $data = Category::all();
    $res = [];
    foreach($data as $d) {
      $res[$d->main_category][] = $d;
    }
    return $res;
  }
}