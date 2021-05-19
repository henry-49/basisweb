<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use App\Models\Brand;
use Auth;
use Image;

class BrandController extends Controller
{
    //
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
       return view('admin.brand.index', compact('brands'));
    }


    public function StoreBrand(Request $request)
    {
        // Validate input
       $validateData = $request->validate([
            'brand_name' => 'required|unique:brands|min:4',
            'brand_image' => 'required|mimes:jpg,jpeg,png'
       ],
       [
        'brand_name.required' => 'Please Input Brand Name',
        'brand_name.min' => 'Brand Name Most be greater than 4 Character',
    ]);

    // store uploaded image in $brand_image
    $brand_image = $request->file('brand_image'); 

    if($brand_image){
    // generate unique id for uploaded brand image
    $gen_name_id = hexdec(uniqid());

    // get image extension jpg, jpeg, png 
    $img_ext = strtolower($brand_image->getClientOriginalExtension());
     
    // concatinate the generated id and extension eg: 53436335.jpg
    $img_name = $gen_name_id.'.'.$img_ext;

    // location to be uploaded
    $up_location = 'image/brand/';
    $last_img = $up_location.$img_name;
    $brand_image->move($up_location,$last_img);


     // generate unique id for uploaded image
    //  $gen_name_id = hexdec(uniqid()). '.'. $brand_image->getClientOriginalExtension();
     // Using image intervention to resize and save in the specified location with the id
    //  Image::make($brand_image)->resize(300,200)->save('image/brand/'.$gen_name_id);
     // save uploaded image
    //  $last_img = 'image/brand/'.$gen_name_id;


    // Using Eloquent ORM Insert Data
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        return Redirect()->route('all.brand')->with('success', 'Brand Inserted Successfuly');

        }else{
            return Redirect()->route('all.brand')->with('error', 'Opps Something went Wrong!');
        }

    }



    public function EditBrand($id)
    {
        $brands = Brand::find($id);
        // $brands = DB::table('brands')->where('id', $id)->first();
      // Parse data to view
      return view('admin.brand.edit', compact('brands'));
    }

   
}
