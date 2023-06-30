<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Site;
use App\Models\Image;

class SiteController extends Controller
{
    public function allSites()
    {
        $sites = Site::all();

        $images = DB::table('sites')
            ->join('images', 'images.site_id', '=', 'sites.id')
            ->select('sites.id', 'image')
            //->groupBy('sites.id')
            ->get();

        return response()->json(
            array(
                'site_data' => $sites,
                'images' => $images,
            )
        );
        //return Site::all();
    }
    public function singleSite(Site $site)
    {
        $image       = DB::table('images')
            ->select('image')
            ->where('site_id', $site->id)
            ->get();
        $ratings_avg = DB::table('ratings')
            ->where('site_id', $site->id)
            ->avg('rating_out_five');

        return response()->json(
            array(
                'site_data' => $site,
                'images' => $image,
                'ratings_avg' => $ratings_avg,
            )
        );
    }

    public function create(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'longitude' => 'required',
            'latitude' => 'required',
            'description' => 'required'
        ]);
        $site           = new \App\Models\Site();
        $site->title    = $request->title;
        $site->longitude = $request->longitude;
        $site->latitude = $request->latitude;
        $site->opening_hours = $request->opening_hours;
        $site->description   = $request->description;


        if (!$site->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //creating successful
        else {
            return response()->json([
                "status" => "success",
                "site" => $site
            ]);
        }
    }

    public function update(Request $request, Site $site)
    {


        //$site_id = $site->id;

        if ($request->has('title')) {
            !
                $site->title = $request->title;
        }


        if ($request->has('longitude')) {
            $site->longitude = $request->longitude;
            $site->latitude = $request->latitude;
        }
        if ($request->has('latitude')) {
            $site->latitude = $request->latitude;
        }

        if ($request->has('opening_hours')) {
            $site->opening_hours = $request->opening_hours;
        }

        if ($request->has('description')) {
            $site->description = $request->description;
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
