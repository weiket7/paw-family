<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TestimonialTable extends Migration
{
  public function up()
  {
    Schema::create('testimonial', function (Blueprint $table) {
      $table->increments('testimonial_id');
      $table->string('name', 30);
      $table->string('location', 30);
      $table->string('testimonial', 250);
    });

    DB::table('testimonial')->insert([
      'testimonial_id'=>1, 'name'=>'Andy', 'location'=>'Yishun',
      'testimonial'=>'The best online shop ever!
The website is easy to use and has many products to choose from at prices below other pet shops. Prompt delivery time and great service too!
Keep it up!'
    ]);
    DB::table('testimonial')->insert([
      'testimonial_id'=>2, 'name'=>'Sandy', 'location'=>'Ang Mo Kio',
      'testimonial'=>'Thanks to Paw Family, Didi had her dinner on time! They fulfilled my urgent request and delivery was punctual on the following day after I ordered.
Fantastic service! Highly recommended.'
    ]);
    DB::table('testimonial')->insert([
      'testimonial_id'=>3, 'name'=>'Kwok Boon', 'location'=>'Commonwealth',
      'testimonial'=>'Great service, competitive pricing, wide range of products... simply awesome!
You guys have done a wonderful job there. I definitely would recommend Paw Family to my friends too!'
    ]);
    DB::table('testimonial')->insert([
      'testimonial_id'=>4, 'name'=>'Hsiao Fen', 'location'=>'Bishan',
      'testimonial'=>'Thank you for the prompt and friendly service with regards to customer service and delivery of products. I have finally found a reliable pet shop!'
    ]);
    DB::table('testimonial')->insert([
      'testimonial_id'=>5, 'name'=>'Jane', 'location'=>'Third Avenue',
      'testimonial'=>'I would just like to thank you for all your help yesterday in getting the item to me at such short notice. It is a pleasure to deal with a company that will go the extra mile!
Thank you.'
    ]);
    DB::table('testimonial')->insert([
      'testimonial_id'=>6, 'name'=>'Alvin', 'location'=>'Haig Road',
      'testimonial'=>'Website is very user friendly and products are cheaper than the well-known pet shop I normally purchase pet products that I need.
Excellent customer service, prompt delivery time with friendly delivery man! Keep it up!'
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('testimonial');
  }
}
