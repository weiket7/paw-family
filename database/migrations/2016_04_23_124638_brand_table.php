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
      $t->string('image', 50);
      $t->mediumInteger('pos');
      $t->string('updated_by', 10);
      $t->timestamp('updated_at');
    });

    DB::table('brand')->insert([
      'brand_id'=>1, 'name'=>'Addiction', 'image'=>'addiction.jpg',
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>2, 'name'=>'ANF', 'image'=>'anf.jpg',
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>3, 'name'=>'Avoderm', 'image'=>'avoderm.jpg',
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>4, 'name'=>'Barking Heads', 'image'=>'barking-heads.jpg',
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
    DB::table('brand')->insert([
      'brand_id'=>5, 'name'=>'Bosch', 'image'=>'bosch.jpg',
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('brand');
  }
}
