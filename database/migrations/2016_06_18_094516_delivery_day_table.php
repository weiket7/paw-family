<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliveryDayTable extends Migration
{
  public function up()
  {
    Schema::create('delivery_day', function(Blueprint $t) {
      $t->integer('day');
      $t->string('area', 50);
      $t->primary('day');
    });

    DB::table('delivery_day')->insert([
      'day'=>2, 'area'=>'East / North / North-East'
    ]);
    DB::table('delivery_day')->insert([
      'day'=>3, 'area'=>'Central / West / North-West'
    ]);
    DB::table('delivery_day')->insert([
      'day'=>4, 'area'=>'East / North / North-East'
    ]);
    DB::table('delivery_day')->insert([
      'day'=>5, 'area'=>'Central / West / North-West'
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('delivery_day');
  }
}
