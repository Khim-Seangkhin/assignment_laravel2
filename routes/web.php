<?php

use App\Http\Controllers\ApplyForItDepartmentController;
use App\Http\Controllers\ApplyForSaleDepartmentController;
use App\Http\Controllers\ItDapartmentController;
use App\Http\Controllers\MissionLeaveStatusController;
use App\Http\Controllers\MissionLeaveSubmitController;
use App\Http\Controllers\SaleDepartmentController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes(['register' => false]);

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::controller(UserController::class)->group(function() {
    Route::get('/user', 'index')->name('user.index');
    Route::get('/user/create', 'create')->name('user.create');
    Route::post('/user/store', 'store')->name('user.store');
    Route::get('/user/edit/{id}', 'edit')->name('user.edit');
    Route::post('/user/update/{id}', 'update')->name('user.update');
    Route::get('/user/logout', 'logout')->name('user.logout');
    Route::get('/user/mission_approve', 'mission_approve');
    Route::get('/user/mission_reject', 'mission_reject');
    Route::get('/user/leave_approve', 'leave_approve');
    Route::get('/user/leave_reject', 'leave_reject');
});

Route::controller(ApplyForItDepartmentController::class)->group(function() {
    Route::get('/apply_for_it_department', 'index')->name('apply_for_it_department.index');
    Route::get('/apply_for_it_department/create', 'create')->name('apply_for_it_department.create');
    Route::post('/apply_for_it_department/store', 'store')->name('apply_for_it_department.store');
    Route::get('/apply_for_it_department/edit/{id}', 'edit')->name('apply_for_it_department.edit');
    Route::post('/apply_for_it_department/update/{id}', 'update')->name('apply_for_it_department.update');
});

Route::controller(ApplyForSaleDepartmentController::class)->group(function() {
    Route::get('/apply_for_sale_department', 'index')->name('apply_for_sale_department.index');
    Route::get('/apply_for_sale_department/create', 'create')->name('apply_for_sale_department.create');
    Route::post('/apply_for_sale_department/store', 'store')->name('apply_for_sale_department.store');
    Route::get('/apply_for_sale_department/edit/{id}', 'edit')->name('apply_for_sale_department.edit');
    Route::post('/apply_for_sale_department/update/{id}', 'update')->name('apply_for_sale_department.update');
});

Route::controller(MissionLeaveSubmitController::class)->group(function() {
    Route::get('/mission_leave_submit', 'index')->name('mission_leave_submit.index');
    Route::get('/mission_leave_submit/submit_mission/{id}', 'submitMission')->name('mission_leave_submit.submit_mission');
    Route::get('/mission_leave_submit/submit_leave/{id}', 'submitLeave')->name('mission_leave_submit.submit_leave');
    
});

Route::controller(MissionLeaveStatusController::class)->group(function() {
    Route::get('/mission_leave_status', 'index')->name('mission_leave_status.index');
});

Route::controller(ItDapartmentController::class)->group(function() {
    Route::get('/it_department', 'index')->name('it_department.index');
    Route::get('/it_department/approve/{id}', 'approve')->name('it_department.approve');
    Route::get('/it_department/reject/{id}', 'reject')->name('it_department.reject');
});

Route::controller(SaleDepartmentController::class)->group(function() {
    Route::get('/sale_department', 'index')->name('sale_department.index');
    Route::get('/sale_department/approve/{id}', 'approve')->name('sale_department.approve');
    Route::get('/sale_department/reject/{id}', 'reject')->name('sale_department.reject');
});
