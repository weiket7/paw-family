<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaleRunningNoTable extends Migration
{
    public function up()
    {
      Schema::create('sale_running_no', function (Blueprint $table) {
        $table->string('value', 15);
      });

      DB::table('sale_running_no')->insert(['value'=>100018619]);
    }

    public function down()
    {
      Schema::dropIfExists('sale_running_no');
    }
}
