<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

use App\Models\Location;

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

//all locations
/*Route::get('/', function () {
    return view('locations',[
        "heading" => "Locations:",
        "locations" => Location::all()
    ]);
});*/

//single locations
Route::get('/locations/{location}', function (Location $location ) {
    return view('location',[
        "locations" => $location
    ]);
});

/*Route::get('/hello',function() {
    return response('<h1>hello world</h1>',200)->header('Content-Type','text/plain')
    ->header('foo','bar');
});

Route::get('/post/{id}',function($id){
    ddd($id);
    return response('Post'.$id);
})->where('id','[0-9]+');
/*
Route::get('/search',function(Request $request){
    dd($request->name.$request->city);
});*/
