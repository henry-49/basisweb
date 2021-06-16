<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Auth;

class ChangePassController extends Controller
{
        //Method to ChangePassword
  public function  ChangePass(){

    return view('admin.body.change_password');
}

// Method Update Changed Password
public function UpdatePass(Request $request)
{
    $validated = $request->validate([
        'oldpassword' => 'required',
        'password' => 'required|confirmed',
    ],
    [
        'oldpassword.required' => 'Please Input Your Old Password',
    ]);
    
    // get the hashed password
    $hashedPassword = Auth::user()->password;
    // check if the old password entered is a match with the hashed password
    if(Hash::check($request->oldpassword, $hashedPassword)){
        // find the Authenticated user id
        $user = User::find(Auth::id());
        // hash the new entered password
        $user->password = Hash::make($request->password);
        
        // Save user password
        $user->save();

        // logout the user after saving the changed password
        Auth::logout();


        return Redirect()->route('login')->with('success', 'Your Password was Changed Successfully');
    }else{
        return Redirect()->back()->with('error', 'Current Password Is Invalid');
    }
    
}


// Get Authenticated User Profile
public function UpdateProfile()
{
    // if user is authenticated
    if(Auth::user()){
        // find the authenticated user id
        $user = User::find(Auth::user()->id);

        // if user has any id then return update profile view
        if($user){
            return view('admin.body.update_profile', compact('user'));
        }
    }
}


// Update Authenticated User Profile
public function UpdateUserProfile(Request $request)
{
    $validated = $request->validate([
        'name' => 'required',
        'email' => 'required'
    ],
    [
    'name.required' => 'Name Input Can\'t Be Empty!',
    ]);

    // Find the Authenticated user id
    $user = User::find(Auth::user()->id);
    // If There is any user data
    if($user){
        $user->name = $request['name'];
        $user->email = $request['email'];

        // save user
        $user->save();

        return Redirect()->back()->with('success', 'User Profile Updated Successfully!');

    }else{
        return Redirect()->back();
    }
}
}
