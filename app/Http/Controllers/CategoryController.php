<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Site;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    

    public function allCategories(){
        //fluent
        //DB::table('posts')->where('id',1) -> get()

        $categories= DB::table('sites')
           ->select('category')
           -> distinct()
           -> get();
        // $sites= DB::table('sites')
        //    ->select('*')
        //    -> get();
        return response()-> json(array(
                'categories' => $categories,
                'sites' => Site::all()
            ));  
    }

    public function singleCategory($category){
        $categories= DB::table('sites')
          ->select('category')
          -> distinct()
          -> get();
        $sites= DB::table('sites')
          ->select('*')
          -> where('category', $category)
          -> get();
        return response()-> json(array(
                'categories' => $categories,
                'sites' => $sites
            ));  
    }
}
