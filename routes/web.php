<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\CategoryController;
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


Route::middleware(['auth:sanctum', 'verified'])->get('/dashboard', function () {
    // $users = User::all(); // Eloqaunt ORM
    $users = DB::table('users')->get(); // Query Builder

    return view('dashboard', compact('users'));
})->name('dashboard');
