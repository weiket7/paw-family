<?php


use App\Models\Category;

class CategoryTest extends \Codeception\TestCase\Test
{
    protected $tester;

    public function testSaveCategorySuccess()
    {
        $category = Category::find(1);
        $input['name'] = "Abc";
        $category->saveCategory($input);
        $this->tester->seeInDatabase('category', ['name'=>'Abc', 'category_id'=>1]);
    }

    public function testGetCategoryAllForMenu() {
        $category_service = new Category();
        $categories = $category_service->getCategoryAllForMenu();
        $this->assertGreaterThan(0, count($categories));
    }

    public function testGetCategoryForDropdown() {
        $category_service = new Category();
        $categories = $category_service->getCategoryForDropdown();
        $this->assertGreaterThan(0, count($categories));
    }

    public function testGetCategoryBySlug() {
        $category_service = new Category();
        $category = $category_service->getCategoryBySlug(1);
        $this->assertEquals("Dry Food", $category->name);
    }
}