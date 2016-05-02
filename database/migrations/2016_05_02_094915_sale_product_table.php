<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaleProductTable extends Migration
{
    public function up()
    {
      Schema::create('sale_product', function (Blueprint $table) {
        $table->primary(['sale_id', 'product_id']);
        $table->integer('sale_id');
        $table->integer('sale_code');
        $table->integer('product_id');
        $table->smallInteger('quantity');
        $table->decimal('price', 9,2);
        $table->decimal('subtotal', 9,2);
      });

      DB::table('sale_product')->insert([
        'sale_id'=>1, 'sale_code'=>'123456', 'product_id'=>2, 'quantity'=>2,
        'price'=>39.10, 'subtotal'=>78.2,
      ]);
      DB::table('sale_product')->insert([
        'sale_id'=>1, 'sale_code'=>'123456', 'product_id'=>3, 'quantity'=>3,
        'price'=>29.95, 'subtotal'=>89.85,
      ]);
    }

    public function down()
    {
        Schema::dropIfExists('sale_product');
    }
}
