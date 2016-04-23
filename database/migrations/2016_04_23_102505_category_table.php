<?php

use App\Models\Enums\MainCategory;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CategoryTable extends Migration
{
    public function up()
    {
      Schema::create('category', function(Blueprint $t) {
        $t->increments('category_id');
        $t->string('main_category', 2);
        $t->string('name', 20);
        $t->char('stat', 1);
        $t->tinyInteger('pos');
        $t->string('updated_by', 10);
        $t->timestamp('updated_at');
      });

      DB::table('category')->insert(['category_id'=>1, 'main_category'=>MainCategory::Dogs, 'name'=>'Dry Food', 'pos'=>1, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>2, 'main_category'=>MainCategory::Dogs, 'name'=>'Canned Food', 'pos'=>2, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>3, 'main_category'=>MainCategory::Dogs, 'name'=>'Supplements', 'pos'=>3, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>4, 'main_category'=>MainCategory::Dogs, 'name'=>'Treats', 'pos'=>4, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>5, 'main_category'=>MainCategory::Dogs, 'name'=>'Grooming', 'pos'=>5, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>6, 'main_category'=>MainCategory::Dogs, 'name'=>'Acessories', 'pos'=>6, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);

      DB::table('category')->insert(['category_id'=>7, 'main_category'=>MainCategory::Cats, 'name'=>'Dry Food', 'pos'=>1, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>8, 'main_category'=>MainCategory::Cats, 'name'=>'Canned Food', 'pos'=>2, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>9, 'main_category'=>MainCategory::Cats, 'name'=>'Supplements', 'pos'=>3, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>10, 'main_category'=>MainCategory::Cats, 'name'=>'Treats', 'pos'=>4, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>11, 'main_category'=>MainCategory::Cats, 'name'=>'Grooming', 'pos'=>5, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>12, 'main_category'=>MainCategory::Cats, 'name'=>'Acessories', 'pos'=>6, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);
      DB::table('category')->insert(['category_id'=>13, 'main_category'=>MainCategory::Cats, 'name'=>'Cat Litter', 'pos'=>7, 'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')]);

    }

    public function down()
    {
      Schema::dropIfExists('category');
    }
}
