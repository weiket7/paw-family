<?php

use App\Models\Enums\CustomerStat;
use App\Models\Enums\SubscribeStat;
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
        $table->string("phone", 20)->nullable();
        $table->string("address", 200);
        $table->string("postal", 10);
        $table->string("building", 10)->nullable();
        $table->string("lift_lobby", 10)->nullable();
        $table->date("birthday")->nullable();
        $table->integer("points");
        $table->char("subscribe", 1);
        $table->decimal("spent_total", 9, 2);
        $table->integer("order_count");
        $table->decimal("spent_avg", 9, 2);
        $table->dateTime("last_login_on");
        $table->dateTime("joined_on");
        $table->dateTime("updated_at");
        $table->rememberToken();
      });

      DB::table('customer')->insert([
        'customer_id'=>1,
        'stat'=>CustomerStat::Active,
        'email'=>'wei_ket@hotmail.com',
        'password'=>Hash::make("test1234"),
        'name'=>'Ong Wei Ket',
        'mobile'=>'9011 0130',
        'phone'=>'6123 4567',
        'postal'=>'470134',
        'lift_lobby'=>'A',
        'address'=>'Blk 134, Bedok Reservoir Rd',
        'birthday'=>'1989-01-05',
        'subscribe'=> SubscribeStat::Yes,
        'spent_total'=>0,
        'order_count'=>0,
        'points'=>377,
        'last_login_on'=>date("Y-m-d H:i:s"),
        'joined_on'=>'2016-05-01',
      ]);
    }

    public function down()
    {
      Schema::dropIfExists('customer');
    }
}
