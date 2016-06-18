<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductSizeTable extends Migration
{
  public function up()
  {
    Schema::create('product_size', function(Blueprint $t) {
      $t->increments('size_id');
      $t->integer('product_id');
      $t->string('name', 20);
      $t->integer('quantity');
      $t->decimal('price', 7, 2);
      $t->decimal('cost_price', 7, 2);
      $t->decimal('discount_amt', 7, 2); //round down
      $t->decimal('discount_percentage', 5, 2);
      $t->char('discount_type', 1); //A or P
      $t->decimal('discounted_price', 7, 2);
      $t->decimal('weight_lb', 5, 2);
      $t->decimal('weight_kg', 5, 2);
      $t->string('updated_by', 20);
      $t->dateTime('updated_on');
    });

    DB::table('product_size')->insert([
      'size_id'=>1, 'product_id'=>1, 'name'=>'Small', 'quantity'=>5, 'weight_lb'=>4, 'weight_kg'=>1.81, 'cost_price'=>24.1, 'price'=>39.1,
      'discount_amt'=>10, 'discount_type'=>'A', 'discounted_price'=>29.1,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('product_size')->insert([
      'size_id'=>2, 'product_id'=>1, 'name'=>'Medium', 'quantity'=>10, 'weight_lb'=>20, 'weight_kg'=>9.07, 'cost_price'=>126.9, 'price'=>142.9,
      'discount_amt'=>10, 'discount_type'=>'A', 'discounted_price'=>132.9,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('product_size')->insert([
      'size_id'=>3, 'product_id'=>1, 'name'=>'Large', 'quantity'=>0, 'weight_lb'=>33, 'weight_kg'=>14.96, 'cost_price'=>170, 'price'=>195.55,
      'discount_amt'=>19.55, 'discount_type'=>'P', 'discounted_price'=>176, 'discount_percentage'=>10,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('product_size');
  }
}
