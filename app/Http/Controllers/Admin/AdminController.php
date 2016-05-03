<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Operator;
use Illuminate\Http\Request;
use Session;

class AdminController extends Controller
{
  public function login(Request $request) {
    $operator = new Operator();
    if ($request->isMethod('post')) {
      $login = $operator->loginOperator($request->input('username'), $request->input('password'));
      if ( $login !== false ) {
        $request->session()->put('auth_operator', $login->username);
        return redirect('admin/dashboard');
      } else {
        return redirect('admin')->with('msg', 'Wrong username and/or password');
      }
    }
    return view('admin.login');
  }

  public function logout(Request $request) {
    $request->session()->forget('auth_operator');
  }

  public function dashboard(Request $request) {
    return view('admin.dashboard');
  }
}