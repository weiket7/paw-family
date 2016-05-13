<?php

use App\Models\Enums\BannerStat;
use App\Models\Enums\BannerType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class BannerTable extends Migration
{
    public function up()
    {
      Schema::create('banner', function(Blueprint $t) {
        $t->increments('banner_id');
        $t->string('name');
        $t->string('link', 200);
        $t->char('type', 1);
        $t->char('stat', 1);
        $t->string('image', 50);
        $t->string('dimension', 100);
        $t->integer('product_id');
        $t->integer('brand_id');
        $t->integer('category_id');
        $t->integer('promo_id');
        //$t->dateTime('start_on');
        //$t->dateTime('end_on');
        $t->string('updated_by', 10);
        $t->dateTime('updated_on');
      });

      DB::table('banner')->insert([
        'banner_id'=>1, 'name'=>'Main 1', 'image'=>'slide_04.jpg', 'dimension'=>'848px width x 460px height', 'link'=>'product/view/addiction-viva-la-venison',
        'stat'=>BannerStat::Active, 'type'=>BannerType::Product, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>2, 'name'=>'Main 2', 'image'=>'slide_04.jpg', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>3, 'name'=>'Main 3', 'image'=>'slide_04.jpg', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Hidden, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>4, 'name'=>'Main 4', 'image'=>'', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Hidden, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>5, 'name'=>'Main 5', 'image'=>'', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>6, 'name'=>'Right top', 'image'=>'banner_img_7.jpg', 'dimension'=>'262px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>7, 'name'=>'Right bottom', 'image'=>'banner_img_8.jpg', 'dimension'=>'262px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>8, 'name'=>'Bottom left', 'image'=>'banner_img_1.png', 'dimension'=>'550px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>9, 'name'=>'Bottom right', 'image'=>'banner_img_1.png', 'dimension'=>'550px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);

    }

    public function down()
    {
      Schema::dropIfExists('banner');
    }
}
