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

  public function getProductByCategoryId($category_id)
  {
    return Product::where('category_id', $category_id)->get();
  }

  public function getProductBySlug($slug)
  {
    $s = "SELECT p.name, p.slug, p.image, b.name as brand, c.name as category, desc_short from product as p
    inner join brand as b on p.brand_id = b.brand_id
    inner join category as c on p.category_id = c.category_id
    where p.slug = :slug";
    $p['slug'] = $slug;

    $data = DB::select($s, $p);
    return $data[0];
  }

}