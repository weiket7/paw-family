<?php

use App\Models\Enums\PaymentType;
use App\Models\Enums\SaleStat;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SaleTable extends Migration
{
  public function up()
  {
    Schema::create('sale', function (Blueprint $t) {
      $t->increments('sale_id');
      $t->string('sale_no', 10);
      $t->integer('customer_id');
      $t->char('stat', 1);
      $t->char('payment_type', 1);
      $t->dateTime('sale_on');
      $t->decimal('gross_total', 9,2);
      $t->decimal('product_discount', 9,2);
      $t->integer('promo_id')->nullable();
      $t->decimal('promo_discount', 9,2);
      $t->decimal('flat_discount', 9,2);
      $t->decimal('delivery_fee', 9, 2);
      $t->decimal('nett_total', 9,2); //after subtractions
      $t->integer('point');
      $t->char('delivery_choice', 1);
      $t->string('delivery_address', 200);
      $t->string('delivery_time', 20);
      $t->string('customer_remark', 200)->nullable();
      $t->string('operator_remark', 200)->nullable();
    });

    DB::table('sale')->insert([
      'sale_id'=>1, 'sale_no'=>'123456', 'customer_id'=>1, 'stat'=> SaleStat::Delivered, 'payment_type'=>PaymentType::Bank,
      'gross_total'=>168.05, 'nett_total'=>168.05, 'point'=>168, 'sale_on'=>date('Y-m-d H:i:s'),
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('sale');
  }
}
