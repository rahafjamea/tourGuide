<?php

namespace App\Http\Controllers;

use App\Models\RouteSite;
use App\Models\Route;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Illuminate\Support\Facades\Redis;

class RouteSiteController extends Controller
{
    public function index()
    {
        RouteSite::all();
    }
    public function routeSites(Route $route)
    {
        $sites = DB::table('route_sites')
            ->join('sites', 'route_sites.site_id', '=', 'sites.id')
            ->select('*')
            ->where('route_id', $route->id)
            ->orderBy('day')
            ->orderBy('order')
            ->get();
        return $sites;
    }
    
    public function create(Request $request)
    {
        $routeSite           = new \App\Models\RouteSite();
        $routeSite->route_id = $request->route_id;
        $routeSite->site_id  = $request->site_id;
        $routeSite->day      = $request->day;
        $routeSite->order    = $request->order;

        if (!$routeSite->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //route successful
        else {
            return response()->json([
                "status" => "success",
                "route_site" => $routeSite
            ]);
        }



    }

    
    public function update(Request $request, RouteSite $routeSite)
    {
        if ($request->has('day')) {
            !
                $routeSite->day = $request->day;
        }


        if ($request->has('order')) {
            $routeSite->order = $request->order;
        }


        $routeSite->update();

        return response()->json([
            "status" => "success",
            "message" => "routeSite updated successfully",
            "data" => $routeSite
        ]);
    }

    
    public function destroy(Route $route, Site $site)
    {
        $delete = DB::table('route_sites')
            ->where('route_id', $route->id)
            ->where('site_id', $site->id)
            ->delete();
        return $delete;
        //return response(null, 204);
    }

    
    public function dummygetexp(int $question)
    {
        if ($question==1) return response()->json([
            "question" => "Which of these historical sites are you interested in? (you can select more than one)",
            "type" => "checkbox",
            "options" => ["Museums, Old Houses and Palaces", "Old Markets" ,"Hisotical Monuments"]
        ]);
        else return response()->json([
            "question" => "Are you interested in historical sites?",
            "type" => "radio",
            "options" => ["yes", "no"]
        ]);
        
    }
    public function dummypostexp(Request $request)
    {
        $answer=$request->answer;
        return response()->json([
            "state" => "success",
            "answer" => $answer
        ]);
    }
    public function dummyrecexp()
    {
        $arr = array(

            array(
                'Site'=> '14', 'Day'=> 1, 'Order'=> 1
            ),
            array(
                'Site'=> '17', 'Day'=> 1, 'Order'=> 1
            ),
            array('Site'=> '16,', 'Day'=> 1, 'Order'=> 3),
            array('Site'=> '36,', 'Day'=> 2, 'Order'=> 2),
            array('Site'=> '24,', 'Day'=> 2, 'Order'=> 3),
            array('Site'=> '26,', 'Day'=> 3, 'Order'=> 1),
            array('Site'=> '39,', 'Day'=> 3, 'Order'=> 2),
            array('Site'=> '3,', 'Day'=> 3, 'Order'=> 3)
        );
        return json_encode($arr);
    }

    public function doneexp(Request $request)
    {
        $request=$request->merge(['site_id' => 1,'day' => 1, 'order' => 1,]);
        $route=$this->create($request);
        return $route;
    }
}
