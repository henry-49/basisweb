<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Multipic;

class PortfolioController extends Controller
{
     //Method for Portfolio
     public function Portfolio()
     {
 
        $multipics =  Multipic::all();
        return view('pages.portfolio', compact('multipics'));
     }
}
