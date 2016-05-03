<?php

use App\Models\Sale;
use App\Models\Size;

class SaleTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testGetSaleUsingIdSuccess() {
        $sale_service = new Sale();
        $sale = $sale_service->getSale(1);
        $this->assertEquals(1, $sale->customer_id);
    }

    public function testGetSaleUsingCodeSuccess() {
        $sale_service = new Sale();
        $sale = $sale_service->getSale("123456");
        $this->assertEquals(1, $sale->customer_id);
    }
}