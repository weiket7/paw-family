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
        $t->string('identifier', 20);
        $t->string('name', 100);
        $t->string('slug', 100);
        $t->string('link', 200);
        $t->char('type', 1);
        $t->char('stat', 1);
        $t->string('image', 50);
        $t->string('dimension', 100);
        /*$t->integer('product_id');
        $t->integer('brand_id');
        $t->integer('category_id');
        $t->integer('promo_id');*/
        //$t->dateTime('start_on');
        //$t->dateTime('end_on');
        $t->string('updated_by', 10);
        $t->dateTime('updated_on');
      });

      DB::table('banner')->insert([
        'banner_id'=>1, 'identifier'=>'Main 1', 'name'=>'Muddy Paws Virgin Coconut Oil', 'slug'=>'muddy-paws-virgin-coconut-oil',
        'image'=>'muddy-paws-virgin-coconut-oil.jpg', 'dimension'=>'848px width x 460px height', 'link'=>'product/view/addiction-viva-la-venison',
        'stat'=>BannerStat::Active, 'type'=>BannerType::Product, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>2, 'identifier'=>'Main 2', 'name'=>'Organicfuls', 'slug'=>'organicfuls',
        'image'=>'organicfuls.jpg', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>3, 'identifier'=>'Main 3', 'name'=>'4-in-1 Roll Play Cat Toy', 'slug'=>'4-in-1-roll-play-cat-toy',
        'image'=>'4-in-1-roll-play-cat-toy.jpg', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>4, 'identifier'=>'Main 4', 'name'=>'', 'image'=>'', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Hidden, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>5, 'identifier'=>'Main 5', 'name'=>'', 'image'=>'', 'dimension'=>'848px width x 460px height', 'link'=>'',
        'stat'=>BannerStat::Hidden, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>6, 'identifier'=>'Right top', 'name'=>'', 'image'=>'banner_img_7.jpg', 'dimension'=>'262px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>7, 'identifier'=>'Right bottom', 'name'=>'', 'image'=>'banner_img_8.jpg', 'dimension'=>'262px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>8, 'identifier'=>'Bottom left', 'name'=>'Cocoyo Pet Sheet', 'image'=>'cocoyo-pet-sheet.jpg', 'dimension'=>'550px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);
      DB::table('banner')->insert([
        'banner_id'=>9, 'identifier'=>'Bottom right', 'name'=>'Busy Bunner', 'image'=>'busy-bunny.jpg', 'dimension'=>'550px width x 220px height', 'link'=>'',
        'stat'=>BannerStat::Active, 'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')]);

    }

    public function down()
    {
      Schema::dropIfExists('banner');
    }
}
