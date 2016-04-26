<?php

use App\Models\Enums\FeaturedStat;
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
      $t->char('stat');
      $t->string('updated_by', 10);
      $t->timestamp('updated_at');
    });

    DB::table('featured')->insert([
      'featured_id'=>1,
      'product_id'=>1,
      'pos'=>1,
      'stat'=> FeaturedStat::Hot,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>2,
      'product_id'=>3,
      'pos'=>2,
      'stat'=> FeaturedStat::Sale,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>3,
      'product_id'=>4,
      'pos'=>3,
      'stat'=> FeaturedStat::New2,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>4,
      'product_id'=>5,
      'pos'=>4,
      'stat'=> FeaturedStat::Normal,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>5,
      'product_id'=>6,
      'pos'=>5,
      'stat'=> FeaturedStat::Normal,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);

    DB::table('featured')->insert([
      'featured_id'=>6,
      'product_id'=>7,
      'pos'=>6,
      'stat'=> FeaturedStat::Normal,
      'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('featured');
  }
}
