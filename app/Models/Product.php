<?php namespace App\Models;

use Eloquent, DB, Validator, Input;

class Product extends Eloquent
{
  public $table = 'product';
  protected $primaryKey = 'product_id';
  protected $validation;

  public function getProductFeatured() {
    $s = "SELECT p.name, p.desc_short, p.stat as product_stat, pf.stat as product_featured_stat
      FROM product AS p
      inner join product_featured as pf on pf.product_id = p.product_id";
    $products = DB::select($s);
    return $products;
  }
  
}