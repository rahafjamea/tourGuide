<?php

namespace App\Http\Controllers;

use App\Models\Image;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ImageController extends Controller
{
    public function imageStore(Request $request)
    {
        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
            'site_id' => 'required'
        ]);

        $image = new \App\Models\Image();

        $image_path = $request->file('image')->store('image', 'public');

        $image->image   = $image_path;
        $image->site_id = $request->site_id;

        $image->save();
        if (!$image->save()) {
            return response()->json([
                "status" => "fail"
            ]);
        } else {
            return response()->json([
                "status" => "success"
            ]);
        }

        return response($image, Response::HTTP_CREATED);
    }

    
    public function destroy(Image $image)
    {
        $image->delete();
        return response(null, 204);
    }
}
