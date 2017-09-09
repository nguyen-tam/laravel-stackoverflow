<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Redirect;

use Session;
use App\User;

class HomeController extends Controller
{
    //
    public function home() {
      return view('front_end.home');
    }

    public function showLogin() {
      return view('front_end.login');
    }

    public function doLogin() {
      return view('front_end.login');
    }

    public function showRegister() {
      return view('front_end.register');
    }

    public function doRegister() {

      $rules = array(
          'name'       => 'required',
          'email'      => 'required|email',
      );
      $validator = Validator::make(Input::all(), $rules);

      if ($validator->fails()) {
          return Redirect::to('/register')
              ->withErrors($validator)
              ->withInput(Input::except('password'));
      } else {
          
          User::create([
            'name' => Input::get('name'),
            'email' => Input::get('email'),
            'password' => bcrypt(Input::get('password')),
          ]);

          // redirect
          Session::flash('message', 'Successfully sign up!');
          return Redirect::to('/');
      }

    }
}
