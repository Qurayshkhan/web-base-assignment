<?php

use App\Http\Controllers\CollageController;
use App\Http\Controllers\CourseController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\UserController;
use App\Models\Course;
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
    Route::get('/get-student-course', [HomeController::class, 'studentCourse'])->name('get.student.course');



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
    Route::get('/collage-list', [CollageController::class, 'getCollageList'])->name('collage.list');
    Route::post('/collage-update-information', [CollageController::class, 'updateCollageInformation'])->name('update.collage');




    // collage

    Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher');


    Route::get('get-teacher', [TeacherController::class, 'getTeacherList'])->name('get.teacher.list');

    Route::post('/add-teacher', [TeacherController::class, 'store'])->name('teacher.store');

    Route::delete('/delete-teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.delete');


    // students
    Route::get('/students', [StudentController::class, 'index'])->name('students');

    Route::get('/get-student', [StudentController::class, 'getStudents'])->name('get.student');
    Route::post('/store-student', [StudentController::class, 'store'])->name('store.student');

    Route::delete('/delete-student/{student}', [StudentController::class, 'deleteStudent'])->name('delete.  student');









    // course
    Route::get('/course', [CourseController::class, 'index'])->name('course');
    Route::post('store-update-course', [CourseController::class, 'store'])->name('cours.store');

    Route::post('/assignment-upload', [CourseController::class, 'uploadAssignment'])->name('course.assignment');

    Route::post('/add-update-course', [CourseController::class, 'addEditCourse'])->name('store.update.course');
    Route::delete('/delete-course/{course}', [CourseController::class, 'destroy'])->name('course.delete');

    Route::get('/assignments/{id}/content', [CourseController::class, 'getContent'])->name('read-assignmnet');

    Route::get('/get-course-assignment/{course}', [CourseController::class, 'getCourseAssignment'])->name('course.assignment.id');

    Route::post('/course-submit-assignment', [CourseController::class, 'submitAssignment'])->name('submit.assignment');



    Route::post('/mark-assignment-result', [CourseController::class, 'markAssignmentResult'])->name('assignment.mark.results');
});
