<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\TodoItemController;

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

Route::post('/user-login',[UserController::class,'UserLogin']);

Route::post("/store",[TodoItemController::class,'CategoryCreate'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/update",[TodoItemController::class,'CategoryDelete'])->middleware([TokenVerificationMiddleware::class]);
Route::post("/destroy",[TodoItemController::class,'CategoryUpdate'])->middleware([TokenVerificationMiddleware::class]);
