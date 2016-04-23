<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerTable extends Migration
{
    public function up()
    {
      Schema::create('customer', function (Blueprint $table) {
        $table->increments('customer_id');
        $table->string('name');
        $table->string('email');
        $table->string('password');
        $table->rememberToken();
        $table->timestamps();
      });
    }

    public function down()
    {
      Schema::dropIfExists('customer');

    }
}
