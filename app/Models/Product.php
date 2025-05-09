<?php namespace App\Models;

use App\Models\Entities\ProductDiscount;
use App\Models\Enums\DiscountType;
use App\Models\Enums\ProductOptionType;
use App\Models\Enums\ProductStat;
use Carbon\Carbon;
use CommonHelper;
use Eloquent, DB, Validator;

class Product extends Eloquent
{
  public $table = 'product';
  protected $primaryKey = 'product_id';
  protected $validation;
  public $timestamps = false;
  protected $attributes = ['stat'=>ProductStat::Available, 'brand_id'=>0, 'category_id'=>0, 'supplier_id'=>0];

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

  public function saveProduct($input, $image = null) {
    $this->validation = Validator::make($input, $this->rules, $this->messages );
    if ( $this->validation->fails() ) {
      return false;
    }

    $this->name = $input['name'];
    $this->stat = $input['stat'];
    $this->sku = $input['sku'];
    $this->slug = str_slug($input['name']);
    $this->supplier_id = $input['supplier_id'];
    $this->brand_id = $input['brand_id'];
    $this->category_id = $input['category_id'];
    $this->cost_price = $input['cost_price'];
    $this->price = $input['price'];
    $this->processing_day = $input['processing_day'];
    $this->weight = $input['weight'];
    $this->weight_uom = $input['weight_uom'];
    $this->desc_short = $input['desc_short'];
    $this->meta_keyword = $input['meta_keyword'];
    $this->meta_desc = $input['meta_desc'];
    $this->round_up_ten_cent = isset($input['round_up_ten_cent']) ? true : false;
    $this->updated_on = Carbon::now();

    $round_up_ten_cent = isset($input['round_up_ten_cent']);
    $product_discount = new ProductDiscount($input['price'], $input['discount_type'], $input['discount_percentage'], $input['discount_amt'], $round_up_ten_cent);
    $this->discount_percentage = $product_discount->discount_percentage;
    $this->discount_type = $product_discount->discount_type;
    $this->discount_amt = $product_discount->discount_amt;
    $this->discounted_price = $product_discount->discounted_price;
    $this->bulk_discount_applicable = $input['bulk_discount_applicable'];
    $this->tag = $input['tag'];

    if ($image) {
      $this->image = CommonHelper::uploadImage('products', $input['name'], $image);
    }

    $this->save();

    $this->updateProductSizeUom();

    return true;
  }

