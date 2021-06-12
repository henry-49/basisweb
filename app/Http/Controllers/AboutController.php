<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use App\Models\HomeAbout;
use DB;
use Auth;

class AboutController extends Controller
{
     //Method to get about
     public function HomeAbout()
     {
         // get all the letest data for about
         $homeabout = HomeAbout::latest()->get();
 
         return view('admin.about.index', compact('homeabout'));
     }
 
     // Call create About Page
     public function AddAbout()
     {
         
         return view('admin.about.create');
     }
 
       // Method to Store Slider
       public function StoreAbout(Request $request)
       {
          
           $validated = $request->validate([
               'title' => 'required|unique:home_abouts|min:4',
               'short_des' => 'required',
               'long_des' => 'required',
           ],
           [
               'title.required' => 'Please Input Home About Title',
               'title.min' => 'Title Must be Longer than 4 Characters',
           ]);
   
           // Using Eloquent ORM to Insert Brand
           HomeAbout::insert([
               'title' => $request->title,
               'short_des' => $request->short_des,
               'long_des' =>  $request->long_des,
               'created_at' => Carbon::now()
           ]);
           // after insert redirect to home/about page 
           return Redirect()->route('home.about')->with('success', 'About Inserted Successfully');
       }
 
         // Edit 
      public function Edit($id)
     {
         $homeabout = HomeAbout::find($id);
 
         return view('admin.about.edit', compact('homeabout'));
     }
 
      // will recieve a POST request and update the specified ID
      public function Update(Request $request, $id)
      {
          // Using Eloquent ORM to Update Data
        $updateabout =  HomeAbout::find($id)->update([
             'title' => $request->title,
             'short_des' => $request->short_des,
             'long_des' =>  $request->long_des
         ]);
 
          // redirect route from update to all category page
          return Redirect()->route('home.about')->with('success', 'About Updated Successfuly');
      }
 
       // Method to Delete About 
     public function AboutDelete($id)
     {
           // Using Eloquent ORM to Delete About
         $delete = HomeAbout::find($id)->delete();
 
         // Delete and Redirect back to the page with a success message
         return Redirect()->back()->with('success', 'About Deleted Successfully!');
     }
}
