<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaleProductTable extends Migration
{
  public function up()
  {
    Schema::create('sale_product', function (Blueprint $table) {
      $table->increments('sale_product_id');
      $table->integer('sale_id');
      $table->string('sale_no', 15);
      $table->integer('product_id');
      $table->string('name', 150);
      $table->integer('size_id')->nullable();
      $table->string('size_name', 20)->nullable();
      $table->integer('option_id')->nullable();
      $table->string('option_name', 20)->nullable();
      $table->decimal('option_price', 9,2)->nullable();
      $table->smallInteger('quantity');
      $table->decimal('cost_price', 9,2);
      $table->decimal('price', 9,2);
      $table->decimal('discounted_price', 9,2);
      $table->decimal('discount_amt', 9,2)->nullable();
      $table->decimal('discount_percentage', 9,2)->nullable();
      $table->boolean('bulk_discount_applicable');
      $table->decimal('subtotal', 9,2);
    });

    DB::table('sale_product')->insert([
      'sale_id'=>1, 'product_id'=>1, 'quantity'=>2, 'size_id'=>2, 'size_name'=>'Medium', 'option_id'=>2, 'option_name'=>'3 packs',
      'option_price'=>1, 'name'=>'Addiction Viva La Venison',
      'cost_price'=>126.9, 'price'=>142.9, 'discounted_price'=>132.9, 'subtotal'=>267.8,
    ]);
    DB::table('sale_product')->insert([
      'sale_id'=>1, 'product_id'=>3, 'quantity'=>3,
      'name'=>'Addiction Le Lamb',
      'cost_price'=>24.95, 'price'=>29.95, 'discounted_price'=>29.95, 'subtotal'=>89.85,
    ]);

    DB::table('sale_product')->insert([
      'sale_id'=>2, 'product_id'=>24, 'quantity'=>4,
      'name'=>'Nutripe Ambrosia Turkey with Green Tripe Canned Dog Food',
      'cost_price'=>4, 'price'=>5.25, 'discounted_price'=>5, 'subtotal'=>20,
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('sale_product');
  }
}
