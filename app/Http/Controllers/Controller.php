<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Setting;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesResources;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class Controller extends BaseController
{
  use AuthorizesRequests, AuthorizesResources, DispatchesJobs, ValidatesRequests;

  public function __construct()
  {
    if (Cache::has("categories_cache")) {
      view()->share("categories_cache", Cache::get("categories_cache"));
    } else {
      $category_service = new Category();
      $categories = $category_service->getCategoryAllForMenu();
      Cache::put("categories_cache", $categories, 1440);
      view()->share("categories_cache", $categories);
    }

    if (Cache::has("settings_cache")) {
      view()->share("settings_cache", Cache::get("settings_cache"));
    } else {
      $setting_service = new Setting();
      $settings = $setting_service->getSettingAllWithNameKey();
      Cache::put("settings_cache", $settings, 1440);
      view()->share("settings_cache", $settings);
    }

    view()->share("auth_check", Auth::check());
  }
}
