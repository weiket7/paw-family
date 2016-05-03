<?php
use App\Models\Dept;
use App\Models\Product;

class ProductTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testGetProductName_Success()
    {
        $product_service = new Product();
        $product_name = $product_service->getProductName(1);
        $this->assertEquals("Addiction Viva La Venison", $product_name);
    }
}