<?php
use App\Models\Enums\DiscountType;
use App\Models\Enums\ProductOptionType;
use App\Models\Enums\ProductStat;
use App\Models\Product;
use App\Models\ProductSize;

class ProductSizeTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testGetSizeName() {
    $size_service = new ProductSize();
    $name = $size_service->getSizeName(1);
    $this->assertEquals("Small", $name);
  }

  public function testGetSize() {
    $size_service = new ProductSize();
    $size = $size_service->getSize(1);
    $this->assertEquals("Small", $size->name);
  }

  public function testSaveSizeWithDiscountPercentage()
  {
    $input['name'] = 'new size name';
    $input['quantity'] = '6';
    $input['cost_price'] = 29.1;
    $input['price'] = 39.1;
    $input['discount_percentage'] = 10;
    $input['discount_amt'] = 3.91;
    $input['weight_lb'] = 4;
    $input['weight_kg'] = 3;
    $size = ProductSize::find(1);
    $size->saveSize($input);

    $size = ProductSize::find(1);
    $this->assertEquals('new size name', $size->name);
    $this->assertEquals(6, $size->quantity);
    $this->assertEquals(29.1, $size->cost_price);
    $this->assertEquals(39.1, $size->price);
    $this->assertEquals(35.19, $size->discounted_price);
    $this->assertEquals(3.91, $size->discount_amt);
    $this->assertEquals(4, $size->weight_lb);
    $this->assertEquals(3, $size->weight_kg);
  }

  public function testSaveSizeWithDiscountPercentageAndRoundUpToFirstDecimal() {
    $input['name'] = 'new size name';
    $input['quantity'] = '6';
    $input['cost_price'] = 29.1;
    $input['price'] = 39.1;
    $input['discount_percentage'] = 10;
    $input['discount_amt'] = 3.91;
    $input['weight_lb'] = 4;
    $input['weight_kg'] = 3;
    $input['round-up-to-first-decimal'] = 'Y';
    $size = ProductSize::find(1);
    $size->saveSize($input);

    $size = ProductSize::find(1);
    $this->assertEquals(39.10, $size->price);
    $this->assertEquals(29.10, $size->cost_price);
    $this->assertEquals(10, $size->discount_percentage);
    $this->assertEquals(3.9, $size->discount_amt);
    $this->assertEquals(35.2, $size->discounted_price);
  }
}