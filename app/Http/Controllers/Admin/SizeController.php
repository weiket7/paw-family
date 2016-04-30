<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
  public function save(Request $request, $size_id = null) {
    $size = Size::findOrNew($size_id);
    $action = $size_id == null ? 'create' : 'update';
    if ($action == 'create')
      $size->product_id = $_GET['product_id'];

    if($request->isMethod('post')) {
      $input = $request->all();
      if (! $size->saveSize($input)) {
        return redirect()->back()->withErrors($size->getValidation())->withInput($input);
      }
      return redirect('admin/size/save/'.$size->size_id)->with('msg', 'Size ' . $action . "d");
    }
    $data['action'] = $action;
    $data['size'] = $size;
    return view('admin.product.size-form', $data);
  }
}