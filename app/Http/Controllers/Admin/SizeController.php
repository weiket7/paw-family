<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Product;
use App\Models\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
  public function save($size_id) {
    $size_service = new Size();
    $data['action'] = ($size_id == null || $size_id == 0) ? "create" : "update";
    $data['size'] = $size_service->getSize($size_id);
    return view("admin.product.size-form", $data);
  }
}