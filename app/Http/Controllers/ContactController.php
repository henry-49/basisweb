<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;
use App\Models\Contact;
use App\Models\ContactForm;

class ContactController extends Controller
{

      // redirect user to login when trying to access url without login
    // construtor
    // public function __construct(){
    //     // check if user is loggedin or not
    //     // if user is not loggedin then redirct to login route
    //     $this->middleware('auth');
    // }

    // For Frontend Page
    public function Contact()
    {
        $contact = DB::table('contacts')->first();
        return view('pages.contact', compact('contact'));
    }

    // Method for Conatct Form
    public function ContactForm(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|unique:contact_forms|min:4',
            'email' => 'required',
            'subject' => 'required',
            'message' => 'required',
        ],
        [
            'name.required' => 'Please Enter Your Name',
            'name.min' => 'Name Must be Longer than 4 Characters',
            'email.required' => 'Please Enter Your Email',
            'subject.required' => 'Sorry! Subject Field Can\'t be Empty',
        ]);

        
           // Using Eloquent ORM to Insert Contact
           ContactForm::insert([
            'name' => $request->name,
            'email' => $request->email,
            'subject' =>  $request->subject,
            'message' =>  $request->message,
            'created_at' => Carbon::now()
        ]);
        // after insert redirect to admin/contact page 
        return Redirect()->route('contact')->with('success', 'Your Message Was Sent Successfully');
    }

    // AdminMessage
    public function AdminMessage()
    {
        // $messages = ContactForm::latest()->paginate(1);
        $messages = ContactForm::all();
        return view('admin.contact.message', compact('messages'));
    }

      // Method to Delete Message 
      public function DeleteAdminMessage($id)
      {
            // Using Eloquent ORM to Delete Contact
          $delete = ContactForm::find($id)->delete();
  
          // Delete and Redirect back to the page with a success message
          return Redirect()->back()->with('success', 'Message Deleted Successfully!');
      }

    public function AdminContact()
    {
        $contacts = Contact::all();
        return view('admin.contact.index', compact('contacts'));
    }

     // Call create Contact Page
     public function AddContact()
     {
         
         return view('admin.contact.create');
     }
 
       // Method to Store Contact
       public function StoreContact(Request $request)
       {
          
           $validated = $request->validate([
               'address' => 'required|unique:contacts|min:4',
               'email' => 'required',
               'phone' => 'required',
           ],
           [
               'address.required' => 'Please Input Contact Address',
               'email.required' => 'Please Enter Your Email',
               'address.min' => 'Address Must be Longer than 4 Characters',
           ]);
   
           // Using Eloquent ORM to Insert Contact
           Contact::insert([
               'address' => $request->address,
               'email' => $request->email,
               'phone' =>  $request->phone,
               'created_at' => Carbon::now()
           ]);
           // after insert redirect to admin/contact page 
           return Redirect()->route('admin.contact')->with('success', 'Contact Inserted Successfully');
       }

       // Edit Contact
       public function EditContact($id)
       {
           $admincontact = Contact::find($id);
           return view('admin.contact.edit', compact('admincontact'));
       }


       // will recieve a POST request and update the specified ID
     public function UpdateContact(Request $request, $id)
     {
         // Using Eloquent ORM to Update Data
       $updateabout =  Contact::find($id)->update([
            'address' => $request->address,
            'email' => $request->email,
            'phone' =>  $request->phone,
        ]);

         // redirect route from update to all category page
         return Redirect()->route('admin.contact')->with('success', 'Contact Updated Successfuly');
     }

      // Method to Delete Contact 
    public function DeleteContact($id)
    {
          // Using Eloquent ORM to Delete Contact
        $delete = Contact::find($id)->delete();

        // Delete and Redirect back to the page with a success message
        return Redirect()->back()->with('success', 'Contact Deleted Successfully!');
    }

 
}
