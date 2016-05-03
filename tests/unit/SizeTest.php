<?php

use App\Models\Size;

class SizeTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testGetSizeName() {
        $size_service = new Size();
        $name = $size_service->getSizeName(1);
        $this->assertEquals("Small", $name);
    }

    public function testGetSize() {
        $size_service = new Size();
        $size = $size_service->getSize(1);
        $this->assertEquals("Small", $size->name);
    }
}