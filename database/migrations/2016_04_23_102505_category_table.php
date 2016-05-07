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
        $t->string('main_category', 15);
        $t->string('name', 20);
        $t->string('slug', 30);
        $t->char('stat', 1);
        $t->integer('product_count');
        $t->tinyInteger('pos');
        $t->string('updated_on', 10);
        $t->timestamp('updated_at');
      });

      DB::table('category')->insert([
        'category_id'=>1, 'main_category'=>MainCategory::Dogs, 'name'=>'Dry Food', 'slug'=>'dry-food',  'product_count'=>19,
        'pos'=>1, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s'
        )]);
      DB::table('category')->insert([
        'category_id'=>2, 'main_category'=>MainCategory::Dogs, 'name'=>'Canned Food', 'slug'=>'canned-food',  'product_count'=>6,
        'pos'=>2, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s'
        )]);
      DB::table('category')->insert([
        'category_id'=>3, 'main_category'=>MainCategory::Dogs, 'name'=>'Supplements', 'slug'=>'supplements',  'product_count'=>0,
        'pos'=>3, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>4, 'main_category'=>MainCategory::Dogs, 'name'=>'Treats', 'slug'=>'treats',  'product_count'=>0,
        'pos'=>4, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>5, 'main_category'=>MainCategory::Dogs, 'name'=>'Grooming', 'slug'=>'grooming',  'product_count'=>0,
        'pos'=>5, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>6, 'main_category'=>MainCategory::Dogs, 'name'=>'Acessories', 'slug'=>'accessory',  'product_count'=>0,
        'pos'=>6, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);

      DB::table('category')->insert([
        'category_id'=>7, 'main_category'=>MainCategory::Cats, 'name'=>'Dry Food', 'slug'=>'dry-food', 'product_count'=>0,
        'pos'=>1, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s'
        )]);
      DB::table('category')->insert([
        'category_id'=>8, 'main_category'=>MainCategory::Cats, 'name'=>'Canned Food', 'slug'=>'canned-food', 'product_count'=>0,
        'pos'=>2, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s'
        )]);
      DB::table('category')->insert([
        'category_id'=>9, 'main_category'=>MainCategory::Cats, 'name'=>'Supplements', 'slug'=>'supplements', 'product_count'=>0,
        'pos'=>3, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>10, 'main_category'=>MainCategory::Cats, 'name'=>'Treats', 'slug'=>'treats', 'product_count'=>0,
        'pos'=>4, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>11, 'main_category'=>MainCategory::Cats, 'name'=>'Grooming', 'slug'=>'grooming', 'product_count'=>0,
        'pos'=>5, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>12, 'main_category'=>MainCategory::Cats, 'name'=>'Acessories', 'slug'=>'accessories', 'product_count'=>0,
        'pos'=>6, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>13, 'main_category'=>MainCategory::Cats, 'name'=>'Cat Litter', 'slug'=>'cat-litter', 'product_count'=>0,
        'pos'=>'7', 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s'
      )]);

      DB::table('category')->insert([
        'category_id'=>14, 'main_category'=>MainCategory::SmallAnimals, 'name'=>'Food', 'slug'=>'dry-food', 'product_count'=>0,
        'pos'=>1, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s'
        )]);
      DB::table('category')->insert([
        'category_id'=>15, 'main_category'=>MainCategory::SmallAnimals, 'name'=>'Treats', 'slug'=>'canned-food', 'product_count'=>0,
        'pos'=>2, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s'
        )]);
      DB::table('category')->insert([
        'category_id'=>16, 'main_category'=>MainCategory::SmallAnimals, 'name'=>'Supplements', 'slug'=>'supplements', 'product_count'=>0,
        'pos'=>3, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>17, 'main_category'=>MainCategory::SmallAnimals, 'name'=>'Grooming', 'slug'=>'treats', 'product_count'=>0,
        'pos'=>4, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>18, 'main_category'=>MainCategory::SmallAnimals, 'name'=>'Accessories', 'slug'=>'treats', 'product_count'=>0,
        'pos'=>4, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>19, 'main_category'=>MainCategory::SmallAnimals, 'name'=>'Hay', 'slug'=>'grooming', 'product_count'=>0,
        'pos'=>5, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
      DB::table('category')->insert([
        'category_id'=>20, 'main_category'=>MainCategory::SmallAnimals, 'name'=>'Bedding', 'slug'=>'accessories', 'product_count'=>0,
        'pos'=>6, 'updated_on'=>'ruth', 'updated_at'=>date('Y-m-d H:i:s')
      ]);
    }

    public function down()
    {
      Schema::dropIfExists('category');
    }
}
