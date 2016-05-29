<?php

use App\Models\Enums\ProductDescType;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ProductDescTable extends Migration
{
  public function up()
  {
    Schema::create('product_desc', function (Blueprint $table) {
      $table->increments('desc_id');
      $table->integer('product_id');
      $table->char('type');
      $table->text('value');
      $table->string('updated_by', 20);
      $table->dateTime('updated_on');
    });

    DB::table('product_desc')->insert([
      'desc_id'=>1,
      'product_id'=>1,
      'type'=> ProductDescType::Description,
      'value'=>'Addiction Dry Dog Food Viva La Venison
        
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


Product of USA',
    ]);
    DB::table('product_desc')->insert([
      'desc_id'=>2,
      'product_id'=>1,
      'type'=> ProductDescType::Video,
      'value'=>'5SXqYtbqhOM'
    ]);
  }

  public function down()
  {
    Schema::dropIfExists('product_desc');
  }
}
