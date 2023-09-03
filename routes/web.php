<?php

use App\Http\Controllers\Dashboard\SectionController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
})->name('home');


Route::group(
    [
        'prefix' => LaravelLocalization::setLocale(),
        'middleware' => [ 'localeSessionRedirect', 'localizationRedirect', 'localeViewPath' ]
    ], function(){

        Route::get('/user/dashboard', function () {
            return view('backend.user.dashboard');
        })->middleware(['auth:web', 'verified'])->name('user.dashboard');

        Route::get('/admin/dashboard', function () {
            return view('backend.admin.dashboard');
        })->middleware(['auth:admin', 'verified'])->name('admin.dashboard');

        Route::middleware(['auth:admin'])->group(function(){
            Route::resource('section',SectionController::class)->names('section');
        });

        require __DIR__.'/auth.php';
    });




Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


