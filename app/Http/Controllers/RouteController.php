<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\User;
use illuminate\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    
    public function index()
    {
        return Route::all();
    }
    public function userRoutes()
    {
        $routes = DB::table('routes')
            ->select('*')
            ->where('user_id', auth()->user()->id)
            ->get();
        return response()->json($routes);
    }
    
    public function create(Request $request)
    {
        $route          = new \App\Models\Route();
        $route->user_id = auth()->user()->id;
        $route->no_of_days = $request->no_of_days;
        if (!$route->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //route successful
        else {
            return response()->json([
                "status" => "success",
                "route" => $route
            ]);
        }
    }

    
    public function destroy(Route $route)
    {
        $route->delete();
        return response(null, 204);
    }
}
