<?php namespace App\Models;

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
      $this->products[$key]->subtotal += $this->products[$key]->quantity * $this->products[$key]->discounted_price;
    } else {
      $product_service = new Product();
      $product = $product_service->getProduct((int)$product_id);

      $sale_product = new SaleProduct();
      $sale_product->product_id = $product_id;
      $sale_product->quantity = (int)$quantity;
      $sale_product->size_id = $size_id;
      $sale_product->option_id = $option_id;
      $sale_product->name = $product->name;
      $sale_product->price = $product->price;
      $sale_product->image = $product->image;
      $sale_product->discounted_price = $product->discounted_price;
      $sale_product->subtotal = $sale_product->quantity * $sale_product->discounted_price;

      $this->products[$key] = $sale_product;
    }
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
  /*
      public function checkOut() {
          $product_service = new Product();
          $products = [];
          foreach($this->products as $key => $p) {
              $product = $product_service->getProduct((int)$p->product_id);

              $sale_product = new SaleProduct();
              $sale_product->product_id = $p->product_id;
              $sale_product->quantity = $p->quantity;
              $sale_product->name = $product->name;
              $sale_product->price = $product->price;
              $sale_product->image = $product->image;
              $sale_product->discounted_price = $product->discounted_price;

              $products[$key] = $sale_product;
          }
          return $products;
      }*/
}