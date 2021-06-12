<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\Slider;
use Image;
use Auth;

class HomeController extends Controller
{
     //Slider
     public function HomeSlider()
     {
          // Using Eloquent ORM to get data
         $sliders = Slider::latest()->get();
         return view('admin.slider.index', compact('sliders'));
     }
 
     // Call Create Slider Page
     public function AddSlider()
     {
         
         return view('admin.slider.create');
     }
 
     // Method to Store Slider
     public function StoreSlider(Request $request)
     {
        
         $validated = $request->validate([
             'title' => 'required|unique:sliders|min:4',
             'image' => 'required|mimes:jpg,jpeg,png',
         ],
         [
             'title.required' => 'Please Input Slider Title',
             'image.required' => 'The Slider Image field is required',
             'title.min' => 'Title Must be Longer than 4 Characters',
         ]);
 
         // get the uploaded image
         $slider_image = $request->file('image');
 
         // generate unique id for uploaded image
         $name_gen = hexdec(uniqid()). '.'. $slider_image->getClientOriginalExtension();
         // Using image intervention to resize and save in the specified location with the id
         Image::make($slider_image)->resize(1920,1088)->save('image/slider/'.$name_gen);
         // save uploaded image
         $last_img = 'image/slider/'.$name_gen;
 
         // Using Eloquent ORM to Insert Brand
         Slider::insert([
             'title' => $request->title,
             'description' => $request->description,
             'image' => $last_img,
             'created_at' => Carbon::now()
         ]);
         // after insert redirect to home/slider page 
         return Redirect()->route('home.slider')->with('success', 'Slider Inserted Successfuly');
     }
 
     // Edit 
     public function Edit($id)
     {
         $sliders = Slider::find($id);
 
         return view('admin.slider.edit', compact('sliders'));
     }
 
 
     // Method to update slider
     public function Update(Request $request, $id)
     {
         $validated = $request->validate([
             'title' => 'required|min:4',
         ],
         [
             'title.required' => 'Please Input Slider Title',
             'title.min' => 'Title Must be Longer than 4 Characters',
         ]);
 
         // old image
         $old_image = $request->old_image;
 
         // get the uploaded image
         $slider_image = $request->file('image');
         if($slider_image){
 
                // generate unique id for uploaded image
         $name_gen = hexdec(uniqid());
 
         // get image extension(jpg, jpeg, png)
         $img_ext = strtolower($slider_image->getClientOriginalExtension());
 
         // get the unique name of the image
         $img_name = $name_gen.'.'.$img_ext;
 
         // Upload image
         $up_location = 'image/slider/';
 
         // before saving image 
         $last_img = $up_location.$img_name;
 
         // save uploaded image
         $slider_image->move($up_location,$img_name);
 
         // unlink old image
         unlink($old_image);
 
          // Using Eloquent ORM to Insert slider
          Slider::find($id)->update([
             'title' => $request->title,
             'description' => $request->description,
             'image' => $last_img,
             'created_at' => Carbon::now()
         ]);
         // redirect route from update to all slider page
         return Redirect()->back()->with('success', 'Slider Updated Successfuly');
 
 
         }else{
             // Using Eloquent ORM to Insert slider
             Slider::find($id)->update([
                 'title' => $request->title,
                 'description' => $request->description,
                 'created_at' => Carbon::now()
             ]);
 
              // redirect route from update to all brand page
          return Redirect()->back()->with('success', 'Brand Updated Successfuly');
         }
     }
 
 
     // Method to Delete Slider 
     public function SliderDelete($id)
     {
         // find the image
         $image = Slider::find($id);
         $old_image = $image->image;
         // unlink: deletes the image
         unlink($old_image);
 
 
         // Using Eloquent ORM to Delete Slider
         Slider::find($id)->delete();
 
          // redirect route from update to all slider page
        return Redirect()->back()->with('success', 'Slider Deleted Successfuly');
     }
}
