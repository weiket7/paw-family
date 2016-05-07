<?php namespace App\Models;

use CommonHelper;
use Eloquent, DB, Validator, Input;

class Brand extends Eloquent
{
  public $table = 'brand';
  protected $primaryKey = 'brand_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
   ];

  private $messages = [
    'name.required'=>'Name is required',
  ];

  public function saveBrand($input, $image) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    if ($image) {
      $this->image = CommonHelper::uploadImage('brands', $input['name'], $image);
    }
    $this->save();
    return true;
  }

  public function getBrandWithProductCountBySlug($slugs) {
    //DB::enableQueryLog();
    $brand_ids = Brand::whereIn("slug", explode(",", $slugs  ))->pluck('brand_id');
    $brands = Product::whereIn("product.brand_id", $brand_ids)
      ->join('brand', 'brand.brand_id', '=', 'product.brand_id')
      ->groupBy('brand_id')
      ->select(DB::raw('count(*) as product_count, brand.brand_id, brand.name'))->get();
    return $brands;
  }


  public function getDistinctBrandByCategory($category_id) {
    $s = "SELECT b.brand_id, b.name, count(1) as product_count from product as p
    inner join category as c on p.category_id = c.category_id
    inner join brand as b on p.brand_id = b.brand_id
    where p.category_id = :category_id
    group by brand_id";
    $p['category_id'] = $category_id;

    $data = DB::select($s, $p);
    return $data;
  }

  public function getBrandIdBySlug($slugs) {
    $s = "SELECT brand_id from brand";
    $slugs = "'".implode("','", $slugs)."'";
    $s .= " where slug in (".$slugs.")";
    $data = DB::select($s);

    $res = [];
    foreach($data as $d) {
      $res[] = $d->brand_id;
    }
    return $res;
  }

  public function getBrandForDropdown(){
    $s = "SELECT brand_id, name as brand_name from brand";
    $data = DB::select($s);

    $res = [];
    foreach($data as $d) {
      $res[$d->brand_id] = $d->brand_name;
    }
    return [''=>''] + $res;
  }

  public function getValidation() {
    return $this->validation;
  }
}