<?php

namespace App\Http\Controllers;

use App\Models\CategorySite;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorySiteController extends Controller
{
    public function singleCategory($category)
    {

        $sites = DB::table('category_sites')
            ->join('sites', 'category_sites.site_id', '=', 'sites.id')
            ->join('categories', 'category_sites.category_id', '=', 'categories.id')
            ->select('*')
            ->where('categories.id', $category)
            ->get();
        return $sites;
    }

    public function create(Request $request)
    {
        $categorySite              = new \App\Models\CategorySite();
        $categorySite->category_id = $request->category_id;
        $categorySite->site_id     = $request->site_id;
        if (!$categorySite->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //creating successful
        else {
            return response()->json([
                "status" => "success",
                "category_site" => $categorySite
            ]);
        }


    }

    public function destroy(Category $category, Site $site)
    {
        $delete = DB::table('category_sites')
            ->where('category_id', $category->id)
            ->where('site_id', $site->id)
            ->delete();
        return $delete;
    }
}
