<?php

use App\Models\Enums\ProductOptionType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductOptionTable extends Migration
{
  public function up()
  {
    Schema::create('product_option', function(Blueprint $t) {
      $t->increments('option_id');
      $t->integer('product_id');
      $t->integer('size_id');
      $t->string('name', 20);
      $t->char('type', 1);
      $t->decimal('price', 5, 2);
      $t->string('updated_by', 10);
      $t->dateTime('updated_on');
    });

    DB::table('product_option')->insert([
      'option_id'=>1, 'product_id'=>1, 'size_id'=>2, 'name'=>'2 packs', 'type'=> ProductOptionType::Repack, 'price'=>0,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('product_option')->insert([
      'option_id'=>2, 'product_id'=>1, 'size_id'=>2, 'name'=>'3 packs', 'type'=> ProductOptionType::Repack, 'price'=>1,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('product_option')->insert([
      'option_id'=>3, 'product_id'=>1, 'size_id'=>3, 'name'=>'3 packs', 'type'=> ProductOptionType::Repack, 'price'=>0,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
    DB::table('product_option')->insert([
      'option_id'=>4, 'product_id'=>1, 'size_id'=>3, 'name'=>'4 packs', 'type'=> ProductOptionType::Repack, 'price'=>1,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('product_option');
  }
}
