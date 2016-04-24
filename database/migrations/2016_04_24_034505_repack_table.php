<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RepackTable extends Migration
{
  public function up()
  {
    Schema::create('repack', function(Blueprint $t) {
      $t->increments('repack_id');
      $t->integer('product_id');
      $t->integer('size_id');
      $t->string('repack_name', 20);
      $t->decimal('cost', 5, 2);
      $t->string('updated_by', 10);
      $t->timestamp('updated_at');
    });

    DB::table('repack')->insert([
      'repack_id'=>1, 'product_id'=>1, 'size_id'=>2, 'repack_name'=>'2 packs - $0',
      'cost'=>0,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('repack')->insert([
      'repack_id'=>2, 'product_id'=>1, 'size_id'=>2, 'repack_name'=>'3 packs - $1',
      'cost'=>1,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('repack')->insert([
      'repack_id'=>3, 'product_id'=>1, 'size_id'=>3, 'repack_name'=>'3 packs - $0',
      'cost'=>0,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('repack')->insert([
      'repack_id'=>4, 'product_id'=>1, 'size_id'=>3, 'repack_name'=>'4 packs - $1',
      'cost'=>1,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('repack');

  }
}
