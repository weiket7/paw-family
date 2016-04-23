<?php

use App\Models\Enums\ProductFeaturedStat;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductFeaturedTable extends Migration
{
  public function up()
  {
    Schema::create('product_featured', function(Blueprint $t) {
      $t->increments('product_featured_id');
      $t->integer('product_id');
      $t->string('pos', 50);
      $t->char('stat');
      $t->string('updated_by', 10);
      $t->timestamp('updated_at');
    });

    DB::table('product_featured')->insert([
      'product_featured_id'=>1,
      'product_id'=>1,
      'pos'=>1,
      'stat'=> ProductFeaturedStat::Hot,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);

    DB::table('product_featured')->insert([
      'product_featured_id'=>2,
      'product_id'=>3,
      'pos'=>2,
      'stat'=> ProductFeaturedStat::Sale,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);

    DB::table('product_featured')->insert([
      'product_featured_id'=>3,
      'product_id'=>4,
      'pos'=>3,
      'stat'=> ProductFeaturedStat::New2,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);

    DB::table('product_featured')->insert([
      'product_featured_id'=>4,
      'product_id'=>5,
      'pos'=>4,
      'stat'=> ProductFeaturedStat::Normal,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);

    DB::table('product_featured')->insert([
      'product_featured_id'=>5,
      'product_id'=>6,
      'pos'=>5,
      'stat'=> ProductFeaturedStat::Normal,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);

    DB::table('product_featured')->insert([
      'product_featured_id'=>6,
      'product_id'=>7,
      'pos'=>6,
      'stat'=> ProductFeaturedStat::Normal,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('product_featured');
  }
}
