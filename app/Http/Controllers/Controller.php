<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
  use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

  public function __construct()
  {
    if (Cache::has("categories")) {
      view()->share('categories', Cache::get('categories'));
    } else {
      $category_service = new Category();
      $categories = $category_service->getCategoryAllForMenu();
      view()->share('categories', $categories);
    }
  }
}
