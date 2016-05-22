<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaleProductTable extends Migration
{
  public function up()
  {
    Schema::create('sale_product', function (Blueprint $table) {
      $table->integer('sale_id');
      $table->integer('product_id');
      $table->integer('size_id');
      $table->integer('option_id');
      $table->smallInteger('quantity');
      $table->decimal('price', 9,2);
      $table->decimal('discounted_price', 9,2);
      $table->decimal('discount_amt', 9,2);
      $table->decimal('discount_percentage', 9,2);
      $table->decimal('subtotal', 9,2);
    });

    DB::table('sale_product')->insert([
        'sale_id'=>1, 'product_id'=>2, 'quantity'=>2,
        'discounted_price'=>35.19, 'price'=>39.10, 'subtotal'=>78.2,
    ]);
    DB::table('sale_product')->insert([
        'sale_id'=>1, 'product_id'=>3, 'quantity'=>3,
        'discounted_price'=>29.95, 'price'=>29.95, 'subtotal'=>89.85,
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('sale_product');
  }
}
