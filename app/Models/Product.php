<?php namespace App\Models;

use App\Models\Enums\ProductOptionType;
use Eloquent, DB, Validator, Input;

class Product extends Eloquent
{
  public $table = 'product';
  protected $primaryKey = 'product_id';
  protected $validation;

  public function getProductFeatured() {
    $s = "SELECT p.name, p.desc_short, p.stat as product_stat, f.stat as featured_stat
      FROM product AS p
      inner join featured as f on f.product_id = p.product_id";
    $products = DB::select($s);
    return $products;
  }

  public function getProductByCategory($category_id)
  {
    return Product::where('category_id', $category_id)->get();
  }

  public function hasSizes() {
    if (! isset($this->sizes)) {
      $this->sizes = $this->getProductSize($this->product_id);
    }
    return count($this->sizes);
  }

  public function getProductBySlug($slug)
  {
    $s = "SELECT product_id, p.name, price, p.slug, p.image, b.name as brand, c.main_category, c.name as category, desc_short from product as p
    inner join brand as b on p.brand_id = b.brand_id
    inner join category as c on p.category_id = c.category_id
    where p.slug = :slug";
    $p['slug'] = $slug;

    $data = DB::select($s, $p);
    $product = $data[0];

    $product->sizes = $this->getProductSize($product->product_id);
    $product->repacks = $this->getProductOption($product->product_id, ProductOptionType::Repack);

    return $product;
  }

  public function getProductSize($product_id) {
    $s = "SELECT size_id, size_name, price, quantity, weight_lb, weight_kg from size
    where product_id = :product_id";
    $p['product_id'] = $product_id;
    $data = DB::select($s, $p);

    $res = [];
    foreach($data as $d) {
      $res[$d->size_id] = $d;
    }
    return $res;
  }

  public function getProductOption($product_id, $type) {
    $s = "SELECT option_id, size_id, name, type, price from `option`
    where product_id = :product_id and type = :type";
    $p['product_id'] = $product_id;
    $p['type'] = $type;
    $data = DB::select($s, $p);

    $res = [];
    foreach($data as $d) {
      $res[$d->size_id][] = $d;
    }
    return $res;
  }

  public function searchProduct($term)
  {
    $s = "SELECT slug, name from product where name like :term";
    $p["term"] = '%'.$term.'%';
    return DB::select($s, $p);
  }

}