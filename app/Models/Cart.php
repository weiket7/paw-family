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
            $this->products[$key]['quantity'] += $quantity;
        } else {
            $this->products[$key] = [
                'product_id'=>$product_id,
                'quantity'=>$quantity,
                'size_id'=>$size_id,
                'option_id'=>$option_id,
            ];
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

    public function checkOut() {
        $product_service = new Product();
        $products = [];
        foreach($this->products as $key => $p) {
            $product = $product_service->getProduct((int)$p['product_id']);
            $products[$key] = (object)[
                'name'=>$product->name,
                'quantity'=>$p['quantity'],
                'price'=>$product->price,
                'image'=>$product->image,
                'discounted_price'=>$product->discounted_price,
            ];
        }
        return $products;
    }
}