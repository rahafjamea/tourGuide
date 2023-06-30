<?php

namespace App\Http\Controllers;

use App\Models\RouteSite;
use App\Models\Route;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

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

    
}
