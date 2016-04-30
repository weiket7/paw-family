<?php namespace App\Models;

use App\Models\Enums\ProductOptionType;
use Eloquent, DB, Validator;

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

  public function getProductByCategory($category_id) {
    return Product::where('category_id', $category_id)->get();
  }

  public function getProductByCategoryAndBrand($category_ids, $brand_ids) {
    //var_dump($category_ids);
    //var_dump($brand_ids);
    if (is_array($category_ids) && is_array($brand_ids)) {
      return Product::whereIn('category_id', $category_ids)->whereIn('brand_id', $brand_ids)->get();
    } else if (is_array($category_ids)) {
      return Product::whereIn('category_id', $category_ids)->where('brand_id', $brand_ids)->get();
    } else if (is_array($brand_ids)) {
      return Product::where('category_id', $category_ids)->whereIn('brand_id', $brand_ids)->get();
    } else {
      return Product::where('category_id', $category_ids)->where('brand_id', $brand_ids)->get();
    }
  }

  public function getProducts($product_ids) {
    $product_ids = implode($product_ids, ',');
    //TODO
  }

  public function getProductAll() {
    $s = "SELECT product_id, p.name, price, p.slug, p.image, price, discount_amt, discount_type, p.stat,
    b.name as brand_name, b.brand_id, c.main_category, c.name as category_name, c.category_id, processing_day, weight_lb, weight_kg,
    desc_short, desc_long
    from product as p
    inner join brand as b on p.brand_id = b.brand_id
    inner join category as c on p.category_id = c.category_id";
    $products = DB::select($s);

    foreach($products as $product) {
      $product->sizes = $this->getProductSize($product->product_id);
      $product->repacks = $this->getProductOption($product->product_id, ProductOptionType::Repack);
    }
    return $products;
  }

  public function getProduct($intOrSlug) {
    $s = "SELECT product_id, p.name, price, p.slug, p.image, price, discount_amt, discount_type, p.stat,
    b.name as brand_name, b.brand_id, c.main_category, c.name as category_name, c.category_id, processing_day, weight_lb, weight_kg,
    desc_short, desc_long
    FROM product as p
    inner join brand as b on p.brand_id = b.brand_id
    inner join category as c on p.category_id = c.category_id";

    if (is_int($intOrSlug)) {
      $s .= " where product_id = :product_id";
      $p['product_id'] = $intOrSlug;
    } else {
      $s .= " where p.slug = :slug";
      $p['slug'] = $intOrSlug;
    }
    $data = DB::select($s, $p);

    $product = $data[0];
    $product->sizes = $this->getProductSize($product->product_id);
    $product->repacks = $this->getProductOption($product->product_id, ProductOptionType::Repack);

    return $product;
  }

  public function getProductSize($product_id) {
    $s = "SELECT size_id, name, price, quantity, weight_lb, weight_kg from size
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