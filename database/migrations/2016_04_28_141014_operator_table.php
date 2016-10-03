<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class OperatorTable extends Migration
{
  public function up()
  {
    Schema::create('operator', function (Blueprint $table) {
      $table->increments('operator_id');
      $table->string('username', 50);
      $table->string('password');
      //$table->string('email');
      $table->dateTime('last_login_at');
      $table->rememberToken();
    });

    DB::table('operator')->insert([
      'operator_id'=>1, 'username'=>'ruth', 'password'=>Hash::make("Pawpaw168"),
      'last_login_at'=>date('Y-m-d H:i:s')]);
    DB::table('operator')->insert([
      'operator_id'=>2, 'username'=>'admin1', 'password'=>Hash::make("Pawpaw123"),
      'last_login_at'=>date('Y-m-d H:i:s')]);
    DB::table('operator')->insert([
      'operator_id'=>3, 'username'=>'admin2', 'password'=>Hash::make("Pawpaw456"),
      'last_login_at'=>date('Y-m-d H:i:s')]);
    DB::table('operator')->insert([
      'operator_id'=>4, 'username'=>'admin3', 'password'=>Hash::make("Pawpaw789"),
      'last_login_at'=>date('Y-m-d H:i:s')]);
  }

  public function down()
  {
    Schema::dropIfExists('operator');
  }
}