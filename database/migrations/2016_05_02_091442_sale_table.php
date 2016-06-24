<?php

use App\Models\Enums\DeliveryChoice;
use App\Models\Enums\DeliveryTime;
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
      $t->string('sale_no', 12);
      $t->integer('customer_id');
      $t->char('stat', 1);
      $t->char('payment_type', 1);
      $t->dateTime('sale_on');
      $t->dateTime('paid_on')->nullable();
      $t->dateTime('delivered_on')->nullable();
      $t->decimal('gross_total', 9,2);
      $t->decimal('product_discount', 9,2);
      $t->integer('promo_id')->nullable();
      $t->decimal('promo_discount', 9,2);
      $t->decimal('redeemed_amt', 9,2)->nullable();
      $t->integer('redeemed_points')->nullable();
      $t->integer('earned_points')->nullable();
      $t->decimal('bulk_discount', 9,2)->nullable();
      $t->decimal('delivery_amt', 9, 2);
      $t->date('delivery_date');
      $t->decimal('nett_total', 9,2); //after subtractions
      $t->decimal('cost_total', 9, 2);
      $t->decimal('profit_total', 9, 2); //nett_total - cost_total
      $t->char('delivery_choice', 1);
      $t->string('address', 100);
      $t->string('postal', 10);
      $t->string('building', 20)->nullable();
      $t->string('lift_lobby', 10)->nullable();
      $t->string('delivery_time', 20);
      $t->string('bank_ref', 20)->nullable();
      $t->string('customer_remark', 200)->nullable();
      $t->string('operator_remark', 200)->nullable();
    });

    DB::table('sale')->insert([
      'sale_id'=>1, 'sale_no'=>'123456', 'customer_id'=>1, 'stat'=>SaleStat::Paid, 'payment_type'=>PaymentType::Bank,
      'delivery_choice'=> DeliveryChoice::OtherAddress, 'address'=>'my other address', 'delivery_time'=> DeliveryTime::$values[DeliveryTime::AnyTime],
      'customer_remark'=>'customer remark', 'product_discount'=>20, 'redeemed_amt'=>10, 'redeemed_points'=>1200,
      'gross_total'=>377.65, 'nett_total'=>347.65, 'earned_points'=>357, 'sale_on'=>date('Y-m-d H:i:s'), 'bank_ref'=>'1234-5678-1234'
    ]);

    DB::table('sale')->insert([
      'sale_id'=>2, 'sale_no'=>'123457', 'customer_id'=>1, 'stat'=>SaleStat::Pending, 'payment_type'=>PaymentType::Paypal,
      'delivery_choice'=> DeliveryChoice::CurrentAddress, 'address'=>'', 'delivery_time'=> DeliveryTime::$values[DeliveryTime::Four30to8],
      'customer_remark'=>'customer remark', 'product_discount'=>1,
      'gross_total'=>21, 'nett_total'=>20, 'earned_points'=>20, 'sale_on'=>date('Y-m-d H:i:s'),
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('sale');
  }
}
