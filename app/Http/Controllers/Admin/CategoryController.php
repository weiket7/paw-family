<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
  public function index(Request $request) {
    $category_service = new Category();
    $data['categories'] = $category_service->getCategoryAllForMenu();
    return view("admin.category.index", $data);
  }
}