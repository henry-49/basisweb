<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category;
use Auth;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;


class CategoryController extends Controller
{
    // redirect user to login when trying to access url without login
    public function __construct(){
        $this->middleware('auth');
    }

    // show all categories
    public function AllCat()
    {

        // Query Builder
        // $categories = DB::table('categories')
        //         ->join('users', 'categories.user_id', 'users.id')
        //         ->select('categories.*', 'users.name')
        //         ->latest()->paginate(5);

            //Eloquent ORM
        $categories = Category::latest()->paginate(5);
        $trashCat = Category::onlyTrashed()->latest()->paginate(3);

            // Query Builder
        // $categories = DB::table('categories')->latest()->paginate(5);
        return view('admin.category.index', compact('categories', 'trashCat'));
    }


    public function AddCat(Request $request)
    {
        $validatedData = $request->validate([
            'category_name' => 'required|unique:categories|max:255',
        ],
        [
            'category_name.required' => 'Please Input Category Name',
        ]);


            // Eloquent ORM Insert Data
        // Category::insert([
        //     'category_name' => $request->category_name,
        //     'user_id' => Auth::user()->id,
        //     'created_at' => Carbon::now()
        // ]);

        // $category = new Category;
        // $category->category_name = $request->category_name;
        // $category->user_id = Auth::user()->id;
        // $category->save();


            // Insert Data With Query Builder
        $data = array();
        $data['category_name'] = $request->category_name;
        $data['user_id'] = Auth::user()->id;
        DB::table('categories')->insert($data);

          // Using Toastr Js
          $notification = array(
            'message' => 'Category Inserted Successfuly',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }



    // method to edit category
    public function EditCat($id)
    {
        // find catagory by id
    //   $categories = Category::find($id);
    $categories = DB::table('categories')->where('id', $id)->first();

      // Parse data to view
      return view('admin.category.edit', compact('categories'));
    }

    //method to update category
    public function UpdateCat(Request $request, $id)
    {
          // find catagory by id
    //   $update = Category::find($id)->update([
    //       'category_name' => $request->category_name,
    //       'user_id' => Auth::user()->id,
    //   ]);

    $data = array();
    $data['category_name'] = $request->category_name;
    $data['user_id'] = Auth::user()->id;
    DB::table('categories')->where('id', $id)->update($data);

       // Using Toastr Js
       $notification = array(
        'message' => 'Category Updated Successfully',
        'alert-type' => 'success'
    );


      return Redirect()->route('all.category')->with($notification);
    }


    // method to delete category
    public function SoftDeleteCat($id)
    {
        // find selected id and delete
       $delete = Category::find($id)->delete();

           // Using Toastr Js
           $notification = array(
            'message' => 'Category SoftDeleted Successfuly',
            'alert-type' => 'info'
        );

       return Redirect()->route('all.category')->with($notification);
    }


    // method to restore softdeleted category
    public function RestoreCat($id)
    {
        // restore the selected id
        $restoreDelete = Category::withTrashed()->find($id)->restore();

              // Using Toastr Js
              $notification = array(
                'message' => 'Category Restore Successfully',
                'alert-type' => 'success'
            );

        return Redirect()->route('all.category')->with($notification);
    }



    public function PDeleteCat($id)
    {
        $pdelete = Category::onlyTrashed()->find($id)->forceDelete();

           // Using Toastr Js
           $notification = array(
            'message' => 'Category Delete Parmanently',
            'alert-type' => 'success'
        );

        return Redirect()->back()->with($notification);
    }
}
