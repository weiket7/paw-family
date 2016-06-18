<?php

use App\Models\Enums\PointType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PointLogTable extends Migration
{
  public function up()
  {
    Schema::create('point_log', function (Blueprint $table) {
      $table->increments('point_log_id');
      $table->integer('customer_id');
      $table->integer('sale_id');
      $table->string('sale_no', 12);
      $table->char('sign', 1);
      $table->char('type', 1);
      $table->integer('point_change');
      $table->integer('point_before');
      $table->integer('point_after');
      $table->dateTime('created_on');
    });

    
    DB::table('point_log')->insert([
      'customer_id'=>1,
      'sale_id'=>1,
      'sign'=>'+',
      'type'=> PointType::Award,
      'sale_no'=>'123456',
      'point_change'=>357,
      'point_before'=>0,
      'point_after'=>357,
      'created_on'=>date('Y-m-d'),
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('point_log');
  }
}
