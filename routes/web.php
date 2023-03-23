<?php

use App\Http\Controllers\CollageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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



Route::get('/reset-password/{token}/{email}', [UserController::class, 'resetPassword']);
Route::post('/update-reset-password', [UserController::class, 'resetPasswordRequest'])->name('user.update.passowrd');



Route::get('/', function () {
    return view('auth.login');
});

Route::get('/profile-complete', [HomeController::class, 'completeProfile'])->name('complete.profile');

Auth::routes();

Route::group(['middleware' => ['auth']], function () {



    Route::get('/home', [HomeController::class, 'index'])->name('home');

    // User
    Route::get('/users', [UserController::class, 'index'])->name('users');

    Route::post('/add-user', [UserController::class, 'createUpdateUser'])->name('user.add.user');

    Route::get('/get-users', [UserController::class, 'getUsersList'])->name('get.users');

    Route::delete('/delete-user/{user}', [UserController::class, 'destroy'])->name('user.delete');



    // Roles

    Route::get('/get-roles', [RoleController::class, 'index'])->name('get.roles');

    Route::get('/roles', [RoleController::class, 'getRolesWithPermission'])->name('roles.list');

    Route::post('/add-user-role', [RoleController::class, 'addRole'])->name('add.user.roles');

    Route::get('/roles/{role}/edit', [RoleController::class, 'edit'])->name('edit.role');

    Route::delete('/delete-role/{role}', [RoleController::class, 'destroy'])->name('role.delete');


    // collage

    Route::get('/collage', [CollageController::class, 'index'])->name('collage');


});
