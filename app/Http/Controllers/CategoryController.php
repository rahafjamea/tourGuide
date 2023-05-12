<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Category;

use Illuminate\Support\Facades\DB;

class CategoryController extends Controller
{
    
  public function index()
  {
      return Category::all();
  }

  public function create(Request $request)
    {
        $category = new \App\Models\Category();
        $category->category_title = $request->category;
        if (!$category->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        }
        //category successful
        else{
        return response()->json([
            "status" => "success",
            "category_id" => $category->id
        ]);
        }
    }

    public function destroy(Category $category)
    {
        $category->delete();
        return response(null,204);
    }

    public function update(Request $request, Category $category)
    {
      $category->category_title = $request->title;
      $category->save();
    }

}
