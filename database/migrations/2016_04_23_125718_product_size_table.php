<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductSizeTable extends Migration
{
    public function up()
    {
      Schema::create('product_size', function(Blueprint $t) {
        $t->increments('product_size_id');
        $t->integer('product_id');
        $t->string('size_name', 10);
        $t->integer('quantity');
        $t->decimal('price', 7, 2);
        $t->decimal('discount_amt', 7, 2); //10% or $10, detect based on %
        $t->char('discount_type', 1); //A or P
        $t->decimal('weight_lb', 5, 2);
        $t->decimal('weight_kg', 5, 2);
        $t->string('updated_by', 10);
        $t->timestamp('updated_at');
      });

      DB::table('product_size')->insert([
        'product_size_id'=>1, 'product_id'=>1, 'size_name'=>'Small', 'quantity'=>5, 'weight_lb'=>4, 'price'=>39.1,
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);
      DB::table('product_size')->insert([
        'product_size_id'=>2, 'product_id'=>1, 'size_name'=>'Medium', 'quantity'=>10, 'weight_lb'=>20, 'price'=>142.9,
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);
      DB::table('product_size')->insert([
        'product_size_id'=>3, 'product_id'=>1, 'size_name'=>'Large', 'quantity'=>0, 'weight_lb'=>33, 'price'=>195.55,
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);
    }

    public function down()
    {
      Schema::dropIfExists('product_size');
    }
}
