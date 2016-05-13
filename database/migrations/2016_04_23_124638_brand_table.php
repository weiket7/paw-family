<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BrandTable extends Migration
{
  public function up()
  {
    Schema::create('brand', function(Blueprint $t) {
      $t->increments('brand_id');
      $t->string('name', 50);
      $t->string('slug', 50);
      $t->string('image', 50);
      $t->integer('product_count');
      $t->mediumInteger('pos');
      $t->string('updated_by', 10);
      $t->dateTime('updated_on');
    });

    DB::table('brand')->insert([
      'brand_id'=>1, 'name'=>'Addiction', 'slug'=>'addiction', 'image'=>'addiction.jpg', 'product_count'=>19, 'pos'=>1,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>2, 'name'=>'ANF', 'slug'=>'anf', 'image'=>'anf.jpg', 'pos'=>2,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>3, 'name'=>'Avoderm', 'slug'=>'avoderm', 'image'=>'avoderm.jpg', 'product_count'=>0, 'pos'=>3,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>4, 'name'=>'Barking Heads', 'slug'=>'barking-heads', 'image'=>'barking-heads.jpg', 'product_count'=>0, 'pos'=>4,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>5, 'name'=>'Bosch', 'slug'=>'bosch', 'image'=>'bosch.png', 'product_count'=>0, 'pos'=>5,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>6, 'name'=>'Primal', 'slug'=>'primal', 'image'=>'primal.jpg', 'product_count'=>4, 'pos'=>6,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>7, 'name'=>'Nutripe', 'slug'=>'nutripe', 'image'=>'nutripe.jpg', 'product_count'=>2, 'pos'=>7,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('brand');
  }
}