  public function updateProductSizeUom() {
    DB::table('product_size')->where('product_id', $this->product_id)->update(['weight_uom' => $this->weight_uom]);
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

  public function getProductAll() {
    $s = "SELECT product_id, p.name, p.slug, p.image, cost_price, price, discount_amt, discount_type, discount_percentage, discounted_price, p.stat, supplier_id, sku,
    brand_id, category_id, processing_day, weight, weight_uom,
    desc_short
    from product as p
    order by updated_on desc
    limit 100";
    $products = DB::select($s);

    foreach($products as $product) {
      $product->sizes = $this->getProductSize($product->product_id);
      $product->repacks = $this->getProductOption($product->product_id, ProductOptionType::Repack);
      //$product->descs = $this->getProductDesc($product->product_id);
    }
    return $products;
  }

  public function getProduct($intOrSlug) {
    $s = "SELECT product_id, p.name, p.slug, p.image, cost_price, price, discount_amt, discount_type, discount_percentage, discounted_price, p.stat,
    supplier_id, sku, bulk_discount_applicable, round_up_ten_cent, tag,
    b.name as brand_name, b.brand_id, c.main_category, c.name as category_name, c.category_id, processing_day, weight, weight_uom,
    desc_short, p.meta_keyword, p.meta_desc
    FROM product as p
    left join brand as b on p.brand_id = b.brand_id
    left join category as c on p.category_id = c.category_id";

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
    $product->descs = $this->getProductDesc($product->product_id);

    return $product;
  }

  public function getProductsYouMayLike() {
    $s = "SELECT product_id, name, slug, image, price, discounted_price
    FROM product
    where stat = :stat and (image is not null and image != '') and discounted_price > 0
    and image not like '/%' and image != 'no selection'
    ORDER BY RAND()
    LIMIT 8";
    $p['stat'] = ProductStat::Available;

    $data = DB::select($s, $p);
    return $data;
  }

  public function getProductDesc($product_id) {
    $s = "SELECT desc_id, type, value from product_desc where product_id = :product_id";
    $p['product_id'] = $product_id;
    $data = DB::select($s, $p);

    $res = CommonHelper::arraySetKey($data, "desc_id");
    return $res;
  }

  public function getProductSize($product_id) {
    $s = "SELECT sku, size_id, name, cost_price, price, quantity, weight, weight_uom, discount_amt, discount_type, discount_percentage, discounted_price, pos
    from product_size where product_id = :product_id
    order by pos";
    $p['product_id'] = $product_id;
    $data = DB::select($s, $p);

    $res = [];
    foreach($data as $d) {
      $res[$d->size_id] = $d;
    }
    return $res;
  }

  public function getProductOption($product_id, $type) {
    $s = "SELECT option_id, size_id, name, type, price from product_option
    where product_id = :product_id and type = :type";
    $p['product_id'] = $product_id;
    $p['type'] = $type;
    $data = DB::select($s, $p);

    $res = [];
    foreach($data as $d) {
      $res[$d->size_id][$d->option_id] = $d;
    }
    return $res;
  }

  public function searchProduct($input) {
    $s = "SELECT * from product where 1 ";
    if($input['name'] != '') {
      $s .= " and name LIKE '%".$input['name']."%'";
    }
    if (isset($input['brand_id']) && $input['brand_id'] != '') {
      $s .= " and brand_id = $input[brand_id]";
    }
    if (isset($input['category_id']) && $input['category_id'] != '') {
      $s .= " and category_id = $input[category_id]";
    }
    if (isset($input['stat']) && $input['stat'] != '') {
      $s .= " and stat = '$input[stat]'";
    }
    $products = DB::select($s);

    foreach($products as $product) {
      $product->sizes = $this->getProductSize($product->product_id);
      $product->repacks = $this->getProductOption($product->product_id, ProductOptionType::Repack);
    }

    return $products;
  }

  public function searchProductByTerm($term)
  {
    $s = "SELECT concat('/product/view/',slug) as link, name from product where name like :term";
    $p["term"] = '%'.$term.'%';
    return DB::select($s, $p);
  }

  public function getValidation() {
    return $this->validation;
  }

  public function getProductByBrand($brand_ids)
  {
    if (is_array($brand_ids)) {
      return Product::whereIn("brand_id", $brand_ids)->get();
    } else {
      return Product::where('brand_id', $brand_ids)->get();
    }
  }

  public function getProductForDropown() {
    $data = DB::table('product')->select("product_id", "name")->get();
    $res = [];
    foreach($data as $d) {
      $res[$d->product_id] = $d->name;
    }
    return [''=>'']+$res;
  }

  public function updateProductCount($product_id, $prev_brand_id = 0, $prev_category_id = 0, $prev_supplier_id = 0) {
    $product = Product::find($product_id);

    $brand_id = $product->brand_id;
    $this->updateTableProductCount('brand', 'brand_id', $brand_id);

    if ($prev_brand_id > 0) {
      $this->updateTableProductCount('brand', 'brand_id', $prev_brand_id);
    }

    $category_id = $product->category_id;
    $this->updateTableProductCount('category', 'category_id', $category_id);

    if ($prev_category_id > 0) {
      $this->updateTableProductCount('category', 'category_id', $prev_category_id);
    }

    $supplier_id = $product->supplier_id;
    $this->updateTableProductCount('supplier', 'supplier_id', $supplier_id);

    if ($prev_supplier_id > 0) {
      $this->updateTableProductCount('supplier', 'supplier_id', $prev_supplier_id);
    }

    return true;
  }

  private function updateTableProductCount($table_name, $id_name, $id) {
    $s = "UPDATE $table_name set product_count = (select count(1) from product where $id_name = $id)
      where $id_name = $id";
    DB::statement($s);
  }

  public function deleteProducts($product_ids) {
    foreach($product_ids as $product_id) {
      $product = Product::find($product_id);
      $product->delete();
    }
  }

}