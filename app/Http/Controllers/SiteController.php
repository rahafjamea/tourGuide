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
        $ratings_avg= DB::table('ratings')
           ->where('site_id', $site->id)
           ->avg('rating_out_five');
        $ratings= DB::table('ratings')
           ->select('*')
           ->where('site_id', $site->id)
           -> get();
        return response()-> json(array(
            'site_data' => $site,
            'ratings_avg' => $ratings_avg,
            'ratings' => $ratings
        ));  
    }

    public function create(Request $request)
    {
        $site = new \App\Models\Site();
        $site->title = $request->title;
        $site->location = $request->location;
        //$site->category = $request->category;
        $site->opening_hours = $request->opening_hours;
        $site->description = $request->description;
        $site->is_hidden_gem = $request->is_hidden_gem;

        if (!$site->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //creating successful
        else{
        return response()->json([
            "status" => "success",
            //"site_id" => $site->id
        ]);
        }
    }

    public function destroy(Site $site)
    {
        $site->delete();
        return response(null, 204);
    }
}
