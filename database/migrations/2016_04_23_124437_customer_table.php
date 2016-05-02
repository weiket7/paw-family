<?php

use App\Models\Enums\CustomerStat;
use App\Models\Enums\SubscribeEmailStat;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CustomerTable extends Migration
{
    public function up()
    {
      Schema::create('customer', function (Blueprint $table) {
        $table->increments('customer_id');
        $table->char('stat');
        $table->string('email');
        $table->string('password');
        $table->string('name');
        $table->string("mobile", 20);
        $table->string("phone", 20);
        $table->string("postal", 10);
        $table->string("address", 200);
        $table->dateTime("birthday");
        $table->char("subscribe_email", 1);
        $table->decimal("spent_amt_total", 9, 2);
        $table->integer("order_count");
        $table->dateTime("last_login_on");
        $table->dateTime("joined_on");
        $table->rememberToken();
      });

      DB::table('customer')->insert([
        'customer_id'=>1,
        'stat'=>CustomerStat::Active,
        'email'=>'wei_ket@hotmail.com',
        'password'=>Hash::make("test168"),
        'name'=>'Ong Wei Ket',
        'mobile'=>'9011 0130',
        'phone'=>'6123 4567',
        'postal'=>'470134',
        'address'=>'Blk 134, Bedok Reservoir Rd',
        'birthday'=>'1989-01-05',
        'subscribe_email'=> SubscribeEmailStat::Yes,
        'spent_amt_total'=>0,
        'order_count'=>0,
        'last_login_on'=>date("Y-m-d H:i:s"),
        'joined_on'=>'2016-05-01',
      ]);
    }

    public function down()
    {
      Schema::dropIfExists('customer');
    }
}
