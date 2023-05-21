<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Site;
use App\Http\Requests\StoreratingRequest;
use App\Http\Requests\UpdateratingRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return Rating::all();
    }

    public function siteRating(Site $site)
    {
        $ratings= DB::table('ratings')
           ->select('*')
           ->where('site_id', $site->id)
           -> get();
        return $ratings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rating = new \App\Models\Rating();
        $rating->user_id = $request->user_id;
        $rating->site_id = $request->site_id;
        $rating->rating_text = $request->rating_text;
        $rating->rating_out_five = $request->rating_out_five;
        if (!$rating->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //rating successful
        else{
        return response()->json([
            "status" => "success",
            "rating_id" => $rating->id
        ]);
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreratingRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreratingRequest $request)
    {
        
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function show(rating $rating)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function edit(Rating $rating)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateratingRequest  $request
     * @param  \App\Models\rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateratingRequest $request, Rating $rating)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\rating  $rating
     * @return \Illuminate\Http\Response
     */
    public function destroy(Rating $rating)
    {
        $rating->delete();
        return response(null,204);
    }
}
