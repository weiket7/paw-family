<?php namespace App\Models;

use Eloquent, DB, Validator, Input;

class Brand extends Eloquent
{
  public $table = 'brand';
  protected $primaryKey = 'brand_id';
  protected $validation;

  public function getDistinctBrandByCategory($category_id) {
    $s = "SELECT distinct b.brand_id, b.name from product as p
    inner join category as c on p.category_id = c.category_id
    inner join brand as b on p.brand_id = b.brand_id
    where p.category_id = :category_id";
    $p['category_id'] = $category_id;

    $data = DB::select($s, $p);

    $res = [];
    foreach($data as $d) {
      $res[$d->brand_id] = $d->name;
    }
    return $res;
  }
}