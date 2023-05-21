<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Site;
use App\Models\Image;

class SiteController extends Controller
{
    public function allSites(){
        
        //for image table
        // $sites = DB::table('sites')
        //   ->leftjoin('images', 'images.site_id', '=', 'sites.id')
        //   ->select('sites.id','title', 'location', 'opening_hours','description','is_hidden_gem',
        //    'sites.created_at','sites.updated_at', 'image')
        //   -> get();
        // return $sites;
        return Site::all();
    }
    public function singleSite(Site $site){
        // $image = DB::table('images')
        // ->select('image')
        // ->where('site_id', $site->id)
        // -> get();
        $ratings_avg= DB::table('ratings')
           ->where('site_id', $site->id)
           ->avg('rating_out_five');
        $ratings= DB::table('ratings')
           ->select('*')
           ->where('site_id', $site->id)
           -> get();

        return response()-> json(array(
            'site_data' => $site,
            //'images' => $image,
            'ratings_avg' => $ratings_avg,
            'ratings' => $ratings
        ));  
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'location' => 'required',
            'description' => 'required'
        ]);
        $site = new \App\Models\Site();
        $site->title = $request->title;
        $site->location = $request->location;
        //$site->category = $request->category;
        $site->opening_hours = $request->opening_hours;
        $site->description = $request->description;
        $site->is_hidden_gem = $request->is_hidden_gem;
        if ($request->has('image')) {
            $request->validate([
                'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
            ]);
            $site->image = $request->file('image')->store('image', 'public');
        }


        if (!$site->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //creating successful
        else{
        return response()->json([
            "status" => "success",
            "site_id" => $site->id
        ]);
        }
    }

    public function update(Request $request, Site $site)
    {
        

            //$site_id = $site->id;

            if ($request->has('title')) {!
                $site->title = $request->title;
            }


            if ($request->has('location')) {
                $site->location = $request->location;
            }

            if ($request->has('opening_hours')) {
                $site->opening_hours = $request->opening_hours;
            }

            if ($request->has('description')) {
                $site->description = $request->description;
            }

            if ($request->has('is_hidden_gem')) {
                $site->is_hidden_gem = $request->is_hidden_gem;
            }
            if ($request->has('image')) {
                $request->validate([
                    'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048'
                ]);
                $site->image = $request->file('image')->store('image', 'public');
            }
    

            $site->update();
            $data = $site;

            return response()->json([
             "status" => "success",
             "message" => "site updated successfully",
             "data" => $data
         ]);
        
    }


    public function destroy(Site $site)
    {
        $site->delete();
        return response(null, 204);
    }
}
