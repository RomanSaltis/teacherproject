<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\GroupController;
use App\Http\Controllers\StudentController;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');



Route::group(['prefix' => 'projects'], function(){
   Route::group(['middleware' => ['auth']], function() {
   Route::get('create', [ProjectController::class, 'create'])->name('project.create');
   Route::post('store', [ProjectController::class, 'store'])->name('project.store');
   Route::get('edit/{project}', [ProjectController::class, 'edit'])->name('project.edit');
   Route::post('update/{project}', [ProjectController::class, 'update'])->name('project.update');
   Route::post('delete/{project}', [ProjectController::class, 'destroy'])->name('project.destroy');
   });
   Route::get('', [ProjectController::class, 'index'])->name('project.index');
});

Route::group(['prefix' => 'groups'], function(){
   Route::group(['middleware' => ['auth']], function() {
   Route::get('create', [GroupController::class, 'create'])->name('group.create');
   Route::post('store', [GroupController::class, 'store'])->name('group.store');
   Route::get('edit/{group}', [GroupController::class, 'edit'])->name('group.edit');
   Route::post('update/{group}', [GroupController::class, 'update'])->name('group.update');
   Route::post('delete/{group}', [GroupController::class, 'destroy'])->name('group.destroy');
   });
   Route::get('', [GroupController::class, 'index'])->name('group.index');
});

Route::group(['prefix' => 'students'], function(){
   Route::group(['middleware' => ['auth']], function() {
   Route::get('create', [StudentController::class, 'create'])->name('student.create');
   Route::post('store', [StudentController::class, 'store'])->name('student.store');
   Route::get('edit/{student}', [StudentController::class, 'edit'])->name('student.edit');
   Route::post('update/{student}', [StudentController::class, 'update'])->name('student.update');
   Route::post('delete/{student}', [StudentController::class, 'destroy'])->name('student.destroy');
   });
   Route::get('', [StudentController::class, 'index'])->name('student.index');
});
