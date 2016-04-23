<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductRepackTable extends Migration
{
  public function up()
  {
    Schema::create('product_repack', function(Blueprint $t) {
      $t->increments('product_repack_id');
      $t->integer('product_id');
      $t->integer('product_size_id');
      $t->decimal('cost', 5, 2);
      $t->string('updated_by', 10);
      $t->timestamp('updated_at');
    });
  }

  public function down()
  {
    Schema::dropIfExists('product_repack');

  }
}
