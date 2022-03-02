<?php
 
namespace App\Http\Controllers\Api;

use App\Models\Tag;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class TagController extends Controller
{

    public function store(Request $request)
    {
        Tag::create([
            "name"=> $request->name,
        ]);    

        return response()->json(["status"=>"create"]);
    }
    
    public function destroy($id)
    {
        $tag = Tag::find($id);

        $tag->delete($tag);

        return response()->json(['status'=>'deleted']);
    }



}