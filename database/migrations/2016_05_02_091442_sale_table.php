<?php

use App\Models\Enums\PaymentType;
use App\Models\Enums\SaleStat;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaleTable extends Migration
{
  public function up()
  {
    Schema::create('sale', function (Blueprint $table) {
      $table->increments('sale_id');
      $table->string('sale_code', 10);
      $table->integer('customer_id');
      $table->char('stat', 1);
      $table->char('payment_type', 1);
      $table->decimal('delivery_fee', 9, 2);
      $table->decimal('discount_total', 9,2);
      $table->decimal('gross_total', 9,2);
      $table->decimal('nett_total', 9,2); //after subtractions
      $table->integer('point');
      $table->dateTime('sale_on');
    });

    DB::table('sale')->insert([
      'sale_id'=>1, 'sale_code'=>'123456', 'customer_id'=>1, 'stat'=> SaleStat::Delivered, 'payment_type'=>PaymentType::Bank,
      'gross_total'=>168.05, 'nett_total'=>168.05, 'point'=>168, 'sale_on'=>date('Y-m-d H:i:s'),
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('sale');
  }
}
