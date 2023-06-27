<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Site;
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
        $ratings = DB::table('ratings')
            ->select('*')
            ->where('site_id', $site->id)
            ->get();
        return $ratings;
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $rating                  = new \App\Models\Rating();
        $rating->user_id         = auth()->user()->id;
        $rating->site_id         = $request->site_id;
        $rating->rating_text     = $request->rating_text;
        $rating->rating_out_five = $request->rating_out_five;
        if (!$rating->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //rating successful
        else {
            return response()->json([
                "status" => "success",
                "rating_id" => $rating->id
            ]);
        }
    }


    public function store(Request $request)
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


    public function update(Request $request, Rating $rating)
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
        return response(null, 204);
    }
}
