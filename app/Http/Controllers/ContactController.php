<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ContactController extends Controller
{

      // redirect user to login when trying to access url without login
      public function __construct(){
        $this->middleware('auth');
    }

    public function index()
    {
        return view('contact');
        // echo "This is a Test";
    }

 
}
