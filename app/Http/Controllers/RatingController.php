<?php

namespace App\Http\Controllers;

use App\Models\Rating;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RatingController extends Controller
{
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
                "rating" => $rating
            ]);
        }
    }

    public function destroy(Rating $rating)
    {
        $rating->delete();
        return response(null, 204);
    }
}
