<?php

use App\Models\Enums\DiscountType;
use App\Models\Enums\PromoType;
use Carbon\Carbon;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromoTable extends Migration
{
    public function up()
    {
        Schema::create('promo', function (Blueprint $table) {
            $table->increments('promo_id');
            $table->string('promo_code', 20);
            $table->char('type', 1);
            $table->decimal('discount_amt', 9,2);
            $table->char('discount_type', 1);
            $table->dateTime('start_on');
            $table->dateTime('end_on');
            $table->dateTime('updated_on');
        });

        $today = Carbon::today();
        $one_week_later = $today->addDay(7);

        DB::table('promo')->insert([
            'promo_id'=>1, 'promo_code'=>'pawpaw', 'type'=> PromoType::All, 'discount_amt'=>10, 'discount_type'=> DiscountType::Amount,
            'start_on'=>$today, 'end_on'=>$one_week_later, 'updated_on'=>date("Y-m-d H:i:s")
        ]);
        DB::table('promo')->insert([
            'promo_id'=>2, 'promo_code'=>'pawfect', 'type'=> PromoType::Product, 'discount_amt'=>10, 'discount_type'=> DiscountType::Percentage,
            'start_on'=>$today, 'end_on'=>$one_week_later, 'updated_on'=>date("Y-m-d H:i:s")
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('promo');
    }
}
