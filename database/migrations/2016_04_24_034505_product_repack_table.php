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
      $t->string('repack_name', 20);
      $t->decimal('cost', 5, 2);
      $t->string('updated_by', 10);
      $t->timestamp('updated_at');
    });

    DB::table('product_repack')->insert([
      'product_repack_id'=>1, 'product_id'=>1, 'product_size_id'=>2, 'repack_name'=>'2 packs',
      'cost'=>0,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('product_repack')->insert([
      'product_repack_id'=>2, 'product_id'=>1, 'product_size_id'=>2, 'repack_name'=>'3 packs',
      'cost'=>1,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('product_repack')->insert([
      'product_repack_id'=>3, 'product_id'=>1, 'product_size_id'=>3, 'repack_name'=>'3 packs',
      'cost'=>0,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('product_repack')->insert([
      'product_repack_id'=>4, 'product_id'=>1, 'product_size_id'=>3, 'repack_name'=>'4 packs',
      'cost'=>1,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('product_repack');

  }
}
