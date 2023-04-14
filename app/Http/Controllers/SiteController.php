<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SiteController extends Controller
{
    public function allSites(){
        //$locations=DB::table()
        $sites= DB::table('sites')
           ->select('*')
           -> get();
        return response()-> json($sites);
    }
    public function singleSite($site){


        $sites= DB::table('sites')
           ->select('*')
           ->where('id', $site)
           -> get();
        $ratings_avg= DB::table('ratings')
           ->where('site_id', $site)
           ->avg('rating_out_five');
        $ratings= DB::table('ratings')
           ->select('*')
           ->where('site_id', $site)
           -> get();
        return response()-> json(array(
            'site_data' => $sites,
            'ratings_avg' => $ratings_avg,
            'ratings' => $ratings
        ));  
    }
}
