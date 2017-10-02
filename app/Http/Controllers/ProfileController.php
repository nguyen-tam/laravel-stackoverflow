<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Auth;

class ProfileController extends Controller
{
    //
    public function __construct() {
       $this->middleware('auth');
  	}

  	public function index() {
  		$user = Auth::user();
  		return view('profile.index', ['user' => $user] );
  	}
}
