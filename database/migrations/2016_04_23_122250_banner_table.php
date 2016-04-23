<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BannerTable extends Migration
{
    public function up()
    {
      Schema::create('banner', function(Blueprint $t) {
        $t->increments('banner_id');
        $t->string('name');
        $t->string('image', 50);
        $t->tinyInteger('pos');
        $t->char('stat', 1);
        $t->string('updated_by', 10);
        $t->timestamp('updated_at');
      });

      DB::table('banner')->insert([
        'banner_id'=>1, 'image'=>'slider_layer_img.png', 'pos'=>1,
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('banner')->insert([
        'banner_id'=>2, 'image'=>'slide_04.jpg', 'pos'=>2,
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('banner')->insert([
        'banner_id'=>3, 'image'=>'slide_04.jpg', 'pos'=>3,
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
    }

    public function down()
    {
      Schema::dropIfExists('banner');
    }
}
