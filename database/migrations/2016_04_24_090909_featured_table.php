<?php

use App\Models\Enums\FeaturedType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FeaturedTable extends Migration
{
  public function up()
  {
    Schema::create('featured', function(Blueprint $t) {
      $t->increments('featured_id');
      $t->integer('product_id');
      $t->string('pos', 50);
      $t->char('type');
      $t->string('updated_by', 10);
      $t->dateTime('updated_on');
    });

    DB::table('featured')->insert([
      'featured_id'=>1,
      'product_id'=>1,
      'pos'=>1,
      'type'=> FeaturedType::Hot,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>2,
      'product_id'=>3,
      'pos'=>2,
      'type'=> FeaturedType::Sale,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>3,
      'product_id'=>4,
      'pos'=>3,
      'type'=> FeaturedType::New2,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>4,
      'product_id'=>5,
      'pos'=>4,
      'type'=> FeaturedType::Normal,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>5,
      'product_id'=>6,
      'pos'=>5,
      'type'=> FeaturedType::Normal,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>6,
      'product_id'=>7,
      'pos'=>6,
      'type'=> FeaturedType::Normal,
      'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('featured');
  }
}
