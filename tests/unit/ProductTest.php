<?php
use App\Models\Dept;
use App\Models\Enums\ProductOptionType;
use App\Models\Product;

class ProductTest extends \Codeception\TestCase\Test
{
    protected $tester;

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