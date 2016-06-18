<?php

use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeliveryDateTable extends Migration
{
  public function up()
  {
    Schema::create('delivery_date', function(Blueprint $t) {
      $t->date('date_value');
      $t->tinyInteger('day');
      $t->string('area', 50);
      $t->tinyInteger('stat');
      $t->primary('date_value');
    });

    $year = date('Y');
    $date = Carbon::create($year, 1, 1);
    for($i = 1; $i<=365; $i++) {
      $stat = 1;
      if (in_array($date->dayOfWeek, [2,4])) {
        $area = 'East / North / North-East';
      } else {
        $area = 'Central / West / North-West';
      }
      if (in_array($date->dayOfWeek, [0,1,6])) {
        $stat = 0;
      }
      $dayOfWeek = $date->dayOfWeek == 0 ? 7 : $date->dayOfWeek;
      DB::table('delivery_date')->insert([
        'date_value'=>$date, 'area'=>$area, 'stat'=>$stat, 'day'=>$dayOfWeek
      ]);
      $date->addDay(1);
    }
  }

  public function down()
  {
    Schema::dropIfExists('delivery_date');
  }
}
