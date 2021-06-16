<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultipicController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\PortfolioController;
use App\Http\Controllers\ChangePassController;
use App\Models\User;
use App\Models\Multipic;
use Illuminate\Support\Facades\DB;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// route to verify user email after registration
Route::get('/email/verify', function () {
    return view('auth.verify-email');
})->middleware('auth')->name('verification.notice');



Route::get('/', function () {

    // return view('welcome');
    // Displays in Frontend
    $brands = DB::table('brands')->get();
    $abouts = DB::table('home_abouts')->first();
    $multipics = Multipic::all();
     return view('home', compact('brands','abouts','multipics'));
});

Route::get('/home', function () {
    echo "This is a test for middleware!";
});

// Route::get('/about', function () {
//     return view('about');
// });


//Laravel 7 and 6
//Route::get('/contact', 'ContactController@index');

// Laravel 8
Route::get('/contact', [ContactController::class, 'index'])->name('contact');


// Category Route
Route::get('/category/all', [CategoryController::class, 'AllCat'])->name('all.category');
Route::post('/category/add', [CategoryController::class, 'AddCat'])->name('store.category');
Route::get('/category/edit/{id}', [CategoryController::class, 'EditCat']);
Route::post('/category/update/{id}', [CategoryController::class, 'UpdateCat']);

Route::get('/softdelete/category/{id}', [CategoryController::class, 'SoftDeleteCat']);
Route::get('/category/restore/{id}', [CategoryController::class, 'RestoreCat']);
Route::get('/pdelete/category/{id}', [CategoryController::class, 'PDeleteCat']);



// Brand Route
Route::get('/brand/all', [BrandController::class, 'AllBrand'])->name('all.brand');
Route::post('/brand/add', [BrandController::class, 'StoreBrand'])->name('store.brand');
Route::get('/brand/edit/{id}', [BrandController::class, 'Edit']);
Route::post('/brand/update/{id}', [BrandController::class, 'Update']);
Route::get('/brand/delete/{id}', [BrandController::class, 'Delete']);


// Multi Image Route
Route::get('/multi/image', [MultipicController::class, 'Multipic'])->name('multi.image');
Route::post('/multi/add', [MultipicController::class, 'StoreMultiImage'])->name('store.image');
Route::get('/multi/delete/{id}', [MultipicController::class, 'Delete']);


// Admin All Route
Route::get('/home/slider', [HomeController::class, 'HomeSlider'])->name('home.slider');
Route::get('/add/slider', [HomeController::class, 'AddSlider'])->name('add.slider');
Route::post('/store/slider', [HomeController::class, 'StoreSlider'])->name('store.slider');
Route::get('/edit/slider/{id}', [HomeController::class, 'Edit']);
Route::post('/update/slider/{id}', [HomeController::class, 'Update']);
Route::get('/delete/slider/{id}', [HomeController::class, 'SliderDelete']);




// Home About Routes
Route::get('/home/about', [AboutController::class, 'HomeAbout'])->name('home.about');
Route::get('/add/about', [AboutController::class, 'AddAbout'])->name('add.about');
Route::post('/store/about', [AboutController::class, 'StoreAbout'])->name('store.about');
Route::get('/edit/about/{id}', [AboutController::class, 'Edit']);
Route::post('/update/about/{id}', [AboutController::class, 'Update']);
Route::get('/delete/about/{id}', [AboutController::class, 'AboutDelete']);


// Admin Portfolio Route
Route::get('/portfolio', [PortfolioController::class, 'Portfolio'])->name('portfolio');


// Admin Contact Page Routes
Route::get('/admin/contact', [ContactController::class, 'AdminContact'])->name('admin.contact');
Route::get('/add/contact', [ContactController::class, 'AddContact'])->name('add.contact');
Route::post('/store/contact', [ContactController::class, 'StoreContact'])->name('store.contact');
Route::get('/edit/contact/{id}', [ContactController::class, 'EditContact']);
Route::post('/update/contact/{id}', [ContactController::class, 'UpdateContact']);
Route::get('/delete/contact/{id}', [ContactController::class, 'DeleteContact']);
Route::get('/add/message', [ContactController::class, 'AdminMessage'])->name('admin.message');
Route::get('/delete/message/{id}', [ContactController::class, 'DeleteAdminMessage']);


// Frontend Contact Page Routes
Route::get('/contact', [ContactController::class, 'Contact'])->name('contact');
Route::post('/contact/form', [ContactController::class, 'ContactForm'])->name('contact.form');


Route::get('/about', [AboutController::class, 'About'])->name('about');


// Change Password and User Profile Routes
Route::get('/user/password', [ChangePassController::class, 'ChangePass'])->name('change.password');
Route::post('/update/password', [ChangePassController::class, 'UpdatePass'])->name('update.password');


//User Profile Route
Route::get('/user/profile', [ChangePassController::class, 'UpdateProfile'])->name('update.profile');
Route::post('/user/profile/update', [ChangePassController::class, 'UpdateUserProfile'])->name('update.user.profile');


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all(); // Eloqaunt ORM
    // $users = DB::table('users')->get(); // Query Builder

    return view('admin.index');
    // return view('dashboard', compact('users'));
})->name('dashboard');


// Logut Route
Route::get('/user/logout', [BrandController::class, 'Logout'])->name('user.logout');
