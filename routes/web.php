<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthorController;
use App\Http\Controllers\BranchController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\companyController;
use App\Http\Controllers\Front\HomeController;
use App\Http\Controllers\UserAuthController;
use App\Mail\AdminEmail;
use App\Models\Product;

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

Route::prefix('cms/')
->middleware('guest:admin,author')
->group(function(){
    Route::get('{guard}/login' , [UserAuthController::class , 'showLogin'] )->name('view.login');
    Route::post('{guard}/login' , [UserAuthController::class , 'login']);
});

Route::prefix('cms/admin/')
->middleware('auth:admin,author')
->group(function(){
    Route::get('logout' , [UserAuthController::class , 'logout'] )->name('view.test');
    Route::get('change_password' , [UserAuthController::class , 'changePassword'])->name('change_password');
    Route::post('update_password' , [UserAuthController::class , 'updatePassword'])->name('update_password');

    Route::get('edit-profile-admin' , [UserAuthController::class , 'editProfile'] )->name('edit-profile-admin');
    Route::post('update-profile' , [UserAuthController::class , 'UpdateProfile'] )->name('update-profile');


    Route::get('change-password' , [UserAuthController::class , 'editPassword'] )->name('view.editPassword');
    Route::post('update-password' , [UserAuthController::class , 'updatePassword'] )->name('update-password');

});





Route::prefix('cms/admin/')
// ->middleware('auth:admin,author')
->group(function(){
    Route::view('' , 'cms.home');
    Route::view('temp' , 'cms.temp');
    Route::view('index' , 'cms.company.index');
    Route::resource('companies' , CompanyController::class);
    Route::post('update-companies/{id}' , [companyController::class , 'update'])->name('update-companies');
    Route::get('forceDelete/{id}' ,[ CompanyController::class , 'forceDelete'] );
    Route::get('restoreindexx', [CompanyController::class, 'restoreindex'])->name('restoreindexx');
    Route::get('restoree/{id}', [CompanyController::class, 'restore'])->name('restoree');

    Route::resource('branches' , BranchController::class);
    Route::post('update-branches/{id}' , [BranchController::class , 'update'])->name('update-branches');


    Route::resource('admins' , AdminController::class);
    Route::post('update-admins/{id}' , [AdminController::class , 'update'])->name('admins-update');
    Route::get('forceDelete/{id}' ,[ AdminController::class , 'forceDelete'] );
    Route::get('restoreindex', [AdminController::class, 'restoreindex'])->name('restoreindex');
    Route::get('restore/{id}', [AdminController::class, 'restore'])->name('restore');
    Route::resource('authors' , AuthorController::class);
    Route::post('update-authors/{id}' , [AuthorController::class , 'update'])->name('update-authors');



});


// Route::get('email' , function(){
//     return new AdminEmail();
// });



