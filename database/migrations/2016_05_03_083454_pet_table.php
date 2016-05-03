<?php

use App\Models\Enums\PetSpecies;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PetTable extends Migration
{
    public function up()
    {
        Schema::create('pet', function (Blueprint $table) {
            $table->increments('pet_id');
            $table->integer('customer_id');
            $table->string('name', 20);
            $table->string('species', 15);
            $table->string('breed', 30);
            $table->char('adopted', 1);
            $table->dateTime('birthday', 1);
            $table->string('updated_by', 20);
            $table->dateTime('updated_on');
        });

        DB::table('pet')->insert([
            'pet_id'=>1, 'customer_id'=>1, 'name'=>'Girl Girl', 'species'=>PetSpecies::Dog, 'breed'=>'Cocker Spaniel',
            'adopted'=>'Y', 'birthday'=>'2006-06-06',
            'updated_by'=>'Wei Ket', 'updated_on'=>date("Y-m-d H:i:s")
        ]);
    }

    public function down()
    {
        Schema::dropIfExists('pet');
    }
}
