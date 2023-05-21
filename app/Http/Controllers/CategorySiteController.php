<?php

namespace App\Http\Controllers;

use App\Models\CategorySite;
use App\Models\Category;
use App\Models\Site;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CategorySiteController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return CategorySite::all();
    }

//     public function allCategories(){
//         //fluent
//         //DB::table('posts')->where('id',1) -> get()

//         $categories= DB::table('categories')
//            ->select('*')
//            //-> distinct()
//            -> get();
//         // $sites= DB::table('sites')
//         //    ->select('*')
//         //    -> get();
//         return response()-> json(array(
//                 'categories' => $categories,
//                 'sites' => Site::all()
//             ));  
//   }

  public function singleCategory($category){
        
        $sites= DB::table('category_sites')
          ->join('sites', 'category_sites.site_id', '=', 'sites.id')
          ->join('categories', 'category_sites.category_id', '=', 'categories.id')
          ->select('*')
          -> where('category_title', $category)
          -> get();
        return $sites;  
  }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $categorySite = new \App\Models\CategorySite();
        $categorySite->category_id = $request->category_id;
        $categorySite->site_id = $request->site_id;
        if (!$categorySite->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //creating successful
        else{
        return response()->json([
            "status" => "success",
            //"category_site_id" => $categorySite->id
        ]);
        }


    }
    
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CategorySite  $categorySite
     * @return \Illuminate\Http\Response
     */
    public function show(CategorySite $categorySite)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CategorySite  $categorySite
     * @return \Illuminate\Http\Response
     */
    public function edit(CategorySite $categorySite)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CategorySite  $categorySite
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CategorySite $categorySite)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CategorySite  $categorySite
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category, Site $site)
    {
        $delete= DB::table('category_sites')
           ->where('category_id', $category->id)
           ->where('site_id', $site->id)
           -> delete();
        return $delete;
    }
}
