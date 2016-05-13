<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Supplier;
use Illuminate\Http\Request;

class SupplierController extends Controller
{
  public function index(Request $request) {
    $data['suppliers'] = Supplier::all();
    return view("admin/supplier.index", $data);
  }

  public function save(Request $request, $supplier_id = null) {
    $supplier = Supplier::findOrNew($supplier_id);
    $action = $supplier_id == null ? 'create' : 'update';
    if($request->isMethod('post')) {
      $input = $request->all();
      if (isset($input['delete']) && $input['delete'] == 'true') {
        if ($supplier->product_count > 0) {
          return redirect()->back()->withErrors(['product_count'=>'Supplier cannot be deleted because there are products'])->withInput($input);
        }
        $supplier->delete();
        return redirect('admin/supplier')->with('msg', 'Supplier deleted');
      }
      if (! $supplier->saveSupplier($input, $request->file('image'))) {
        return redirect()->back()->withErrors($supplier->getValidation())->withInput($input);
      }

      return redirect('admin/supplier/save/'.$supplier->supplier_id)->with('msg', 'Supplier ' . $action . "d");
    }
    $data['action'] = $action;
    $data['supplier'] = $supplier;
    return view('admin/supplier/form', $data);
  }
}