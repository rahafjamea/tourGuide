<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CategorySiteController;
use App\Http\Controllers\LocationController;
use App\Http\Controllers\RouteController;
use App\Http\Controllers\RouteSiteController;
use App\Http\Controllers\SiteController;
use App\Http\Controllers\userController;
use App\Http\Controllers\RatingController;
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
// Route::middleware('auth:api')->prefix('v1')->group(function() {
//     Route::get('/user', function (Request $request) {
//         return $request->user();
//     });

    
// });

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//tested
Route::get('/categories', [CategoryController::class,'index']);
Route::post('/categories', [CategoryController::class,'create']);
Route::delete('/categories/{category}', [CategoryController::class,'destroy']); 
Route::put('/categories/{category}', [CategoryController::class,'update']); 

//categories+sites need to make categories many to many
Route::get('/categorysites', [CategorySiteController::class,'allCategories']);
//categories+sites of selected category
Route::get('/categorysites/{category}', [CategorySiteController::class,'singleCategory']);
Route::post('/categorysites', [CategorySiteController::class,'create']);
Route::delete('/routesites/{category}/{site}', [CategorySiteController::class,'destroy']);
Route::post('/routesites/{site}', [CategorySiteController::class,'addSiteCategory']);
//need updating

//sites //need updating
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

//done //need ordering mechanism api/algorithm
Route::get('/routesites', [RouteSiteController::class,'index']);
Route::get('/routesites/{route}', [RouteSiteController::class,'routeSites']);
Route::post('/routesites', [RouteSiteController::class,'create']); 
Route::delete('/routesites/{route}/{site}', [RouteSiteController::class,'destroy']);  //done

//done
Route::get('/ratings', [RatingController::class,'index']); 
Route::post('/ratings', [RatingController::class,'create']); 
Route::get('/ratings/{site}', [RatingController::class,'siteRating']); 
Route::delete('/ratings/{rating}', [RatingController::class,'destroy']); 

//not working
Route::post('/login', [userController::class, 'loginPost'])->name('login.post'); //we can access the route by this name
Route::post('/registraion', [userController::class, 'registrationPost'])->name('registration.post');
Route::get('/logout', [userController::class, 'logout'])->name('logout');
Route::post('/update-profile', [userController::class, 'updateProfile'])->name('update.profile');