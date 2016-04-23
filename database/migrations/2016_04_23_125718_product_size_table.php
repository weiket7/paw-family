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
        $t->integer('quantity');
        $t->decimal('weight_lb', 5, 2);
        $t->decimal('weight_kg', 5, 2);
        $t->string('updated_by', 10);
        $t->timestamp('updated_at');
      });
    }

    public function down()
    {
      Schema::dropIfExists('product_size');

    }
}
