<?php


use App\Models\Category;
use App\Models\Enums\MainCategory;

class CategoryTest extends \Codeception\TestCase\Test
{
  protected $tester;

  public function testSaveCategorySuccess()
  {
    $category = Category::find(1);
    $input['name'] = "Abc";
    $input['main_category'] = MainCategory::Dogs;
    $category->saveCategory($input);
    $this->tester->seeRecord('category', ['category_id'=>1, 'name'=>'Abc']);
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
    $category = $category_service->getCategoryBySlug('dry-food');
    $this->assertEquals("Dry Food", $category->name);
  }
}