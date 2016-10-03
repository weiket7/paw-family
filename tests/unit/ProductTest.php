<?php
use App\Models\Enums\DiscountType;
use App\Models\Enums\ProductOptionType;
use App\Models\Enums\ProductStat;
use App\Models\Product;

class ProductTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testSaveProductWithDiscountPercentage() {
    $product_id = 1;
    $product = Product::find($product_id);
    $input['name'] = 'Addiction La Viva';
    $input['stat'] = ProductStat::OutOfStock;
    $input['sku'] = 'SKU-01';
    $input['supplier_id'] = 3;
    $input['brand_id'] = 4;
    $input['category_id'] = 5;
    $input['price'] = 39.10;
    $input['cost_price'] = 29.10;
    $input['processing_day'] = 3;
    $input['weight_lb'] = 11;
    $input['weight_kg'] = 6.6;
    $input['discount_percentage'] = 10;
    $input['discount_amt'] = 3.91;
    $input['discount_type'] = DiscountType::Percentage;
    $input['meta_keyword'] = '';
    $input['meta_desc'] = '';
    $input['desc_short'] = "Short description";
    $product->saveProduct($input);

    $product = Product::find($product_id);
    $this->assertEquals("Addiction La Viva", $product->name);
    $this->assertEquals(ProductStat::OutOfStock, $product->stat);
    $this->assertEquals("SKU-01", $product->sku);
    $this->assertEquals(3, $product->supplier_id);
    $this->assertEquals(4, $product->brand_id);
    $this->assertEquals(5, $product->category_id);
    $this->assertEquals(3, $product->processing_day);
    $this->assertEquals(11, $product->weight_lb);
    $this->assertEquals(6.6, $product->weight_kg);
    $this->assertEquals(39.10, $product->price);
    $this->assertEquals(29.10, $product->cost_price);
    $this->assertEquals(10, $product->discount_percentage);
    $this->assertEquals(3.91, $product->discount_amt);
    $this->assertEquals(35.19, $product->discounted_price);
    $this->assertEquals("Short description", $product->desc_short);
  }

  public function testSaveProductWithDiscountPercentageAndRoundUpToFirstDecimal() {
    $product_id = 1;
    $product = Product::find($product_id);
    $input['name'] = 'Addiction Viva La Venison';
    $input['stat'] = ProductStat::Hidden;
    $input['sku'] = 'SKU-02';
    $input['supplier_id'] = 3;
    $input['brand_id'] = 4;
    $input['category_id'] = 5;
    $input['price'] = 39.10;
    $input['cost_price'] = 29.10;
    $input['processing_day'] = 3;
    $input['weight_lb'] = 11;
    $input['weight_kg'] = 6.6;
    $input['discount_percentage'] = 10;
    $input['discount_amt'] = 3.91;
    $input['discount_type'] = DiscountType::Percentage;
    $input['meta_keyword'] = '';
    $input['meta_desc'] = '';
    $input['desc_short'] = "Short description";
    $input['round-up-to-first-decimal'] = 'Y';
    $product->saveProduct($input);

    $product = Product::find($product_id);
    $this->assertEquals(39.10, $product->price);
    $this->assertEquals(29.10, $product->cost_price);
    $this->assertEquals(10, $product->discount_percentage);
    $this->assertEquals(3.9, $product->discount_amt);
    $this->assertEquals(35.2, $product->discounted_price);
    $this->assertEquals(DiscountType::Percentage, $product->discount_type);
  }

  public function testGetProductByCategorySuccess() {
    $product_service = new Product();
    $products = $product_service->getProductByCategory(1);
    $this->assertGreaterThan(0, count($products));
  }

  public function testSearchProductSuccess() {
    $product_service = new Product();
    $products = $product_service->searchProductByTerm("venison");
    $this->assertGreaterThan(0, count($products));
  }

  public function testGetProductOptionSuccess() {
    $product_service = new Product();
    $options = $product_service->getProductOption(1, ProductOptionType::Repack);
    $first_size_id = 2;
    $second_size_id = 3;
    $this->assertEquals(2, count($options));
    $this->assertEquals(2, count($options[$first_size_id]));
    $this->assertEquals(2, count($options[$second_size_id]));
  }

  public function testGetProductSize() {
    $product_service = new Product();
    $sizes = $product_service->getProductSize(1);
    $this->assertGreaterThan(0, count($sizes));
  }

  public function testGetProductByInt() {
    $product_service = new Product();
    $product = $product_service->getProduct(1);
    $this->assertEquals("Addiction Viva La Venison", $product->name);
  }

  public function testGetProductBySlug() {
    $product_service = new Product();
    $product = $product_service->getProduct("addiction-viva-la-venison");
    $this->assertEquals("Addiction Viva La Venison", $product->name);
  }

  public function testGetProductByCategoryIntAndBrandInt() {
    $product_service = new Product();
    $products = $product_service->getProductByCategoryAndBrand(1, 1);
    $this->assertGreaterThan(0, count($products));
  }

  public function testGetProductDesc() {
    $product_service = new Product();
    $descs = $product_service->getProductDesc(1);
    $this->assertCount(2, $descs);
  }

  public function testUpdateProductCount() {
    $product_service = new Product();
    $result = $product_service->updateProductCount(1);
    $this->assertTrue($result);
  }


}