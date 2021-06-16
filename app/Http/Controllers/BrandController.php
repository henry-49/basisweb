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

      // redirect user to login when trying to access url without login
      public function __construct(){
        $this->middleware('auth');
    }

    //method to show all brand with pagination
    public function AllBrand()
    {
        $brands = Brand::latest()->paginate(5);
       return view('admin.brand.index', compact('brands'));
    }


    // method to create brand
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

    // generate unique id for uploaded brand image
    // $gen_name_id = hexdec(uniqid());

    // get image extension jpg, jpeg, png 
    // $img_ext = strtolower($brand_image->getClientOriginalExtension());
     
    // concatinate the generated id and extension eg: 53436335.jpg
    // $img_name = $gen_name_id.'.'.$img_ext;

    // location to be uploaded
    // $up_location = 'image/brand/';
    // $last_img = $up_location.$img_name;
    // $brand_image->move($up_location,$last_img);


    // generate unique id for uploaded image
     $gen_name_id = hexdec(uniqid()). '.'. $brand_image->getClientOriginalExtension();
    // Using image intervention to resize and save in the specified location with the id
     Image::make($brand_image)->resize(300,200)->save('image/brand/'.$gen_name_id);
    // save uploaded image
     $last_img = 'image/brand/'.$gen_name_id;


    // Using Eloquent ORM Insert Data
        Brand::insert([
            'brand_name' => $request->brand_name,
            'brand_image' => $last_img,
            'created_at' => Carbon::now()
        ]);

        $notification = array(
            'message' => 'Brand Inserted Successfully',
            'alert-type' => 'success'
        );
        
        return Redirect()->back()->with($notification);

        // return Redirect()->route('all.brand')->with('success', 'Brand Inserted Successfuly');


    }


    // method to edit brand
    public function Edit($id)
    {
        $brands = Brand::find($id);
        // $brands = DB::table('brands')->where('id', $id)->first();
      // Parse data to view
      return view('admin.brand.edit', compact('brands'));
    }

   
    // Method to update brand
    public function Update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'brand_name' => 'required|min:4'
        ],
        [
            'brand_name.required' => 'Please Input Brand Name',
            'brand_name.min' => 'Brand Must Longer than 4 Characters',
        ]);

        // old image
            $old_image = $request->old_image;

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

            // unlink old image
            unlink($old_image);


            // Using Eloquent ORM Insert Data
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'brand_image' => $last_img,
                'created_at' => Carbon::now()
            ]);

            $notification = array(
                'message' => 'Brand Updated Successfully',
                'alert-type' => 'success'
            );

            return Redirect()->back()->with($notification);

            }else{

            // Using Eloquent ORM Insert Data
            Brand::find($id)->update([
                'brand_name' => $request->brand_name,
                'created_at' => Carbon::now()
            ]);

            return Redirect()->back()->with($notification);
            // return Redirect()->back()->with('success', 'Brand Updated Successfully');
            
            }
        
        
    }


    // method to delete brand
    public function Delete($id)
    {
         // find the image
         $image = Brand::find($id);
         $old_image = $image->brand_image;
         // unlink: deletes the image
         unlink($old_image);
 
 
        // Using Eloquent ORM to Delete Brand
        Brand::find($id)->delete();

        //  Using Toastr Js
        $notification = array(
            'message' => 'Brand Deleted Successfully',
            'alert-type' => 'warning'
        );

        return Redirect()->back()->with($notification);

        // return Redirect()->back()->with('success', 'Brand Deleted Successfully');
    }


    // method to logout
    public function Logout(){
        Auth::logout();

         // Using Toastr Js
         $notification = array(
            'message' => 'You Have Successfully Logout ',
            'alert-type' => 'success'
        );

        // redirect to login page
        return Redirect()->route('login')->with($notification);
    }
}
