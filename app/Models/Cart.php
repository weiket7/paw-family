<?php namespace App\Models;

use App\Models\Entities\SaleProduct;

class Cart {
  protected $products;

  public function addToCart($product_id, $quantity, $size_id = 0, $option_id = 0)
  {
    if ($this->products == null) {
      $this->products = [];
    }

    $key = $this->getKey($product_id, $size_id);
    if (array_key_exists($key, $this->products)) {
      $this->products[$key]->quantity += (int)$quantity;
      $this->products[$key]->subtotal = $this->products[$key]->quantity * $this->products[$key]->discounted_price;
    } else {
      $product_service = new Product();
      $product = $product_service->getProduct((int)$product_id);
      //var_dump($product);

      $sale_product = new SaleProduct();
      $sale_product->product_id = $product_id;
      $sale_product->quantity = (int)$quantity;
      $sale_product->name = $product->name;
      $sale_product->bulk_discount_applicable = $product->bulk_discount_applicable;
      $sale_product->size_id = $size_id;
      $sale_product->option_id = $option_id;
      if($size_id > 0) {
        $sale_product->price = $product->sizes[$size_id]->price;
        $sale_product->cost_price = $product->sizes[$size_id]->cost_price;
        $sale_product->discounted_price = $product->sizes[$size_id]->discounted_price;
        $sale_product->discount_amt = $product->sizes[$size_id]->discount_amt;
        $sale_product->size_name = $product->sizes[$size_id]->name;
        if ($option_id > 0) {
          $sale_product->option_name = $product->repacks[$size_id][$option_id]->name;
          $sale_product->option_price = $product->repacks[$size_id][$option_id]->price;
        }
      } else {
        $sale_product->price = $product->price;
        $sale_product->cost_price = $product->cost_price;
        $sale_product->discounted_price = $product->discounted_price;
        $sale_product->discount_amt = $product->discount_amt;
      }
      $sale_product->image = $product->image;
      $sale_product->slug = $product->slug;
      $sale_product->subtotal = ($sale_product->quantity * $sale_product->discounted_price) + ($sale_product->quantity *$sale_product->option_price );
      $this->products[$key] = $sale_product;
    }
  }

  public function removeFromCart($product_id, $size_id) {
    $key = $this->getKey($product_id, $size_id);
    unset($this->products[$key]);
  }

  public function getKey($product_id, $size_id) {
    return $product_id.'_'.$size_id;
  }

  public function setCart($products) {
    $this->products = $products;
  }

  public function getCart() {
    return $this->products;
  }

  public function updateCart($product_id, $quantity, $size_id = 0, $option_id = 0) {
    $key = $this->getKey($product_id, $size_id);
    $this->products[$key]->quantity = (int)$quantity;
    $this->products[$key]->subtotal = $this->products[$key]->quantity * $this->products[$key]->discounted_price;
  }
}