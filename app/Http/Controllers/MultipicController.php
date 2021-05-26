<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Multipic;
use Auth;
use Image;

class MultipicController extends Controller
{

      // redirect user to login when trying to access url without login
      public function __construct(){
        $this->middleware('auth');
    }

    //show all multi pics
    public function Multipic()
    {
        $images = Multipic::all();
        return view('admin.multipic.index', compact('images'));
    }


    public function StoreMultiImage(Request $request)
    {
    

    // store uploaded image in $brand_image
    $multi_image = $request->file('image'); 

    // loop through the multiple uploaded image
    foreach($multi_image as $image){

       
    // generate unique id for uploaded image
     $gen_name_id = hexdec(uniqid()). '.'. $image->getClientOriginalExtension();
     // Using image intervention to resize and save in the specified location with the id
     Image::make($image)->resize(300,300)->save('image/multi/'.$gen_name_id);
     // save uploaded image
     $last_img = 'image/multi/'.$gen_name_id;


      // Using Eloquent ORM Insert Data
        Multipic::insert([
            'image' => $last_img,
            'created_at' => Carbon::now()
        ]);

      } // end foreach
        return Redirect()->route('multi.image')->with('success', 'Multi Image Inserted Successfuly');
    
    }
}
