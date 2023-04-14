<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LocationController extends Controller
{
    public function allLocations(){
        //$locations=DB::table()
        $locations= DB::table('locations')
           ->select('*')
           -> get();
        return response()-> json($locations);
    }
    public function singleLocation($location){


        $locations= DB::table('locations')
           ->select('*')
           ->where('id', $location)
           -> get();
        $ratings_avg= DB::table('ratings')
           ->where('site_id', $location)
           ->avg('rating_out_five');
        $ratings= DB::table('ratings')
           ->select('*')
           ->where('site_id', $location)
           -> get();
        return response()-> json(array(
            'location_data' => $locations,
            'ratings_avg' => $ratings_avg,
            'ratings' => $ratings
        ));  
    }
}
