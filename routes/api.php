<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\GetController;
use App\Http\Controllers\PostController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::controller(AuthController::class)->group(function(){
    Route::post('/register', 'register');
    Route::post('/login', 'login');
});






Route::middleware('auth.api')->group(function () {
    Route::controller(GetController::class)->group(function(){
        Route::get('/alltask', 'alltask');
        Route::get('/verify_email', 'verify_email')->where(['email' => '.*', 'firstname' => '[A-Za-z]+']);

    });


    Route::controller(PostController::class)->group(function(){
        Route::post("/create_task", "create_task");
        Route::delete("delete_task", "delete_task");
        Route::get("single_task", "single_task");
        Route::put("edit_task", "edit_task");
    });

    Route::controller(AuthController::class)->group(function(){
        Route::get("/logout", "logout");
    });
});
