<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tag;

class AdminController extends Controller
{
    public function getTag()
    {
        # code...
        $tags = Tag::all();
        return response()->json(['tags'=>$tags]);
    }
    public function addtag(Request $request)
    {
        // dd($request->tagName);
        // $request->validate([
        //     'tagName'=>'required'
        // ]);
        
        return Tag::create([
            'tagName'=>$request->tagName
        ]);
    }
  
    public function editTag(Request $request)
    {
        # code...
        // dd($request->id);
        $id = $request->id;
        $tag = Tag::findOrFail($id);
        // dd($tag);
        $tag->tagName = $request->tagName;
        $tag->save();
        return response()->json($tag);
    }

}