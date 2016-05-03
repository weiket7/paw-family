<?php


use App\Models\Brand;
use App\Models\Category;

class BrandTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testGetDistinctBrandByCategory() {
        $brand_service = new Brand();
        $brands = $brand_service->getDistinctBrandByCategory(1);
        $this->assertGreaterThan(0, count($brands));
    }

    public function testGetBrandForDropdown() {
        $brand_service = new Brand();
        $brands = $brand_service->getBrandForDropdown(1);
        $this->assertGreaterThan(0, count($brands));
    }

    public function testGetBrandIdBySlug() {
        $brand_service = new Brand();
        $brands = $brand_service->getBrandIdBySlug(['addiction', 'primal']);
        $this->assertGreaterThan(0, count($brands));
    }
}