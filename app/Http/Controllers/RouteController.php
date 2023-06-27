<?php

namespace App\Http\Controllers;

use App\Models\Route;
use App\Models\User;
use illuminate\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;

class RouteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
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
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $route          = new \App\Models\Route();
        $route->user_id = auth()->user()->id;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        // $route = Route::create([
        //     'user_id' => $request->input('user_id')
        //     //'user_id' => Auth::id()

        // ]

        // );
        // return $request->input('user_id');

    }



    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function show(Route $route)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function edit(Route $route)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\Request  $request
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Route $route)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Route  $route
     * @return \Illuminate\Http\Response
     */
    public function destroy(Route $route)
    {
        $route->delete();
        return response(null, 204);
    }
}
