<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\SiteController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Models\Location;

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

//categories+sites
Route::get('/categories', [CategoryController::class,'allCategories']);
//categories+sites of selected category
Route::get('/categories/{category}', [CategoryController::class,'singleCategory']);



//sites
Route::get('/sites', [SiteController::class,'allSites']);
Route::get('/sites/{site}', [SiteController::class,'singleSite']); 

