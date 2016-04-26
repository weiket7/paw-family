<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Request;

class AdminController extends Controller
{
  public function index() {

  }

  public function login() {
    if (Request::isMethod("post")) {
      $user = new User();
      $input = Input::all();
      $user_id = $user->loginUser($input['username'], $input['password']);
      if ($user_id) {
        $user = User::find($user_id);
        Auth::login($user);
        return redirect('adopt/admin')->with('alert', ['type'=>'success', 'msg'=>'You have logged in']);;
      }
      return redirect('login')->with('alert', ['type'=>'error', 'msg'=>'Wrong username/password']);
    }
    return view("site/login");
  }
}