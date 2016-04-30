<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
  public function index(Request $request) {
    $data['brands'] = Brand::all();
    return view("admin.brand.index", $data);
  }
}