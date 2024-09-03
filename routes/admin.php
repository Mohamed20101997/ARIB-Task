<?php

use App\Http\Controllers\Dashboard\WelcomeController;
use App\Http\Controllers\Dashboard\AuthController;
use App\Http\Controllers\Dashboard\EmployeeController;
use App\Http\Controllers\Dashboard\DepartmentController;
use App\Http\Controllers\Dashboard\TaskController;
use Illuminate\Support\Facades\Route;


Route::group(['middleware'=>['auth:admin']], function () {

    Route::get('/',[WelcomeController::class,'index'])->name('welcome');

    //logout route
    Route::post('logout', [AuthController::class,'logout'])->name('logout');

    //department route
    Route::resource('department', DepartmentController::class)->except('show');

    //employee route
    Route::resource('employee', EmployeeController::class);



    //task route
    Route::resource('task', TaskController::class);
    Route::put('employee/update_task/{id}',[TaskController::class ,'updateTaskStatuses'])->name('employee.updateTasks');
});  /** End of Route Group  */



/** Start Auth Section */

Route::group(['middleware'=>'guest:admin'], function () {

    Route::get('login',  [AuthController::class,'getLogin'])->name('getLogin');
    Route::post('login',  [AuthController::class,'login'])->name('login');

});
