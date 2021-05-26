<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\MultipicController;
use App\Models\User;
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
    return view('welcome');
});

Route::get('/home', function () {
    echo "This is a test for middleware!";
});

Route::get('/about', function () {
    return view('about');
});


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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all(); // Eloqaunt ORM
    $users = DB::table('users')->get(); // Query Builder

    return view('dashboard', compact('users'));
})->name('dashboard');
