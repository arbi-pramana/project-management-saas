<?php

use App\Http\Controllers\User\DepartmentController;
use App\Http\Controllers\User\EmployeeController;
use App\Http\Controllers\User\EmployeeTypeController;
use App\Http\Controllers\User\HomeController;
use App\Http\Controllers\User\LoginController;
use App\Http\Controllers\User\RegisterController;
use App\Http\Controllers\User\ClientController;
use App\Http\Controllers\User\ProjectController;
use App\Http\Controllers\User\ExpenseController;
use App\Http\Controllers\User\IncomeController;
use App\Http\Controllers\User\MilestoneController;
use App\Http\Controllers\User\TaskController;
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

Route::get('/', function () {
    return view('welcome');
});

Route::get('blank',function(){
    return view('users.blank');
});

Route::get('login',LoginController::class.'@login')->name('users.login');
Route::post('auth',LoginController::class.'@auth')->name('users.auth');
Route::get('register',RegisterController::class.'@register')->name('users.register.index');
Route::post('register/store',RegisterController::class.'@store')->name('users.register.store');
Route::get('verify',RegisterController::class.'@verify')->name('users.register.verify');

Route::group(['middleware'=>'users.auth','prefix'=>'users'],function(){
    Route::get('logout',LoginController::class.'@logout')->name('users.logout');
    Route::get('dashboard',HomeController::class.'@index')->name('users.dashboard.index');
    
    Route::group(['prefix'=>'client'],function(){
        Route::get('/',ClientController::class.'@index')->name('users.client.index');
        Route::post('/',ClientController::class.'@store')->name('users.client.store');
        Route::put('/',ClientController::class.'@update')->name('users.client.update');
        Route::delete('/',ClientController::class.'@destroy')->name('users.client.destroy');
    });

    Route::group(['prefix'=>'project'],function(){
        Route::get('/',ProjectController::class.'@index')->name('users.project.index');
        Route::get('/{id}/detail',ProjectController::class.'@detail')->name('users.project.detail');
        Route::post('/',ProjectController::class.'@store')->name('users.project.store');
        Route::put('/',ProjectController::class.'@update')->name('users.project.update');
        Route::delete('/',ProjectController::class.'@destroy')->name('users.project.destroy');
        // milestone
        Route::get('/{id}/milestone',MilestoneController::class.'@index')->name('users.milestone.index');
        Route::post('/{id}/milestone',MilestoneController::class.'@store')->name('users.milestone.store');
        Route::put('/{id}/milestone',MilestoneController::class.'@update')->name('users.milestone.update');
        Route::delete('/{id}/milestone',MilestoneController::class.'@destroy')->name('users.milestone.destroy');
        // task
        Route::get('/{id}/task',TaskController::class.'@index')->name('users.task.index');
        Route::post('/{id}/task',TaskController::class.'@store')->name('users.task.store');
        Route::put('/{id}/task',TaskController::class.'@update')->name('users.task.update');
        Route::delete('/{id}/task',TaskController::class.'@destroy')->name('users.task.destroy');
        // income
        Route::get('/{id}/income',IncomeController::class.'@index')->name('users.income.index');
        Route::post('/{id}/income',IncomeController::class.'@store')->name('users.income.store');
        Route::put('/{id}/income',IncomeController::class.'@update')->name('users.income.update');
        Route::delete('/{id}/income',IncomeController::class.'@destroy')->name('users.income.destroy');
        // expense
        Route::get('/{id}/expense',ExpenseController::class.'@index')->name('users.expense.index');
        Route::post('/{id}/expense',ExpenseController::class.'@store')->name('users.expense.store');
        Route::put('/{id}/expense',ExpenseController::class.'@update')->name('users.expense.update');
        Route::delete('/{id}/expense',ExpenseController::class.'@destroy')->name('users.expense.destroy');
    });

    Route::group(['prefix'=>'department'],function(){
        Route::get('/',DepartmentController::class.'@index')->name('users.department.index');
        Route::post('/',DepartmentController::class.'@store')->name('users.department.store');
        Route::put('/',DepartmentController::class.'@update')->name('users.department.update');
        Route::delete('/',DepartmentController::class.'@destroy')->name('users.department.destroy');
    });

    Route::group(['prefix'=>'employee-type'],function(){
        Route::get('/',EmployeeTypeController::class.'@index')->name('users.employee-type.index');
        Route::post('/',EmployeeTypeController::class.'@store')->name('users.employee-type.store');
        Route::put('/',EmployeeTypeController::class.'@update')->name('users.employee-type.update');
        Route::delete('/',EmployeeTypeController::class.'@destroy')->name('users.employee-type.destroy');
    });

    Route::group(['prefix'=>'employee'],function(){
        Route::get('/',EmployeeController::class.'@index')->name('users.employee.index');
        Route::post('/',EmployeeController::class.'@store')->name('users.employee.store');
        Route::put('/',EmployeeController::class.'@update')->name('users.employee.update');
        Route::delete('/',EmployeeController::class.'@destroy')->name('users.employee.destroy');
    });
});