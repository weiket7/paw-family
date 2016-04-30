<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
  public function save(Request $request, $size_id = null) {
    $action = $size_id == null ? 'create' : 'update';

    if($request->isMethod('post')) {
      $input = $request->all();
      $size = $action == "create" ? new Size() : Size::find($size_id);
      if (! $size->saveSize($input)) {
        return redirect()->back()->withErrors($size->getValidation())->withInput($input);
      }
      return redirect('admin/size/save/'.$size_id)->with('msg', 'Size ' . $action . "d");
    }
    $data['action'] = $action;
    $size_service = new Size();
    $data['size'] = "create" ? new Size() : $size_service->getSize($size_id);
    return view('admin.product.size-form', $data);
  }
}