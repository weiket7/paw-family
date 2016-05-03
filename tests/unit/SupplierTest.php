<?php

use App\Models\Supplier;

class SupplierTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testGetSupplierForDropdown() {
        $supplier_service = new Supplier();
        $suppliers = $supplier_service->getSupplierForDropdown(1);
        $this->assertGreaterThan(0, count($suppliers));
    }

}