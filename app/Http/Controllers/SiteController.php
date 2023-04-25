<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Site;

class SiteController extends Controller
{
    public function allSites(){
        //$locations=DB::table()
        // $sites= DB::table('sites')
        //    ->select('*')
        //    -> get();
        return Site::all();
    }
    public function singleSite(Site $site){


        // $sites= DB::table('sites')
        //    ->select('*')
        //    ->where('id', $site)
        //    -> get();
        $ratings_avg= DB::table('ratings')
           ->where('site_id', $site)
           ->avg('rating_out_five');
        $ratings= DB::table('ratings')
           ->select('*')
           ->where('site_id', $site)
           -> get();
        return response()-> json(array(
            'site_data' => $site,
            'ratings_avg' => $ratings_avg,
            'ratings' => $ratings
        ));  
    }
}
