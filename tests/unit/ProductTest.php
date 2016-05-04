<?php
use App\Models\Enums\DiscountType;
use App\Models\Enums\ProductOptionType;
use App\Models\Enums\ProductStat;
use App\Models\Product;

class ProductTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testSaveProductWithPercentageDiscount() {
        $product_id = 1;
        $product = Product::find($product_id);
        $input['name'] = 'Addiction La Viva';
        $input['stat'] = ProductStat::OutOfStock;
        $input['sku'] = 'SKU-01';
        $input['supplier_id'] = 3;
        $input['brand_id'] = 4;
        $input['category_id'] = 5;
        $input['price'] = 195.55;
        $input['processing_day'] = 3;
        $input['weight_lb'] = 11;
        $input['weight_kg'] = 6.6;
        $input['discount_percentage'] = 10;
        $input['discount_type'] = DiscountType::Percentage;
        $input['desc_short'] = "Short description";
        $product->saveProduct($input);

        $product = Product::find($product_id);
        $this->assertEquals("Addiction La Viva", $product->name);
        $this->assertEquals(ProductStat::OutOfStock, $product->stat);
        $this->assertEquals("SKU-01", $product->sku);
        $this->assertEquals(3, $product->supplier_id);
        $this->assertEquals(4, $product->brand_id);
        $this->assertEquals(5, $product->category_id);
        $this->assertEquals(195.55, $product->price);
        $this->assertEquals(3, $product->processing_day);
        $this->assertEquals(11, $product->weight_lb);
        $this->assertEquals(6.6, $product->weight_kg);
        $this->assertEquals(10, $product->discount_percentage);
        $this->assertEquals(19.55, $product->discount_amt);
        $this->assertEquals(195.55-19.55, $product->discounted_price);
        $this->assertEquals(DiscountType::Percentage, $product->discount_type);
        $this->assertEquals("Short description", $product->desc_short);
    }

    public function testGetProductNameSuccess() {
        $product_service = new Product();
        $product_name = $product_service->getProductName(1);
        $this->assertEquals("Addiction Viva La Venison", $product_name);
    }

    public function testGetProductByCategorySuccess() {
        $product_service = new Product();
        $products = $product_service->getProductByCategory(1);
        $this->assertGreaterThan(0, count($products));
    }

    public function testGetProductFeaturedSuccess() {
        $product_service = new Product();
        $products = $product_service->getProductFeatured();
        $this->assertGreaterThan(0, count($products));
    }

    public function testSearchProductSuccess() {
        $product_service = new Product();
        $products = $product_service->searchProduct("venison");
        $this->assertGreaterThan(0, count($products));
    }

    public function testGetProductOptionSuccess() {
        $product_service = new Product();
        $options = $product_service->getProductOption(1, ProductOptionType::Repack);
        $this->assertGreaterThan(0, count($options));
    }

    public function testGetProductSize() {
        $product_service = new Product();
        $sizes = $product_service->getProductSize(1);
        $this->assertGreaterThan(0, count($sizes));
    }

    public function testGetProductByIntSuccess() {
        $product_service = new Product();
        $product = $product_service->getProduct(1);
        $this->assertEquals("Addiction Viva La Venison", $product->name);
    }

    public function testGetProductBySlugSuccess() {
        $product_service = new Product();
        $product = $product_service->getProduct("addiction-viva-la-venison");
        $this->assertEquals("Addiction Viva La Venison", $product->name);
    }

    public function testGetProductByCategoryIntAndBrandIntSuccess() {
        $product_service = new Product();
        $products = $product_service->getProductByCategoryAndBrand(1, 1);
        $this->assertGreaterThan(0, count($products));
    }


}