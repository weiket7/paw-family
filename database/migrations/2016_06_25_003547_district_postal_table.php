<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DistrictPostalTable extends Migration
{
    public function up()
    {
      Schema::create('district_postal', function (Blueprint $table) {
        $table->integer('district');
        $table->integer('postal');
        $table->tinyInteger('CBD');
      });

      //http://propertyinvestmentsingapore.sg/blog/singapore-district-map/
      $district_postal[] = ['district'=>1, 'postal'=>1];
      $district_postal[] = ['district'=>1, 'postal'=>2];
      $district_postal[] = ['district'=>1, 'postal'=>3];
      $district_postal[] = ['district'=>1, 'postal'=>4];
      $district_postal[] = ['district'=>1, 'postal'=>5];
      $district_postal[] = ['district'=>1, 'postal'=>6];
      $district_postal[] = ['district'=>2, 'postal'=>7];
      $district_postal[] = ['district'=>2, 'postal'=>8];
      $district_postal[] = ['district'=>3, 'postal'=>14];
      $district_postal[] = ['district'=>3, 'postal'=>15];
      $district_postal[] = ['district'=>3, 'postal'=>16];
      $district_postal[] = ['district'=>4, 'postal'=>9];
      $district_postal[] = ['district'=>4, 'postal'=>10];
      $district_postal[] = ['district'=>5, 'postal'=>11];
      $district_postal[] = ['district'=>5, 'postal'=>12];
      $district_postal[] = ['district'=>5, 'postal'=>13];
      $district_postal[] = ['district'=>6, 'postal'=>17, 'CBD'=>1];
      $district_postal[] = ['district'=>7, 'postal'=>18, 'CBD'=>1];
      $district_postal[] = ['district'=>7, 'postal'=>19, 'CBD'=>1];
      $district_postal[] = ['district'=>8, 'postal'=>20, 'CBD'=>1];
      $district_postal[] = ['district'=>8, 'postal'=>21, 'CBD'=>1];
      $district_postal[] = ['district'=>9, 'postal'=>22, 'CBD'=>1];
      $district_postal[] = ['district'=>9, 'postal'=>23, 'CBD'=>1];
      $district_postal[] = ['district'=>10, 'postal'=>24, 'CBD'=>1];
      $district_postal[] = ['district'=>10, 'postal'=>25, 'CBD'=>1];
      $district_postal[] = ['district'=>10, 'postal'=>26, 'CBD'=>1];
      $district_postal[] = ['district'=>10, 'postal'=>27, 'CBD'=>1];
      $district_postal[] = ['district'=>11, 'postal'=>28, 'CBD'=>1];
      $district_postal[] = ['district'=>11, 'postal'=>29, 'CBD'=>1];
      $district_postal[] = ['district'=>11, 'postal'=>30, 'CBD'=>1];
      $district_postal[] = ['district'=>12, 'postal'=>31, 'CBD'=>1];
      $district_postal[] = ['district'=>12, 'postal'=>32, 'CBD'=>1];
      $district_postal[] = ['district'=>12, 'postal'=>33, 'CBD'=>1];
      $district_postal[] = ['district'=>13, 'postal'=>34, 'CBD'=>1];
      $district_postal[] = ['district'=>13, 'postal'=>35, 'CBD'=>1];
      $district_postal[] = ['district'=>13, 'postal'=>36, 'CBD'=>1];
      $district_postal[] = ['district'=>13, 'postal'=>37, 'CBD'=>1];
      $district_postal[] = ['district'=>14, 'postal'=>38, 'CBD'=>1];
      $district_postal[] = ['district'=>14, 'postal'=>39, 'CBD'=>1];
      $district_postal[] = ['district'=>14, 'postal'=>40, 'CBD'=>1];
      $district_postal[] = ['district'=>14, 'postal'=>41, 'CBD'=>1];
      $district_postal[] = ['district'=>15, 'postal'=>42];
      $district_postal[] = ['district'=>15, 'postal'=>43];
      $district_postal[] = ['district'=>15, 'postal'=>44];
      $district_postal[] = ['district'=>15, 'postal'=>45];
      $district_postal[] = ['district'=>16, 'postal'=>46];
      $district_postal[] = ['district'=>16, 'postal'=>47];
      $district_postal[] = ['district'=>16, 'postal'=>48];
      $district_postal[] = ['district'=>17, 'postal'=>49];
      $district_postal[] = ['district'=>17, 'postal'=>50];
      $district_postal[] = ['district'=>17, 'postal'=>81];
      $district_postal[] = ['district'=>18, 'postal'=>51];
      $district_postal[] = ['district'=>18, 'postal'=>52];
      $district_postal[] = ['district'=>19, 'postal'=>53];
      $district_postal[] = ['district'=>19, 'postal'=>54];
      $district_postal[] = ['district'=>19, 'postal'=>55];
      $district_postal[] = ['district'=>19, 'postal'=>82];
      $district_postal[] = ['district'=>20, 'postal'=>56];
      $district_postal[] = ['district'=>20, 'postal'=>57];
      $district_postal[] = ['district'=>21, 'postal'=>58];
      $district_postal[] = ['district'=>21, 'postal'=>59];
      $district_postal[] = ['district'=>22, 'postal'=>60];
      $district_postal[] = ['district'=>22, 'postal'=>61];
      $district_postal[] = ['district'=>22, 'postal'=>62];
      $district_postal[] = ['district'=>22, 'postal'=>63];
      $district_postal[] = ['district'=>22, 'postal'=>64];
      $district_postal[] = ['district'=>23, 'postal'=>65];
      $district_postal[] = ['district'=>23, 'postal'=>66];
      $district_postal[] = ['district'=>23, 'postal'=>67];
      $district_postal[] = ['district'=>23, 'postal'=>68];
      $district_postal[] = ['district'=>24, 'postal'=>69];
      $district_postal[] = ['district'=>24, 'postal'=>70];
      $district_postal[] = ['district'=>24, 'postal'=>71];
      $district_postal[] = ['district'=>25, 'postal'=>72];
      $district_postal[] = ['district'=>25, 'postal'=>73];
      $district_postal[] = ['district'=>26, 'postal'=>77];
      $district_postal[] = ['district'=>26, 'postal'=>78];
      $district_postal[] = ['district'=>27, 'postal'=>75];
      $district_postal[] = ['district'=>27, 'postal'=>76];
      $district_postal[] = ['district'=>28, 'postal'=>79];
      $district_postal[] = ['district'=>28, 'postal'=>80];

      foreach($district_postal as $dp) {
        DB::table('district_postal')->insert($dp);
      }
    }

    public function down()
    {
      Schema::dropIfExists('district_postal');
    }
}
