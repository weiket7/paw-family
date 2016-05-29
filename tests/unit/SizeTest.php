<?php

use App\Models\ProductSize;

class SizeTest extends \Codeception\TestCase\Test
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
}