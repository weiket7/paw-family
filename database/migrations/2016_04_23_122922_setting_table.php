<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingTable extends Migration
{
    public function up()
    {
      Schema::create('setting', function(Blueprint $t) {
        $t->increments('setting_id');
        $t->string('name', 50);
        $t->string('value', 50);
        $t->string('updated_on', 10);
        $t->timestamp('updated_at');
      });

      DB::table('setting')->insert([
        'setting_id'=>1, 'name'=>'freedeliveryaboveorequalto', 'value'=>'80',
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>2, 'name'=>'deliveryfee', 'value'=>'10',
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>3, 'name'=>'cbdsurcharge', 'value'=>'5',
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>4, 'name'=>'redeemfirstpoint', 'value'=>1200,
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>5, 'name'=>'redeemfirstamt', 'value'=>10,
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>6, 'name'=>'redeemsecondpoint', 'value'=>3000,
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>7, 'name'=>'redeemsecondamt', 'value'=>25,
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>8, 'name'=>'redeemthirdpoint', 'value'=>5000,
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('setting')->insert([
        'setting_id'=>9, 'name'=>'redeemthirdamt', 'value'=>50,
        'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);

    }

    public function down()
    {
      Schema::dropIfExists('setting');
    }
}
