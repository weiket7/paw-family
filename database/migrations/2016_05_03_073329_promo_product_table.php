<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PromoProductTable extends Migration
{
    public function up()
    {
        Schema::create('promo_product', function (Blueprint $table) {
            $table->primary(['promo_id', 'product_id']);
            $table->integer('promo_id');
            $table->integer('product_id');
            $table->decimal('discount_amt', 9,2);
            $table->char('discount_type', 1);
        });

        DB::table('promo_product')->insert([
            'promo_id'=>1, 'product_id'=>1
        ]);
        DB::table('promo_product')->insert([
            'promo_id'=>1, 'product_id'=>2
        ]);
        DB::table('promo_product')->insert([
            'promo_id'=>2, 'product_id'=>1
        ]);
        DB::table('promo_product')->insert([
            'promo_id'=>2, 'product_id'=>2
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('promo_product');
    }
}
