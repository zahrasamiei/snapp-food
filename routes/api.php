<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\RecipeController;

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

#login and register api routes
Route::post("login",[UserController::class, 'login']);
Route::post("register",[UserController::class, 'register'])->name("register");
#end

#each route needed Bearer token
Route::middleware("auth:api")->group( function (){
    Route::post("/order", [ OrderController::class, 'create' ]);
    Route::prefix("menu")->group( function (){
        Route::get("/", [ RecipeController::class, 'menu' ]);
        Route::post("/", [ RecipeController::class, 'menuWithFilters' ]);
    });
});
#end
