<?php

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
        $t->string('name', 100);
        $t->text('desc');
        $t->string('desc_short', 250);
        $t->string('image', 50);
        $t->char('stat', 1);
        $t->string('updated_by', 10);
        $t->timestamp('updated_at');
      });

      DB::table('product')->insert([
        'product_id'=>1,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Viva La Venison',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>2,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Salmon Bleu',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Hidden,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>3,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Le Lamb',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>4,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Dry Dog Food Wild Kangaroo & Apples',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>5,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction La Porchetta',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>6,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Zen Vegetarian',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>7,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Viva La Venison Puppy',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>8,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Salmon Bleu Puppy',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>9,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Figlicious Venison Feast (Grain Free)',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>10,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Herbed Lamb & Potatos (Grain Free)',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>11,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Steakhouse Beef & Zucchini (Grain Free)',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>12,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - NZ Forest Delicacies',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>13,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Homestyle Venison & Cranberry Dinner',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>14,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Perfect Summer Brushtail (Grain Free)',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      DB::table('product')->insert([
        'product_id'=>15,
        'category_id'=>1,
        'brand_id'=>1,
        'name'=>'Addiction Raw Dehydrated - Country Chicken & Apricot Dinner (Grain Free)',
        'image'=>'product_img_1.jpg',
        'stat'=>ProductStat::Available,
        'desc_short'=>'Delicious!',
        'updated_by'=>'ruth', 'updated_at'=>date('Y-m-d H:is')
      ]);

      $product = Product::find(1);
      $product->desc = 'Addiction Dry Dog Food Viva La Venison

- New Zealand Venison High in Protein, Low in Fat
- Probiotics for a Healthy Digestive & Immune System
- Fruits & Vegetables Rich in Phytonutrients

Viva La Venison - A Delectable Grain-Free Meal for your Dog
Featuring Free-Range New Zealand Venison, Addiction\'s Viva La Venison is a mouth-watering treat that will satisfy any dog! Served with a generous dose of Fruits and Vegetables, we have included Probiotics for overall health and vitality. Formulated without grains, this wholesome meal is also ideal for sensitive dogs of all lifestages.

Free-Range Venison High in Protein, Low in Fat
Low in fat and highly digestible, Venison has a full flavor that dogs simply love. It is also lower in cholesterol and fat than most cuts of meat, making it an ideal protein for optimal well-being and vitality. Free-Range New Zealand Venison is raised in the lush grasslands of New Zealand and is free from artificial hormones and steroids.

Probiotics for a Healthy Immune and Digestive System
Beneficial bacteria known as Probiotics have long been useful in optimizing digestive processes and allowing maximum nutritional benefit from food. Probiotics support a healthy digestive tract and immune system.

Addiction’s Viva La Venison is formulated to meet the nutritional levels established by the AAFCO Dog Food Nutrient Profiles for all life stages.


INGREDIENTS
Venison Meal, Dried Potatoes, Chicken Fat (Preserved with Mixed Tocopherols), Natural Flavors, Dried Egg, Dried Kelp, Dehydrated Alfalfa Meal, Dried Carrots, Dried Cranberries, Dried Apples, Dried Spinach, Potassium Chloride, Salt, Brewers Dried Yeast, Lecithin, Dried Enterococcus faecium Fermentation Product, Dried Lactobacillus acidophilus Fermentation Product, Dried Aspergillus niger Fermentation Extract, Dried Bacillus subtilis Fermentation Extract, Choline Chloride, Zinc Proteinate, Vitamin E Supplement, Iron Proteinate, Dried Saccharomyces cerevisiae Fermentation Solubles, Inulin (from chicory root), Ascorbic Acid (source of Vitamin C), Taurine, DL-Methionine, Yucca Schidigera Extract, Niacin (Vitamin B3), Copper Proteinate, Manganese Proteinate, Calcium Pantothenate, Thiamine (Vitamin B1), Biotin (Vitamin B7), Riboflavin (Vitamin B2), Vitamin A Supplement, Vitamin D3 Supplement, Pyridoxine Hydrochloride (Vitamin B6), Vitamin B12 Supplement, Beta Carotene, Folic Acid (Vitamin B9), Sodium Selenite, Rosemary Extract

With added:
- New Zealand Venison - high in protein, low in fat
- Probiotics for a healthy digestive system
- Fruits and Vegetables high in antioxidants and phytonutrients

No:
- Grain
- By products, Fillers, Corn, Wheat, Soy, Artificial Colors and Flavorings

NUTRITIONAL ANALYSIS
Guaranteed Analysis:
• Crude Protein - (min) 26%
• Crude Fat - (min) 14%
• Crude Fibre - (max) 3.5%
• Moisture - (max) 10%

Typical Analysis:
• Calcium - 2.3%
• Phosphorus - 1.5%
• Sodium - 0.4%

Caloric Content 4286 kcal/kg


Product of USA';
      $product->save();
    }

    public function down()
    {
      Schema::dropIfExists('product');
    }
}
