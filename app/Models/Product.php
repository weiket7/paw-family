<?php namespace App\Models;

use App\Models\Enums\ProductOptionType;
use CommonHelper;
use Eloquent, DB, Validator;

class Product extends Eloquent
{
  public $table = 'product';
  protected $primaryKey = 'product_id';
  protected $validation;
  public $timestamps = false;

  private $rules = [
    'name'=>'required',
    'stat'=>'required',
    'brand_id'=>'required',
    'category_id'=>'required',
  ];

  private $messages = [
    'name.required'=>'Name is required',
    'stat.required'=>'Status is required',
    'brand_id.required'=>'Brand is required',
    'category_id.required'=>'Category is required',
  ];

  public function saveProduct($input, $image) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->sku = $input['sku'];
    $this->supplier_id = $input['supplier_id'];
    $this->brand_id = $input['brand_id'];
    $this->category_id = $input['category_id'];
    $this->price = $input['price'];
    $this->processing_day = $input['processing_day'];
    $this->weight_lb = $input['weight_lb'];
    $this->weight_kg = $input['weight_kg'];
    $this->discount_type = $input['discount_type'];
    $this->discount_amt = $input['discount_amt'];
    $this->desc_short = $input['desc_short'];
    $this->desc_long = $input['desc_long'];

    if ($image) {
      $this->image = CommonHelper::uploadImage('products', $input['name'], $image);
    }
    $this->save();
    return true;
  }

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
    $s = "SELECT product_id, p.name, p.slug, p.image, price, discount_amt, discount_type, discount_percentage, discounted_price, p.stat, supplier_id, sku,
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
    $s = "SELECT product_id, p.name, p.slug, p.image, price, discount_amt, discount_type, discount_percentage, discounted_price, p.stat, supplier_id, sku,
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

  public function getProductName($product_id) {
    $product_name = DB::table("product")->where("product_id", $product_id)->value("name");
    return $product_name;
  }

  public function getProductSize($product_id) {
    $s = "SELECT size_id, name, price, quantity, weight_lb, weight_kg, discount_amt, discount_type, discount_percentage, discounted_price from size
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

  public function getValidation() {
    return $this->validation;
  }

}