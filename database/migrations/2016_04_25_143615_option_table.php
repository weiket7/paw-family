<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OptionTable extends Migration
{
  public function up()
  {
    Schema::create('option', function(Blueprint $t) {
      $t->increments('option_id');
      $t->integer('product_id');
      $t->integer('size_id');
      $t->string('name', 20);
      $t->char('type', 1);
      $t->decimal('price', 5, 2);
      $t->string('updated_by', 10);
      $t->timestamp('updated_at');
    });

    DB::table('option')->insert([
      'option_id'=>1, 'product_id'=>1, 'size_id'=>2, 'name'=>'2 packs', 'type'=>'R', 'price'=>0,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);
    DB::table('option')->insert([
      'option_id'=>2, 'product_id'=>1, 'size_id'=>2, 'name'=>'3 packs', 'type'=>'R', 'price'=>1,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);
    DB::table('option')->insert([
      'option_id'=>3, 'product_id'=>1, 'size_id'=>3, 'name'=>'3 packs', 'type'=>'R', 'price'=>0,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);
    DB::table('option')->insert([
      'option_id'=>4, 'product_id'=>1, 'size_id'=>3, 'name'=>'4 packs', 'type'=>'R', 'price'=>1,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('option');

  }
}
