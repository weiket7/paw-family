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

  public function save(Request $request, $category_id = null) {
    $category = Category::findOrNew($category_id);
    $action = $category_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        $category->delete();
        return redirect('admin/category/save/'.$category->product_id)->with('msg', 'Category deleted');
      }
      if (! $category->saveCategory($input, $request->file('image'))) {
        return redirect()->back()->withErrors($category->getValidation())->withInput($input);
      }

      return redirect('admin/category/save/'.$category->category_id)->with('msg', 'Category ' . $action . "d");
    }
    $data['action'] = $action;
    $data['category'] = $category;
    return view('admin/category/form', $data);
  }

}