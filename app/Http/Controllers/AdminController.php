<?php

namespace App\Http\Controllers;

use App\Models\Category;
use Illuminate\Http\Request;
use App\Models\Tag;
use Illuminate\Support\Facades\Storage;

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
    public function delTag(Request $request)
    {
        Tag::where('id',$request->id)->delete();

        return response()->json('Success');
        # code...
    }
    //*================================
        //* Controller Category*/ 
    //*================================

    public function getCategory()
    {
        # code...
        $categories = Category::all();
        return response()->json(['categories'=>$categories]);
    }

  
    public function editCategory(Request $request)
    {
        # code...
        $id = $request->id;
        dd($request);
        $photoName = time().'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('uploads'),$photoName);
        $category = Category::findOrFail($id);
        $category->categoryName = $request->categoryName;
        $category->iconImage = $request->iconImage;
        $category->save();
        return response()->json($category);
    }
    public function delCategory(Request $request)
    {
        $category = Category::findOrfail($request->id);
        $photo = $category->iconImage;
        $filePath = public_path().'/uploads/'.$photo;
        if(is_file($filePath)) {
            @unlink($filePath);
            }
        $category->delete();

        return response()->json('Success');
        # code...
    }
    
    public function createCategory(Request $request)
    {
       
        $photoName = time().'.'.$request->file('image')->extension();
        $request->file('image')->move(public_path('uploads'),$photoName);
        $category = Category::create([
            "categoryName"=>$request['categoryName'],
            "iconImage"=>$photoName
        ]);
        return response()->json($category);

    
    }

}