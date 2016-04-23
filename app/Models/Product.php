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
    $s = "SELECT product_id, p.name, p.slug, p.image, b.name as brand, c.name as category, desc_short from product as p
    inner join brand as b on p.brand_id = b.brand_id
    inner join category as c on p.category_id = c.category_id
    where p.slug = :slug";
    $p['slug'] = $slug;

    $data = DB::select($s, $p);
    $product = $data[0];

    $product->sizes = $this->getProductSize($product->product_id);

    return $product;
  }

  public function getProductSize($product_id) {
    $s = "SELECT size_name, quantity, weight_lb, weight_kg from product_size
    where product_id = :product_id";
    $p['product_id'] = $product_id;
    return DB::select($s, $p);
  }

  public function getProductRepack($product_id, $product_size_id) {
    $s = "SELECT product_size_id, repack_name, cost from product_repack
    where product_id = :product_id and product_size_id = :product_size_id";
    $p['product_id'] = $product_id;
    $p['product_size_id'] = $product_size_id;
    $data = DB::select($s, $p);

    $res = [];
    foreach($data as $d) {
      $res[$d->product_size_id][] = $d;
    }
    return $res;
  }

}