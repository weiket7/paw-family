<?php

use App\Models\Enums\DiscountType;
use App\Models\Enums\ProductStat;
use App\Models\Product;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductTable extends Migration
{
    public function up()
    {
      Schema::create('product', function(Blueprint $t) {
        $t->increments('product_id');
        $t->integer('category_id');
        $t->integer('brand_id');
        $t->char('stat', 1);
        $t->string('name', 150);
        $t->string('slug', 150);
        $t->string('sku', 20);
        $t->integer('supplier_id');
        $t->decimal('cost_price', 7, 2);
        $t->decimal('price', 7, 2); //selling_price
        $t->decimal('discount_percentage', 5, 2);
        $t->char('discount_type', 1); //A or P
        $t->decimal('discounted_price', 7, 2);
        //$t->string('ingredient', 250);
        $t->decimal('weight_lb', 7, 2);
        $t->decimal('weight_kg', 7, 2);
        $t->tinyInteger('processing_day');
        $t->decimal('discount_amt', 7, 2); //round down
        $t->string('image', 150);
        $t->string('desc_short', 250);
        $t->string('meta_title', 250);
        $t->string('meta_keyword', 250);
        $t->string('meta_desc', 250);
        $t->integer("view_count");
        $t->integer("size_count");
        $t->string('updated_by', 20);
        $t->dateTime('updated_on');
      });

      DB::table('product')->insert([
        'product_id'=>1,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Viva La Venison',
        'slug'=>'addiction-viva-la-venison',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>29.1,
        'price'=>39.1,
        'discounted_price'=>29.1,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-viva-la-venison.jpg',
        'discount_amt'=>'10',
        'discount_type'=>DiscountType::Amount,
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>2,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Salmon Bleu',
        'slug'=>'addiction-salmon-bleu',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>30.19,
        'price'=>39.1,
        'discounted_price'=>35.19,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-salmon-bleu.jpg',
        'discount_amt'=>3.91,
        'discount_percentage'=>10,
        'discount_type'=>DiscountType::Percentage,
        'stat'=>ProductStat::Hidden,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>3,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Le Lamb',
        'slug'=>'addiction-le-lamb',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>24.95,
        'price'=>29.95,
        'discounted_price'=>29.95,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-le-lamb.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>4,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Dry Dog Food Wild Kangaroo & Apples',
        'slug'=>'addiction-dry-dog-food-wild-kangaroo-apples',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>31.3,
        'price'=>31.30,
        'discounted_price'=>31.3,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-dry-dog-food-wild-kangaroo-apples.png',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>5,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction La Porchetta',
        'slug'=>'addiction-la-porchetta',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>29.95,
        'price'=>29.95,
        'discounted_price'=>29.95,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-la-porchetta.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>6,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Zen Vegetarian',
        'slug'=>'addiction-zen-vegetarian',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>23.35,
        'price'=>23.35,
        'discounted_price'=>23.35,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-zen-vegetarian.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>7,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Viva La Venison Puppy',
        'slug'=>'addiction-viva-la-venison-puppy',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>40.95,
        'price'=>40.95,
        'discounted_price'=>40.95,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-viva-la-venison-puppy.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>8,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Salmon Bleu Puppy',
        'slug'=>'addiction-salmon-bleu-puppy',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>40.90,
        'price'=>40.90,
        'discounted_price'=>40.90,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-salmon-bleu-puppy.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>9,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Figlicious Venison Feast (Grain Free)',
        'slug'=>'addiction-raw-dehydrated-figlicious-venison-feast-grain-free',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>41.6,
        'price'=>41.60,
        'discounted_price'=>41.6,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-raw-dehydrated-figlicious-venison-feast-grain-free.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>10,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Herbed Lamb & Potatos (Grain Free)',
        'slug'=>'addiction-raw-dehydrated-herbed-lamb-potatoes-grain-free',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>37.05,
        'price'=>37.05,
        'discounted_price'=>37.05,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-raw-dehydrated-herbed-lamb-potatoes-grain-free.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>11,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Steakhouse Beef & Zucchini (Grain Free)',
        'slug'=>'addiction-raw-dehydrated-steakhouse-beef-zucchini-grain-free',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>37.05,
        'price'=>37.05,
        'discounted_price'=>37.05,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-raw-dehydrated-steakhouse-beef-zucchini-grain-free.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>12,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - NZ Forest Delicacies',
        'slug'=>'addiction-raw-dehydrated-nz-forest-delicacies',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>41.6,
        'price'=>41.6,
        'discounted_price'=>41.6,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-raw-dehydrated-nz-forest-delicacies.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>13,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Homestyle Venison & Cranberry Dinner',
        'slug'=>'addiction-raw-dehydrated-homestyle-venison-cranberry-dinner',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>39.15,
        'price'=>39.15,
        'discounted_price'=>39.15,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-raw-dehydrated-homestyle-venison-cranberry-dinner.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>14,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Perfect Summer Brushtail (Grain Free)',
        'slug'=>'addiction-raw-dehydrated-perfect-summer-brushtail-grain-free',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>41.6,
        'price'=>41.6,
        'discounted_price'=>41.6,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-raw-dehydrated-perfect-summer-brushtail-grain-free.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>15,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Country Chicken & Apricot Dinner (Grain Free)',
        'slug'=>'addiction-raw-dehydrated-country-chicken-apricot-dinner-grain-free',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>37.05,
        'price'=>37.05,
        'discounted_price'=>37.05,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'addiction-raw-dehydrated-country-chicken-apricot-dinner-grain-free.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>16,
        'category_id'=>1,
        'brand_id'=>6,
        'name'=>'Primal Freeze Dried Canine Turkey & Sardine',
        'slug'=>'primal-freeze-dried-canine-turkey-sardine',
        'supplier_id'=>2,
        'sku'=>'PSU-01',
        'cost_price'=>42.7,
        'price'=>42.70,
        'discounted_price'=>42.7,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'primal-freeze-dried-canine-turkey-sardine.jpg',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>17,
        'category_id'=>1,
        'brand_id'=>6,
        'name'=>'Primal Freeze Dried Canine Lamb Formula',
        'slug'=>'primal-freeze-dried-canine-lamb-formula',
        'supplier_id'=>2,
        'sku'=>'PSU-01',
        'cost_price'=>42.7,
        'price'=>42.70,
        'discounted_price'=>42.7,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'primal-freeze-dried-canine-lamb-formula.jpg',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>18,
        'category_id'=>1,
        'brand_id'=>6,
        'name'=>'Primal Freeze Dried Canine Duck Formula',
        'slug'=>'primal-freeze-dried-canine-duck-formula',
        'supplier_id'=>2,
        'sku'=>'PSU-01',
        'cost_price'=>42.7,
        'price'=>42.70,
        'discounted_price'=>42.7,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'primal-freeze-dried-canine-duck-formula.jpg',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>19,
        'category_id'=>1,
        'brand_id'=>6,
        'name'=>'Primal Freeze Dried Canine Chicken Formula',
        'slug'=>'primal-freeze-dried-canine-chicken-formula',
        'supplier_id'=>2,
        'sku'=>'PSU-01',
        'cost_price'=>42.7,
        'price'=>42.70,
        'discounted_price'=>42.7,
        'weight_lb'=>4,
        'weight_kg'=>1.81,
        'processing_day'=>3,
        'image'=>'primal-freeze-dried-canine-chicken-formula.jpg',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>20,
        'category_id'=>2,
        'brand_id'=>1,
        'name'=>'Addiction NZ Brushtail & Vegetables Entree (Grain Free) Dog Canned Food',
        'slug'=>'addiction-nz-brushtail-vegetables-entree-grain-free-dog-canned-food',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>4.25,
        'price'=>5.25,
        'discounted_price'=>5.25,
        'weight_lb'=>0,
        'weight_kg'=>0.390,
        'processing_day'=>3,
        'image'=>'addiction-nz-brushtail-vegetables-entree-grain-free-dog-canned-food.png',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>21,
        'category_id'=>2,
        'brand_id'=>1,
        'name'=>'Addiction NZ Venison & Apples Entree (Grain Free) Dog Canned Food',
        'slug'=>'addiction-nz-venison-apples-entree-grain-free-dog-canned-food',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>4.25,
        'price'=>5.60,
        'discounted_price'=>5.25,
        'discount_amt'=>0.35,
        'weight_lb'=>0,
        'weight_kg'=>0.390,
        'processing_day'=>3,
        'image'=>'addiction-nz-venison-apples-entree-grain-free-dog-canned-food.png',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>22,
        'category_id'=>2,
        'brand_id'=>1,
        'name'=>'Addiction King Salmon & Potatoes Entree (Grain Free) Dog Canned Food',
        'slug'=>'addiction-king-salmon-potatoes-entree-grain-free-dog-canned-food',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>4.25,
        'price'=>5.60,
        'discounted_price'=>5.25,
        'discount_amt'=>0.35,
        'weight_lb'=>0,
        'weight_kg'=>0.390,
        'processing_day'=>3,
        'image'=>'addiction-king-salmon-potatoes-entree-grain-free-dog-canned-food.png',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>23,
        'category_id'=>2,
        'brand_id'=>1,
        'name'=>'Addiction Unagi & Seaweed Entree (Grain Free) Dog Canned Food',
        'slug'=>'addiction-unagi-seaweed-entree-grain-free-dog-canned-food',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>4.25,
        'price'=>5.60,
        'discounted_price'=>5.25,
        'discount_amt'=>0.35,
        'weight_lb'=>0,
        'weight_kg'=>0.390,
        'processing_day'=>3,
        'image'=>'addiction-unagi-seaweed-entree-grain-free-dog-canned-food.png',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>24,
        'category_id'=>2,
        'brand_id'=>7,
        'name'=>'Nutripe Ambrosia Turkey with Green Tripe Canned Dog Food',
        'slug'=>'nutripe-ambrosia-turkey-with-green-tripe-canned-dog-food',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>4,
        'price'=>5.25,
        'discounted_price'=>5,
        'discount_amt'=>0.25,
        'weight_lb'=>0,
        'weight_kg'=>0.390,
        'processing_day'=>3,
        'image'=>'nutripe-ambrosia-turkey-with-green-tripe-canned-dog-food.jpg',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);

      DB::table('product')->insert([
        'product_id'=>25,
        'category_id'=>2,
        'brand_id'=>7,
        'name'=>'Nutripe Ambrosia Chicken with Green Tripe Canned Dog Food',
        'slug'=>'nutripe-ambrosia-chicken-with-green-tripe-canned-dog-food',
        'supplier_id'=>1,
        'sku'=>'PSU-01',
        'cost_price'=>4,
        'price'=>5.25,
        'discounted_price'=>5,
        'discount_amt'=>0.25,
        'weight_lb'=>0,
        'weight_kg'=>0.390,
        'processing_day'=>3,
        'image'=>'addiction-unagi-seaweed-entree-grain-free-dog-canned-food.jpg',
        'stat'=>ProductStat::Available,
        'updated_by'=>'ruth', 'updated_on'=>date('Y-m-d H:i:s')
      ]);
    }

    public function down()
    {
      Schema::dropIfExists('product');
    }
}
