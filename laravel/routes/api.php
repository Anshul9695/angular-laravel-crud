<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('student/add',[UserController::class,'AddStudent']);
Route::post('student/update/{id}',[UserController::class,'UpdateStudent']);
Route::delete('student/delete/{id}',[UserController::class,'deleteStudent']);
Route::get('student/show',[UserController::class,'showStudent']);