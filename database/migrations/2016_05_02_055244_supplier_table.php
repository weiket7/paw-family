<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SupplierTable extends Migration
{
  public function up()
  {
    Schema::create('supplier', function (Blueprint $table) {
      $table->increments('supplier_id');
      $table->char('stat', 1);
      $table->string('name', 50);
    });

    DB::table('supplier')->insert([
      'supplier_id'=>1, 'stat'=>'', 'name'=>'Addiction Pet Foods'
    ]);
    DB::table('supplier')->insert([
      'supplier_id'=>2, 'stat'=>'', 'name'=>'Primal Pet Foods'
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('supplier');
  }
}
