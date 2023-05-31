<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySiteController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteSiteController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\userController;
use App\Http\Controllers\RatingController;
use App\Http\Controllers\ImageController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::middleware('auth:api')->group(function (){
    Route::get('/user', function (Request $request) {
        return $request->user();
    });

    //user
    Route::post('/update', [userController::class, 'update']);
    Route::get('/profile', [userController::class, 'profile']);
    Route::post('/logout', [userController::class, 'logout']);
    

    //tested
    Route::get('/categories', [CategoryController::class,'index']);
    Route::post('/categories', [CategoryController::class,'create']);
    Route::delete('/categories/{category}', [CategoryController::class,'destroy']); 
    Route::put('/categories/{category}', [CategoryController::class,'update']); 

    //categories with thier sites
    Route::get('/categorysites', [CategorySiteController::class,'index']);
    //sites of selected category
    Route::get('/categorysites/{category}', [CategorySiteController::class,'singleCategory']);
    Route::post('/categorysites', [CategorySiteController::class,'create']);
    Route::delete('/routesites/{category}/{site}', [CategorySiteController::class,'destroy']);

    
    //sites
    Route::get('/sites', [SiteController::class,'allSites']);
    Route::get('/sites/{site}', [SiteController::class,'singleSite']);
    Route::post('/sites', [SiteController::class,'create']);
    Route::delete('/sites/{site}', [SiteController::class,'destroy']);  
    Route::put('/sites/{site}', [SiteController::class,'update']);

    //done
    Route::get('/routes', [RouteController::class,'index']);
    Route::get('routes/{user}', [RouteController::class,'userRoutes']);
    Route::post('/routes', [RouteController::class,'create']);
    Route::delete('/routes/{route}', [RouteController::class,'destroy']);  

    //done
    Route::get('/routesites', [RouteSiteController::class,'index']);
    Route::get('/routesites/{route}', [RouteSiteController::class,'routeSites']);
    Route::post('/routesites', [RouteSiteController::class,'create']); 
    Route::delete('/routesites/{route}/{site}', [RouteSiteController::class,'destroy']);  //done

    //done
    Route::get('/ratings', [RatingController::class,'index']); 
    Route::post('/ratings', [RatingController::class,'create']); 
    Route::get('/ratings/{site}', [RatingController::class,'siteRating']); 
    Route::delete('/ratings/{rating}', [RatingController::class,'destroy']); 

    //post image for site
    Route::post('/image', [ImageController::class,'imageStore']); 
    
});

Route::post('/register', [userController::class, 'register']);
Route::post('/login', [userController::class, 'login']);











