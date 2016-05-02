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

      DB::table('setting')->insert(['setting_id'=>1, 'name'=>'freedeliveryaboveorequalto', 'value'=>'80', 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')]);
    }

    public function down()
    {
      Schema::dropIfExists('setting');
    }
}
